<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style><?php require 'style/pelanggan/riwayat.css' ?></style>
    <style><?php require 'style/font.css' ?></style>
    <title>Kantinku</title>
</head>
<body>
    <?php require 'components/pelanggan/navbar.php' ?>
    <?php 
    if (!isset($_SESSION['isLoggedIn_pelanggan'])){
      header('Location: /');
    } 
    ?>
    <div class="container py-5 mx-auto">
      <h1 class="text-center">Riwayat Transaksi</h1>
      <div class="overflow-auto card mt-5" style="min-height: 500px;">
        <table class="table m-0 text-center">
          <thead class="table-dark">
            <tr>
              <th class="thead-font" scope="col">No Pesanan</th>
              <th class="thead-font" scope="col">Total Harga</th>
              <th class="thead-font" scope="col">Tanggal</th>
              <th class="thead-font" scope="col">Detail Pesanan</th>
            </tr>
          </thead>
          <tbody>
            <?php
              require 'process/config.php';
              $count = 0;
              $id_pelanggan = $_SESSION['id_pelanggan'];
              $sqlriwayat = "SELECT total_harga, tanggal_pesanan, id_pesanan FROM pesanan WHERE id_pelanggan='$id_pelanggan'";
              $resultriwayat = mysqli_query($conn, $sqlriwayat);
              foreach($resultriwayat as $riwayat){
                $count += 1;
                $id_pesanan = $riwayat['id_pesanan'];
                $sqldetail = "SELECT jumlah, nama_pesanan, harga_pesanan FROM detailpesanan WHERE id_pesanan='$id_pesanan'";
                $resultdetail = mysqli_query($conn, $sqldetail);
            ?>
            <tr>
              <td class="align-middle"><?= $count ?></td>
              <td class="align-middle">Rp<?= $riwayat['total_harga'] ?></td>
              <td class="align-middle"><?= $riwayat['tanggal_pesanan'] ?></td>
              <td class="align-middle">
                <button class="btn btn-primary text-white rounded" data-bs-toggle="modal" data-bs-target="#pesanan-<?= $count ?>">Lihat Detail</button>
                <div class="modal fade" id="pesanan-<?= $count ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Detail Pesanan <?= $count ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <table class="table m-0">
                          <thead class="table-dark">
                            <tr>
                              <th class="thead-font" scope="col">Nama</th>
                              <th class="thead-font" scope="col">Jumlah</th>
                              <th class="thead-font" scope="col">Harga</th>
                              <th class="thead-font" scope="col">Subtotal</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                              foreach($resultdetail as $detail){
                                $subtotal = (int)$detail['harga_pesanan']*(int)$detail['jumlah'];
                            ?>
                            <tr>
                              <td class="align-middle"><?= $detail['nama_pesanan'] ?></td>
                              <td class="align-middle"><?= $detail['jumlah'] ?></td>
                              <td class="align-middle">Rp<?= $detail['harga_pesanan'] ?></td>
                              <td class="align-middle">Rp<?= $subtotal ?></td>
                            </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    <?php require 'components/pelanggan/footer.php' ?>
</body>
</html>