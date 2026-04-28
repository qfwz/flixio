<?php
session_start();
include "connection.php";

?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/account.css">
    <title>Flixio</title>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>


<body>

<header class="header">
    <div class="logo">
        <span class="flix">Flix</span><span class="io">io</span>
    </div>

    <nav class="nav">
        <a href="dashboard.php">Home</a>
        <a href="dashboard.php">Movies</a>
        <a href="dashboard.php">Genre</a>
        <a href="account.php">Account</a>
    </nav>
</header>

<div class="container">
    <h1>Account Details</h1>

    <div class="account-info">
        <p> <?= $_SESSION['username'] ?></p>

    </div>

    <a href="logout.php" class="logout-button">Logout</a>

</div>






</body>
</html>