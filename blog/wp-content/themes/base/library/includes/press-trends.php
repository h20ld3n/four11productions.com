<?php

// Presstrends

function presstrends() {

// Add your PressTrends and Theme API Keys
$api_key = 't3ecnxconv4btw9yk0cqfru29zodrsimm5km';

if ( GPP_THEME_NAME == 'Base' ) {
	$auth = 'aq1mcb4j0gqkttb8xfs37hhyi5w2bncv3';
}
if ( GPP_THEME_NAME == 'Sidewinder' ) {
	$auth = 'r9k9aggm0jlunw9mole1x4ys2zv2lfkx1';
}
if ( GPP_THEME_NAME == 'Immense' ) {
	$auth = '8p1ln040g1ahr5135obsbtjgvw5pry9jn';
}
if ( GPP_THEME_NAME == 'Uno' ) {
	$auth = 'xutw6ofmb7lwqh0q2mq11g7h6xyxlbyym';
}
if ( GPP_THEME_NAME == 'Focal Point' ) {
	$auth = '9op9k99ghcbfaf9ksn9x6r1159nhbf38e';
}


// NO NEED TO EDIT BELOW
$data = get_transient( 'presstrends_data' );
if (!$data || $data == ''){
$api_base = 'http://api.presstrends.io/index.php/api/sites/add/auth/';
$url = $api_base . $auth . '/api/' . $api_key . '/';
$data = array();
$count_posts = wp_count_posts();
$comments_count = wp_count_comments();
$theme_data = get_theme_data(get_stylesheet_directory() . '/style.css');
$plugin_count = count(get_option('active_plugins'));
$data['url'] = stripslashes(str_replace(array('http://', '/', ':' ), '', site_url()));
$data['posts'] = $count_posts->publish;
$data['comments'] = $comments_count->total_comments;
$data['theme_version'] = $theme_data['Version'];
$data['theme_name'] = str_replace( ' ', '', get_bloginfo( 'name' ));
$data['plugins'] = $plugin_count;
$data['wpversion'] = get_bloginfo('version');
foreach ( $data as $k => $v ) {
$url .= $k . '/' . $v . '/';
}
$response = wp_remote_get( $url );
set_transient('presstrends_data', $data, 60*60*24);
}}


global $gpp;
if(isset($gpp[ 'gpp_base_press_trends' ])){
	$press_trends = $gpp[ 'gpp_base_press_trends' ];
} else {
	$press_trends = '';
}
if ( $press_trends != '' )
 add_action('wp_head', 'presstrends');