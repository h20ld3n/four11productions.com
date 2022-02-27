<?php
/**
 * The Sidebar containing the main widget area.
 *
 * @package WordPress
 * @subpackage Base
 * @since Base 1.3
 */
?>
<?php 
	global $gpp, $showsidebar, $sidebar;
	$gpp = get_option( 'gpp_base_options' ); 
	if ( isset( $gpp[ 'gpp_base_sidebar' ] ) )
		$sidebar = $gpp[ 'gpp_base_sidebar' ];	
?>
<?php if ( $sidebar == "true" || ( $gpp === FALSE && $showsidebar == "true" ) ) { ?>

<?php gpp_base_above_sidebar_hook(); ?>

<div id="secondary" class="widget-area" role="complementary">
	
		<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'Sidebar' ) ) : ?>	
		
			<?php get_search_form(); ?>
				<aside id="archives" class="widget">
					<h3 class="widget-title"><?php _e( 'Archives','gpp_base_lang' ); ?></h3>
					<ul>
						<?php wp_get_archives( 'type=monthly' ); ?>
					</ul>
				</aside>

				<aside id="meta" class="widget">
					<h3 class="widget-title"><?php _e( 'Meta','gpp_base_lang' ); ?></h3>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<?php wp_meta(); ?>
					</ul>
				</aside>
		
		<?php endif; ?>	
		
</div><!-- #secondary -->

<?php gpp_base_below_sidebar_hook(); ?>

<?php } ?>