<?php
$request = $_SERVER['REQUEST_URI'];
switch ($request) {
    case '/' :
        require 'views/pelanggan/home.php';
        break;
    case '' :
        require 'views/pelanggan/home.php';
        break;
    case '/pesan' :
        require 'views/pelanggan/pesan.php';
        break;
    case '/login' :
        require 'views/pelanggan/login.php';
        break;
    case '/signup' :
        require 'views/pelanggan/signup.php';
        break;
    case '/profile' :
        require 'views/pelanggan/profile.php';
        break;
    case '/riwayat' :
        require 'views/pelanggan/riwayat.php';
        break;
    case '/dashboardkios' :
        require 'views/kios/dashboard.php';
        break;
    case '/loginkios' :
        require 'views/kios/login.php';
        break;
    case '/pesanankios' :
        require 'views/kios/pesanan.php';
        break;
    case '/profilekios' :
        require 'views/kios/profile.php';
        break;
    case '/signupkios' :
        require 'views/kios/signup.php';
        break;
    case '/menukios' :
        require 'views/kios/menu.php';
        break;
    case '/test' :
        require 'process/test.php';
        break;
    default:
        http_response_code(404);
        break;
}
