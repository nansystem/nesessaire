<?php require_once('header.php') ?>
<section class="contentAccount">
	<h1><?=$user->name?>様の会員情報</h1>
	<hr>
	<aside class="g160 alpha">
		<nav>
			<dl>
				<dt>会員情報の変更</dt>
				<dd><a href="#">会員情報の変更</a></dd>
				<dd><a href="#">お届け先の変更・追加</a></dd>

				<dt>注文履歴</dt>
				<dd><a href="#">注文履歴を見る</a></dd>
			</dl>
		</nav>
	</aside>
	<section class="g800 omega">
		<section class="contentAccountDetail">
			<h1>会員情報の変更</h1>
			<ul class="contentAccountDetailList">
				<li class="clearfix">
					<div class="g160 alpha">お名前</div>
					<div class="g640"><?=$user->name?>(<?=$user->furigana?>)</div>
				</li>
				<li class="clearfix">
					<div class="g160 alpha">メールアドレス</div>
					<div class="g640"><?=$user->email1?></div>
				</li>
				<li class="clearfix">
					<div class="g160 alpha">パスワード</div>
					<div class="g640">********</div>
				</li>
			</ul>
		</section>		
		<section class="contentAccountAddress">
			<h1>お届け先の変更・追加</h1>			
			<ul class="contentAccountAddressList">
				<li class="clearfix">
					<div class="g160 alpha">住所</div>
					<div class="g640">
						<ul class="contentAccountAddressListInnerList">
							<li>〒<?=$user->zipcode?></li>
							<li><?=$user->address?></li>
							<li>電話番号<?=$user->tel?></li>
						</ul>
					</div>
				</li>
			</ul>
		</section>		
	</section>


</section><!-- /contentAccount -->
<?php require_once('footer.php') ?>
