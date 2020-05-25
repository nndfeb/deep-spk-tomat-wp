<?php
$kriteria = new Kriteria;

if (isset($_GET['id'])) {

  $id =htmlentities(trim( $_GET['id']));

  $kriteria->hapus_detail_sub_kriteria($id);

}
