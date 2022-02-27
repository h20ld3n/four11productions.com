<?php

/*-----------------------------------------------------------------------------------*/
/* HEADER HOOKS */
/*-----------------------------------------------------------------------------------*/

function gpp_base_above_header_hook() { do_action( 'gpp_base_above_header_hook' ); }  // defined above header div
function gpp_base_below_header_hook() { do_action( 'gpp_base_below_header_hook' ); }  // defined  below header div 
function gpp_base_css_hook() { do_action( 'gpp_base_css_hook' ); } // for css priority level load first default
function gpp_base_header_hook() { do_action( 'gpp_base_header_hook' ); } // priority 1= logo; priority 3= description
function gpp_base_nav_hook() { do_action( 'gpp_base_nav_hook' ); } //hook for navigation menu default is defined in header-extension.php
function gpp_base_topnav_hook() { do_action( 'gpp_base_topnav_hook' ); } //hook for navigation menu default is defined in header-extension.php
function gpp_base_tracking_code_hook() { do_action( 'gpp_base_tracking_code_hook' ); } // tracking code hook, default is defined


/*-----------------------------------------------------------------------------------*/
/* CONTENT HOOKS */
/*-----------------------------------------------------------------------------------*/

function gpp_base_above_content_hook() { do_action( 'gpp_base_above_content_hook' ); } // defined above entry-content 
function gpp_base_above_title_hook() { do_action( 'gpp_base_above_title_hook' ); } //defined above entry-title
function gpp_base_after_single_post_hook() { do_action( 'gpp_base_after_single_post_hook' ); } //define after single post
function gpp_base_apps_hook() { do_action( 'gpp_base_apps_hook' ); } // gpp apps like slideshow in index page
function gpp_base_archive_loop_hook() { do_action( 'gpp_base_archive_loop_hook' ); } //archive loop hook, default is defined
function gpp_base_attachment_loop_hook() { do_action( 'gpp_base_attachment_loop_hook' ); } //attachment loop hook, default is defined
function gpp_base_author_loop_hook() { do_action( 'gpp_base_author_loop_hook' ); } //auther loop hook, default is defined
function gpp_base_below_content_hook() { do_action( 'gpp_base_below_content_hook' ); } // defined below entry-content
function gpp_base_below_title_hook() { do_action( 'gpp_base_below_title_hook' ); } // defined below entry-title, default is defined
function gpp_base_home_widgets_hook() { do_action( 'gpp_base_home_widgets_hook' ); } // adding a fully widgetized homepage
function gpp_base_index_loop_hook() { do_action( 'gpp_base_index_loop_hook' );} // index loop hook, default is defined
function gpp_base_loop_hook() { do_action( 'gpp_base_loop_hook' ); } // general loop
function gpp_base_meta_hook() { do_action( 'gpp_base_meta_hook' ); } // hook defined with metadata of post
function gpp_base_navigation_hook() { do_action( 'gpp_base_navigation_hook' ); } // previous page / next page
function gpp_base_not_found_hook() { do_action( 'gpp_base_not_found_hook' ); } // post not found hook default is defined
function gpp_base_page_title_hook() { do_action( 'gpp_base_page_title_hook' ); } // page title for archive and author
function gpp_base_page_blog_hook() { do_action( 'gpp_base_page_blog_hook' ); } // blog loop hook, default is defined
function gpp_base_page_hook() { do_action( 'gpp_base_page_hook' ); } // page loop hook, default is defined
function gpp_base_post_author_hook() { do_action( 'gpp_base_post_author_hook' ); } // auther loop hook, default is defined
function gpp_base_posted_on_hook() { do_action( 'gpp_base_posted_on_hook' ); } // posted date and auther hook, default is defined in content-extension.php
function gpp_base_search_loop_hook() { do_action( 'gpp_base_search_loop_hook' ); } // search loop hook, default is defined
function gpp_base_single_post_hook() { do_action( 'gpp_base_single_post_hook' ); } // single loop hook, default is defined
function gpp_base_single_meta_hook() { do_action( 'gpp_base_single_meta_hook' ); } // single metadata hook, default is defined


/*-----------------------------------------------------------------------------------*/
/* SIDEBAR HOOKS */
/*-----------------------------------------------------------------------------------*/

function gpp_base_above_sidebar_hook() { do_action( 'gpp_base_above_sidebar_hook' ); } // defined above sidebar
function gpp_base_below_sidebar_hook() { do_action( 'gpp_base_below_sidebar_hook' ); } // define below sidebar
function gpp_base_check_sidebar_hook() { do_action( 'gpp_base_check_sidebar_hook' ); } // hook to determine the existance of sidebar
function gpp_base_sidebar_hook() { do_action( 'gpp_base_sidebar_hook' ); } // sidebar hook, default is defined


/*-----------------------------------------------------------------------------------*/
/* FOOTER HOOKS */
/*-----------------------------------------------------------------------------------*/

function gpp_base_above_footer_hook() { do_action( 'gpp_base_above_footer_hook' ); } // defined above footer
function gpp_base_below_footer_hook() { do_action( 'gpp_base_below_footer_hook' ); } // define below footer
function gpp_base_footer_credits_hook() { do_action( 'gpp_base_footer_credits_hook' ); } // defined below footer, default credits is defined
function gpp_base_footer_hook() { do_action( 'gpp_base_footer_hook' ); } // footer hook, default is defined


/*-----------------------------------------------------------------------------------*/
/* THEME OPTION HOOKS */
/*-----------------------------------------------------------------------------------*/

function gpp_base_theme_options_hook() {	do_action( 'gpp_base_theme_options_hook' ); }