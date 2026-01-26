<?php
include_once 'conModel.php'; 

function validateUser($username, $password) {
    global $conn; 

    if ($conn === null) {
        die("Database connection is not initialized.");
    }

    $user = $conn->real_escape_string($username);
    
    $sql = "SELECT username, password, role FROM users WHERE username = '$user' LIMIT 1";
    $result = mysqli_query($conn, $sql);
<<<<<<< HEAD
<<<<<<< HEAD
   if ($result && mysqli_num_rows($result) > 0) {
=======

    if ($result && mysqli_num_rows($result) > 0) {
>>>>>>> b8a7c4a (Added search functions and more validations)
=======

    if ($result && mysqli_num_rows($result) > 0) {
>>>>>>> b8a7c4abd6bc3ad98aa622459974fe6bc508f502
        $row = mysqli_fetch_assoc($result);
        
        // Plain-text comparison per your request
        if ($password === $row['password']) {
            return $row; 
        }
    }
    return false;
}
<<<<<<< HEAD
<<<<<<< HEAD
?>
=======
?>
>>>>>>> b8a7c4a (Added search functions and more validations)
=======
?>
>>>>>>> b8a7c4abd6bc3ad98aa622459974fe6bc508f502
