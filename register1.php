<?php
session_start();
require_once("lib.php");
require_once('vendor/autoload.php');
use Respect\Validation\Validator as v;

if($_SERVER['REQUEST_METHOD'] === 'POST'){
	  	$validator  = v::key('name', v::notEmpty()->setName('nameEmpty')->setTemplate('お名前を入力してください') )
                    ->key('name', v::string()->length(null, 16)->setName('nameMax')->setTemplate('お名前は16文字以内で入力してください') )
                    ->key('furigana', v::notEmpty()->setName('furiganaEmpty')->setTemplate('お名前（フリガナ）を入力してください') )
                    ->key('furigana', v::string()->length(null, 16)->setName('furiganaMax')->setTemplate('お名前（フリガナ）は16文字以内で入力してください') )
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
	    							'furiganaEmpty', 'furiganaMax',
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
		$_SESSION = array_merge($_SESSION, $_POST);;
		header('Location: register2.php');
		exit();
	} 

}

require_once("register1.tmpl.php");