<?php
global $gpp, $post, $posts, $tag, $author, $paged, $cat, $monthnum, $day, $year, $wp_query, $catarray;
$user_info = get_userdata($author); //get the auther of the post.
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; //enabeling paging
$ppp = get_option('posts_per_page'); // Get number of posts set in the setting page
$custombg = get_theme_mod('background_image'); // Get the custom background image url
$imgjson = "";
$post_type = "";
/**
* Somehow the wordpress global variables $day, $monthnum, $year are not coming since 3.3, hence we are defining them below. 
*/
$day = get_the_time('j' );
$monthnum = get_the_time('n' );	
$year = get_the_time('Y' );

if(!isset($gpp) || $gpp == false  || (!isset($gpp['gpp_base_slideshow_autoplay']) || $gpp['gpp_base_slideshow_autoplay']!= true) ){
	$autoplay = 0;
}else{
	$autoplay = 1;
}

if(!isset($gpp) || $gpp == false  || (isset($gpp['gpp_base_postinfo_display']) && $gpp['gpp_base_postinfo_display']== true) ){
	$dispinfo = 1;
}else{
	$dispinfo = 0;
}
if(!isset($gpp) || $gpp == false || (!isset($gpp['gpp_base_slideshow_effect']) || $gpp['gpp_base_slideshow_effect']== false)){ 
	$effect = 1;
}else{
	$effect = $gpp['gpp_base_slideshow_effect'];
}

if(!isset($gpp) || $gpp == false || (!isset($gpp['gpp_base_slideshow_interval']) || $gpp['gpp_base_slideshow_interval']== false)){ 
	$slideshowinterval = 5000;
}else{
	$slideshowinterval = $gpp['gpp_base_slideshow_interval'];
}

if(!isset($gpp) || $gpp == false || (!isset($gpp['gpp_base_transition_speed']) || $gpp['gpp_base_transition_speed']== false)){ 
	$transitionspeed = 500;
}else{
	$transitionspeed = $gpp['gpp_base_transition_speed'];
}

if(!isset($gpp) || $gpp == false  || (!isset($gpp['gpp_base_display_info']) || $gpp['gpp_base_display_info']!= false) ){
	$displayinfo = 1;
}else{
	$displayinfo = 0;
}

