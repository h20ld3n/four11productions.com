<?php

/*-----------------------------------------------------------------------------------*/
/* HEADER.PHP - HEAD profile */
/*-----------------------------------------------------------------------------------*/

function gpp_base_head_profile() {
    $content = '<head profile="http://gmpg.org/xfn/11">' . "\n";
    echo apply_filters( 'gpp_base_head_profile', $content );
} // end gpp_base_head_profile


/*-----------------------------------------------------------------------------------*/
/* HEADER.PHP - TITLE */
/*-----------------------------------------------------------------------------------*/

function gpp_base_doctitle() {
	global $author;
	$site_name = get_bloginfo( 'name' );
    $separator = '|';
    $user_info = get_userdata( $author );    	
    if ( is_single() ) {
		$content = single_post_title( '', FALSE );
    } elseif ( is_home() || is_front_page() ) { 
		$content = get_bloginfo( 'description' );
    } elseif ( is_page() ) { 
		$content = single_post_title( '', FALSE ); 
    } elseif ( is_search() ) { 
		$content = __( 'Search Results for:', 'gpp_base_lang' ); 
		$content .= ' ' . esc_html( stripslashes( get_search_query() ), true );
    } elseif ( is_category() ) {
		$content = __( 'Category Archives:', 'gpp_base_lang' );
		$content .= ' ' . single_cat_title( "", false );
    } elseif ( is_tag() ) { 
		$content = __( 'Tag Archives:', 'gpp_base_lang' );
		$content .= ' ' . get_query_var( 'tag' );
	} elseif ( is_author() ) { 
		$content = __( 'Archives for:', 'gpp_base_lang' );
		$content .= ' ' . $user_info->display_name;		
	} elseif ( is_month() ) { 
		$content = __( 'Archives for:', 'gpp_base_lang' );
		$content .= ' ' . single_month_title( "", false );
	} elseif ( is_date() ) { 
		$content = __( 'Archives for:', 'gpp_base_lang' );
		$content .= ' ' . get_the_date();
	} elseif ( is_archive() ) {
		$content = __( 'Archives for:', 'gpp_base_lang' );
		$content .= ' ' . single_term_title( "", false );
    } elseif ( is_404() ) { 
		$content = __( 'Not Found', 'gpp_base_lang' ); 
    } else { 
		$content = get_bloginfo( 'description' );
    }

    if ( get_query_var( 'paged' ) ) {
		$content .= ' ' .$separator. ' ';
		$content .= 'Page';
		$content .= ' ';
		$content .= get_query_var( 'paged' );
    }

    if( $content ) {
     
      $elements = array(
					'site_name' => $site_name,
					'separator' => $separator,
					'content' => $content
				  );

    } else {
		$elements = array(
					'site_name' => $site_name
					);
    }

    // Filters should return an array
    $elements = apply_filters( 'gpp_base_doctitle', $elements );
	
    // But if they don't, it won't try to implode
    if ( is_array( $elements ) ) {
		$doctitle = implode( ' ', $elements );
    } else {
		$doctitle = $elements;
    }
    
    $doctitle = "<title>" . $doctitle . "</title>" . "\n";
    
    echo $doctitle;
} // end gpp_base_doctitle


/*-----------------------------------------------------------------------------------*/
/* HEADER.PHP - CONTENT TYPE */
/*-----------------------------------------------------------------------------------*/

function gpp_base_create_contenttype() {
  $content = "<meta http-equiv=\"Content-Type\" content=\"";
  $content .= get_bloginfo( 'html_type' ); 
  $content .= "; charset=";
  $content .= get_bloginfo( 'charset' );
  $content .= "\" />";
  $content .= "\n";
  echo apply_filters( 'gpp_base_create_contenttype', $content );
} // end gpp_base_create_contenttype


/*-----------------------------------------------------------------------------------*/
/* HEADER.PHP - META DESCRIPTION */
/*-----------------------------------------------------------------------------------*/

function gpp_base_show_description() {
	global $gpp;
	$content = "<meta name=\"description\" content=\"";
	$content .= get_bloginfo( 'description' ); 
	$content .= "\" />";
	$content .= "\n";	
	echo apply_filters( 'gpp_base_show_description', $content );
	
} // end gpp_base_show_description


/*-----------------------------------------------------------------------------------*/
/* HEADER - META ROBOTS */
/*-----------------------------------------------------------------------------------*/

