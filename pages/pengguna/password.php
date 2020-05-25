<?php
require_once "../../../init.php";

if (isset($_GET['u_password'])) {
    $id = $_GET['u_password'];
    $id_array = array(
        'kd_pengguna'=> $_GET['u_password']
    );
}

if(isset($_POST['action'])){
    if($_POST['password'] == ""){
        echo "<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Password Tidak Boleh Kosong!')
                </SCRIPT>";
    }else{
        $data =array(
            'password'=> md5($_POST['password']) 
        );
        $result = $main->update('tb_pengguna',$data, $id_array);
        
        if($result == TRUE){
            echo "<SCRIPT LANGUAGE='JavaScript'>
                            window.alert('Berhasil memperbarui Password!')
                            window.location.href='index.php';
                    </SCRIPT>";
        }
    }
}
?>

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
            <label for="kd_pengguna">Kode Kriteria</label>
            <input id="kd_pengguna"  type="text" placeholder="Kode Pengguna" name="kd_pengguna" value="<?= $id ?>" readonly>
        </div>

        <div class="control-group">
            <label for="email">Email</label>
            <input id="email" type="email" value="<?= $row->email;?>" readonly>
        </div>

        <div class="control-group">
            <label for="password">Password Baru</label>
            <input id="password" type="text" placeholder="Masukan Password Baru" name="password">
        </div>


        <div class="btn-control">
            <button type="submit" name="action" class="trigger" >Mutahir</button>
        </div>

        <div class="btn-control">
            <button type="reset" onclick="location.href='index.php'" class="trigger" style="background-color: lightgray"><b><</b></button>
        </div>
           
      
</form>
<script src="../../../../public/assets/js/main.js"></script>
<?php endwhile ?>
</div>