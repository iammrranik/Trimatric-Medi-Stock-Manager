<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'Moderator') { 
    header("Location: loginPage.php"); 
    exit(); 
}
include_once '../model/moderatorModel.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Moderator Panel | Trimatric</title>
    <link rel="stylesheet" href="Design/moderatorDesign.css">
</head>
<<<<<<< HEAD
<body>

<div class="sidebar">
    <div class="sidebar-header">
        <h2>TRIMATRIC</h2>
        <span class="role-badge">Moderator Access</span>
    </div>
    <nav>
        <button class="side-btn" onclick="showTab('inventory')">📦 Inventory</button>
        <button class="side-btn" onclick="showTab('patients')">👥 Patients</button>
        <button class="side-btn" onclick="showTab('payments')">💰 Payments</button>
        <hr class="nav-divider">
        <button class="side-btn reload-btn" onclick="window.location.reload();">↻ Refresh</button>
        <a href="../controller/moderatorController.php?action=logout" class="side-btn logout-link">Logout ⏻</a>
    </nav>
</div>

<div class="main-content">
    <div id="inventory" class="tab-pane">
        <div class="header-row">
            <h1>Stock Management</h1>
            <button class="btn-add" onclick="prepareAddInv()">+ Add New Item</button>
        </div>
        <table class="data-table">
            <thead>
                <tr><th>Product</th><th>Qty</th><th>Category</th><th>Expiry</th><th>Status</th><th>Actions</th></tr>
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
                    <td><button class="btn-edit" onclick='editInv(<?php echo json_encode($r); ?>)'>Edit</button></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div id="patients" class="tab-pane" style="display:none">
        <div class="header-row">
            <h1>Patient Database</h1>
            <button class="btn-add" onclick="prepareAddPat()">+ New Patient</button>
        </div>
        <table class="data-table">
            <thead>
                <tr><th>Serial</th><th>Name</th><th>Phone</th><th>Task</th><th>Actions</th></tr>
            </thead>
            <tbody>
                <?php $res = fetchTable('patients'); while($r = mysqli_fetch_assoc($res)): ?>
                <tr>
                    <td>#<?php echo $r['patient_serial']; ?></td>
                    <td><?php echo htmlspecialchars($r['patient_name']); ?></td>
                    <td><?php echo htmlspecialchars($r['phone_no']); ?></td>
                    <td><?php echo htmlspecialchars($r['record_task_type']); ?></td>
                    <td><button class="btn-edit" onclick='editPat(<?php echo json_encode($r); ?>)'>Edit</button></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div id="payments" class="tab-pane" style="display:none">
        <div class="header-row">
            <h1>Payment Records</h1>
            <button class="btn-add" onclick="prepareAddPay()">+ Record Payment</button>
        </div>
        <table class="data-table">
            <thead>
                <tr><th>ID</th><th>Patient</th><th>Amount</th><th>Ref</th><th>Actions</th></tr>
            </thead>
            <tbody>
                <?php $res = fetchTable('payments'); while($r = mysqli_fetch_assoc($res)): ?>
                <tr>
                    <td><?php echo $r['payment_id']; ?></td>
                    <td><?php echo htmlspecialchars($r['patient_name']); ?></td>
                    <td><strong>$<?php echo number_format($r['amount'], 2); ?></strong></td>
                    <td><?php echo $r['patient_serial']; ?></td>
                    <td><button class="btn-edit" onclick='editPay(<?php echo json_encode($r); ?>)'>Edit</button></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<div id="invModal" class="modal">
    <div class="modal-content">
        <h2 id="i_title">Stock Form</h2>
        <form action="../controller/moderatorController.php" method="POST" class="form-grid">
            <input type="hidden" name="id" id="i_id">
            <input type="text" name="product_name" id="i_name" placeholder="Product Name" required>
            <input type="date" name="purchase_date" id="i_pdate" required>
            <input type="number" name="quantity" id="i_qty" placeholder="Quantity">
            <input type="text" name="category" id="i_cat" placeholder="Category">
            <input type="date" name="expire_date" id="i_edate" required>
            <select name="status" id="i_status">
                <option value="Valid">Valid</option>
                <option value="Expired">Expired</option>
            </select>
            <div class="modal-buttons">
                <button type="submit" name="save_inv" class="btn-save">Save Item</button>
                <button type="button" class="btn-cancel" onclick="closeModal('invModal')">Cancel</button>
            </div>
        </form>
    </div>
