<?php
require '../config.php';
$email = $_POST['email'];
$password = $_POST['password'];
$nama = $_POST['nama'];
$admin = $_POST['admin'];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

if($admin == "admin123"){
    $sqlsignup = "INSERT INTO kios(nama_kios, email_kios, password_kios) VALUES ('$nama','$email','$hashed_password')";

    $sqlcheckemail = "SELECT email_kios FROM kios WHERE email_kios='$email'";
    $checkemail = mysqli_query($conn, $sqlcheckemail);
    $count = mysqli_num_rows($checkemail);

    if($count === 0){
        $success = true;
        $msg = "Silahkan Login";
        $type = "success";
        mysqli_query($conn, $sqlsignup);
        echo json_encode(array("success" => $success, "msg" => $msg, "type" => $type));
    } else{
        $success = false;
        $msg = "Email Telah Digunakan";
        $type = "warning";
        echo json_encode(array("success" => $success, "msg" => $msg, "type" => $type));
    }
} else{
    $success = false;
    $msg = "Admin Key Tidak Valid";
    $type = "error";
    echo json_encode(array("success" => $success, "msg" => $msg, "type" => $type));
}

