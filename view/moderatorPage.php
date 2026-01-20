<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'Moderator') { 
    header("Location: loginPage.php"); 
    exit(); 
}
include_once '../model/moderatorModel.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Moderator Panel | Trimatric</title>
    <link rel="stylesheet" href="Design/moderatorDesign.css">
</head>

</html>