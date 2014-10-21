<?php require_once('header.php') ?>
<section class="g960 contentCart">
	<h1>ショッピングカート</h1>
	<hr>
	<?php if( empty($items) ): ?>
	<div class="contentCartEmpty">
		<p class="contentCartEmptyMessage">カートに商品は入っていません。</p>
		<p><a class="btn btn-primary" href="index.php">ショッピングを続ける</a></p>
	</div><!-- /contentCartEmpty -->
	<?php else: ?>
	<div class="g720 alpha">
		<ul class="contentCartList">
		<?php foreach($items as $item): ?>
			<li class="clearfix">
				<ul class="contentCartInnerList">

					<li class="g120 alpha"><img src="imageResize.php?url=<?= $item->image_url ?>&width=100&height=141" alt="<?= $item->product_name ?>" /></li>
					<li class="g240">
						<ul class="contentCartInnerListItemInfoList">
							<div class="contentCartInnerListItemInfoListInner">
								<li><?=$item->product_name?></li>					
								<li>カラー:<?=$item->color_name?></li>					
								<li>サイズ:<?=$item->size_name?></li>								
							</div><!-- /contentCartInnerListItemInfoListInner -->
						</ul>
						<form class="contentCartInnerListDeleteForm" action="" method="post">
							<input type="hidden" name="action" value="remove">
							<input type="hidden" name="item_id" value="<?= $item->item_id ?>">
							<input type="hidden" name="ticket" value="<?= $ticket ?>">
							<input type="submit" value="削除">
						</form>
					</li>
					<li class="g160"><?= moneyFormat( $item->list_price ) ?></li>
					<li class="g200 omega">数量：<?= $item->quantity ?></li>
				</ul>
			</li>
		<?php endforeach ?>
		</ul>
	</div><!-- g720 -->
	<div class="g240 contentItemRight">
		<form class="contentItemRightNextForm" action="order.php"　action="post">
			<input type="hidden" value="">
			<input class="btn btn-primary" type="submit" value="レジへ進む">
			<ul class="contentItemRightNextFormList">
				<li>商品合計<span><?=moneyFormat($productTotal)?></span></li>
				<li>配送料<span><?=moneyFormat($deliveryFee)?></span></li>
				<li class="contentItemRightNextFormListSumTotal">合計<span><?=moneyFormat($sumTotal)?></span></li>
			</ul>
		</form>
	</div><!-- /g240 -->

	<?php endif ?>
</section>
<?php require_once('footer.php') ?>