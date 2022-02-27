<?php
global $gpp, $showsidebaroption, $showhomewidgetoption, $showfooterwidgets;
$cnt = "";

if ( ( isset( $gpp['gpp_base_footer'] ) && $gpp['gpp_base_footer'] == false ) ) {
	$showfooterwidgets = false;
} 
if ( ( $showfooterwidgets ) || $gpp['gpp_base_footer'] == true ) {	
	if ( isset( $gpp['gpp_base_footer_widgets'] ) ) {	
		$cnt = $gpp['gpp_base_footer_widgets'];
	} else {	
		$cnt = 4;	
	}
}
if ( function_exists('register_sidebar') ) :
	if ( ( ! $gpp && $showhomewidgetoption ) || isset($gpp['gpp_base_home_widget']) == true ) {
		register_sidebar(array(
			'name' => 'Home',
			'before_title' => '<h3 class="sub"><span>',
			'after_title' => '</span></h3>'
		));
	}    
	
	if ( ( ! $gpp && $showsidebaroption ) || isset($gpp['gpp_base_sidebar']) == true ) {
	    register_sidebar(array(
	        'name' => 'Sidebar',
	        'before_widget' => '<aside class="widget">',
	        'after_widget' => '</aside>',
	        'before_title' => '<h3 class="widget-title">',
	        'after_title' => '</h3>'
	    ));
    }
    for( $i = 1; $i <= $cnt; $i++ ){	
		register_sidebar(array(
			'name' => 'Footer Widget '.$i,
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		));
    }  
		
endif;