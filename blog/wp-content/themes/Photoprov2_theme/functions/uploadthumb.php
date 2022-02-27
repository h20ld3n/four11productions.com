<?php /*
Plugin Name: Simple Post Thumbnails
Plugin URI: http://www.press75.com/the-simple-post-thumbnails-wordpress-plugin/
Description: Easily add thumbnail images to your posts. Brought to you by <a href="http://www.press75.com" title="Press75.com">Press75.com</a>. 
Version: 1.0
Author: James Lao
Author URI: http://jameslao.com/
*/

define("P75_THUMB_DIR", ABSPATH . "wp-content/thumbnails/"); // thumbnail directory
define("P75_THUMB_WEB", get_bloginfo('siteurl') . '/wp-content/thumbnails/');

if ( !defined("P75_THUMB_W") )
	define("P75_THUMB_W", 300); // thumbnail width
if ( !defined("P75_THUMB_H") )
	define("P75_THUMB_H", 200); // thumbnail height

/**
 * Thumbnail directory check.
 */
if( !is_dir( P75_THUMB_DIR ) ) {
	if( !mkdir( P75_THUMB_DIR ) )
	{
		function p75Warning()
		{
			echo '<div class="updated fade"><p>Could not create thumbnail directory. Please create a folder named &quot;thumbnails&quot; in the &quot;wp-content&quot; folder of your WordPress installation.</p></div>';
		}
		add_action('admin_notices', 'p75Warning');
	}
}


/**
 * Post admin hooks
 */
add_action('admin_menu', "p75_thumbnailAdminInit");
add_action('save_post', 'p75_saveThumb');

function p75_thumbnailAdminInit() {
	if( function_exists("add_meta_box") ) {
		add_meta_box("p75-thumbnail-posting", "(OLD) Featured Image", "p75_thumbnailPosting", "post", "advanced");
	}
}

/**
 * Code for the meta box.
 */
function p75_thumbnailPosting() {
	global $post_ID;
	$thumbURL = get_post_meta($post_ID, '_bigimg', true);
?>
	<script type="text/javascript">
		document.getElementById("post").setAttribute("enctype","multipart/form-data");
	</script>

	<table>
	
		<tr>
			<td><p style="margin:0 0 20px -1px;">Notice: Please use the new way to upload image.</p></td>
		</tr>	
	
		<tr>
			<td>
				<p style="margin:0 0 10px -1px;"><label for="p75-thumb-url-upload">Upload via URL, or Select Image (Below):</label><br />
				<input style="width: 300px; margin-top:5px;" id="p75-thumb-url-upload" name="p75-thumb-url-upload" type="text" /></p>
			</td>
		</tr>
		<tr>
			<td style="background: url(<?php echo get_bloginfo('template_directory'); ?>/images/browse.jpg) top left no-repeat;">
				<input style="position: relative; text-align: right; -moz-opacity: 0; filter:alpha(opacity: 0); opacity: 0; z-index: 2; width: 102px; height: 23px;" id="p75-video-thumb" type="file" name="p75-video-thumb" />
			</td>
		</tr>
		<tr>
			<td>
				<?php if ($thumbURL) : ?>
					<div style="padding: 3px; border: 1px solid #ccc; float: left; margin: 10px 0 0 0;">
						<img style="max-width: 300px" src="<?php echo $thumbURL . "?nocache=" . time(); ?>" alt="Thumbnail Preview" />
					</div>
				<?php else : ?>
					<div style="margin: 10px 0 0 0; border: 1px solid #CCC; width: <?php echo P75_THUMB_W; ?>px; height: <?php echo P75_THUMB_H; ?>px; line-height: <?php echo P75_THUMB_H; ?>px; text-align: center;">
					No Image Selected
					</div>
				<?php endif; ?>
			</td>
		</tr>
	</table>
	<p style="margin:10px 0 0 0;"><input id="p75-thumb-delete" type="checkbox" name="p75-thumb-delete"> <label for="p75-thumb-delete">Delete thumbnail</label></p>
    
	<p style="margin:10px 0 0 0;"><input id="publish" class="button-primary" type="submit" value="Update Post" accesskey="p" tabindex="5" name="save"/></p>  
<?php
}

