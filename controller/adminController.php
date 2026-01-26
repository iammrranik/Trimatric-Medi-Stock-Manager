<?php
session_start();
include_once '../model/adminModel.php';

<<<<<<< HEAD
// Helper function to send JSON response
function sendJsonResponse($success, $message = '', $data = null) {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => $success,
        'message' => $message,
        'data' => $data
    ]);
    exit();
}

=======
>>>>>>> b8a7c4abd6bc3ad98aa622459974fe6bc508f502
// 1. LOGOUT LOGIC
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy();
    setcookie("user_login", "", time() - 3600, "/");
    setcookie("user_role", "", time() - 3600, "/");
    header("Location: ../view/loginPage.php");
    exit();
}

<<<<<<< HEAD
// 2. DELETE LOGIC (All Tables) - AJAX VERSION
if (isset($_POST['delete']) && isset($_POST['type']) && isset($_POST['id'])) {
    $type = $_POST['type'];
    $id = $_POST['id'];

    try {
        if ($type == 'users') deleteRecord('users', 'username', $id);
        elseif ($type == 'inv') deleteRecord('inventory', 'id', $id);
        elseif ($type == 'pat') deleteRecord('patients', 'patient_serial', $id);
        elseif ($type == 'pay') deleteRecord('payments', 'payment_id', $id);
        
        sendJsonResponse(true, 'Record deleted successfully');
    } catch (Exception $e) {
        sendJsonResponse(false, $e->getMessage());
    }
}

// 2.1 DELETE LOGIC (All Tables) - REGULAR GET VERSION (for backward compatibility)
=======
// 2. DELETE LOGIC (All Tables)
>>>>>>> b8a7c4abd6bc3ad98aa622459974fe6bc508f502
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
<<<<<<< HEAD
    try {
        $result = saveUser($_POST['old_username'], $_POST);
        if ($result) {
            sendJsonResponse(true, 'User saved successfully');
        } else {
            sendJsonResponse(false, 'User save failed');
        }
    } catch (Exception $e) {
        sendJsonResponse(false, $e->getMessage());
    }
=======
    $result = saveUser($_POST['old_username'], $_POST);
    if ($result) {
        header("Location: ../view/adminPage.php?msg=success");
    } else {
        header("Location: ../view/adminPage.php?msg=error&error=User save failed");
    }
    exit();
>>>>>>> b8a7c4abd6bc3ad98aa622459974fe6bc508f502
}

// Process Inventory
if (isset($_POST['save_inv'])) {
<<<<<<< HEAD
    try {
        $result = saveInventory($_POST['id'], $_POST);
        if ($result) {
            sendJsonResponse(true, 'Item saved successfully');
        } else {
            sendJsonResponse(false, 'Inventory save failed');
        }
    } catch (Exception $e) {
        sendJsonResponse(false, $e->getMessage());
    }
=======
    $result = saveInventory($_POST['id'], $_POST);
    if ($result) {
        header("Location: ../view/adminPage.php?msg=success");
    } else {
        header("Location: ../view/adminPage.php?msg=error&error=Inventory save failed");
    }
    exit();
>>>>>>> b8a7c4abd6bc3ad98aa622459974fe6bc508f502
}

// Process Patient
if (isset($_POST['save_pat'])) {
<<<<<<< HEAD
    try {
        $result = savePatient($_POST['patient_serial'], $_POST);
        if ($result) {
            sendJsonResponse(true, 'Patient saved successfully');
        } else {
            sendJsonResponse(false, 'Patient save failed');
        }
    } catch (Exception $e) {
        sendJsonResponse(false, $e->getMessage());
    }
=======
    $result = savePatient($_POST['patient_serial'], $_POST);
    if ($result) {
        header("Location: ../view/adminPage.php?msg=success");
    } else {
        header("Location: ../view/adminPage.php?msg=error&error=Patient save failed");
    }
    exit();
>>>>>>> b8a7c4abd6bc3ad98aa622459974fe6bc508f502
}

// Process Payment (Fixed to use the Model Function)
if (isset($_POST['save_pay'])) {
<<<<<<< HEAD
    try {
        $result = savePayment($_POST['payment_id'], $_POST);
        if ($result) {
            sendJsonResponse(true, 'Payment saved successfully');
        } else {
            sendJsonResponse(false, 'Payment save failed');
        }
    } catch (Exception $e) {
        sendJsonResponse(false, $e->getMessage());
    }
=======
    $result = savePayment($_POST['payment_id'], $_POST);
    if ($result) {
        header("Location: ../view/adminPage.php?msg=success");
    } else {
        header("Location: ../view/adminPage.php?msg=error&error=Payment save failed");
    }
    exit();
>>>>>>> b8a7c4abd6bc3ad98aa622459974fe6bc508f502
}

// Fallback redirect
header("Location: ../view/adminPage.php");
exit();
?>