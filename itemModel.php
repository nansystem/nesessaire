<?php
require_once 'database.php';
class ItemModel extends Database{

	private $table = "items";

	public function getById($item_id){
		return $this->query("SELECT * FROM {$this->table} WHERE item_id = :item_id LIMIT 1"
							,[":item_id" => $item_id])[0];
	}


	/**
	 * カート表示用 商品名、画像、サイズ、色、値段を表示
	 * 在庫数チェック
	 * @param  String $item_id アイテムID
	 * @return Object          アイテム関連オブジェクト
	 */
	public function getByIdWithRelations( $item_id ){
		return $this->query(
			"SELECT * FROM {$this->table} AS it
			INNER JOIN products AS pr
			-- 商品情報(商品名、価格など)を取得
			ON it.product_id = pr.product_id
			-- サイズ名を取得
			INNER JOIN sizes AS si
			ON it.size_id = si.size_id
			-- 色名を取得
			INNER JOIN colors AS co
			ON it.color_id = co.color_id
			-- メイン画像を取得
			INNER JOIN product_images AS pi
			ON it.product_id = pi.product_id
			WHERE it.item_id = :item_id
			AND pi.rank = 1
			LIMIT 1"
			,[":item_id" => $item_id])[0];
	}


	/**
	 * 在庫数を取得する
	 * @param  String $item_id アイテムID
	 * @return String          在庫数
	 */
	public function getStockQuantity( $item_id ){
		return $this->query(
			"SELECT * FROM {$this->table} AS it
			INNER JOIN stock AS st
			ON it.item_id = st.item_id
			WHERE it.item_id = :item_id
			LIMIT 1"
			,[":item_id" => $item_id])[0]->quantity;

	}

	/**
	 * 引数のアイテムIDの配列からアイテム詳細の配列を返却する
	 * @param  array $itemIds アイテムIDの配列
	 * @return array          アイテム詳細の配列
	 */
	public function getItems( $itemIds ) {
		$items = [];
		foreach($itemIds as $itemId => $quantity ){
			$item = $this->getByIdWithRelations( $itemId );
			$item->quantity = $quantity;
			$items[] = $item;
		}
		return $items;
	}

	/**
	 * 商品合計額を算出する
	 * ※DB接続なし
	 * @param  array $items アイテムオブジェクトが格納された配列
	 * @return integer      商品合計額
	 */
	function calculateSumAmount( $items ){
		$productTotal = 0;
		foreach($items as $item ){
			$productTotal += $item->list_price * $item->quantity;
		}
		return $productTotal;
	}


	/**
	 * 商品合計が5000円以上の場合は配送料無料。それ以外は配送料800円
	 * ※DB接続なし
	 * @param  integer $productTotal 商品合計金額
	 * @return integer            配送料
	 */
	function getDeliveryFee( $productTotal = 0 ){
		$threshold = 5000;
		if( $productTotal > $threshold) {
			return 0;
		}
		return 800;
	}


	/**
	 * 代引き手数料(ヤマト運輸)を返却する
	 * ※DB接続なし
	 * 参考
	 * http://www.yamatofinancial.jp/service/co.html
	 * @return integer 代引き手数料
	 */
	function getCashOnDeliveryFee( $productTotal = 0 ) {
		if ( $productTotal < 10000 ) {
			return round(300 * 1.08);
		} elseif( $productTotal >= 10000 && $productTotal < 30000 ) {
			return round(400 * 1.08);
		} elseif( $productTotal >= 30000 && $productTotal < 100000 ) {
			return round(600 * 1.08);
		} elseif( $productTotal >= 100000 && $productTotal < 300000 ) {
			return round(1000 * 1.08);
		} else {
			return false;
		}
	}

}