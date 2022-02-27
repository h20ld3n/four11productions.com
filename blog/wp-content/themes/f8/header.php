<?php global $gpp; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">

    <title><?php wp_title( '-', true, 'right' ); echo esc_html( get_bloginfo('name'), 1 ); ?></title>

    <meta http-equiv="content-type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />
	
	<?php if(is_search()) { ?>
	<meta name="robots" content="noindex, nofollow" /> 
    <?php }?>
    
<!-- BeginStyle -->
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/styles/print.css" type="text/css" media="print" />
	<!--[if IE]><link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/styles/ie.css" type="text/css" media="screen, projection" /><![endif]-->
<!-- EndStyle -->

	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php if ( $gpp['gpp_feedburner_url'] <> "" ) { echo $gpp['gpp_feedburner_url']; } else { echo get_bloginfo_rss('rss2_url'); } ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php wp_head(); ?>
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	<script type="text/javascript"> 
		jQuery(document).ready(function() { 
		    jQuery('.mover').hide();
		        jQuery('#slideToggle').click(function(){
		            jQuery(this).siblings('.mover').slideToggle();
		        }); 
		}); 
	</script>
	
	<!-- Conditional Javascripts -->
	<!--[if IE 6]>
	<script src="<?php echo get_template_directory_uri(); ?>/includes/js/pngfix.js"></script>	
	<![endif]-->
	<!-- End Conditional Javascripts -->

</head>

<body <?php body_class(); ?>>
<!-- BeginHeader -->
<div class="container">
<div class="container-inner">
<!-- EndHeader --> 

<?php get_template_part('inside');  ?>
<!-- BeginHeader -->
<div id="masthead">
<div id="logo">
	<h1 class="sitename"><a href="<?php echo home_url(); ?>" title="<?php bloginfo('description'); ?>"><?php if($gpp['gpp_logo_off']=="true") { ?><img class="sitetitle" src="<?php if ( $gpp['gpp_logo'] <> "" ) { echo $gpp['gpp_logo']; } else { echo get_stylesheet_directory_uri(); ?>/images/logo.png<?php } ?>" alt="<?php bloginfo('name'); ?>" /><?php  } else { bloginfo('name'); } ?></a></h1>
           
   	<div class="description"><?php bloginfo('description'); ?></div>
</div>

	<?php
	$email = '';
	$phone = '';
	
	if(isset($gpp['gpp_contact_info']) && $gpp['gpp_contact_info'] == 'true') {
	$contact_info = $gpp['gpp_contact_info']; 
    }
    if(isset($gpp['gpp_email']) && $gpp['gpp_email'] <> '') {
 	$email = $gpp['gpp_email'];
    }
 	if(isset($gpp['gpp_phone']) && $gpp['gpp_phone'] <> '') {
 	$phone = $gpp['gpp_phone'];
    }
    
 	if ($email === FALSE) { $emailval = "you@email.com"; } else { $emailval = $gpp['gpp_email'];}
 	if ($phone === FALSE) { $phoneval = "1-800-867-5309"; } else { $phoneval = $gpp['gpp_phone'];}
 	
    if ( $gpp['gpp_contact_info'] == 'true' || $gpp['gpp_contact_info'] === FALSE) { ?>
        <ul class="right">
                <?php if(($phone === FALSE || $phone != "")) { ?><li><a href="tel:<?php echo $phoneval; ?>" class="icon phone" title="<?php echo $phoneval; ?>"><?php echo $phoneval; ?></a></li><?php } ?>
                <?php if(($email === FALSE || $email != "")) { ?><li><a href="mailto:<?php echo $emailval; ?>" class="icon email" title="<?php _e('email me','gpp_i18n'); ?>"><?php _e('email me','gpp_i18n'); ?></a></li><?php } ?>
        </ul>
    <?php } ?>
</div>
<div class="clear"></div>

<!-- EndHeader -->
<?php if (is_home()) { ?>
<?php if ( $gpp['gpp_video'] == 'true' ) { 
     get_template_part('/apps/video-home');
} ?>
<?php if ( $gpp['gpp_slideshow'] == 'true' || $gpp['gpp_slideshow']=== FALSE ) { 
     get_template_part('/apps/slideshow');
} ?>
<?php } ?>
<!-- BeginHeader -->
<?php wp_nav_menu( 'sort_column=menu_order&menu_class=sf-menu&theme_location=main-menu' ); ?>
<!-- EndHeader -->