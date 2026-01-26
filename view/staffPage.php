<?php
session_start();
// Security Check: Only allow 'Staff' role
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'Staff') { 
    header("Location: loginPage.php"); 
    exit(); 
}
include_once '../model/moderatorModel.php'; // We use the same fetch logic
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff Portal | Trimatric</title>
    <link rel="stylesheet" href="Design/staffDesign.css">
</head>
<body>

<div class="sidebar">
    <div class="sidebar-header">
        <h2>TRIMATRIC</h2>
        <span class="role-badge">Staff Access</span>
    </div>
    <nav>
        <button class="side-btn" onclick="showTab('inventory')">📦 View Inventory</button>
        <button class="side-btn" onclick="showTab('patients')">👥 View Patients</button>
        <hr class="nav-divider">
        <button class="side-btn reload-btn" onclick="window.location.reload();">↻ Refresh Data</button>
        <a href="../controller/moderatorController.php?action=logout" class="side-btn logout-link">Logout ⏻</a>
    </nav>
</div>

<div class="main-content">
    <div id="inventory" class="tab-pane">
        <div class="header-row">
            <h1>Current Inventory</h1>
            <div class="info-tag">View Only Mode</div>
        </div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Stock Qty</th>
                    <th>Category</th>
                    <th>Expiry Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $res = fetchTable('inventory'); while($r = mysqli_fetch_assoc($res)): ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($r['product_name']); ?></strong></td>
                    <td><?php echo $r['quantity']; ?></td>
                    <td><?php echo htmlspecialchars($r['category']); ?></td>
                    <td><?php echo $r['expire_date']; ?></td>
                    <td>
                        <span class="status-tag <?php echo (strtolower($r['status']) == 'valid') ? 'status-valid' : 'status-expired'; ?>">
                            <?php echo !empty($r['status']) ? htmlspecialchars($r['status']) : 'Valid'; ?>
                        </span>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div id="patients" class="tab-pane" style="display:none">
        <div class="header-row">
            <h1>Patient Directory</h1>
        </div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Serial</th>
                    <th>Patient Name</th>
                    <th>Phone</th>
                    <th>Last Task</th>
                </tr>
            </thead>
            <tbody>
                <?php $res = fetchTable('patients'); while($r = mysqli_fetch_assoc($res)): ?>
                <tr>
                    <td>#<?php echo $r['patient_serial']; ?></td>
                    <td><?php echo htmlspecialchars($r['patient_name']); ?></td>
                    <td><?php echo htmlspecialchars($r['phone_no']); ?></td>
                    <td><?php echo htmlspecialchars($r['record_task_type']); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function showTab(id) {
        document.querySelectorAll('.tab-pane').forEach(t => t.style.display = 'none');
        document.getElementById(id).style.display = 'block';
    }
</script>
</body>
</html>