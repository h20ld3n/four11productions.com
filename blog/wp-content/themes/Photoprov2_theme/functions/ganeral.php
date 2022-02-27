<?php

// WP 2.9+ Thumbnail support
// true = hard crop

if (function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(100, 70, true);
    add_image_size('home-big', 692, 99999);
    add_image_size('full-size', 99999, 99999, true);
}

// choose old comment template if not compatible with threaded comment
add_filter( 'comments_template', 'legacy_comments' );
function legacy_comments( $file ) {
	if ( !function_exists('wp_list_comments') )
		$file = TEMPLATEPATH . '/legacy.comments.php';
	return $file;
}

// register sidebar
if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
));

// exclude pages from search result
function mySearchFilter($query) {
	if ($query->is_search) {
	$query->set('post_type', 'post');
	}
	return $query;
}

add_filter('pre_get_posts','mySearchFilter');

?>