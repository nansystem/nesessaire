<?php require_once('headerLogin.php') ?>
<section class="contentRegister">
  <div class="g720 alpha">
  	<h1>お届け先住所の確認</h1>
  	<p>お届け先住所を確認後、一番下の「次へ」ボタンをクリックしてください。</p>
	<form action="" method="post" id="contentRegisterForm" class="form-horizontal" role="form">
		<div class="form-group clearfix">
			<div class="clearfix">			
				<label for="name" class="g160 alpha control-label">お名前</label>
				<div class="g240">
					<p class="name form-control-static" ><?= $_SESSION['name'] ?></p>
				</div><!-- /g240 -->
			</div><!-- /clearfix -->

		</div><!-- /form-group -->
		<div class="form-group clearfix">
			<div class="clearfix">			
				<label for="furigana" class="g160 alpha control-label">お名前(フリガナ)</label>
				<div class="g240">
					<p class="furigana form-control-static" ><?= $_SESSION['furigana'] ?></p>
				</div><!-- /g240 -->
			</div><!-- /clearfix -->
		</div><!-- /form-group -->
		<div class="form-group clearfix">
			<label for="sex" class="g160 alpha control-label">性別</label>
			<div class="g240">
				<?php if ($_SESSION['furigana'] === "1"): ?>
					<p class="sex form-control-static" >女</p>
				<?php else: ?>
					<p class="sex form-control-static" >男</p>					
				<?php endif ?>
			</div><!-- /g240 -->
		</div><!-- /form-group -->
		<div class="form-group clearfix">
			<div class="clearfix">
				<label for="zipcode" class="g160 alpha control-label">郵便番号</label>
				<div class="g160">
					<p class="zipcode form-control-static" ><?= $_SESSION['zipcode'] ?></p>					
				</div><!-- /g160 -->
			</div><!-- /clearfix -->
		</div><!-- /form-group -->
		<div class="form-group clearfix">
			<label for="xmpf" class="g160 alpha control-label">都道府県</label>
			<div class="g280">
				<p class="xmpf form-control-static" ><?= xmpf()[$_SESSION['xmpf']] ?></p>					
			</div><!-- g240 -->
		</div><!-- /form-group -->
		<div class="form-group clearfix">
			<label for="address" class="g160 alpha control-label">住所</label>
			<div class="g480">
				<p class="address form-control-static" ><?= $_SESSION['address'] ?></p>					
			</div><!-- g400 -->
		</div><!-- /form-group -->
		<div class="form-group clearfix">
			<div class="clearfix">
				<label for="tel" class="control-label g160 alpha">電話番号</label>
				<div class="g240">
					<p class="tel form-control-static" ><?= $_SESSION['tel'] ?></p>					
				</div><!-- /g240 -->				
			</div><!-- /clearfix -->
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