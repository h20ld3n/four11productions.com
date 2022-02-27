<?php
/**
 * Immersion functions and definitions
 * @subpackage Immersion
 *
 * @since Immersion 1.0
 */

/** Run the gpp_pre hook */
do_action( 'gpp_pre' );

add_action( 'gpp_init', 'gpp_theme_support' );
/**
 * This function activates default theme features
 *
 * @since 1.0
 */
function gpp_theme_support() {

	add_theme_support( 'menus' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-formats', array( 'link', 'gallery', 'image', 'video', 'audio', 'quote' ) );
	add_editor_style('style-editor.css');

}

/**
 * Set the thumbnail sizes for this theme
 */
if ( function_exists( 'add_theme_support' ) ) {

}

add_action( 'gpp_init', 'gpp_constants' );
/**
 * This function defines the Immersion theme constants
 *
 * @since 1.0
 */
function gpp_constants() {

	/** Define Theme Info Constants */
	define( 'PARENT_THEME_NAME', 'immersion' );
	define( 'PARENT_THEME_VERSION', '1.0' );

	/** Define Directory Location Constants */
	define( 'PARENT_DIR', get_template_directory() );
	define( 'CHILD_DIR', get_stylesheet_directory() );
	define( 'GPP_IMAGES_DIR', PARENT_DIR . '/images' );
	define( 'GPP_CHILD_IMAGES_DIR', CHILD_DIR . '/images' );
	define( 'GPP_LIB_DIR', PARENT_DIR . '/lib' );
	define( 'GPP_FUNCTIONS_DIR', GPP_LIB_DIR . '/functions' );
	define( 'GPP_JS_DIR', GPP_LIB_DIR . '/js' );
	define( 'GPP_CHILD_JS_DIR', CHILD_DIR . '/js' );
	define( 'GPP_CSS_DIR', GPP_LIB_DIR . '/css' );
	if ( ! defined( 'GPP_LANGUAGES_DIR' ) ) /** So we can define with a child theme */
		define( 'GPP_LANGUAGES_DIR', GPP_LIB_DIR . '/languages' );

	/** Define URL Location Constants */
	define( 'PARENT_URL', get_template_directory_uri() );
	define( 'CHILD_URL', get_stylesheet_directory_uri() );
	define( 'GPP_IMAGES_URL', PARENT_URL . '/images' );
	define( 'GPP_CHILD_IMAGES_URL', CHILD_URL . '/images' );
	define( 'GPP_LIB_URL', PARENT_URL . '/lib' );
	define( 'GPP_JS_URL', GPP_LIB_URL . '/js' );
	define( 'GPP_CHILD_JS_URL', CHILD_URL . '/lib/js' );
	define( 'GPP_CSS_URL', GPP_LIB_URL . '/css' );
	define( 'GPP_CHILD_CSS_URL', CHILD_URL . '/lib/css' );
	define( 'GPP_FUNCTIONS_URL', GPP_LIB_URL . '/functions' );
	if ( ! defined( 'GPP_LANGUAGES_URL' ) ) /** So we can predefine to child theme */
		define( 'GPP_LANGUAGES_URL', GPP_LIB_URL . '/languages' );

}

/**
* Options variable
*/
$gpp = get_option( 'immersion_options' );

add_action( 'gpp_init', 'gpp_load_files' );
/**
 * This function loads all the files and features
 *
 * @since 1.0
 */
function gpp_load_files() {

	/** Load Functions */
	require_once( GPP_FUNCTIONS_DIR . '/body.php' );
	require_once( GPP_FUNCTIONS_DIR . '/comments.php' );
	require_once( GPP_FUNCTIONS_DIR . '/formats.php' );
	require_once( GPP_FUNCTIONS_DIR . '/i18n.php' );
	require_once( GPP_FUNCTIONS_DIR . '/menus.php' );
	require_once( GPP_FUNCTIONS_DIR . '/meta.php' );
	require_once( GPP_FUNCTIONS_DIR . '/postnav.php' );
	require_once( GPP_FUNCTIONS_DIR . '/posts.php' );
	require_once( GPP_FUNCTIONS_DIR . '/widgets.php' );
	require_once( GPP_FUNCTIONS_DIR . '/helper-functions.php' );
	require_once( GPP_FUNCTIONS_DIR . '/class-tgm-plugin-activation.php' ); // plugin activation class

	/* Load options */
	require_once( GPP_LIB_DIR . '/options/index.php' );

	/** Load Javascript */
	require_once( GPP_JS_DIR . '/load-scripts.php' );

	/** Load CSS */
	require_once( GPP_LIB_DIR . '/options/inc/load-styles.php' );

}



add_action( 'gpp_init', 'gpp_theme_setup' );
/**
 * This function setups up the theme defaults
 *
 * @since 1.0
 */
function gpp_theme_setup() {

	/** Set the content width based on the theme's design and stylesheet */
	if ( ! isset( $content_width ) )
		$content_width = 620; /* pixels */

	/** This theme uses wp_nav_menu() in one location */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'immersion' ),
		'top-right' => __( 'Top Right Menu', 'immersion' ),
		'top-right-secondary' => __( 'Top Right Secondary Menu', 'immersion' ),
		'footer' => __( 'Footer Menu', 'immersion' )
	) );

}

