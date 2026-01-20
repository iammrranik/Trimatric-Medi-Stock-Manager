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
   if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        // Plain-text comparison per your request
        if ($password === $row['password']) {
            return $row; 
        }
    }
    return false;
}
?>
