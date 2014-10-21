<?php
class CartModel{

	function __construct(){
		if( !isset($_SESSION) ) {
			session_start();
		}
		if( !array_key_exists('cart', $_SESSION) ){
			$_SESSION['cart'] = [];
		}
	}

	/**
	 * カートの中身を全て取得する
	 * @return array カートの中身
	 */
	function getAll(){
		return $_SESSION['cart'];
	}

	/**
	 * カートに商品を追加
	 * @param $product_id 商品のid
	 */
    function addItem($product_id) {
        if ( isset($_SESSION['cart'][$product_id] ) ) {
            $_SESSION['cart'][$product_id] += 1;
        } else {
            $_SESSION['cart'][$product_id] = 1;
       }
    }
	/**
	 * カートから商品を削除する
	 * @return void
	 */
	function removeItem($product_id){
		unset($_SESSION['cart'][$product_id]);
	}

	/**
	 * カートからすべての商品を削除する
	 * @return void
	 */
	function removeAll(){
		$_SESSION['cart'] = [];
	}

}