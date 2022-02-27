<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage Immersion
 * @since Immersion 1.0
 */
?>
<?php 
global $gpp;
$sidebar = "";

if ( isset( $gpp[ 'immersion_sidebar' ] ) )
		$sidebar = $gpp[ 'immersion_sidebar' ];
	if ( $sidebar == "true" || ( $gpp === FALSE ) ) { ?>
	<?php do_action( 'gpp_before_sidebar' ); ?>
		<div id="secondary" class="widget-area" role="complementary">
			<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

				<aside id="search" class="widget widget_search">
					<?php get_search_form(); ?>
				</aside>

				<aside id="archives" class="widget">
					<h1 class="widget-title"><?php _e( 'Archives', 'immersion' ); ?></h1>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>
				</aside>

				<aside id="meta" class="widget">
					<h1 class="widget-title"><?php _e( 'Meta', 'immersion' ); ?></h1>
					<ul>
						<?php wp_register(); ?>
						<aside><?php wp_loginout(); ?></aside>
						<?php wp_meta(); ?>
					</ul>
				</aside>

			<?php endif; // end sidebar widget area ?>
		</div><!-- #secondary .widget-area -->

		<?php do_action( 'gpp_after_sidebar' ); ?>
		
		<?php } ?>