<?php
require_once 'passwordHash.php';
require_once 'database.php';
class UserModel extends Database{

	private $table = "users";

	public function getById(){
		return parent::get($this->table);
	}

	public function getByEmail1( $email1 ){
		return $this->query("SELECT * FROM users WHERE email1 = :email1 LIMIT 1"
							,[":email1" => $email1])[0];
	}

	public function insertEmailAndPassword( $bindings ){
		$stmt = $this->conn->prepare("INSERT INTO {$this->table} (email1, password) VALUES (:email1, :password)");
		$stmt->bindParam(':email1', $bindings['email1'] ,PDO::PARAM_STR);
		$stmt->bindParam(':password', create_hash( $bindings['password'] ) ,PDO::PARAM_STR);
		if($stmt->execute()){
			return $this->conn->lastInsertId('user_id');
		}
		return false;
	}


	public function update($bindings){
		$stmt = $this->conn->prepare(
			"UPDATE {$this->table}
			SET name = :name
			, furigana = :furigana
			, sex = :sex
			, tel = :tel
			, zipcode = :zipcode
			, xmpf = :xmpf
			, address = :address
			WHERE email1 = :email1"
			);
		$stmt->bindParam(':email1', $bindings['email1'] ,PDO::PARAM_STR);
		$stmt->bindParam(':name', $bindings['name'] ,PDO::PARAM_STR);
		$stmt->bindParam(':furigana', $bindings['furigana'] ,PDO::PARAM_STR);
		$stmt->bindParam(':sex', $bindings['sex'] ,PDO::PARAM_INT);
		$stmt->bindParam(':tel', $bindings['tel'] ,PDO::PARAM_STR);
		$stmt->bindParam(':zipcode', $bindings['zipcode'] ,PDO::PARAM_STR);
		$stmt->bindParam(':xmpf', $bindings['xmpf'] ,PDO::PARAM_INT);
		$stmt->bindParam(':address', $bindings['address'] ,PDO::PARAM_STR);
		if($stmt->execute()){
			return true;
		}
		return false;
	}


	/**
	 * メールアドレスが登録済みかチェックする
	 * @param  string $email チェック対象のメールアドレス
	 * @return bool        true:登録済み, false:登録されていない
	 */
	public function emailExists( $email ){
		return (bool)$this->getByEmail1( $email );
	}


	/**
	 * パスワードが正しいか検証する
	 * @param  string $email         メールアドレス
	 * @param  string $inputPassword 入力されたパスワード
	 * @return bool                true:パスワードは正しい, false:パスワードが間違っている
	 */
	public function validatePassword( $email, $inputPassword ) {
		if( !$user = $this->getByEmail1( $email ) ){
			return false;
		}
		return validate_password($inputPassword, $user->password);
	}

}