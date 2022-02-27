<?php 
global $gpp;
$blogcats = "";
$blogexclude = "";

//changing the descriptions of widgets
add_filter('instructions_desc', 'gpp_base_instructions_desc_uno');
function gpp_base_instructions_desc_uno(){return "This theme uses Widgets.<br /><br />";}

$gpp = get_option('gpp_base_options');
if(isset($gpp['gpp_base_blog_cat'])) {
	$blogcats = substr($gpp['gpp_base_blog_cat'],0,-1);
	$blogexclude = $blogcats; //str_replace(',',' and ', $blogcats);
}

	$allcategories = get_all_category_ids();
	$catarray = explode(",",$blogcats);
	$nonblogcatstemp = array_diff($allcategories,$catarray);
	$tempcats = "";
	foreach($nonblogcatstemp as $nonblogcat){
		$tempcats .= $nonblogcat.",";
	}
	$nonblogcats = str_replace(',',',', substr($tempcats,0,-1));

// Define Theme Options Variables
$themename = "Uno";
$showsidebar= "false";

// Available css themes
if( ! isset( $css ) ) {
	$css = array( "default.css" => "Default Light", "dark.css" => "Dark", "fancy.css" => "Fancy" );
	$defaultcss = "default.css";
}

//config
$showsidebaroption = 0;
$showhomewidgetoption = 0;
$showblogoption = 1;
$showheadermenu = 0;
$showbackgroundmenu = 0;
$content_width = 940;
$showfooterwidgets = false;
if((isset($gpp['gpp_base_footer']) && $gpp['gpp_base_footer']==true)){
	$showfooterwidgets = true;
}
// Add Post Thumbnail Theme Support
if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support( 'post-thumbnails' );
}


// Set image sizes upon theme activation
function gpp_base_child_setup() {
	// updating thumbnail and image sizes
	update_option( 'thumbnail_size_w', 300, true );
	update_option( 'thumbnail_size_h', 200, true );
	update_option( 'medium_size_w', 620, true );
	update_option( 'medium_size_h', '', true );
	update_option( 'large_size_w', 940, true );
	update_option( 'large_size_h', '' );
}

add_action( 'init', 'gpp_base_child_setup' );

// remove base indexloop / footer
add_action('wp_head','remove_gpp_base_actions');
function remove_gpp_base_actions() {
 	global $catarray;
 	remove_action('gpp_base_loop_hook','gpp_base_loop_wrapper');
 	remove_action('gpp_base_sidebar_hook','gpp_base_sidebar');
	remove_action('gpp_base_single_post_hook', 'gpp_base_single_post');	
 	remove_action('gpp_base_archive_loop_hook','gpp_base_archive_loop');
	remove_action('gpp_base_author_loop_hook', 'gpp_base_author_loop');
	remove_action('gpp_base_search_loop_hook','gpp_base_search_loop'); 	
 	remove_action('gpp_base_check_sidebar_hook', 'gpp_base_check_sidebar');
	//remove_action('gpp_base_navigation_hook', 'gpp_base_navigation', 2);
	remove_action('gpp_base_single_meta_hook', 'gpp_base_single_meta');
	//remove_action('gpp_base_below_title_hook', 'gpp_base_below_title');

	// have to load default gallery in blog page/posts
	if((!is_page_template('page-blog.php') && !in_category($catarray)) || is_home()) {
		remove_shortcode('gallery', 'gallery_shortcode');
		add_shortcode('gallery', 'uno_gallery_shortcode');		
	}
}

