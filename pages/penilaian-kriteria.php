<?php
$kriteria = new Kriteria;
$kd_pengguna = $_SESSION['kd_pengguna'];

if ($_SESSION['id_akses'] == 1 || $_SESSION['id_akses']==2) {

?>
<style>
.card-content {
    padding: 12px 20px;
}

.kriteria {

    font-size: 12pt;
    margin-left: 10px;
    font-weight: 500;
}
</style>

<?php 
            $data = $kriteria->semua_kriteria($kd_pengguna);
     
            while ($row = $data->fetch_assoc()) :
    ?>
<div class="card">
    <div class="card-header">
        <a href="?page=tambah-penilaian-kriteria&kd_kriteria=<?= $row['kd_kriteria'] ?>&nm_kriteria=<?= $row['nm_kriteria'] ?>"
            class="btn btn-submit">Nilai Kriteria</a> <span class="kriteria"><?= $row['nm_kriteria'] ?>
            (<?= $row['kd_kriteria']?>)</span>
    </div>
    <div class="card-content">
        <table style="text-align: center;" class="table" width=100%>
            <tr>
                <th style="text-align: left;" width=40%>Deskripsi</th>
                <th width=30%>Keterangan</th>
                <th width=10%>Nilai</th>
                <th width=20%>Aksi</th>
            </tr>
            <?php 
          $detail = $kriteria->detail_sub_kriteria($kd_pengguna, $row['kd_kriteria'] );

          while ($row2 = $detail->fetch_assoc()) :
        ?>
            <tr>
                <td style="text-align: left;"><?= $row2['deskripsi'] ?></td>
                <td><?= $row2['keterangan'] ?></td>
                <td><?= $row2['nilai'] ?></td>
                <td>
                    <a href="?page=edit-penilaian-kriteria=<?= $row2['kriteria'] ?>"> <i class=" fas fa-edit"></i></a>|
                    <a href="?page=hapus-penilaian-kriteria&id=<?= $row2['id'] ?>"
                        onclick=" javascript:return confirm('Yakin akan menghaspus data ?')"> <i
                            class=" fas fa-trash"></i></a>
                </td>
            </tr>
            <?php endwhile ?>
        </table>
    </div>
</div>
<?php endwhile ?>

<!-- Jika Bukan admin Maka lembar ke halaan utama -->
<?php
} else {

    // echo "gagal";
    header('location:../index.php');
}
?>