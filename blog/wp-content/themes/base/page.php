<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Base
 * @since Base 1.3
 */
get_header(); ?>

<div id="primary">
	<div id="content" role="main" class="<?php gpp_base_check_sidebar_hook(); ?>">
	
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
			<?php gpp_base_page_hook(); ?>		
		
		<?php endwhile; endif; ?>
		
		<?php gpp_base_comments(); ?>

	</div>
</div>
		
<?php gpp_base_sidebar_hook(); ?>

<?php get_footer(); ?>