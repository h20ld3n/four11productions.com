<?php load_theme_textdomain('rgb'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes();?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title>
<?php if ( is_page() or is_single() ) { 	the_title(); } elseif ( is_category() ) { printf(__('Category Archive for \'%s\'','rgb'), single_cat_title('', false) ); } elseif ( function_exists('is_tag') && is_tag()) { if (function_exists('single_tag_title') ) { printf(__('Tag Archive for \'%s\'','rgb'), single_tag_title('', false)); } elseif (!function_exists('single_tag_title') ) { printf(__('Tag Archive for \'%s\'','rgb'), get_query_var('tag')); } } elseif ( is_archive() ) { printf(__('%s Archive','rgb'), wp_title('', false)); } elseif ( is_search() ) { printf(__('Search Results for \'%s\'','rgb'), attribute_escape(stripslashes(get_query_var('s')))); } if ( !is_home() and !is_404() ) { _e(' at ','rgb'); } bloginfo('name'); ?>
</title>
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
<meta name="description" content="<?php bloginfo('description'); ?>" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<!--[if gte IE 6]>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/ie6.css" type="text/css" media="screen" />
<![endif]-->
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php if ( get_option('rgb_rss') != '') { echo (get_option('rgb_rss')); } else { echo bloginfo('rss2_url'); } ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Comments Rss" href="<?php bloginfo('comments_rss2_url'); ?>" />
<?php if (is_single() || is_page()) { ?>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php } ?>
<?php if((get_option('rgb_uitabs') == 1 || get_option('rgb_shelf') == 1)) { ?>
<?php wp_enqueue_script('jquery'); ?>
<?php if(get_option('rgb_uitabs') == 1) { ?>
<?php wp_enqueue_script('jquery-ui-core'); ?>
<?php wp_enqueue_script('jquery-ui-tabs'); ?>
<?php } ?>
<?php if(get_option('rgb_shelf') == 1) { ?>
<?php wp_enqueue_script('thickbox'); ?>
<link rel="stylesheet" href="<?php bloginfo('wpurl'); ?>/wp-includes/js/thickbox/thickbox.css" type="text/css" media="screen" />
<?php } ?>
<?php } ?>
<?php wp_head(); ?>
<?php if(get_option('rgb_uitabs') == 1) { ?>
<script type="text/javascript">
jQuery.noConflict();
jQuery(function() {
	jQuery('#sidebar > ul#ui-tabs').tabs({ fx: { opacity: 'toggle' } });
});
</script>
<?php } ?>
<?php if(get_option('rgb_shelf') == 1) { ?>
<script type="text/javascript">
var tb_pathToImage = "<?php echo get_template_directory_uri(); ?>/images/loadingAnimation.gif";
var tb_closeImage = "<?php echo get_template_directory_uri(); ?>/images/tb-close.png";
</script>
<?php } ?>
</head>
<body>
<div id="container">
<div id="header">
  <div id="headerimg">
    <h1><a href="<?php echo get_settings('home'); ?>/">
      <?php bloginfo('name'); ?>
      </a></h1>
    <p class="description">
      <?php bloginfo('description'); ?>
    </p></div></div>
    <div id="navwrap">
    <ul id="nav">
      <?php if ('page' != get_option('show_on_front')) { ?>
      <li class="<?php if ( is_home() || is_archive() || is_single() || is_paged() || is_search() || is_tag() ) { ?>current_page_item<?php } else { ?>page_item<?php } ?>"> <a href="<?php echo get_settings('home'); ?>/" title="<?php _e('Blog','rgb'); ?>">
        <?php _e('Blog','rgb'); ?>
        </a> </li>
      <?php } ?>
      <?php wp_list_pages('title_li=&depth=1&sort_column=menu_order&exclude='. get_option('rgb_hidepages'));?>
      <li class="rss"><a href="<?php if ( get_option('rgb_rss') != '') { echo (get_option('rgb_rss')); } else { echo bloginfo('rss2_url'); } ?>" title="<?php _e('RSS Feed for Blog Entries','rgb'); ?>">
        <?php _e('RSS','rgb'); ?>
        </a></li>
      <?php wp_register(); ?>
      <?php include (TEMPLATEPATH . '/searchform.php'); ?>
    </ul></div>


<hr />
<div id="content">
