<?php
$kriteria = new Kriteria;
$alternatif = new Alternatif;
$keputusan = new Keputusan;


$kd_pengguna = $_SESSION['kd_pengguna'];

if ($_SESSION['id_akses'] == 1 || $_SESSION['id_akses'] == 2) {

$convert = $keputusan->convert_nilai_w($kd_pengguna);
$data_alternatif = $alternatif->data_alternatif($kd_pengguna);





?>
<style>
.table tr:nth-child(even) {
    background-color: #f2f2f2;
}

.table tr:hover {
    background-color: #f1f3f7;
}


.blokir {
    color: #fff;
    /* color: #212529; */
    margin: 0px;
    color: #fff;
    background-color: #dc3545;
    border-color: #dc3545;
    border-radius: .25rem;
}


.card-1 {
    /* position: relative; */
    display: inline-block;
    /* display: flex; */
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    width: 32.8%;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0, 0, 0, .125);
    border-radius: .25rem;
}

.card-body-1 {
    display: inline-block;
    padding: .75rem 1.25rem;
    margin-bottom: 0;
    background-color: rgba(0, 0, 0, .03);
    border-bottom: 1px solid rgba(0, 0, 0, .125);
}

.main-1 {
    width: 100%;
}

.text-center {
    text-align: center;
}

.output {
    background-color: rgb(255, 179, 0);
}


td a {
    margin: 0 5px;
}

tr th {
    padding: 10px;
}
</style>

<div class="card">
    <div class="card-body" style="padding: 10px;">
        <span><b>Tabel Pencocokan Kriteria</b></span>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <table>
            <thead>
                <tr>
                    <th>Alternatif</th>
                    <?php
                        $result_kriteria = $kriteria->semua_kriteria($kd_pengguna);
                        foreach ($result_kriteria as $key) { ?>
                    <th><?= $key['kd_kriteria'] ?></th>
                    <?php } ?>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $result_alternatif = $alternatif->semua_alternatif($kd_pengguna);
                    foreach ($result_alternatif as $key) {
                        $key['kd_alternatif'];
                    }
                    if ($key == NULL) { ?>
                <tr>
                    <td class="text-center" colspan="<?= 2 + count($result_kriteria)  ?>">Silahkan lengkapi data di
                        halaman <a href="?page=master-alternatif" class=" text-black"><u>Alternatif</u></a>
                    </td>
                </tr>
                <?php }; ?>
                <?php foreach ($result_alternatif as $keys) { ?>
                <tr>
                    <td><?= $keys['kd_alternatif'] ?></td>
                    <?php foreach ($result_kriteria as $key) { ?>
                    <td>
                        <?php $pencocokan = $keputusan->data_pencocokan_kriteria($kd_pengguna, $keys['kd_alternatif'], $key['kd_kriteria']) ?>
                        <?php while ($hasil = $pencocokan->fetch_assoc()) {
                                        echo $hasil['nilai'];
                                    } ?>
                    </td>
                    <?php } ?>
                    <td>
                        <?php $cek_tombol = $keputusan->untuk_tombol($kd_pengguna, $keys['kd_alternatif']); ?>
                        <?php if (mysqli_num_rows($cek_tombol) > 0) { ?>
                        <a
                            href="?page=edit-penilaian&kd_pengguna=<?= $kd_pengguna ?>&kd_alternatif=<?= $keys['kd_alternatif'] ?>">Edit</a>
                        <?php } else { ?>
                        <a
                            href="?page=set-penilaian&kd_pengguna=<?= $kd_pengguna ?>&kd_alternatif=<?= $keys['kd_alternatif'] ?>">SET</a>
                        <?php } ?>
                    </td>
                    <?php } ?>
                </tr>
        </table>
    </div>
</div>

<!-- Pangkat -->
<?php
    $j=0;
    foreach ($result_alternatif as $keys) {
    $s = 1;
    foreach ($result_kriteria as $key) {
        $pangkat = $keputusan->pangkat($kd_pengguna, $key['kd_kriteria']);
        if ($pangkat['jenis'] == 'Cost') {
        $p = -$pangkat['nilai'];
        } else {
        $p = +$pangkat['nilai'];
        }
        $c = $keputusan->data_pencocokan_kriteria_nilai($kd_pengguna, $keys['kd_alternatif'], $key['kd_kriteria']);
        $s *= $c['nilai'] ** $p;
    }
    $j += $s;
}

?>

