<?php
session_start();
include_once '../model/moderatorModel.php';

// Check if the person is actually a Moderator
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Moderator') {
    header("Location: ../view/loginPage.php");
    exit();
}

// 1. LOGOUT
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy();
    header("Location: ../view/loginPage.php");
    exit();
}

// 2. SAVE INVENTORY
if (isset($_POST['save_inv'])) {
    modSaveInventory($_POST['id'], $_POST);
    header("Location: ../view/moderatorPage.php?msg=success");
    exit();
}

// 3. SAVE PATIENT
if (isset($_POST['save_pat'])) {
    modSavePatient($_POST['patient_serial'], $_POST);
    header("Location: ../view/moderatorPage.php?msg=success");
    exit();
}

// 4. SAVE PAYMENT
if (isset($_POST['save_pay'])) {
    modSavePayment($_POST['payment_id'], $_POST);
    header("Location: ../view/moderatorPage.php?msg=success");
    exit();
}

// Default redirect
header("Location: ../view/moderatorPage.php");
exit();
?>
