<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.  
 *
 * @package WordPress
 * @subpackage Base
 * @since Base 1.3
 */
?>
<?php global $gpp; ?>
	<div id="comments">
		<?php if ( post_password_required() ) : ?>
				<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'gpp_base_lang' ); ?></p>
	</div><!-- #comments -->
		<?php
				/* Stop the rest of comments.php from being processed,
				 * but don't kill the script entirely -- we still have
				 * to fully load the template.
				 */
				return;
			endif;
		?>

		<?php if ( have_comments() ) : ?>
				<h3 id="comments-title">
					<?php
						printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'gpp_base_lang' ),
							number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' );
					?>
				</h3>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
					<nav id="comment-nav-above">
						<h1 class="assistive-text"><?php _e( 'Comment navigation', 'gpp_base_lang' ); ?></h1>
						<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'gpp_base_lang' ) ); ?></div>
						<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'gpp_base_lang' ) ); ?></div>
					</nav> 
				
		<?php endif; // check for comment navigation ?>

				<ol class="commentlist">
					<?php
						/* Loop through and list the comments. Tell wp_list_comments()
						 * to use gpp_base_comment() to format the comments.
						 * If you want to overload this in a child theme then you can
						 * define gpp_base_comment() and that will be used instead.
						 * See gpp_base_comment() in f8-lite/functions.php for more.
						 */
						wp_list_comments( array( 'callback' => 'gpp_base_comment' ) );
					?>
				</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
					<nav id="comment-nav-below">
						<h1 class="assistive-text"><?php _e( 'Comment navigation', 'gpp_base_lang' ); ?></h1>
						<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'gpp_base_lang' ) ); ?></div>
						<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'gpp_base_lang' ) ); ?></div>
					</nav>
		<?php endif; // check for comment navigation ?>

		<?php else : // or, if we don't have comments:

			/* If there are no comments and comments are closed,
			 * let's leave a little note, shall we?
			 */
			if ( ! comments_open() ) {
				if ( ! isset( $gpp['gpp_base_commentsclosed'] ) || ( $gpp['gpp_base_commentsclosed'] == true ) ) {
				
				} else {
		?>
					<p class="nocomments"><?php _e( 'Comments are closed.', 'gpp_base_lang' ); ?></p>
		<?php 
				} //end commentsclosed
			} // end ! comments_open()

			?>

		<?php endif; // end have_comments() ?>

		<?php comment_form(); ?>

	</div><!-- #comments -->
