<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Base
 * @since Base 2.0
 */
get_header(); ?>

<section id="primary">
	<div id="content" role="main" class="<?php gpp_base_check_sidebar_hook(); ?>">

	<?php gpp_base_single_post_hook(); ?>
	
	<?php gpp_base_after_single_post_hook(); ?>	

	<?php gpp_base_comments(); ?>
	
	</div><!-- #content -->
</section><!-- #primary -->
<?php  gpp_base_sidebar_hook(); ?>

<?php get_footer(); ?>