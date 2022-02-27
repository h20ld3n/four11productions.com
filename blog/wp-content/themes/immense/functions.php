<?php
global $sidebarshow,$showbackgroundmenu;
// Define Theme Options Variables
$themename='Immense';
$showsidebaroption = 1; 
$showsidebar = true; 
$showheadermenu = 0;
$showfooterwidgets = false;
$showhomewidgetoption = 0;

// Available css themes
$css = array( "default.css" => "Default" );
$defaultcss = "default.css";

add_filter('logo_desc', 'gpp_base_logo_desc_im');
function gpp_base_logo_desc_im(){return "Upload a logo for your theme, or specify the image address of your online logo. (http://yoursite.com/logo.png).  Logos should be in transparent PNG format and be 20px in max height and 300px in max width.  If you don't upload a logo, your site name will appear in unstyled html text.";}

add_filter('instructions_desc', 'gpp_base_instructions_desc_im');
function gpp_base_instructions_desc_im(){return "This theme uses widgets in the footer and sidebar.<br /><br />";}

// Allow Custom Background Image
if($showbackgroundmenu) add_custom_background();

// Set image sizes upon theme activation
function gpp_base_child_setup() {
	// updating thumbnail and image sizes
	update_option( 'thumbnail_size_w', 150, true );
	update_option( 'thumbnail_size_h', 150, true );
	update_option( 'medium_size_w', 620, true );
	update_option( 'medium_size_h', '', true );
	update_option( 'large_size_w', 940, true );
	update_option( 'large_size_h', 800, true );
}

add_action( 'init', 'gpp_base_child_setup' );


$apphide = array();
if (!is_admin()) add_action('wp_print_styles', 'gpp_immense_stylesheet');	
function gpp_immense_stylesheet() {
	wp_register_style( 'gpp-supersize-style', get_bloginfo('stylesheet_directory').'/library/js/supersized/css/supersized.css');
	wp_enqueue_style( 'gpp-supersize-style');		
}
// load jquery and core slider functionality
if (!is_admin()) add_action( 'wp_enqueue_scripts', 'load_js_im' );
function load_js_im( ) {	   
	wp_enqueue_script('supersize', get_bloginfo('stylesheet_directory').'/library/js/supersized/js/supersized.3.1.3.js', array( 'jquery' ) );		
}

//Declearing a hook for up-menu
function up_menu() {
    do_action('up_menu');
}

/*-----------------------------------------------------------------------------------*/
/* REMOVE BASE DEFAULTS TO OVERIDE */
/*-----------------------------------------------------------------------------------*/
add_action('wp_head','remove_gpp_base_actions');
function remove_gpp_base_actions() {
	global $gpp,$catarray;
	// grab categories from theme options removing the trailing comma, else removes undefined variable
	if(isset($gpp['gpp_base_blog_cat'])){
		$cats = substr($gpp['gpp_base_blog_cat'],0,-1);
	}else{
		$cats = "";
	}	
	$catarray = explode(",",$cats);	
	//print_r($catarray);
	
	add_action('up_menu', 'gpp_base_nav');	
	require_once (STYLESHEETPATH.'/library/inc/core-js.php');
	
	remove_action('gpp_base_nav_hook','gpp_base_nav');		
	remove_action('gpp_base_index_loop_hook', 'gpp_base_index_loop');
	if(!in_category($catarray) && !is_tag()) {
		remove_action('gpp_base_archive_loop_hook','gpp_base_archive_loop');
		add_action('gpp_base_archive_loop_hook', 'gpp_base_index_loop_im');
	}
	remove_action('gpp_base_author_loop_hook', 'gpp_base_author_loop');	
	remove_action('gpp_base_page_title_hook', 'gpp_base_page_title'); // remove the title of archive and author page

	
	if(is_home()){
		if(!is_single()){
			remove_action('gpp_base_navigation_hook', 'gpp_base_navigation', 2);
		}
		//if(!in_category($catarray) && !is_tag()) {
			remove_action('gpp_base_sidebar_hook','gpp_base_sidebar');
			remove_action('gpp_base_check_sidebar_hook', 'gpp_base_check_sidebar');		
			add_action('gpp_base_check_sidebar_hook', 'gpp_base_no_sidebar');
		//}		
	}
	
	if(is_archive() && (!in_category($catarray) && !is_tag()) ){		
		remove_action('gpp_base_sidebar_hook','gpp_base_sidebar');
		remove_action('gpp_base_check_sidebar_hook', 'gpp_base_check_sidebar');		
		add_action('gpp_base_check_sidebar_hook', 'gpp_base_no_sidebar');
		remove_action('gpp_base_navigation_hook', 'gpp_base_navigation', 2);		
	}
	
	
	if((is_single() || is_page()) && !is_page_template('page-blog.php')){
		remove_shortcode('gallery', 'gallery_shortcode');
		add_shortcode('gallery', 'im_gallery_shortcode');
	}
}

