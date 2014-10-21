<?php
require_once 'database.php';
class ProductModel extends Database{

	private $table = "products";

	public function getById($product_id){
		return 	$this->query("SELECT * FROM products AS pr
				LEFT OUTER JOIN product_images AS pi
				ON pr.product_id = pi.product_id
				WHERE pr.product_id = :product_id
				LIMIT 1",[ ':product_id' => $product_id ]
				)[0];
	}

	// public function getLimitRow($limit = 30){
	// 	return parent::getLimitRow($this->table, $limit);
	// }

	public function getLimitRowWithRelationshipTables($limit = 30){
		$sql =
			"SELECT * FROM {$this->table} AS pr
			LEFT OUTER JOIN product_images as pi
			ON pr.product_id = pi.product_id
			AND pi.rank = 1
			LIMIT :limit";
		$stmt = $this->conn->prepare($sql);
		$stmt-> bindParam(':limit', $limit, PDO::PARAM_INT);
		$stmt-> execute();
		$results = $stmt->fetchAll();
		return $results ? $results : false;
	}

	public function getRelationshipTables(){
		return $this->query(
			"SELECT * FROM {$this->table} AS pr
			LEFT OUTER JOIN product_images as pi
			ON pr.product_id = pi.product_id
			");
	}

	public function getRelationshipTablesById( $product_id ){
		return $this->query(
			"SELECT * FROM {$this->table} AS pr
			LEFT OUTER JOIN product_images as pi
			on pr.product_id = pi.product_id
			WHERE pr.product_id = :product_id
			ORDER BY pi.rank
			",[":product_id" => $product_id]
			);
	}

	/**
	 * 商品の色、サイズごとに在庫を取得する
	 * @param  String $product_id プロダクト番号
	 * @return Object             在庫データ
	 */
	public function getStock( $product_id ){
		return $this->query(
			"SELECT * FROM {$this->table} AS pr
			LEFT OUTER JOIN product_sizes as ps
			ON pr.product_id = ps.product_id
			LEFT OUTER JOIN sizes as si
			ON ps.size_id = si.size_id
			LEFT OUTER JOIN product_colors as pc
			ON pr.product_id = pc.product_id
			LEFT OUTER JOIN colors as co
			ON pc.color_id = co.color_id
			LEFT OUTER JOIN items as it
			ON pr.product_id = it.product_id
			AND ps.size_id = it.size_id
			AND pc.color_id = it.color_id
			LEFT OUTER JOIN stock as st
			ON it.item_id = st.item_id
			WHERE pr.product_id = :product_id
			",[":product_id" => $product_id]
			);
	}

	/**
	 * おすすめ商品一覧を取得する
	 * @return [type] [description]
	 */
	public function getPickups(){
		return $this->query(
			"SELECT * FROM product_pickups AS pp
			LEFT OUTER JOIN products as pr
			on pp.product_id = pr.product_id
			LEFT OUTER JOIN product_images as pi
			on pr.product_id = pi.product_id
			AND pi.rank = 1
			ORDER BY pp.rank");
	}


	/**
	 * 検索語を元にあいまい検索し、商品一覧を返す
	 * @param  string $keyword 検索語
	 * @return array             商品一覧
	 */
	public function getByKeyWord( $keyword, $limit = 100) {
		$sql =
			"SELECT * FROM {$this->table} AS pr
			LEFT OUTER JOIN product_images as pi
			ON pr.product_id = pi.product_id
			AND pi.rank = 1
			WHERE pr.product_name LIKE :keyword
			LIMIT :limit";
		$stmt = $this->conn->prepare($sql);
		$stmt-> bindParam(':limit', $limit, PDO::PARAM_INT);
		$keyword = "%".addcslashes($keyword, '\_%')."%";
		$stmt-> bindParam(':keyword', $keyword ,PDO::PARAM_STR);
		$stmt-> execute();
		$results = $stmt->fetchAll();
		return $results ? $results : false;
	}

}