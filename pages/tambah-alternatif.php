<?php
$alternatif = new Alternatif;
$kd_pengguna = $_SESSION['kd_pengguna'];


$kd_alternatif = $alternatif->get_id($kd_pengguna);


if (isset($_POST['submit'])) {
    $data = array(
        'kd_alternatif' => htmlentities(trim($_POST['kd_alternatif'])),
        'kd_pengguna' => htmlentities(trim($_POST['kd_pengguna'])),
        'nm_alternatif' => htmlentities(trim($_POST['nm_alternatif']))
    );
    $value = $_POST['nm_alternatif'];

    $alternatif->tambah_alternatif($data, $value, $kd_pengguna);

 
}

?>



<div class="card" style="margin-bottom:5px; background-color: rgb(255, 249, 231);">
    <div class=" card-header">
        <a href=" ?page=master-alternatif">Data Alternatif /</a> <span>Tambah Alternatif</span>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <p>Tambah data Alternatif</p>
    </div>
    <div class="main-form">
        <form action="" method="POST">
            <div class="form-group">
                <label for="kd_pengguna">Kode Pengguna</label>
                <input type="text" class="form-control" name="kd_pengguna" value="<?= $kd_pengguna; ?> " id="nama" readonly>
            </div>
            <div class="form-group">
                <label for="kd_alternatif">Kode alternatif</label>
                <input type="text" class="form-control" name="kd_alternatif" value="<?= $kd_alternatif; ?> " id="nama" readonly>
            </div>
            <div class="form-group">
                <label for="nm_alternatif">Nama alternatif</label>
                <input type="text" class="form-control" name="nm_alternatif" id="nm_alternatif" placeholder="Nama Alternatif" autocomplete="off" autofocus>
            </div>
            <button type="submit" name="submit" class="btn btn-submit">Tambah Alternatif</button>
        </form>
    </div>
</div>