<?php
session_start();
require '../config.php';
$id = $_SESSION['id_kios'];
$password = $_POST['password'];
$konfirmasi = $_POST['konfirmasi'];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sqlvalidateedit = "SELECT password_kios FROM kios WHERE id_kios='$id'";
$validateedit = mysqli_query($conn, $sqlvalidateedit);
$resultvalidateedit = mysqli_fetch_assoc($validateedit);

$sqleditpassword = "UPDATE kios SET password_kios='$hashed_password' WHERE id_kios='$id'";

if(password_verify($konfirmasi, $resultvalidateedit['password_kios'])){
    $success = true;
    $msg = "Password anda sudah terganti";
    $type = "success";
    mysqli_query($conn, $sqleditpassword);
    echo json_encode(array("success" => $success, "msg" => $msg, "type" => $type));
} else{
    $success = false;
    $msg = "Password anda salah";
    $type = "error";
    echo json_encode(array("success" => $success, "msg" => $msg, "type" => $type));
}