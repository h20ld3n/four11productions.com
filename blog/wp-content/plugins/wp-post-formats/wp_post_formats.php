<?php
/*
Plugin Name: WP Post Formats
Plugin URI: http://www.tigerstrikemedia.com/plugins/wp-post-formats
Description: This Plugin creates a visual interface for modifying and editing how your post formats are formatted.
Version: 0.2
Author: Ben Casey
Author URI: http://www.tigerstrikemedia.com
License: GPL3
*/

/*
	Copyright 2011  Ben Casey  (email : bcasey@tigerstrikemedia.com)

	This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

function ra( $data ){
	echo '<pre>';
	print_r( $data );
	echo '</pre>';
}

/*
 * Define An Absolute Path to the plugin
 */
define( 'WPPF_ABSPATH' , plugins_url( 'wp-post-formats' ) ) ;

/*
 * International Baby
 */
load_plugin_textdomain('wppf_translations', false, '/lang/');

/*
 * Global Variables
 */

//As post formats are limited, we can set an array of them
$wppf_possible_formats = array(
	'aside',
	'gallery',
	'link',
	'image',
	'quote',
	'status',
	'video',
	'audio',
	'chat'
);

/*
 * Action And Filters.
 */

//Add The Administration Page
add_action ( 'admin_menu' , 'wppf_add_menu' ) ;

//Small Init Function to add theme supports
add_action ( 'init' , 'wppf_init' ) ;

//Save data function
add_action ( 'load-settings_page_wp-post-formats' , 'wppf_save_data' ) ;

//Activation / Deactivation Hooks
register_activation_hook( __FILE__ , 'wppf_install' ) ;
register_deactivation_hook( __FILE__ , 'wppf_uninstall' ) ;

/*
 * Adds An Administration Menu Under The General Options Page
 */
function wppf_add_menu() {
	add_options_page ( 'WP Post Format Options' , 'WP Post Formats' , 'manage_options' , 'wp-post-formats' , 'wppf_create_admin_page' );
}

/*
 * Generic Function To ERun On Init.
 */
function wppf_init(){
	
	//We need to overwrite any default post format functionality
	if( current_theme_supports( 'post-formats' )){
		remove_theme_support( 'post-formats' );
	}
	
	//And Add Theme Support for the selected ones.
	$formats = wppf_get_option( 'selected_formats' );	
	add_theme_support( 'post-formats' , $formats );
	
}

/**
 * Creates The HTML For The Administration Options Page
 * @since 0.1
 */
