<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Base
 * @since Base 2.0
 */
?><!DOCTYPE html>

<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->


<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="initial-scale=1.0, width=device-width" />

<?php
	global $gpp;
	if ( ! isset( $gpp[ 'gpp_base_seo' ] ) || ( $gpp[ 'gpp_base_seo' ] == "" ) ) { // If SEO plugin is not used
		// Creating the doc title
		gpp_base_doctitle();
	} else {
		echo "<title>";
		wp_title( "", true );
		echo "</title>";
	}
	// Creating the content type
	gpp_base_create_contenttype();
	
	if ( ! isset( $gpp[ 'gpp_base_seo' ] ) || ( $gpp[ 'gpp_base_seo' ] == "" ) ) { //If SEO plugin is not used
		// Creating the description
		gpp_base_show_description();
	}  
	// Load base or child color CSS first
	gpp_base_css_hook();
	
	// Loading the stylesheet
	gpp_base_create_stylesheet();
	
	// Creating the internal RSS links
	gpp_base_show_rss();
	
	// Creating the pingback address
	gpp_base_show_pingback();
	
	// Enqueue comment scripts
	if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
?>

<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/library/js/html5.js" type="text/javascript"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/library/js/css3-mediaqueries.js"></script>
<![endif]-->

<?php wp_head(); ?>

<?php gpp_base_tracking_code_hook(); ?>
</head>

<body <?php body_class(); ?>>

	<div id="page" class="hfeed">
	<?php gpp_base_above_header_hook(); ?>

	<!-- BeginHeader -->
	<header id="branding" role="banner">
		<hgroup>
			<?php gpp_base_header_hook(); ?>
		</hgroup>
		<nav id="topaccess" role="navigation">
				<?php gpp_base_topnav_hook(); ?>
		</nav>	
		<?php gpp_base_header_image(); ?>	
		<nav id="access" role="navigation">
			<?php gpp_base_nav_hook(); ?>
		</nav>	
	</header>
	<!-- EndHeader -->

	<?php gpp_base_below_header_hook(); ?>

	<!-- BeginContent -->
	<div id="main">
