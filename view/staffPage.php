<?php
session_start();
// Security Check: Only allow 'Staff' role
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'Staff') { 
    header("Location: loginPage.php"); 
    exit(); 
}
include_once '../model/moderatorModel.php'; // We use the same fetch logic
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff Portal | Trimatric</title>
    <link rel="stylesheet" href="Design/staffDesign.css">
</head>

</html>