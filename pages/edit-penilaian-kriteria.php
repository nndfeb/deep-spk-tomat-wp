<?php
$kriteria = new Kriteria;
$kd_pengguna = $_SESSION['kd_pengguna'];

if (isset($_GET['kd_kriteria'])) {
    $kd = $_GET['kd_kriteria'];
}
echo $kd;
?>