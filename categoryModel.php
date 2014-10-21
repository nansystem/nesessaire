<?php
require_once 'database.php';
class CategoryModel extends Database{

	private $table = "categories";

	public function getById($category_id){
		return $this->query("SELECT * FROM {$this->table} WHERE category_id = :category_id LIMIT 1"
							,[":category_id" => $category_id])[0];
	}

	/**
	 * 子カテゴリーのみを取得する
	 * @return PDOStatement 子カテゴリー
	 */
	public function getChildCategories(){
		return $this->query("SELECT * FROM {$this->table} WHERE parent_category_id <> 0");
	}


	/**
	 * カテゴリーIDを元に商品情報を取得する
	 * @param  array $bindings カテゴリーID
	 * @param  integer $limit 取得件数
	 * @return array           商品情報
	 */
	public function getByCategoryId( $bindings,$limit = 30 ){
		$stmt = $this->conn->prepare("SELECT * FROM categories AS ca
			LEFT OUTER JOIN products AS pr
			ON ca.category_id = pr.category_id
			LEFT OUTER JOIN product_images AS pi
			ON pr.product_id = pi.product_id
			WHERE ca.category_id = :category_id
			AND pi.rank = 1
			LIMIT :limit");
		$stmt->bindParam(':category_id', $bindings['category_id'], PDO::PARAM_INT);
		$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
		$stmt->execute();
		$results = $stmt->fetchAll();
		return $results ? $results : false;
	}


	/**
	 * 親カテゴリーIDを元に商品情報を取得する
	 * @param  array $bindings 親カテゴリーID
	 * @param  integer $limit 取得件数
	 * @return array           商品情報
	 */
	public function getByParentCategoryId( $bindings,$limit = 30 ){
		$stmt = $this->conn->prepare("SELECT * FROM categories AS ca
			LEFT OUTER JOIN products AS pr
			ON ca.category_id = pr.category_id
			LEFT OUTER JOIN product_images AS pi
			ON pr.product_id = pi.product_id
			WHERE ca.parent_category_id = :parent_category_id
			AND pi.rank = 1
			LIMIT :limit");
		$stmt->bindParam(':parent_category_id', $bindings['parent_category_id'], PDO::PARAM_INT);
		$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
		$stmt->execute();
		$results = $stmt->fetchAll();
		return $results ? $results : false;
	}

}