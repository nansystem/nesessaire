<?php
require_once('../vendor/autoload.php');
require_once('../lib.php');
use Respect\Validation\Validator as v;

/**
 * 英数混在であることをチェックする
 * @param  string $data チェック対象の文字列
 * @return bool       true:英数混在である, false:英数混在ではない
 */
function mixedAlphanumeric($data)
{
	return preg_match("/[0-9].*[a-zA-Z]|[a-zA-Z].*[0-9]/s", $data);
}

/**
 * メールアドレスの重複登録をチェックする
 * @param  string $email チェック対象のメールアドレス
 * @return bool        true:重複していない, false:重複している
 */
function emailExists( $email ){
	return true;
}

/**
 * 全角を半角にし、0-9のみの文字列を返却する
 * @param  string $phone 変換対象の文字列
 * @return string        数字のみの文字列
 */
function convertNumber( $number ){
	$convertedPhone = mb_convert_kana( trim( $number ) , "a", "UTF-8");
	return preg_replace('/[^0-9]/u', '', $convertedPhone);
}

$errors = [];
if( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
  	$validator  = v::key('name', v::notEmpty()->setName('nameEmpty')->setTemplate('お名前を入力してください') )
                    ->key('name', v::string()->length(null, 16)->setName('nameMax')->setTemplate('お名前は16文字以内で入力してください') )
                    ->key('zipcode', v::notEmpty()->setName('zipcodeEmpty')->setTemplate('郵便番号を入力してください') )
                    ->key('zipcode', v::int()->length(7, 7)->setName('zipcodeLength')->setTemplate('郵便番号は7けたの半角数字を入力してください') )
                    // できたら「正しい郵便番号を入力してください。」を追加する
                    ->key('xmpf', v::int()->between(1, 47)->setName('xmpfBetween')->setTemplate('都道府県を選択してください') )
                	// できたら「都道府県と郵便番号が一致しません。必要な場合は修正してください」を追加する
                    ->key('address', v::notEmpty()->setName('addressEmpty')->setTemplate('住所を入力してください') )
                    ->key('address', v::string()->length(null, 64)->setName('addressLength')->setTemplate('住所は64文字以内で入力してください') )
                    ->key('tel', v::notEmpty()->setName('telEmpty')->setTemplate('商品のお届けに問題が起きた場合にご連絡できるよう、電話番号を入力してください') )
                    ->key('tel', v::length(9, null)->setName('telMin')->setTemplate('電話番号を全桁入力してください') )
                    ->key('tel', v::length(null, 11)->setName('telMax')->setTemplate('電話番号を正しく入力してください') );
	try {
		$_POST['zipcode'] = convertNumber( $_POST['zipcode'] );
		$_POST['tel'] = convertNumber( $_POST['tel'] );
	    $validator->assert( $_POST );
	} catch(\InvalidArgumentException $e) {
	    $errors = $e->findMessages(['nameEmpty', 'nameMax', 
	    							'zipcodeEmpty', 'zipcodeLength',
	    							'xmpfBetween',
									'addressEmpty', 'addressLength',
									'telEmpty', 'telMin', 'telMax'
	    							]);
	}

	if( !isset($_POST['sex']) ){
		$errors['sex'] = '性別を選択してください';
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
	<style>
		.error {
			color:red;
		}
	</style>
</head>
<body>
<form action="" method="post">
<div class="form-group">
	<label for="name">お名前</label>
	<input type="text" id="name" name="name" class="form-control">
	<?php	// 名前のバリデーションメッセージ
	if( !empty($errors['nameEmpty']) ){
		echo "<div class='error' >{$errors['nameEmpty']}</div>";
	} elseif( !empty($errors['nameMax']) ) {
		echo "<div class='error' >{$errors['nameMax']}</div>";
	} ?>
</div><!-- /form-group -->
<div class="form-group">
<label for="man">
	<input type="radio" name="sex" value="0" id="man">男
</label>
<label for="woman">
	<input type="radio" name="sex" value="1" id="woman">女
</label>
	<?php	// 名前のバリデーションメッセージ
	if( !empty($errors['sex']) ){
		echo "<div class='error' >{$errors['sex']}</div>";
	} ?>
</div><!-- /form-group -->
<div class="form-group">
	<label for="zipcode">郵便番号</label>
	<input type="text" id="zipcode" name="zipcode">
	<?php	// 郵便番号のバリデーションメッセージ
	if( !empty($errors['zipcodeEmpty']) ){
		echo "<div class='error' >{$errors['zipcodeEmpty']}</div>";
	} elseif( !empty($errors['zipcodeLength']) ) {
		echo "<div class='error' >{$errors['zipcodeLength']}</div>";
	} ?>
</div><!-- /form-group -->
<div class="form-group">
	<label for="xmpf">都道府県</label>
	<select name="xmpf" id="xmpf">
	<?php foreach(xmpf() as $key => $value) :?>
		<option value="<?= $key ?>"><?= $value ?></option>
	<?php endforeach ?>
	</select>
	<?php // 都道府県のバリデーションメッセージ
	if( !empty($errors['xmpfBetween']) ){
		echo "<div class='error' >{$errors['xmpfBetween']}</div>";
	} ?>
</div><!-- /form-group -->
<div class="form-group">
	<label for="address">住所</label>
	<input type="text" id="address" name="address">	
	<?php // 住所のバリデーションメッセージ
	if( !empty($errors['addressEmpty']) ){
		echo "<div class='error' >{$errors['addressEmpty']}</div>";
	} elseif( !empty($errors['addressLength']) ) {
		echo "<div class='error' >{$errors['addressLength']}</div>";
	} ?>
</div><!-- /form-group -->
<div class="form-group">
	<label for="tel">電話番号</label>
	<input type="text" id="tel" name="tel">
	<?php	// 電話番号のバリデーションメッセージ
	if( !empty($errors['telEmpty']) ){
		echo "<div class='error' >{$errors['telEmpty']}</div>";
	} elseif( !empty($errors['telMin']) ) {
		echo "<div class='error' >{$errors['telMin']}</div>";
	} elseif( !empty($errors['telMax']) ) {
		echo "<div class='error' >{$errors['telMax']}</div>";
	} ?>
</div><!-- /form-group -->
<input type="submit" value="送信">
</form>
</body>
</html>
