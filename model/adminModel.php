<?php
include_once 'conModel.php';

// READ: Generic fetch for any table
function fetchAll($table) {
    global $conn;
    return mysqli_query($conn, "SELECT * FROM " . mysqli_real_escape_string($conn, $table));
}

// DELETE: Generic delete using specific primary keys
function deleteRecord($table, $column, $value) {
    global $conn;
    $table = mysqli_real_escape_string($conn, $table);
    $column = mysqli_real_escape_string($conn, $column);
    $value = mysqli_real_escape_string($conn, $value);
    return mysqli_query($conn, "DELETE FROM $table WHERE $column = '$value'");
}

// SAVE USER (8 Columns)
function saveUser($old_user, $d) {
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



?>
