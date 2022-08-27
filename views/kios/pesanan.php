<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style><?php require 'style/kios/pesanan.css' ?></style>
    <style><?php require 'style/font.css' ?></style>
    <title>Pesanan</title>
</head>
<body>
    <?php require 'components/kios/navbar.php' ?>
    <?php require 'components/kios/sidebar.php' ?>
    <main>
        <div class="container-fluid mx-auto p-3">
          <h1 class="fw-bold">Pesanan</h1>
          <div class="row py-3">
            <div class="col-12">
              <div class="card text-black bg-light mb-3 card-height shadow border-0 overflow-auto">
                <table class="table m-0 text-center">
                  <thead class="table-dark">
                    <tr>
                      <th class="thead-font" scope="col">No</th>
                      <th class="thead-font" scope="col">Nama Pesanan</th>
                      <th class="thead-font" scope="col">Jml</th>
                      <th class="thead-font" scope="col">Harga</th>
                      <th class="thead-font" scope="col">Subtotal</th>
                      <th class="thead-font" scope="col">Dipesan Oleh</th>
                      <th class="thead-font" scope="col">Tanggal</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      require 'process/config.php';
                      $count = 0;
                      $id_kios = $_SESSION['id_kios'];
                      $sqlriwayat = "SELECT detailpesanan.*, pesanan.tanggal_pesanan as tanggal_pesanan FROM detailpesanan INNER JOIN pesanan ON detailpesanan.id_pesanan = pesanan.id_pesanan WHERE detailpesanan.id_kios='$id_kios'";;
                      $resultriwayat = mysqli_query($conn, $sqlriwayat);
                      foreach($resultriwayat as $riwayat){
                        $id_pesanan = $riwayat['id_pesanan'];
                        $sqlpelanggan = "SELECT pesanan.no_meja, pelanggan.nama_pelanggan FROM pesanan INNER JOIN pelanggan ON pesanan.id_pelanggan=pelanggan.id_pelanggan WHERE pesanan.id_pesanan='$id_pesanan'";
                        $resultpelanggan = mysqli_query($conn, $sqlpelanggan);
                        while($pelanggan = mysqli_fetch_assoc($resultpelanggan)){
                          $no_meja = $pelanggan['no_meja'];
                          $nama_pelanggan = $pelanggan['nama_pelanggan'];
                        }
                        $count += 1;
                    ?>
                    <tr>
                      <td class="align-middle"><?= $count ?></td>
                      <td class="align-middle"><?= $riwayat['nama_pesanan'] ?></td>
                      <td class="align-middle"><?= $riwayat['jumlah'] ?></td>
                      <td class="align-middle">Rp<?= $riwayat['harga_pesanan'] ?></td>
                      <td class="align-middle">Rp<?= (int)$riwayat['jumlah']*(int)$riwayat['harga_pesanan'] ?></td>
                      <td class="align-middle"><?= $nama_pelanggan ?>, Meja <?= $no_meja ?></td>
                      <td class="align-middle"><?= $riwayat['tanggal_pesanan'] ?></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
    </main>
</body>
</html>