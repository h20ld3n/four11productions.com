<?php

/*-----------------------------------------------------------------------------------*/
/* FOOTER */
/*-----------------------------------------------------------------------------------*/

function gpp_base_footer() {
	global $gpp, $showwidgets, $showfooterwidgets;
	if ( ! isset( $showwidgets ) )
		$showwidgets = 1;	
	if ( isset( $gpp[ 'gpp_base_footer_widgets' ] ) ) {	
		$columns = $gpp[ 'gpp_base_footer_widgets' ];
	} else {
		$columns = 4;
	}
		
	if ( ( $showfooterwidgets ) || $gpp[ 'gpp_base_footer' ] == true ) {
		gpp_base_footer_widget( $columns );	
	}		
}
add_action( 'gpp_base_footer_hook', 'gpp_base_footer' );

function gpp_base_footer_widget( $cols ){ 
	global $showwidgets;	 ?>
	<div id="footer-widgets">
	<?php
	for( $i = 1; $i <= $cols; $i++ ) { ?>
	
	<aside class="widget-<?php echo $cols; ?>" id="widget-<?php echo $i; ?>">
		<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'Footer Widget '.$i ) ) : ?>	
			<?php if ( $showwidgets ) { ?>
				<h3 class="widget-title"><?php _e( 'Footer Widget ' . $i, 'gpp_base_lang' ); ?></h3>
				<p><?php _e( 'To add content to this area, visit the widget page and add a widget to the Footer Widget ' . $i . ' widget.', 'gpp_base_lang' ); ?></p>
			<?php } ?>
		<?php endif; ?>			
	</aside>
	
<?php } ?>
    </div>
<?php
}


/*-----------------------------------------------------------------------------------*/
/* FOOTER - CREDITS */
/*-----------------------------------------------------------------------------------*/

function gpp_base_footer_credits() {
	global $gpp;
	$affiliate = $gpp['gpp_base_affiliate_url'];
?>
	<div id="below_footer">
		<p><?php printf( __( 'All content &copy; %1$s by %2$s.', 'gpp_base_lang' ), date( 'Y' ), __( get_bloginfo( 'name' ) ) ); ?>
		<?php if ( $affiliate != '' )
			$url = $affiliate;
			else
			$url = GPP_THEME_AUTHOR_URI;
		_e( '<a href="'.$url.'" title="WordPress themes">WordPress Themes</a> by Graph Paper Press', 'gpp_base_lang' ); ?>
		 </p>
	</div>
<?php }
add_action( 'gpp_base_footer_credits_hook', 'gpp_base_footer_credits' );

?>