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

	<?php if ( is_search() ) : // Only display Excerpts for search pages ?>
	<div class="entry-summary">
		<?php do_action( 'gpp_before_content' ); ?>
		<?php the_excerpt(); ?>
		<?php do_action( 'gpp_after_content' ); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php do_action( 'gpp_before_content' ); ?>
    <?php
        $quote_name = get_post_meta($post->ID, '_format_quote_source_name', true);
        $quote_url = get_post_meta($post->ID, '_format_quote_source_url', true);
    ?>
    <div class="post-format-content">
       <blockquote>
          <span class="icon left_quote"></span>
          <?php the_content(); ?>
          <span class="icon right_quote"></span>
       </blockquote>
       <?php if(isset($quote_name) && $quote_name <> '') { ?>
          <p class="quote-author"><?php if(isset($quote_url) && $quote_url <> '') { ?><a href="<?php echo $quote_url; ?>">&mdash; <?php echo $quote_name; ?></a>
       <?php } else { ?>
          &mdash; <?php echo $quote_name; ?>
       <?php } ?>
          </p>
      <?php } ?>
    </div>
      <?php do_action( 'gpp_before_content' ); ?>
          <?php if ( is_singular() ) { ?>
        <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'immersion' ) ); ?>
      <?php } else { ?>
              <?php gpp_custom_content(); ?>
          <?php } ?>
          <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'immersion' ), 'after' => '</div>' ) ); ?>
      <?php do_action( 'gpp_after_content' ); ?>

		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'immersion' ), 'after' => '</div>' ) ); ?>
		<?php do_action( 'gpp_after_content' ); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>

    <?php get_template_part( 'entry', 'footer' ); ?>

</article><!-- #post-<?php the_ID(); ?> -->