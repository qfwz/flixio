<?php
$conn = mysqli_connect("db", "root", "root", "flixio_db");

if (!$conn) {
    die("koneksi gagal: " . mysqli_connect_error());
}
?>