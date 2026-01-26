<?php
include_once 'conModel.php';

// READ: Fetching logic (Moderators can see everything except the Users table)
function fetchTable($table) {
    global $conn;
    $allowed = ['inventory', 'patients', 'payments'];
    if (!in_array($table, $allowed)) return false;
    return mysqli_query($conn, "SELECT * FROM " . mysqli_real_escape_string($conn, $table));
}

// SAVE INVENTORY (Identical to Admin but isolated)
function modSaveInventory($id, $d) {
    global $conn;
    $p = mysqli_real_escape_string($conn, $d['product_name']);
    $pd = mysqli_real_escape_string($conn, $d['purchase_date']);
    $q = (int)$d['quantity'];
    $c = mysqli_real_escape_string($conn, $d['category']);
    $ed = mysqli_real_escape_string($conn, $d['expire_date']);
    $s = mysqli_real_escape_string($conn, $d['status']);

    if (empty($id)) {
        return mysqli_query($conn, "INSERT INTO inventory (product_name, purchase_date, quantity, category, expire_date, status) VALUES ('$p','$pd','$q','$c','$ed','$s')");
    } else {
        return mysqli_query($conn, "UPDATE inventory SET product_name='$p', purchase_date='$pd', quantity='$q', category='$c', expire_date='$ed', status='$s' WHERE id='$id'");
    }
}

// SAVE PATIENT
function modSavePatient($serial, $d) {
    global $conn;
    $n = mysqli_real_escape_string($conn, $d['patient_name']);
    $ph = mysqli_real_escape_string($conn, $d['phone_no']);
    $t = mysqli_real_escape_string($conn, $d['record_task_type']);

    if (empty($serial)) {
        return mysqli_query($conn, "INSERT INTO patients (patient_name, phone_no, record_task_type) VALUES ('$n','$ph','$t')");
    } else {
        return mysqli_query($conn, "UPDATE patients SET patient_name='$n', phone_no='$ph', record_task_type='$t' WHERE patient_serial='$serial'");
    }
}

// SAVE PAYMENT
function modSavePayment($pay_id, $d) {
    global $conn;
    $n = mysqli_real_escape_string($conn, $d['patient_name']);
    $ph = mysqli_real_escape_string($conn, $d['phone_no']);
    $a = mysqli_real_escape_string($conn, $d['amount']);
    $s = mysqli_real_escape_string($conn, $d['patient_serial']);

    if (empty($pay_id)) {
        return mysqli_query($conn, "INSERT INTO payments (patient_name, phone_no, amount, patient_serial) VALUES ('$n','$ph','$a','$s')");
    } else {
        return mysqli_query($conn, "UPDATE payments SET patient_name='$n', phone_no='$ph', amount='$a', patient_serial='$s' WHERE payment_id='$pay_id'");
    }
}
<<<<<<< HEAD
?>
=======
?>
>>>>>>> b8a7c4abd6bc3ad98aa622459974fe6bc508f502
