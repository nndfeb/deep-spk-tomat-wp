<?php
require_once '../../init.php';


//deklarasi array kriteria
$array_kriteria = array();
//deklarasi array bobot kriteria
$array_bobot    = array();
//deklarasi array  type bobot
$array_tipe        = array();


// set bobot (KRITERIA)
$isi_kriteria = $kriteria->showTable();
foreach ($isi_kriteria as $key => $row_kriteria) {
    $array_kriteria[] = $row_kriteria['kd_kriteria'];
    $array_bobot[] = round(($row_kriteria['bobot'] / 100), 2);
    $array_tipe[] = $row_kriteria['jenis'];
}

// var_dump($array_kriteria);
// var_dump($array_bobot);
// var_dump($array_tipe);
// die;

// Set (ALTERNATIF)
$array_alternatif = array();
$isi_alternatif = $alternatif->showTable();

foreach ($isi_alternatif as $key => $row_alternatif) {
    $array_alternatif[] = $row_alternatif['kd_alternatif'];
}
// var_dump($array_alternatif);
// die;

// SET MATRIX ARRAY
$val_penilaian = array();
for ($row = 0; $row < sizeof($array_alternatif); $row++) {

    for ($col = 0; $col < sizeof($array_kriteria); $col++) {
        $clausa = "kd_alternatif ='" . $array_alternatif[$row] . "' AND kd_kriteria='" . $array_kriteria[$col] . "' ";
        // var_dump($clausa);
        // die;
        $isi_value = $penilaian->showRecord($clausa);
        // var_dump($isi_value);
        // die;
        $row_value = $isi_value->fetch_assoc();
        // var_dump($row_value);
        // die;
        $val_penilaian[$row][$col] = $row_value['nilai'];
        // var_dump($value_penilaian);
        // die;
    }
}

// var_dump($val_penilaian);
// die;

if ((sizeof($array_kriteria) == FALSE) or (sizeof($array_alternatif) == FALSE)) { ?>
    <h3>Belum ada data penilaian, silakan isi penilaian terlebih dahulu</h3>
<?php
} else {

    // var_dump($val_penilaian);
    // die;
    $pangkat = $wp->pangkat($val_penilaian, $array_bobot, $array_tipe);
    // var_dump($pangkat);
    // die;
    $hasil = $wp->skor($pangkat);
    // var_dump($hasil);
    // die;

    $vektor = $wp->vektor($hasil);
    // var_dump($vektor);
    // die;
} ?>

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
        background-color: #e5e5e5;
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
    .keluar {
        background-color: red;
        width: 10%;
        margin-left: 290px;
        text-align: center;
        padding: 2px;
        border-radius: 50px;
        color: #fff;
        cursor: pointer;
    }

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

    /* Baru */
    .main .judul {
        display: block;
        padding-top: 50px;
    }

    .wrapper .main .content-judul p {
        color: #181818;
        /* padding: 10px 0 0 0;
        margin: 5px 0 3px 0; */
        padding-top: 10px;
        margin-bottom: 0px;

    }


    .wrapper .main .content-judul {
        /* color: #1683ff; */
    }

    .wrapper .main #mytable th {
        color: #181818;
        background: #e5e5e5;
        text-align: center;
        padding: 5px;


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
        <a class="btn-menu" href="kriteria.php">Kriteria & Alternatif</a>
        <a class="btn-menu" style="background: #00af66; color:white" href="keputusan.php">Keputusan</a>
        <a class="btn-menu" href="#">Pengaturan</a>
        <a class="btn-menu" href="#">Profile</a>
        <a class="btn-menu" href="../logout.php">Logout</a>
    </div>
</div>

<div class="wrapper">
    <div class="main">
        <div class="judul">
            <h4 style="color: #181818;">Tabel Keputusan</h4>
        </div>
    </div>
</div>
<div class="wrapper">
    <div class="main">
        <table id="mytable" style="text-align: center">
            <tr>
                <th>Rangkin</th>
                <th>Kode Alternatif</th>
                <th>Nama Alternatif</th>
                <th>Nilai Vektor</th>
            </tr>
            <?php
            $no = 1;
            foreach ($vektor as $rr => $nilai) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td>
                        <?php $clausa = "kd_alternatif= '" . $array_alternatif[$rr] . "' ";
                        $nm_alternatif = $alternatif->showRecord($clausa);
                        $row_nm_alternatif = $nm_alternatif->fetch_assoc();
                        echo $row_nm_alternatif['kd_alternatif'];
                        ?>
                    </td>
                    <td style="text-align: left"><?= $row_nm_alternatif['nm_alternatif'] ?></td>
                    <td><?php echo round($nilai, 3) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

<div class="wrapper">
    <div class="main">
        <div class="content-judul">
            <p>Detail Perhitungan</p>

        </div>
    </div>