function gpp_base_show_robots() {
	global $content;
   // if(is_search()) { 
    $content = "<meta name=\"robots\" content=\"noindex, nofollow\" />";
    $content .= "\n";
	//}
    echo apply_filters( 'gpp_base_show_robots', $content );
} // end gpp_base_show_robots


/*-----------------------------------------------------------------------------------*/
/* HEADER.PHP - STYLESHEET LINK */
/*-----------------------------------------------------------------------------------*/

function gpp_base_create_stylesheet() {
    $content = "<link rel=\"stylesheet\" type=\"text/css\" href=\"";
    $content .= get_bloginfo( 'stylesheet_url' );
    $content .= "\" />";
    $content .= "\n";
    echo apply_filters( 'gpp_base_create_stylesheet', $content );
}


/*-----------------------------------------------------------------------------------*/
/* HEADER.PHP - RSS FEED LINK - CONTAINS FILTER */
/*-----------------------------------------------------------------------------------*/

function gpp_base_show_rss() {
	global $gpp; 
    $display = TRUE;
    $display = apply_filters( 'gpp_base_show_rss', $display );
    if ( $display ) {
        $content = "<link rel=\"alternate\" type=\"application/rss+xml\" href=\"";
			if( isset( $gpp[ 'gpp_base_feedburner_url' ] ) && ( $gpp[ 'gpp_base_feedburner_url' ] <> "" ) ) {
				$content .= $gpp[ 'gpp_base_feedburner_url' ];
			} else {
				$content .= get_bloginfo_rss( 'rss2_url' );
			}
        $content .= "\" title=\"";
        $content .= esc_html( get_bloginfo('name'), 1 );
        $content .= " " . __( 'Posts RSS feed', 'gpp_base_lang' );
        $content .= "\" />";
        $content .= "\n";
        echo apply_filters( 'gpp_base_rss', $content );
    }
} // end gpp_base_show_rss


/*-----------------------------------------------------------------------------------*/
/* HEADER.PHP - PINGBACKS - CONTAINS FILTER */
/*-----------------------------------------------------------------------------------*/

function gpp_base_show_pingback() {
    $display = TRUE;
    $display = apply_filters( 'gpp_base_show_pingback', $display );
    if ( $display ) {
        $content = "<link rel=\"pingback\" href=\"";
        $content .= get_bloginfo('pingback_url');
        $content .= "\" />";
        $content .= "\n";
        echo apply_filters( 'gpp_base_pingback_url', $content );
    }
} // end gpp_base_show_pingback


/*-----------------------------------------------------------------------------------*/
/* HEADER.PHP - CUSTOM CSS */
/*-----------------------------------------------------------------------------------*/

function gpp_base_wp_head() { 
	global $gpp;
	$style="";
	if ( isset( $_REQUEST['style'] ) ) $style = $_REQUEST['style'];
     if ( $style != '' ) {
          echo '<link href="'. get_stylesheet_directory_uri() .'/styles/'. $style . '.css" rel="stylesheet" type="text/css" />'."\n"; 
     } else { 
          $stylesheet = get_option( 'gpp_base_alt_stylesheet' );
          if ( $stylesheet != '' )
               echo '<link href="'. get_stylesheet_directory_uri() .'/styles/'. $stylesheet .'" rel="stylesheet" type="text/css" />'."\n";
     } 
     
      // Custom.css insert
     // echo '<link href="'. get_template_directory_uri() .'/custom.css" rel="stylesheet" type="text/css" />'."\n";   
  
  $gpp = get_option( 'gpp_base_options' );
  
     // Favicon
  	if ( isset( $gpp['gpp_base_custom_favicon'] ) )
	 		$favicon = $gpp['gpp_base_custom_favicon'];
    if ( isset( $favicon ) && ( $favicon != '' ) ) {
        echo '<link rel="shortcut icon" href="'.  $favicon  .'" />'."\n";
    }     

}


/*-----------------------------------------------------------------------------------*/
/* HEADER.PHP - BROWSER DETECTION */
/*-----------------------------------------------------------------------------------*/

