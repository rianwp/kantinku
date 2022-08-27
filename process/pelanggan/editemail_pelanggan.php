<?php
session_start();
require '../config.php';
$id = $_SESSION['id_pelanggan'];
$email = $_POST['email'];
$konfirmasi = $_POST['konfirmasi'];

$sqlvalidateedit = "SELECT password_pelanggan FROM pelanggan WHERE id_pelanggan='$id'";
$validateedit = mysqli_query($conn, $sqlvalidateedit);
$resultvalidateedit = mysqli_fetch_assoc($validateedit);

$sqleditemail = "UPDATE pelanggan SET email_pelanggan='$email' WHERE id_pelanggan='$id'";

if(password_verify($konfirmasi, $resultvalidateedit['password_pelanggan'])){
    $success = true;
    $msg = "Email anda sudah terganti";
    $type = "success";
    mysqli_query($conn, $sqleditemail);
    echo json_encode(array("success" => $success, "msg" => $msg, "type" => $type));
} else{
    $success = false;
    $msg = "Password anda salah";
    $type = "error";
    echo json_encode(array("success" => $success, "msg" => $msg, "type" => $type));
}