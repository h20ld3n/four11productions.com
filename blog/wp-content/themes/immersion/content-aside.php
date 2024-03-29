<?php
/**
 * The template for displaying posts in the Aside Post Format on index and archive pages
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 *
 * @package WordPress
 * @subpackage Immersion
 * @since Immersion 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php do_action( 'gpp_before_title' ); ?>
		<?php if ( is_singular() ) { ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php } else { ?>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'immersion' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		<?php } ?>
		<?php do_action( 'gpp_after_title' ); ?>
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for search pages ?>
	<div class="entry-summary">
		<?php do_action( 'gpp_before_content' ); ?>
		<?php the_excerpt(); ?>
		<?php do_action( 'gpp_after_content' ); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php do_action( 'gpp_before_content' ); ?>
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'immersion' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'immersion' ), 'after' => '</div>' ) ); ?>
		<?php do_action( 'gpp_after_content' ); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>

    <?php get_template_part( 'entry', 'footer' ); ?>

</article><!-- #post-<?php the_ID(); ?> -->