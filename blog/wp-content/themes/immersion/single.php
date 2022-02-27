<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Immersion
 * @since Immersion 1.0
 */

get_header(); ?>

		<div id="primary" class="<?php gpp_check_sidebar(); ?>">

			<div id="content" role="main">

			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<?php // gpp_content_nav( 'nav-above' ); ?>

				<?php  get_template_part( 'content', get_post_format() ); ?>
				
				<?php the_tags(); ?>

				<?php gpp_content_nav( 'nav-below' ); ?>

				<?php comments_template( '', true ); ?>

			<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>