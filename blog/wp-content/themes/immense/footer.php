</div><!--#main-->

<footer id="colophon" role="contentinfo">

<?php
global $catarray; 
if(get_post_type( $post->ID )!="galleries" && !is_home()){ 
	if(is_archive() && (!in_category($catarray) && !is_tag()) ){
	
	}else{
		gpp_base_above_footer_hook(); 
		gpp_base_footer_hook(); 
		gpp_base_below_footer_hook();
		gpp_base_footer_credits_hook();
	}
} 


?>

</footer><!-- #colophon -->	

</div><!-- #page -->

<?php wp_footer(); ?>


<!-- <?php echo get_num_queries(); ?> queries in <?php timer_stop(1); ?> -->

</body>
</html> 