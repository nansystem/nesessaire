	</div><!-- clearfix -->
	<footer>
		<small>COPYRIGHT &copy; nesessaire CO.,LTD. ALL RIGHTS RESERVED.</small>
	</footer>
	</div><!-- /container -->
</div><!-- wrapper -->

<script>//initiate the plugin and pass the id of the div containing gallery images 
$(window).load(function () {
$("#img_01").elevateZoom({gallery:'gallery_01', cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: true, loadingIcon: 'img/spinner.gif', zoomWindowWidth:'550', zoomWindowHeight:'550'});
 //pass the images to Fancybox 
 $("#img_01").bind("click", function(e) { 
 	console.log("clicked");
 	var ez = $('#img_01').data('elevateZoom');	$.fancybox(ez.getGalleryList()); return false; });
});
</script>

</body>
</html>