function wppf_create_admin_page() { 
	
	global $wppf_possible_formats ;
	//Get all the plugin options
	$wppf_options = get_option( 'wppf_options' );
	
	$selected_formats = $wppf_options['selected_formats'];
	
	$post_format_content_default = isset ( $wppf_options['post_format_content_default'] ) ? $wppf_options['post_format_content_default'] : false ;
	
	foreach( $wppf_possible_formats as $poss_format ) {
		if ( isset ( $wppf_options['post_format_content_' . $poss_format ] ) ) {
			$post_format_content_{ $poss_format } = $wppf_options['post_format_content_' . $poss_format ] ;
		}
	}
	?>
	<div class="wrap metabox-holder">
		<form name="wppf_general_options" action="" method="POST" >
		<?php wp_nonce_field('update-wppf-options'); ?>
		
		<div id="icon-options-general" class="icon32"><br /></div>
		<h2><?php  _e( 'WP Post Formats Options' , 'wppf_translations' ) ; ?></h2>
		
		<div class="postbox wppf_options_box">
			<h3><span><?php _e( 'Available Post Formats' , 'wppf_translations' ) ;?></span></h3>
			
			<div class="inside" style="padding:10px;">
			
			<?php foreach ( $wppf_possible_formats as $format ) { 
				$checked = isset( $selected_formats ) && in_array( $format , $selected_formats ) ? 'checked="checked"' : '' ;
			?>
				<label for="format-check-<?php echo $format ; ?>"><?php echo $format ; ?></label>
				<input <?php echo $checked ; ?> type="checkbox" name="format-check-<?php echo $format ; ?>" value="<?php echo $format ; ?>" />
			<?php } ?>
			
			</div>
		</div>

		<p class="available_tags">
			<?php _e( 
			'<p>Use The Following Boxes To Control Your Post Formats Display.</p>
			<p>The Following Tags Are Available By Default:<br />
			<ul>
				<li><b>{_permalink_} : </b> The Same As the_permalink(); </li>
				<li><b>{_content, more_link_text, stripteaser_} : </b> The Same As the_content( $more_link_text, $stripteaser );</li>
				<li><b>{_excerpt_} : </b> Same As the_excerpt(); </li>
				<li><b>{_title, before, after_} : </b> Same As the_title( $before, $after ); </li>
				<li><b>{_tags, before, sep, after_} : </b> Same As the_tags( $before, $sep, $after ); </li>
				<li><b>{_author_} : </b> Same As the_author(); </li>
				<li><b>{_category, seperator, parents_} : </b> Same As the_category( $seperator, $parents ); </li>
				<li><b>{_time_} : </b> Same as the_time(); The time format is the default set in the general settings</li>
				<li><b>{_post-thumbnail, size_} : </b> Same As the_post_thumbnail( $size )</li>
				<li><b>{_term-list, taxonomy, before, sep, after_} : </b> Same As get_the_term_list( $post->ID , $taxonomy, $before, $sep, $after )</li>
				<li><b>{_post-class_} : </b> Same As post_class(); </li>		
			</ul>
			</p>' , 
			'wppf_translations' 
			) ;?>			
		</p>
		
		<div class="postbox wppf_options_box">
			<h3><span><?php _e( 'Post Format - default' , 'wppf_translations' ) ;?></span></h3>
			
			<div class="inside">
				
				<textarea cols="140" rows="10" name="post_format_content_default"><?php echo stripslashes( $post_format_content_default ) ; ?></textarea>
			
			</div>
		</div>
		
		<?php foreach ($selected_formats as $format) { 
		$val = isset ( $wppf_options['post_format_content_' . $format] ) ? $wppf_options['post_format_content_' . $format] : '' ;
		?>
		
			<div class="postbox wppf_options_box">
				<h3><span><?php _e( 'Post Format - ' , 'wppf_translations' ) ;?><?php echo $format ; ?></span></h3>
				
				<div class="inside">
					
					<textarea cols="140" rows="10" name="post_format_content_<?php echo $format ; ?>"><?php echo stripslashes( $val ) ; ?></textarea>
				
				</div>
			</div>
		
		
		<?php } ?>
		
		<input type="submit" class="button-primary" name="wppf_options_submit" value="<?php _e( 'Save Options' , 'wppf_translations' ) ?>" />
		</form>
	</div>
	
<?php }

/**
 * Saves The Options To The Database
 */
function wppf_save_data(){
	
	//This function fires during the load process of the admin page, load up the CSS here:
	wp_enqueue_style( 'wppf_admin_styles' , WPPF_ABSPATH . '/admin-styles.css' ) ;
	
	if ( isset ( $_POST['wppf_options_submit'] ) ) {
			
		check_admin_referer( 'update-wppf-options' );
		
		global $wppf_possible_formats ;
		
		$checked_formats = array(); 
		
		foreach ( $wppf_possible_formats as $format ) {
			
			if ( isset( $_POST['format-check-' . $format ] ) ) {
				$checked_formats[] = $format ;
			}
			
			if ( isset ( $_POST['post_format_content_' . $format]) ) {
				wppf_save_option( 'post_format_content_' . $format , $_POST['post_format_content_' . $format] );
			}
			
		}
		
		if ( isset ( $_POST['post_format_content_default'] ) ) {
			wppf_save_option( 'post_format_content_default' , $_POST['post_format_content_default'] );
		}
		
		if ( ! empty($checked_formats) ) {
			wppf_save_option( 'selected_formats' , $checked_formats );
		}
		
	}
	
	
}

/*
 * Set Some default values for the plugin options
 */
function wppf_install(){
	$defaults = array(
		//Some Default Selected Formats
		'selected_formats' => array(
			'aside' ,
			'gallery'
		),
		
		'post_format_content_aside'   =>  '
<div {_post-class_} >
	<h2 class="entry-title"><a href="{_permalink_}">{_title_}</a></h2>
	<div class="post_content">
		{_excerpt_}
	</div>
</div>',
		
		'post_format_content_gallery' => '
<div {_post-class_} >
	<h2 class="entry-title"><a href="{_permalink_}">{_title_}</a></h2>
	<div class="post_content">
		{_content_}
	</div>
</div>',
		
		'post_format_content_default' => '
<div {_post-class_} >
	<h2 class="entry-title"><a href="{_permalink_}">{_title_}</a></h2>
	<div class="post_content">
		{_content_}
	</div>
</div>',
		
	);
	
	update_option( 'wppf_options' , $defaults );
	
}

