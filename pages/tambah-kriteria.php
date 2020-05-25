<?php
$kriteria = new Kriteria;
$kd_pengguna = $_SESSION['kd_pengguna'];
$kd_kriteria = $kriteria->get_id($kd_pengguna);
if (isset($_POST['submit'])) {
    $data = array(
        'kd_kriteria' => trim($_POST['kd_kriteria']),
        'kd_pengguna' => trim($_POST['kd_pengguna']),
        'nm_kriteria' => trim($_POST['nm_kriteria']),
        'jenis' => trim($_POST['jenis']),
        'bobot' => trim($_POST['bobot'])
    );
    $nm_kriteria = $_POST['nm_kriteria'];
    $kriteria->tambah_kriteria($data, $nm_kriteria, $kd_pengguna);
}
?>

<div class="card" style="margin-bottom:5px; background-color: rgb(255, 249, 231);">
    <div class=" card-header">
        <a href=" ?page=master-kriteria">Data Kriteria /</a> <span>Tambah Kriteria</span>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <p>Tambah data Kriteria</p>
    </div>
    <div class="main-form">
        <form action="" method="POST">
            <div class="form-group">
                <label for="kd_pengguna">Kode Pengguna</label>
                <input type="text" class="form-control" name="kd_pengguna" value="<?= $kd_pengguna; ?> " id="nama"
                    readonly>
            </div>
            <div class="form-group">
                <label for="kd_kriteria">Kode Kriteria</label>
                <input type="text" class="form-control" name="kd_kriteria" value="<?= $kd_kriteria; ?> " id="nama"
                    readonly>
            </div>
            <div class="form-group">
                <label for="nm_kriteria">Nama Kriteria</label>
                <input type="text" class="form-control" name="nm_kriteria" id="nm_kriteria" placeholder="Nama Kriteia"
                    autocomplete="off" autofocus>
            </div>
            <div class="form-group">
                <label for="id_akses">Jenis</label>
                <select name="jenis" id="jenis" class="form-control" style="width: 10%">
                    <option value='pilih'>Pilih</option>
                    <option value='Benefit'>Benefit</option>
                    <option value='Cost'>Cost</option>
                </select>
            </div>
            <div class="form-group">
                <label for="bobot">Bobot</label>
                <input type="text" class="form-control" name="bobot" id="bobot" placeholder="Masukan bobot">
            </div>
            <button type="submit" name="submit" class="btn btn-submit">Tambah Kriteria</button>
        </form>
    </div>
</div>