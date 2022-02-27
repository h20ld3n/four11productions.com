<?php
$shortname = "gpp_base";
$collsarray = array();
  
global $posts, $gpp_base_child_options, $multicheckcats, $wpdb;
/* $numofimg = 10; */

$collectionids=$wpdb->get_results("SELECT term_id FROM $wpdb->term_taxonomy WHERE taxonomy='collections'");
foreach($collectionids as $collectionid){
	$collsname=$wpdb->get_var("SELECT name FROM $wpdb->terms WHERE term_id='".$collectionid->term_id."'");
	$collsarray[$collectionid->term_id] =  $collsname;		
}	

$slideshoweffects=array("0"=>"None","1"=>"Fade","2"=>"Slide Top","3"=>"Slide Right","4"=>"Slide Bottom","5"=>"Slide Left","6"=>"Carousel Right","7"=>"Carousel Left");

$args = array('post_type'=>'galleries','numberposts'=>-1,'order'=>'DESC','orderby'=>'ID');				
$mygalleries = get_posts($args);
$galleries = array();

foreach( $mygalleries as $post ) :	setup_postdata($post);					
		if ( stripos($post->post_content, '[gallery') !== false){
			$galleries[get_the_ID()] = get_the_title();		
		}
endforeach;
		
		
if(count($galleries)==0){
	$opts = array("posts"=>"Latest Posts","galleries"=>"Latest Galleries");
}else{
	$opts = array("posts"=>"Latest Posts","galleries"=>"Latest Galleries","single"=>"Single Gallery");
}

$options = array();
$options[] = array(	"name" => "Homepage Design",
					"type" => "heading");
					
$options[] = array(	"name" => "Homepage Design",
					"desc" => "The homepage slideshow can display your Latest Posts, Latest Galleries or a Single Gallery.  The Posts and Galleries options display all posts that have both a Featured Image and a Gallery inserted into the post.",
				    "id" => $shortname."_homepage_design",
		    		"std" => "",
		    		"type" => "select",
		    		"options" => $opts);	
if(sizeof($multicheckcats) > 0){		    		
	$options[] = array( "name" => "Categories",
					"desc" => "Select categories you want to show",
					"id" => $shortname."_homepage_cats",
					"std" => "all",
					"type" => "multicheck",
					"options" => $multicheckcats,
					"pid" => $shortname."_homepage_design pid posts");				
}

$options[] = array( "name" => "Choose Gallery",
					"desc" => "Select a gallery you want to show on homepage",
					"id" => $shortname."_homepage_gallery",
					"std" => "",
					"type" => "select",
					"options" => $galleries,
					"pid" => $shortname."_homepage_design pid single");	
if(sizeof($collsarray) > 0){					
	$options[] = array( "name" => "Collections",
					"desc" => "Select collections you want to show",
					"id" => $shortname."_homepage_colls",
					"std" => "all",
					"type" => "multicheck",
					"options" => $collsarray,
					"pid" => $shortname."_homepage_design pid galleries");
}

$options[] = array(	"name" => "Slideshow Settings",
					"type" => "heading");					

$options[] = array( "name" => "Autoplay Slideshow",
					"desc" => "Check this to auto start the slideshow.",
					"id" => $shortname."_slideshow_autoplay",
					"std" => "false",
					"type" => "checkbox");

$options[] = array(	"name" => "Slideshow Effect",
					"desc" => "Choose the slideshow effect of your choice.",
			    	"id" => $shortname."_slideshow_effect",
			    	"std" => "1",
			   		"type" => "select",
					"options" => $slideshoweffects
					);

$options[] = array( "name" => "Slideshow Interval",
                    "desc" => "Set the time the image displays before another images loads.",
                    "id" => $shortname."_slideshow_interval",
                    "std" => "5000",
                    "type" => "text");

$options[] = array( "name" => "Transition Speed",
                    "desc" => "Set the transition time between two images.",
                    "id" => $shortname."_transition_speed",
                    "std" => "500",
                    "type" => "text");	
					
$options[] = array( "name" => "Display Info",
					"desc" => "Check this to show the title and description.",
					"id" => $shortname."_display_info",
					"std" => "true",
					"type" => "checkbox");
					
$gpp_base_child_options = array_merge($gpp_base_child_options,$options);
?>