/*
 * Uninstall Function.
 */
function wppf_uninstall(){
	
	delete_option( 'wppf_options' );
	
}


/**
 * As I am saving a lot of database queries be using a serialised array for the options, This function updates one option
 * @param String $option_name The name of the option to update
 * @param Mixed $value The Value of the option to update
 */
function wppf_save_option( $option_name , $value ) {
	$wppf_options = get_option( 'wppf_options' );
	
	//Some Basic Checking First
	if( ! $wppf_options ){
		//No Options Yet, Start with a blank array
		$wppf_options = array();
		
		//Add the first one.
		$wppf_options[$option_name] = $value;
	} else {
		//Already something there, Add The new option
		$wppf_options[$option_name] = $value;
	}
	
	//And save it
	return update_option( 'wppf_options' , $wppf_options );
	
}

/**
 * Returns an option value, if passed an array will call wppf_get_options with that value.
 * @param string $option_name
 * @return mixed
 */
function wppf_get_option( $option_name ) {
	
	//Get all the options
	$wppf_options = get_option( 'wppf_options' ) ;
		
	//If the option exists, return it
	if( array_key_exists( $option_name , $wppf_options ) ) {
		return $wppf_options[$option_name] ;
	}else{
		return false;
	}
	
	//If we get this far, something is very wrong
	return false;
	
}

/**
 * This Function Replaces the WPPFCode with the required content.
 * @param String $content
 */
