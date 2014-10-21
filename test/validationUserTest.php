<?php
require_once('../vendor/autoload.php');
use Respect\Validation\Validator as v;

/**
 * 英数混在であることをチェックする
 * @param  [string] $data [チェック対象の文字列]
 * @return [bool]       [true:英数混在である, false:英数混在ではない]
 */
function mixedAlphanumeric($data)
{
	return preg_match("/[0-9].*[a-zA-Z]|[a-zA-Z].*[0-9]/s", $data);
}

/**
 * メールアドレスの重複登録をチェックする
 * @param  [string] $email チェック対象のメールアドレス
 * @return [bool]        [true:重複していない, false:重複している]
 */
function emailExists( $email ){
	return true;
}

if(empty($_POST['agree'])){
	var_dump("agree empty");
}

if( isset($_POST['sex']) ){
	var_dump($_POST['sex']);
}

$errors = [];
if( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
  	$validator  = v::key('email', v::notEmpty()->setName('emailEmpty')->setTemplate('メールアドレスを入力してください') )
  					->key('email', v::email()->setName('emailValid')->setTemplate('無効なメールアドレス形式です。正しいメールアドレスを入力してください') )
					->key('email', v::callback('emailExists')->setName('emailExists')->setTemplate('メールアドレスはすでに使用されています') )
                    ->key('password', v::notEmpty()->setName('passwordEmpty')->setTemplate('パスワードを入力してください') )
                    ->key('password', v::length(8, null)->setName('passwordMin')->setTemplate('パスワードは8文字以上で入力してください') )
                    ->key('password', v::length(null, 9)->setName('passwordMax')->setTemplate('パスワードは64文字以内で入力してください') )
                    ->key('password', v::callback('mixedAlphanumeric')->setName('passwordMixedAlphanumeric')->setTemplate('パスワードは英字と数字を混ぜてください') );

	try {
	    $validator->assert( $_POST );
	} catch(\InvalidArgumentException $e) {
	    $errors = $e->findMessages(['emailEmpty', 'emailValid', 'emailExists',
	    							'passwordEmpty', 'passwordMin', 'passwordMax', 'passwordMixedAlphanumeric']);
	}

	// メールアドレスのバリデーションメッセージ
	if( !empty($errors['emailEmpty']) ){
		echo $errors['emailEmpty'];
	} elseif( !empty($errors['emailValid']) ) {
		echo $errors['emailValid'];
	} elseif( !empty($errors['emailExists']) ){
		echo $errors['emailExists'];
	} 

	// パスワードのバリデーションメッセージ
	if( !empty($errors['passwordEmpty']) ){
		echo $errors['passwordEmpty'];
	} elseif( !empty($errors['passwordMin']) ) {
		echo $errors['passwordMin'];
	} elseif( !empty($errors['passwordMax']) ){
		echo $errors['passwordMax'];
	} elseif( !empty($errors['passwordMixedAlphanumeric']) ){
		echo $errors['passwordMixedAlphanumeric'];
	} 

	if( $validator->validate( $_POST ) ){
		var_dump('create');
	} else {		
		var_dump('retry');
	}

}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form action="" method="post">
<div class="form-group">
<label for="email">email</label>
<input id="email" name="email" type="text">
</div><!-- form-group -->
<div class="form-group">	
<label for="password">password</label>
<input id="password" name="password" type="text">
</div>
<label for="agree">
<input type="checkbox" name="agree" id="agree">同意する
</label>
<div class="form-group">
<label for="man">
	<input type="radio" name="sex" value="0" id="man">男
</label>
<label for="woman">
	<input type="radio" name="sex" value="1" id="woman">女
</label>
</div><!-- /form-group -->
<input type="submit" value="送信">
</form>
</body>
</html>