/* overwriting the base prev next links with in_same_cat to true */
add_filter('gpp_base_previous_post_link_args','gpp_base_previous_post_link_args_uno');
function gpp_base_previous_post_link_args_uno(){
	global $blogexclude, $catarray, $nonblogcats;	
	if ( in_category( $catarray ) ) {
		$catstoexclude = $nonblogcats;
	 }else {
		$catstoexclude = $blogexclude;
	 }
	 
	$args = array (	'format' 				=> '%link',
					'link'                	=> '<span class="meta-nav">&laquo;</span> %title',
					'in_same_cat'         	=> FALSE,
					'excluded_categories' 	=> $catstoexclude);
	
	return $args;
}
add_filter('gpp_base_next_post_link_args','gpp_base_next_post_link_args_uno');
function gpp_base_next_post_link_args_uno(){
	global $blogexclude, $catarray, $nonblogcats;
	if ( in_category( $catarray ) ) {
		$catstoexclude = $nonblogcats;
	 }else {
		$catstoexclude = $blogexclude;
	 }
	$args = array (	'format' 				=> '%link',
					'link'                	=> '%title <span class="meta-nav">&raquo;</span>',
					'in_same_cat'         	=> FALSE,
					'excluded_categories' 	=> $catstoexclude);
	
	return $args;
}



//bypass sidebar option
add_action('gpp_base_check_sidebar_hook', 'gpp_base_check_sidebar_uno');	
function gpp_base_check_sidebar_uno() {
	 echo "nosidebar"; 
}



// Redirect homepage to single post page
add_action('gpp_base_loop_hook', 'gpp_base_loop_uno');	
function gpp_base_loop_uno() { 
	global $gpp, $blogcats, $post;
	$tmp_post = $post;
	$id="";
	$exblogcats = str_replace(",",",-",$blogcats);		
	// grab latest post which is not blog
	$posts = get_posts(array('numberposts'=>1,'category'=>-$exblogcats,'post__in'=>get_option('sticky_posts')));
	
	//to find out next latest post
	$postnext = get_posts(array('numberposts'=>1,'offset'=>1,'category'=>-$exblogcats,'post__in'=>get_option('sticky_posts')));
	
	$next_url = "";
	
	if(!empty($postnext)) {

		foreach($postnext as $obj) { // no need for $a - just use $result
	   	 $id =  $obj->ID;
		} 
					
		// grab next post URL
		$next_url = get_permalink($id);
	
	}

	// The Loop
	foreach( $posts as $post ) :	setup_postdata($post); ?>		
		
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>		
		
		<div class="entry-content maincontent">			
			<?php 			
				
				if (stripos($post->post_content,'[gallery') !== false) { 
					echo apply_filters( 'the_content', '[gallery]'); 
				} else { ?>
				<div class="slide"><div>
					<?php the_post_thumbnail('large'); ?>
					</div>
				</div>
			<?php	}

			?>
			<div class="navigation">
				<div class="nav-previous"><?php if($next_url) { ?><a rel="prev" href="<?php echo $next_url; ?>"></a><?php } ?></div>
				<div class="nav-next"></div>
				<div class="clear"></div>
			</div>
		</div><!-- .entry-content -->			
		
		<div class="meta">				
			<h2 class="entry-title-meta"><a href="#singlecontent" class="title"><?php the_title(); ?></a></h2>
			<div class="title-meta">
				<?php if(comments_open()) { ?>&#183;<?php } ?> <span class="comments-link"> <?php
				comments_popup_link( __( 'Leave a comment', 'gpp' ), __( '1 Comment', 'gpp' ), __( '% Comments', 'gpp' ), '', '');  ?>
			</span> &#183; <?php gpp_base_posted_on_hook(); ?>
			</div>				
		
			<div class="imgnav">				
				<div class="navigation">
					<div class="nav-previous"><a rel="prev" href="<?php echo $next_url; ?>"></a></div>
					<div class="nav-next"></div>
					<div class="clear"></div>
				</div>
				<div id="circles"><div id="indicator"></div></div>				
			</div>	

		</div><!-- .meta-->
		
 		<div class="clear"></div>
		<div id="singlecontent">
			<?php 
			add_filter('the_content', 'remove_specific_shortcode');
			gpp_base_content(); ?>
		</div>  
		
		</article><!-- #post-<?php the_ID(); ?> -->
		
	<?php		

	endforeach; 
	$post = $tmp_post;
} 

/* Custom Gallery for Uno */

//replace default gallery shortcode by image slider if not blog category
function uno_gallery_shortcode($attr) {
   global $post;	

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,		
		'columns'    => 3,
		'size'       => 'thumbnail',
		'include'    => '',
		'exclude'    => ''
	), $attr));

	$id = intval($id);
	if ( 'RAND' == $order )
		$orderby = 'none';

	if ( !empty($include) ) {
		$include = preg_replace( '/[^0-9,]+/', '', $include );
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if ( empty($attachments) )
		return '';	
	
	$unoshortcode = '<div class="slide">';
	foreach ( $attachments as $id => $attachment ) {   
		$image = wp_get_attachment_image_src( $id,'large' );
		$permalink = $attachment->ID;
				$width = $image['1'];
				$height = $image['2'];
				
				if ($height >= $width) {
					$resizeheight = "600";
					$class = "vertical";
				} else {
					$class= "horizontal";
					$resizeheight = '';					
				}

					$unoshortcode .= "<div id='image-".$permalink."' class='image ".$class." clearfix'>"."\n";					
					$unoshortcode .= '<img src="'.$image[0].'" alt="'.$attachment->post_title.'" width="'.$width.'" height="'.$height.'"/>';
					if($attachment->post_excerpt) {$unoshortcode .=  '<span class="imgcaption">'.$attachment->post_excerpt.'</span>';}
					$unoshortcode .= "</div>"."\n";	 
				
	}
	
	$unoshortcode .='</div>';	
	return $unoshortcode;	
}


