<?php
session_start();
require_once '../../../init.php';
$kd_pengguna = $_SESSION['kd_pengguna'];
$id = $main->get_kode('tb_alternatif', 'kd_alternatif', 'A', 'A1');

if (isset($_POST['action'])) {
    $data = array(
        'kd_alternatif' => $_POST['kd_alternatif'],
        'kd_pengguna' => $_POST['kd_pengguna'],
        'nm_alternatif' => $_POST['nm_alternatif']
    );
    $value1 = $_POST['kd_alternatif'];
    $value2 = $_POST['kd_pengguna'];
    $result = $main->insert2('tb_alternatif', $data, 'kd_alternatif', $value1, 'kd_pengguna', $value2, 'data sudah ada!');
    if ($result === TRUE) {
        echo "<script type='text/javascript'>  window.location='alternatif.php'; </script>";
    }
}


if (@$_GET['hapus']) {
    $kd_alternatif = $_GET['hapus'];
    $main->hapus('tb_alternatif', 'kd_alternatif', $kd_alternatif, 'kd_pengguna', $kd_pengguna);
}
?>
<title>Page Alteriantif</title>
<link rel="stylesheet" href="../../../assets/css/style.css">
<style>
    .kotak-table {
        /* width: 90%; */
        margin-left: 20px;
        margin-right: 20px;

    }
</style>

<body>

    <div class="navbar">
        <div class="container">
            <a href="index.php">Home</a>
            <a class="finish" href="kriteria.php">Kriteria ></a>
            <a class="active" href="alternatif.php">Alternatif ></a>
            <a href="penilaian_kriteria.php">Penilaian ></a>

        </div>
        <img src="#" style="width:200px;height:43px; float:right; padding-right:40px;">
    </div>
    <br>
    <div class="container">
        <div class="kotak-table">
            <div class="form-main">
                <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Tambah</button>
            </div>
            <div id="id01" class="modal">
                <form action="" class="modal-content animate" action="" method="POST">
                    <div class="imgcontainer">
                        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                    </div>
                    <div class="container1">
                        <input type="hidden" name="kd_alternatif" value="<?= $id ?>">
                        <input type="hidden" name="kd_pengguna" value="<?= $kd_pengguna ?>">
                        <input type="text" name="nm_alternatif" placeholder="Nama Alternatif Tomat" required>
                        <button type="submit" name="action">Tambah</button>
                    </div>
                </form>
            </div>
            <table class="main-table">
                <thead>
                    <tr>
                        <th style="width: 10%">Kode</th>
                        <th style="text-align: left">Nama Alternatif</th>
                        <th style="width: 20%">Aksi</th>
                    </tr>
                </thead>
                <?php
                $data = $main->tampil('tb_alternatif', 'kd_pengguna', $kd_pengguna);
                while ($row = $data->fetch_object()) :
                ?>
                    <tbody>
                        <tr>
                            <td><?= $row->kd_alternatif; ?></td>
                            <td style="text-align: left"><?= $row->nm_alternatif; ?></td>
                            <td>
                                <!-- <a href="penilaian_kriteria.php?kd_alternatif=<?= $row->kd_alternatif; ?> "><img src="../../../assets/icons/list-ul.svg" style="width:18px;height:18px; padding-right:5px; padding-left:5px;"></a> -->
                                <a href="edit.php?ubah=<?= $row->kd_alternatif; ?> "><img src="../../../assets/icons/edit.svg" style="width:18px;height:18px; padding-right:5px; padding-left:5px;"></a>
                                <a href="?hapus=<?= $row->kd_alternatif; ?>" onclick="javascript:return confirm('Yakin ingin menghapus data (<?php echo $row->nm_alternatif; ?>) ?')"><img src="../../../assets/icons/trash-alt.svg" style="width:16px;height:16px;padding-left:5px;"></a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
            </table>
        </div>
    </div>
    </div>
</body>
<script src="../../../assets/js/main.js"></script>