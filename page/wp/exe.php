<?php
session_start();
require_once '../../init.php';
$kd_pengguna = $_SESSION['kd_pengguna'];
if (!isset($_SESSION['kd_pengguna'])) {
    header('location:../../index.php');
}

$kd_alternatif        = $_POST['kd_alternatif'];
$nilai             = $_POST['nilai'];
$kd_kriteria     = $_POST['kd_kriteria'];

foreach ($kd_kriteria as $key => $value_kd) {
    $clause_cek = "kd_alternatif='" . $kd_alternatif . "' AND kd_kriteria='" . $value_kd . "' ";
    if ($penilaian->checkInput('tb_penilaian', $clause_cek) == FALSE) {
        $fields = "kd_alternatif, kd_kriteria,kd_pengguna,nilai";

        $values = "'" . $kd_alternatif . "','" . $value_kd . "','" . $kd_pengguna . "','" . $nilai[$key] . "' ";

        if ($penilaian->insertTable('tb_penilaian', $fields, $values)) {
            echo "<script>alert('Berhasil Menambahkan Nilai!');window.location.href='penilaian_kriteria.php'</script>";
        } else {
            echo "<script>alert('gagal simpan data');window.location.href='penilaian_kriteria.php'</script>";
        }
    } else {
        $clause_update = "kd_alternatif='" . $kd_alternatif . "' AND kd_kriteria='" . $value_kd . "' ";
        $field_update = "nilai=" . $nilai[$key] . "";
        if ($penilaian->updatePenilaian('tb_penilaian', $field_update, $clause_update)) {
            echo "<script>alert('Berhasil Memperbarui Nilai!');window.location.href='penilaian_kriteria.php'</script>";
        } else {
            echo "<script>alert('gagal simpan data');window.location.href='penilaian_kriteria.php'</script>";
        }
    }
}
