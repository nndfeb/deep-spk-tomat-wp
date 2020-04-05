<?php
include_once 'Config.php';
class Penilaian extends Config
{
	public $table = "tb_penilaian";

	public function __construct()
	{
		parent::__construct();
	}

	public function tampilKriteria($table, $value)
	{
		$query = "SELECT * FROM $table WHERE $value";
		// var_dump($query);
		// die;
		$result = $this->conn->query($query);

		if ($result == FALSE) {
			echo 'Error:  ';
			return FALSE;
		} else {
			return $result;
		}
	}

	public function checkInput($table, $clause)
	{
		$query = "SELECT * FROM $table WHERE $clause";
		// var_dump($query);
		// die;
		$result = $this->conn->query($query);

		if ($result->fetch_assoc() == TRUE) {
			return TRUE;
		} else {

			return FALSE;
		}
	}
	public function insertTable($table, $field, $values)
	{
		$query = "INSERT INTO $table ({$field}) VALUES({$values})";
		// var_dump($query);
		// die; 
		$result = $this->conn->query($query);
		if ($result == FALSE) {
			echo 'Error: cannot execute the command';
			return FALSE;
		} else {
			return TRUE;
		}
	}
	public function updatePenilaian($table, $field, $clause)
	{
		$query = "UPDATE $table SET $field WHERE {$clause}";
		$result = $this->conn->query($query);

		if ($result == FALSE) {
			echo 'Error: cannot execute the command';
			return FALSE;
		} else {
			return TRUE;
		}
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
