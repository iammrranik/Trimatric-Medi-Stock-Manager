<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: loginPage.php");
    exit();
}
include_once '../model/adminModel.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Trimatric Manager | Full Access</title>
    <link rel="stylesheet" href="Design/adminDesign.css">
</head>

<body>

    <div class="sidebar">
        <h2>TRIMATRIC</h2>
        <nav>
            <button class="side-btn" onclick="showTab('users')">Manage Users</button>
            <button class="side-btn" onclick="showTab('inventory')">Inventory</button>
            <button class="side-btn" onclick="showTab('patients')">Patients</button>
            <button class="side-btn" onclick="showTab('payments')">Payments</button>
            <hr>
            <button class="side-btn reload-btn" onclick="window.location.reload();">Reload Data ↻</button>
            <a href="../controller/adminController.php?action=logout" class="side-btn logout-link" onclick="return confirm('Logout now?')">Logout ⏻</a>
        </nav>
    </div>

    <div class="main-content">

        <div id="users" class="tab-pane">
            <div class="header-row">
                <h1>Staff & Users</h1>
                <button class="btn-add" onclick="prepareAddUser()">+ Add User</button>
            </div>
            <br>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Full Name</th>
                        <th>Password</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $res = fetchAll('users');
                    while ($r = mysqli_fetch_assoc($res)): ?>
                        <tr>
                            <td><?php echo $r['username']; ?></td>
                            <td><?php echo $r['full_name']; ?></td>
                            <td><?php echo $r['password']; ?></td>
                            <td><?php echo $r['role']; ?></td>
                            <td>
                                <button class="btn-edit" onclick='editUser(<?php echo json_encode($r); ?>)'>Edit</button>
                                <a href="../controller/adminController.php?type=users&del=<?php echo urlencode($r['username']); ?>" class="btn-del">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <div id="inventory" class="tab-pane" style="display:none">
            <div class="header-row">
                <h1>Stock Inventory</h1>
                <button class="btn-add" onclick="prepareAddInv()">+ Add Item</button>
            </div>
            <br>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Category</th>
                        <th>Expiry</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $res = fetchAll('inventory');
                    while ($r = mysqli_fetch_assoc($res)): ?>
                        <tr>
                            <td><?php echo $r['product_name']; ?></td>
                            <td><?php echo $r['quantity']; ?></td>
                            <td><?php echo $r['category']; ?></td>
                            <td><?php echo $r['expire_date']; ?></td>
                            <td><?php echo $r['status']; ?></td>
                            <td>
                                <button class="btn-edit" onclick='editInv(<?php echo json_encode($r); ?>)'>Edit</button>
                                <a href="../controller/adminController.php?type=inv&del=<?php echo $r['id']; ?>" class="btn-del">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <div id="patients" class="tab-pane" style="display:none">
            <div class="header-row">
                <h1>Patient Records</h1>
                <button class="btn-add" onclick="prepareAddPat()">+ Add Patient</button>
            </div>
            <br>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Serial</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Task</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $res = fetchAll('patients');
                    while ($r = mysqli_fetch_assoc($res)): ?>
                        <tr>
                            <td><?php echo $r['patient_serial']; ?></td>
                            <td><?php echo $r['patient_name']; ?></td>
                            <td><?php echo $r['phone_no']; ?></td>
                            <td><?php echo $r['record_task_type']; ?></td>
                            <td>
                                <button class="btn-edit" onclick='editPat(<?php echo json_encode($r); ?>)'>Edit</button>
                                <a href="../controller/adminController.php?type=pat&del=<?php echo $r['patient_serial']; ?>" class="btn-del">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <div id="payments" class="tab-pane" style="display:none">
            <div class="header-row">
                <h1>Payment Management</h1>
                <button class="btn-add" onclick="prepareAddPay()">+ Record New Payment</button>
            </div>
            <br>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Patient Name</th>
                        <th>Phone</th>
                        <th>Amount</th>
                        <th>Ref Serial</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $res = fetchAll('payments');
                    while ($r = mysqli_fetch_assoc($res)): ?>
                        <tr>
                            <td><?php echo $r['payment_id']; ?></td>
                            <td><?php echo htmlspecialchars($r['patient_name']); ?></td>
                            <td><?php echo htmlspecialchars($r['phone_no']); ?></td>
                            <td><strong>৳ <?php echo number_format($r['amount'], 2); ?></strong></td>
                            <td><?php echo $r['patient_serial']; ?></td>
                            <td>
                                <button class="btn-edit" onclick='editPay(<?php echo json_encode($r); ?>)'>Edit</button>
                                <a href="../controller/adminController.php?type=pay&del=<?php echo $r['payment_id']; ?>"
                                    class="btn-del" onclick="return confirm('Delete this payment?')">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <div id="userModal" class="modal">
            <div class="modal-content">
                <h2 id="u_title">User Form</h2>
                <form action="../controller/adminController.php" method="POST" class="form-grid">
                    <input type="hidden" name="old_username" id="old_username">
                    <input type="text" name="username" id="u_name" placeholder="Username" required>
                    <input type="text" name="full_name" id="u_full" placeholder="Full Name" required>
                    <input type="text" name="password" id="u_pass" placeholder="Password" required>
                    <input type="text" name="nid" id="u_nid" placeholder="NID">
                    <input type="email" name="email" id="u_email" placeholder="Email">
                    <input type="text" name="phone_no" id="u_phone" placeholder="Phone">
                    <input type="text" name="address" id="u_addr" placeholder="Address" style="grid-column: span 2;">
                    <select name="role" id="u_role">
                        <option>Admin</option>
                        <option>Moderator</option>
                        <option>Staff</option>
                    </select>
                    <button type="submit" name="save_user" class="btn-save">Save User</button>
                    <button type="button" class="btn-cancel" onclick="closeModal('userModal')">Cancel</button>
                </form>
            </div>
        </div>

        <div id="invModal" class="modal">
            <div class="modal-content">
                <h2 id="i_title">Stock Form</h2>
                <form action="../controller/adminController.php" method="POST" class="form-grid">
                    <input type="hidden" name="id" id="i_id">
                    <input type="text" name="product_name" id="i_name" placeholder="Product Name" required>
                    <input type="date" name="purchase_date" id="i_pdate" required>
                    <input type="number" name="quantity" id="i_qty" placeholder="Quantity">
                    <input type="text" name="category" id="i_cat" placeholder="Category">
                    <input type="date" name="expire_date" id="i_edate" required>
                    <select name="status" id="i_status">
                        <option>Valid</option>
                        <option>Expired</option>
                    </select>
                    <button type="submit" name="save_inv" class="btn-save">Save Item</button>
                    <button type="button" class="btn-cancel" onclick="closeModal('invModal')">Cancel</button>
                </form>
            </div>
        </div>

        <div id="patModal" class="modal">
            <div class="modal-content">
                <h2 id="p_title">Patient Form</h2>
                <form action="../controller/adminController.php" method="POST" class="form-grid">
                    <input type="hidden" name="patient_serial" id="p_serial">
                    <input type="text" name="patient_name" id="p_name" placeholder="Name" required>
                    <input type="text" name="phone_no" id="p_phone" placeholder="Phone" required>
                    <input type="text" name="record_task_type" id="p_task" placeholder="Task Type">
                    <button type="submit" name="save_pat" class="btn-save">Save Patient</button>
                    <button type="button" class="btn-cancel" onclick="closeModal('patModal')">Cancel</button>
                </form>
            </div>
        </div>

        <div id="payModal" class="modal">
            <div class="modal-content">
                <h2 id="pay_title">Payment Record</h2>
                <form action="../controller/adminController.php" method="POST" class="form-grid">
                    <input type="hidden" name="payment_id" id="f_pay_id">

                    <input type="text" name="patient_name" id="f_pay_name" placeholder="Patient Name" required>
                    <input type="text" name="phone_no" id="f_pay_phone" placeholder="Phone Number" required>
                    <input type="number" step="0.01" name="amount" id="f_pay_amount" placeholder="Amount" required>
                    <input type="number" name="patient_serial" id="f_pay_serial" placeholder="Ref Serial" required>

                    <div style="grid-column: span 2;">
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

            function openModal(id) {
                document.getElementById(id).style.display = 'flex';
            }

            function closeModal(id) {
                document.getElementById(id).style.display = 'none';
            }

            // USER JS
            function prepareAddUser() {
                document.getElementById('old_username').value = "";
                document.querySelector('#userModal form').reset();
                openModal('userModal');
            }

            function editUser(data) {
                document.getElementById('old_username').value = data.username;
                document.getElementById('u_name').value = data.username;
                document.getElementById('u_full').value = data.full_name;
                document.getElementById('u_pass').value = data.password;
                document.getElementById('u_nid').value = data.nid;
                document.getElementById('u_email').value = data.email;
                document.getElementById('u_addr').value = data.address;
                document.getElementById('u_phone').value = data.phone_no;
                document.getElementById('u_role').value = data.role;
                openModal('userModal');
            }

            // INVENTORY JS
            function prepareAddInv() {
                document.getElementById('i_id').value = "";
                document.querySelector('#invModal form').reset();
                openModal('invModal');
            }

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

            // PATIENT JS
            function prepareAddPat() {
                document.getElementById('p_serial').value = "";
                document.querySelector('#patModal form').reset();
                openModal('patModal');
            }

            function editPat(data) {
                document.getElementById('p_serial').value = data.patient_serial;
                document.getElementById('p_name').value = data.patient_name;
                document.getElementById('p_phone').value = data.phone_no;
                document.getElementById('p_task').value = data.record_task_type;
                openModal('patModal');
            }

            function prepareAddPay() {
                document.getElementById('pay_title').innerText = "Record New Payment";
                document.getElementById('f_pay_id').value = ""; // Crucial: clear hidden ID
                document.querySelector('#payModal form').reset();
                openModal('payModal');
            }

            // Function to populate modal for EDITING payment
            function editPay(data) {
                document.getElementById('pay_title').innerText = "Edit Payment Record";
                document.getElementById('f_pay_id').value = data.payment_id; // Set ID for Update
                document.getElementById('f_pay_name').value = data.patient_name;
                document.getElementById('f_pay_phone').value = data.phone_no;
                document.getElementById('f_pay_amount').value = data.amount;
                document.getElementById('f_pay_serial').value = data.patient_serial;
                openModal('payModal');
            }
        </script>
</body>

</html>