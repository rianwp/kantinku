<?php
session_start();
require '../connect.php';
$email = $_POST['email'];
$password = $_POST['password'];

$sqlvalidatelogin = "SELECT id_pelanggan, password_pelanggan FROM pelanggan WHERE email_pelanggan='$email'";

$validatelogin = mysqli_query($conn, $sqlvalidatelogin);
$resultvalidatelogin = mysqli_fetch_assoc($validatelogin);

if(!isset($_SESSION['isLoggedIn_pelanggan'])) {
    if(mysqli_num_rows($validatelogin) === 1){
        if(password_verify($password, $resultvalidatelogin['password_pelanggan'])){
            $_SESSION['isLoggedIn_pelanggan'] = true;
            $_SESSION['id_pelanggan'] = $resultvalidatelogin['id_pelanggan'];
            $loggedIn = true;
            $msg = "Anda Akan Diarahkan Menuju Halaman Utama";
            $type = "success";
            echo json_encode(array("loggedIn" => $loggedIn, "msg" => $msg, "type" => $type));
        } else{
            $loggedIn = false;
            $msg = "Password Anda Salah";
            $type = "error";
            echo json_encode(array("loggedIn" => $loggedIn, "msg" => $msg, "type" => $type));
        }
    } else{
        $loggedIn = false;
        $msg = "Email Anda Salah";
        $type = "error";
        echo json_encode(array("loggedIn" => $loggedIn, "msg" => $msg, "type" => $type));
    }
} else{
    $loggedIn = false;
    $msg = "Anda Sudah Login";
    $type = "warning";
    echo json_encode(array("loggedIn" => $loggedIn, "msg" => $msg, "type" => $type));
}


