<?php 


// Path constants 
define('THEMELIB', TEMPLATEPATH . '/lib');  

// Load Theme Options
$gpp = get_option( 'option_tree' );

// Add TGM Plugin Activation class
include(THEMELIB . '/tgm-plugin-activation/class-tgm-plugin-activation.php'); 

// Load Google Fonts  
include(THEMELIB . '/google-fonts.php'); 


// Load JS
if (!is_admin()) add_action( 'init', 'load_js' );
function load_js( ) {
	wp_enqueue_script('functions', get_stylesheet_directory_uri().'/js/functions.js', array('jquery'));
}

function getPost($post = NULL) {
	include('post.php');
}

// Add Menu Theme Support
if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support( 'nav-menus' );
	add_action( 'init', 'register_gpp_menus' );
	add_theme_support('automatic-feed-links');
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 128, 128, true );
	add_image_size( '575x350', 575, 350, true); // 575x350 image size
	add_image_size( '950x200', 950, 200, true); // 950x200 image size

	function register_gpp_menus() {
		register_nav_menus(
			array(
				'main-menu' => __( 'Main Menu', 'MonochromePro'),
				'top-menu' => __( 'Top Menu', 'MonochromePro')
			)
		);
	}
}

// Allow Custom Background Image
// add_custom_background();

// Set Content Width
if(!isset($content_width)) $content_width = 575;

// Add Custom Header
define('HEADER_TEXTCOLOR', '');
define('HEADER_IMAGE', '%s/images/headers/arrow.jpg'); // %s is the template dir uri
// The height and width of your custom header. You can hook into the theme's own filters to change these values.
// Add a filter to gpp_base_header_image_width and gpp_base_header_image_height to change these values.
define( 'HEADER_IMAGE_WIDTH', apply_filters( 'gpp_base_header_image_width', 940 ) );
define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'gpp_base_header_image_height', 200 ) );
define( 'NO_HEADER_TEXT', true );

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'bottles' => array(
			'url' => '%s/images/headers/bottles.jpg',
			'thumbnail_url' => '%s/images/headers/bottles-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Bottles', 'MonochromePro' )
		),
		'brush' => array(
			'url' => '%s/images/headers/brush.jpg',
			'thumbnail_url' => '%s/images/headers/brush-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Brush', 'MonochromePro' )
		),
		'clouds' => array(
			'url' => '%s/images/headers/clouds.jpg',
			'thumbnail_url' => '%s/images/headers/clouds-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Clouds', 'MonochromePro' )
		),
		'arrow' => array(
			'url' => '%s/images/headers/arrow.jpg',
			'thumbnail_url' => '%s/images/headers/arrow-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Arrow', 'MonochromePro' )
		),
		'surf' => array(
			'url' => '%s/images/headers/surf.jpg',
			'thumbnail_url' => '%s/images/headers/surf-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Surf', 'MonochromePro' )
		),
		'wood' => array(
			'url' => '%s/images/headers/wood.jpg',
			'thumbnail_url' => '%s/images/headers/wood-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Wood', 'MonochromePro' )
		)
	) );


// Add Custom Header CSS to Admin
function gpp_mpro_admin_header_style() {
	$header_height = HEADER_IMAGE_HEIGHT;
	$header_width = HEADER_IMAGE_WIDTH;
    ?><style type="text/css">
        #headimg {
            width: <?php echo $header_width; ?>px !important;
            height: <?php echo $header_height; ?>px !important;
            padding: 3em 0 2em 2em;
            background-repeat: no-repeat;
        }
    </style><?php
}

// Add Custom Header CSS to Admin
function gpp_mpro_header_style() {
	$header_height = HEADER_IMAGE_HEIGHT;
	$header_width = HEADER_IMAGE_WIDTH;
    ?><style type="text/css">
        .headerimg {
            width: <?php echo $header_width; ?>px !important;
            height: <?php echo $header_height; ?>px !important;
            background-repeat: no-repeat;
            border-top: 5px solid #000;
            border-right: 5px solid #000;
            border-left: 5px solid #000;
        }
    </style><?php
}

