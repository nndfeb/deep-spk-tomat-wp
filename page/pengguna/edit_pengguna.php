<?php
require_once "../../../init.php";

if (isset($_GET['ubah'])) {
    $id = $_GET['ubah'];
    $id_array = array(
        'kd_pengguna'=> $_GET['ubah']
    );
}

if(isset($_POST['action'])){
    if($_POST['nama'] == ""){
        echo "<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Data Nama tidak boleh kosong !!')
            </SCRIPT>";
    }elseif($_POST['email'] == ""){
        echo "<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('email boleh kosong !!')
            </SCRIPT>";
    }else{
        $data =array(
            'kd_pengguna'=> $_POST['kd_pengguna'],
            'nama'=> $_POST['nama'],
            'email'=> $_POST['email'],
            'id_akses'=> $_POST['id_akses']
        );
        // $table_name, $fields, $where_condition
        $result = $c_main->update('tb_pengguna',$data, $id_array);
        
        if($result == TRUE){
            echo "<SCRIPT LANGUAGE='JavaScript'>
                            window.alert('Berhasil memperbarui data')
                            window.location.href='index.php';
                    </SCRIPT>";
        }
    }
}
?>


<title>Ubah Pengguna</title>
<link rel="stylesheet" href="../../../assets/css/style.css">
<style>
    .btn-control{
        display: inline-block;
    }
</style>
<div class="container">
<?php
$no = 1;
$data = $main->tampil('tb_pengguna', 'kd_pengguna', $id);
while ($row = $data->fetch_object()) :
?>

<form class="form" action="" method="post" >
        <div class="control-group">
            <label for="kd_pengguna">Kode pengguna</label>
            <input id="kd_pengguna"  type="text" placeholder="Kode Pengguna" name="kd_pengguna" value="<?= $id ?>" readonly>
        </div>

        <div class="control-group">
            <label for="nama">Nama Pengguna</label>
            <input id="nama"  type="text" placeholder="Nama Pengguna" name="nama" value="<?= $row->nama; ?> ">
        </div>

        <div class="control-group">
            <label for="email">Email Pengguna</label>
            <input id="email"  type="email" placeholder="Email Pengguna" name="email" value="<?= $row->email; ?> ">
        </div>

        <div class="control-group">
            <label for="id_akses">Akses</label>
            <select name="id_akses" id="id_akses">
            <?if($row->id_akses === '1'){
                 echo "<option value='1' selected>Admin</option>";
                 echo "<option value='2'>Pengguna</option>";
                }else if($row->id_akses === '2'){ 
                    echo "<option value='2' selected>Pengguna</option>"; 
                    echo "<option value='1'>Admin</option>";
                    } 
            ?>
            </select>
        </div>

            <input id="password" type="hidden" placeholder="Masukan password" name="password" value="<?= $row->password;?>" >

        
        <div class="btn-control">
            <button type="submit" name="action" class="trigger" > Mutahir</button>
        </div>

        <div class="btn-control">
            <button type="reset" onclick="location.href='index.php'" class="trigger" style="background-color: lightgray"><b><</b></button>
        </div>
</form>
<script src="../../../public/assets/js/main.js"></script>
<?php endwhile ?>
</div>