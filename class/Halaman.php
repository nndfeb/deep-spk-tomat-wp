<?php
error_reporting(0);
class Halaman
{
    public function pages()
    {
        if (is_null($_SESSION['id_akses'])) {
            echo "<script>location.href='../index.php'</script>";
        } ?>
<div class="sidebar">
    <a class="" href="#home"><?= $_SESSION["nama"];
                                        if ($_SESSION['id_akses'] == 1) {
                                            echo ' (admin)';
                                        } else {
                                            echo ' (Petani)';
                                        } ?> </a>

    <?php if ($_SESSION['id_akses'] == 1 || $_SESSION['id_akses'] == 2) : ?>
    <div class="judul-sidebar">
        <p>Kelola Data</p>
    </div>
    <?php if ($_SESSION['id_akses'] == 1) : ?>
    <a href="?page=master-pengguna">Data Pengguna</a>
    <?php endif ?>
    <?php if ($_SESSION['id_akses'] == 2) : ?>
    <a href="">Petani</a>
    <?php endif ?>
    <a href="?page=master-alternatif">Data Alternatif</a>
    <a href="?page=master-kriteria">Data Kriteria</a>
    <a class="" href="?page=penilaian-kriteria">Nilai Kriteria</a>
    <a href="?page=master-keputusan">Keputusan</a>
    <a class="" href="?page=informasi">Informasi</a>
    <a class="" href="?page=profile">Profile</a>
    <a class="" href="?page=tutorial">Tutorial</a>
    <a href="?page=logout">Logout</a>
    <?php
            endif ?>
</div>

<div class="container">
    <nav>
        <img src="../assets/imgs/logo.png" alt="" width="50">
    </nav>
    <?php
            if (!isset($_GET['page'])) {
                include 'beranda.php';
            } else {
                if (file_exists($_GET['page'] . '.php')) {
                    include $_GET['page'] . '.php';
                } else {
                    include 'beranda.php';
                }
            }
            ?>
    <?php require_once '../templates/footer.php' ?>
    <?php
    }
} ?>