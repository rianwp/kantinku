<?php
session_start();
require '../config.php';
$id = $_SESSION['id_pelanggan'];
$nama = $_POST['nama'];
$konfirmasi = $_POST['konfirmasi'];

$sqlvalidateedit = "SELECT password_pelanggan FROM pelanggan WHERE id_pelanggan='$id'";
$validateedit = mysqli_query($conn, $sqlvalidateedit);
$resultvalidateedit = mysqli_fetch_assoc($validateedit);

$sqleditnama = "UPDATE pelanggan SET nama_pelanggan='$nama' WHERE id_pelanggan='$id'";

if(password_verify($konfirmasi, $resultvalidateedit['password_pelanggan'])){
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