function gpp_base_no_sidebar() {
	echo "nosidebar";
}

add_action('gpp_base_nav_hook', 'gpp_base_nav_im');
function gpp_base_nav_im() { ?>
	<div id="upmenu">
		<a href="#" class="upmenu">menu</a>			
		<?php up_menu(); ?>	
	</div>


<?php
}


/*-----------------------------------------------------------------------------------*/
/* CONTENT - INDEX LOOP **** ARCHIVE LOOP **** AUTHOR LOOP */
/*-----------------------------------------------------------------------------------*/

add_action('gpp_base_index_loop_hook', 'gpp_base_index_loop_im');
/* add_action('gpp_base_archive_loop_hook', 'gpp_base_index_loop_im'); */
add_action('gpp_base_author_loop_hook', 'gpp_base_index_loop_im');

function gpp_base_index_loop_im() {
	global $gpp, $post, $paged, $author, $tag, $cat, $monthnum, $day, $year, $max_pages, $wp_query, $taxarray;
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; //enabeling paging
	$ppp = get_option('posts_per_page'); // Get number of posts set in the setting page

	$z= 0;
	$nop = 0;
	$catid = "";
	$tagid = "";
	$arcyear = "";
	$arcmonth  = "";
	$arcday = "";
	$arcauthor = "";	
	
	// Somehow the wordpress global variables $day, $monthnum, $year are not coming since 3.3, hence we are defining them below. 
	
	$day = get_the_time('j' );
	$monthnum = get_the_time('n' );	
	$year = get_the_time('Y' );
	
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
			
		}elseif((isset($gpp['gpp_base_homepage_design']) && $gpp['gpp_base_homepage_design']=='single') && is_home()) { //single gallery in homepage with images
			$post_type = "galleries";
			$category = "";	
			$postid = $gpp['gpp_base_homepage_gallery'];			 
			$i = 0;
			
			$attachments =&get_children('post_type=attachment&post_mime_type=image&post_parent=' . $postid .'&order=DESC&orderby=menu_order ID' );		
			if ($attachments) {
				foreach ( $attachments as $attachment ) {				
					$imageTitle = $attachment->post_title;
					$imageCaption = $attachment->post_excerpt;
					$imageDescription = $attachment->post_content;
					?>
					<div id="post<?php echo $i; ?>" class="eachposts">
						<h3><?php echo $imageTitle; ?></h3>
						<p><?php echo $imageDescription; ?></p>						
					</div>
			<?php $i++;		
				}
			} 
			?>
			<div id="controls-wrapper">

			<div id="controls">								
				<!--Navigation-->			
				<div id="navblock">						
					
					<span id="gallerytitle"><?php echo get_the_title($postid); ?></span><div id="slidecaption"></div>
					<?php if($i>1){ ?>
						<div id="thumbnav">
						<?php for($j=0;$j<$i;$j++){ ?>
							<a href="#" class="imgs <?php if($j==0){echo 'curimg';} ?>" id="<?php echo $j; ?>"><?php echo $j; ?></a>
						<?php } ?>
						</div>
					<?php } ?>	
						<div id="playnav"><div id="navigation"><span id="pauseplay" class="pause">play</span></div></div>				
							
				</div>
				<!--Navigation-->
			</div>
		</div>		
		<?php 		
		}else{	
			$post_type = "post";
		}
	}
		
	if(is_category()){		
		$catid = $cat;
		$post_type = "post";
	}
	if(is_tag()){
		$tagid = $tag;
		$post_type = "post";
	}
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
	
	if(is_search()){
		$post_type = "any";
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
	//print_r($taxarray);
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
			
if((isset($gpp['gpp_base_homepage_design']) && $gpp['gpp_base_homepage_design']=='single') && is_home()) { 	}else{	
	$temp = $wp_query;
	$wp_query = null;

	$wp_query = new WP_Query();
	$wp_query->query($args);
	$max_pages = intval($wp_query->max_num_pages); // used for index/archive navigation
	
	$width = 0;
	while ($wp_query->have_posts()) : $wp_query->the_post(); ?>	
		
		<div class="eachposts" id="post<?php echo $nop; ?>">
			<h3><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s','gpp_base_lang' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
			<?php the_excerpt();
			$nop++; ?>
			<a href="<?php the_permalink(); ?>"><?php if($post_type=="galleries"){echo "View Gallery";}else {echo "View Post";} ?></a>
		</div>
<?php
endwhile;
 wp_reset_query();
$wp_query = null; $wp_query = $temp; 
?>	
	<div id="postcontent"></div>	
	<!--Thumbnail Navigation-->
	<div id="prevthumb"></div> <div id="nextthumb"></div>
	
	<!--Control Bar-->
	<div id="controls-wrapper">		
		<div id="controls">				
			<!--Navigation-->			
			<div id="navblock">								
				
				
				
				<!--Slide captions displayed here-->
			<?php  if(is_archive()){ ?> <div id="archivefor"></div><?php } ?>
			<div id="<?php if(is_page_template('page-blog.php')){echo "showhidearch"; }else{echo "slidecaption"; } ?>">info</div>
			
			<?php if($nop>1){ ?>
					<div id="thumbnav">
					<?php for($i=$z;$i<$nop;$i++){ ?>
						<a href="#" class="imgs <?php if($i==0){echo 'curimg';} ?>" id="<?php echo $i; ?>"><?php echo $i; ?></a>
					<?php } ?>
					</div>
				<?php } ?>
				<div id="playnav">
					<div id="navigation">
						<span id="pauseplay" class="pause">play</span>
					</div>
					<?php gpp_base_navigation(); ?>
				</div>
			</div><!--Navigation-->
			
			
			
		</div>
	</div>

<?php }
}


