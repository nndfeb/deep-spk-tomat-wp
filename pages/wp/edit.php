<?php
require_once '../../../init.php';
if (@$_GET['ubah']) {
    $id = $_GET['ubah'];
}

$result = $main->tampil('tb_kriteria', 'kd_kriteria', $id);
$data = mysqli_fetch_assoc($result);

// var_dump($data);
// die;


if (isset($_POST['mutakhir'])) {
    $nm_kriteria = $_POST['nm_kriteria'];
    $jenis = $_POST['jenis'];
    $bobot = $_POST['bobot'];

    $field = "nm_kriteria='" . $nm_kriteria . "',jenis='" . $jenis . "' ,bobot=" . $bobot . " ";
    $clause = "kd_kriteria='$id'";
    if ($main->update_form('tb_kriteria', $field, $clause)) {
        echo "<script>
		window.location.href='kriteria.php';
		</script>";
    } else {
        echo " Gagal!!";
    }
}
?>
<link rel="stylesheet" href="../../../assets/css/style.css">

<style>
.box {
    width: 20%;

    padding-top: 10%;
    background-color: lightgray;
    margin: auto;

}
</style>
<div class="container">
    <div class="box">
        <form action="" method="POST">
            <input type="hidden" value="<?= $data['kd_kriteria']; ?>" name="kd_kriteria" required><br>
            <input type="text" value="<?= $data['nm_kriteria']; ?>" name="nm_kriteria" required><br>
            <select name="jenis" id="jenis">
                <?php if ($data['jenis'] == "Benefit") {
                    echo " <option value='Benefit' selected>Benefit</option>";
                    echo " <option value='Cost'>Cost</option>";
                } elseif ($data['jenis'] == "Cost") {
                    echo " <option value='Cost' selected>Cost</option>";
                    echo " <option value='Benefit'>Benefit</option>";
                }
                ?>
            </select>
            <input type="number" value="<?= $data['bobot']; ?>" name="bobot" required><br>
            <button type="submit" name="mutakhir">Mutakhir</button>
        </form>
    </div>
</div>