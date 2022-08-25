<?php
session_start();
require '../connect.php';
$id = $_SESSION['id_pelanggan'];
$password = $_POST['password'];
$konfirmasi = $_POST['konfirmasi'];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sqlvalidateedit = "SELECT password_pelanggan FROM pelanggan WHERE id_pelanggan='$id'";
$validateedit = mysqli_query($conn, $sqlvalidateedit);
$resultvalidateedit = mysqli_fetch_assoc($validateedit);

$sqleditpassword = "UPDATE pelanggan SET password_pelanggan='$hashed_password' WHERE id_pelanggan='$id'";

if(password_verify($konfirmasi, $resultvalidateedit['password_pelanggan'])){
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