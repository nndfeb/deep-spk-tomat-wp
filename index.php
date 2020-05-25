<?php

// require_once 'page/login.php';
?>

<link rel="stylesheet" href="assets/css/main.css">
<style>
    body {
        color: #181818;
        background: url('assets/imgs/wall1.jpg');
        background-size: cover;
        background-attachment: fixed;
        background-repeat: no-repeat;
        padding: 0;
        margin: 0;
    }

    .content {
        padding: 30px;
        text-align: center;
        background: red;
        width: 560px;
        height: 450px;
        margin: 70px auto;
        position: relative;
        background-color: rgba(255, 255, 255, 0.8);
        border-radius: 10px;
        box-shadow: 0 4px 8px 0 rgba(0, 45, 248, 0.062), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    .content p {
        margin: 0px;
    }
</style>


<?php
require_once 'init.php';

if (isset($_POST['login'])) {
    echo "hallo";
    $email = $_POST['email'];
    $password = $_POST['password'];
    $login->login($email, $password);
}
?>

<body>
    <div class="content">
        <div class="content-text">
            <h3>SISTEM PENDUKUNG KEPUTUSAN</h3>
            <h3>PEMILIHAN BENIH TOMAT</h3>
            <h3><i> MENGGUNAKAN METODE WEIGHTING PRODUCT</i></h3>
            <p>P4S (pelatihan pertanian dan pedesaan) Wira Tani Karawang</p>
            <br>
            <h3>Siti Mariam Solihat</h3>
            <p>Informatika</p>
            <br>
            <h3>SEKOLAH TINGGI MANAJEMEN INFORMATIKA</h3>
            <h3>KHARISMA KARAWANG</h3>
            <h3>TAHUN 2020</h3>
            <br>
            <button class="btn btn-next" onclick="window.location.href = 'login.php';">Lanjut</button>
        </div>
    </div>
</body>