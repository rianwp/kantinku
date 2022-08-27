<?php
session_start();
require '../config.php';
$email = $_POST['email'];
$password = $_POST['password'];

$sqlvalidatelogin = "SELECT id_kios, password_kios FROM kios WHERE email_kios='$email'";

$validatelogin = mysqli_query($conn, $sqlvalidatelogin);
$resultvalidatelogin = mysqli_fetch_assoc($validatelogin);

if(!isset($_SESSION['isLoggedIn_kios'])) {
    if(mysqli_num_rows($validatelogin) === 1){
        if(password_verify($password, $resultvalidatelogin['password_kios'])){
            $_SESSION['isLoggedIn_kios'] = true;
            $_SESSION['id_kios'] = $resultvalidatelogin['id_kios'];
            $loggedIn = true;
            $msg = "Anda Akan Diarahkan Menuju Dashboard";
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