</div>
<div class="wrapper">
    <div class="main">
        <div class="content-judul">
            <p style="color: #181818;margin-bottom:0px;"> 1. Matriks Keputusan</p>
        </div>
        <table id="mytable" style="text-align: center">
            <?php
            $first = TRUE;
            $no = 1;
            foreach ($val_penilaian as $key1 => $val1) {
                if ($first) { ?>
                    <tr>
                        <!-- <td>&nbsp;</td> -->
                        <th style="text-align: center; width:30px;">No</th>
                        <th style="text-align: center">Nama Alternatif</th>
                        <?php
                        foreach ($val1 as $key2 => $value2) {
                            $clausa = "kd_kriteria = '" . $array_kriteria[$key2] . "' ";
                            $nm_kriteria = $kriteria->showRecord($clausa);
                            $row_nama = $nm_kriteria->fetch_assoc();

                        ?>
                            <th><?= $row_nama['nm_kriteria'] ?> </th>
                        <?php } ?>
                    </tr>
                <?php
                    $first = FALSE;
                }
                $clausa = "kd_alternatif='" . $array_alternatif[$key1] . "'";
                $nm_alternatif = $alternatif->showRecord($clausa);
                $row_nm_alternatif = $nm_alternatif->fetch_assoc();
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td style="text-align: left"><?= $row_nm_alternatif['nm_alternatif'] ?></td>
                    <?php
                    foreach ($val1 as $key2 => $value2) {
                        $n = $value2;
                        if ($n == '') {
                            $nn = 0;
                        } else {
                            $nn = $n;
                        }
                    ?>
                        <td><?= $nn ?></td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>

<div class="wrapper">
    <div class="main">
        <div class="content-judul">
            <p style="color: #181818;margin-bottom:0px;"> 2. Skor</p>
        </div>
        <table id="mytable" style="text-align: center">
            <?php
            $first = TRUE;
            $total_skor = 0;
            $no = 1;
            foreach ($pangkat as $key1 => $val1) {
                if ($first) { ?>
                    <tr>
                        <th style="text-align: center; width:30px;">No</th>
                        <th>Nama Alternatif</th>
                        <?php foreach ($val1 as $key2 => $value2) {
                            $clausa = "kd_kriteria='" . $array_kriteria[$key2] . "'";
                            $nm_kriteria = $kriteria->showRecord($clausa);
                            $row_nama = $nm_kriteria->fetch_assoc();
                        ?><th><?= $row_nama['nm_kriteria'] ?></th>
                        <?php } ?>
                        <th>Skor</th>
                    </tr>

                <?php
                    $first = FALSE;
                }
                $clausa = "kd_alternatif= '" . $array_alternatif[$key1] . "' ";
                $nm_alternatif = $alternatif->showRecord($clausa);
                $row_nm_alternatif = $nm_alternatif->fetch_assoc();
                ?>


                <tr>
                    <td><?= $no++ ?></td>
                    <td style="text-align: left"><?= $row_nm_alternatif['nm_alternatif'] ?></td>
                    <?php
                    foreach ($val1 as $key2 => $value2) {
                        $n        = $value2;
                        if ($n == '') {
                            $nn = 0;
                        } else {
                            $nn = $n;
                        }
                    ?>
                        <td><?php echo number_format($nn, 3) ?></td>

                    <?php } ?>
                    <td><?php echo number_format($hasil[$key1], 3) ?></td>
                </tr>
            <?php
                $total_skor = $total_skor + $hasil[$key1];
            }
            ?>
            <td colspan="<?php echo sizeof($array_kriteria)  + 2 ?>"> Total Skor</td>
            <td><?php echo number_format($total_skor, 3) ?></td>
        </table>
    </div>
</div>


<div class="wrapper">
    <div class="main">
        <div class="content-judul">
            <p style="color: #181818;margin-bottom:0px;"> 3. Nilai Bobot</p>
        </div>
        <table id="mytable" style="text-align: center">
            <tr>
                <th style="text-align: center; width:30px;">No</th>
                <th>Alternatip Tomat</th>
                <th>Bobot</th>
            </tr>
            <?php
            $no = 1;
            foreach ($vektor as $rr => $nilai) { ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td style=" text-align: left">
                        <?php $clausa = "kd_alternatif= '" . $array_alternatif[$rr] . "' ";
                        $nm_alternatif = $alternatif->showRecord($clausa);
                        $row_nm_alternatif = $nm_alternatif->fetch_assoc();
                        echo $row_nm_alternatif['nm_alternatif'];
                        ?>
                    </td>
                    <td><?php echo round($nilai, 3) ?></td>
                </tr>

            <?php } ?>
        </table>
    </div>
</div>