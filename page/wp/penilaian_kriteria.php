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
$data_kriteria = $wp->showTable('tb_kriteria', 'kd_pengguna', $kd_pengguna);
$data_alternatif = $wp->showTable('tb_alternatif', 'kd_pengguna', $kd_pengguna);

?>


<title>Penilaian</title>
<!-- <link rel="stylesheet" href="../../assets/css/style.css"> -->
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
            <a class=" btn-tahapan" href="kriteria.php">Kriteria ></a>
            <a class="btn-tahapan" href="alternatif.php">Alternatif ></a>
            <a class="btn-tahapan-active" href="penilaian_kriteria.php">Pembobotan</a>
        </div>
    </div>
</div>

<!-- MAIN -->
<div class="wrapper">
    <div class="main">
        <?php
        foreach ($data_alternatif as $key => $row_alternatif) {


            $data = $main->tampil('tb_alternatif', 'kd_pengguna', $row_alternatif['kd_alternatif']);
            // var_dump($data);
            // die;
            $row = $data->fetch_assoc();

        ?>
            <fieldset>
                <legend> <b> <?php echo  $row_alternatif['nm_alternatif']  ?> </b></legend>
                <form action="exe.php" method="POST">
                    <input type="hidden" name="kd_alternatif" value="<?= $row_alternatif['kd_alternatif'] ?>">
                    <table id="mytable">
                        <th style="padding:1px; width:35px">No</th>
                        <th style="padding:1px; width:280px">Kriteria</th>
                        <th style="padding:1px; width:110px">Penilaian</th>

                        <?php
                        $no = 1;
                        foreach ($data_kriteria as $key => $row_kriteria) {
                            $value = "kd_alternatif='" . $row_alternatif['kd_alternatif'] . "' AND kd_kriteria='" . $row_kriteria['kd_kriteria'] . "' AND kd_pengguna='" . $kd_pengguna . "' ";
                            // echo $value;
                            // die;
                            $data_penilaian = $penilaian->tampilKriteria('tb_penilaian', $value);
                            $row_penilaian = $data_penilaian->fetch_assoc();

                        ?>
                            <input type="hidden" name="kd_kriteria[]" value="<?php echo $row_kriteria['kd_kriteria'] ?>">
                            <tr>
                                <td><?= $no;
                                    $no++; ?></td>
                                <td style="text-align: left"><?= $row_kriteria['nm_kriteria']; ?></td>
                                <td><input type="number" style="margin: 0px;" step="any" name="nilai[]" class="input-kriteria" required="required" value="<?php echo $row_penilaian['nilai'] ?>"></td>
                            </tr>
                        <?php  } ?>
                    </table>
                    <button class="btn-submit" type="submit" name="mutakhir">Simpan
                    </button>
                </form>
            </fieldset>
        <?php } ?>
    </div>
</div>
<script src="../../assets/js/main.js"></script>