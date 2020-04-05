<?php
include_once 'Config.php';
class Alternatif extends Config
{

    public $table = "tb_alternatif";

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
        return $rows;
    }

    public function showRecord($clause)
    {
        $query = "SELECT * FROM {$this->table} WHERE {$clause}";
        $result = $this->conn->query($query);

        if ($result == FALSE) {
            echo 'Error:  ';
            return FALSE;
        } else {
            return $result;
        }
    }
}
