<?php require_once('header.php') ?>
<section class="contentSearch">
	<?php require_once('sidebar.tmpl.php') ?>
	<section class="contentSearchResult g800 omega">
		<h1>"<?=h($serachWord)?>"の検索結果</h1>
		<?php if ( empty( $products ) ): ?>
			<p>該当商品0件</p>
			<p>ご希望の条件を選択してください。</p>
			<p><a href="index.php">トップに戻る</a></p>
		<?php else: ?>
		<?php foreach($products as $key => $product) : ?>			
			<?php if( $key % 5 === 0 ) echo '<div class="clearfix">' ?>
				<dl class="g160<?php if( $key % 5 === 0 ) echo ' alpha' ?>">					
					<dt>
						<a href="product.php?product_id=<?= $product->product_id ?>"><img src="<?= $product->image_url ?>" width="140" height="187" /></a>
					</dt>
					<dd><?= $product->product_name ?></dd>
					<dd><span>￥<?= number_format( $product->list_price ) ?></span></dd>
				</dl>
			<?php if( $key % 5 === 4 ) echo '</div><!-- /clearfix -->' ?>
		<?php endforeach; ?>
		<?php endif ?>
	</section><!-- /contentSearchResult -->

</section><!-- /contentSearch -->
<?php require_once('footer.php') ?>
