<?php require_once('header.php') ?>
<section class="contentItem">
	<div class="g400 contentItemLeft">
		<p class="contentItemLeftMainImg">
		<img id="img_01" src="imageResize.php?url=<?= $product[0]->image_url ?>&width=380&height=536" data-zoom-image="<?= $product[0]->image_url ?>" alt="">
		</p>
		<ul class="subImglist clearfix" id="gallery_01"> 
		<?php foreach ($product as $row): ?>
			<li>
				<a href="#" data-image="imageResize.php?url=<?= $row->image_url ?>&width=380&height=536" data-zoom-image="<?= $row->image_url ?>">
					<img id="img_01" src="imageResize.php?url=<?= $row->image_url ?>&width=58&height=82" /></a>
				<span class="title"><?= $row->img_title ?></span>
			</li>
		<?php endforeach ?>
		</ul><!-- /gallery_01 -->
	</div><!-- /g400 -->
	<div class="g320 contentItemCenter">
		<section>
			<h1><?= $product[0]->product_name ?></h1>
			<h2>価格: <span>￥<?= number_format( $product[0]->list_price ) ?></span> 税込</h2>
		</section>
		<section>
		<h1>アイテム説明</h1>
		<p><?= $product[0]->product_description ?></p>
		</section>
	</div><!-- /g320 -->
	<div class="g240 contentItemRight">
		<form action="cart.php" method="post">
			<input type="hidden" name="action" value="add">
			<!-- <input type="hidden" name="product_id" value="<?= $product[0]->product_id ?>"> -->
			<input type="hidden" name="ticket" value="<?= $ticket ?>">
			<div class="form-group">
				<label for="item_id">サイズ/色/在庫数：</label>
				<select name="item_id" id="item_id" >
				<?php foreach ($stocks as $product): ?>
					<option value="<?= $product->item_id ?>"<?php if( empty($product->quantity) ) echo "disabled" ?> >
						<?=$product->size_name?>/<?=$product->color_name?>/<?php if( empty($product->quantity) ){ echo "在庫なし"; } else { echo $product->quantity;} ?>
					</option>
				<?php endforeach ?>
				</select>
			</div>
			<input class="btn btn-primary" type="submit" value="カートへ入れる">
		</form>
		<input class="btn btn-default" type="button" value="お気に入りに追加">
	</div><!-- /g240 -->
</section>
<?php require_once('footer.php') ?>