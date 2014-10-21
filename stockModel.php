<?php
require_once 'database.php';
class StockModel extends Database{

	private $table = "stock";

	public function getById($item_id){
		return $this->query("SELECT * FROM {$this->table} WHERE item_id = :item_id LIMIT 1"
							,[":item_id" => $item_id])[0];
	}

	/**
	 * 在庫数を変更する
	 * @param  integer $item_id  アイテムID
	 * @param  integer $quantity 更新後の在庫数
	 * @return integer          更新したアイテムID
	 */
	public function update( $bindings ){
		$stmt = $this->conn->prepare(
			"UPDATE {$this->table}
			 SET quantity = :quantity
			 WHERE item_id = :item_id");
		$stmt->bindParam(':item_id', $bindings['item_id'] ,PDO::PARAM_INT);
		$stmt->bindParam(':quantity', $bindings['quantity'] ,PDO::PARAM_INT);
		if($stmt->execute()){
			return $this->conn->lastInsertId('item_id');
		}
		return false;
	}

}