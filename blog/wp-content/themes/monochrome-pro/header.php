<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>> 
<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<title><?php wp_title(''); ?><?php if ( !(is_404()) && (is_single()) or (is_page()) or (is_archive()) ) { ?> :: <?php } ?>
<?php bloginfo('name'); ?></title>

	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
	
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />  
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/flexslider.css" type="text/css" />                                                                                                           
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/print.css" type="text/css" media="print" /> 
	<?php if ( function_exists( 'get_option_tree' ) && get_option_tree( 'gpp_custom_css' ) <> '') { ?>
	    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/dynamic.css" type="text/css" />
	    <?php } ?>
	    
	
<!--[if IE]><link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/lib/ie.css" type="text/css" media="screen, projection" /><![endif]--> 

<!--[if lt IE 7]>
	<script defer type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/pngfix.js"></script>
	<![endif]-->
<!--[if gte IE 5.5]>
   <script language="javaScript" src="<?php echo get_template_directory_uri(); ?>/js/dhtml.js" type="text/javaScript"></script>
<script language="javaScript" src="<?php echo get_template_directory_uri(); ?>/js/dhtml2.js" type="text/javaScript"></script>
   <![endif]-->
<!-- Show the grid and baseline  -->
<style type="text/css">
/*		.container { background: url(echo get_template_directory_uri();/css/lib/img/grid.png); }*/
	</style> 
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?>  
	<?php wp_head(); ?>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.flexslider-min.js"></script>   
	
	<script type="text/javascript">
     jQuery(window).load(function() {  


               $('.flexslider').flexslider({
                     directionNav: false,
                     controlNav: true,
                     slideshowSpeed: 6000
                 });


    		});

    </script>
</head>
<body <?php body_class(); ?>>
<div class="container">
<div class="container-bg">

<!-- Top Navigation -->
<?php if (function_exists('wp_nav_menu'))  {
		wp_nav_menu( 'sort_column=menu_order&container=&menu_id=navmenu-h-r&theme_location=top-menu&fallback_cb=' );
	 } ?>
	 
<!-- Search -->
	<?php get_search_form(); ?>
	
<!-- Logo --> 
<div class="logo">
 <?php
     
    if ( function_exists( 'get_option_tree') && get_option_tree( 'monochromepro_logo') <>'') { ?>
        <a href="<?php echo home_url(); ?>/" title="Return to the frontpage"><img src="<?php get_option_tree( 'monochromepro_logo', '', true ); ?>" id="logo-image" alt="logo image" /></a>
      
   <?php } else { ?> 
       
       <h1><a href="<?php echo home_url(); ?>/" title="Return to the frontpage"><?php bloginfo('name'); ?></a></h1>
       
   <?php } ?>
</div>


<?php
		if ( is_singular() &&
				has_post_thumbnail( $post->ID ) &&
				( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array( '950', '400' ) ) ) &&
				$image[1] >= HEADER_IMAGE_WIDTH ) :
			// Houston, we have a new header image!
			echo get_the_post_thumbnail( $post->ID, '950x400' );
		elseif ( get_header_image() ) : ?>
			<img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="<?php bloginfo('name'); ?>" class="headerimg" />
	<?php endif; ?>

<!-- Navigation -->
<div class="column span-24 large" id="nav">
<div class="content">
<?php if (function_exists('wp_nav_menu')) {
		wp_nav_menu( 'sort_column=menu_order&container=&menu_id=navmenu-h&theme_location=main-menu&fallback_cb=' );
  
      } ?> 
      
</div>
</div>
