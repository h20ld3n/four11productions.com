<?php

// Load Base Javascripts


function gpp_base_load_base_js( ) {	
	wp_register_script( 'base', get_template_directory_uri().'/library/js/base.js', array( 'jquery' ) );
	wp_register_script( 'fitvids', get_template_directory_uri().'/library/js/jquery.fitvids.js', array( 'jquery' ) );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'base' );
	wp_enqueue_script( 'fitvids' );
	wp_enqueue_script( 'swfobject' );
	wp_enqueue_style( 'responsive-css', get_template_directory_uri().'/library/includes/responsive.css' );

}
if ( ! is_admin() ) add_action( 'wp_enqueue_scripts', 'gpp_base_load_base_js' );

// Load Dom Ready Javascripts

function gpp_base_load_dom_ready_js() {
	
	$doc_ready_script = '';
	$doc_ready_script = '
		<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery("#page").fitVids();
				
				// Correct last element margin
				jQuery("#colophon aside").last().addClass("last");				
				jQuery("#colophon aside:nth-child(even)").addClass("even");
				jQuery("#secondary aside:nth-child(even)").addClass("odd");				
				
			});
		</script>' . "\n";
					
	echo $doc_ready_script;	
}

// Add DOM ready scripts
add_action( 'wp_head', 'gpp_base_load_dom_ready_js' );