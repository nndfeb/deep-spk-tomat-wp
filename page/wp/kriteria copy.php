<?php
session_start();
require_once '../../../init.php';
if (!isset($_SESSION['kd_pengguna'])) {
    header('location:../../../index.php');
}
$kd_pengguna = $_SESSION['kd_pengguna'];

$id = $main->get_kode('tb_kriteria', 'kd_kriteria', 'C', 'C01');

if (isset($_POST['action'])) {
    $data = array(
        'kd_kriteria' => $_POST['kd_kriteria'],
        'kd_pengguna' => $_POST['kd_pengguna'],
        'nm_kriteria' => $_POST['nm_kriteria'],
        'jenis' => $_POST['jenis'],
        'bobot' => $_POST['bobot']
    );
    $value1 = $_POST['nm_kriteria'];
    $value2 = $_POST['kd_pengguna'];
    $result1 = $main->insert2('tb_kriteria', $data, 'nm_kriteria', $value1, 'kd_pengguna', $value2, 'data yang anda masukan sudah ada!', 'Berhasil memasukan kriteria baru');
    if ($result1 === TRUE) {
        echo "<script type='text/javascript'>  window.location='kriteria.php'; </script>";
    }
}

if (@$_GET['hapus']) {
    $kd_kriteria = $_GET['hapus'];
    $main->hapus('tb_kriteria', 'kd_kriteria', $kd_kriteria, 'kd_pengguna', $kd_pengguna);
}

?>
<title>Page Kriteria</title>
<link rel="stylesheet" href="../../../assets/css/style.css">
<style>
    .kotak-table {
        /* width: 90%; */
        margin-left: 20px;
        margin-right: 20px;

    }
</style>

<div class="navbar">
    <div class="container">
        <a href="index.php">Home</a>
        <a class="active" href="kriteria.php">Kriteria</a>
        <a href="alternatif.php">Alternatif ></a>
    </div>
    <img src="#" style="width:200px;height:43px; float:right; padding-right:40px;">
</div>
<br>
<div class="container">
    <div class="kotak-table">
        <div class="form-main">
            <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Tambah</button>
            <div id="id01" class="modal">
                <form class="modal-content animate" action="" method="POST">
                    <div class="imgcontainer">
                        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                    </div>
                    <div class="container1">
                        <!-- <label><b>Nama Kriteria</b></label> -->
                        <input type="hidden" name="kd_kriteria" value="<?= $id ?>">
                        <input type="hidden" name="kd_pengguna" value="<?= $kd_pengguna ?>">
                        <input type="text" placeholder="Nama Kriteria" name="nm_kriteria" required>
                        <!-- <label><b>Bobot</b></label> -->
                        <input type="number" placeholder="Masukan Bobot" name="bobot" required>
                        <!-- <label><b>Jenis</b></label>   -->
                        <select name="jenis" id="jenis">
                            <option value='pilih'>Pilih</option>
                            <option value='Benefit'>Benefit</option>
                            <option value='Cost'>Cost</option>
                        </select>
                        <button type="submit" name="action">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
        <table class="main-table">
            <thead>
                <tr>
                    <th style="width: 10%">Kode</th>
                    <th style="text-align: left">Kriteria</th>
                    <th style="width: 10%">Jenis</th>
                    <th style="width: 10%">Bobot</th>
                    <th style="width: 20%">Aksi</th>
                </tr>
            </thead>
            <?php
            $data = $main->tampil('tb_kriteria', 'kd_pengguna', $kd_pengguna);
            while ($row = $data->fetch_object()) :
            ?>
                <tbody>
                    <tr>
                        <td><?= $row->kd_kriteria; ?></td>
                        <td style="text-align: left"><?= $row->nm_kriteria; ?></td>
                        <td><?= $row->jenis; ?></td>
                        <td><?= $row->bobot; ?></td>
                        <td>
                            <a href="edit.php?ubah=<?= $row->kd_kriteria; ?> "><img src="../../../assets/icons/edit.svg" style="width:18px;height:18px; padding-right:5px; padding-left:5px;"></a>
                            <a href="?hapus=<?= $row->kd_kriteria; ?>" onclick="javascript:return confirm('Yakin ingin menghapus data (<?php echo $row->nm_kriteria; ?>) ?')"><img src="../../../assets/icons/trash-alt.svg" style="width:16px;height:16px;padding-left:5px;"></a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
        </table>
    </div>
</div>
<script src="../../../assets/js/main.js"></script>