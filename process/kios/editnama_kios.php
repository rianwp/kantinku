<?php
session_start();
require '../config.php';
$id = $_SESSION['id_kios'];
$nama = $_POST['nama'];
$konfirmasi = $_POST['konfirmasi'];

$sqlvalidateedit = "SELECT password_kios FROM kios WHERE id_kios='$id'";
$validateedit = mysqli_query($conn, $sqlvalidateedit);
$resultvalidateedit = mysqli_fetch_assoc($validateedit);

$sqleditnama = "UPDATE kios SET nama_kios='$nama' WHERE id_kios='$id'";

if(password_verify($konfirmasi, $resultvalidateedit['password_kios'])){
    $success = true;
    $msg = "Nama anda sudah terganti";
    $type = "success";
    mysqli_query($conn, $sqleditnama);
    echo json_encode(array("success" => $success, "msg" => $msg, "type" => $type));
} else{
    $success = false;
    $msg = "Password anda salah";
    $type = "error";
    echo json_encode(array("success" => $success, "msg" => $msg, "type" => $type));
}