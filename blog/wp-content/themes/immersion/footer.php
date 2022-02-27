<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Immersion
 * @since Immersion 1.0
 */
?>
    </div><!--  #primary-wrap  -->
    <?php get_sidebar(); ?>
	</div><!-- #main -->

	<?php do_action( 'gpp_before_footer' ); ?>

	<footer id="colophon" role="contentinfo">
		<?php
		global $gpp;
		$footerwidget = $gpp['immersion_footer'];
		if ( $footerwidget == "true" || ( $gpp === FALSE ) ) {
		?>
		<div id="footer-widgets">
			<?php

				$no_of_fwidgets = intval($gpp['immersion_footer_widgets']) ;


			for( $i = 1; $i <= $no_of_fwidgets; $i++ ) { ?>

			<aside class="widget-<?php echo $no_of_fwidgets; ?>" id="widget-<?php echo $i; ?>">
				<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'Footer Widget '.$i ) ) : ?>
					<?php //if ( $showwidgets ) { ?>
						<h3 class="widget-title"><?php _e( 'Footer Widget ' . $i,'gpp_lang' ); ?></h3>
						<p><?php _e( 'To add content to this area, visit the widget page and add a widget to the Footer Widget ' . $i . ' widget.','gpp_lang' ); ?></p>
					<?php //} ?>
				<?php endif; ?>
			</aside>

			<?php } //end for ?>
		</div>
	<?php } //footer div close ?>
		<div id="site-generator">
			<?php do_action( 'gpp_credits' ); ?>
			Powered by <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'immersion' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'immersion' ); ?>" ><?php printf( __( '%s', 'immersion' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'immersion' ), '<a href="http://graphpaperpress.com/themes/immersion/">Immersion</a>', '<a href="http://graphpaperpress.com/">Graph Paper Press</a>' ); ?>
		</div>
		<?php if (has_nav_menu('footer')) wp_nav_menu( 'sort_column=menu_order&menu_class=menu-footer&theme_location=footer' ); ?>
	</footer><!-- #colophon -->

	<?php do_action( 'gpp_after_footer' ); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>