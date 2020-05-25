<?php
$kriteria = new Kriteria;
$kd_pengguna = $_SESSION['kd_pengguna'];


$kd_kriteria = $kriteria->get_id($kd_pengguna);
if(isset($_GET['kd_kriteria']) &&  $_GET['nm_kriteria'] ){
 $kd_kriteria=  $_GET['kd_kriteria'];
 $nm_kriteria=  $_GET['nm_kriteria'];
}

if (isset($_POST['submit'])) {
    $data = array(
        'kd_pengguna' => trim($_POST['kd_pengguna']),
        'kriteria' => trim($_POST['kriteria']),
        'deskripsi' => trim($_POST['deskripsi']),
        'keterangan' => trim($_POST['keterangan']),
        'nilai' => trim($_POST['nilai'])
    );


    // $nm_kriteria = $_POST['nm_kriteria'];
    $kriteria->tambah_sub_kriteria($data);


}

?>

<div class="card" style="margin-bottom:5px; background-color: rgb(255, 249, 231);">
    <div class=" card-header">
        <a href=" ?page=penilaian-kriteria">Nilai Kriteria /</a> <span>Tambah Kriteria Detail
            (<?= $kd_kriteria ?>)</span>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <p>Tambah Kriteria <?= $nm_kriteria?> (<?= $kd_kriteria?>)</p>
    </div>
    <div class="main-form">
        <form action="" method="POST">
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <input type="hidden" class="form-control" name="kd_pengguna" value="<?= $kd_pengguna; ?> " id="">
                <input type="hidden" class="form-control" name="kriteria" value="<?= $kd_kriteria; ?> " id="">
                <input type="text" class="form-control" name="deskripsi" id="deskripsi">
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <input type="text" class="form-control" name="keterangan" id="keterangan">
            </div>
            <div class="form-group">
                <label for="nilai">Nilai</label>
                <input type="text" class="form-control" name="nilai" id="nilai">
            </div>

            <button type="submit" name="submit" class="btn btn-submit">Tambah Kriteria</button>
        </form>
    </div>
</div>