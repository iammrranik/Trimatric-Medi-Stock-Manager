<?php
include_once 'conModel.php';

// READ: Generic fetch for any table
function fetchAll($table)
{
    global $conn;
    return mysqli_query($conn, "SELECT * FROM " . mysqli_real_escape_string($conn, $table));
}

// DELETE: Generic delete using specific primary keys
function deleteRecord($table, $column, $value)
{
    global $conn;
    $table = mysqli_real_escape_string($conn, $table);
    $column = mysqli_real_escape_string($conn, $column);
    $value = mysqli_real_escape_string($conn, $value);
    return mysqli_query($conn, "DELETE FROM $table WHERE $column = '$value'");
}

// SAVE USER (8 Columns)
function saveUser($old_user, $d)
{
    global $conn;
    $u = mysqli_real_escape_string($conn, $d['username']);
    $f = mysqli_real_escape_string($conn, $d['full_name']);
    $n = mysqli_real_escape_string($conn, $d['nid']);
    $e = mysqli_real_escape_string($conn, $d['email']);
    $a = mysqli_real_escape_string($conn, $d['address']);
    $p = mysqli_real_escape_string($conn, $d['password']);
    $ph = mysqli_real_escape_string($conn, $d['phone_no']);
    $r = mysqli_real_escape_string($conn, $d['role']);

    if (empty($old_user)) {
        return mysqli_query($conn, "INSERT INTO users VALUES ('$u','$f','$n','$e','$a','$p','$ph','$r')");
    } else {
        return mysqli_query($conn, "UPDATE users SET username='$u', full_name='$f', nid='$n', email='$e', address='$a', password='$p', phone_no='$ph', role='$r' WHERE username='$old_user'");
    }
}

// SAVE INVENTORY (7 Columns)
function saveInventory($id, $d)
{
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

// SAVE PATIENT (4 Columns)
function savePatient($serial, $d)
{
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

// SAVE PAYMENT (NEW - 4 Columns)
function savePayment($pay_id, $d)
{
    global $conn;
    $n = mysqli_real_escape_string($conn, $d['patient_name']);
    $ph = mysqli_real_escape_string($conn, $d['phone_no']);
    $a = mysqli_real_escape_string($conn, $d['amount']);
    $s = mysqli_real_escape_string($conn, $d['patient_serial']);

    if (empty($pay_id)) {
        // Insert new payment record
        return mysqli_query($conn, "INSERT INTO payments (patient_name, phone_no, amount, patient_serial) VALUES ('$n','$ph','$a','$s')");
    } else {
        // Update existing payment record
        return mysqli_query($conn, "UPDATE payments SET patient_name='$n', phone_no='$ph', amount='$a', patient_serial='$s' WHERE payment_id='$pay_id'");
    }
}
