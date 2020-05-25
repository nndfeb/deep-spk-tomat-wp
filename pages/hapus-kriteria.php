<?php
$kriteria = new Kriteria;

if (isset($_GET['kd_kriteria']) && $_GET['kd_pengguna']) {
  $kd_kriteria = htmlentities(trim($_GET['kd_kriteria']));
  $kd_pengguna = htmlentities(trim($_GET['kd_pengguna']));
  $kriteria->hapus_kriteria($kd_kriteria, $kd_pengguna);
}