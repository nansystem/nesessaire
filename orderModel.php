<?php
require_once 'database.php';
class OrderModel extends Database{

	private $table = "orders";

	public function getById($sale_id){
		return $this->query("SELECT * FROM {$this->table} WHERE sale_id = :sale_id LIMIT 1"
							,[":sale_id" => $sale])[0];
	}

	public function getByUserId($user_id){
		return $this->query("SELECT * FROM {$this->table} WHERE user_id = :user_id ORDER BY order_date DESC"
							,[":user_id" => $user_id]);
	}

	/**
	 * 受注情報をINSERTする
	 * @param  array $bindings INSERTする値
	 * @return interger           order_id
	 */
	public function insert( $bindings ) {
		$stmt = $this->conn->prepare(
			"INSERT INTO {$this->table} (user_id,  payment,  state,  remote_addr,  shipping_name,  shipping_furigana,  shipping_zipcode,  shipping_xmpf,  shipping_address,  product_total,  delivery_fee,  charge,  sum_total,  order_date,  shipping_date)
								VALUES (:user_id, :payment, :state, :remote_addr, :shipping_name, :shipping_furigana, :shipping_zipcode, :shipping_xmpf, :shipping_address, :product_total, :delivery_fee, :charge, :sum_total, :order_date, :shipping_date)");
		$stmt->bindParam(':user_id', $bindings['user_id'] ,PDO::PARAM_INT);
		$stmt->bindParam(':payment', $bindings['payment'] ,PDO::PARAM_STR);
		$stmt->bindParam(':state', $bindings['state']  ,PDO::PARAM_INT);
		$stmt->bindParam(':remote_addr', $bindings['remote_addr'] ,PDO::PARAM_STR);
		$stmt->bindParam(':shipping_name', $bindings['shipping_name']  ,PDO::PARAM_STR);
		$stmt->bindParam(':shipping_furigana', $bindings['shipping_furigana'] ,PDO::PARAM_STR);
		$stmt->bindParam(':shipping_zipcode', $bindings['shipping_zipcode']  ,PDO::PARAM_STR);
		$stmt->bindParam(':shipping_xmpf', $bindings['shipping_xmpf'] ,PDO::PARAM_INT);
		$stmt->bindParam(':shipping_address', $bindings['shipping_address']  ,PDO::PARAM_STR);
		$stmt->bindParam(':product_total', $bindings['product_total']  ,PDO::PARAM_STR);
		$stmt->bindParam(':delivery_fee', $bindings['delivery_fee']  ,PDO::PARAM_STR);
		$stmt->bindParam(':charge', $bindings['charge']  ,PDO::PARAM_STR);
		$stmt->bindParam(':sum_total', $bindings['sum_total']  ,PDO::PARAM_STR);
		$stmt->bindParam(':order_date', $bindings['order_date'] ,PDO::PARAM_STR);
		$stmt->bindParam(':shipping_date', $bindings['shipping_date']  ,PDO::PARAM_STR);
		if($stmt->execute()){
			return $this->conn->lastInsertId('order_id');
		}
		return false;
	}

	/**
	 * 受取日を算出する
	 * 注文日の3日後とする
	 * ※DB接続なし
	 * @return date 受取日
	 */
	function calculateShippingDate() {
		$now = date('Y-m-d H:i:s');
		$shippingDate = (date('Y-m-d H:i:s', strtotime("$now + 3 day")));
		return $shippingDate;
	}

}