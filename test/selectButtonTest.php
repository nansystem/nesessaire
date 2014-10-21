<!-- 
・在庫なしの場合は「カートへ入れるボタン」が押せないようにする
⇒そもそも在庫がない場合はOPITONで選択できないようになっているから、
次ページの値チェックで、在庫があるかチェックすればよい。
もしなければ、エラー表示または初期画面に戻るようにする
 1.初期表示
  (1)在庫あり
  (2)在庫なし
 2.SELECT OPTION変更時
  (1)在庫あり
  (2)在庫なし
 3.在庫なし1件
　-->
<?php 
	var_dump($_POST);
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
</head>
<body>
<form id="testForm" name="testForm" action="selectButtonTest.php" method="post">
	<label for="item_id">色/サイズ/在庫数</label>
	<select name="item_id" id="item_id">
		<option value="1" disabled>赤/S/1</option>
<!-- 		<option value="2" >青/S/1</option>
		<option value="3" >緑/S/1</option>
 -->	</select>
	<input type="submit" value="カートへ入れる">
</form>

</body>
</html>