/**
 * Saves the thumbnail image as a meta field associated
 * with the current post. Runs when a post is saved.
 *
 * @param The post ID
 */
function p75_saveThumb( $postID ) {
	global $wpdb;

	// Get the correct post ID if revision.
	if ( $wpdb->get_var("SELECT post_type FROM $wpdb->posts WHERE ID=$postID")=='revision')
		$postID = $wpdb->get_var("SELECT post_parent FROM $wpdb->posts WHERE ID=$postID");

	if ( $_POST['p75-thumb-delete'] ) {
		delete_post_meta($postID, '_bigimg');
		@unlink(P75_THUMB_DIR . $postID . ".png");
	} else {
   
		// Create file name.
		$thumbFileName = $postID . ".png";
   
		// Location of thumbnail on server.
		$loc = P75_THUMB_DIR . $thumbFileName;
   
		// URL to the thumbnail.
		$thumbURL = get_bloginfo('siteurl') . "/wp-content/thumbnails/" . $thumbFileName;
		
		$thumbUploaded = false;
   
		if ( $_POST['p75-thumb-url-upload'] ) {
			// Try just using fopen to download the image.
			if( ini_get('allow_url_fopen') ) {
				copy($_POST['p75-thumb-url-upload'], $loc);
				$thumbUploaded = true;
			} else
			
			// If fopen doesn't work, try cURL.
			if( function_exists('curl_init') ) {
				$ch = curl_init($_POST['p75-thumb-url-upload']);
				$fp = fopen($loc, "wb");
   
				$options = array(CURLOPT_FILE => $fp,
					CURLOPT_HEADER => 0,
					CURLOPT_FOLLOWLOCATION => 1,
					CURLOPT_TIMEOUT => 60);
				curl_setopt_array($ch, $options);
				
				curl_exec($ch);
				curl_close($ch);
   
				fclose($fp);
				$thumbUploaded = true;
			}
		} else
   
		// Attempt to move the uploaded thumbnail to the thumbnail directory.
		if ( !empty($_FILES['p75-video-thumb']['tmp_name']) && move_uploaded_file($_FILES['p75-video-thumb']['tmp_name'], $loc) ) {
			$thumbUploaded = true;
		}
		
		if ( $thumbUploaded ) {
			
   
			if( !update_post_meta($postID, '_bigimg', $thumbURL ) )
				add_post_meta($postID, '_bigimg', $thumbURL );
		}

	}
}

function p75CreateThumbnail($loc) {
	$imageInfo = getimagesize($loc);
	$width = $imageInfo[0];
	$height = $imageInfo[1];

	// Create image resource from uploaded file.
	switch($imageInfo['mime']) {
	case 'image/jpeg':
	case 'image/jpg':
		$original = imagecreatefromjpeg($loc);
		break;
	case 'image/png':
		$original = imagecreatefrompng($loc);
		break;
	case 'image/gif':
		$original = imagecreatefromgif($loc);
		break;
	}

	// Create new image with correct width and height.
	$thumb = imagecreatetruecolor(P75_THUMB_W, P75_THUMB_H);

	// Do scaling and cropping depending on aspect ratio.
	if( ($width/$height) <= (P75_THUMB_W/P75_THUMB_H) ) {
		$newHeight = ($width*P75_THUMB_H)/P75_THUMB_W;
		imagecopyresampled($thumb, $original, 0, 0, 0, ($height-$newHeight)/2, P75_THUMB_W, P75_THUMB_H, $width, $newHeight);
	} else {
		$newWidth = ($height*P75_THUMB_W)/P75_THUMB_H;
		imagecopyresampled($thumb, $original, 0, 0, (($width-$newWidth)/2), 0, P75_THUMB_W, P75_THUMB_H, $newWidth, $height);
	}

	// Create image.
	imagepng($thumb, $loc);
}

/**
 * Gets the thumbnail.
 *
 * @param The post ID of the thumbnail
 * @return The URL of the thumbnail
 */
function Getbig($postID) {
	if( $thumbnail = get_post_meta($postID, 'thumbnail', true) ) return $thumbnail;
	
	return get_post_meta($postID, '_bigimg', true);
}

?>