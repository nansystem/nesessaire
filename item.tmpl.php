<?php require_once('header.php') ?>
<section class="contentItem">
	<div class="g400 contentItemLeft">
		<img src="<?= $item->image_url ?>" width="380" alt="">
	</div><!-- /g400 -->
	<div class="g320 contentItemCenter">
		<section>
			<h1><?= $item->item_name ?></h1>
			<h2>価格: <span>￥<?= number_format( $item->list_price ) ?></span> 税込</h2>
		</section>
		<section>
		<h1>アイテム説明</h1>
		<p>
			●限定数量に達し次第、締め切りとなります。<br>

			JULES TOURNIER ET FILSの軽くて暖かい燃えはの記事を使用した、プルオーバーです。後ろはスナップ明きで、パールの飾り釦がついています。後ろ裾がカーブになっているのもポイントです。
		</p>
		</section>
	</div><!-- /g320 -->
	<div class="g240 contentItemRight">
		<form action="cart.php" method="post">
			<input type="hidden" name="action" value="add">
			<input type="hidden" name="item_id" value="<?= $item->item_id ?>">
			<input type="hidden" name="ticket" value="<?= $ticket ?>">
			<div class="form-group">
				<label for="color">色：</label>
				<select name="color" id="color">
					<option value="">青</option>
					<option value="">白</option>
					<option value="">ピンク</option>
				</select>
			</div><!-- /form-group -->
			<input class="btn btn-primary" type="submit" value="カートへ入れる">
		</form>
		<input class="btn btn-default" type="button" value="お気に入りに追加">
	</div><!-- /g240 -->
</section>
<?php require_once('footer.php') ?>