<?php require_once('header.php') ?>
<section class="contentOrderHistory">
<h1>注文履歴</h1>
<ul class="contentOrderHistoryList">
<?php foreach ($orders as $order): ?>
	<?php $orderDetails = $orderDetailModel->getByOrderId($order->order_id) ?>
	<?php if($orderDetails): ?>
	<li class="clearfix">
		<div class="g200 alpha">
			<ul class="contentOrderHistoryListLeftList">
				<li><?=$order->order_date?></li>
				<li>注文番号 <span><?=$order->order_id?></span></li>
				<li>受取人 <?=$order->shipping_name?></li>
				<li>合計 <?=moneyFormat($order->sum_total)?></li>
			</ul>
		</div><!-- g200 -->
		<?php foreach ( $orderDetails as $key => $orderDetail ): ?>
		<div class="contentOrderHistoryListLeftListItem g760<?php if($key > 0) echo ' ml200'?>">
			<dl>
				<dt class="g120 alpha"><img src="imageResize.php?url=<?= $orderDetail->image_url ?>&width=100&height=141" alt="<?= $orderDetail->product_name ?>" width="100" /></dt>
				<div class="g600">
					<dd><?=$orderDetail->product_name?></dd>
					<dd>カラー：<?=$orderDetail->color_name?></dd>
					<dd>サイズ：<?=$orderDetail->size_name?></dd>
					<dd>数量:<?=$orderDetail->quantity?></dd>
					<dd>価格:<?=moneyFormat($orderDetail->sale_price)?></dd>
				</div><!-- /g600 -->
			</dl>
		</div><!-- g680 -->							
		<?php endforeach ?>
	</li>
	<?php endif ?>
<?php endforeach ?>
</ul>
</section><!-- contentOrderHistory -->
<?php require_once('footer.php') ?>