/*-----------------------------------------------------------------------------------*/
/* CONTENT - GALLERY SHORTCODE  REPLACE FOR POSTS AND PAGES */
/*-----------------------------------------------------------------------------------*/


//replace default gallery shortcode by image slider if not blog category
function im_gallery_shortcode($attr) {
   global $gpp, $post;
   // to show the custom taxonomies in single page of the custom post-type galleries
	if(get_post_type( $post->ID )=="galleries"){
		remove_action('gpp_base_single_meta_hook', 'gpp_base_single_meta');
		add_action('gpp_base_single_meta_hook', 'gpp_base_single_gallery_meta');
	}
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
		'size'       => 'thumbnail-50',
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
	
	
$cnt = 0;	
	
	$count = count( $attachments );
	if(isset($count)){$cnt = $count;}
	//echo $cnt;
 ?>
		<div id="controls-wrapper">

			<div id="controls">								
				<!--Navigation-->			
				<div id="navblock">		
													
					<?php if(is_single() && (get_post_type() == "galleries")){ ?>
						<span id="gallerytitle"><?php echo $post->post_title; ?></span><div id="slidecaption"></div>
					<?php }else{ ?>
						<div id="showhide" class="hidecont">Show/Hide</div>
					<?php } ?>

					
					<?php if($cnt>1){ ?>
						<div id="thumbnav">
						<?php for($i=0;$i<$cnt;$i++){ ?>
							<a href="#" class="imgs <?php if($i==0){echo 'curimg';} ?>" id="<?php echo $i; ?>"><?php echo $i; ?></a>
						<?php } ?>
						</div>
					<?php } ?>	
					<div id="playnav"><div id="navigation"><span id="pauseplay" class="pause">play</span></div></div>
										
									
				</div>
				<!--Navigation-->
			</div>
		</div>
<?php
}

