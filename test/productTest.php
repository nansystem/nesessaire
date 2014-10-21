<?php
require_once '../product.php';

$produtModel = new Product();
$products = $produtModel->getRelationshipTablesById(1);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8'/>
	<title>jQuery elevateZoom Demo</title>
	<script src='../js/jquery-1.8.3.min.js'></script>
	<script src='../js/jquery.elevatezoom.js'></script>
	<style>
		/*set a border on the images to prevent shifting*/ 
		#gallery_01 img{border:2px solid white;} 
		/*Change the colour*/ 
		.active img{border:2px solid #333 !important;}
		.subImglist li{
			float: left;
			width: 80px;
		}
	</style>
</head>
<body>
<h1>Basic Zoom Example</h1>
<img id="img_01" src="imageResize.php?url=../<?= $products[0]->image_url ?>&width=380&height=506" data-zoom-image="../<?= $products[0]->image_url ?>"/>
<ul class="subImglist" id="gallery_01"> 
<?php foreach ($products as $product): ?>
	<li>
		<a href="#" data-image="imageResize.php?url=../<?= $product->image_url ?>&width=380&height=506" data-zoom-image="../<?= $product->image_url ?>">
			<img id="img_01" src="imageResize.php?url=../<?= $product->image_url ?>&width=60&height=85" /></a>
		<span class="title"><?= $product->img_title ?></span>
	</li>
<?php endforeach ?>
</ul><!-- /gallery_01 -->
<script>//initiate the plugin and pass the id of the div containing gallery images 
$(window).load(function () {
$("#img_01").elevateZoom({gallery:'gallery_01', cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: true, loadingIcon: '../img/spinner.gif', zoomWindowWidth:'550', zoomWindowHeight:'550'});
 //pass the images to Fancybox 
 $("#img_01").bind("click", function(e) { 
 	console.log("clicked");
 	var ez = $('#img_01').data('elevateZoom');	$.fancybox(ez.getGalleryList()); return false; });
});
</script>

</body>
</html>