</div>

<div id="patModal" class="modal">
    <div class="modal-content">
        <h2>Patient Form</h2>
        <form action="../controller/moderatorController.php" method="POST" class="form-grid">
            <input type="hidden" name="patient_serial" id="p_serial">
            <input type="text" name="patient_name" id="p_name" placeholder="Full Name" required>
            <input type="text" name="phone_no" id="p_phone" placeholder="Phone Number" required>
            <input type="text" name="record_task_type" id="p_task" placeholder="Task Type">
            <div class="modal-buttons">
                <button type="submit" name="save_pat" class="btn-save">Save Patient</button>
                <button type="button" class="btn-cancel" onclick="closeModal('patModal')">Cancel</button>
            </div>
        </form>
    </div>
</div>

<div id="payModal" class="modal">
    <div class="modal-content">
        <h2 id="pay_title">Payment Record</h2>
        <form action="../controller/moderatorController.php" method="POST" class="form-grid">
            <input type="hidden" name="payment_id" id="f_pay_id">
            <input type="text" name="patient_name" id="f_pay_name" placeholder="Patient Name" required>
            <input type="text" name="phone_no" id="f_pay_phone" placeholder="Phone Number" required>
            <input type="number" step="0.01" name="amount" id="f_pay_amount" placeholder="Amount" required>
            <input type="number" name="patient_serial" id="f_pay_serial" placeholder="Ref Serial" required>
            <div class="modal-buttons">
                <button type="submit" name="save_pay" class="btn-save">Save Transaction</button>
                <button type="button" class="btn-cancel" onclick="closeModal('payModal')">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
    function showTab(id) {
        document.querySelectorAll('.tab-pane').forEach(t => t.style.display = 'none');
        document.getElementById(id).style.display = 'block';
    }
    function openModal(id) { document.getElementById(id).style.display = 'flex'; }
    function closeModal(id) { document.getElementById(id).style.display = 'none'; }

    function prepareAddInv() { document.getElementById('i_id').value = ""; document.querySelector('#invModal form').reset(); openModal('invModal'); }
    function editInv(data) {
        document.getElementById('i_id').value = data.id;
        document.getElementById('i_name').value = data.product_name;
        document.getElementById('i_pdate').value = data.purchase_date;
        document.getElementById('i_qty').value = data.quantity;
        document.getElementById('i_cat').value = data.category;
        document.getElementById('i_edate').value = data.expire_date;
        document.getElementById('i_status').value = data.status;
        openModal('invModal');
    }

    function prepareAddPat() { document.getElementById('p_serial').value = ""; document.querySelector('#patModal form').reset(); openModal('patModal'); }
    function editPat(data) {
        document.getElementById('p_serial').value = data.patient_serial;
        document.getElementById('p_name').value = data.patient_name;
        document.getElementById('p_phone').value = data.phone_no;
        document.getElementById('p_task').value = data.record_task_type;
        openModal('patModal');
    }

    function prepareAddPay() { document.getElementById('f_pay_id').value = ""; document.querySelector('#payModal form').reset(); openModal('payModal'); }
    function editPay(data) {
        document.getElementById('f_pay_id').value = data.payment_id;
        document.getElementById('f_pay_name').value = data.patient_name;
        document.getElementById('f_pay_phone').value = data.phone_no;
        document.getElementById('f_pay_amount').value = data.amount;
        document.getElementById('f_pay_serial').value = data.patient_serial;
        openModal('payModal');
    }
</script>
</body>
</html>
=======

</html>
>>>>>>> b8a7c4abd6bc3ad98aa622459974fe6bc508f502
