<?php

// Load Google Font API script
function gpp_add_google_fonts() {
	global $gpp, $gpp_google_font;
	if(isset($gpp['gpp_google_font']))
		$gpp_google_font = $gpp['gpp_google_font'];
	if($gpp_google_font != "")	
echo '<!-- BeginHeader -->
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=' .$gpp_google_font. '" />
 <!-- EndHeader -->' . "\n\n";
}
add_action('wp_head', 'gpp_add_google_fonts',6);

// Load Custom CSS from Theme Options 
function gpp_add_custom_styles($content) { 
	global $gpp;

	$gpp_google_font = $gpp['gpp_google_font'];
	$gpp_google_font_family = $gpp['gpp_google_font_family'];
	$gpp_google_font_weight = $gpp['gpp_google_font_weight'];
	if ( isset($gpp['gpp_google_fonts_all']) && $gpp['gpp_google_fonts_all'] != "")	{
		$google_fonts = $gpp['gpp_google_fonts_all'][0];
	}

	echo '<!-- BeginHeader -->
<style type="text/css" media="screen">' . "\n";
	

	
		if(isset($google_fonts)) {
			echo 'body, input, textarea, submit, h1, h2, h3, h4, h5, h6, #footer p, #top #masthead #logo .description, .fancy, blockquote, p.credits, .postmetadata, #hide, .image-wrap span.title {font-family: "'.$gpp_google_font_family.'"; font-weight: '.$gpp_google_font_weight.';}';
		  	
	
  
}
	echo "\n" . '</style>
<!-- EndHeader -->' . "\n\n" ;
		
} // end gpp_add_custom_styles
add_action('wp_head', 'gpp_add_custom_styles',7);

?>