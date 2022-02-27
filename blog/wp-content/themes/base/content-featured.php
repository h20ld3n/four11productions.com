<?php
/**
 * The template for displaying content featured in the showcase.php page template
 *
 * @package WordPress
 * @subpackage Base
 * @since Base 2.0
 */

global $feature_class; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $feature_class ); ?>>
		
		<h3 class="entry-format"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'gpp_base_lang' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php _e( 'Featured', 'gpp_base_lang' ); ?></a></h3>
		<div class="entry-meta">
			<?php gpp_base_posted_on(); ?>
		</div><!-- .entry-meta -->
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'gpp_base_lang' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		

	<div class="entry-summary">
		
		<?php the_excerpt(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'gpp_base_lang' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<?php gpp_base_meta(); //call meta data ?>
	
</article><!-- #post-<?php the_ID(); ?> -->
