<?php
$alternatif = new Alternatif;
$kd_pengguna = $_SESSION['kd_pengguna'];




if ($_SESSION['id_akses'] == 1 || $_SESSION['id_akses'] == 2) {

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

td a {
    margin: 0 5px;
}

tr th {
    padding: 10px;
}
</style>

<div class="card">
    <div class="card-body" style="padding: 10px;">
        <a href="?page=tambah-alternatif" class="btn btn-submit">Tambah Alternatif Tomat</a>
        <a href="?page=#" class="btn btn-submit">Cari</a>
    </div>

</div>
<div class="card">
    <table style="text-align: center;" class="table">
        <tr>
            <th>ID</th>
            <th>Nama Alternatif</th>
            <th>Aksi</th>
        </tr>

        <?php
            $data = $alternatif->semua_alternatif($kd_pengguna);
            while ($row = $data->fetch_assoc()) :
            ?>
        <tr>
            <td> <?= $row['kd_alternatif']; ?> </td>
            <td> <?= $row['nm_alternatif']; ?> </td>
            <td>
                <a
                    href="?page=edit-alternatif&kd_alternatif=<?= $row['kd_alternatif'] ?>&kd_pengguna=<?= $kd_pengguna ?>">
                    <i class=" fas fa-edit"></i></a>|
                <a href="?page=hapus-alternatif&kd_alternatif=<?= $row['kd_alternatif'] ?>&kd_pengguna=<?= $row['kd_pengguna'] ?>"
                    onclick=" javascript:return confirm('Yakin akan menghaspus data ?')"> <i
                        class=" fas fa-trash"></i></a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>


<!-- Jika Bukan admin Maka lembar ke halaan utama -->
<?php
} else {

    // echo "gagal";
    header('location:../index.php');
}
?>