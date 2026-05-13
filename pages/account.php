<?php
session_start();
$pageTitle = "Account - Flixio";
include __DIR__ . '/../config/connection.php';
include __DIR__ . '/../includes/header.php';
?>




<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/account.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>


<body>

<div class="container">
    <h1>Account Details</h1>

    <div class="account-info">
        <p> <?= $_SESSION['username'] ?></p>

    </div>

    <a href="../auth/logout_process.php" class="logout-button">Logout</a>

</div>






</body>
</html>