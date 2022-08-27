<?php 
session_start(); 
if(!isset($_SESSION['isLoggedIn_kios'])){
  header('Location: /loginkios');
}
?>
<nav class="navbar navbar-expand-lg text-white bg-dark sticky-top">
  <div class="container-fluid">
    <div class="align-items-center d-flex">
      <a role="button" onclick="toggleSidebar()" class="d-inline d-lg-none toggler-size me-2"><i class="bi bi-list"></i></a>
      <div class="navbar-brand">KiosKantinku</div>
    </div>
  </div>
</nav>
<style><?php require 'style/kios/navbar.css' ?></style>
<script src="script/kios/navbar.js"></script>