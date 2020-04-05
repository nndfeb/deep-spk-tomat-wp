<?php
include_once 'Config.php';
class Login extends Config
{

    public $id;
    public $table = "tb_pengguna";
    public $pengguna;
    public $password;


    public function __construct()
    {
        parent::__construct();
    }

    public function login($email, $password)
    {
        $password_hash = md5($password);
        $data = $this->auth($email, $password_hash);
        // var_dump($data);
        // die;

        if ($data == TRUE) {
            session_start();
            $_SESSION['kd_pengguna'] = $data['kd_pengguna'];
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['email'] = $data['email'];
            $_SESSION['id_akses'] = $data['id_akses'];
            $_SESSION['akses'] = $data['akses'];
            $_SESSION['password'] = $data['password'];


            // pengarahan halaman sesuai hak akses
            if ($_SESSION['id_akses'] == '1') {
                header('Location: index.php');
            } else if ($_SESSION['id_akses'] == '2') {
                header('Location: index.php');
            } else {
                die;
            }
        } else {
            echo "SALAH";
        }
    }

    protected function auth($email, $password_hash)
    {
        $query = "SELECT * FROM {$this->table} WHERE email='$email' AND password='$password_hash'";
        // var_dump($query);
        // die;
        $result = $this->conn->query($query);

        if (mysqli_num_rows($result) > 0) {

            // Mengambil email yang melakukan login
            $fetch = mysqli_fetch_assoc($result);
            $email = $fetch['email'];

            // Melakukan query pengambilan data akes 
            $query = "SELECT * FROM tb_pengguna INNER JOIN 
            tb_akses ON tb_pengguna.id_akses = tb_akses.id_akses WHERE email='$email'";
            $result = $this->conn->query($query);
            $data = $result->fetch_assoc();
            return $data;
        }
        return false;
    }

    public function get_user()
    {
        return $this->pengguna;
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
            $hasilkode = $set_kd . str_pad($kode, 2, "0", STR_PAD_LEFT);
        } else {
            $hasilkode = $default;
        }
        return $hasilkode;
    }
}
