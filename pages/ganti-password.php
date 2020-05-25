<?php
$pengguna = new Pengguna;


if (isset($_GET['kd_pengguna'])) {
    $kd = $_GET['kd_pengguna'];
}

if (isset($_POST['submit'])) {
    $data = array(
        'kd_pengguna' => trim($_POST['kd_pengguna']),
        'password' => trim(md5($_POST['password']))

    );

    $kd = array(
        'kd_pengguna' => $_GET['kd_pengguna']
    );

    $result = $pengguna->ganti_password($data, $kd);
}

?>

<div class="card" style="margin-bottom:5px; background-color: rgb(255, 249, 231);">
    <div class=" card-header">
        <a href=" ?page=master-pengguna">Master Pengguna /</a> <span>Ubah Password</span>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <p>Edit data Pengguna</p>
    </div>
    <div class="main-form">
        <?php
        $data = $pengguna->edit_pengguna($kd);
        while ($row = $data->fetch_assoc()) :
        ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="kd_pengguna" </label> <input type="hidden" class="form-control" name="kd_pengguna" value="<?= $row['kd_pengguna']; ?>" id="nama" readonly>
                </div>
                <div class="form-group">
                    <label for="password">Password Baru</label>
                    <input type="text" class="form-control" name="password" id="nama" placeholder="Password Baru" autofocus>
                </div>
                <div class="form-group">
                    <label for="password">Password Lama (MD5)</label>
                    <input type="text" class="form-control" value="<?= $row['password']; ?>" id="password" readonly>
                </div>
                <button type="submit" name="submit" class="btn btn-submit">Ganti Password</button>
            </form>
        <?php endwhile ?>
    </div>
</div>