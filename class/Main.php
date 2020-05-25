<?php
include_once 'Config.php';
class Main extends Config
{

    public $id;
    public $table = "tb_pengguna";
    public $pengguna;
    public $password;

    public function __construct()
    {
        parent::__construct();
    }


    public function insert($tabel, $data, $where, $value, $msg)
    {
        $query = "SELECT * FROM $tabel WHERE $where='$value'";
        $result = $this->conn->query($query);
        $check = mysqli_num_rows($result);

        if ($check > 0) {
            echo "<script>alert('$msg');</script>";
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
            $query = "INSERT INTO $tabel ($column) VALUE($values)";
            // var_dump($query);
            // die;
            $result = mysqli_query($this->conn, $query);
        }
        return TRUE;
    }

    public function tampil($table, $where = NULL, $value)
    {
        if ($where === NULL) {
            $query = "SELECT * FROM $table";
            $result = $this->conn->query($query);
        } else {
            $query = "SELECT * FROM $table WHERE $where='$value'";
            $result = $this->conn->query($query);
            // var_dump($query);
            // die;
        }
        return $result;
    }



    public function hapus($table, $kolom, $value)
    {
        $query = "DELETE FROM $table WHERE $kolom='$value'";
        $result = $this->conn->query($query);
        if ($result == TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public function get_kode($table, $value, $set_kd, $default)
    {
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

    public function update($table_name, $fields, $where_condition)
    {
        $query = '';
        $condition = '';
        foreach ($fields as $key => $value) {
            $query .= $key . "='" . $value . "', ";
        }
        $query = substr($query, 0, -2);
        /*This code will convert array to string like this-  
           input - array(  
                'key1'     =>     'value1',  
                'key2'     =>     'value2'  
           )  
           output = key1 = 'value1', key2 = 'value2'*/
        foreach ($where_condition as $key => $value) {
            $condition .= $key . "='" . $value . "' AND ";
        }
        $condition = substr($condition, 0, -5);
        /*This code will convert array to string like this-  
           input - array(  
                'id'     =>     '5'  
           )  
           output = id = '5'*/
        $query = "UPDATE " . $table_name . " SET " . $query . " WHERE " . $condition . "";
        // var_dump($query);
        // die;
        if (mysqli_query($this->conn, $query)) {
            return true;
        }
    }
    public function insert2($tabel, $data, $where1, $value1, $where2 = NULL, $value2, $msg)
    {
        if (!$where2 == NULL) {
            $query = "SELECT * FROM $tabel WHERE $where1='$value1' AND $where2='$value2'";
            $result = $this->conn->query($query);
        } else {
            $query = "SELECT * FROM $tabel WHERE $where1='$value1'";
            $result = $this->conn->query($query);
        }


        $check = mysqli_num_rows($result);

        if ($check > 0) {
            echo "<script>alert('$msg');</script>";
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
            $query = "INSERT INTO $tabel ($column) VALUE($values)";
            // var_dump($query);
            // die;
            $result = mysqli_query($this->conn, $query);
        }
        return TRUE;
    }
    public function update_form($table, $field, $clause)
    {
        $query = "UPDATE $table SET $field WHERE {$clause}";
        // var_dump($query);
        // die;
        $result = mysqli_query($this->conn, $query);
        if ($result == FALSE) {
            echo 'Error: Tidak bisa melakukan perubahan data';
            return FALSE;
        } else {
            return TRUE;
        }
    }
}
