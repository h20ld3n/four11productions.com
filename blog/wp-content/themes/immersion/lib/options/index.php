<?php

// Theme Data Constants
	$theme_data = get_theme_data(get_stylesheet_directory().'/style.css');
	define('GPP_THEME_NAME', $theme_data['Name']);	
	define('GPP_THEME_VERSION', trim($theme_data['Version']));	
	define('GPP_THEME_SHORTNAME', str_replace(" ", "_", strtolower(GPP_THEME_NAME)));
	
	define('GPP_OPTIONS_DIR', get_template_directory().'/lib/options/');
	define('GPP_OPTIONS_URL', get_template_directory_uri().'/lib/options/');

/* Load options */
function gpp_theme_options_setup() {
	require_once( GPP_OPTIONS_DIR . 'admin/admin-interface.php' );
	require_once( GPP_OPTIONS_DIR . 'inc/theme-options.php' );
	
	// Load Javascript
	require_once( GPP_OPTIONS_DIR. 'admin/admin-js.php' );
}
add_action( 'gpp_init', 'gpp_theme_options_setup', 12 );
?>