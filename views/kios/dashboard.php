<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style><?php require 'style/kios/dashboard.css' ?></style>
    <style><?php require 'style/font.css' ?></style>
    <title>Dashboard</title>
</head>
<body>
    <?php require 'components/kios/navbar.php' ?>
    <?php require 'components/kios/sidebar.php' ?>
    <?php 
      require 'process/config.php';
      $id_kios = $_SESSION['id_kios'];
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
    ?>
    <main>
      <div class="container-fluid mx-auto p-3">
        <h1 class="fw-bold">Dashboard</h1>
        <div class="row py-3">
          <div class="col-lg-6 col-12">
            <div class="card text-white bg-success mb-3 card-height shadow border-0">
              <div class="card-body">
                <h6 class="card-title">Total Pesanan</h6>
                <div id="totaljumlah" class="card-text fs-4 fw-bold"><?= $totaljumlah ?></div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-12">
            <div class="card text-white bg-primary mb-3 card-height shadow border-0">
              <div class="card-body">
                <h6 class="card-title">Total Pendapatan</h6>
                <div id="totalharga" class="card-text fs-4 fw-bold">Rp<?= $totalharga ?></div>
              </div>
            </div>
          </div>
          <div class="col-12 mt-2">
            <div class="card text-black bg-light mb-3 card-height shadow border-0 overflow-auto">
              <div class="card-header">
                <span><i class="me-2 bi bi-clipboard-fill"></i></span>
                <span class="fw-bold">Pesanan (1 Jam Terakhir)</span>
              </div>
              <div class="card-body p-0">
                <div class="card-text fs-6 fw-bold">
                  <table class="table m-0 text-center">
                    <thead class="table-dark">
                      <tr>
                        <th class="thead-font" scope="col">Pesanan</th>
                        <th class="thead-font" scope="col">Ket</th>
                        <th class="thead-font" scope="col">Jml</th>
                        <th class="thead-font" scope="col">Harga</th>
                        <th class="thead-font" scope="col">Subtotal</th>
                        <th class="thead-font" scope="col">Atas Nama</th>
                        <th class="thead-font" scope="col">No Meja</th>
                      </tr>
                    </thead>
                    <tbody id="tabel-pesanan"></tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <script src="script/kios/dashboard.js"></script>
</body>
</html>