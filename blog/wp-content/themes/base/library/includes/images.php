<?php
/*
 * Resize images dynamically using wp built in functions
 * Victor Teixeira with mods by Thad Allender and Sanam Maharjan
 *
 * php 5.2+
 *
 * Example use:
 * 
 * <?php 
 * $thumb = get_post_thumbnail_id(); 
 * $image = gpp_base_resize( $thumb, '', 140, 110, true );
 * ?>
 * <img src="<?php echo $image[url]; ?>" width="<?php echo $image[width]; ?>" height="<?php echo $image[height]; ?>" />
 *
 * @param int $attach_id
 * @param string $img_url
 * @param int $width
 * @param int $height
 * @param bool $crop
 * @return array
 */

// Start modification for gpp_base_image by Thad
function gpp_base_image( $args = array() ) {
	global $post, $imgreturn;

	// Set the default arguments
	$defaults = array(
		'post_id' => $post->ID,
		'custom_key' => false,		
		'width' => false,
		'height' => false,
		'the_post_thumbnail' => true, // image in featured post
		'attachment'=>true, //images in attachment
		'returntype'=>'image' //return image or array			
	);

	// Add filter for the arguments
	$args = apply_filters( 'gpp_base_image_args', $args );

	// Merge the input arguments and the defaults
	$args = wp_parse_args( $args, $defaults );
	
	// Pull them out
	extract( $args );
	//$custom = get_post_custom_values("thumb");
	
	/* If a custom field key (array) is defined, check for images by custom field. */
	$customimg = 0;
	$image = "";
	$img_url = "";
	$attach_id="";
	$imgreturn = 0;	

	if ( $custom_key ) {
		$image = image_by_custom_field( $args );
		if ( $image ) {
			$customimg = 1;
			$img_url = $image['customurl'];
		}		
	}   

	/* If no image found and $the_post_thumbnail is set to true, check for a post image (WP feature). */
	if ( ! $image && $the_post_thumbnail ) {
		$image = image_by_the_post_thumbnail( $args ) ; 
	}  
	/* If no image found and $attachment is set to true, check for an image by attachment. */
	if ( ! $image && $attachment ) {
		$image = image_by_attachment( $args );
	} 	

	/* Allow plugins/theme to override the final output. */

	
	if ( isset( $image['url'] ) ) {
		$img_url = $image['url'];
	} elseif ( isset( $image['id'] ) ) {
		$attach_id = $image['id'];	
	}

	if ( ( $img_url != "" ) || ( $attach_id != "" ) ) {		
		
		if ( $customimg == 1 ) {
			$imgsize = getimagesize( $image['customurl'] );		
			$resizedimg = array( "url"=>$image['customurl'], "width"=>$imgsize['0'], "height"=>$imgsize['1'] );
			if ( $returntype == "array" ) { //if return type is array
				return $resizedimg;
			} else { 		//else return image	
				echo '<img src="' . $resizedimg['url'] . '" width="' . $resizedimg['width'] . '" height="' . $resizedimg['height'] . '" />';
			}
			$customimg = 0;
		} else {
			$resizedimg = gpp_base_resize( $attach_id, $img_url, $width, $height, true );
			if ( $returntype == "array" ) {
				return $resizedimg;
			} else { 	
				if ( isset( $attach_id ) || isset( $img_url ) ) {
					$imgreturn = 1;
					echo '<img src="' . $resizedimg['url'] . '" width="' . $resizedimg['width'] . '" height="' . $resizedimg['height'] . '" />';					
				} else {					
					return;
				}
			}
		}
	}
} // End modification for gpp_base_image by Thad

function image_by_custom_field( $args = array() ) {

	/* If $custom_key is a string, we want to split it by spaces into an array. */
	if ( ! is_array( $args['custom_key'] ) )
		$args['custom_key'] = preg_split( '#\s+#', $args['custom_key'] );

	/* If $custom_key is set, loop through each custom field key, searching for values. */
	if ( isset( $args['custom_key'] ) ) {
		foreach ( $args['custom_key'] as $custom ) {
			$image = get_metadata( 'post', $args['post_id'], $custom, true );
			
			if ( $image )
				break;
		}
	}

	/* If a custom key value has been given for one of the keys, return the image URL. */
	if ( $image )
		return array( 'customurl' => $image );

	return false;
}

function image_by_the_post_thumbnail( $args = array() ) {

	/* Check for a post image ID (set by WP as a custom field). */
	$post_thumbnail_id = get_post_thumbnail_id( $args['post_id'] );

	/* If no post image ID is found, return false. */
	if ( empty( $post_thumbnail_id ) )
		return false;
	return array( 'id' => $post_thumbnail_id );

}


