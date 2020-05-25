<?php
$pengguna = new Pengguna;
$kd_pengguna = $pengguna->get_kode('tb_pengguna', 'kd_pengguna', 'P', 'P1');

if (isset($_POST['submit'])) {
    $data = array(
        'kd_pengguna' => trim($_POST['kd_pengguna']),
        'nama' => trim($_POST['nama']),
        'email' => trim($_POST['email']),
        'id_akses' => trim($_POST['id_akses']),
        'password' => md5($_POST['password'])
    );

    $value = $_POST['email'];
    $pengguna->tambah_pengguna($data, $value);
}

?>



<div class="card" style="margin-bottom:5px; background-color: rgb(255, 249, 231);">
    <div class=" card-header">
        <a href=" ?page=master-pengguna">Master Pengguna /</a> <a href="?page=tambah-pengguna">Tambah pengguna</a>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <p>Tambah data Pengguna</p>
    </div>
    <div class="main-form">
        <form action="" method="POST">
            <div class="form-group">
                <label for="kd_pengguna">Kode Pengguna</label>
                <input type="text" class="form-control" name="kd_pengguna" value="<?= $kd_pengguna; ?> " id="nama" readonly>
            </div>
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Lengkap">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="example@mail.com">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Masukan password">
            </div>
            <div class="form-group">
                <label for="id_akses">Hak Akses</label>
                <select name="id_akses" id="id_akses" class="form-control" style="width: 10%">
                    <option value='pilih'>Pilih</option>
                    <option value='1'>Admin</option>
                    <option value='2'>Pengguna</option>
                </select>
            </div>
            <button type="submit" name="submit" class="btn btn-submit">Tambah Psengguna</button>
        </form>
    </div>
</div>