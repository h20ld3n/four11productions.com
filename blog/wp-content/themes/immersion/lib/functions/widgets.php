<?php

/*
 * Register widgetized area and update sidebar with default widgets
 * @package WordPress
 * @subpackage Immersion
 * @since Immersion 1.0
 */

function gpp_widgets_init() {
	global $gpp;
	$no_of_fwidgets = intval($gpp['immersion_footer_widgets']) ;
	$footerwidget = $gpp['immersion_footer'];
	$sidebarwidget = $gpp['immersion_sidebar'];
	if ( $sidebarwidget == "true" || ( $gpp === FALSE ) ) {
		register_sidebar( array(
			'name' => __( 'Sidebar 1', 'immersion' ),
			'id' => 'sidebar-1',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => "</aside>",
			'before_title' => '<h1 class="widget-title">',
			'after_title' => '</h1>',
		) );
	}
	if ( $footerwidget == "true" || ( $gpp === FALSE ) ) {
		for( $i = 1; $i <= $no_of_fwidgets; $i++ ){	
			register_sidebar(array(
				'name' => 'Footer Widget '.$i,
				'id' => 'footer-widget'.$i,
				'before_widget' => '<div class="widget">',
				'after_widget' => '</div>',
				'before_title' => '<h3 class="widget-title"><span>',
				'after_title' => '</span></h3>'
			));
		}
	}
}
add_action( 'init', 'gpp_widgets_init' );