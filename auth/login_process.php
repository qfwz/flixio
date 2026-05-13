<?php
session_start();
include __DIR__ . '/../config/connection.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($conn, $query);

$user = mysqli_fetch_assoc($result);

if ($user && password_verify($password, $user['password'])) {
    
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['just_login'] = true;

    header("Location: ../pages/dashboard.php");
    exit;

} else {
    echo "username atau password salah";
}
?>