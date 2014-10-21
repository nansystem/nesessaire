<?php
require_once('../productModel.php');

$productModel = new Product();
$mainVisuals = $productModel->getPickups();
?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/font-awesome.min.css">  
  <style>
  #carousel-example-generic{
    width: 640px;
  }
  .carousel-inner > .item > img, .carousel-inner > .item > a > img{
    display: inline-block;
    float:left;
  }
  </style>
	<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script src="../js/bootstrap.js"></script>
  <script>
  $(function() {
    $('.carousel').carousel({
      interval: 3500
    });
  });
  </script>
</head>
<body>
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
      <a href="products.php?product_id=<?=$mainVisuals[$j]->product_id?>"><img src="../<?= $mainVisuals[$j]->image_url ?>" alt="<?=$mainVisuals[$j]->product_name?>" width="320"></a>
      <a href="products.php?product_id=<?=$mainVisuals[$j + 1]->product_id?>"><img src="../<?= $mainVisuals[$j + 1]->image_url ?>" alt="<?=$mainVisuals[$j + 1]->product_name?>" width="320"></a>
    </div>
  	<?php endfor ?>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <i class="fa fa-chevron-left glyphicon-chevron-left"></i>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <i class="fa fa-chevron-right glyphicon-chevron-right"></i>
  </a>
</div>


</body>
</html>