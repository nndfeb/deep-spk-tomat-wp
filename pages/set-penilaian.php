<?php
$alternatif = new Alternatif;
$kriteria = new Kriteria;
$keputusan = new Keputusan;

$kd_pengguna = $_SESSION['kd_pengguna'];

if (isset($_GET['kd_pengguna']) && $_GET['kd_alternatif']) {
    $id_kd_alternatif = $_GET['kd_alternatif'];
}

if (isset($_POST['submit'])) {
    $kd_pengguna;
    $c = $_POST['c'];
    $a = $id_kd_alternatif;
    $id_nilai = $_POST['penilaian'];
    $result = $keputusan->pencocokankriteria($kd_pengguna, $c, $a, $id_nilai);
    if ($result == TRUE) {
        echo ('<script LANGUAGE="JavaScript">
            window.alert("Pencocokan Berhasil di masukan");
            window.location.href="index.php?page=master-keputusan";
            </script>');
    } else {
        echo ('<script LANGUAGE="JavaScript">
            window.alert("Pencocokan Gagal di masukan");
            window.location.href="index.php?page=master-keputusan";
            </script>');
    }
}
?>

<div class="card" style="margin-bottom:5px; background-color: rgb(255, 249, 231);">
    <div class=" card-header">
        <a href=" ?page=master-keputusan">Master Keputusan /</a> <span>Set Penilaian</span>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <p>Set Penialain</p>
    </div>
    <div class="main-form">
        <form action="" method="POST">
            <?php $data = $kriteria->semua_kriteria($kd_pengguna);
            while ($row = $data->fetch_assoc()) { ?>
            <div class="form-group">
                <input type="text" name="c[]" value="<?= $row['kd_kriteria'] ?>" hidden>
                <label for="id_akses"><?= $row['kd_kriteria'] ?></label>
                <select name="penilaian[]" id="" class="form-control">
                    <option value="">pilih</option>
                    <?php $data2 = $kriteria->detail_penilaian_kriteria($kd_pengguna, $row['kd_kriteria']);
                        while ($row2 = $data2->fetch_assoc()) { ?>
                    <option value="<?= $row2['id'] ?>"><?= $row2['deskripsi'] ?> (<?= $row2['keterangan']?>) </option>
                    <?php } ?>
                </select>
                <?php } ?>
            </div>
            <button type="submit" name="submit" class="btn btn-submit">Tambah Alternatif</button>
        </form>
    </div>
</div>