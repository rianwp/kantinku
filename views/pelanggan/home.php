<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style><?php require 'style/pelanggan/home.css' ?></style>
    <style><?php require 'style/font.css' ?></style>
    <title>Kantinku</title>
</head>
<body>
    <?php require 'components/pelanggan/navbar.php' ?>
    <div class="hero-section">
      <h1 class="text-white hero-text text-center">Temukan Berbagai Makanan Disini</h1>
      <div class="text-center mt-4">
        <?php if(isset($_SESSION['isLoggedIn_pelanggan'])){?>
          <a href="/pesan" class="btn btn-success text-white rounded-pill px-4 py-2">
            Pesan Disini
          </a>
        <?php } else{ ?>
          <a role="button" onclick="pesanError()" class="btn btn-success text-white rounded-pill px-4 py-2">
            Pesan Disini
          </a>
        <?php } ?>
      </div>
    </div>
    <div id="menu" class="container py-5 mx-auto">
      <h1 class="text-center my-3">Menu Makanan & Minuman</h1>
      <div id="slider" class="carousel carousel-dark slide" data-bs-ride="true">
        <div class="carousel-inner">
          <?php
            require 'process/config.php';
            $sqlkios = 'SELECT id_kios,nama_kios FROM kios';
            $resultkios = mysqli_query($conn, $sqlkios);
            $count = 0;
            foreach($resultkios as $kios){
              $count += 1;
          ?>
          <div class="carousel-item <?php if($count==1){?> active <?php } ?>">
            <div class="row mt-4 text-center">
              <h3 class="text-center mb-5"><?= $kios['nama_kios'] ?></h3>
              <?php
                $sqlmenu = 'SELECT nama_menu,harga_menu,gambar_menu FROM menu WHERE id_kios='.$kios['id_kios'];
                $resultmenu = mysqli_query($conn, $sqlmenu);
                foreach($resultmenu as $menu){
              ?>
              <div class="col-12 col-md-6 col-lg-4 p-3">
                <img src="data:image/jpeg;base64,<?= base64_encode($menu['gambar_menu']) ?>" class="foto-menu rounded-circle" alt="Foto <?= $menu['nama_menu'] ?>">
                <h4 class="mt-4"><?= $menu['nama_menu'] ?></h4>
                <h6>Rp<?= $menu['harga_menu'] ?></h6>
              </div>
              <?php }?>
            </div>
          </div>
          <?php }?>
        </div>
      </div>
      <div class="text-center mt-5">
        <button class="carousel-nav" type="button" data-bs-target="#slider" data-bs-slide="prev">
          <i class="bi bi-chevron-left"></i>
        </button>
        <button class="carousel-nav" type="button" data-bs-target="#slider" data-bs-slide="next">
          <i class="bi bi-chevron-right"></i>
        </button>
      </div>
    </div>
    <div id="about" class="container py-5 mx-auto">
      <h1 class="text-center my-3">Tentang Kantinku</h1>
      <div class="row mt-4 text-center">
        <div class="col-12 col-lg-8 col-md-10 mx-auto">
          Kantinku adalah sebuah platfrom yang menjadi perantara antara pelanggan kantin dengan penyedia makanan pada kantin. Dengan adanya website Kantinku, pelanggan akan lebih mudah dalam melakukan pemesanan serta penyedia makanan di kantin akan lebih mudah menerima pesanan. Kantinku adalah salah satu bentuk digitalisasi proses pemesanan pada kantin.
        </div>
      </div>
    </div>
    <?php require 'components/pelanggan/footer.php' ?>
</body>
</html>