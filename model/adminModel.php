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

?>
