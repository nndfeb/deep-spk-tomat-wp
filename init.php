<?php
spl_autoload_register(function ($class) {
    require_once 'class/' . $class . '.php';
});

$login = new Login();
$main = new Main();
$wp = new Wp();
$kriteria = new Kriteria();
$alternatif = new Alternatif();
$penilaian = new Penilaian();
