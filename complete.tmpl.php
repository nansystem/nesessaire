<?php require_once('header.php') ?>
<section class="contentComplete">
<p>ご注文ありがとうございました。</p>
<?php if(!empty($outOfStockItems)):?>
	<div class="contentCompleteOutofStock">
		<p>なお、下記商品に関しては、ご注文確定前に在庫不足になったため、注文できませんでした。ご了承ください。</p>
		<ul class="contentCompleteOutofStockList">
		<?php foreach ($outOfStockItems as $outOfStockItem): ?>
			<li>
				<ul class="contentCompleteOutofStockListInnerList">
					<li><?=$outOfStockItem->product_name?></li>
					<li>カラー:<?=$outOfStockItem->color_name?></li>
					<li>サイズ:<?=$outOfStockItem->size_name?></li>
					<li><?=$outOfStockItem->quantity?>個</li>
				</ul>
			</li>
		<?php endforeach ?>
		</ul>
	</div><!-- /contentCompleteOutofStock -->
<?php endif	?>
<p><a href="index.php">トップに戻る</a></p>
</section><!-- contentComplete -->
<?php require_once('footer.php') ?>
