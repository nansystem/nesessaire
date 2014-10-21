<?php
require_once('userModel.php');
class AuthModel {

	/**
	 * ログイン確認
	 * @return mixed ログインしていればユーザーインスタンスを返す
	 *                 ログインしていなければFALSE
	 */
	static function isLoggedIn() {
		if(	!isset( $_SESSION['email'] ) ){
			return false;
		}
		$userModel = new UserModel();
		$user = $userModel->getByEmail1( $_SESSION['email'] );
		return $user;
	}


	/**
	 * お客様情報登録確認
	 * @return mixed 必須項目である名前、ふりがな、メールアドレス、
	 * 郵便番号、住所、電話番号が入力済みであればユーザーインスタンスを返す、
	 * それ以外はFALSE
	 */
	static function userCheck(){
		$userModel = new UserModel();
		$user = $userModel->getByEmail1( $_SESSION['email'] );
		return !( empty($user->name) || empty($user->furigana) || empty($user->email1) 
			|| empty($user->zipcode) || empty($user->address) || empty($user->tel)
			) ? $user : false;
	}

}