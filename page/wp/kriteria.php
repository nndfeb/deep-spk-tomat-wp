<?php
session_start();
require_once '../../init.php';
if (!isset($_SESSION['kd_pengguna'])) {
    header('location:../../index.php');
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

if (isset($_POST['mutakhir'])) {

    $kd_kriteria = $_POST['kd_kriteria'];
    $nm_kriteria = $_POST['nm_kriteria'];
    $jenis = $_POST['jenis'];
    $bobot = $_POST['bobot'];

    $field = "nm_kriteria='" . $nm_kriteria . "',jenis='" . $jenis . "' ,bobot=" . $bobot . " ";
    $clause = "kd_kriteria='$kd_kriteria'";
    if ($main->update_form('tb_kriteria', $field, $clause)) {
        echo "<script>
    	window.location.href='kriteria.php';
    	</script>";
    } else {
        echo " Gagal!!";
    }
}

?>
<title>Page Kriteria</title>
<link rel="stylesheet" href="../../assets/css/main.css">
<style>
    .nav-tahapan {
        background-color: #f1f3f7;
        width: 100%;
        height: 30px;
        padding: auto;
        margin-top: 10px;
        display: inline-block;
    }



    .main {
        /* background-color: red; */
        width: 97%;
        margin: auto;
    }

    /* tabel */
    #mytable {
        border-collapse: collapse;
        width: 100%;
        font-size: 10pt;
    }

    #mytable thead,
    #mytable td,
    #mytable th {
        border: 1px solid #ddd;
        padding: 5px;
    }

    #mytable tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #mytable tr:hover {
        background-color: #ddd;
        /* opacity: 0.5;
        color: #181818; */
    }

    #mytable th {
        padding-top: 10px;
        padding-bottom: 10px;
        text-align: left;
        background-color: #dbdbdb;
    }

    /* Form */

    .btn-submit {
        background-color: #167ffc;
        color: #fff;
        border: none;
        margin: 2px;
        padding: 3px 13px;
    }

    .btn-submit button :hover {
        background-color: #595bd4;
        cursor: pointer;
    }


    .content {
        /* background-color: greenyellow; */
        padding: 10px;
        width: 50%;
        margin: auto;
    }

    fieldset {
        width: 50%;
        margin: auto;
        position: relative;
        border: 1px solid #ddd;

    }

    .main-form {
        margin-bottom: 10px;
    }

    input[type=text],
    input[type=password],
    input[type=number],
    input[type=email],
    select {
        width: 100%;
        padding: 3px 3px;
        margin: 1px 0;
        border: 1px solid #ddd;
        font-size: 11pt;
    }
</style>


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
            <a class=" btn-tahapan-active" href=" kriteria.php">Kriteria ></a>
            <a class=" btn-tahapan" href="alternatif.php">Alternatif ></a>
            <a class=" btn-tahapan" href="penilaian_kriteria.php">Pembobotan</a>
        </div>
    </div>
</div>


<?php
if (@$_GET['aksi'] == '') {

?>
    <!-- FORM TAMBAH -->
    <div class="wrapper">
        <div class="main">
            <div class="main-form">
                <button onclick="document.getElementById('id01').style.display='block'" class="btn-submit" style="width:auto;">Tambah</button>
                <div id="id01" class="modal">
                    <fieldset>
                        <legend>Tambah Kriteria Tomat</legend>
                        <form class="modal-content animate" action="" method="POST">
                            <div class="keluar">
                                <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal" $>&times;</span>
                            </div>
                            <div class="content">
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
                                <button type="submit" class="btn-submit" name="action">Tambah</button>
                            </div>
                        </form>
                </div>
                </fieldset>
            </div>
        </div>
    </div>

<?php } else if (@$_GET['aksi'] == 'edit') { ?>
    <!-- FORM EDIT -->

    <div class="wrapper">
        <div class="main">
            <fieldset>
                <legend>Edit Kriteria</legend>
                <?php
                if (@$_GET['aksi'] == 'edit') {
                    $kd = $_GET['kd_kriteria'];
                    $data = $main->tampil('tb_kriteria', 'kd_kriteria', $kd);
                    $row = $data->fetch_assoc();
                ?>
                    <div class="judul-kriteria">
                        <center>
                            <p><?php echo $row['nm_kriteria']; ?></p>
                        </center>
                    </div>
                    <form action="" method="POST">
                        <input type="hidden" name="kd_kriteria" value="<?= $kd ?>" id="">
                        <table class="main-table">
                            <thead>
                                <th style="padding:1px; width:270px">Kriteria</th>
                                <th style="padding:1px; width:100px">Jenis</th>
                                <th style="padding:1px; width:100px">Bobot</th>
                            </thead>
                            <tbody>
                                <td> <input type="text" name="nm_kriteria" value="<?php echo $row['nm_kriteria']; ?>" id="" style="width: 100%; margin: 0px; padding: 2px"></td>
                                <td> <select name="jenis" id="jenis" style="width: 100%; margin: 0px; padding: 2px">
                                        <?php if ($row['jenis'] == 'Benefit') {
                                            echo "<option value='Benefit' selected>Benefit</option>";
                                            echo "<option value='Cost'>Cost</option>";
                                        } elseif ($row['jenis'] == 'Cost') {
                                            echo "<option value='Cost' selected>Cost</option>";
                                            echo "<option value='Benefit'>Benefit</option>";
                                        } ?>

                                    </select>
                                </td>
                                <td> <input type="number" name="bobot" value="<?php echo $row['bobot']; ?>" id="" style="width: 100%; margin: 0px; padding: 2px"></td>
                            </tbody>
                        </table>
                        <a href="kriteria.php" class="btn-back">Kembali</a> <button class="btn-submit" style="border: none" type="submit" name="mutakhir">Simpan
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
                <th style="text-align: left">Kriteria</th>
                <th style="width: 10%">Jenis</th>
                <th style="width: 10%">Bobot</th>
                <th style="width: 20%">Aksi</th>
            </tr>
            <?php
            $data = $main->tampil('tb_kriteria', 'kd_pengguna', $kd_pengguna);
            while ($row = $data->fetch_object()) :
            ?>

                <tr>
                    <td><?= $row->kd_kriteria; ?></td>
                    <td style="text-align: left"><?= $row->nm_kriteria; ?></td>
                    <td><?= $row->jenis; ?></td>
                    <td><?= $row->bobot; ?></td>
                    <td>
                        <a href="?aksi=edit&kd_kriteria=<?= $row->kd_kriteria; ?> "><img src="../../assets/icons/edit.svg" style="width:18px;height:18px; padding-right:5px; padding-left:5px;"></a>
                        <a href="?hapus=<?= $row->kd_kriteria; ?>" onclick="javascript:return confirm('Yakin ingin menghapus data (<?php echo $row->nm_kriteria; ?>) ?')"><img src="../../assets/icons/trash-alt.svg" style="width:16px;height:16px;padding-left:5px;"></a>
                    </td>
                </tr>

            <?php endwhile; ?>
        </table>
    </div>
    </body>
</div>
</div>
<script src="../../assets/js/main.js"></script>