if(is_single() || is_page()){
	if ( stripos($post->post_content, '[gallery') !== false ){		
		$attachments =&get_children('post_type=attachment&post_mime_type=image&post_parent=' . $post->ID.'&order=DESC&orderby=menu_order ID' );				
			if ($attachments) {
				foreach ( $attachments as $post ) {															
					$imagearray = wp_get_attachment_image_src($post->ID,"large");					
					$imgjson .= "{image:'".$imagearray[0]."',title:' '},";
				}
			}
		$imgjson = substr($imgjson,0,-1);	
	}else{	
		if (has_post_thumbnail( $post->ID ) ): 
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' ); 
			$imgjson = "{image:'".$image[0]."'}";
		endif;
		if($imgjson != ""){
			echo '<div id="controls-wrapper" style="z-index:99;"><div id="controls"><div id="showhide" class="hidecont">Show/Hide</div></div></div>';
		}
	}	
}elseif((isset($gpp['gpp_base_homepage_design']) && $gpp['gpp_base_homepage_design']=='single') && is_home()) { //single gallery in homepage with images
		 	$post_type = "galleries";
			$category = "";	
			$postid = $gpp['gpp_base_homepage_gallery'];			
			$attachments = get_children('post_type=attachment&post_mime_type=image&post_parent='.$postid.'&order=DESC&orderby=menu_order ID' );						
			if ($attachments) {
				foreach ( $attachments as $post ) {															
					$imagearray = wp_get_attachment_image_src($post->ID,"large");					
					$imgjson .= "{image:'".$imagearray[0]."',title:' '},";
				}
			}
			//print_r($imgjson);
			$imgjson = substr($imgjson,0,-1);
			//print_r($imgjson); 	
}else{
	$catid = "";
	$tagid = "";
	$arcyear = "";
	$arcmonth  = "";
	$arcday = "";
	$arcauthor = "";
	$taxarray = "";
	
	
	if(is_home()){
		if(isset($gpp['gpp_base_homepage_cats'])){
			$catid = substr($gpp['gpp_base_homepage_cats'],0,-1);
		}
		if((isset($gpp['gpp_base_homepage_design']) && $gpp['gpp_base_homepage_design']=='galleries') && is_home()) { //all galleries in homepage with single image
			$post_type = "galleries";
			$catid = "";
			if(isset($gpp['gpp_base_homepage_colls'])){	
				$collection = substr($gpp['gpp_base_homepage_colls'],0,-1);	
				$collections = explode(",", $collection);
				$taxarray = array(							
								array(
									'taxonomy' => "collections",
									'field' => 'id',
									'terms' => $collections								
								)
							) ;	
			}else{
				$collections = array();
				$taxarray = "";
			}
				
		}else{	
			$post_type = "post";
		}
	}
	
	if(is_category()){		
		$catid = $cat;
		$post_type = "post";
	}
	/* if(is_tag()){
		$tagid = $tag;
		$post_type = "post";
	} */
	if(is_date()){
		$post_type = "any";
		if(is_year()){				
			$arcyear = $year;
			$arcmonth = "";
			$arcday = "";			
		}
		if(is_month()){				
			$arcyear = $year;
			$arcmonth = $monthnum;
			$arcday = "";			
		}
		if(is_day()){				
			$arcyear = $year;
			$arcmonth = $monthnum;
			$arcday = $day;				
		}
	}
	if(is_author()){
		$post_type = "any";
		$arcauthor = $author;	
	}	
	
	if(is_search()){
		$post_type = "~none";
	}
	
	// if we are viewing a custom taxonomy for galleries, don't get category
	if(is_tax()) {		
		$post_type = "galleries";
		$catid = "";
		$tax = $wp_query->get_queried_object();
		$taxname = $tax->taxonomy;
		$tax = $tax->slug;
		$taxarray = array(							
							array(
								'taxonomy' => $taxname,
								'field' => 'slug',
								'terms' => $tax
							)
						) ; 
	}
	
	$args = array(
				'posts_per_page'=>$ppp,
				'ignore_sticky_posts' =>0,
				'cat' => $catid,
				'tag'=> $tagid,
				'author' => $arcauthor,
				'year' => $arcyear,
				'monthnum' => $arcmonth,
				'day' => $arcday,
				'paged' => $paged,
				'meta_key' => '_thumbnail_id',
				'post_type' => $post_type,
				'tax_query' =>$taxarray
				);
	if(/* !in_category($catarray) &&  */!is_tag()) {			
		$temp = $wp_query;
		$wp_query = null;
		$wp_query = new WP_Query();
		$wp_query->query($args);	
		while ($wp_query->have_posts()) : $wp_query->the_post();
			if (has_post_thumbnail( $post->ID ) ): 
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' ); 
				$imgjson .= "{image:'".$image[0]."',title:'".addslashes($post->post_title)."',url:'".$post->guid."'},";
			endif;
		endwhile;
		
		$wp_query = null; $wp_query = $temp;	
		$imgjson = substr($imgjson,0,-1); 
	}
} 
if($imgjson=="" && $custombg != ""){$imgjson = "{image:'".$custombg."',title:'Blog',url:''}";}elseif($imgjson=="" && $custombg == ""){$imgjson = "{image:'".content_url()."/themes/immense/images/default.jpg',title:'Blog',url:''}";}
$imgcnt = substr_count($imgjson,"image:");	
$imgpath = get_bloginfo('stylesheet_directory')."/library/supersized/img/";