function image_by_attachment( $args = array() ) {
	$attachments = get_children( array( 'post_parent' => $args['post_id'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'DESC', 'orderby' => 'menu_order ID' ) );
	/* If no attachments are found, return false. */
	if ( empty( $attachments ) )
		return false;

	/* Loop through each attachment. Once the $order_of_image (default is '1') is reached, break the loop. */	
	$i = 0;
	foreach( $attachments as $attach ) {
		if( ++$i == 1 ) {
			$attach_id =  $attach->ID;
			break;			
		}
	} 
	/* Return the image URL. */
	 return array( 'id' => $attach_id );
}
	
function gpp_base_resize( $attach_id = null, $img_url = null, $width, $height, $crop = false ) {

	$file_path = "";
	$extension = "";
	$image_src= array();
	$image_src['0'] = "";
	$image_src['1'] = "";
	$image_src['2'] = "";
	$no_ext_path = "";
	$new_img_path = ""; 
	$temp = "";

	// this is an attachment, so we have the ID
	if ( $attach_id ) {	
		$image_src = wp_get_attachment_image_src( $attach_id, 'full' );	
		//print_r($image_src);
		$file_path = get_attached_file( $attach_id );

	// this is not an attachment, let's use the image url
	} elseif ( $img_url ) {
		$file_path = $img_url;		
		$file_path = parse_url( $img_url );
		$file_temp = $temp.$file_path['path'];
		$file_path = $_SERVER["DOCUMENT_ROOT"] . ltrim( $file_path['path'], '' );
		
		// Edit by Thad: Find the correct path to the image uploaded to a multisite blog
		if ( is_multisite() ) {
			global $blog_id;
			if ( isset( $blog_id ) && $blog_id > 0 ) {
				$image_parts = explode('/files/', $file_path);				
				if ( isset( $image_parts[1] ) ) {
					$file_path = WP_CONTENT_DIR .'/blogs.dir/' . $blog_id . '/files/' . $image_parts[1];					 
					$orig_size = getimagesize( $file_path );
				} else {
					$orig_size = getimagesize( $file_path );
				}
			}			
		} else {
			$orig_size = getimagesize( $file_path );
		}
				
		$image_src['0'] = $file_path;
		$image_src['1'] = $orig_size['0'];
		$image_src['2'] = $orig_size['1'];
	}
	if ( ! $width && ! $height ) {
		$width = $image_src['1'];
		$height = $image_src['2'];		
	} elseif ( $width && ! $height ) {
		$height = floor($image_src['2']*($width/$image_src['1']));
	} elseif ( ! $width && $height ) {
		$width = floor($image_src['1']*($height/$image_src['2']));
		//echo $image_src['2']."aaaa";
	}
	//echo $width."X".$height;
	$file_info = pathinfo( $file_path );
	if ( isset( $file_info['extension'] ) )
		$extension = '.'. $file_info['extension'];

	// the image path without the extension
	if ( isset( $file_info['dirname'] ) && isset( $file_info['filename'] ) )
		$no_ext_path = $file_info['dirname'].'/'.$file_info['filename'];

	$cropped_img_path = $no_ext_path.'-'.$width.'x'.$height.$extension;	
	if ( $image_src['1'] > $width ||  $image_src['2'] > $height ) {
		// the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match)
		if ( file_exists( $cropped_img_path ) ) {
			if ( $img_url != "" ) {
				$cropped_img_url = str_replace( basename( $file_temp ), basename( $cropped_img_path ), $file_temp );
			} else {
				$cropped_img_url = str_replace( basename( $image_src['0'] ), basename( $cropped_img_path ), $image_src['0'] );
			} 			
			$gpp_base_image = array (
				'url' => $cropped_img_url,
				'width' => $width,
				'height' => $height
			);				
			return $gpp_base_image;
		}

		if ( $crop == false ) {
			// calculate the size proportionaly
			$proportional_size = wp_constrain_dimensions( $image_src['1'], $image_src['2'], $width, $height );
			$resized_img_path = $no_ext_path.'-'.$proportional_size['0'].'x'.$proportional_size['1'].$extension;			
			// checking if the file already exists
			if ( file_exists( $resized_img_path ) ) {
			//$resized_img_url = str_replace( basename( $image_src[0] ), basename( $resized_img_path ), $image_src[0] );
				if ( $img_url != "" ) {
					$resized_img_url = str_replace( basename( $file_temp ), basename( $resized_img_path ), $file_temp );
				} else {
					$resized_img_url = str_replace( basename( $image_src['0'] ), basename( $resized_img_path ), $image_src['0'] );
				} 
				$gpp_base_image = array (
					'url' => $resized_img_url,
					'width' => $proportional_size['0'],
					'height' => $proportional_size['1']
				);				
				return $gpp_base_image;
			}
		}

		// no cache files - let's finally resize it
		$new_img_path = image_resize( $file_path, $width, $height, $crop );
		$new_img_size = getimagesize( $new_img_path );
		//$new_img = str_replace( basename( $image_src[0] ), basename( $new_img_path ), $image_src[0] );
		if( $img_url != "" ) {
			$new_img = str_replace( basename( $file_temp ), basename( $new_img_path ), $file_temp );
		} else {
			$new_img = str_replace( basename( $image_src['0'] ), basename( $new_img_path ), $image_src['0'] );
		} 
		
		// resized output
		$gpp_base_image = array (
			'url' => $new_img,
			'width' => $new_img_size['0'],
			'height' => $new_img_size['1']
		);		
		return $gpp_base_image;
	}
	if ( $img_url != "" ) {
		$image_src['0'] = str_replace( basename( $file_temp ), basename( $image_src['0'] ), $file_temp );
	} 
	// default output - without resizing
	$gpp_base_image = array (
						'url' => $image_src['0'],
						'width' => $image_src['1'],
						'height' => $image_src['2']
					);	
	return $gpp_base_image;	
}
?>