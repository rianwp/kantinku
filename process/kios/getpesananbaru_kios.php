<?php
session_start();
if(isset($_SESSION['id_kios'])){
    $id_kios = $_SESSION['id_kios'];
    require '../config.php';
    $timenow = strtotime(date("Y-m-d H:i:s"));
    $response = array();

    $sqldetail = "SELECT detailpesanan.*, pesanan.tanggal_pesanan as tanggal_pesanan FROM detailpesanan INNER JOIN pesanan ON detailpesanan.id_pesanan = pesanan.id_pesanan WHERE detailpesanan.id_kios='$id_kios'";
    $resultdetail= mysqli_query($conn, $sqldetail);
    $sqltotalpesanan = "SELECT SUM(jumlah) as totaljumlah, SUM(jumlah*harga_pesanan) as totalharga FROM detailpesanan WHERE id_kios='$id_kios'";
    $resulttotalpesanan = mysqli_query($conn, $sqltotalpesanan);
    while($total = mysqli_fetch_assoc($resulttotalpesanan)){
        $totaljumlah = $total['totaljumlah'];
        $totalharga = $total['totalharga'];
        if($totaljumlah == ""){
          $totaljumlah = "0";
        }
        if($totalharga == ""){
          $totalharga = "0";
        }
    }
    foreach($resultdetail as $detail){
        $tanggal_pesanan = strtotime($detail['tanggal_pesanan']);
        if(($timenow - $tanggal_pesanan) <= 3600){
            $id_detailpesanan = $detail['id_detailpesanan'];
            $id_pesanan = $detail['id_pesanan'];
            $nama_pesanan = $detail['nama_pesanan'];
            $harga_pesanan = $detail['harga_pesanan'];
            $jumlah = $detail['jumlah'];
            $keterangan = $detail['keterangan'];

            $sqlpelanggan = "SELECT pesanan.no_meja, pelanggan.nama_pelanggan FROM pesanan INNER JOIN pelanggan ON pesanan.id_pelanggan=pelanggan.id_pelanggan WHERE pesanan.id_pesanan='$id_pesanan'";
            $resultpelanggan = mysqli_query($conn, $sqlpelanggan);
            while($pelanggan = mysqli_fetch_assoc($resultpelanggan)){
                $no_meja = $pelanggan['no_meja'];
                $nama_pelanggan = $pelanggan['nama_pelanggan'];
            }
            array_push($response,array(
                "id_detailpesanan" => $id_detailpesanan,
                "nama_pelanggan" => $nama_pelanggan,
                "no_meja" => $no_meja,
                "nama_pesanan" => $nama_pesanan,
                "harga_pesanan" => (int)$harga_pesanan,
                "jumlah" => (int)$jumlah,
                "keterangan" => $keterangan,
                "totaljumlah" => $totaljumlah,
                "totalharga" => $totalharga,
            ));
        }
    }
    echo json_encode($response);
}
