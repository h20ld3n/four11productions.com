<?php
/**
 * The template for displaying posts footers
 *
 * @package WordPress
 * @subpackage Immersion
 * @since Immersion 1.0
 */
?>

<footer class="entry-meta clearfix">
    <?php do_action( 'gpp_before_meta' ); ?>
    <div class="left">
      <?php gpp_pub_date(); ?>
        <?php if ( is_singular() ) { ?>
            <?php edit_post_link( __( 'Edit', 'immersion' ), '<span class="sep"> | </span><span class="edit-link">', '</span>' ); ?>
        <?php } ?>
    </div>
    <div class="right">
        <?php if ( comments_open() || ( '0' != get_comments_number() && ! comments_open() ) ) : ?>
        <?php comments_popup_link( __( '0', 'immersion' ), __( '1', 'immersion' ), __( '%', 'immersion' ), 'comments-link icon comment_alt2_fill' ); ?>
        <?php endif; ?>
        <a id="like-<?php the_ID(); ?>" class="like-count icon heart_fill" href="#" <?php gpp_liked_class(); ?>>
            <?php gpp_post_liked_count(); ?>
        </a>
    </div>
    <?php do_action( 'gpp_after_meta' ); ?>
</footer><!-- #entry-meta -->