/*-----------------------------------------------------------------------------------*/
/* Register new post type */
/*-----------------------------------------------------------------------------------*/

add_action( 'init', 'gpp_base_im_gallery_create_type' );

function gpp_base_im_gallery_create_type() {
	
	$sslug = __('Gallery','gpp_base_lang');
	$slug = __('Galleries','gpp_base_lang');
	
	$sslugl = strtolower($sslug); // single name lowercase
	$slugl = strtolower($slug); // plural name lowercase
	
	register_post_type('galleries',
		array(
			'labels' => array(
				'name'						=> $slug,
				'singular_name' 			=> $sslug,
				'add_new'					=> __('Add '.$sslug.''),
				'add_new_item'				=> __('Add '.$sslug.''),
				'new_item'					=> __('Add '.$sslug.''),
				'view_item'					=> __('View '.$slug.''),
				'search_items' 				=> __('Search '.$slug.''), 
				'edit_item' 				=> __('Edit '.$sslug.''),
				'all_items'					=> __('All '.$slug.''),
				'not_found'					=> __('No '.$slug.' found'),
				'not_found_in_trash'		=> __('No '.$slug.' found in Trash')
			),
			'taxonomies'	=> array('collections', 'gallery_tags'),
			'public' => true,
			'show_ui' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array( 'slug' => ''.$sslugl.'', 'with_front' => false ),
			'query_var' => true,
			'supports' => array('title','revisions','thumbnail','author','editor','comments'),
			'menu_position' => 5,
			'menu_icon' => get_bloginfo('stylesheet_directory').'/images/icon.jpg',
			'has_archive' => ''.$slugl.''
		)
	);
}


/*-----------------------------------------------------------------------------------*/
/* Register taxonomy for new post type */
/*-----------------------------------------------------------------------------------*/

add_action( 'init', 'gpp_base_im_gallery_taxonomy', 0 );  

function gpp_base_im_gallery_taxonomy() {
	register_taxonomy('collections','galleries',array(
				'hierarchical' => true,
				'label' => 'Collections',
				'query_var' => true,
				'rewrite' => true
	));
}

add_action( 'init', 'gpp_base_im_gallery_tags', 1 );  

function gpp_base_im_gallery_tags() {
	register_taxonomy( 'gallery_tags', 'galleries', array(
				'hierarchical' => false, 
				'update_count_callback' => '_update_post_term_count', 
				'label' => __('Gallery Tags'), 
				'query_var' => true, 
				'rewrite' => true
	)) ;
}

// ADDS EXTRA INFO TO ADMIN MENU FOR GALLERY POST TYPE
add_filter('manage_edit-galleries_columns', 'add_new_galleries_columns');
function add_new_galleries_columns($galleries_columns) {
	$new_columns['cb'] = '<input type="checkbox" />'; 	
	$new_columns['title'] = _x('Title', 'column name');
	$new_columns['author'] = __('Author');
	$new_columns['gcategories'] = __('Collections');
	$new_columns['gtags'] = __('Gallery Tags');	
	$new_columns['date'] = _x('Date', 'column name'); 
	return $new_columns;
}
  
