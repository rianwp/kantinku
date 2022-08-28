<?php
session_start();
require '../config.php';
$id_menu = $_POST['id_menu'];

if(isset($_FILES)){
    $allowedext = array('png','jpeg', 'jpg');
    $filename = basename($_FILES['foto']['name']);
    $filesize = $_FILES['foto']['size'];
    $fileext = pathinfo($filename, PATHINFO_EXTENSION);
    $filetmp = $_FILES['foto']['tmp_name'];
    $fileblob = addslashes(file_get_contents($filetmp));
    $sqleditfoto = "UPDATE menu SET foto_menu='$fileblob' WHERE id_menu='$id_menu'";

    if(in_array($fileext,$allowedext) && $filesize < 2000000){
        $success = true;
        $msg = "Foto Menu berhasil diganti";
        $type = "success";
        mysqli_query($conn, $sqleditfoto);
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