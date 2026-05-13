<?php
session_start();

include __DIR__ . '/../config/connection.php';

$id = intval($_GET['id']);

if ($_SESSION['role'] !== 'admin') {
    header("Location: ../pages/dashboard.php?error=1");
    exit;
}

mysqli_query($conn, "DELETE FROM movies WHERE id = $id");

header("Location: ../pages/dashboard.php?deleted=1");
?>