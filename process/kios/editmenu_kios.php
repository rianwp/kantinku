<?php
session_start();
require '../config.php';
$id_menu = $_POST['id_menu'];
$nama = $_POST['nama'];
$harga = $_POST['harga'];

$sqleditnama = "UPDATE menu SET nama_menu='$nama' WHERE id_menu='$id_menu'";
$sqleditharga = "UPDATE menu SET harga_menu='$harga' WHERE id_menu='$id_menu'";

if($nama == "" && $harga == ""){
    $success = false;
    $msg = "Nama dan Harga tidak boleh kosong";
    $type = "error";
    echo json_encode(array("success" => $success, "msg" => $msg, "type" => $type));
} else{
    if($nama != "" && $harga == ""){
        $success = true;
        $msg = "Nama berhasil diedit";
        $type = "success";
        mysqli_query($conn, $sqleditnama);
        echo json_encode(array("success" => $success, "msg" => $msg, "type" => $type));
    } else if($nama == "" && $harga != ""){
        $success = true;
        $msg = "Harga berhasil diedit";
        $type = "success";
        mysqli_query($conn, $sqleditharga);
        echo json_encode(array("success" => $success, "msg" => $msg, "type" => $type));
    } else if($nama != "" && $harga != ""){
        $success = true;
        $msg = "Harga dan Nama berhasil diedit";
        $type = "success";
        mysqli_query($conn, $sqleditharga);
        mysqli_query($conn, $sqleditnama);
        echo json_encode(array("success" => $success, "msg" => $msg, "type" => $type));
    }
}