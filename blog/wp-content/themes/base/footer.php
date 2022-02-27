<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Base
 * @since Base 2.0
 */
?>
	</div><!--#main-->
	<footer id="colophon" role="contentinfo">
	
		<?php gpp_base_above_footer_hook(); ?>
		<?php gpp_base_footer_hook(); ?>
		<?php gpp_base_below_footer_hook(); ?>
		<?php gpp_base_footer_credits_hook(); ?>

	</footer><!-- #colophon -->
	

	

</div><!-- #page -->

<?php wp_footer(); ?>


<!-- <?php echo get_num_queries(); ?> queries in <?php timer_stop(1); ?> -->

</body>
</html>