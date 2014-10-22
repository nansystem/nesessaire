<?php
require_once __DIR__ . '/vendor/autoload.php';

use Respect\Validation\Validator as v;
session_set_cookie_params(365 * 24 * 3600);
session_start();

function emailExists( $email ){
	$userModel = new UserModel();
	return $userModel->emailExists($email);
}

function emailNotExists( $email ){
	$userModel = new UserModel();
	return !$userModel->emailExists($email);
}

$errors = [];
if($_SERVER['REQUEST_METHOD'] === 'POST'){
	if( $_POST['action'] === 'login' ) {
		$loginValidator  = v::key('email', v::notEmpty()->setName('emailEmpty')->setTemplate('メールアドレスを入力してください') )
	  					->key('email', v::email()->setName('emailValid')->setTemplate('無効なメールアドレス形式です。正しいメールアドレスを入力してください') )
						->key('email', v::callback('emailExists')->setName('emailNotExists')->setTemplate('登録されていないメールアドレスが入力されています') )
	                    ->key('password', v::notEmpty()->setName('passwordEmpty')->setTemplate('パスワードを入力してください') );


		try {
		    $loginValidator->assert( $_POST );
		} catch(\InvalidArgumentException $e) {
		    $errors = $e->findMessages(['emailEmpty', 'emailValid', 'emailNotExists',
		    							'passwordEmpty']);
		}

		if( empty( $errors ) ){
			$userModel = new UserModel();
			if( $userModel->validatePassword($_POST['email'], $_POST['password']) ){
				$_SESSION['email'] = $_POST['email'];
				$redirect = isset( $_POST['redirect'] ) ? $_POST['redirect'] : 'index.php';
				header("Location: $redirect");
				exit();
			} else {
				$errors['validatePassword'] = 'メールアドレスまたはパスワードが間違っています。再度ご入力ください';
			}
		}

	} elseif ( $_POST['action'] === 'register' ) {
		$registerValidator  = v::key('email', v::notEmpty()->setName('emailEmpty')->setTemplate('メールアドレスを入力してください') )
	  					->key('email', v::email()->setName('emailValid')->setTemplate('無効なメールアドレス形式です。正しいメールアドレスを入力してください') )
						->key('email', v::callback('emailNotExists')->setName('emailExists')->setTemplate('メールアドレスはすでに使用されています') )
	                    ->key('password', v::notEmpty()->setName('passwordEmpty')->setTemplate('パスワードを入力してください') )
	                    ->key('password', v::length(8, null)->setName('passwordMin')->setTemplate('パスワードは8文字以上で入力してください') )
	                    ->key('password', v::length(null, 64)->setName('passwordMax')->setTemplate('パスワードは64文字以内で入力してください') )
	                    ->key('password', v::callback('mixedAlphanumeric')->setName('passwordMixedAlphanumeric')->setTemplate('パスワードは英字と数字を混ぜてください') );
		try {
		    $registerValidator->assert( $_POST );
		} catch(\InvalidArgumentException $e) {
		    $errors = $e->findMessages(['emailEmpty', 'emailValid', 'emailExists',
		    							'passwordEmpty', 'passwordMin', 'passwordMax', 'passwordMixedAlphanumeric']);
		}

		if( $registerValidator->validate( $_POST ) ) {
			$userModel = new UserModel();
			$user_id = $userModel->insertEmailAndPassword(
				[
					'email1' => $_POST['email'],
					'password' => $_POST['password']
				]);

			$_SESSION['email'] = $_POST['email'];
			$_SESSION['user_id'] = $user_id;
			$redirect = isset( $_POST['redirect'] ) ? $_POST['redirect'] : 'index.php';
			header("Location: $redirect");
			exit();
		}

	}

}

require_once("login.tmpl.php");