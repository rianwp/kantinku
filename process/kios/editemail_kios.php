<?php
session_start();
require '../config.php';
$id = $_SESSION['id_kios'];
$email = $_POST['email'];
$konfirmasi = $_POST['konfirmasi'];

$sqlvalidateedit = "SELECT password_kios FROM kios WHERE id_kios='$id'";
$validateedit = mysqli_query($conn, $sqlvalidateedit);
$resultvalidateedit = mysqli_fetch_assoc($validateedit);

$sqleditemail = "UPDATE kios SET email_kios='$email' WHERE id_kios='$id'";

if(password_verify($konfirmasi, $resultvalidateedit['password_kios'])){
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