/** Run the plugin activation hook */
add_action( 'tgmpa_register', 'gpp_register_required_plugins' );

/**
 * This function sets up up the required plugins
 *
 * @since 1.0
 */
function gpp_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin pre-packaged with a theme
		array(
			'name'     				=> 'CF Post Formats', // The plugin name
			'slug'     				=> 'wp-post-formats', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/lib/plugins/wp-post-formats.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),

		// This is an example of how to include a plugin from the WordPress Plugin Repository
		// array(
			// 'name' 		=> 'BuddyPress',
			// 'slug' 		=> 'buddypress',
			// 'required' 	=> false,
		// ),

	);
	$config = array();
	// theme text domain
	$theme_text_domain = 'immersion';

	tgmpa( $plugins, $config );

}

/** Run the gpp_init hook */
do_action( 'gpp_init' );

/** Run the gpp_setup hook */
do_action( 'gpp_setup' );

// Add AJAX actions
add_action('wp_ajax_gpp_liked_ajax', 'gpp_update_liked_count');
add_action('wp_ajax_nopriv_gpp_liked_ajax', 'gpp_update_liked_count');



function gpp_update_liked_count() {
	// get post ID
	$id = $_POST['id'];
	$metakey='_gpp_liked';
	// get liked count
	$count=get_post_meta($id,$metakey,true);
	// check for count
	if(!$count)
		$count=0;
	// increase by 1
	$count++;
	if(isset($_COOKIE['_gpp_liked'])) {
		$cookie=  $_COOKIE['_gpp_liked'];
		$liked=explode('|',$cookie);
		if(!in_array($id,$liked)) {
			$status=update_post_meta($id,$metakey,$count);
			$cookie=$cookie.'|'.$id;
		} else {
			$status=FALSE;
		}
	} else {
		// update liked count
		$status=update_post_meta($id,$metakey,$count);
		$cookie=$id;
	}
	if($status) {
		setcookie('_gpp_liked', $cookie ,time()+3600*24*365,'/');
		$status=true;
	}
	// generate the response
	$response = json_encode(
		array(
			'success' => $status,
			'postID' => $id,
			'count' => $count
		)
	);
	// JSON header
	header('Content-type: application/json');
	echo $response;
	die();
}

function gpp_post_liked_count() {
    global $post;
	$liked=get_post_meta($post->ID,'_gpp_liked',TRUE);
	echo $liked?$liked:'0';
}

function gpp_liked_class() {
    global $post;
	$liked=array();
	if(isset($_COOKIE['_gpp_liked'])) {
		$cookie= $_COOKIE['_gpp_liked'];
		$liked=explode('|',$cookie);
	}
	if(in_array($post->ID,$liked))
		echo 'class="active"';
}