add_custom_image_header('gpp_mpro_header_style', 'gpp_mpro_admin_header_style');



if ( function_exists('register_sidebar') )
{
   register_sidebar(array(
          'name' => 'Sidebar',
          'before_widget' => '<div class="bottombar">',
          'after_widget' => '</div>',
          'before_title' => '<h2 class="widgettitle">',
          'after_title' => '</h2>',
        )
    );
   	register_sidebar(array(
          'name' => 'Sidebar-Single',
          'before_widget' => '<div class="bottombar">',
          'after_widget' => '</div>',
          'before_title' => '<h2 class="widgettitle">',
          'after_title' => '</h2>',
        )
    );
   register_sidebar(array(
          'name' => 'Sidebar-Home',
          'before_widget' => '<div class="bottombar">',
          'after_widget' => '</div>',
          'before_title' => '<h2 class="widgettitle">',
          'after_title' => '</h2>',
        )
    );  
   register_sidebar(array(
          'name' => 'Bottom-Left',
          'before_widget' => '<div class="bottombar">',
          'after_widget' => '</div>',
          'before_title' => '<h2 class="widgettitle">',
          'after_title' => '</h2>',
        )
    );  
    register_sidebar(array(
          'name' => 'Bottom-Middle',
          'before_widget' => '<div class="bottombar">',
          'after_widget' => '</div>',
          'before_title' => '<h2 class="widgettitle">',
          'after_title' => '</h2>',
        )
    );   
 register_sidebar(array(
          'name' => 'Bottom-Right',
          'before_widget' => '<div class="bottombar">',
          'after_widget' => '</div>',
          'before_title' => '<h2 class="widgettitle">',
          'after_title' => '</h2>',
        )
    );   
}


add_action( 'tgmpa_register', 'fullscreen_register_required_plugins' ); 

/*  TGM register required plugins  */
function fullscreen_register_required_plugins() {

	$plugins = array(

		/* Add Option Tree Plugin from .org repo */
		array('name' => 'Option Tree',
		'slug' => 'option-tree',
		),
	);

	/** Change this to your theme text domain, used for internationalising strings */
	$theme_text_domain = 'MonochromePro';

	/**
	 * Array of configuration settings. Uncomment and amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * uncomment the strings and domain.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
        'domain'       => $theme_text_domain,         // Text domain - likely want to be the same as your theme
		'strings'      => array(
			/*'page_title'             => __( 'Install Required Plugins', $theme_text_domain ), // */
			/*'menu_title'             => __( 'Install Plugins', $theme_text_domain ), // */
			/*'instructions_install'   => __( 'The %1$s plugin is required for this theme. Click on the big blue button below to install and activate %1$s.', $theme_text_domain ), // %1$s = plugin name */
			/*'instructions_activate'  => __( 'The %1$s is installed but currently inactive. Please go to the <a href="%2$s">plugin administration page</a> page to activate it.', $theme_text_domain ), // %1$s = plugin name, %2$s = plugins page URL */
			/*'button'                 => __( 'Install %s Now', $theme_text_domain ), // %1$s = plugin name */
			/*'installing'             => __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name */
			/*'oops'                   => __( 'Something went wrong with the plugin API.', $theme_text_domain ), // */
			/*'notice_can_install'     => __( 'This theme requires the %1$s plugin. <a href="%2$s"><strong>Click here to begin the installation process</strong></a>. You may be asked for FTP credentials based on your server setup.', $theme_text_domain ), // %1$s = plugin name, %2$s = TGMPA page URL */
			/*'notice_cannot_install'  => __( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', $theme_text_domain ), // %1$s = plugin name */
			/*'notice_can_activate'    => __( 'This theme requires the %1$s plugin. That plugin is currently inactive, so please go to the <a href="%2$s">plugin administration page</a> to activate it.', $theme_text_domain ), // %1$s = plugin name, %2$s = plugins page URL */
			/*'notice_cannot_activate' => __( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', $theme_text_domain ), // %1$s = plugin name */
			/*'return'                 => __( 'Return to Required Plugins Installer', $theme_text_domain ), // */
		),
	);

	tgmpa( $plugins, $config );

} ?>