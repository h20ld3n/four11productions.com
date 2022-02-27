<?php

/*
 * These functions display define Post loops
 * @package WordPress
 * @subpackage Immersion
 * @since Immersion 1.0
 */

if ( ! function_exists( 'gpp_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own gpp_posted_on to override in a child theme
 *
 * @since Immersion 1.2
 */
function gpp_posted_on() {
	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" >%4$s</time></a><span class="byline"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'immersion' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		sprintf( esc_attr__( 'View all posts by %s', 'immersion' ), get_the_author() ),
		esc_html( get_the_author() )
	);
}
endif;

if ( ! function_exists( 'gpp_pub_date' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own gpp_posted_on to override in a child theme
 *
 * @since Immersion 1.2
 */
function gpp_pub_date() {
    printf( __( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" >%4$s</time></a>', 'immersion' ),
        esc_url( get_permalink() ),
        esc_attr( get_the_time() ),
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date() )
    );
}
endif;

/**
 * If we go beyond the last page and request a page that doesn't exist,
 * force WordPress to return a 404.
 * See http://core.trac.wordpress.org/ticket/15770
 * This is fixed in WP 3.4
 *
 * @since Immersion 1.0
 */
function gpp_paged_404_fix( ) {
    global $wp_query;
    if ( is_404() || !is_paged() || 0 != count( $wp_query->posts ) )
        return;
    $wp_query->set_404();
    status_header( 404 );
    nocache_headers();
}
add_action( 'wp', 'gpp_paged_404_fix' );

/**
 * Returns the_content or the_excerpt or none
 * User theme option
 *
 * @since Immersion 1.0
 */
function gpp_custom_content() {

    global $gpp;

    if ( isset( $gpp[ 'immersion_cen' ] ) )
        $cen = $gpp[ 'immersion_cen' ];

	if ( isset($cen) && $cen == 'the_content')
        $cen = get_the_content();
    elseif (isset($cen) && $cen == 'the_excerpt')
        $cen = get_the_excerpt();
    else
        $cen = '';

    print $cen;


}