<?php
include_once 'Config.php';
class Kriteria extends Config
{

    public $table = "tb_kriteria";

    public function __construct()
    {
        parent::__construct();
    }

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
