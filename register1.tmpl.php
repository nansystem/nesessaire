<?php require_once('headerLogin.php') ?>
<section class="contentRegister">
  <div class="g720 alpha">    
  	<h1>お届け先住所の登録</h1>
  	<p>下記フォームにお届け先住所を入力後、一番下の「次へ」ボタンをクリックしてください。</p>
	<p class="contentRegisterRequire">すべて入力必須項目です。</p>
	<form action="" method="post" id="contentRegisterForm" class="form-horizontal" role="form">
		<div class="form-group clearfix">
			<div class="clearfix">			
				<label for="name" class="g160 alpha control-label">お名前</label>
				<div class="g240">
					<input type="text" id="name" name="name" class="name form-control" placeholder="例)根瀬千愛"  value="<?php v('name') ?>">
				</div><!-- /g240 -->
			</div><!-- /clearfix -->
			<div class="ml160">
				<?php	// 名前のバリデーションメッセージ
				if( !empty($errors['nameEmpty']) ){
					echo "<div class='error' >{$errors['nameEmpty']}</div>";
				} elseif( !empty($errors['nameMax']) ) {
					echo "<div class='error' >{$errors['nameMax']}</div>";
				} ?>				
			</div><!-- /ml240 -->

		</div><!-- /form-group -->
		<div class="form-group clearfix">
			<div class="clearfix">			
				<label for="furigana" class="g160 alpha control-label">お名前(フリガナ)</label>
				<div class="g240">
					<input type="text" id="furigana" name="furigana" class="furigana form-control" placeholder="例)ネセセア"  value="<?php v('furigana') ?>">
				</div><!-- /g240 -->
			</div><!-- /clearfix -->
			<div class="ml160">				
				<?php	// 名前（フリガナ）のバリデーションメッセージ
				if( !empty($errors['furiganaEmpty']) ){
					echo "<div class='error' >{$errors['furiganaEmpty']}</div>";
				} elseif( !empty($errors['furiganaMax']) ) {
					echo "<div class='error' >{$errors['furiganaMax']}</div>";
				} ?>
			</div><!-- /ml160 -->
		</div><!-- /form-group -->
		<div class="form-group clearfix">
			<label for="sex" class="g160 alpha control-label">性別</label>
			<div class="g240">			
				<label for="woman" class="radio-inline">
					<input type="radio" name="sex" value="1" id="woman" checked class="sex">女
				</label>
				<label for="man" class="radio-inline">
					<input type="radio" name="sex" value="0" id="man" class="sex">男
				</label>
				<?php	// 名前のバリデーションメッセージ
				if( !empty($errors['sex']) ){
					echo "<div class='error' >{$errors['sex']}</div>";
				} ?>
			</div><!-- /g240 -->
		</div><!-- /form-group -->
		<div class="form-group clearfix">
			<div class="clearfix">
				<label for="zipcode" class="g160 alpha control-label">郵便番号</label>
				<div class="g160">
					<input type="text" id="zipcode" name="zipcode" class="zipcode form-control" placeholder="例)1080004" value="<?php v('zipcode') ?>">
				</div><!-- /g160 -->
			</div><!-- /clearfix -->
			<div class="ml160">
			<?php	// 郵便番号のバリデーションメッセージ
			if( !empty($errors['zipcodeEmpty']) ){
				echo "<div class='error' >{$errors['zipcodeEmpty']}</div>";
			} elseif( !empty($errors['zipcodeLength']) ) {
				echo "<div class='error' >{$errors['zipcodeLength']}</div>";
			} ?>
			</div><!-- /ml160 -->
		</div><!-- /form-group -->
		<div class="form-group clearfix">
			<label for="xmpf" class="g160 alpha control-label">都道府県</label>
			<div class="g280">			
				<select name="xmpf" id="xmpf" class="xmpf form-control">
				<?php foreach(xmpf() as $key => $value) :?>
					<option value="<?= $key ?>"><?= $value ?></option>
				<?php endforeach ?>
				</select>
				<?php // 都道府県のバリデーションメッセージ
				if( !empty($errors['xmpfBetween']) ){
					echo "<div class='error' >{$errors['xmpfBetween']}</div>";
				} ?>
			</div><!-- g240 -->
		</div><!-- /form-group -->
		<div class="form-group clearfix">
			<label for="address" class="g160 alpha control-label">住所</label>
			<div class="g480">
				<input type="text" id="address" name="address" class="address form-control" placeholder="例)中央区銀座１－８－８ライオンズマンション８０１" value="<?php v('address') ?>">	
				<?php // 住所のバリデーションメッセージ
				if( !empty($errors['addressEmpty']) ){
					echo "<div class='error' >{$errors['addressEmpty']}</div>";
				} elseif( !empty($errors['addressLength']) ) {
					echo "<div class='error' >{$errors['addressLength']}</div>";
				} ?>
			</div><!-- g400 -->
		</div><!-- /form-group -->
		<div class="form-group clearfix">
			<div class="clearfix">
				<label for="tel" class="control-label g160 alpha">電話番号</label>
				<div class="g240">
					<input type="text" id="tel" name="tel" class="tel form-control" placeholder="例)09012345678"  value="<?php v('tel') ?>">
				</div><!-- /g240 -->				
			</div><!-- /clearfix -->
			<div class="ml160">
			<?php	// 電話番号のバリデーションメッセージ
			if( !empty($errors['telEmpty']) ){
				echo "<div class='error' >{$errors['telEmpty']}</div>";
			} elseif( !empty($errors['telMin']) ) {
				echo "<div class='error' >{$errors['telMin']}</div>";
			} elseif( !empty($errors['telMax']) ) {
				echo "<div class='error' >{$errors['telMax']}</div>";
			} ?>
			</div><!-- /ml160 -->
		</div><!-- /form-group -->
		<div class="form-group">
			<div class="ml140">
				<div class="g240">
					<input type="submit" value="次へ" class="btn btn-primary">		
				</div><!-- /g240 -->
			</div><!-- ml140 -->			
		</div><!-- /form-group -->
	</form>
  </div><!-- /g720 -->
</section><!-- contentLogin -->
<?php require_once('footerLogin.php') ?>