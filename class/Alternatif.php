<?php
include_once 'Config.php';
class Alternatif extends Config
{

    private $_table = "tb_alternatif";

    public function __construct()
    {
        parent::__construct();
    }

    public function tambah_alternatif($data, $value, $kd_pengguna)
    {
        $table = $this->_table;
        // SELECT * FROM tb_kriteria WHERE nm_kriteria='bangkong' AND kd_pengguna='P1'
        $query = "SELECT * FROM  $table WHERE nm_alternatif='$value' AND kd_pengguna='" . $kd_pengguna . "'";
        $result = $this->conn->query($query);
        $check = mysqli_num_rows($result);
        if ($check > 0) {
            echo ('<script LANGUAGE="JavaScript">
            window.alert("Alternatif sudah ada!");
            window.location.href="index.php?page=tambah-alternatif";
            </script>');
        } else {
            // mengambil kolom
            $column = implode(", ", array_keys($data));
            // mengambil nilai
            $valueArrays = array();
            $i = 0;
            foreach ($data as $key => $values) {
                if (is_int($values)) {
                    $valueArrays[$i] = $values;
                } else {
                    $valueArrays[$i] = "'" . $values . "'";
                }
                $i++;
            }

            $values = implode(", ", $valueArrays);
            // INSERT INTO `tb_kriteria` (`kd_kriteria`, `kd_pengguna`, `nm_kriteria`, `jenis`, `bobot`, `waktu`) VALUES ('C1', 'P1', 'anjing', 'Benefit', '1', NOW());
            // INSERT INTO tb_kriteria (kd_kriteria, kd_pengguna, nm_kriteria, jenis, bobot,wkatu) VALUE('C1', 'P1', 'kampret', 'Benefit', '10', now())
            $query = "INSERT INTO $table ($column,waktu) VALUE($values, now())";
            // var_dump($query);
            // die;
            $result = mysqli_query($this->conn, $query);

            if ($result > 0) {
                echo ('<script LANGUAGE="JavaScript">
                    window.alert("Berhasil memasukan alternatif baru");
                    window.location.href="index.php?page=master-alternatif";
                    </script>');
            }
        }
        return $this;
    }

    


    
    public function get_id($kd_pengguna)    
    {
        $query= "SELECT * FROM $this->_table WHERE kd_pengguna='$kd_pengguna' AND waktu=(SELECT MAX(waktu) FROM $this->_table WHERE kd_pengguna='$kd_pengguna')";
        $result = $this->conn->query($query);
        $data_kd = mysqli_fetch_array($result);
        if($data_kd){
            $nilai_kd = substr($data_kd[0], 1);
            $kode = (int) $nilai_kd;
            $kode = $kode + 1;
            $hasilkode = "A" . str_pad($kode, 1, "0", STR_PAD_LEFT);
        }else{
            $hasilkode= 'A1';
        }
        return $hasilkode;
    }

 
    
    public function semua_alternatif($kd_pengguna)
    {
        $query = "SELECT * FROM $this->_table WHERE kd_pengguna='$kd_pengguna' ORDER BY waktu;";
        $result = $this->conn->query($query);
        return $result;
    }

    public function data_alternatif($kd_pengguna)
    {
        $query = "SELECT * FROM $this->_table WHERE kd_pengguna='$kd_pengguna' ORDER BY waktu;";
        $result = $this->conn->query($query)->fetch_assoc();
        return $result;
    }

    public function edit_alternatif($kd, $kd_pengguna)
    {
        $query = "SELECT * FROM " . $this->_table . " WHERE kd_pengguna='$kd_pengguna' AND kd_alternatif='$kd'";
        //    var_dump($query);
        // die;
        $result = $this->conn->query($query);
        return $result;
    }


    public function hapus_alternatif($kd_alternatif, $kd_pengguna)
    {
        $query = "DELETE FROM $this->_table WHERE kd_alternatif='$kd_alternatif' AND kd_pengguna='$kd_pengguna'";
        // var_dump($query);
        // die;
        $result = $this->conn->query($query);

        if ($result == TRUE) {
            echo ('<script LANGUAGE="JavaScript">
                window.alert("Alternatif Dengan Kode(' . $kd_alternatif . ') Berhasil dihapus");
                window.location.href="index.php?page=master-Alternatif";
                </script>');
        } else {
            echo ('<script LANGUAGE="JavaScript">
            window.alert("Alternatif Dengan Kode(' . $kd_alternatif . ') Gagal dihapus");
            window.location.href="index.php?page=master-Alternatif";
            </script>');
        }
    }

    public function perbarui_alternatif($data, $clause)
    {
        foreach ($clause as $value) {
            $kd = $value;
        }
        foreach ($data as $key => $value) {

            $field .= $key . "='" . $value . "',";
        }
        $field = substr($field, 0, -2);

        foreach ($clause as $key => $value) {
            $condition .= $key . "='" . $value . "' AND ";
        }
        $condition = substr($condition, 0, -5);
        $query = 'UPDATE ' . $this->_table . ' SET ' . $field . "' WHERE " . $condition;
    
        $result = mysqli_query($this->conn, $query);

        if ($result == TRUE) {
            echo ('<script LANGUAGE="JavaScript">
                window.alert("Kode Kriteria (' . $kd . ') Berhasil diperbarui");
                window.location.href="index.php?page=master-alternatif&kd_alternatif";
                </script>');
        } else {
            echo ('<script LANGUAGE="JavaScript">
                window.alert("Kode Kriteria (' . $kd . ') Gagal diperbarui");
                window.location.href="index.php?page=edit-alternatif&kd_alternatif=' . $kd . '";
                </script>');
        }
    }



    

    public function showTable()
    {
        $query = "SELECT * FROM {$this->_table}";
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

    public function showRecord($clause)
    {
        $query = "SELECT * FROM {$this->_table} WHERE {$clause}";
        $result = $this->conn->query($query);

        if ($result == FALSE) {
            echo 'Error:  ';
            return FALSE;
        } else {
            return $result;
        }
    }

}