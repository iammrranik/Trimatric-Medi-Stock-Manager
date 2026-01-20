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
<body>

<div class="sidebar">
    <div class="sidebar-header">
        <h2>TRIMATRIC</h2>
        <span class="role-badge">Moderator Access</span>
    </div>
    <nav>
        <button class="side-btn" onclick="showTab('inventory')">📦 Inventory</button>
        <button class="side-btn" onclick="showTab('patients')">👥 Patients</button>
        <button class="side-btn" onclick="showTab('payments')">💰 Payments</button>
        <hr class="nav-divider">
        <button class="side-btn reload-btn" onclick="window.location.reload();">↻ Refresh</button>
        <a href="../controller/moderatorController.php?action=logout" class="side-btn logout-link">Logout ⏻</a>
    </nav>
</div>
