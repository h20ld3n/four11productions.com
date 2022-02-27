<?php
/* Theme Created by Rajbir Dhaliwal */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php bloginfo('name'); ?> <?php wp_title('&raquo;', true, 'left'); ?> </title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />


<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<?php wp_head(); ?>
</head>
<body>
<div id="container">



				<div id="header">
					<h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
					<h3><?php bloginfo('description'); ?></h3>



				</div>

				<div id="rss">
					<a href="<?php bloginfo('rss2_url'); ?>"><img src="http://rajbirdhaliwal.com/themetest/wp-content/themes/Blackout/images/rss.jpg"></a>
				</div>

				<div class="clear">
				</div>

				<div id="navigation">
					<ul>
						<li style="border-style:none"><a href="<?php echo get_option('home'); ?>/">Home</a></li>

								<?php wp_list_pages('depth=1&sort_column=menu_order&title_li='); ?>

						<?php
							if($post->post_parent)
								$children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0"); else
								$children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
							if ($children) { ?>

							<?php } ?>


				   </ul>
			   </div>


			<div id="grey-back-one">
			</div>

			<div id="grey-back-two">
			</div>
<div id="body-content">

<?php get_search_form(); ?>