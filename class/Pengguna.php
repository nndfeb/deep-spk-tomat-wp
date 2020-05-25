<?php
include_once 'Config.php';
class Pengguna extends Config
{

    private $_table = 'tb_pengguna';

    public function __construct()
    {
        parent::__construct();
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

    public function tambah_pengguna($data, $value)
    {
        $table = $this->_table;
        $query = "SELECT * FROM  $table WHERE email='$value'";
        // var_dump($query);
        // die;
        $result = $this->conn->query($query);
        $check = mysqli_num_rows($result);

        if ($check > 0) {
            echo ('<script LANGUAGE="JavaScript">
            window.alert("Email sudah terdaftar!");
            window.location.href="index.php?page=tambah-pengguna";
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
            $query = "INSERT INTO $table ($column) VALUE($values)";
            // var_dump($query);
            // die;
            $result = mysqli_query($this->conn, $query);

            if ($result > 0) {
                echo ('<script LANGUAGE="JavaScript">
                    window.alert("Berhasil memasukan data");
                    window.location.href="index.php?page=master-pengguna";
                    </script>');
            }
        }
        // header('Location: index.php?page=master-pengguna');
        return $this;
    }

    public function semua_pengguna()
    {
        $query = 'SELECT * FROM ' . $this->_table;
        $result = $this->conn->query($query);
        return $result;
    }

    public function block_pengguna($kd)
    {
        $query = "UPDATE " . $this->_table . " SET id_akses='0' WHERE kd_pengguna='$kd'";
        // var_dump($query);
        // die;
        $result = mysqli_query($this->conn, $query);

        if ($result == TRUE) {
            echo ('<script LANGUAGE="JavaScript">
                window.alert("Kode Pengguna (' . $kd . ') Berhasil dihapus");
                window.location.href="index.php?page=master-pengguna";
                </script>');
        } else {
            echo ('<script LANGUAGE="JavaScript">
            window.alert("Kode Pengguna (' . $kd . ') Gagal dihapus");
            window.location.href="index.php?page=master-pengguna";
            </script>');
        }
    }

    public function hapus_pengguna($kd)
    {
        $query = "DELETE FROM " . $this->_table . " WHERE kd_pengguna='$kd'";
        // var_dump($query);
        // die;
        $result = $this->conn->query($query);

        if ($result == TRUE) {
            echo ('<script LANGUAGE="JavaScript">
                window.alert("Kode Pengguna (' . $kd . ') Berhasil dihapus");
                window.location.href="index.php?page=master-pengguna&kd_pengguna";
                </script>');
        } else {
            echo ('<script LANGUAGE="JavaScript">
            window.alert("Kode Pengguna (' . $kd . ') Gagal dihapus");
            window.location.href="index.php?page=master-pengguna&kd_pengguna";
            </script>');
        }
    }

    public function edit_pengguna($kd)
    {
        $query = "SELECT * FROM " . $this->_table . " WHERE kd_pengguna='$kd'";
        $result = $this->conn->query($query);
        return $result;
    }

    public function ganti_password($data, $clause)
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
                window.alert("Kode Pengguna (' . $kd . ') Password Berhasil diperbarui");
                window.location.href="index.php?page=master-pengguna&kd_pengguna";
                </script>');
        } else {
            echo ('<script LANGUAGE="JavaScript">
                window.alert("Kode Pengguna (' . $kd . ') Gagal memperbarui Password");
                window.location.href="index.php?page=edit-pengguna&kd_pengguna=' . $kd . '";
                </script>');
        }
    }

    public function perbarui_data_pengguna($data, $clause)
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
                window.alert("Kode Pengguna (' . $kd . ') Berhasil diperbarui");
                window.location.href="index.php?page=master-pengguna&kd_pengguna";
                </script>');
        } else {
            echo ('<script LANGUAGE="JavaScript">
                window.alert("Kode Pengguna (' . $kd . ') Gagal diperbarui");
                window.location.href="index.php?page=edit-pengguna&kd_pengguna=' . $kd . '";
                </script>');
        }
    }
}
