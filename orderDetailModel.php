<?php
require_once 'database.php';
class OrderDetailModel extends Database{

	private $table = "order_details";

	public function getById($order_detail_id){
		return $this->query("SELECT * FROM {$this->table} WHERE order_detail_id = :order_detail_id LIMIT 1"
							,[":order_detail_id" => $order_detail_id])[0];
	}

	/**
	 * 注文IDから注文詳細情報の一覧を取得する
	 * @param  integer $order_id 注文ID
	 * @return array             注文詳細情報の配列
	 */
	public function getByOrderId($order_id){
		return $this->query("SELECT * FROM {$this->table} WHERE order_id = :order_id"
							,[":order_id" => $order_id]);
	}

	/**
	 * 受注明細情報をINSERTする
	 * @param  array $bindings INSERTする値
	 * @return interger           order_detail_id
	 */
	public function insert( $bindings ) {
		$stmt = $this->conn->prepare(
			"INSERT INTO {$this->table} (order_id, item_id, product_name, color_name, size_name, sale_price, image_url, quantity)
			VALUES (:order_id, :item_id, :product_name, :color_name, :size_name, :sale_price, :image_url, :quantity)");
		$stmt->bindParam(':order_id', $bindings['order_id'] ,PDO::PARAM_INT);
		$stmt->bindParam(':item_id', $bindings['item_id']  ,PDO::PARAM_INT);
		$stmt->bindParam(':product_name', $bindings['product_name']  ,PDO::PARAM_STR);
		$stmt->bindParam(':color_name', $bindings['color_name']  ,PDO::PARAM_STR);
		$stmt->bindParam(':size_name', $bindings['size_name']  ,PDO::PARAM_STR);
		$stmt->bindParam(':sale_price', $bindings['sale_price']  ,PDO::PARAM_STR);
		$stmt->bindParam(':image_url', $bindings['image_url']  ,PDO::PARAM_STR);
		$stmt->bindParam(':quantity', $bindings['quantity'] ,PDO::PARAM_INT);
		if($stmt->execute()){
			return $this->conn->lastInsertId('order_detail_id');
		}
		return false;
	}

}