<?php
include_once 'Config.php';
class Keputusan extends Config
{

    private $_table = "tb_pencocokan_kriteria";

    public function __construct()
    {
        parent::__construct();
    }

    public function data_pencocokan_kriteria($kd_pengguna, $a, $c)
    {
        $query = "SELECT * FROM $this->_table JOIN tb_sub_kriteria 
                                                WHERE $this->_table.id_nilai=tb_sub_kriteria.id 
                                                AND $this->_table.kd_pengguna='$kd_pengguna' 
                                                AND tb_sub_kriteria.kd_pengguna='$kd_pengguna' 
                                                AND a='$a' 
                                                AND c='$c'";
        $result = $this->conn->query($query);
        return $result;
    }
    public function data_pencocokan_kriteria_nilai($kd_pengguna, $a, $c)
    {
        $query = "SELECT * FROM $this->_table JOIN tb_sub_kriteria 
                                                WHERE $this->_table.id_nilai=tb_sub_kriteria.id 
                                                AND $this->_table.kd_pengguna='$kd_pengguna' 
                                                AND tb_sub_kriteria.kd_pengguna='$kd_pengguna' 
                                                AND a='$a' 
                                                AND c='$c'";
        $result = $this->conn->query($query)->fetch_assoc();
        return $result;
    }

    public function untuk_tombol($kd_pengguna, $kd_alternatif)
	{
		$query ="SELECT * FROM $this->_table WHERE kd_pengguna='$kd_pengguna' AND a='$kd_alternatif'";
        $result = $this->conn->query($query);
        return $result;
    }
    
    public function tampil_set_penilaian($kd_pengguna, $kd_kriteria)
    {

      	$query ="SELECT * FROM tb_sub_kriteria WHERE kd_pengguna='$kd_pengguna' AND kd_kriteria='$kd_kriteria'";
        $result = $this->conn->query($query);
        return $result;
    }

    public function pencocokankriteria($kd_pengguna,$c,$a,$id_nilai)
    {   
        $i =0;
        foreach ($id_nilai as $key) {
            $query = "INSERT INTO $this->_table values ('$kd_pengguna','$c[$i]','$a','$key')";
            $i++;
            $result = mysqli_query($this->conn, $query);
        }
        
        if ($result == TRUE) {
            echo ('<script LANGUAGE="JavaScript">
                window.alert("Pencocokan Berhasil di masukan");
                window.location.href="index.php?page=master-keputusan";
                </script>');
        } else {
            echo ('<script LANGUAGE="JavaScript">
                window.alert("Pencocokan Gagal di masukan");
                window.location.href="index.php?page=master-keputusan";
                </script>');
        }
    }

    public function editpencocokankriteria($kd_pengguna,$c,$a,$id_nilai)
    {
        $i =0;
        foreach ($id_nilai as $key) {
            $cek = $this->untuk_cek($kd_pengguna,$c[$i],$a);
            if($cek==0){
                $this->tambah_pencocokan($kd_pengguna,$c[$i],$a,$key);
            }else{
                $this->edit_pencocokan($kd_pengguna,$c[$i],$a,$key);
            }
            $i++;
        }
        
        if($this->tambah_pencocokan()== TRUE){
            echo ('<script LANGUAGE="JavaScript">
                window.alert("Pencocokan Berhasil di masukan");
                window.location.href="index.php?page=master-keputusan";
                </script>');
        }

        if($this->edit_pencocokan()== TRUE){
            echo ('<script LANGUAGE="JavaScript">
                window.alert("Pencocokan Berhasil di masukan");
                window.location.href="index.php?page=master-keputusan";
                </script>');
        }else{
            echo ('<script LANGUAGE="JavaScript">
                window.alert("Pencocokan Gagal di masukan Periksa Kembali Inputan anda");
                window.location.href="index.php?page=edit-penilaian&kd_pengguna='.$kd_pengguna.'&kd_alternatif='.$a.'";
                </script>');
        }
    }

    public function untuk_cek($kd_pengguna,$c,$a){
        $query ="SELECT * FROM tb_pencocokan_kriteria WHERE kd_pengguna='$kd_pengguna' AND c='$c' AND a='$a'";
        $result = $this->conn->query($query);
        $data= mysqli_num_rows($result);
        return $data;
        
    }

    public function tambah_pencocokan($kd_pengguna,$c,$a,$nilai)
    {
        $query="INSERT INTO tb_pencocokan_kriteria VALUE('$kd_pengguna','$c','$a','$nilai');";
        $result = mysqli_query($this->conn, $query);
    }

    public function edit_pencocokan($kd_pengguna,$c,$a,$nilai)
    {
        $query = "UPDATE tb_pencocokan_kriteria SET id_nilai='$nilai' WHERE kd_pengguna='$kd_pengguna' AND c='$c' AND a='$a'; ";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    public function untuk_option($kd_pengguna,$a,$c)
    {
        $query ="SELECT * FROM $this->_table WHERE kd_pengguna='$kd_pengguna' AND a='$a' AND c='$c'; ";
        $result = $this->conn->query($query)->fetch_assoc();
        return $result;
    }


    public function pangkat($kd_pengguna,$kd_kriteria)
    {
        $query="SELECT kd_kriteria, bobot/total AS nilai, jenis FROM tb_kriteria JOIN (SELECT sum(bobot) AS total FROM tb_kriteria WHERE kd_pengguna='$kd_pengguna') AS b WHERE kd_pengguna='$kd_pengguna' AND kd_kriteria='$kd_kriteria';";
        $result = $this->conn->query($query)->fetch_assoc();
        return $result;
    }

    public function convert_nilai_w($kd_pengguna)
    {
        $query ="SELECT kd_pengguna,kd_kriteria, bobot/total AS nilai, jenis FROM tb_kriteria JOIN (SELECT ROUND(sum(bobot),1) AS total FROM tb_kriteria WHERE kd_pengguna='$kd_pengguna') AS b WHERE kd_pengguna='$kd_pengguna';";
        $result = $this->conn->query($query);
        
        while($row = $result->fetch_assoc())
        {
        $rows[] = $row;
        }
        return $rows;
    }

    public function hasil($kd_pengguna, $max)
    {
        $query= "SELECT * FROM tb_alternatif WHERE kd_pengguna='$kd_pengguna' AND kd_alternatif='$max';";
        $result = $this->conn->query($query)->fetch_assoc();
        return $result;
    }


}