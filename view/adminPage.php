<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: loginPage.php");
    exit();
}
include_once '../model/adminModel.php';

// Handle database error messages
$errorMsg = isset($_GET['error']) ? $_GET['error'] : '';
$successMsg = isset($_GET['msg']) ? $_GET['msg'] : '';
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
            <div class="search-container">
                <input type="text" id="usersSearchInput" placeholder="Search by username, name, email, or phone..." class="search-input">
                <button class="btn-search" onclick="searchTable('users')">🔍 Search</button>
                <button class="btn-clear" onclick="clearSearch('users')">Clear</button>
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
            <div class="search-container">
                <input type="text" id="inventorySearchInput" placeholder="Search by product name or category..." class="search-input">
                <button class="btn-search" onclick="searchTable('inventory')">🔍 Search</button>
                <button class="btn-clear" onclick="clearSearch('inventory')">Clear</button>
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
            <div class="search-container">
                <input type="text" id="patientsSearchInput" placeholder="Search by name, phone, or serial..." class="search-input">
                <button class="btn-search" onclick="searchTable('patients')">🔍 Search</button>
                <button class="btn-clear" onclick="clearSearch('patients')">Clear</button>
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
            <div class="search-container">
                <input type="text" id="paymentsSearchInput" placeholder="Search by patient name, phone, or serial..." class="search-input">
                <button class="btn-search" onclick="searchTable('payments')">🔍 Search</button>
                <button class="btn-clear" onclick="clearSearch('payments')">Clear</button>
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
                <div id="userErrors" style="display:none; padding:10px; background-color:#f8d7da; color:#721c24; border-radius:4px; margin-bottom:10px;"></div>
                <form action="../controller/adminController.php" method="POST" class="form-grid" onsubmit="return validateUserForm(event)">
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
                <div id="invErrors" style="display:none; padding:10px; background-color:#f8d7da; color:#721c24; border-radius:4px; margin-bottom:10px;"></div>
                <form action="../controller/adminController.php" method="POST" class="form-grid" onsubmit="return validateInventoryForm(event)">
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
                <div id="patErrors" style="display:none; padding:10px; background-color:#f8d7da; color:#721c24; border-radius:4px; margin-bottom:10px;"></div>
                <form action="../controller/adminController.php" method="POST" class="form-grid" onsubmit="return validatePatientForm(event)">
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
                <div id="payErrors" style="display:none; padding:10px; background-color:#f8d7da; color:#721c24; border-radius:4px; margin-bottom:10px;"></div>
                <form action="../controller/adminController.php" method="POST" class="form-grid" onsubmit="return validatePaymentForm(event)">
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
            // ============= VALIDATION HELPER FUNCTIONS =============
            function showError(errorDivId, messages) {
                const errorDiv = document.getElementById(errorDivId);
                if (messages.length > 0) {
                    errorDiv.innerHTML = '<strong>Please fix the following errors:</strong><ul style="margin: 8px 0; padding-left: 20px;">' 
                        + messages.map(msg => '<li>' + msg + '</li>').join('') + '</ul>';
                    errorDiv.style.display = 'block';
                    return false;
                }
                errorDiv.style.display = 'none';
                return true;
            }

            // ============= ERROR & SUCCESS NOTIFICATIONS =============
            window.addEventListener('load', function() {
                const urlParams = new URLSearchParams(window.location.search);
                const errorMsg = urlParams.get('error');
                const msg = urlParams.get('msg');

                if (errorMsg) {
                    alert('❌ Error: ' + decodeURIComponent(errorMsg));
                    window.history.replaceState({}, document.title, window.location.pathname);
                } else if (msg === 'success') {
                    alert('✓ Operation completed successfully!');
                    window.history.replaceState({}, document.title, window.location.pathname);
                } else if (msg === 'deleted') {
                    alert('✓ Record deleted successfully!');
                    window.history.replaceState({}, document.title, window.location.pathname);
                }
            });

            function validateEmail(email) {
                // Must have @ and at least one dot after @
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }

            function validateNID(nid) {
                // NID must be 10, 13, or 17 digits
                const nidDigits = nid.replace(/\D/g, '');
                return [10, 13, 17].includes(nidDigits.length);
            }

            function validatePassword(password) {
                // Min 8 characters, at least 1 capital letter, 1 number, 1 special character
                if (password.length < 8) return false;
                if (!/[A-Z]/.test(password)) return false;
                if (!/[0-9]/.test(password)) return false;
                if (!/[!@#$%^&*()_+\-=\[\]{};:'",.<>?/\\|`~]/.test(password)) return false;
                return true;
            }

            function validatePhone(phone) {
                // Extract only digits
                const phoneDigits = phone.replace(/\D/g, '');
                // Must be exactly 11 digits
                return phoneDigits.length === 11;
            }

            // ============= USER FORM VALIDATION =============
            function validateUserForm(event) {
                event.preventDefault();
                const errors = [];

                const username = document.getElementById('u_name').value.trim();
                const fullName = document.getElementById('u_full').value.trim();
                const password = document.getElementById('u_pass').value.trim();
                const nid = document.getElementById('u_nid').value.trim();
                const email = document.getElementById('u_email').value.trim();
                const phone = document.getElementById('u_phone').value.trim();

                // Username validation
                if (username.length < 3) {
                    errors.push('Username must be at least 3 characters long');
                }
                if (!/^[a-zA-Z0-9_]+$/.test(username)) {
                    errors.push('Username can only contain letters, numbers, and underscores');
                }

                // Full Name validation
                if (fullName.length < 3) {
                    errors.push('Full Name must be at least 3 characters long');
                }
                if (!/^[a-zA-Z\s]+$/.test(fullName)) {
                    errors.push('Full Name can only contain letters and spaces');
                }

                // Password validation - NEW STRICT REQUIREMENTS
                if (!validatePassword(password)) {
                    errors.push('Password must be at least 8 characters with 1 capital letter, 1 number, and 1 special character (!@#$%^&*etc)');
                }

                // NID validation - NEW REQUIREMENTS
                if (nid && !validateNID(nid)) {
                    errors.push('NID must be 10, 13, or 17 digits');
                }

                // Email validation (optional but if provided, must be valid)
                if (email && !validateEmail(email)) {
                    errors.push('Email must contain @ and . (dot)');
                }

                // Phone validation (optional but if provided, must be valid)
                if (phone && !validatePhone(phone)) {
                    errors.push('Phone number must be exactly 11 digits');
                }

                if (!showError('userErrors', errors)) {
                    return false;
                }

                // If all validations pass, submit the form
                event.target.submit();
                return false;
            }

            // ============= INVENTORY FORM VALIDATION =============
            function validateInventoryForm(event) {
                event.preventDefault();
                const errors = [];

                const productName = document.getElementById('i_name').value.trim();
                const purchaseDate = document.getElementById('i_pdate').value;
                const quantity = document.getElementById('i_qty').value.trim();
                const expireDate = document.getElementById('i_edate').value;

                // Product Name validation
                if (productName.length < 2) {
                    errors.push('Product Name must be at least 2 characters long');
                }

                // Purchase Date validation
                if (!purchaseDate) {
                    errors.push('Purchase Date is required');
                } else if (new Date(purchaseDate) > new Date()) {
                    errors.push('Purchase Date cannot be in the future');
                }

                // Quantity validation
                if (quantity && isNaN(quantity)) {
                    errors.push('Quantity must be a number');
                }
                if (quantity && parseInt(quantity) <= 0) {
                    errors.push('Quantity must be greater than 0');
                }

                // Expire Date validation
                if (!expireDate) {
                    errors.push('Expiry Date is required');
                } else if (new Date(expireDate) <= new Date()) {
                    errors.push('Expiry Date must be in the future');
                }

                // Check if expire date is after purchase date
                if (purchaseDate && expireDate && new Date(expireDate) <= new Date(purchaseDate)) {
                    errors.push('Expiry Date must be after Purchase Date');
                }

                if (!showError('invErrors', errors)) {
                    return false;
                }

                event.target.submit();
                return false;
            }

            // ============= PATIENT FORM VALIDATION =============
            function validatePatientForm(event) {
                event.preventDefault();
                const errors = [];

                const patientName = document.getElementById('p_name').value.trim();
                const phone = document.getElementById('p_phone').value.trim();

                // Patient Name validation
                if (patientName.length < 2) {
                    errors.push('Patient Name must be at least 2 characters long');
                }
                if (!/^[a-zA-Z\s]+$/.test(patientName)) {
                    errors.push('Patient Name can only contain letters and spaces');
                }

                // Phone validation
                if (!phone) {
                    errors.push('Phone Number is required');
                } else if (!validatePhone(phone)) {
                    errors.push('Phone number must be exactly 11 digits');
                }

                if (!showError('patErrors', errors)) {
                    return false;
                }

                event.target.submit();
                return false;
            }

            // ============= PAYMENT FORM VALIDATION =============
            function validatePaymentForm(event) {
                event.preventDefault();
                const errors = [];

                const patientName = document.getElementById('f_pay_name').value.trim();
                const phone = document.getElementById('f_pay_phone').value.trim();
                const amount = document.getElementById('f_pay_amount').value.trim();
                const serial = document.getElementById('f_pay_serial').value.trim();

                // Patient Name validation
                if (patientName.length < 2) {
                    errors.push('Patient Name must be at least 2 characters long');
                }

                // Phone validation
                if (!phone) {
                    errors.push('Phone Number is required');
                } else if (!validatePhone(phone)) {
                    errors.push('Phone number must be exactly 11 digits');
                }

                // Amount validation
                if (!amount || isNaN(amount)) {
                    errors.push('Amount must be a valid number');
                } else if (parseFloat(amount) <= 0) {
                    errors.push('Amount must be greater than 0');
                }

                // Serial validation
                if (!serial || isNaN(serial)) {
                    errors.push('Reference Serial must be a valid number');
                } else if (parseInt(serial) <= 0) {
                    errors.push('Reference Serial must be a positive number');
                }

                if (!showError('payErrors', errors)) {
                    return false;
                }

                event.target.submit();
                return false;
            }

            // ============= MODAL & TAB FUNCTIONS =============
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

            // ============= SEARCH FUNCTIONS =============
            function searchTable(tableType) {
                let searchInput, searchTerm;
                
                if (tableType === 'users') {
                    searchInput = document.getElementById('usersSearchInput');
                } else if (tableType === 'inventory') {
                    searchInput = document.getElementById('inventorySearchInput');
                } else if (tableType === 'patients') {
                    searchInput = document.getElementById('patientsSearchInput');
                } else if (tableType === 'payments') {
                    searchInput = document.getElementById('paymentsSearchInput');
                }

                searchTerm = searchInput.value.trim();

                if (!searchTerm) {
                    alert('Please enter a search term');
                    return;
                }

                // Send search request to controller
                fetch(`../controller/adminController.php?search_type=${tableType}&search_term=${encodeURIComponent(searchTerm)}`)
                    .then(response => response.json())
                    .then(data => {
                        renderSearchResults(tableType, data);
                    })
                    .catch(error => {
                        console.error('Search error:', error);
                        alert('Error performing search');
                    });
            }

            function renderSearchResults(tableType, data) {
                let tableBody;
                
                if (tableType === 'users') {
                    tableBody = document.querySelector('#users .data-table tbody');
                    tableBody.innerHTML = '';
                    
                    if (data.length === 0) {
                        tableBody.innerHTML = '<tr><td colspan="5" style="text-align: center; color: #999;">No results found</td></tr>';
                        return;
                    }

                    data.forEach(r => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${r.username}</td>
                            <td>${r.full_name}</td>
                            <td>${r.password}</td>
                            <td>${r.role}</td>
                            <td>
                                <button class="btn-edit" onclick='editUser(${JSON.stringify(r)})'>Edit</button>
                                <a href="../controller/adminController.php?type=users&del=${encodeURIComponent(r.username)}" class="btn-del">Delete</a>
                            </td>
                        `;
                        tableBody.appendChild(row);
                    });

                } else if (tableType === 'inventory') {
                    tableBody = document.querySelector('#inventory .data-table tbody');
                    tableBody.innerHTML = '';
                    
                    if (data.length === 0) {
                        tableBody.innerHTML = '<tr><td colspan="6" style="text-align: center; color: #999;">No results found</td></tr>';
                        return;
                    }

                    data.forEach(r => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${r.product_name}</td>
                            <td>${r.quantity}</td>
                            <td>${r.category}</td>
                            <td>${r.expire_date}</td>
                            <td>${r.status}</td>
                            <td>
                                <button class="btn-edit" onclick='editInv(${JSON.stringify(r)})'>Edit</button>
                                <a href="../controller/adminController.php?type=inv&del=${r.id}" class="btn-del">Delete</a>
                            </td>
                        `;
                        tableBody.appendChild(row);
                    });

                } else if (tableType === 'patients') {
                    tableBody = document.querySelector('#patients .data-table tbody');
                    tableBody.innerHTML = '';
                    
                    if (data.length === 0) {
                        tableBody.innerHTML = '<tr><td colspan="5" style="text-align: center; color: #999;">No results found</td></tr>';
                        return;
                    }

                    data.forEach(r => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${r.patient_serial}</td>
                            <td>${r.patient_name}</td>
                            <td>${r.phone_no}</td>
                            <td>${r.record_task_type}</td>
                            <td>
                                <button class="btn-edit" onclick='editPat(${JSON.stringify(r)})'>Edit</button>
                                <a href="../controller/adminController.php?type=pat&del=${r.patient_serial}" class="btn-del">Delete</a>
                            </td>
                        `;
                        tableBody.appendChild(row);
                    });

                } else if (tableType === 'payments') {
                    tableBody = document.querySelector('#payments .data-table tbody');
                    tableBody.innerHTML = '';
                    
                    if (data.length === 0) {
                        tableBody.innerHTML = '<tr><td colspan="6" style="text-align: center; color: #999;">No results found</td></tr>';
                        return;
                    }

                    data.forEach(r => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${r.payment_id}</td>
                            <td>${r.patient_name}</td>
                            <td>${r.phone_no}</td>
                            <td><strong>৳ ${parseFloat(r.amount).toFixed(2)}</strong></td>
                            <td>${r.patient_serial}</td>
                            <td>
                                <button class="btn-edit" onclick='editPay(${JSON.stringify(r)})'>Edit</button>
                                <a href="../controller/adminController.php?type=pay&del=${r.payment_id}" class="btn-del" onclick="return confirm('Delete this payment?')">Delete</a>
                            </td>
                        `;
                        tableBody.appendChild(row);
                    });
                }
            }

            function clearSearch(tableType) {
                // Reload only the current tab's data
                if (tableType === 'users') {
                    document.getElementById('usersSearchInput').value = '';
                    location.hash = '#users';
                    location.reload();
                } else if (tableType === 'inventory') {
                    document.getElementById('inventorySearchInput').value = '';
                    location.hash = '#inventory';
                    location.reload();
                } else if (tableType === 'patients') {
                    document.getElementById('patientsSearchInput').value = '';
                    location.hash = '#patients';
                    location.reload();
                } else if (tableType === 'payments') {
                    document.getElementById('paymentsSearchInput').value = '';
                    location.hash = '#payments';
                    location.reload();
                }
            }

            // USER JS
            function prepareAddUser() {
                document.getElementById('old_username').value = "";
                document.querySelector('#userModal form').reset();
                document.getElementById('userErrors').style.display = 'none';
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
                document.getElementById('userErrors').style.display = 'none';
                openModal('userModal');
            }

            // INVENTORY JS
            function prepareAddInv() {
                document.getElementById('i_id').value = "";
                document.querySelector('#invModal form').reset();
                document.getElementById('invErrors').style.display = 'none';
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
                document.getElementById('invErrors').style.display = 'none';
                openModal('invModal');
            }

            // PATIENT JS
            function prepareAddPat() {
                document.getElementById('p_serial').value = "";
                document.querySelector('#patModal form').reset();
                document.getElementById('patErrors').style.display = 'none';
                openModal('patModal');
            }

            function editPat(data) {
                document.getElementById('p_serial').value = data.patient_serial;
                document.getElementById('p_name').value = data.patient_name;
                document.getElementById('p_phone').value = data.phone_no;
                document.getElementById('p_task').value = data.record_task_type;
                document.getElementById('patErrors').style.display = 'none';
                openModal('patModal');
            }

            function prepareAddPay() {
                document.getElementById('pay_title').innerText = "Record New Payment";
                document.getElementById('f_pay_id').value = "";
                document.querySelector('#payModal form').reset();
                document.getElementById('payErrors').style.display = 'none';
                openModal('payModal');
            }

            function editPay(data) {
                document.getElementById('pay_title').innerText = "Edit Payment Record";
                document.getElementById('f_pay_id').value = data.payment_id;
                document.getElementById('f_pay_name').value = data.patient_name;
                document.getElementById('f_pay_phone').value = data.phone_no;
                document.getElementById('f_pay_amount').value = data.amount;
                document.getElementById('f_pay_serial').value = data.patient_serial;
                document.getElementById('payErrors').style.display = 'none';
                openModal('payModal');
            }
        </script>
</body>

</html>