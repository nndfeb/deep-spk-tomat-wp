<?php
$pengguna = new Pengguna;

if (isset($_GET['kd_pengguna'])) {
    $kd = $_GET['kd_pengguna'];

    $pengguna->hapus_pengguna($kd);
}
