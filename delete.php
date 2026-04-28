<?php
include "connection.php";

$id = intval($_GET['id']);

if ($_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php?error=1");
    exit;
}

mysqli_query($conn, "DELETE FROM movies WHERE id = $id");

header("Location: dashboard.php?deleted=1");
?>