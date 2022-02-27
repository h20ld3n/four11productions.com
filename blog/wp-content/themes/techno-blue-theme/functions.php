<?php
if ( function_exists('register_sidebar') )
	register_sidebar(array(
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<div class="title"><h1>',
        'after_title' => '</h1></div>',
    ));
?>