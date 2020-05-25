<?php
$pengguna = new Pengguna;
$kd_pengguna = $_SESSION['kd_pengguna'];

if ($_SESSION['id_akses'] == 1) {
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
            <a href="?page=tambah-pengguna" class="btn btn-submit">Tambah</a>
            <a href="?page=#" class="btn btn-submit">Cari</a>
        </div>
    </div>
    <div class="card">
        <table style="text-align: center;" class="table">
            <tr>
                <th>No</th>
                <th>Kode Pengguna</th>
                <th>Nama Pengguna</th>
                <th>Username</th>
                <th>Akses</th>
                <th>Aksi</th>
            </tr>
            <?php
            $no = 1;
            $data = $pengguna->semua_pengguna();
            while ($row = $data->fetch_assoc()) :
            ?>
                <tr>
                    <td><?= $no++; ?> </td>
                    <td> <?= $row['kd_pengguna']; ?> </td>
                    <td> <?= $row['nama']; ?> </td>
                    <td> <?= $row['email']; ?> </td>
                    <td> <?php if ($row['id_akses'] == '1') {
                                echo '<i class=" fas fa-user-plus"></i> Admin';
                            } else if ($row['id_akses'] == '2') {
                                echo '<i class=" fas fa-user"></i> Pengguna';
                            } else {
                                echo '<i class=" fas fa-lock"></i> Pengguna';
                            } ?> </td>
                    <td>
                        <a href="?page=edit-pengguna&kd_pengguna=<?= $row['kd_pengguna'] ?>"> <i class=" fas fa-edit"></i></a>|
                        <a href="?page=ganti-password&kd_pengguna=<?= $row['kd_pengguna'] ?>"> <i class=" fas fa-key"></i></a>|
                        <a href="?page=hapus-pengguna&kd_pengguna=<?= $row['kd_pengguna'] ?>" onclick=" javascript:return confirm('Yakin akan menghaspus data ?')"> <i class=" fas fa-trash"></i></a>|
                        <a href="?page=block-pengguna&kd_pengguna=<?= $row['kd_pengguna'] ?>" onclick=" javascript:return confirm('Yakin ingin memblokir ?')"> <i class=" fas fa-lock"></i></a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>


    <!-- Jika Bukan admin Maka lembar ke halaan utama -->
<?php
} else {
    header('location:../index.php');
}
?>
