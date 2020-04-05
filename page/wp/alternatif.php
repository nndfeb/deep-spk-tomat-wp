<?php
session_start();
require_once '../../init.php';
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


if (isset($_POST['mutakhir'])) {

    $kd_alternatif = $_POST['kd_alternatif'];
    $nm_alternatif = $_POST['nm_alternatif'];


    $field = "nm_alternatif='" . $nm_alternatif . "'";
    $clause = "kd_alternatif='$kd_alternatif'";
    if ($main->update_form('tb_alternatif', $field, $clause)) {
        echo "<script>
    	window.location.href='alternatif.php';
    	</script>";
    } else {
        echo " Gagal!!";
    }
}
?>
<title>Page Alteriantif</title>
<link rel="stylesheet" href="../../assets/css/main.css">


<div class="wrapper-header">
    <header>
        <div class="logo">
            <img src="../../assets/imgs/logo.png" alt="">
        </div>
        <div class="content-hudul">
            <h4>SISTEM PENDUKUNG KEPUTUSAN</h3>
                <h4>PEMILIHAN BENIH TOMAT</h3>
                    <h3>MENGGUNAKAN METODE WEIGHTING PRODUCT</h3>
                    <p>P4S (pelatihan pertanian dan pedesaan) Wira Tani Karawang </p>
        </div>
    </header>
</div>
<div class="wrapper">
    <div class="navbar">
        <a class="btn-menu" href="../index.php">Home</a>
        <a class="btn-menu" style="background: #00af66; color:white" href="kriteria.php">Kriteria & Alternatif</a>
        <a class="btn-menu" href="keputusan.php">Keputusan</a>
        <a class="btn-menu" href="#">Pengaturan</a>
        <a class="btn-menu" href="#">Profile</a>
        <a class="btn-menu" href="../logout.php">Logout</a>
    </div>
</div>

<div class="wrapper">
    <div class="main">
        <div class="nav-tahapan">
            <a class="btn-tahapan" href="kriteria.php">Kriteria ></a>
            <a class="btn-tahapan-active" href="alternatif.php">Alternatif ></a>
            <a class="btn-tahapan" href="penilaian_kriteria.php">Pembobotan</a>
        </div>
    </div>
</div>


<?php
if (@$_GET['aksi'] == '') {

?>
    <div class="wrapper">
        <div class="main">
            <button onclick="document.getElementById('id01').style.display='block'" class="btn-submit" style="width:auto;">Tambah</button>
            <fieldset>
                <legend>Tambah Alternatif</legend>
                <div class="main-form">
                    <div id="id01" class="modal">
                        <form action="" class="modal-content animate" action="" method="POST">
                            <div class="keluar" style="margin-left: 430;">
                                <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal" style="margin: 6px;padding: 1px">&times;</span>
                            </div>
                            <div class="container1">
                                <input type="hidden" name="kd_alternatif" value="<?= $id ?>">
                                <input type="hidden" name="kd_pengguna" value="<?= $kd_pengguna ?>">
                                <input type="text" name="nm_alternatif" placeholder="Nama Alternatif Tomat" required>
                                <button type="submit" class="btn-submit" name="action">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>

<?php } else if (@$_GET['aksi'] == 'edit') { ?>
    <!-- FORM EDIT -->
    <div class="wrapper">
        <div class="main">
            <fieldset>
                <legend>Edit Alternatif</legend>

                <?php
                if (@$_GET['aksi'] == 'edit') {
                    $kd = $_GET['kd_alternatif'];
                    $data = $main->tampil('tb_alternatif', 'kd_alternatif', $kd);
                    $row = $data->fetch_assoc();
                ?>
                    <div class="judul-kriteria">
                        <center>
                            <p><?php echo $row['nm_alternatif']; ?></p>
                        </center>

                    </div>
                    <form action="" method="POST">
                        <table class="main-table">
                            <tr>
                                <th style="padding:1px; width:50px">Kode</th>
                                <th style="padding:1px; width:380px">Nama Alternatif</th>
                            </tr>
                            <tr>
                                <td> <input type="text" name="kd_alternatif" value="<?= $row['kd_alternatif']; ?>" id="" style="width: 100%; margin: 0px; padding: 2px" readonly></td>
                                <td> <input type="text" name="nm_alternatif" value="<?= $row['nm_alternatif']; ?>" id="" style="width: 100%; margin: 0px; padding: 2px"></td>
                            </tr>
                        </table>
                        <a href="alternatif.php" class="btn-back">Kembali</a><button class="btn-submit" type="submit" name="mutakhir">Simpan
                        </button>
                    </form>

                <?php } ?>

            </fieldset>
        </div>
    </div>

<?php } ?>
<div class="wrapper">
    <div class="main">
        <table id="mytable">
            <tr>
                <th style="width: 10%">Kode</th>
                <th style="text-align: left">Nama Alternatif</th>
                <th style="width: 20%">Aksi</th>
            </tr>
            <?php
            $data = $main->tampil('tb_alternatif', 'kd_pengguna', $kd_pengguna);
            while ($row = $data->fetch_object()) :
            ?>

                <tr>
                    <td><?= $row->kd_alternatif; ?></td>
                    <td style="text-align: left"><?= $row->nm_alternatif; ?></td>
                    <td>
                        <!-- <a href="penilaian_kriteria.php?kd_alternatif=<?= $row->kd_alternatif; ?> "><img src="../../assets/icons/list-ul.svg" style="width:18px;height:18px; padding-right:5px; padding-left:5px;"></a> -->
                        <a href="?aksi=edit&kd_alternatif=<?= $row->kd_alternatif; ?> "><img src="../../assets/icons/edit.svg" style="width:18px;height:18px; padding-right:5px; padding-left:5px;"></a>
                        <a href="?hapus=<?= $row->kd_alternatif; ?>" onclick="javascript:return confirm('Yakin ingin menghapus data (<?php echo $row->nm_alternatif; ?>) ?')"><img src="../../assets/icons/trash-alt.svg" style="width:16px;height:16px;padding-left:5px;"></a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</div>

<script src="../../assets/js/main.js"></script>