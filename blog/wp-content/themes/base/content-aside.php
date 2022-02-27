<?php
/**
 * The template for displaying posts in the Aside Post Format on index and archive pages
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 *
 * @package WordPress
 * @subpackage Base
 * @since Base 2.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<h3 class="entry-format"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'gpp_base_lang' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php _e( 'Aside', 'gpp_base_lang' ); ?></a></h3>
			<?php gpp_base_above_title_hook(); ?>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'gpp_base_lang' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		</header>
		<div class="entry-content">				
				
				<?php if ( is_search() ) : // Only display Excerpts for Search ?>
					<?php the_excerpt(); ?>
				<?php else : ?>
				
					<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'gpp_base_lang' ) ); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'gpp_base_lang' ) . '</span>', 'after' => '</div>' ) ); ?>
						
				<?php endif; ?>
			</div><!-- .entry-content -->

		<?php gpp_base_meta(); //call meta data ?>
		
	</article><!-- #post-<?php the_ID(); ?> -->
