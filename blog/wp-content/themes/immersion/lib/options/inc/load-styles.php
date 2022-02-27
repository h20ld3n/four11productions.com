<?php
/* add CSS color themes */

$gpp = get_option('immersion_options');

function gpp_add_custom_stylesheet() {
		global $gpp;
		
		$stylesheet = $gpp[ 'immersion_alt_css' ];
    
		/* Checks if the custom field has a value and that the stylesheet actually exists on the server */
		if ( $stylesheet <> '' ) {
		
			/* Echos the stylesheet link */
			echo '<link rel="stylesheet" href="' . get_stylesheet_directory_uri() . "/lib/css/" . $stylesheet . '" type="text/css" media="screen,projection,tv" />';
			
		}

		elseif ( $stylesheet == '' ) {
		
			/* Echos the default stylesheet link */
			echo '<link rel="stylesheet" href="' . get_stylesheet_directory_uri() . '/lib/css/default.css" type="text/css" media="screen,projection,tv" />';
			
		}

}

/* Register with hook 'wp_print_styles' */
if(!is_admin()) 
	add_action('wp_print_styles', 'gpp_add_custom_stylesheet');


/* add google fonts */
function gpp_add_custom_styles( $content ) { 	
	global $gpp;
	$custom_css = $gpp['immersion_custom_css'];
	$google_font = $gpp['immersion_google_font'];	
	$google_fonts_all = $gpp['immersion_google_fonts_all'];
		
	echo '<style type="text/css" media="screen">';

		
		
	if ( $custom_css <> '' ) {
		echo stripslashes( stripslashes( $custom_css ) ) . "\n";
	}
	if ( $google_font <> '' ) {	
		if ( $google_fonts_all ) { 
			$fonts = explode( '|', $google_font );
			$separated_fonts = '';
			foreach( $fonts as $font ) {
				$subset = strpos( $font, '&' );
				if( $subset ) {
					$font = substr( $font, 0, $subset );							
				}
				$position = strpos( $font, ':' );
				if( $position ) {
					$fontname = explode( ':', $font );
					$font = $fontname[0];
				}  
				$pos = strpos( $font, '+' );
				
				if ( $pos ) {
					$google_font = str_replace( '+', ' ', $font );					
					$google_font = strtok( $google_font, ':' );
					$google_font = '"'. $google_font . '"';
				} else {
					$google_font = $font;
				}				
				
				$separated_fonts .= $google_font . ',';

			} // end foreach
			
			echo 'body, input, textarea, submit { font-family: '.substr( $separated_fonts, 0, -1 ).'; }';
		}		
	
	} // end $custom_css or $google_fonts check	

	echo "\n" . '</style>' . "\n" ;

} // end 
add_action( 'wp_head', 'gpp_add_custom_styles', 98 );

// Load Google Font API script
function gpp_add_google_fonts() {
	global $gpp;
	
	$google_font = $gpp['immersion_google_font'];
	if ( $google_font <> "" )
  		echo '<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=' .$google_font. '" />' . "\n";

}
add_action( 'wp_head', 'gpp_add_google_fonts', 97 );