<?php if($convert==NULL OR $j==0) {?>
<div class="card" style="height: 200px; padding-top: 90px;">
    <div class="card-body">
        <div class="text-center">
            isi tabel di atas
        </div>
    </div>
</div>
<?php }else{?>
<div class="main-1">
    <!-- Niai W -->
    <div class="card-1">
        <div class="card-body" style="padding: 10px;">
            <span><b>Convert W</b></span>
        </div>
        <div class="card-body" style="background-color:rgb(189, 255, 181);">
            <table>
                <thead>
                    <tr>
                        <th>Kriteria</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach ($convert as $key) {?>
                    <tr>
                        <td> <?= $key['kd_kriteria'] ?> </td>
                        <td>
                            <?php 
                                if($key['jenis']=='Benefit'){
                                    // echo number_format(+$key['nilai'],10);
                                    echo +$key['nilai'];
                                }else{
                                    echo '<span style="color: rgb(180, 0, 0);">'.number_format(-$key['nilai'],10).'</span>';
                                }
                            ?>
                        </td>
                    </tr>
                    <?php  }?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Convert V -->
    <div class="card-1">
        <div class="card-body" style="padding: 10px;">
            <span><b>Nilai V</b></span>
        </div>
        <div class="card-body" style="background-color:rgb(168, 250, 159);">
            <table>
                <thead>
                    <tr>
                        <th>Alternatif</th>
                        <th>Nilai V</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 

                    foreach ($result_alternatif as $keys) {?>
                    <tr>
                        <td> <?= $keys['kd_alternatif'] ?> </td>
                        <td>
                            <?php 
                                $s=1;
                                foreach ($result_kriteria as $key) {
                                    $pangkat = $keputusan->pangkat($kd_pengguna, $key['kd_kriteria']);
                                    if ($pangkat['jenis'] == 'Cost') {
                                    $p = -$pangkat['nilai'];
                                    } else {
                                    $p = +$pangkat['nilai'];
                                    }
                                    $c = $keputusan->data_pencocokan_kriteria_nilai($kd_pengguna, $keys['kd_alternatif'], $key['kd_kriteria']);
                                    // $p= 0.090909090909091
                                    // $c=0.8   
                                  
                                    $s *= $c['nilai'] ** $p;
                                }
                                $n[] = $s/$j;
                                $id[]=$keys['kd_alternatif'];
                                echo $s/$j;
                            ?>
                        </td>
                    </tr>
                    <?php  }?>
                    <?php 
                        $i = array_search(max($n), $n);
                        $max = $id[$i];
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Nilai V -->
    <div class="card-1">
        <div class="card-body" style="padding: 10px;">
            <span><b>Nilai S</b></span>
        </div>
        <div class="card-body" style="background-color:rgb(144, 255, 132);">
            <table>
                <thead>
                    <tr>
                        <th>Alternatif</th>
                        <th>Nilai S</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result_alternatif as $keys) {?>
                    <tr>
                        <td> <?= $keys['kd_alternatif'] ?> </td>
                        <td>
                            <?php 
                                $s=1;
                                foreach ($result_kriteria as $key) {
                                    $pangkat = $keputusan->pangkat($kd_pengguna, $key['kd_kriteria']);
                                    if ($pangkat['jenis']=='Cost') {
                                        $p = -$pangkat['nilai'];
                                    }else{
                                        $p = +$pangkat['nilai'];
                                    }
                                    $c=$keputusan->data_pencocokan_kriteria_nilai($kd_pengguna, $keys['kd_alternatif'], $key['kd_kriteria']);
                                    $s *=$c['nilai'] ** $p;
                                }
                                echo number_format($s,10);
                            ?>
                        </td>
                    </tr>
                    <?php  }?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Nilai Keputusan -->
<div class="card">
    <div class="card-body" style="padding: 10px;">
        <span><b>Hasil Keputusan</b></span>
    </div>
</div>
<div class="card">
    <div class="card-body output">
        <?php $hasil =$keputusan->hasil($kd_pengguna, $max)?>
        Hasil perhitungan menggunakan metode WP. Alternatif terbaik adalah <b><?= $hasil['kd_alternatif'] ?></b> yaitu
        <b><?= $hasil['nm_alternatif'] ?></b>
    </div>
</div>

<?php }?>

<!-- Jika Bukan admin atau petani Maka lembar ke halaan utama -->
<?php
} else {
    header('location:../index.php');
}
?>