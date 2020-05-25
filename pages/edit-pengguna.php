<?php
$pengguna = new Pengguna;


if (isset($_GET['kd_pengguna'])) {
    $kd = $_GET['kd_pengguna'];
}

if (isset($_POST['submit'])) {
    $data = array(
        'kd_pengguna' => trim($_POST['kd_pengguna']),
        'nama' => trim($_POST['nama']),
        'email' => trim($_POST['email']),
        'id_akses' => $_POST['id_akses']
    );

    $kd = array(
        'kd_pengguna' => $_GET['kd_pengguna']
    );


    $result = $pengguna->perbarui_data_pengguna($data, $kd);
    if ($result == FALSE) {
        echo "<script>alert('Gagal merubah data');</script>";
    }
}

?>



<div class="card" style="margin-bottom:5px; background-color: rgb(255, 249, 231);">
    <div class=" card-header">
        <a href=" ?page=master-pengguna">Master Pengguna /</a> <span>Edit Pengguna</span>
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
                    <label for="kd_pengguna" </label> <input type="text" class="form-control" name="kd_pengguna" value="<?= $row['kd_pengguna']; ?>" id="nama" readonly>
                </div>
                <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama" value="<?= $row['nama']; ?>" id="nama" placeholder="Nama Lengkap">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" value="<?= $row['email']; ?>" id="email" placeholder="example@mail.com">
                </div>
                <div class="form-group">
                    <label for="id_akses">Hak Akses</label>
                    <select name="id_akses" id="id_akses" class="form-control" style="width: 10%">
                        <? if ($row['id_akses'] === '1') {
                            echo "<option value='1' selected>Admin</option>";
                            // echo "<option value='2'>Pengguna</option>";
                        } else if ($row['id_akses'] === '2') {
                            echo "<option value='2' selected>Pengguna</option>";
                            // echo "<option value='1'>Admin</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" name="submit" class="btn btn-submit">Edit Psengguna</button>
            </form>
        <?php endwhile ?>
    </div>
</div>