<?php

/*
 * Menu helper functions
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 * @package WordPress
 * @subpackage Immersion
 * @since Immersion 1.0
 */

function gpp_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'gpp_page_menu_args' );