// Add to admin_init function
add_action('manage_galleries_posts_custom_column', 'manage_galleries_columns', 10, 3);
function manage_galleries_columns($column_name, $id) {
global $post;	
	switch ($column_name) {
		case 'gcategories':			
			// Get the collections			
			$gcats = "";
						
			$collections = get_the_terms( $post->ID, 'collections');
			if($collections != ""){
				foreach($collections as $collection){					
					$gcats .= " <a href=edit.php?post_type=galleries&collections=".$collection->slug.">".$collection->name."</a>,";				
				}
			}
			echo substr($gcats,0,-1); 	 	
			break;
		case 'gtags':			
			// Get the collections	
			$gtags = "";			
			$gallery_tags = get_the_terms( $post->ID, 'gallery_tags');
			if($gallery_tags != ""){
				foreach($gallery_tags as $gallery_tag){				
					$gtags .= " <a href=edit.php?post_type=galleries&gallery_tags=".$gallery_tag->slug.">".$gallery_tag->name."</a>,";				
				}
			}			
			echo substr($gtags,0,-1); 	 	
			break;		 			
		default:
			break;
	} // end switch
}
 
// overwrite the default meta function with this for the custom post-type galleries
function gpp_base_single_gallery_meta() {
	global $post;
	$collections_list = get_the_term_list( $post->ID, 'collections', '', ', ', '' ); 
	$tags_list = get_the_term_list( $post->ID, 'gallery_tags', '', ', ', '' ); 

	echo '<div class="entry-utility">';
		_e('Posted in ','gpp_base_lang');  echo $collections_list; _e(' and tagged with ','gpp_base_lang');  echo $tags_list; echo ". ";
		 printf(__('<a href="%1$s" title="%2$s feed">%2$s</a> feed. ','gpp_base_lang'),get_post_comments_feed_link(),__('RSS 2.0','gpp_base_lang')); 
		 edit_post_link(__('Edit this entry','gpp_base_lang'),'','.'); 
	echo '</div>'; 
}

// turn off the comments in the gallery post types by default.
function default_comments_off( $data ) {
    if( $data['post_type'] == 'galleries' && $data['post_status'] == 'auto-draft' ) {
        $data['comment_status'] = 0;
    }
    return $data;
}
add_filter( 'wp_insert_post_data', 'default_comments_off' );


/*
get the gallery posts.
*/
$args = array('post_type'=>'galleries','numberposts'=>-1,'order'=>'DESC','orderby'=>'ID');				
$mygalleries = get_posts($args);
$galleries = array();

foreach( $mygalleries as $post ) :	setup_postdata($post);					
		if ( stripos($post->post_content, '[gallery') !== false){
			$galleries[get_the_ID()] = get_the_title();		
		}
endforeach;


/*
add filter to append child theme options to the main theme options
'gpp_base_child_options_hook' hook is define in theme-options.php file of base 
*/
$gpp_base_child_options = array();
add_filter( 'gpp_base_child_options_hook', 'load_uno_options' ); 
function load_uno_options() {
$shortname = "gpp_base";
$collsarray = array();
  
global $posts, $gpp_base_child_options, $multicheckcats, $wpdb, $galleries;
/* $numofimg = 10; */

$collectionids=$wpdb->get_results("SELECT term_id FROM $wpdb->term_taxonomy WHERE taxonomy='collections'");
foreach($collectionids as $collectionid){
	$collsname=$wpdb->get_var("SELECT name FROM $wpdb->terms WHERE term_id='".$collectionid->term_id."'");
	$collsarray[$collectionid->term_id] =  $collsname;		
}	

$slideshoweffects=array("0"=>"None","1"=>"Fade","2"=>"Slide Top","3"=>"Slide Right","4"=>"Slide Bottom","5"=>"Slide Left","6"=>"Carousel Right","7"=>"Carousel Left");

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
return $gpp_base_child_options ;
}
?>