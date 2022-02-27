<?php
/**
 * Style Extensions - A WordPress script for post-specific stylesheets.
 *
 * Style Extensions allows users and developers to add unique, per-post stylesheets.  This script was 
 * created so that custom stylesheet files could be dropped into the active theme's '/css' folder and loaded for 
 * individual posts using the 'Stylesheet' post meta key and the stylesheet name as the post meta value.
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume 
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @package Base
 * @version 1.1.0
 * @author Thad Allender <info@graphpaperpress.com>
 * @copyright Copyright (c) 2011, Thad Allender
 * @link http://graphpaperpress.com
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
 
/* Adds a custom stylesheet to a singular post, page or type */
function gpp_base_add_custom_stylesheet() {

	/* Get the global post var */
	global $post;

	/* Are we viewing a singular post, page or type? */
	if ( is_singular() ) {
		
		/* Sets $styleesheet variable to the value of the Stylesheet custom field */
		$stylesheet = get_post_meta( $post->ID, 'Stylesheet', true );
		
		/* Sets $theme variable to the lowercase name of the current active theme */
		$theme = strtolower( get_current_theme() );
		
		/* Replaces any empty spaces in theme name with hyphens to build the theme folder name */
		$theme = str_replace( " ", "-", $theme );
		
		/* Sets $stylesheet_file variable to the place where the stylesheet is expected to exists on server */
		$stylesheet_file = ABSPATH . 'wp-content/themes/'.$theme.'/css/'.$stylesheet;
    
		/* Checks if the custom field has a value and that the stylesheet actually exists on the server */
		if ( $stylesheet && file_exists( $stylesheet_file ) ) {
		
			/* Echos the stylesheet link */
			echo '<link rel="stylesheet" href="'.get_template_directory_uri().'/css/'.$stylesheet.'" type="text/css" media="screen,projection,tv" />';
			
		}
	
	}

}

/* Register with hook 'wp_print_styles' */
add_action( 'wp_print_styles', 'gpp_base_add_custom_stylesheet', 2 );