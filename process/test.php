<?php
require 'config.php';
$timenow = strtotime(date("Y-m-d H:i:s"));
$response = array();

$sqldetail = "SELECT detailpesanan.*, pesanan.tanggal_pesanan as tanggal_pesanan FROM detailpesanan INNER JOIN pesanan ON detailpesanan.id_pesanan = pesanan.id_pesanan WHERE detailpesanan.id_kios='1'";
$resultdetail= mysqli_query($conn, $sqldetail);

foreach($resultdetail as $detail){
    $tanggal_pesanan = strtotime($detail['tanggal_pesanan']);
    if(($timenow - $tanggal_pesanan) <= 3600){
        $id_detailpesanan = $detail['id_detailpesanan'];
        $id_pesanan = $detail['id_pesanan'];
        $nama_pesanan = $detail['nama_pesanan'];
        $harga_pesanan = $detail['harga_pesanan'];
        $jumlah = $detail['jumlah'];
        $keterangan = $detail['keterangan'];

        $sqlpelanggan = "SELECT pesanan.no_meja, pesanan.id_pelanggan, pelanggan.nama_pelanggan FROM pesanan INNER JOIN pelanggan ON pesanan.id_pelanggan=pelanggan.id_pelanggan WHERE pesanan.id_pesanan='$id_pesanan'";
        $resultpelanggan = mysqli_query($conn, $sqlpelanggan);
        while($pelanggan = mysqli_fetch_assoc($resultpelanggan)){
            $no_meja = $pelanggan['no_meja'];
            $id_pelanggan = $pelanggan['id_pelanggan'];
            $nama_pelanggan = $pelanggan['nama_pelanggan'];
        }
        array_push($response,array(
            "id_detailpesanan" => $id_detailpesanan,
            "id_pelanggan" => $id_pelanggan,
            "nama_pelanggan" => $nama_pelanggan,
            "no_meja" => $no_meja,
            "nama_pesanan" => $nama_pesanan,
            "harga_lpesanan" => $harga_pesanan,
            "jumlah" => $jumlah,
            "keterangan" => $keterangan,
        ));
    }
}
echo json_encode($response);



    





