<?php require_once('header.php') ?>
<section class="content">
	<section class="contentMainVisual clearfix">
		<!-- <ul class="contentMainVisualList"> -->
		<div class="g640 alpha">
			<div id="carousel-example-generic" class="carousel slide carousel-fade" data-ride="carousel">
			  <!-- Indicators -->
			  <ol class="carousel-indicators">
			    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
			  	<?php for ($i=1; $i < count($mainVisuals) / 2; $i++): ?>
			    <li data-target="#carousel-example-generic" data-slide-to="<?=$i?>"></li>
			  	<?php endfor ?>
			  </ol>

			  <!-- Wrapper for slides -->
			  <div class="carousel-inner">
			  	<?php for ($j=0; $j < count($mainVisuals); $j = $j + 2): ?>  
			    <div class="item <?php if( $j === 0 ) echo 'active' ?>">
			      <a href="product.php?product_id=<?=$mainVisuals[$j]->product_id?>"><img src="imageResize.php?url=<?= $mainVisuals[$j]->image_url ?>&width=320&height=451" alt="<?=$mainVisuals[$j]->product_name?>"></a>
			      <a href="product.php?product_id=<?=$mainVisuals[$j + 1]->product_id?>"><img src="imageResize.php?url=<?= $mainVisuals[$j+1]->image_url ?>&width=320&height=451" alt="<?=$mainVisuals[$j+1]->product_name?>"></a>
			    </div>
			  	<?php endfor ?>
			  </div><!-- /carousel-inner -->

			  <!-- Controls -->
			  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
			    <i class="fa fa-chevron-left glyphicon-chevron-left"></i>
			  </a>
			  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
			    <i class="fa fa-chevron-right glyphicon-chevron-right"></i>
			  </a>
			</div><!-- /carousel-example-generic -->
		</div><!-- /g640 -->
		<div class="g320 omega">
			<ul class="contentMainVisualSubList">
				<li>
					<a href="product.php?product_id=<?= $mainVisual3->product_id ?>">
						<img src="imageResize.php?url=<?= $mainVisual3->image_url ?>&width=320&height=216" alt="<?=$mainVisual3->product_name?>">
						<p><span>accessory</span></p>
					</a>
				</li>
				<li>
					<a href="product.php?product_id=<?= $mainVisual4->product_id ?>"><img src="imageResize.php?url=<?= $mainVisual4->image_url ?>&width=320&height=216" alt="<?=$mainVisual4->product_name?>"></a>
					<p><span>bag</span></p>
				</li>
			</ul>				
		</div><!-- /g320 -->
	</section><!-- /contentMainVisual -->

	<section class="contentInner">
		<?php require_once('sidebar.tmpl.php') ?>
		<section class="g800 omega">
			<div class="contentInnerMain">
				<section class="contentInnerMainNewItems clearfix">
					<h1>New Arrivals<span>新着アイテム</span></h1>
					<?php foreach($products as $key => $product) : ?>
						<?php if( $key % 5 === 0 ): ?>
						<dl class="g160 alpha">					
						<?php else: ?>
						<dl class="g160">					
						<?php endif ?>
							<dt>
								<a href="product.php?product_id=<?= $product->product_id ?>"><img src="<?= $product->image_url ?>" width="140" height="187" /></a>
							</dt>
							<dd><?= $product->product_name ?></dd>
							<dd><span>￥<?= number_format( $product->list_price ) ?></span></dd>
						</dl>
					<?php endforeach; ?>
				</section><!-- /contentInnerMain -->
				<section class="contentInnerMainRankingItems clearfix">
					<h1>Ranking<span>ランキング</span></h1>
					<ul class="contentInnerMainRankingItemsList">
						<li class="g240">
							<h2>トップス</h2>
							<dl>
								<dt>
									No.1
									<a href="product.php?product_id=<?= $topsCategoryProducts[0]->product_id ?>"><img src="imageResize.php?url=<?= $topsCategoryProducts[0]->image_url ?>&width=240&height=338" alt="<?= $topsCategoryProducts[0]->product_name ?>" /></a>
								</dt>
								<dd><?= $topsCategoryProducts[0]->product_name ?></dd>
								<dd><span>￥<?= number_format( $topsCategoryProducts[0]->list_price ) ?></span></dd>
							</dl>
							<div class="contentInnerMainRankingItemsListSubDl">							
								<dl class="contentInnerMainRankingItemsListSubDl1">
									<dt>
										No.2
										<a href="product.php?product_id=<?= $topsCategoryProducts[1]->product_id ?>"><img src="imageResize.php?url=<?= $topsCategoryProducts[1]->image_url ?>&width=110&height=155" alt="<?= $topsCategoryProducts[1]->product_name ?>" /></a>
									</dt>
									<dd><?= $topsCategoryProducts[1]->product_name ?></dd>
									<dd><span>￥<?= number_format( $topsCategoryProducts[1]->list_price ) ?></span></dd>
								</dl>
								<dl class="contentInnerMainRankingItemsListSubDl2">
									<dt>
										No.3
										<a href="product.php?product_id=<?= $topsCategoryProducts[2]->product_id ?>"><img src="imageResize.php?url=<?= $topsCategoryProducts[2]->image_url ?>&width=110&height=155" alt="<?= $topsCategoryProducts[2]->product_name ?>" /></a>
									</dt>
									<dd><?= $topsCategoryProducts[2]->product_name ?></dd>
									<dd><span>￥<?= number_format( $topsCategoryProducts[2]->list_price ) ?></span></dd>
								</dl>
							</div><!-- /contentInnerMainRankingItemsListSubDl -->
						</li>
						<li class="g240">
							<h2>ジャケット・アウター</h2>
							<dl>
								<dt>
									No.1
									<a href="product.php?product_id=<?= $jacketCategoryProducts[0]->product_id ?>"><img src="imageResize.php?url=<?= $jacketCategoryProducts[0]->image_url ?>&width=240&height=338" alt="<?= $jacketCategoryProducts[0]->product_name ?>" /></a>
								</dt>
								<dd><?= $jacketCategoryProducts[0]->product_name ?></dd>
								<dd><span>￥<?= number_format( $jacketCategoryProducts[0]->list_price ) ?></span></dd>
							</dl>
							<div class="contentInnerMainRankingItemsListSubDl">							
								<dl class="contentInnerMainRankingItemsListSubDl1">
									<dt>
										No.2
										<a href="product.php?product_id=<?= $jacketCategoryProducts[1]->product_id ?>"><img src="imageResize.php?url=<?= $jacketCategoryProducts[1]->image_url ?>&width=110&height=155" alt="<?= $jacketCategoryProducts[1]->product_name ?>" /></a>
									</dt>
									<dd><?= $jacketCategoryProducts[1]->product_name ?></dd>
									<dd><span>￥<?= number_format( $jacketCategoryProducts[1]->list_price ) ?></span></dd>
								</dl>
								<dl class="contentInnerMainRankingItemsListSubDl2">
									<dt>
										No.3
										<a href="product.php?product_id=<?= $jacketCategoryProducts[2]->product_id ?>"><img src="imageResize.php?url=<?= $jacketCategoryProducts[2]->image_url ?>&width=110&height=155" alt="<?= $jacketCategoryProducts[2]->product_name ?>" /></a>
									</dt>
									<dd><?= $jacketCategoryProducts[2]->product_name ?></dd>
									<dd><span>￥<?= number_format( $jacketCategoryProducts[2]->list_price ) ?></span></dd>
								</dl>
							</div><!-- /contentInnerMainRankingItemsListSubDl -->
						</li>
						<li class="g240">
							<h2>アクセサリー</h2>
							<dl>
								<dt>
									No.1
									<a href="product.php?product_id=<?= $accessoryCategoryProducts[0]->product_id ?>"><img src="imageResize.php?url=<?= $accessoryCategoryProducts[0]->image_url ?>&width=240&height=338" alt="<?= $accessoryCategoryProducts[0]->product_name ?>" /></a>
								</dt>
								<dd><?= $accessoryCategoryProducts[0]->product_name ?></dd>
								<dd><span>￥<?= number_format( $accessoryCategoryProducts[0]->list_price ) ?></span></dd>
							</dl>
							<div class="contentInnerMainRankingItemsListSubDl">							
								<dl class="contentInnerMainRankingItemsListSubDl1">
									<dt>
										No.2
										<a href="product.php?product_id=<?= $accessoryCategoryProducts[1]->product_id ?>"><img src="imageResize.php?url=<?= $accessoryCategoryProducts[1]->image_url ?>&width=110&height=155" alt="<?= $accessoryCategoryProducts[1]->product_name ?>" /></a>
									</dt>
									<dd><?= $accessoryCategoryProducts[1]->product_name ?></dd>
									<dd><span>￥<?= number_format( $accessoryCategoryProducts[1]->list_price ) ?></span></dd>
								</dl>
								<dl class="contentInnerMainRankingItemsListSubDl2">
									<dt>
										No.3
										<a href="product.php?product_id=<?= $accessoryCategoryProducts[2]->product_id ?>"><img src="imageResize.php?url=<?= $accessoryCategoryProducts[2]->image_url ?>&width=110&height=155" alt="<?= $accessoryCategoryProducts[2]->product_name ?>" /></a>
									</dt>
									<dd><?= $accessoryCategoryProducts[2]->product_name ?></dd>
									<dd><span>￥<?= number_format( $accessoryCategoryProducts[2]->list_price ) ?></span></dd>
								</dl>
							</div><!-- /contentInnerMainRankingItemsListSubDl -->
						</li>
					</ul>
				</section>
<!-- 				<section class="contentInnerMainCategories clearfix">
					<h1>カテゴリー</h1>
				</section> -->
			</div><!-- /contentInnerMain -->
		</section>
	</section><!-- /contentInner -->
</section><!-- content -->
<?php require_once('footer.php') ?>
