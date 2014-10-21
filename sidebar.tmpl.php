<aside class="g160 alpha">
	<div class="contentInnerSide">			
		<nav>
			<dl>
				<dt>一覧</dt>
				<dd><a href="search.php">すべて</a></dd>
				<!-- <dd><a href="#">新着から探す</a></dd> -->
				<!-- <dd><a href="#">ランキングから探す</a></dd> -->

				<dt>カテゴリ</dt>
				<?php foreach ($childCategories as $childCategory): ?>
					<dd><a href="search.php?category_id=<?=$childCategory->category_id?>"><?=$childCategory->category_name?></a></dd>					
				<?php endforeach ?>

				<dt>フリーワード検索</dt>
				<form id="searchForm" class="contentInnerSideForm" action="search.php">
					<dd>
						<input id="keyword" name="keyword" type="text" placeholder="ドット柄" value="<?=v('keyword')?>">
						<button type="submit" name="keywordSubmit" class="btn btn-primary">
			                <i class="fa fa-search"></i>
			            </button>
					</dd>	
				</form>

			</dl>
		</nav>
	</div><!-- /contentInnerSide -->
</aside>