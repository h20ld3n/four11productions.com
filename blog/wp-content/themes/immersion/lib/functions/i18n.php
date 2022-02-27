<?php
/**
 * Controls translation
 *
 * @package Immersion
 * @since 1.0
 */

// used for theme localization
load_theme_textdomain('immersion', GPP_LANGUAGES_DIR);
$locale = get_locale();
$locale_file = GPP_LANGUAGES_DIR . "/$locale.php";
if ( is_readable( $locale_file ) )
	require_once( $locale_file );