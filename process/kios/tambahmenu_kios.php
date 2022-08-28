<?php
session_start();
require '../config.php';

$id_kios = $_SESSION['id_kios'];
$nama_menu = $_POST['nama'];
$harga_menu = $_POST['harga'];

if(isset($_FILES)){
    $allowedext = array('png','jpeg', 'jpg');
    $filename = basename($_FILES['foto']['name']);
    $filesize = $_FILES['foto']['size'];
    $fileext = pathinfo($filename, PATHINFO_EXTENSION);
    $filetmp = $_FILES['foto']['tmp_name'];
    $fileblob = addslashes(file_get_contents($filetmp));

    $sqlmenu = "INSERT INTO menu(nama_menu, harga_menu, foto_menu, id_kios) VALUES ('$nama_menu', '$harga_menu', '$fileblob', '$id_kios')";

    if(in_array($fileext,$allowedext) && $filesize < 2000000){
        $success = true;
        $msg = "Foto Menu berhasil diganti";
        $type = "success";
        mysqli_query($conn, $sqlmenu);
        echo json_encode(array("success" => $success, "msg" => $msg, "type" => $type));
    } else{
        $success = false;
        $msg = "File harus berekstensi png, jpg, dan jpg serta berukuran dibawah 2MB";
        $type = "error";
        echo json_encode(array("success" => $success, "msg" => $msg, "type" => $type));
    }
}else{
    $success = false;
    $msg = "Terjadi Kesalahan";
    $type = "error";
    echo json_encode(array("success" => $success, "msg" => $msg, "type" => $type));
}



