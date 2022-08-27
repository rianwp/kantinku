<?php 
  require 'process/config.php';
  $id_kios = $_SESSION['id_kios'];
  $sqlprofile = "SELECT nama_kios FROM kios WHERE id_kios='$id_kios'";
  $resultprofile = mysqli_query($conn, $sqlprofile);
  while($profile = mysqli_fetch_assoc($resultprofile)){
    $nama = $profile['nama_kios']; 
  }
?>
<div id="sidebar" class="sidebar bg-light text-black shadow-lg">
  <div class="py-3">
    <ul class="navbar-nav">
      <li>
        <div class="text-center mb-4">
          <p class="m-0 text-black">Kios</p>
          <p class="fw-bold"><?= $nama ?></p>
        </div>
      </li>
      <li class="nav-list px-3">
        <a class="nav-link" href="/dashboardkios"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
      </li>
      <li class="nav-list px-3">
        <a class="nav-link" href="/pesanankios"><i class="bi bi-clipboard-fill me-2"></i>Pesanan</a>
      </li>
      <li class="nav-list px-3">
        <a class="nav-link" href="/menukios"><i class="bi bi-table me-2"></i>Edit Menu</a>
      </li>
      <li class="nav-list px-3">
        <a class="nav-link" href="/profilekios"><i class="bi bi-person-fill me-2"></i>Profile</a>
      </li>
      <li class="nav-list px-3">
        <a class="nav-link" role="button" onclick="setLogout()"><i class="bi bi-power me-2"></i>Logout</a>
      </li>
    </ul>
  </div>
</div>
<style><?php require 'style/kios/sidebar.css' ?></style>
<script src="script/kios/logout.js"></script>