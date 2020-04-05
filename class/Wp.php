<?php
include_once 'Config.php';
class Wp extends Config
{

    public function __construct()
    {
        parent::__construct();
    }
    public function showTable($table, $where, $value)
    {
        $query = "SELECT * FROM $table WHERE $where='$value'";
        $result = $this->conn->query($query);

        if ($result == FALSE) {
            return FALSE;
        }

        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        return $rows;
    }
    public function showRecord($table, $where, $value)
    {

        $query = "SELECT * FROM WHERE $table $where='$value'";
        $result = $this->conn->query($query);

        if ($result == false) {
            echo 'Error:  ';
            return false;
        } else {
            return $result;
        }
    }

    function pangkat($matriks, $bobot, $tipe)
    {
        // var_dump($matriks, $bobot, $tipe);
        // die;
        foreach ($matriks as $key1 => $val1) {
            foreach ($val1 as $key2 => $val2) {
                $y = $key2;
            }
            $x = $key1;
        }
        $hasil = array();
        for ($a = 0; $a <= $x; $a++) {
            for ($b = 0; $b <= $y; $b++) {
                if ($tipe[$b] == 'benefit') {
                    if ($matriks[$a][$b] != 0) {
                        $hasil[$a][$b] = pow($matriks[$a][$b], $bobot[$b]);
                    } else {
                        $hasil[$a][$b] = 1;
                    }
                } else {
                    if ($matriks[$a][$b] != 0) {
                        $hasil[$a][$b] = pow($matriks[$a][$b], -$bobot[$b]);
                    } else {
                        $hasil[$a][$b] = 1;
                    }
                }
            }
        }
        return $hasil;
    }
    function skor($matriks)
    {
        foreach ($matriks as $key1 => $val1) {
            $skor1 = 1;
            foreach ($val1 as $key2 => $val2) {
                $skor1 = $skor1 * $val1[$key2];
            }
            $skor[] = $skor1;
        }
        return $skor;
    }
    function vektor($array)
    {
        $total = 0;
        foreach ($array as $key => $val) {
            $total = $total + $array[$key];
        }
        foreach ($array as $key2 => $val2) {
            $vektor[] = $array[$key2] / $total;
        }
        return $vektor;
    }
}
