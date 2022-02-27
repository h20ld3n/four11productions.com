<?php

// Load Base Color CSS Stylesheet
function gpp_base_add_alt_css( $content ) {
	
	// lets get some global variables
	global $gpp, $gpp_base_css, $defaultcss;
	
	// if alt css option is set
	if ( isset( $gpp['gpp_base_alt_css'] ) ) {
	
		// if the option contains http from old options, get the basename (the filename) from the URL
		if ( strpos( $gpp['gpp_base_alt_css'], 'http' ) === 0 )
			$gpp_base_css = basename( $gpp['gpp_base_alt_css'] );
			
		// otherwise, lets get the user-selected alt css
		else
			$gpp_base_css = $gpp['gpp_base_alt_css'];
	}
	
	// for all other conditions, set default css
	else {
		
		// set default css
		$gpp_base_css = $defaultcss;
	
	}
		
  	echo '<link rel="stylesheet" type="text/css" href="' . get_stylesheet_directory_uri() . "/library/css/" . $gpp_base_css. '" />' . "\n";

}
add_action( 'gpp_base_css_hook', 'gpp_base_add_alt_css', 0 );

// Load Custom CSS from Theme Options 
function gpp_base_add_custom_styles( $content ) { 
	global $gpp, $separated_fonts;
	$custom_css = $gpp['gpp_base_custom_css'];
	$gpp_base_google_font = $gpp['gpp_base_google_font'];	
	$google_fonts = $gpp['gpp_base_google_fonts_all'];
	
	echo '<style type="text/css" media="screen">' . "\n";
	
	if ( ( $custom_css != "" )  || $google_fonts ) {			
		
		if ( $custom_css ) {
			echo stripslashes( stripslashes( $custom_css ) ) . "\n";
		}
	
		if ( $google_fonts ) { 
			$fonts = explode( '|', $gpp_base_google_font );
			foreach( $fonts as $font ) {
				$position = strpos( $font, ':' );
				if( $position ) {
					$fontname = explode( ':', $font );
					$font = $fontname[0];
				}  
				$pos = strpos( $font, '+' );
				
				if ( $pos ) {
					$gpp_base_google_font = str_replace( '+', ' ', $font );					
					$gpp_base_google_font = strtok( $gpp_base_google_font, ':' );
					$gpp_base_google_font = '"'. $gpp_base_google_font . '"';
				} else {
					$gpp_base_google_font = $font;
				}				
				
				$separated_fonts .= $gpp_base_google_font . ',';
			}
			echo 'body, input, textarea, submit {font-family: '.substr( $separated_fonts, 0, -1 ).';}';
		}		
	
	} // end $custom_css or $google_fonts check
	
	$childcss = "";
	
	// apply hook to receive child theme options			
	$childcss = apply_filters( 'childcss', $childcss );

	echo "\n" . '</style>' . "\n" ;
		
} // end gpp_base_add_custom_styles
add_action( 'wp_head', 'gpp_base_add_custom_styles', 7 );

// Load Google Font API script
function gpp_base_add_google_fonts() {
	global $gpp, $gpp_base_google_font;
	if ( isset( $gpp['gpp_base_google_font'] ) )
		$gpp_base_google_font = $gpp['gpp_base_google_font'];
		
	if ( $gpp_base_google_font != "" )	
  		echo '<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=' .$gpp_base_google_font. '" />' . "\n";
}
add_action( 'wp_head', 'gpp_base_add_google_fonts', 6 );