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

// 2.5 SEARCH LOGIC
if (isset($_GET['search_type']) && isset($_GET['search_term'])) {
    $search_type = $_GET['search_type'];
    $search_term = $_GET['search_term'];
    
    if ($search_type == 'users') {
        $result = searchUsers($search_term);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    } elseif ($search_type == 'inventory') {
        $result = searchInventory($search_term);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    } elseif ($search_type == 'patients') {
        $result = searchPatients($search_term);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    } elseif ($search_type == 'payments') {
        $result = searchPayments($search_term);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }
}

// 3. SAVE / UPDATE LOGIC (Routing to Model Functions)

// Process User
if (isset($_POST['save_user'])) {
    $result = saveUser($_POST['old_username'], $_POST);
    if ($result) {
        header("Location: ../view/adminPage.php?msg=success");
    } else {
        header("Location: ../view/adminPage.php?msg=error&error=User save failed");
    }
    exit();
}

// Process Inventory
if (isset($_POST['save_inv'])) {
    $result = saveInventory($_POST['id'], $_POST);
    if ($result) {
        header("Location: ../view/adminPage.php?msg=success");
    } else {
        header("Location: ../view/adminPage.php?msg=error&error=Inventory save failed");
    }
    exit();
}

// Process Patient
if (isset($_POST['save_pat'])) {
    $result = savePatient($_POST['patient_serial'], $_POST);
    if ($result) {
        header("Location: ../view/adminPage.php?msg=success");
    } else {
        header("Location: ../view/adminPage.php?msg=error&error=Patient save failed");
    }
    exit();
}

// Process Payment (Fixed to use the Model Function)
if (isset($_POST['save_pay'])) {
    $result = savePayment($_POST['payment_id'], $_POST);
    if ($result) {
        header("Location: ../view/adminPage.php?msg=success");
    } else {
        header("Location: ../view/adminPage.php?msg=error&error=Payment save failed");
    }
    exit();
}

// Fallback redirect
header("Location: ../view/adminPage.php");
exit();
?>