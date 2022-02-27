<?php

function gpp_base_options(){

	// Global Variables
	global $themename, $css, $footerwidgets, $showfooterwidgets, $showsidebar, $showhomewidget, $gpp_base_child_options, $showsidebaroption, $showhomewidgetoption, $showblogoption, $arraycount, $categories, $multicheckcats, $shortname;
	
	// Get Wordpress Categories
	$cats_array = get_categories();
	$categories = array();
	$multicheckcats = array();
	foreach ( $cats_array as $cats ) {
		$categories[0] = "";
		$categories[$cats->cat_ID] = $cats->cat_name;
		$multicheckcats[$cats->cat_ID] = $cats->cat_name;	
	}
	
	if ( ! isset( $themename ) ) { $themename = "Base"; }
	if ( ! isset( $showsidebar) ) { $showsidebar = "true"; }
	if ( ! isset( $showhomewidget ) ) { $showhomewidget = "true"; }
		
	$footerwidgets=array( "1"=>"One", "2"=>"Two", "3"=>"Three", "4"=>"Four" );
	$creditsposition=array( "Below Footer Widgets (Full Width)", "Last Fixed Footer Widget" );
	$instructionsurl = admin_url('/themes.php?page=gpp-instructions-page');
	$supporturl = 'http://graphpaperpress.com/support/';
	$shortname = "gpp_base";
	
	// Access the WordPress Categories via an Array
	$gpp_base_categories = array();  
	$gpp_base_categories_obj = get_categories( 'hide_empty=0' );
	foreach ( $gpp_base_categories_obj as $gpp_base_cat ) {
	    $gpp_base_categories[$gpp_base_cat->cat_ID] = $gpp_base_cat->cat_name;
	}
	$categories_tmp = array_unshift( $gpp_base_categories, "Select a category:" );    
	       
	// Access the WordPress Pages via an Array
	$gpp_base_pages = array();
	$gpp_base_pages_obj = get_pages( 'sort_column=post_parent,menu_order' );    
	foreach ( $gpp_base_pages_obj as $gpp_base_page ) {
	    $gpp_base_pages[$gpp_base_page->ID] = $gpp_base_page->post_name; }
	$gpp_base_pages_tmp = array_unshift( $gpp_base_pages, "Select a page:" );       


	// More Options
	$all_uploads_path = home_url() . '/wp-content/uploads/';
	$all_uploads = get_option( 'gpp_base_uploads' );

	
	// Theme Options
	$options = array();   
	
	$options[] = array(	
					"name" => "General Settings",
					"type" => "heading"
				);
	if ( strlen( $arraycount ) > 1 ) {
		$options[] = array( 
						"name" => "Application order",
						"desc" => "Drag and drop the blocks to arrange the display flow of the applications.",
						"id" => $shortname."_appsorder",
						"std" => $arraycount,
						"type" => "dragdrop"
					);
	}
						
	$options[] = array( 
					"name" => "Logo",
					"desc" => apply_filters( 'logo_desc', "Upload a logo for your theme, or specify the image address of your online logo. (http://yoursite.com/logo.png).  Logos should be in transparent PNG format and be 60px in max height and 350px in max width.  If you don't upload a logo, your site name will appear in unstyled html text." ),
					"id" => $shortname."_logo",
					"std" => "",
					"type" => "upload"
				);
						                                                                                     
	$options[] = array( 
					"name" => "Custom Favicon",
					"desc" => "Upload a 16px x 16px Png/Gif image that will represent your website's favicon.",
					"id" => $shortname."_custom_favicon",
					"std" => "",
					"type" => "upload"
				);
	
	$options[] = array( 
					"name" => "SEO Plugin?",
					"desc" => "Check this if you are using SEO plugins. Checking this option will allow your SEO plugin to easily rewrite the titles of your posts and pages and allow you to craft an SEO-friendly site description.  If you don't use an SEO plugin, this theme will use the Tagline of your site, which you can set at Settings -> General -> Tagline.",
					"id" => $shortname."_seo",
					"std" => "false",
					"type" => "checkbox"
				);
	
	$options[] = array( 
					"name" => "Comments",
					"desc" => "Check this to hide 'Comments are closed' message if comments are disabled on posts.",
					"id" => $shortname."_commentsclosed",
					"std" => "true",
					"type" => "checkbox"
				);
	
	$options[] = array(	
					"name" => "Mobile video",
					"desc" => "Check to enable the ability to show mobile videos in iPhone, iPad and other devices with Flash disabled.  Please refer the theme instructions for detailed instructions.",
					"id" => $shortname."_iphone",
					"std" => "false",
					"type" => "checkbox"
				);
	                                               
	$options[] = array( 
					"name" => "Analytics Tracking",
					"desc" => "Paste your Google Analytics Account Number (UA-xxxxxx-x) here. This will be added into the footer of the theme. <a href=\"http://www.google.com/support/analytics/bin/answer.py?hl=en&answer=81977\" target=\"_blank\">Help me find my Account Number &raquo;</a>",
					"id" => $shortname."_tracking_code",
					"std" => "",
					"type" => "text"
				);        
	
	$options[] = array( 
					"name" => "RSS URL",
					"desc" => "Enter your preferred RSS URL. (Feedburner or other)",
					"id" => $shortname."_feedburner_url",
					"std" => "",
					"type" => "text"
				);
						
	$options[] = array( 
					"name" => "Affiliate Link",
					"desc" => "Enter your Graph Paper Press Affiliate Link here.  When one of your visitors clicks the Graph Paper Press link in the footer of your site and then signs up for a paid account, you will earn 25% commission.  This is an easy way to generate passive income, so be sure to copy and paste <a href=\"http://graphpaperpress.com/members/aff.php?action=links\" target=\"_blank\">your Affiliate Link on your Member Dashboard</a> into the input field at the left.",
					"id" => $shortname."_affiliate_url",
					"std" => "",
					"type" => "text"
				);
				
	$options[] = array( 
					"name" => "Help Us Help You",
					"desc" => "Keep your site updated and secure by sending Graph Paper Press and PressTrends anonymous usage data.  This lets us see things such as which versions of WordPress and our themes are in use, average number of plugins installed, etc.  This also enables us to alert you when your site might have a security vulnerability.  None of your personal data is sent to us or to PressTrends.",
					"id" => $shortname."_press_trends",
					"std" => "",
					"type" => "checkbox"
				);
	
	               
	$options[] = array(	
					"name" => "Colors and Fonts",
					"type" => "heading"
				);
						
	$options[] = array( 
					"name" => "Select Color Theme",
					"desc" => "Select your desired theme color scheme.",
					"id" => $shortname."_alt_css",
					"std" => "",
					"type" => "select",
					"options" => $css
				);
						                 
	$options[] = array( 
					"name" => "Google Font API",
	                "desc" => "Add your desired font from <a href=\"http://code.google.com/webfonts\" target=\"_blank\">Google Font Directory</a>. e.g. Droid+Serif. For more fonts, try Short+Stack|Inconsolata|Droid+Sans",
	                "id" => $shortname."_google_font",
	                "std" => "",
	                "type" => "text"
				);
	                    
	$options[] = array(	
					"name" => "Apply Fonts to all",
					"desc" => "Check this option to apply Google Fonts to entire site. If you do not wish to apply to entire site, you can use it individually in the Custom CSS textarea below.",
					"id" => $shortname."_google_fonts_all",
			    	"std" => "false",
			    	"type" => "checkbox"
				);
	
	$options[] = array( 
					"name" => "Custom CSS",
	                "desc" => "Quickly add some CSS to your theme by adding it to this block.",
	                "id" => $shortname."_custom_css",
	                "std" => "",
	                "type" => "textarea"
				);
	
	// show blog if only it needs					
	if ( $showblogoption ) {								
		$options[] = array(	
						"name" => "Blog",
						"type" => "heading"
					);
							
		$options[] = array( 
						"name" => "Blog Category" ,
						"desc" => "Choose the categories to be displayed in the blog template page",
						"id" => $shortname."_blog_cat",
						"std" => false,
						"type" => "multicheck",
						"options" => $multicheckcats,
						"pid" => $shortname."_blog"
					);
	}
	
								
	$options[] = array(	
					"name" => "Widgets",
					"type" => "heading"
				);
						
	$options[] = array(	
					"name" => "Instructions",
					"desc" => apply_filters( 'instructions_desc', "This theme uses Widgets to add and sort things like Slideshows, Category Columns, Welcome Messages, etc.<br /><br /><a href=\"plugin-install.php?tab=search&type=tag&s=graphpaperpress&plugin-search-input=Search+Plugins\">Install Widget Plugins</a>, then <a href=\"widgets.php\">Configure Your Widgets</a>" ),
					"type" => "help"
				);
						
	// show sidebar only if it needs					
	if ( $showhomewidgetoption ) {					
		$options[] = array(	
						"name" => "Home Widget",
						"desc" => apply_filters( 'homewidget_desc', 'Check to show homewidget on home pages.' ),
				    	"id" => $shortname."_home_widget",
				    	"std" => $showhomewidget,
				   		"type" => "checkbox"
					);			   		
	}					
						
	// show sidebar only if it needs					
	if ( $showsidebaroption ) {					
		$options[] = array(	
						"name" => "Sidebar",
						"desc" => apply_filters( 'sidebar_desc', 'Check to show a sidebar on all posts and pages.' ),
				    	"id" => $shortname."_sidebar",
				    	"std" => $showsidebar,
				   		"type" => "checkbox"
					);			   		
	}
						
	$options[] = array(	
					"name" => "Show Footer Widgets",
					"desc" => "Check this to show footer widgets",
				    "id" => $shortname."_footer",
				    "std" => $showfooterwidgets,
				   	"type" => "checkbox"
				);
						
	$options[] = array(	
					"name" => "No of Footer Widgets",
					"desc" => "Choose the number of footer widgets to be displayed.",
				    "id" => $shortname."_footer_widgets",
				    "std" => "4",
				   	"type" => "select",
					"options" => $footerwidgets,
					"pid" => $shortname."_footer"
				);				
				
	// apply hook to receive child theme options			
	$gpp_base_child_options = apply_filters( 'gpp_base_child_options_hook', $gpp_base_child_options );

	if ( is_admin() && $gpp_base_child_options != "" ) {
		foreach( $gpp_base_child_options as $opt ) {
			$options[] = $opt;
		}
	}
					
	update_option( 'gpp_base_template', $options );      
	update_option( 'gpp_base_themename', $themename );   
	update_option( 'gpp_base_shortname', $shortname );
	update_option( 'gpp_base_instructions', $instructionsurl );
	update_option( 'gpp_base_support', $supporturl );
	   

} //end options

add_action( 'init', 'gpp_base_options' ); 