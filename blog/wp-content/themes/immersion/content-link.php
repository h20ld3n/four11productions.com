<?php
/**
 * The template for displaying posts in the Quote Post Format on index and archive pages
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
        <?php
            $link = get_post_meta($post->ID, '_format_link_url', true);
        ?>
        <div class="post-format-content">
            <?php
                if ( is_singular() )
                    echo '<h1 class="entry-title">';
                else
                    echo '<h2 class="entry-title">';
            ?>
                <a href="<?php echo $link; ?>" class="icon book_alt2" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
            <?php
                if ( is_singular() )
                    echo '</h1>';
                else
                    echo '</h2>';
            ?>
        </div>
    </header>

	<?php if ( is_search() ) : // Only display Excerpts for search pages ?>
	<div class="entry-summary">
		<?php do_action( 'gpp_before_content' ); ?>
		<?php the_excerpt(); ?>
		<?php do_action( 'gpp_after_content' ); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
    <div class="entry-content">
        <?php do_action( 'gpp_before_content' ); ?>
        <?php if ( is_singular() ) { ?>
          <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'immersion' ) ); ?>
        <?php } else { ?>
            <?php gpp_custom_content(); ?>
        <?php } ?>
        <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'immersion' ), 'after' => '</div>' ) ); ?>
        <?php do_action( 'gpp_after_content' ); ?>
    </div><!-- .entry-content -->
	<?php endif; ?>

    <?php get_template_part( 'entry', 'footer' ); ?>

</article><!-- #post-<?php the_ID(); ?> -->