// single post design
add_action('gpp_base_single_post_hook', 'gpp_base_single_post_uno');
function gpp_base_single_post_uno() {
	global $gpp, $count, $videos, $post, $blogcats;
	$videos = get_post_meta($post->ID, "video", false);

	$catarray = explode(",",$blogcats);
	
	//print_r ($catarray);
	
	while ( have_posts() ) : the_post() ?>
		
		<?php 
		//non blog posts
		if(!in_category($catarray)): ?>
		
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>		
		
		<div class="entry-content maincontent">				
			
			<?php if(!$videos) { ?>
			
			<?php 			
				if (stripos($post->post_content,'[gallery') !== false) { 
					echo apply_filters( 'the_content', '[gallery]'); 
				} else { ?>
				<div class="slide"><div>
					<?php the_post_thumbnail('large'); ?>
					</div>
				</div>
				<?php }	?>		
			
			<?php } else { ?>
			<div class="slide"><div>
			<?php get_template_part('video');  ?> 
			</div></div>   	
			<?php } ?>
	    
	    	<?php if(!$videos) gpp_base_navigation_hook(); ?>	    	
	
		</div>		
		
		<div class="meta">	
					
			<h2 class="entry-title-meta"><a href="#singlecontent" class="title"><?php the_title(); ?></a></h2>
			<div class="title-meta">
				<?php if(comments_open()) { ?>&#183;<?php } ?> <span class="comments-link"> <?php
				comments_popup_link( __( 'Leave a comment', 'gpp' ), __( '1 Comment', 'gpp' ), __( '% Comments', 'gpp' ), '', '');  ?>
			</span> &#183; <?php gpp_base_posted_on_hook(); ?>
			</div>			
		
			<div class="imgnav">				
				<?php gpp_base_navigation_hook(); ?>
				<div id="circles"><div id="indicator"></div></div>						
			</div>

		</div><!-- .meta-->		
		
		
		</article>
		
		<?php else: ?>
		
			<!-- single blog post -->
			<div class="singleblog">
    		<h2 class="entry-title"><?php the_title(); ?></h2>
			<?php gpp_base_below_title_hook(); ?>
				<div class="entry-content">
					<?php get_template_part('video'); ?>
					<?php gpp_base_content(); ?>
					<?php wp_link_pages('before=<div class="page-link">' .__('Pages:', 'gpp') . '&after=</div>') ?>
				</div>
				<div class="entry-utility">
					<p class="postmetadata alt">
						<small>
							<?php printf(__('This entry was posted on %1$s at %2$s.','gpp_base_i18n'),get_the_time(__('l, F jS, Y','gpp_base_i18n')),get_the_time());?>
							<?php _e('It is filed under','gpp_base_i18n'); ?> <?php the_category(', '); the_tags(__(' and tagged with ','gpp_base_i18n')); ?>.
							<?php printf(__('You can follow any responses to this entry through the <a href="%1$s" title="%2$s feed">%2$s</a> feed.','gpp_base_i18n'),get_post_comments_feed_link(),__('RSS 2.0','gpp_base_i18n')); ?> 
							<?php edit_post_link(__('Edit this entry','gpp_base_i18n'),'','.'); ?>
						</small>
					</p>
				</div><!-- .entry-meta -->
				<?php gpp_base_navigation_hook(); ?>
				<div class="clear"></div>
				<?php gpp_base_comments(); ?>
			</div><!-- .post -->
			
			<!-- end single blog post -->
			
			
		<?php endif; ?>
	 <?php endwhile; wp_reset_query(); 
}

function remove_specific_shortcode($content='gallery') {
    $content = strip_shortcodes( $content );
  return $content;
}

add_action('gpp_base_after_single_post_hook', 'gpp_base_after_single_post_uno');	
function gpp_base_after_single_post_uno() { 
	add_filter('the_content', 'remove_specific_shortcode');
?>
	  <div class="clear"></div>
	<div id="singlecontent">
		<?php gpp_base_content(); ?>
	</div>  

<?php } 

//add archive and author page
add_action('gpp_base_author_loop_hook', 'gpp_base_archive_loop_uno');	
add_action('gpp_base_archive_loop_hook', 'gpp_base_archive_loop_uno');	
function gpp_base_archive_loop_uno() { 
 	$i = 0;
 	while ( have_posts() ) : the_post() ?>
	<div class="archive-thumb<?php if ($i%3==2){echo " omega";} ?>">
			 <h3 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s','gpp_base_lang'),the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a></h3>
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s','gpp_base_lang'),the_title_attribute('echo=0')); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
	</div>
	<?php $i++; endwhile; ?>	
<?php }

//Add Search Page
add_action('gpp_base_search_loop_hook', 'gpp_base_search_loop_uno');	
function gpp_base_search_loop_uno() { 
	$i = 0;
	while ( have_posts() ) : the_post() ?>
	<div class="archive-thumb<?php if ($i%3==2){echo " omega";} ?>">
			 <h3 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s','gpp_base_lang'),the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a></h3>
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s','gpp_base_lang'),the_title_attribute('echo=0')); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
			<?php gpp_base_content(); ?>
	</div>
	<?php $i++; endwhile; ?>	
<?php }

// load scroller js
add_action( 'template_redirect', 'gpp_base_load_js_uno' );
function gpp_base_load_js_uno( ) {	   
	wp_enqueue_script('scroll', get_bloginfo('stylesheet_directory').'/library/js/jquery.scrollTo-1.4.2-min.js', array('jquery'));	
}

// Add DOM ready scripts
add_action('wp_footer', 'gpp_base_load_doc_js_uno');
function gpp_base_load_doc_js_uno() {

	$doc_ready_script = '
	<script type="text/javascript">
		/* <![CDATA[ */
		jQuery(document).ready(function(){			
			jQuery( ".maincontent" ).hide();
			jQuery( ".maincontent" ).fadeIn(1000);
			
			// redirect the home comment botton to single page comment. 
			var pathname = window.location;
			var pathname = pathname.toString()			
			var urlstring = pathname.substr(pathname.length - 7);			
			if(urlstring === "respond"){				
				jQuery("#singlecontent, #commentsbox").toggle();
			}
			';			
	
	if(!is_page_template('page-blog.php') && !is_home()){
		$doc_ready_script .= '
				jQuery(".comments-link a").click( function(e){
					e.preventDefault();
					jQuery("#singlecontent, #commentsbox").toggle();
					jQuery(window).scrollTo(jQuery("div[id=\"singlecontent\"]"), 600);
				});
			'; 
	}	
	if(!is_page_template('page-blog.php')){
		$doc_ready_script .= '
				jQuery("a.title").click( function(e){
					e.preventDefault();
					jQuery("#singlecontent, #commentsbox").toggle();
					jQuery(window).scrollTo(jQuery("div[id=\"singlecontent\"]"), 600);
				});
			'; 
	}
	
	$doc_ready_script .= '		
			if(jQuery(".slide div").length > 1) {			
				
				jQuery(".slide div:gt(0)").hide();
				jQuery("#indicator").show();
				aindex = 0;

				//when window changes grab the image height and set slide height dynamically
				jQuery(window).resize(function() {
					var slideheight = parseInt(jQuery("div.slide div").height());
					jQuery(".slide").height(slideheight);
				});
				jQuery(".maincontent .slide div").each(function(index){
					jQuery("#indicator").append("<a href=\"#\">"+index+"</a>");
				});
				jQuery("#indicator a:first-child").addClass("active");
				
				// add class to identify first and last item
				jQuery(".slide div:first-child").addClass("first active");
				jQuery(".slide div:last-child").addClass("last");
				
				// check last post
				if(jQuery(".nav-previous").html()=="") {
					jQuery(".nav-previous").html("<a href=\"#\"></a>");
				}
				
				// right link browse older posts
				jQuery(".nav-previous a").live("click",function(e){					
					if(!jQuery(".slide div.active").hasClass("last")) {
						e.preventDefault(); 
						jQuery("#indicator a.active").removeClass().next("a").addClass("active");	 
						var slideheight = parseInt(jQuery("div.slide div").height());
						jQuery(".slide").height(slideheight);
						jQuery(".slide div:first-child").removeClass("active").hide()			
							.next("div").addClass("active").fadeIn()
	         				.end().appendTo(".slide");         			        			
         			} 
         			
         			//empty last post last image link         			
         			if(jQuery(".nav-previous").html()=="<a href=\"#\"></a>" && jQuery(".slide div.active").hasClass("last")) {			
	         			jQuery(".nav-previous").html("");
	         		}
	         		
         			// check first post not first image and add link
         			if(jQuery(".nav-next").html()=="") {
						jQuery(".nav-next").html("<a href=\"#\"></a>");
					}
					

				});
				
				// left link browse newer posts
				jQuery(".nav-next a").live("click",function(e){					
					if(!jQuery(".slide div.active").hasClass("first")) {
						e.preventDefault();
						jQuery("#indicator a.active").removeClass().prev("a").addClass("active");
						jQuery(".slide div:last-child").prependTo(".slide").addClass("active");
						jQuery(".slide div:first-child").fadeIn().next("div").hide().removeClass("active");				
					}	
					
					//check first post first image empty <a> link
					if(jQuery(".nav-next").html()=="<a href=\"#\"></a>" && jQuery(".slide div.image").first().hasClass("first")) {
						jQuery(".nav-next").html("");
					}
					
					// check last post not last image and add link
         			if(jQuery(".nav-previous").html()=="") {
						jQuery(".nav-previous").html("<a href=\"#\"></a>");
					}
						
				});				
				
				// clickable circle indicators nav does not work
				jQuery("#indicator a").click(function(e){
					e.preventDefault();					
				});		
				
			}
			
			jQuery(".maincontent").contents().not(".slide, .navigation").detach();
			
		});
/* ]]> */
	</script>';
					
	echo $doc_ready_script;

}

add_filter('childcss', 'gpp_base_custom_css_uno');

/* Load uno custom CSS for logo */
function gpp_base_custom_css_uno() { 
	global $gpp;
	$logo = $gpp['gpp_base_logo'];
	if($logo <> "") {
		list($width) = getimagesize($logo);
		echo "#masthead h1 {width: ".$width."px; margin: 0 auto 5px;}";
	}
}