function gpp_base_browser_class($classes) {
	global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
		if ( $is_lynx ) $classes[] = 'browser-lynx';
		elseif( $is_gecko ) $classes[] = 'browser-gecko';
		elseif( $is_opera ) $classes[] = 'browser-opera';
		elseif( $is_NS4 ) $classes[] = 'browser-ns4';
		elseif( $is_safari ) $classes[] = 'browser-safari';
		elseif( $is_chrome ) $classes[] = 'browser-chrome';
		elseif( $is_IE ) $classes[] = 'browser-ie';
		else $classes[] = '';
		if ( $is_iphone ) $classes[] = 'browser-iphone';
	return $classes;
}
add_filter( 'body_class', 'gpp_base_browser_class' );


/*-----------------------------------------------------------------------------------*/
/* HEADER.PHP - LOGO */
/*-----------------------------------------------------------------------------------*/

function gpp_base_site_logo() {
	global $gpp;
?>
	<h1 id="logo"><a href="<?php echo home_url(); ?>" title="<?php bloginfo( 'description' ); ?>"><?php if($gpp['gpp_base_logo'] <> "") { ?><img class="sitetitle" src="<?php echo $gpp['gpp_base_logo']; ?>" alt="<?php bloginfo( 'name' ); ?>" /><?php  } else { bloginfo( 'name' ); } ?></a></h1>
<?php }
add_action( 'gpp_base_header_hook', 'gpp_base_site_logo', 1 );


/*-----------------------------------------------------------------------------------*/
/* HEADER.PHP - DESCRIPTION */
/*-----------------------------------------------------------------------------------*/

function gpp_base_site_description() { ?>
	<h2 class="description"><?php bloginfo( 'description' ); ?></h2>
<?php }
add_action( 'gpp_base_header_hook', 'gpp_base_site_description', 3 );	


/*-----------------------------------------------------------------------------------*/
/* HEADER.PHP - HEADER IMAGES */
/*-----------------------------------------------------------------------------------*/

function gpp_base_header_image() {
	global $showheadermenu, $post;
		// Check if this is a post or page, if it has a thumbnail, and if it's a big one
		
	if( $showheadermenu ) { //if headerimage functionality is on
		if ( is_singular() &&
				has_post_thumbnail( $post->ID ) &&
				( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array( '940', '200' ) ) ) &&
				$image[ 1 ] >= HEADER_IMAGE_WIDTH ) :
			// Houston, we have a new header image!
			echo get_the_post_thumbnail( $post->ID, '940x200' );
		elseif ( get_header_image() ) : ?>
			<img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="<?php bloginfo( 'name' ); ?>" class="headerimg" />
	<?php endif; 
	}
}


/*-----------------------------------------------------------------------------------*/
/* HEADER.PHP - NAVIGATION */
/*-----------------------------------------------------------------------------------*/

// Make Menu Support compatible with earlier WP versions
function gpp_base_nav() {
	if ( function_exists( 'wp_nav_menu' ) )
		wp_nav_menu( 'sort_column=menu_order&theme_location=main-menu&container_class=menu clearfix&fallback_cb=' );
	else
		gpp_base_nav_fallback();
}
add_action( 'gpp_base_nav_hook', 'gpp_base_nav' );	

// Make Menu Support compatible with earlier WP versions
function gpp_base_topnav() {
	if ( function_exists( 'wp_nav_menu' ) )
		wp_nav_menu( 'sort_column=menu_order&theme_location=top-menu&container_class=topmenu clearfix&fallback_cb=' );
}
add_action( 'gpp_base_topnav_hook', 'gpp_base_topnav' );	

// Create our GPP Fallback Menu
function gpp_base_nav_fallback() {
    echo '<ul class="menu"><li><a href="'.site_url().'/wp-admin/nav-menus.php">Create Menu</a></li></ul>';
}


/*-----------------------------------------------------------------------------------*/
/* FOOTER - TRACKING CODE */
/*-----------------------------------------------------------------------------------*/

function gpp_base_tracking_code() {
	global $gpp;
	$tracking_code = $gpp[ 'gpp_base_tracking_code' ];
	if ( $tracking_code != '' ) {			
		echo '<script type="text/javascript">

		  var _gaq = _gaq || [];
		  _gaq.push(["_setAccount", "'.$tracking_code.'"]);
		  _gaq.push(["_trackPageview"]);

		  (function() {
			var ga = document.createElement("script"); ga.type = "text/javascript"; ga.async = true;
			ga.src = ("https:" == document.location.protocol ? "https://ssl" : "http://www") + ".google-analytics.com/ga.js";
			var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ga, s);
		  })();

		</script>';
	}	
}
add_action( 'gpp_base_tracking_code_hook', 'gpp_base_tracking_code' );
