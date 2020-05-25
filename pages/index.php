<?php

session_start();
require_once '../templates/header.php';
require_once '../init.php';


$halaman->pages();

?>
<!-- 

<div class="sidebar">
  <a class="active" href="#home"><?= $_SESSION["nama"];
                                  if ($id == 1) {
                                    echo ' (admin)';
                                  } else {
                                    echo ' (Petani)';
                                  } ?> </a>
  <a href="#">News</a>
  <a href="#contact">Contact</a>
  <a href="#about">About</a>
</div>

<div class="container">
  <nav>
    <img src="../assets/imgs/logo.png" alt="" width="50">
  </nav>




  <div class="card">
    <div class="card-header">
      ini header
    </div>
    <div class="card-body">
      <h5 class="card-title">Special title treatment</h5>

      <h2>Responsive Sidebar Example</h2>
      <a href="#" class="btn btn-submit">Go somewhere</a>
    </div>
  </div>
  <div class="container">

    <?php
    require_once '../templates/footer.php'
    ?>
  </div>
 -->


<!-- <link rel="stylesheet" href="../assets/css/main.css">

<div class="wrapper-header">
  <header>
    <div class="logo">
      <img src="../assets/imgs/logo.png" alt="">
    </div>
    <div class="content-hudul">
      <h4>SISTEM PENDUKUNG KEPUTUSAN</h3>
        <h4>PEMILIHAN BENIH TOMAT</h3>
          <h3>MENGGUNAKAN METODE WEIGHTING PRODUCT</h3>
          <p>P4S (pelatihan pertanian dan pedesaan) Wira Tani Karawang </p>
    </div>

  </header>
</div>
<div class="wrapper">
  <div class="navbar">
    <a class="btn-menu" style="background: #00af66; color:white" href="index.php">Home</a>
    <a class="btn-menu" href="wp/kriteria.php">Kriteria & Alternatif</a>
    <a class="btn-menu" href="wp/keputusan.php">Keputusan</a>
    <a class="btn-menu" href="">Pengaturan</a>
    <a class="btn-menu" href="#">Profile</a>
    <a class="btn-menu" href="../logout.php">Logout</a>
  </div>
</div>

<div class="wrapper">
  <div class="content-img">
    <img src="../assets/imgs/page-awal.jpg" alt="">
  </div>
</div> -->