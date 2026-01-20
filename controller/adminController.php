<?php
session_start();
include_once '../model/adminModel.php';

// 1. LOGOUT LOGIC
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy();
    setcookie("user_login", "", time() - 3600, "/");
    setcookie("user_role", "", time() - 3600, "/");
    header("Location: ../view/loginPage.php");
    exit();
}

// 2. DELETE LOGIC (All Tables)
if (isset($_GET['del']) && isset($_GET['type'])) {
    $type = $_GET['type'];
    $val = $_GET['del'];

    if ($type == 'users') deleteRecord('users', 'username', $val);
    elseif ($type == 'inv') deleteRecord('inventory', 'id', $val);
    elseif ($type == 'pat') deleteRecord('patients', 'patient_serial', $val);
    elseif ($type == 'pay') deleteRecord('payments', 'payment_id', $val); 

    header("Location: ../view/adminPage.php?msg=deleted");
    exit();
}

// 3. SAVE / UPDATE LOGIC (Routing to Model Functions)

// Process User
if (isset($_POST['save_user'])) {
    saveUser($_POST['old_username'], $_POST);
    header("Location: ../view/adminPage.php?msg=success");
    exit();
}

// Process Inventory
if (isset($_POST['save_inv'])) {
    saveInventory($_POST['id'], $_POST);
    header("Location: ../view/adminPage.php?msg=success");
    exit();
}

// Process Patient
if (isset($_POST['save_pat'])) {
    savePatient($_POST['patient_serial'], $_POST);
    header("Location: ../view/adminPage.php?msg=success");
    exit();
}

// Process Payment (Fixed to use the Model Function)
if (isset($_POST['save_pay'])) {
    // We call the function we added to adminModel.php
    savePayment($_POST['payment_id'], $_POST); 
    header("Location: ../view/adminPage.php?msg=success");
    exit();
}

// Fallback redirect
header("Location: ../view/adminPage.php");
exit();
?>
