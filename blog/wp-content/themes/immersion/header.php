<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Immersion
 * @since Immersion 1.0
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="initial-scale=1.0, width=device-width" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged, $gpp;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'immersion' ), max( $paged, $page ) );

	?></title>

	<?php
	 // Favicon
  	if ( isset( $gpp['immersion_custom_favicon'] ) )
	 		$favicon = $gpp['immersion_custom_favicon'];
    if ( isset( $favicon ) && ( $favicon != '' ) ) {
        echo '<link rel="shortcut icon" href="'.  $favicon  .'" />'."\n";
    }
	?>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<link rel="stylesheet" href="<?php echo get_template_directory_uri().'/lib/js/prettyPhoto/css/prettyPhoto.css'; ?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri().'/lib/js/flexSlider/flexslider.css'; ?>" type="text/css" media="screen" />
<?php wp_head(); ?>

</head>

<body lang="en" <?php body_class(); ?>>
<?php do_action( 'gpp_before_page' ); ?>

<nav id="access" role="navigation">
    <h1 class="assistive-text"><?php _e( 'Main menu', 'immersion' ); ?></h1>
    <div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'immersion' ); ?>"><?php _e( 'Skip to content', 'immersion' ); ?></a></div>

    <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'menu clearfix' ) ); ?>

</nav><!-- #access -->

<div id="page" class="hfeed">

<?php do_action( 'gpp_before_header' ); ?>
	<header id="branding" role="banner">
        <?php if (has_nav_menu('top-right')) wp_nav_menu( array( 'theme_location' => 'top-right', 'menu_class' => 'menu-top-right social clearfix' ) ); ?>
        <?php if (has_nav_menu('top-right-secondary')) wp_nav_menu( array( 'theme_location' => 'top-right-secondary', 'menu_class' => 'menu-top-right secondary clearfix' ) ); ?>
		<hgroup>
		    <h1 id="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php if($gpp['immersion_logo'] <> "") { ?><img class="sitetitle" src="<?php echo $gpp['immersion_logo']; ?>" alt="<?php bloginfo( 'name' ); ?>" /><?php  } else { bloginfo( 'name' ); } ?></a></h1>
			<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
		</hgroup>
	</header><!-- #branding -->
<?php do_action( 'gpp_after_header' ); ?>

	<div id="main">
	    <div id="primary-wrap">