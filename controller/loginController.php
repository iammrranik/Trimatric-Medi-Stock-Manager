<?php
session_start();
include_once '../model/loginModel.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect data from your HTML form fields
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $remember = isset($_POST['remember']); 

    // Validate using your model function
    $userData = validateUser($user, $pass);

    if ($userData) {
        // 1. Set standard Session
        $_SESSION['user'] = $userData['username'];
        $_SESSION['role'] = $userData['role'];

        // 2. Set 30-minute Cookie if "Remember me" was checked
        if ($remember) {
            setcookie("user_login", $userData['username'], time() + 1800, "/");
            setcookie("user_role", $userData['role'], time() + 1800, "/");
        }
