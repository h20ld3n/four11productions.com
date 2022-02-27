<?php

function gpp_theme_options(){

	// Global Variables
	global  $css, $footerwidgets, $showfooterwidgets;


	$footerwidgets = array( "1" => "One", "2" => "Two", "3" => "Three" );

	// Available css themes
	$css = array( "default.css" => "Light", "dark.css" => "Dark");

	$defaultcss = "default.css";

	// Thumbnail Orientation
	$orientation = array( "landscape" => "Landscape", "portrait" => "Portrait", "square" => "Square" );

	// Archive Columns
	$columns = array( "1" => "One Column", "2" => "Two Columns", "3" => "Three Columns" );

	// Content or Excerpt or None
	$cen = array( "the_content" => "Full Content", "the_excerpt" => "Excerpt Content", "" => "None" );

	// Theme Options
	$options = array();

	$options[] = array(
					"name" => "General Settings",
					"type" => "heading"
				);

	$options[] = array(
					"name" => "Logo",
					"desc" => apply_filters( 'logo_desc', "Upload a logo for your theme, or specify the image address of your online logo. (http://yoursite.com/logo.png).  Logos should be in transparent PNG format and be 60px in max height and 350px in max width.  If you don't upload a logo, your site name will appear in unstyled html text." ),
					"id" => GPP_THEME_SHORTNAME."_logo",
					"std" => "",
					"type" => "image"
				);

	$options[] = array(
					"name" => "Custom Favicon",
					"desc" => "Upload a 16px x 16px Png/Gif image that will represent your website's favicon.",
					"id" => GPP_THEME_SHORTNAME."_custom_favicon",
					"std" => "",
					"type" => "image"
				);

	// $options[] = array(
	// 				"name" => "RSS URL",
	// 				"desc" => "Enter your preferred RSS URL. (Feedburner or other)",
	// 				"id" => GPP_THEME_SHORTNAME."_feedburner_url",
	// 				"std" => "",
	// 				"type" => "text"
	// 			);

	$options[] = array(
					"name" => "Affiliate Link",
					"desc" => "Enter your Graph Paper Press Affiliate Link here.  When one of your visitors clicks the Graph Paper Press link in the footer of your site and then signs up for a paid account, you will earn 25% commission.  This is an easy way to generate passive income, so be sure to copy and paste <a href=\"http://graphpaperpress.com/members/aff.php?action=links\" target=\"_blank\">your Affiliate Link on your Member Dashboard</a> into the input field at the left.",
					"id" => GPP_THEME_SHORTNAME."_affiliate_url",
					"std" => "",
					"type" => "text"
				);

	// $options[] = array(
	// 				"name" => "Help Us Help You",
	// 				"desc" => "Keep your site updated and secure by sending Graph Paper Press and PressTrends anonymous usage data.  This lets us see things such as which versions of WordPress and our themes are in use, average number of plugins installed, etc.  This also enables us to alert you when your site might have a security vulnerability.  None of your personal data is sent to us or to PressTrends.",
	// 				"id" => GPP_THEME_SHORTNAME."_press_trends",
	// 				"std" => "",
	// 				"type" => "checkbox"
	// 			);


	$options[] = array(
					"name" => "Colors and Fonts",
					"type" => "heading"
				);

	$options[] = array(
					"name" => "Select Color Theme",
					"desc" => "Select your desired theme color scheme.",
					"id" => GPP_THEME_SHORTNAME."_alt_css",
					"std" => "",
					"type" => "select",
					"options" => $css
				);

	$options[] = array(
					"name" => "Google Font API",
	                "desc" => "Add your desired font from <a href=\"http://code.google.com/webfonts\" target=\"_blank\">Google Font Directory</a>. e.g. Droid+Serif. For more fonts, try Short+Stack|Inconsolata|Droid+Sans",
	                "id" => GPP_THEME_SHORTNAME."_google_font",
	                "std" => "",
	                "type" => "text"
				);

	$options[] = array(
					"name" => "Apply Fonts to all",
					"desc" => "Check this option to apply Google Fonts to entire site. If you do not wish to apply to entire site, you can use it individually in the Custom CSS textarea below.",
					"id" => GPP_THEME_SHORTNAME."_google_fonts_all",
			    	"std" => "false",
			    	"type" => "checkbox"
				);

	$options[] = array(
					"name" => "Custom CSS",
	                "desc" => "Quickly add some CSS to your theme by adding it to this block.",
	                "id" => GPP_THEME_SHORTNAME."_custom_css",
	                "std" => "",
	                "type" => "textarea"
				);

	$options[] = array(
					"name" => "Layout",
					"type" => "heading"
				);

	$options[] = array(
					"name" => "Post Content Display",
					"desc" => "Select what you want to display on the homepage and archive pages.",
			    	"id" => GPP_THEME_SHORTNAME."_cen",
			    	"std" => "",
			   		"type" => "select",
					"options" => $cen
				);

	$options[] = array(
					"name" => "Thumbnail Orientation",
					"desc" => "Select your preferred orientation of post thumbnails.",
			    	"id" => GPP_THEME_SHORTNAME."_orientation",
			    	"std" => "",
			   		"type" => "select",
					"options" => $orientation
				);

	$options[] = array(
					"name" => "Archive Columns",
					"desc" => "Select the number of columns you want on your archives.",
			    	"id" => GPP_THEME_SHORTNAME."_columns",
			    	"std" => "",
			   		"type" => "select",
					"options" => $columns
				);

	$options[] = array(
					"name" => "Sidebar",
					"desc" => apply_filters( 'sidebar_desc', 'Check to show a sidebar on all posts and pages.' ),
			    	"id" => GPP_THEME_SHORTNAME."_sidebar",
			    	"std" => true,
			   		"type" => "checkbox"
				);

	$options[] = array(
					"name" => "Show Footer Widgets",
					"desc" => "Check this to show footer widgets",
				    "id" => GPP_THEME_SHORTNAME."_footer",
				    "std" => $showfooterwidgets,
				   	"type" => "checkbox"
				);

	$options[] = array(
					"name" => "No of Footer Widgets",
					"desc" => "Choose the number of footer widgets to be displayed.",
				    "id" => GPP_THEME_SHORTNAME."_footer_widgets",
				    "std" => "3",
				   	"type" => "select",
					"options" => $footerwidgets,
					"pid" => GPP_THEME_SHORTNAME."_footer"
				);

	$options[] = array(
					"name" => "Infinite Scroll",
					"desc" => "Check this to enable infiniate scrolling when a user reaches the bottom of your homepage posts and archive pages.",
					"id" => GPP_THEME_SHORTNAME."_infinite_scroll",
					"std" => "false",
					"type" => "checkbox"
				);

	update_option( GPP_THEME_SHORTNAME.'_template', $options );


} //end options

add_action( 'init', 'gpp_theme_options' );