$doc_ready_script = '
	<script type="text/javascript">
		jQuery(document).ready(function(){
				
				jQuery.supersized({			
					//Functionality
					slideshow               :   1,		//Slideshow on/off
					autoplay				:	'.$autoplay.',		//Slideshow starts playing automatically
					start_slide             :   1,		//Start slide (0 is random)
					random					: 	0,		//Randomize slide order (Ignores start slide)
					slide_interval          :   '.$slideshowinterval.',	//Length between transitions
					transition              :   '.$effect.', 		//0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
					transition_speed		:	'.$transitionspeed.',	//Speed of transition
					new_window				:	1,		//Image links open in new window/tab
					pause_hover             :   0,		//Pause slideshow on hover
					keyboard_nav            :   1,		//Keyboard navigation on/off
					performance				:	0,		//0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
					image_protect			:	1,		//Disables image dragging and right click with Javascript
					image_path				:	"'.$imgpath.'", //Default image path
					display_info			:	"'.$displayinfo.'",
					//Size & Position
					min_width		        :   0,		//Min width allowed (in pixels)
					min_height		        :   0,		//Min height allowed (in pixels)
					vertical_center         :   1,		//Vertically center background
					horizontal_center       :   1,		//Horizontally center background
					fit_portrait         	:   1,		//Portrait images will not exceed browser height
					fit_landscape			:   0,		//Landscape images will not exceed browser width
					
					//Components
					navigation              :   1,		//Slideshow controls on/off
					thumbnail_navigation    :   1,		//Thumbnail navigation
					slide_counter           :   0,		//Display slide numbers
					slide_captions          :   1,		//Slide caption (Pull from "title" in slides array)
					slides 					:  	[		//Slideshow Images														
														'.$imgjson.'							
												]								
				}); 				
				
				jQuery("#page .entry-content>div#controls-wrapper").detach().appendTo("#page");	
				
				/* menu hover addclass */
				jQuery("#upmenu").mouseover(function(){										
					jQuery("#upmenu a.upmenu").addClass("slideup")/* .parent().css("padding-right","50px") */;					
				});
				jQuery("#upmenu").mouseout(function(){					
					jQuery("#upmenu a.upmenu").removeClass("slideup")/* .parent().css("padding-right","0px") */;					
				});		
								
				
				/* Hover delay added in menu to stop flickering */
				jQuery("#upmenu").hover(
					function() {
						 var that = this;						 
						 jQuery(this).data("timer", setTimeout(function(){test(that)},300));
						 function test() {							
							jQuery("div#upmenu div.menu").slideDown("fast");
							jQuery("a.upmenu.slideup").css("background-position", "0 -38px");							
						 }
					 },
					 function () {						
						 var timer = jQuery(this).data("timer");
						 if (timer) jQuery(this).data("timer", clearTimeout(timer));
						jQuery("div#upmenu div.menu").slideUp("fast");
						jQuery("a.upmenu").css("background-position", "0 -6px");	
					}
				); 
				
				var curimgid = jQuery("#controls #thumbnav a.curimg").attr("id");
				var curtitle = jQuery("#content #post"+curimgid+" h3 a").html();
				
				//toggle the content in single page.
				jQuery("#showhide").live("click",function(){
					jQuery(this).toggleClass("showcont").toggleClass("hidecont");
					jQuery("#page #main").fadeToggle();
					jQuery("#page #pagecontent").fadeToggle();
				});	
				
				//toggle the content in single page.
				jQuery("#showhidearch").live("click",function(){			
					jQuery("#page #archposts").fadeToggle();
				});
							
				// Toggle class
				jQuery(".showcontent").live("click",function(){
					jQuery(this).toggleClass("active");
				});
				
				/* info hover addclass */
				jQuery(".showcontent, #showhidearch").live("mouseover",function(){										
					jQuery(this).addClass("infoup");			
				});
				jQuery(".showcontent, #showhidearch").live("mouseout",function(){
					//if (!jQuery(".eachposts").is(":visible")) {
						jQuery(this).removeClass("infoup");
					//}								
				});
				
				/* Wrap the archive contents into one div 
				jQuery("#page>.eachposts").wrapAll("<div id=\"archposts\" />");*/	

				/* Wrap all contents of single post in one div */
				jQuery(".single #page #branding").nextUntil("#controls-wrapper").wrapAll("<div id=\"pagecontent\" />");
				
				jQuery(".single-galleries #page div#content").unwrap();
				jQuery(".single-galleries #page div#content").children().not("#controls-wrapper, .eachposts").hide();
				
				/* Wrap all contents of page in one div */
				jQuery(".page #page #branding").nextUntil("#controls-wrapper").wrapAll("<div id=\"pagecontent\" />");
				
				/* Wrap all contents of page in one div */
				jQuery(".error404 #page #branding").nextUntil("#controls-wrapper").wrapAll("<div id=\"e404content\" />");
				
				/* Wrap all contents of page in one div */
				jQuery(".search #page #branding").nextUntil("#controls-wrapper").wrapAll("<div id=\"searchcontent\" />");
				
				// Show content initially		
					jQuery("#post0").show();
			';
 // Show content initially			
 if(!isset($gpp['gpp_base_display_info']) || $gpp['gpp_base_display_info']==true){			
	$doc_ready_script .= '				
			jQuery("#post0").show();	
//alert("aaaaaaaaaaaaa");			
	';			
}else{
	$doc_ready_script .= '				
			jQuery("#post0").hide();			
	';	
} 			
if(is_archive()){
	if(is_author()){		
		$content = ' ' . $user_info->display_name;
	} elseif ( is_month() ) { 		
		$content = ' ' . single_month_title("", false);
		$content .= __(' Archives:', 'gpp_base_lang');
	} elseif ( is_date() ) { 		
		$content = ' ' . get_the_date();
		$content .= __(' Archives:', 'gpp_base_lang');
	} else {		
		$content = ' ' . single_term_title("", false);
	}
	$doc_ready_script .= '
			jQuery("#archivefor").html("'.$content.'");
		';
}
if($imgcnt>20 && $imgcnt<=40){
	$mar1="5px";  $mar2="6px";  
}elseif($imgcnt>40 && $imgcnt<=60){
	 $mar1="13px"; $mar2="0px";
}elseif($imgcnt>60){
	$mar1="0px"; $mar2="0px"; 
} else{
	 $mar1=0; $mar2="9px";
}

$doc_ready_script .= '
	jQuery("#controls-wrapper #controls #showhide, #controls-wrapper #controls #navigation").css("margin-top","'.$mar1.'");
	jQuery("#controls-wrapper").css("margin-bottom","'.$mar2.'");
'; 

if(in_category($catarray) || is_tag()) { 
	$doc_ready_script .= '
				/* Wrap all contents of blog archive page in one div */
				jQuery(".archive #page #branding").nextUntil("#controls-wrapper").wrapAll("<div id=\"pagecontent\" />");
	';
}	

$doc_ready_script .= '
			});
		</script>
';			
	echo $doc_ready_script;	
?>