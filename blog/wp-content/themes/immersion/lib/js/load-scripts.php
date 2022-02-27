<?php

/*
 * Adding javascripts to theme
 * First register, then enqueue
 * References: http://matty.co.za/2010/03/enqueue-javascript-in-wordpress/
 * @package WordPress
 * @subpackage Immersion
 * @since Immersion 1.0
 */

add_action('init','gpp_register_scripts');
// Register our scripts for easier
function gpp_register_scripts() {
	wp_register_script('gpp_core', GPP_JS_URL.'/core.js', array( 'jquery' ), '1.0' );
	wp_register_script('selectivizr', GPP_JS_URL.'/selectivizr.min.js', array( 'jquery' ), '1.0.2' );
	wp_register_script('fitvids', GPP_JS_URL.'/jquery.fitvids.js', array( 'jquery' ), '1.0');
	wp_register_script('prettyphoto', GPP_JS_URL.'/prettyPhoto/jquery.prettyPhoto.js');
	wp_register_script('jplayer', GPP_JS_URL . '/jquery.jplayer.min.js', array('jquery'), '2.0.0', false);
	wp_register_script('flexslider', GPP_JS_URL . '/flexSlider/jquery.flexslider-min.js');
	wp_register_script('infinitescroll', GPP_JS_URL.'/jquery.infinitescroll.min.js', array( 'jquery' ), '2.0');

    wp_register_script('masonry', GPP_JS_URL.'/jquery.masonry.min.js', array( 'jquery' ), '2.1.03');
    wp_register_script('imagesloaded', GPP_JS_URL.'/jquery.imagesloaded.min.js', array( 'jquery' ), '2.1.03');

}

add_action('wp_enqueue_scripts','gpp_enqueue_scripts');
// Wrap all required scripts in one function for easier enqueue
function gpp_enqueue_scripts() {
	global $gpp;

	// check for user options
	if ( isset( $gpp['immersion_infinite_scroll'] ) )
	 	$infinite_scroll = $gpp['immersion_infinite_scroll'];
    // check columns
    if ( isset( $gpp[ 'immersion_columns' ] ) )
        $columns = $gpp[ 'immersion_columns' ];
	// Enqueue site-wide
	wp_enqueue_script('jquery');
	wp_enqueue_script('gpp_core');
	wp_enqueue_script('selectivizr');
	wp_enqueue_script('fitvids');
	wp_enqueue_script('prettyphoto');
    wp_enqueue_script('jplayer');
    wp_enqueue_script('flexslider');

    // AJAX url variable
    wp_localize_script('gpp_core','gpp',
   	    array(
   		'ajaxurl'=>admin_url('admin-ajax.php'),
   		'ajaxnonce' => wp_create_nonce('ajax-nonce')
        )
    );

    if ( ! is_singular() && isset( $infinite_scroll ) && ( $infinite_scroll == true ) ) {
    	wp_enqueue_script('infinitescroll');
    }
    if ( ! is_singular() && isset( $columns ) && ( $columns != "1" ) ) {
        wp_enqueue_script('masonry');
        wp_enqueue_script('imagesloaded');
    }

}

// init infinite scroll
add_action( 'wp_footer', 'gpp_infinite_scroll_js',100 );
function gpp_infinite_scroll_js() {
	global $gpp;

	// check for user options
	if ( isset( $gpp['immersion_infinite_scroll'] ) )
	 	$infinite_scroll = $gpp['immersion_infinite_scroll'];

    if ( ! is_singular() && isset( $infinite_scroll ) && ( $infinite_scroll == true ) ) { ?>
    <script>
    var infinite_scroll = {
        loading: {
            img: "<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif",
            msgText: "<?php _e( 'Loading the next set of posts...', 'immersion' ); ?>",
            finishedMsg: "<?php _e( 'All posts loaded.', 'immersion' ); ?>"
        },
        "nextSelector":"#nav-below .nav-previous a",
        "navSelector":"#nav-below",
        "itemSelector":"article",
        "contentSelector":"#content"
    };
    jQuery( infinite_scroll.contentSelector ).infinitescroll( infinite_scroll );
    </script>
    <?php
    }
}

// init masonry
add_action( 'wp_footer', 'gpp_masonry_js',100 );
function gpp_masonry_js() {
    global $gpp;

    // check columns
    if ( isset( $gpp[ 'immersion_columns' ] ) )
        $columns = $gpp[ 'immersion_columns' ];

    if ( ! is_singular() && isset( $columns ) && ( $columns != "1" ) ) { ?>
    <script>
      jQuery(function($){

        var $container = $('#content-inner');

        $container.imagesLoaded( function(){
          $container.masonry({
            itemSelector : '.two-columns, .three-columns',
            isAnimated: true,
            // set columnWidth a fraction of the container width
            columnWidth: function( containerWidth ) {
                return containerWidth / <?php print $columns; ?>;
            }
          });
        });

      });
    </script>
    <?php
    }
}