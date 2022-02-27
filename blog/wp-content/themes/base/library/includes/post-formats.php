<?php

/*
 * AUDIO EDITOR MARKUP CUSTOMIZATIONS
 */
 
function gpp_base_audio_editor_markup( $href, $title, $caption ) {

    $args = array(
        'order'          => 'ASC',
        'orderby' 		 	=> 'menu_order',
        'post_type'      => 'attachment',
        'post_parent'    => $post->ID,
        'post_mime_type' => 'audio',
        'post_status'    => null,
        'numberposts'    => -1,
        'size' => 'large'
    );

    $attachments = get_posts( $args );
    if ( $attachments ) {
        foreach ( $attachments as $attachment ) {
            $title = $attachment->post_title;
            $caption = $attachment->post_excerpt;
            $description = $attachment->post_content;
            $url = $attachment->guid;
        }
    }
    
    $out = sprintf( '<ul class="%s"><li>', 'playlist' );
    $out .= sprintf( '<a href="%s" class="%s" title="%s">%s', $href, 'inline', $title, $title );
    if ( $caption ) {
        $out .= sprintf( '<span class="%s">%s</span></a>', 'caption', $caption );
    }
    $out .= sprintf( '<a href="%s" class="%s">%s</a>', $href, 'exclude', 'Download' );
    $out .= "</li></ul>";

    return $out;
}

/*
 * AUDIO SHORTCODES REPLACE [AUDIO] SHORTCODE WITH HTML MARKUP
 */
 
function gpp_base_audio_shortcode( $atts, $content ) {
	extract( $atts );
	
	$html = gpp_base_audio_editor_markup( $href, $title, $content );
	return $html;
}

add_shortcode( 'audio', 'gpp_base_audio_shortcode' );

/*
 * AUDIO SHORTCODES CONSTRUCTING THE SHORTCODE THAT IS ADDED TO THE EDITOR
 */
 
function gpp_base_audio_editor_shortcode( $html, $href, $title  ) {
	return sprintf( '[audio href="%s" title="%s"]Insert caption here[/audio]', $href, $title );
}

add_filter( 'audio_send_to_editor_url', 'gpp_base_audio_editor_shortcode', 10, 3 );

/*
 * AUDIO PLAYER MARKUP - BUILDS THE HTML FOR AUDIO PLAYER CONTROLS
 */
 
function gpp_base_audio_player_markup() { ?>
	<div id="control-template">
	    <div class="controls">
	        <div class="statusbar">
	            <div class="loading"></div>
	            <div class="position"></div>
	        </div>
	    </div>
	    <div class="timing">
	        <div id="sm2_timing" class="timing-data">
	            <span class="sm2_position">%s1</span> / <span class="sm2_total">%s2</span></div>
	    </div>
	    <div class="peak">
	        <div class="peak-box"><span class="l"></span><span class="r"></span>
	        </div>
	    </div>
	</div>
	<div id="spectrum-container" class="spectrum-container">
	    <div class="spectrum-box">
	        <div class="spectrum"></div>
	    </div>
	</div>
<?php }

/*
 * AUDIO FORMAT LOADING
 */
 
function gpp_base_has_audio_format() {
	$format = get_post_format();
	if ( $format == 'audio' ) {
		add_action( 'wp_footer', 'gpp_base_audio_player_markup' );

	}
}

if ( ! is_admin() )
	wp_enqueue_script( 'soundmanager2', get_template_directory_uri().'/library/js/soundmanager2-jsmin.js', '', '2.97' );