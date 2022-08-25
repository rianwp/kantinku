<?php
session_start();
require '../connect.php';

$pesanan = json_decode($_POST['pesanan'],true);


if(isset($_SESSION['id_pelanggan'])){
    $no_meja = $pesanan['no_meja'];
    $total_harga = $pesanan['total_harga'];
    $array_detail_pesanan = $pesanan['detail_pesanan'];
    $id_pelanggan = $_SESSION['id_pelanggan'];
    $sqlpesanan = "INSERT INTO pesanan(id_pelanggan, total_harga, no_meja, tanggal_pesanan) VALUES ('$id_pelanggan', '$total_harga', '$no_meja', NOW())";

    mysqli_query($conn, $sqlpesanan);
    $id_pesanan = mysqli_insert_id($conn);

    if(isset($id_pesanan)){
        foreach($array_detail_pesanan as $detail_pesanan){
            $id_kios = $detail_pesanan['id_kios'];
            $nama_pesanan = $detail_pesanan['nama_menu'];
            $harga_pesanan = $detail_pesanan['harga_menu'];
            $jumlah = $detail_pesanan['jumlah'];
            $keterangan = $detail_pesanan['keterangan'];
        
            $sqldetailpesanan = "INSERT INTO detailpesanan(nama_pesanan, harga_pesanan, jumlah, keterangan, id_kios, id_pesanan) VALUES ('$nama_pesanan','$harga_pesanan','$jumlah','$keterangan','$id_kios','$id_pesanan')";
            mysqli_query($conn, $sqldetailpesanan);
        }
    }
}

echo json_encode(array("success" => true, "msg" => "Silahkan Menunggu Pesanan Anda", "type" => "success"));

