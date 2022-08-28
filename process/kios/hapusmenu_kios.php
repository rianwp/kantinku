<?php
session_start();
require '../config.php';

$id_menu = $_POST['id_menu'];
$sqlhapus = "DELETE FROM menu WHERE id_menu='$id_menu'";
mysqli_query($conn, $sqlhapus);


