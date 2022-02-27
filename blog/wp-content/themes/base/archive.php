<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Base
 * @since Base 2.0
 */ 
	get_header(); 
	rewind_posts(); 
?>

		<section id="primary">
			<div id="content" role="main" class="<?php gpp_base_check_sidebar_hook(); ?>">

				<?php if ( have_posts() ) : ?>
				
					<?php gpp_base_page_title_hook(); ?>			
					<?php gpp_base_archive_loop_hook(); ?>
					
					<div class="clear"></div>
					<?php gpp_base_navigation_hook(); ?>

				<?php else : ?>
				
					<h2><?php _e( 'Nothing found', 'gpp_base_lang' ); ?></h2>
					<?php get_search_form(); ?>
				
				<?php endif; ?>
			
			</div><!-- #content -->
		</section><!-- #primary -->

<?php gpp_base_sidebar_hook(); ?>

<?php get_footer(); ?>