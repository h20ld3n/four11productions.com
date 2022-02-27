<?php
add_action( 'wp_print_scripts', 'c_add_javascript' );
function c_add_javascript( ) {
	wp_enqueue_script('jquery');    
	wp_enqueue_script( 'tab',  get_bloginfo('template_directory').'/js/jquery.tabs.pack.js', array( 'jquery' ) );	
}
?>