<?php
include "connection.php";

$id = intval($_GET['id']);

mysqli_query($conn, "DELETE FROM movies WHERE id = $id");

header("Location: index.php?deleted=1");
?>