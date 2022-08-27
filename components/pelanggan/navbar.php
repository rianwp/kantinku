<?php session_start(); ?>
<nav class="navbar navbar-expand-lg navbar-light shadow-lg sticky-top">
  <div class="container">
    <a class="navbar-brand" href="/">Kantinku</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link" href="/#about">About Us</a>
        <a class="nav-link" href="/#menu">Menu</a>
        <?php if(isset($_SESSION['isLoggedIn_pelanggan'])){?>
          <a class="nav-link" href="/pesan">Pesan</a>
        <?php } else{ ?>
          <a class="nav-link" role="button" onclick="pesanError()">Pesan</a>
        <?php } ?>
      </div>
      <div class="navbar-nav">
        <?php if(isset($_SESSION['isLoggedIn_pelanggan'])){
          require 'process/config.php';
          $id_pelanggan = $_SESSION['id_pelanggan'];
          $sqlprofile = "SELECT nama_pelanggan, foto_pelanggan FROM pelanggan WHERE id_pelanggan='$id_pelanggan'";
          $resultprofile= mysqli_query($conn, $sqlprofile);
          while($profile = mysqli_fetch_assoc($resultprofile)){
            $nama = $profile['nama_pelanggan'];
            $foto = $profile['foto_pelanggan'];
          }
        ?>
          <a role="button" onclick="setLogout()" class="btn btn-outline-success text-success rounded-pill px-4 mx-lg-1 my-lg-0 my-1">Logout</a>
          <button class="dropdown d-inline-block border-0 bg-transparent p-0">
            <a role="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false" class="btn btn-outline-success text-success rounded-pill px-3 mx-lg-1 my-lg-0 my-1 w-100"><i class="bi bi-person-fill"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
              <li class="text-center px-1">
                <?php if($foto == ""){ ?>
                  <img src="../assets/user.png" class="rounded-circle foto-profile">
                <?php } else{ ?>
                  <img src="data:image/jpeg;base64,<?= base64_encode($foto) ?>" class="rounded-circle foto-profile">
                <?php } ?>
              </li>
              <li class="text-center pt-2 ket-nama text-muted">Pelanggan</li>
              <li class="text-center pb-2 px-1 border-bottom border-1 font-nama"><?= $nama ?></li>
              <li class="mt-2"><a class="dropdown-item" href="/profile">Profile</a></li>
              <li><a class="dropdown-item" href="/riwayat">Riwayat</a></li>
            </ul>
          </button>
        <?php } else{ ?>
          <a href="/login" class="btn btn-outline-success text-success rounded-pill px-4 mx-lg-1 my-lg-0 my-1">Login</a>
          <a href="/signup" class="btn btn-outline-success text-success rounded-pill px-4 mx-lg-1 my-lg-0 my-1">Sign Up</a>
        <?php } ?>
      </div>
    </div>
  </div>
</nav>
<script src="script/pelanggan/logout.js"></script>
<style><?php require 'style/pelanggan/navbar.css' ?></style>