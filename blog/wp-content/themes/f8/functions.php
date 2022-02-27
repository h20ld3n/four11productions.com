<?php

// Define Theme Options Variables

$themename='F8';
$thumbnailsize = "310 x 150 pixels";
$gppslideshow = "true";
$thumbslider = "false";
$featured = "true";
$category_columns = "false";
$default_thumb = get_stylesheet_directory_uri() . "/images/default-thumb.jpg";

function load_ie_head() { ?><!--[if IE]><link href="<?php echo get_stylesheet_directory_uri(); ?>/ie-folio.css" rel="stylesheet" type="text/css" /><![endif]--><?php }
add_action('wp_head', 'load_ie_head');

function f8_options() {
$shortname = "gpp";

$options[] = array(	"name" => __('Extend Featured Section','gpp_i18n'),
					"desc" => __('Check this to extend Thumbnails Section to 3 columns.','gpp_i18n'),
					"id" => $shortname."_featured_columns",
					"std" => "false",
					"type" => "checkbox");
return $options;
}
add_filter('childtheme_options', 'f8_options');

?>