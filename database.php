<?php
require_once('dbconfig.php');
class Database{
	protected $conn;

	public function __construct(){
		try{
			$this->conn = new PDO(DbConfing::DSN, DbConfing::USER, DbConfing::PASSWORD);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
			//http://qiita.com/stk2k/items/c46cc921a4f7b6e4bab2
			$this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		} catch(PDOException $e){
			return false;
		}
	}

	public function __destruct(){
		$this->conn = null;
	}

	public function get($tableName){
		try{
			$stmt = $this->conn->query("SELECT * FROM $tableName");
			return ($stmt->rowCount() > 0)
				? $stmt
				: false;
		} catch(PDOException $e){
			return false;
		}
	}

	public function getLimitRow($tableName, $limit = 10){
		$sql = "SELECT * FROM $tableName LIMIT :limit";
		$stmt = $this->conn->prepare($sql);
		$stmt-> bindParam(':limit', $limit, PDO::PARAM_INT);
		$stmt-> execute();
		$results = $stmt->fetchAll();
		return $results ? $results : false;
	}

	public function query($query, $bindings = null){
		$stmt = $this->conn->query($query);
		$stmt->execute($bindings);
		$results = $stmt->fetchAll();
		return $results ? $results : false;
	}

}