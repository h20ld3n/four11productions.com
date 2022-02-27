<?php
/**
 * The template for displaying posts in the Image Post Format on index and archive pages
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 *
 * @package WordPress
 * @subpackage Base
 * @since Base 2.0
 */
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'indexed' ); ?>>
				
			<h3 class="entry-format"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'gpp_base_lang' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php _e( 'Image', 'gpp_base_lang' ); ?></a></h3>
			<?php gpp_base_above_title_hook(); ?>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'gpp_base_lang' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<?php if ( comments_open() && ! post_password_required() ) : ?>
					<div class="comments-link">
						<?php comments_popup_link( '<span class="leave-reply">' . __( "Reply", 'gpp_base_lang' ) . '</span>', _x( '1', 'comments number', 'gpp_base_lang' ), _x( '%', 'comments number', 'gpp_base_lang' ) ); ?>
					</div>
			<?php endif; ?>

		<div class="entry-content">
			
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'gpp_base_lang' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'gpp_base_lang' ) . '</span>', 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->

		<footer class="entry-meta">
			<div class="entry-utility">
				<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'gpp_base_lang' ) );
				if ( $categories_list ):
				?>
					<span class="cat-links">
						<?php printf( __( '<span class="%1$s">Posted in</span> %2$s', 'gpp_base_lang' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list ); ?>
					</span>
				<?php endif; // End if categories ?>
				<?php
					/* translators: used between list items, there is a space after the comma */
					$tags_list = get_the_tag_list( '', __( ', ', 'gpp_base_lang' ) );
					if ( $tags_list ): ?>
						<span class="meta-sep"> &#183; </span>
						<span class="tag-links">
							<?php printf( __( '<span class="%1$s">Tagged</span> %2$s', 'gpp_base_lang' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
						</span>
				<?php endif; // End if $tags_list ?>

				<?php if ( comments_open() ) : ?>
						<span class="comments-link"><?php comments_popup_link( '<span class="leave-reply">' . __( 'Reply', 'gpp_base_lang' ) . '</span>', __( '<strong>1</strong> Reply', 'gpp_base_lang' ), __( '<strong>%</strong> Replies', 'gpp_base_lang' ) ); ?></span>
				<?php endif; // End if comments_open() ?>
				<span class="meta-sep"> &#183; </span>
				<?php edit_post_link( __( 'Edit', 'gpp_base_lang' ), '<span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-utility -->
			
		</footer><!-- #entry-meta -->
	</article><!-- #post-<?php the_ID(); ?> -->
