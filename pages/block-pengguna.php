<?php
$pengguna = new Pengguna;

if (isset($_GET['kd_pengguna'])) {
    $kd = $_GET['kd_pengguna'];
    $pengguna->block_pengguna($kd);
}