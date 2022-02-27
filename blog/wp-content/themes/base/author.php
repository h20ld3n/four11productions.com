<?php
/**
 * The template for displaying Author Archive pages.
 *
 * @package WordPress
 * @subpackage Base
 * @since Base 1.3
 */
get_header(); ?>

	<section id="primary">
		<div id="content" role="main" class="<?php gpp_base_check_sidebar_hook(); ?>">

			<?php if ( have_posts() ) : ?>
				<?php gpp_base_page_title_hook(); ?>
				<?php
					// If a user has filled out their description, show a bio on their entries.
					if ( get_the_author_meta( 'description' ) ) : 
				?>
						<div id="entry-author-info">
							<div id="author-avatar"><?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'gpp_base_author_bio_avatar_size', 60 ) ); ?></div><!-- #author-avatar -->
							<div id="author-description">
								<h2><?php printf( __( 'About %s', 'gpp_base_lang' ), get_the_author() ); ?></h2>
								<?php the_author_meta( 'description' ); ?>
							</div><!-- #author-description	-->
						</div><!-- #entry-author-info -->
				<?php endif; ?>
				<?php gpp_base_author_loop_hook(); ?>
				<div class="clear"></div>
				
				<?php gpp_base_navigation_hook(); ?>
			<?php endif; ?>	
		
		</div><!-- #content -->
	</section><!-- #primary -->

<?php gpp_base_sidebar_hook(); ?>
<?php get_footer(); ?>