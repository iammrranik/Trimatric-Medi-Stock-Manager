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
