<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Base
 * @since Base 2.0
 */
get_header();	?>

<?php gpp_base_home_widgets_hook(); // pull homepage widgets ?>
	
<?php gpp_base_apps_hook(); // pull apps such as slideshow, slider ?>

<?php gpp_base_loop_hook(); // determines output of post display ?>

<?php gpp_base_sidebar_hook(); ?> 

<?php get_footer(); ?>                             