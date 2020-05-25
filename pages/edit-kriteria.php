<?php
$kriteria = new Kriteria;
$kd_pengguna = $_SESSION['kd_pengguna'];

if (isset($_GET['kd_kriteria'])) {
    $kd = $_GET['kd_kriteria'];
}

if (isset($_POST['submit'])) {
    $data = array(
        'nm_kriteria' =>htmlentities(trim($_POST['nm_kriteria'])),
        'jenis' => htmlentities(trim($_POST['jenis'])),
        'bobot' => htmlentities(trim($_POST['bobot']))
    );
    
    $clausa = array(
        'kd_pengguna' =>htmlentities(trim($_GET['kd_pengguna'])),
        'kd_kriteria' => htmlentities(trim($_POST['kd_kriteria']))
    );

    $kriteria->perbarui_kriteria($data, $clausa);
}

?>

<div class="card" style="margin-bottom:5px; background-color: rgb(255, 249, 231);">
    <div class=" card-header">
        <a href=" ?page=master-kriteria">Master Kriteria /</a> <span>Edit Kriteria</span>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <p>Edit data Kriteria</p>
    </div>
    <div class="main-form">
        <?php

        $data = $kriteria->edit_kriteria($kd, $kd_pengguna);

        while ($row = $data->fetch_assoc()) :
        ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="kd_pengguna">Kode Pengguna</label>
                <input type="text" class="form-control" name="kd_pengguna" value="<?= $kd_pengguna; ?> " id="nama"
                    readonly>
            </div>
            <div class="form-group">
                <label for="kd_kriteria">Kode Kriteria</label>
                <input type="text" class="form-control" name="kd_kriteria" value="<?= $row['kd_kriteria']; ?>"
                    id="kd_kriteria">
            </div>
            <div class="form-group">
                <label for="nm_kriteria">Nama Kriteria</label>
                <input type="text" class="form-control" name="nm_kriteria" value="<?= $row['nm_kriteria']; ?>"
                    id="nm_kriteria" placeholder="Nama Kriteia">
            </div>
            <div class="form-group">
                <label for="jenis">Jenis</label>
                <select name="jenis" id="jenis" class="form-control" style="width: 10%">
                    <? if ($row['jenis'] === 'Benefit') {
                            echo "<option value='Benefit' selected>Benefit</option>";
                            echo "<option value='Cost'>Cost</option>";
                        } else if ($row['jenis'] === 'Cost') {
                            echo "<option value='Cost' selected>Cost</option>";
                            echo "<option value='Benefit'>Benefit</option>";
                        }
                        ?>
                </select>
            </div>
            <div class="form-group">
                <label for="bobot">Bobot</label>
                <input type="number" class="form-control" name="bobot" value="<?= $row['bobot']; ?>" id="bobot"
                    placeholder="Masukan bobot">
            </div>
            <button type="submit" name="submit" class="btn btn-submit">Edit Kriteria</button>
        </form>
        <?php endwhile ?>
    </div>
</div>