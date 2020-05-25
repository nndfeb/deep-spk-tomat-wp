<?php
session_start();
if (!isset($_SESSION['kd_pengguna'])) {
    header('location:../../index.php');
}
require_once "../../init.php";
$id = $main->get_kode('tb_pengguna', 'kd_pengguna', 'P', 'P01');

// Prosess pengiriman data ke class main method insert()
if (isset($_POST['action'])) {
    $data = array(
        'kd_pengguna' => $_POST['kd_pengguna'],
        'nama' => $_POST['nama'],
        'email' => $_POST['email'],
        'id_akses' => $_POST['id_akses'],
        'password' => md5($_POST['password'])
    );
    $value = $_POST['nama'];
    $a = $main->insert('tb_pengguna', $data, 'nama', $value, 'Kode Kriteria sudah ada');

    if ($a == TRUE) {
        echo "<SCRIPT LANGUAGE='JavaScript'>
                        window.alert('Berhasil memasukan pengguna dengan nama " . $value . "')
                        window.location.href='index.php';
                    </SCRIPT>";
    } else {
        echo "<SCRIPT LANGUAGE='JavaScript'>
                        window.alert('GAGAL memasukan data!!')
                        window.location.href='index.php';
                    </SCRIPT>";
    }
}

//   Button hapus data
if (isset($_GET['hapus'])) {
    $kd_pengguna = $_GET['hapus'];
    $result = $main->hapus('tb_pengguna', 'kd_pengguna', $kd_pengguna);
    if ($result == TRUE) {
        echo "<SCRIPT LANGUAGE='JavaScript'>
                        window.alert('Berhasil menghapus pengguna dengan Kode=(" . $kd_pengguna . ")')
                        window.location.href='index.php';
                    </SCRIPT>";
    } else {
        echo "<SCRIPT LANGUAGE='JavaScript'>
                        window.alert('GAGAL mengapus data!!')
                        window.location.href='index.php';
                    </SCRIPT>";
    }
}
?>
<title>Page Pengguna</title>
<style>
    .kotak-table-2 {
        /* width: 90%; */
        margin-left: 25%;
        margin-right: 25%;
        margin-top: 40px;


    }
</style>
<link rel="stylesheet" href="../../assets/css/style.css">

<div class="navbar">
    <div class="container">
        <a href="../">Home</a>
        <a href="#">Pengguna</a>

    </div>
    <img src="#" style="width:200px;height:43px; float:right; padding-right:40px;">
</div>


<!-- <div class="navbar">
    <a href="../index.php">Beranda</a> / <a href=""> Pengguna </a>
</div> -->
<br>
<div class="container">
    <div class="kotak-table-2">
        <div class="form-main">
            <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Tambah</button>
            <div id="id01" class="modal">
                <form class="modal-content animate" action="" method="POST">
                    <div class="imgcontainer">
                        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                    </div>
                    <div class="container1">
                        <input id="" type="text" name="kd_pengguna" value="<?= $id ?>" readonly>
                        <input id="nama" type="text" placeholder="Nama Lengkap" name="nama" required>
                        <input id="email" type="text" placeholder="Masukan Email" name="email" required>
                        <input id="password" type="password" placeholder="Masukan password" name="password" required>
                        <select name="id_akses" id="id_akses">
                            <option value='pilih'>Pilih</option>
                            <option value='1'>Admin</option>
                            <option value='2'>Pengguna</option>
                        </select>
                        <button type="submit" name="action">Tambah</button>
                    </div>
                </form>
            </div>
        </div>

        <table class="main-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Pengguna</th>
                    <th>Nama Pengguna</th>
                    <th>Username</th>
                    <th>Akses</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php
            $no = 1;
            $data = $main->tampil('tb_pengguna', NULL, NULL);
            while ($row = $data->fetch_object()) :
            ?>
                <tbody>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row->kd_pengguna; ?></td>
                        <td><?= $row->nama; ?></td>
                        <td><?= $row->email; ?></td>
                        <td><?php if ($row->id_akses == '1') {
                                echo "Admin";
                            } else {
                                echo "Pengguna";
                            } ?>
                        </td>
                        <td>
                            <a href="edit_pengguna.php?ubah=<?= $row->kd_pengguna; ?>"><img src="../../assets/icons/edit.svg" style="width:18px;height:18px; padding-right:5px; padding-left:5px;"></a>
                            <a href="password.php?u_password=<?= $row->kd_pengguna; ?>"><img src="../../assets/icons/password.png" style="width:18px;height:18px; padding-right:5px; padding-left:5px;"></a>
                            <a href="block.php?blcok=<?= $row->kd_pengguna; ?>"><img src="../../assets/icons/block.svg" style="width:18px;height:18px; padding-right:5px; padding-left:5px;"></a>
                            <a href="?hapus=<?= $row->kd_pengguna; ?>" onclick="javascript:return confirm('Yakin ingin menghapus data (<?php echo $row->nama ?>) dengan kode (<?php echo $row->kd_pengguna ?>) ?')"><img src="../../assets/icons/trash-alt.svg" style="width:16px;height:16px;padding-left:5px;"></a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
        </table>
    </div>
</div>


<script src="../../assets/js/main.js"></script>