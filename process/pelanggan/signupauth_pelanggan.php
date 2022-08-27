<?php
require '../config.php';
$email = $_POST['email'];
$password = $_POST['password'];
$nama = $_POST['nama'];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sqlsignup = "INSERT INTO pelanggan(nama_pelanggan, email_pelanggan, password_pelanggan) VALUES ('$nama','$email','$hashed_password')";

$sqlcheckemail = "SELECT email_pelanggan FROM pelanggan WHERE email_pelanggan='$email'";
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
    