<?php
$alternatif = new Alternatif;

if (isset($_GET['kd_alternatif']) && $_GET['kd_pengguna']) {
  $kd_alternatif =htmlentities(trim( $_GET['kd_alternatif']));
  $kd_pengguna =htmlentities(trim( $_GET['kd_pengguna']));

  $alternatif->hapus_alternatif($kd_alternatif, $kd_pengguna);
}
