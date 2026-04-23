<?php
$conn = mysqli_connect("localhost", "root", "", "flixio_db");

if (!$conn) {
    die("koneksi gagal: " . mysqli_connect_error());
}
?>