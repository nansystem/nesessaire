<?php
require_once('passwordHash.php');


/**
 * リクエスト情報に値がセットされている場合は、その値を返却する。
 * 値がセットされていない場合は第二引数で指定した値を返却する。
 * 第二引数になにも指定していない場合はnullを返却する。
 * @param  string $key     リクエストのキー
 * @param  string $default キーがセットされていない場合の値(任意)
 * @return string          キーの値
 */
function getRequest($key, $default = null){
	if( isset($_REQUEST[$key] ) ){
		return $_REQUEST[$key];
	} else {
		return $default;
	}
}


/**
* htmlspecialcharsの略記
* < > & ' " の5つをエスケープする
*/
function h($str){
	return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}


/**
 * 入力チェックでエラーの場合に、前回入力した値を出力する
 */
function v($key){
	if( !empty($_REQUEST[$key]) ) echo h($_REQUEST[$key]);
}


/**
 * 都道府県の配列を返す
 * @return array 都道府県の配列
 */
function xmpf() {
	// $pref = array(,'北海道','青森県','岩手県','宮城県','秋田県','山形県','福島県','茨城県','栃木県','群馬県','埼玉県','千葉県','東京都','神奈川県','新潟県','富山県','石川県','福井県','山梨県','長野県','岐阜県','静岡県','愛知県','三重県','滋賀県','京都府','大阪府','兵庫県','奈良県','和歌山県','鳥取県','島根県','岡山県','広島県','山口県','徳島県','香川県','愛媛県','高知県','福岡県','佐賀県','長崎県','熊本県','大分県','宮崎県','鹿児島県','沖縄県');
	return array('0'=>'都道府県を指定してください','1'=>'北海道','2'=>'青森県','3'=>'岩手県','4'=>'宮城県','5'=>'秋田県','6'=>'山形県','7'=>'福島県','8'=>'茨城県','9'=>'栃木県','10'=>'群馬県','11'=>'埼玉県','12'=>'千葉県','13'=>'東京都','14'=>'神奈川県','15'=>'新潟県','16'=>'富山県','17'=>'石川県','18'=>'福井県','19'=>'山梨県','20'=>'長野県','21'=>'岐阜県','22'=>'静岡県','23'=>'愛知県','24'=>'三重県','25'=>'滋賀県','26'=>'京都府','27'=>'大阪府','28'=>'兵庫県','29'=>'奈良県','30'=>'和歌山県','31'=>'鳥取県','32'=>'島根県','33'=>'岡山県','34'=>'広島県','35'=>'山口県','36'=>'徳島県','37'=>'香川県','38'=>'愛媛県','39'=>'高知県','40'=>'福岡県','41'=>'佐賀県','42'=>'長崎県','43'=>'熊本県','44'=>'大分県','45'=>'宮崎県','46'=>'鹿児島県','47'=>'沖縄県');
}


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
 * 全角を半角にし、0-9のみの文字列を返却する
 * @param  string $phone 変換対象の文字列
 * @return string        数字のみの文字列
 */
function convertNumber( $number ){
	$convertedPhone = mb_convert_kana( trim( $number ) , "a", "UTF-8");
	return preg_replace('/[^0-9]/u', '', $convertedPhone);
}


/**
 * 数値を3桁のカンマ区切りにして、先頭に￥マークを追加する
 * @param  integer $money 金額
 * @return string         3桁区切りの金額
 */
function moneyFormat( $money ){
	return '&yen;' . number_format( $money );
}