<?php
	function gpp_base_custom_image_slider_include() {
		global $gpp;
		include ('customimage.php');
	}

	if((isset($gpp['gpp_base_homepage_design']) && $gpp['gpp_base_homepage_design']=='slideshow')) {
		remove_action('gpp_base_loop_hook', 'gpp_base_loop_wrapper');	
		add_action('gpp_base_apps_hook', 'gpp_base_custom_image_slider_include');
	} 
?>