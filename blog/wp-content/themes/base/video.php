<?php	
	global $gpp, $post, $sidebar, $showsidebar;
	//grab multiple values for same key
	$videos = get_post_meta( $post->ID, "video", false );
	$iphones = get_post_meta( $post->ID, "iphone", false );
	$videothumbs = get_post_meta( $post->ID, "video-thumb", false );
	
	//custom dimensions
	$height = get_post_meta( $post->ID, "height", false );
	$width = get_post_meta( $post->ID, "width", false );

	//check sidebar and set appropriate dimensions
	if ( isset( $gpp['gpp_base_sidebar'] ) )
		$sidebar = $gpp['gpp_base_sidebar'];
	if ( $sidebar == "true" || ( $gpp === FALSE && $showsidebar == "true" ) ) {
		$videowidth = 620; $videoheight = 374;
	} else {
		$videowidth = 940; $videoheight = 554;
	}
	
	
	
	if ( $videos != "" ) { // if video custom field exists
		for ( $video = 0; $video < count( $videos ); $video++ ) {
			if ( ! empty( $height ) ) {			
				$videoheight = $height[$video] + 20;
			}
			if( ! empty( $width ) ) {
				$videowidth = $width[$video];
			}

?>

			<div id="flashcontent-<?php the_ID(); ?>-<?php echo $video; ?>" class="vendor">
				<?php
					if ( get_option( 'gpp_base_iphone' ) == 'false' ) {
						echo '<div class=\"box\"><p>Please install the free <a href=\"http://www.adobe.com/products/flashplayer/\">Adobe Flash Player</a> to view this content.</p></div>';
					}
				?>
			</div>

			<script type="text/javascript">
				var flashvars = {};
				flashvars.imagePath = "<?php echo $videothumbs[ $video ]; ?>";
				flashvars.videoPath = "<?php echo $videos[ $video ]; ?>";
				flashvars.autoStart = "false";
				flashvars.autoHide = "false";
				flashvars.autoHideTime = "5";
				flashvars.hideLogo = "true";
				flashvars.volAudio = "60";
				flashvars.newWidth = "<?php echo $videowidth; ?>";
				flashvars.newHeight = "<?php echo $videoheight; ?>";
				flashvars.disableMiddleButton = "false";
				flashvars.playSounds = "false";
				flashvars.soundBarColor = "0x0066FF";
				flashvars.barColor = "0x0066FF";
				flashvars.barShadowColor = "0x91BBFB";
				flashvars.subbarColor = "0xffffff";
				
				var params = {};
				params.wmode = "transparent";
				params.allowFullScreen = "true";

				var attributes = {};
				
				swfobject.embedSWF( "<?php echo get_template_directory_uri(); ?>/library/includes/video/flvPlayer.swf", "flashcontent-<?php the_ID(); ?>-<?php echo $video; ?>", "<?php echo $videowidth; ?>", "<?php echo $videoheight; ?>", "9", "<?php echo get_template_directory_uri(); ?>/library/includes/video/expressInstall.swf", flashvars, params, attributes );
						
			</script>

			<?php if ( $gpp[ 'gpp_base_iphone' ] == 'true' && ( count( $iphones ) > 0 ) ) { 
					?>
					
				<script type="text/javascript">
					<!--
					if ( ( navigator.userAgent.match(/iPhone/i) ) || ( navigator.userAgent.match(/iPod/i) ) || ( navigator.userAgent.match(/iPad/i) ) ) {
						 document.getElementById( "flashcontent-<?php the_ID(); ?>-<?php echo $video; ?>" ).innerHTML = "<div class=\"play\"><a href=\"<?php echo $iphones[$video]; ?>\"><img src=\"<?php echo $videothumbs[$video]; ?>\" /><span></span></a></div>";
					}
					-->
				</script>
				
			<?php } ?>


		<?php }  ?>
	<?php } ?>