function wppf_safe_format( $format , $post_id ) {
	
	global $post;
	$postdata = get_post( $post_id );
	
	//If There is a problem, gtfo
	if( ! $postdata ) {
		return false;
	}
	
	//Set The Delimiters
	$before = apply_filters( 'wppf_before_tag' , '{_' );
	$after = apply_filters( 'wppf_after_tag' , '_}' );
	
	//Split Up By The Before Delimiter
	$arr = explode( $before , $format );
	
	//And The After Delimiter
	foreach( $arr as $key => $val ) {
		$arr[$key] = explode( $after , $val );
		$datarr[$key] = $arr[$key][0];
	}
	
	//ra( $datarr );
	
	/* 
	 * Loop through the resulting array replacing the tags with the necessary content
	 */
	foreach( $datarr as $key => $val ) :
	
		/*
		 * {_content,more_link_text,stripteaser_}
		 * get_the_content( $more_link_text , $stripteaser );
		 */
		if( strpos( $val , 'content' ) === 0 ) {
			//Get The Arguments 
			$contentarr = explode( ',' , str_replace( ', ' , ',' , $val ) );
			$more = isset( $contentarr[1] ) ? $contentarr[1] : null ;
			$strip = isset( $contentarr[2] ) ? $contentarr[2] : 0 ;
			
			//Then The Content
			$content = apply_filters( 'the_content' , get_the_content( $more, $strip) );
						
			//And str_replace the content
			$format = str_replace( $before . $val . $after , $content , $format );
		}
		
		/*
		 * {_excerpt_}
		 */
		if( strpos( $val , 'excerpt' ) === 0 ) {
						
			//Get The Permalink
			$excerpt = get_the_excerpt();
						
			//And Replace the content
			$format = str_replace( $before . $val . $after , $excerpt , $format );
		}
		
		/*
		 * {_title,before,after_}
		 */
		if( strpos( $val , 'title' ) === 0 ) {
			
			$titlearr = explode( ',' , str_replace( ', ' , ',' , $val ) );
			$before_title = isset( $titlearr[1] ) ? $titlearr[1] : '' ;
			$after_title = isset( $titlearr[2] ) ? $titlearr[2] : '' ;
			
			//Get The Content
			$title = the_title( $before_title , $after_title , false );
						
			//And Replace the content
			$format = str_replace( $before . $val . $after , $title , $format );
		}
		
		/*
		 * {_permalink_}
		 */
		if( strpos( $val , 'permalink' ) === 0 ) {
						
			//Get The Permalink
			$permalink = get_permalink( $post_id );
						
			//And Replace the content
			$format = str_replace( $before . $val . $after , $permalink , $format );
		}
		
		/*
		 * {_tags,before,sep,after_}
		 */
		if( strpos( $val , 'tags' ) === 0 ) {
			
			$tagarr = explode( ',' , str_replace( ', ' , ',' , $val ) );
			$before_tags = isset( $tagarr[1] ) ? $tagarr[1] : __('Tags: ') ;
			$sep_tags = isset( $tagarr[2] ) ? $tagarr[2] : ',' ;
			$after_tags = isset( $tagarr[3] ) ? $tagarr[3] : '' ;
			
			//Get The Tags
			$tags = get_the_tag_list($before_tags, $sep_tags, $after_tags);
						
			//And Replace the content
			$format = str_replace( $before . $val . $after , $tags , $format );
		}
		
		/*
		 * {_category,seperator,parents_}
		 */
		if( strpos( $val , 'category' ) === 0 ) {
			
			$catarr = explode( ',' , str_replace( ', ' , ',' , $val ) );
			$sep_cats = isset( $catarr[1] ) ? $catarr[1] : '' ;
			$parent_cats = isset( $catarr[2] ) ? $catarr[2] : '' ;
			
			//Get The Cats
			$cats = get_the_category_list( $sep_cats, $parent_cats );
						
			//And Replace the content
			$format = str_replace( $before . $val . $after , $cats , $format );
		}
		
		/*
		 * {_time_}
		 * Due to the nature of the formatting string, the time format is not controllable from here, it is set in
		 * the general options under settings. 
		 */
		if( strpos( $val , 'time' ) === 0 ) {
						
			//Get The Time
			$time = get_the_time();
						
			//And Replace the content
			$format = str_replace( $before . $val . $after , $time , $format );
		}
		
		/*
		 * {_author_]
		 */
		if( strpos( $val , 'author' ) === 0 ) {
						
			//Get The Author
			$author = get_the_author();
									
			//And Replace the content
			$format = str_replace( $before . $val . $after , $author , $format );
		}
		
		/*
		 * {_post_thumbnail,size_}
		 */
		if( strpos( $val , 'post_thumbnail' && current_theme_supports( 'post-thumbnails' ) ) === 0 ) {
			
			$ptarr = explode( ',' , str_replace( ', ' , ',' , $val ) );
			$pt_size = isset( $ptarr[1] ) ? $ptarr[1] : 'post-thumbnail' ;
			
			if( has_post_thumbnail() ) :
			
				//Get The Thumb
				$thumb = get_the_post_thumbnail( $post_id , $pt_size );
							
				//And Replace the content
				$format = str_replace( $before . $val . $after , $thumb , $format );
			
			endif;
		}
		
		/*
		 * {_post-class_}
		 */
		if( strpos( $val , 'post-class') === 0 ) {
			
			//Get The Post_class String.
			$class = get_post_class();
			
			$classstr = 'class="' . join( ' ', get_post_class( ) ) . '"';
			//echo 'class="' . join( ' ', get_post_class( $class, $post_id ) ) . '"';
			$format = str_replace( $before . $val . $after , $classstr , $format );
			
		}
		
		/*
		 * {_term-list,taxonomy,before,sep,after_}
		 */
		if( strpos( $val , 'term-list' ) === 0 ) {
			
			$termarr = explode( ',' , str_replace( ', ' , ',' , $val ) );
			$term_tax = isset( $termarr[1] ) ? $termarr[1] : '' ;
			$term_before = isset( $termarr[2] ) ? $termarr[2] : '' ;
			$term_sep = isset( $termarr[3] ) ? $termarr[3] : '' ;
			$term_after = isset( $termarr[4] ) ? $termarr[4] : '' ;
			
			//Get The Terms
			$terms = get_the_term_list( $post_id , $term_tax, $term_before, $term_sep, $term_after );
						
			//And Replace the content
			$format = str_replace( $before . $val . $after , $terms , $format );
		}
		
		
		/*
		 * Add a hook so Programmers can do their thangg
		 */
		do_action( 'wppf_tags' );
	
	endforeach;
	
	
	return $format;
	
}


/**
 * Eval's The given functionality and displays the required data
 */
function display_wp_post_format ( ) {
	
	global $post ;
	
	$wppf_options = get_option( 'wppf_options' );
	
	$format = get_post_format( $post->ID ) ;

	if ( empty ($format) ) {
		$str = stripslashes ( $wppf_options['post_format_content_default'] ) ;
		echo wppf_safe_format( $str , $post->ID );
	}
	
	if( isset ($wppf_options['post_format_content_' . $format ]) ) {
		$str = stripslashes ( $wppf_options['post_format_content_' . $format ] ) ;
		echo wppf_safe_format( $str , $post->ID );
	}
		
}
?>