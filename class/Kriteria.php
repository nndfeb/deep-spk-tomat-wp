<?php
include_once 'Config.php';
class Kriteria extends Config
{

    private $_table = "tb_kriteria";
    private $_kd_kriteria = "kd_kriteria";

    public function __construct()
    {
        parent::__construct();
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
            $hasilkode = "C" . str_pad($kode, 1, "0", STR_PAD_LEFT);
        }else{
            $hasilkode= 'C1';
        }
        return $hasilkode;
    }

    public function get_code($set_kd, $default)
    {
        $table = $this->_table;
        $value = $this->_kd_kriteria;
        $query = "SELECT MAX($value) AS kd FROM $table ";
        $result = $this->conn->query($query);
        $data_kd = mysqli_fetch_array($result);

        if ($data_kd) {
            $nilai_kd = substr($data_kd[0], 1);
            $kode = (int) $nilai_kd;
            $kode = $kode + 1;
            $hasilkode = $set_kd . str_pad($kode, 1, "0", STR_PAD_LEFT);
        } else {
            $hasilkode = $default;
        }
        return $hasilkode;
    }

    public function tambah_kriteria($data, $value, $kd_pengguna)
    {
        $table = $this->_table;
        // SELECT * FROM tb_kriteria WHERE nm_kriteria='bangkong' AND kd_pengguna='P1'
        $query = "SELECT * FROM  $table WHERE nm_kriteria='$value' AND kd_pengguna='" . $kd_pengguna . "'";
        $result = $this->conn->query($query);
        $check = mysqli_num_rows($result);

        if ($check > 0) {
            echo ('<script LANGUAGE="JavaScript">
            window.alert("Kriteria sudah ada!");
            window.location.href="index.php?page=tambah-kriteria";
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
                    $valueArrays[$i] = "'" . $values . "'";}
                $i++;
            }

            $values = implode(", ", $valueArrays);
            $query = "INSERT INTO $table ($column,waktu) VALUE($values, now())";
            $result = mysqli_query($this->conn, $query);

            if ($result > 0) {
                echo ('<script LANGUAGE="JavaScript">
                    window.alert("Berhasil memasukan kretieria baru");
                    window.location.href="index.php?page=master-kriteria";
                    </script>');
            }
        }
        return $this;
    }

    public function detail_sub_kriteria($kd_pengguna,$kriteria)
    {
        $query = "SELECT * FROM tb_sub_kriteria WHERE kd_pengguna='$kd_pengguna' AND kriteria='$kriteria'";
        $result = $this->conn->query($query);
        return $result;
    }


    // public function detail_kriteria($kd_pengguna)
    // {
    //     $query = "SELECT * FROM sub_kriteria WHERE kd_pengguna='$kd_pengguna'";
    //     $result = $this->conn->query($query);
    //     return $result;
    // }

    public function tambah_sub_kriteria($data)
    {

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
            $query = "INSERT INTO tb_sub_kriteria (id,$column) VALUE('',$values)";
 
            $result = mysqli_query($this->conn, $query);

            if ($result > 0) {
                echo ('<script LANGUAGE="JavaScript">
                    window.alert("Berhasil memasukan penilaian kriteria baru");
                    window.location.href="index.php?page=penilaian-kriteria";
                    </script>');
            }

        return $this;
    }

    public function semua_kriteria($kd_pengguna)
    {
        $query = "SELECT * FROM $this->_table WHERE kd_pengguna='$kd_pengguna';";
        $result = $this->conn->query($query);
        return $result;
    }
    
    public function detail_penilaian_kriteria($kd_pengguna, $kd_kriteria)
    {
        $query = "SELECT * FROM tb_sub_kriteria WHERE kd_pengguna='$kd_pengguna' AND kriteria='$kd_kriteria'";
        $result = $this->conn->query($query);
        return $result;
    }

    public function edit_kriteria($kd, $kd_pengguna)
    {
        $query = "SELECT * FROM " . $this->_table . " WHERE kd_pengguna='$kd_pengguna' AND kd_kriteria='$kd'";
        $result = $this->conn->query($query);
        return $result;
    }

    public function hapus_kriteria($kd_kriteria, $kd_pengguna)
    {
        $query = "DELETE FROM $this->_table WHERE kd_kriteria='$kd_kriteria' AND kd_pengguna='$kd_pengguna'";
        // var_dump($query);
        // die;
        $result = $this->conn->query($query);

        if ($result == TRUE) {
            echo ('<script LANGUAGE="JavaScript">
                window.alert("Kriteria Dengan Kode(' . $kd_kriteria . ') Berhasil dihapus");
                window.location.href="index.php?page=master-kriteria";
                </script>');
        } else {
            echo ('<script LANGUAGE="JavaScript">
            window.alert("Kriteria Dengan Kode(' . $kd_kriteria . ') Gagal dihapus");
            window.location.href="index.php?page=master-kriteria";
            </script>');
        }
    }

      public function hapus_detail_sub_kriteria($id)
    {
        $query = "DELETE FROM tb_sub_kriteria WHERE id='$id'";
        // var_dump($query);
        // die;
        $result = $this->conn->query($query);

        if ($result == TRUE) {
            echo ('<script LANGUAGE="JavaScript">
                window.alert("Sub Kriteria Berhasil dihapus");
                window.location.href="index.php?page=penilaian-kriteria";
                </script>');
        } else {
            echo ('<script LANGUAGE="JavaScript">
            window.alert("Sub Kriteria gagal dihapus");
            window.location.href="index.php?page=tambah-penilaian-kriteria";
            </script>');
        }
    }


    public function perbarui_kriteria($data, $clause)
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
        // var_dump($query);
        // die;
        $result = mysqli_query($this->conn, $query);

        if ($result == TRUE) {
            echo ('<script LANGUAGE="JavaScript">
                window.alert("Kode kriteria (' . $kd . ') Berhasil diperbarui");
                window.location.href="index.php?page=master-kriteria&kd_kriteria";
                </script>');
        } else {
            echo ('<script LANGUAGE="JavaScript">
                window.alert("Kode kriteria (' . $kd . ') Gagal diperbarui");
                window.location.href="index.php?page=edit-kriteria&kd_kriteria=' . $kd . '";
                </script>');
        }
    }

    public function data_sub_kriteria($kriteria,$kd_pengguna)
    {   
       $query="SELECT * FROM tb_sub_kriteria WHERE kriteria='$kriteria' AND kd_pengguna='$kd_pengguna' ORDER BY nilai DESC;";
    //   var_dump($query);
    //   die;
       $result = $this->conn->query($query);
       return $result;
    }


    // 

    public function showTable()
    {
        $query = "SELECT * FROM {$this->table}";
        $result = $this->conn->query($query);

        if ($result == FALSE) {
            return FALSE;
        }
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        // print_r($rows);
        // die;
        return $rows;
    }

    public function showRecord($clause)
    {
        $query = "SELECT * FROM {$this->table} WHERE {$clause}";

        $result = $this->conn->query($query);

        if ($result == false) {
            echo 'Error:  ';
            return false;
        } else {
            return $result;
        }
    }
}