<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; Blog Archive <?php } ?> <?php wp_title(); ?></title>
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); wp_head(); ?>

<!-- Favicon -->
<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicon.png" type="image/png" />
<link rel="icon" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicon.png" type="image/png" />	
	
<!-- lightbox css -->
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/js/lg/css/prettyPhoto.css" type="text/css" media="screen" />

<?php wp_get_archives('type=monthly&format=link'); ?>
<?php wp_head(); ?>

<!-- retive admin code -->
<?php include("include/retrive_admin.php"); ?>

<!-- header analytics script-->
<?php echo stripslashes($p_header_scripts); ?>

</head>
<body>

<?php include("include/control_panel.php"); ?>
<?php include("include/login_form.php"); ?>

<div id="top">
	<div class="wrap">
		<ul id="menu">
			<li><a href="<?php echo get_settings('home'); ?>/" title="Home">HOME</a></li>
			<?php wp_list_pages('depth=1&sort_column=menu_order&title_li=' . __('') . '' ); ?>
		
			<!-- RSS -->	
			<?php $key = $p_feedburner_url;
			if($key !== '') {?>
				<li class="rss"><a href="<?php echo $key; ?>">RSS</a> </li>
			<?php } else { ?> 
			 	  <li class="rss"><a href="<?php bloginfo('rss2_url'); ?>">RSS</a></li>
			<?php } ?>
		
			<!-- Print login link, if user logged in, print hello USERNAME -->					
			<?php global $user_ID, $user_identity, $user_level ?>
			<?php if ( $user_ID ) : ?>               
		    	<li>Hello <strong><?php echo $user_identity ?></strong>!  <a href="<?php echo wp_logout_url(); ?>">Logout</a></li>
		    <?php else : ?>             
		   		<li class="login"><a href="#" id="trigger">Login</a></li>  
			 <?php endif // get_option('users_can_register') ?>
		</ul><!-- #menu -->
	</div><!-- .wrap -->
</div><!-- #top -->

<div class="wrap">
	<div id="header">
		<!-- if have logo from option page, print logo instead of text -->
		<?php if($p_logo == "") { ?>
			<h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
		<?php } else { ?>
			<!-- MODIFY YOUR LOGO HERE -->
			<a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><img src="<?php echo $p_logo; ?>" alt="" /></a>
		<?php } ?>
	</div><!-- #header -->