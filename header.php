<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
  	<title>nesessaire</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/980_24_20.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">  
  <style>
  #carousel-example-generic{
    width: 640px;
  }
  .carousel-inner > .item > img, .carousel-inner > .item > a > img{
    display: inline-block;
    float:left;
  }
  </style>
	<script type="text/javascript">
	  WebFontConfig = {
	    google: { families: [ 'Great+Vibes::latin' ] }
	  };
	  (function() {
	    var wf = document.createElement('script');
	    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
	      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
	    wf.type = 'text/javascript';
	    wf.async = 'true';
	    var s = document.getElementsByTagName('script')[0];
	    s.parentNode.insertBefore(wf, s);
	  })(); </script>
	<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script src="js/script.js"></script>
	<script src='js/jquery.elevatezoom.js'></script>
	<script src="js/bootstrap.js"></script>
	<script>
	$(function() {
		$('.carousel').carousel({
		  interval: 3750
		});
	});
	</script>
</head>
<body>
<div class="wrapper">
	<div class="container">
	<header class="clearfix">
		<div class="g240 alpha">
			<h1><a class="logo text-hide" href="index.php">nesessaire</a></h1>
			<p class="headerDescription">nesessaire（ネセセア）の公式オンラインショップです</p>
		</div><!-- /g240 -->
		<div class="g760 omega">
			<nav>
				<ul class="headerNavList">
			      <li class="dropdown">
					<?php if( isset($_SESSION['email']) ): ?>
					<a id="drop4" role="button" class="btn btn-default" data-toggle="dropdown" href="#"><?= h( mb_strimwidth($_SESSION['email'], 0, 13, "...", "UTF-8")) ?> 様<span class="caret"></span></a>
					<ul id="menu1" class="dropdown-menu" role="menu" aria-labelledby="drop4">
					  <li role="presentation"><a role="menuitem" tabindex="-1" href="orderHistory.php">注文履歴</a></li>
					  <!-- <li role="presentation"><a role="menuitem" tabindex="-1" href="account.php">登録情報</a></li> -->
					  <li role="presentation" class="divider"></li>
					  <li role="presentation"><a role="menuitem" tabindex="-1" href="logout.php">ログアウト</a></li>
					</ul>
					<?php else: ?>
						<a class="btn btn-default" href="login.php">ログイン</a>				
					<?php endif ?>
					</li>
					<li><a class="btn btn-primary" href="cart.php?action=cart">カート</a></li>
				</ul>
			</nav>				
		</div><!-- /g720 -->
	</header>
	<div class="clearfix">