<?php require_once('headerOrder.php') ?>
<section class="g960 contentOrderConfirm">
	<h1>注文内容の確認</h1>
	<hr>
	<form class="contentItemRightNextForm" action="complete.php" method="post">
		<div class="g720 alpha">
			<ul class="contentOrderConfirmList">
				<li class="clearfix">
					<div class="g160 alpha">
						<h2>お届け先 <a href="#">変更</a></h2>
					</div><!-- /g160 -->
					<div class="g560">
						<ul class="contentOrderConfirmListUserList">
							<li><?= $user->name ?>様</li>
							<li>〒<?= $user->zipcode ?></li>
							<li><?= $user->address ?></li>
						</ul>
					</div><!-- /g560 -->
				</li>
				<li class="clearfix">
					<div class="g160 alpha">
						<h2>お支払い方法</h2>
					</div><!-- /g160 -->
					<div class="g560">
						<label for="cod">
							<input id="cod" type="radio" name="pay" value="cod" checked>
							代引き
						</label>
						<label for="credit">
							<input id="credit" type="radio" name="pay" value="credit" >
							クレジットカード
						</label>
					</div><!-- /g560 -->
				</li>
				<li class="clearfix">
					<div class="g160 alpha">
						<h2>受け取り日時</h2>				
					</div><!-- /g160 -->
					<div class="g560">
			     		<p><?=date('Y/m/d', strtotime($shippingDate) )?></p>				
					</div><!-- /g560 -->
				</li>
				<?php foreach ($items as $item): ?>	
				<li class="clearfix">
					<div class="g160 alpha">
						<h2>商品</h2>				
					</div><!-- /g160 -->
					<div class="g560 clearfix">
						<div class="g120 alpha">
							<img src="<?= $item->image_url ?>" width="100" alt="">
						</div><!-- /g120 -->
						<div class="g200">
							<ul class="contentOrderConfirmListItemList">
								<div class="contentOrderConfirmListItemListInner">
									<li><?=$item->product_name?></li>
									<li>カラー:<?=$item->color_name?></li>					
									<li>サイズ:<?=$item->size_name?></li>
								</div><!-- /contentOrderConfirmListItemListInner -->
							</ul>
						</div><!-- /g200 -->
						<div class="g120">
							<?=moneyFormat( $item->list_price )?>
						</div><!-- /g120 -->
						<div class="g120">
							<?= $item->quantity ?>個
						</div><!-- /g120 -->					
					</div><!-- /g560 -->
				</li>
				<?php endforeach ?>					
			</ul>
		</div><!-- /g720 -->
		<div class="g240 contentItemRight">
				<input class="btn btn-primary" type="submit" value="注文を確定する">
				<ul class="contentItemRightNextFormList">
					<li>商品合計<span><?=moneyFormat($productTotal)?></span></li>
					<li>配送料<span><?=moneyFormat($deliveryFee)?></span></li>
					<li>代引手数料<span><?=moneyFormat($cashOnDeliveryFee)?></span></li>
					<li class="contentItemRightNextFormListSumTotal">合計<span><?=moneyFormat($sumTotal)?></span></li>
				</ul>
		</div><!-- /g240 -->
	</form>
</section>
<?php require_once('footerLogin.php') ?>