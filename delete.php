<?php
include 'connect.php';

$id = $_GET['id'];
$conn->query("DELETE FROM accounts WHERE id = $id");
header("Location: view.php");
?>
