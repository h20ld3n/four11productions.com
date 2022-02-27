<?php

// Show About Section
function gpp_base_theme_options_about() {
	global $gpp, $aboutimage, $gppabout;
	if ( isset( $gpp['gpp_base_about_image'] ) )
		$aboutimage = $gpp['gpp_base_about_image'];
	if ( isset( $gpp['gpp_base_about'] ) )
		$gppabout = $gpp['gpp_base_about']
?>

		<?php if ( $aboutimage != '' ) { ?><img src="<?php echo $aboutimage; ?>" alt="<?php echo ( $gpp['gpp_base_about_name'] ); ?>" title="<?php echo ( $gpp['gpp_base_about_name'] ); ?>" class="alignleft" /><?php } ?>
		<h3 class="sub"><?php _e( 'About  ','gpp_base_lang' ); if ( $gpp['gpp_base_about_name'] != '') { echo ( $gpp['gpp_base_about_name'] ); } ?></h3>
		<p class="nomargin"><?php if ( $gpp['gpp_base_about'] != '' ) { echo stripslashes( stripslashes( $gpp['gpp_base_about'] ) ); } else {  _e( 'Add a little information about yourself here. It will appear in the footer of your site.', 'gpp_base_lang' ); } ?><br />
			<?php if ( $gpp['gpp_base_phone'] != '' ) { echo "phone: ".$gpp['gpp_base_phone']; } ?><br />
			<?php if ( $gpp['gpp_base_email'] != '' ) { echo "email: "; ?><a href="mailto:<?php echo $gpp['gpp_base_email']; ?>"><?php echo $gpp['gpp_base_email']; } ?></a>
		</p>

		<?php if ( $gpp['gpp_base_about_link'] != '' ) { ?><p><a class="aboutlink" href="<?php echo stripslashes( $gpp['gpp_base_about_link'] ); ?>"><?php _e( 'Read more &raquo;', 'gpp_base_lang' ); ?></a></p><?php } ?>
		
		<?php

} // end gpp_base_theme_options_about();
	
add_action( 'gpp_base_theme_options', 'gpp_base_theme_options_about', 1 );

?>