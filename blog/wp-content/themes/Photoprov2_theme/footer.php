<!-- retive admin code -->
<?php include("include/retrive_admin.php"); ?>

	<div id="footer">
		<!-- The left side of footer -->
		<div class="left">
			<p><a href="<?php echo get_option('home'); ?>/wp-admin/">Admin panel</a> 	&bull;	<a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS'); ?>"><?php _e('Entries <abbr title="Really Simple Syndication">RSS</abbr>'); ?></a>  &bull;  <a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php _e('The latest comments to all posts in RSS'); ?>"><?php _e('Comments <abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></p>
	
			<p>&copy;  <? print(Date("Y")); ?>  <?php if ($aOptions['featured1-title'] != '') : ?><?php echo($aOptions['featured1-title']); ?><?php endif; ?> &#187;  All Rights Reserved &#187; Photopro theme by <a class="frozr-copyright" href="http://www.frozr.com" >Frozr.com</a></p>	
		</div>
	
		<!-- The right side of footer -->
		<div class="right">
			<p><a href="#top"><img src="<?php bloginfo('template_directory'); ?>/images/top.jpg" alt="top" title="top"/></a></p>	
		</div>
		
	</div><!-- #footer -->

</div><!-- .container => from header.php -->
<?php wp_footer(); ?>

<!-- javascript -->
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/motionpack.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.carousel.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/lg/js/jquery.prettyPhoto.js"></script>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		$("a[rel^='prettyPhoto'], .gallery-icon a").prettyPhoto();
	});
	
	$(document).ready(function() {
			$(function(){
				$("div.example-5").carousel({ autoSlide: false,   dispItems: 6});
	
			});
	});
</script>

<!-- Start footer script-->
	<?php echo stripslashes($p_footer_scripts); ?>
<!-- End footer script-->

</body>
</html>