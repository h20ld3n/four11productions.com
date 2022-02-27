<?php

/**
 * Immersion helper functions and definitions
 * @subpackage Immersion
 *
 * @since Immersion 1.0
 */

/**
 * This function checks the thumbnailorientation theme option
 *
 * @since 1.0
 */

function gpp_post_thumbnail() {

    global $gpp, $post_id;

    if ( has_post_thumbnail() ) {

        if ( isset( $gpp[ 'immersion_orientation' ] ) )
            $orientation = $gpp[ 'immersion_orientation' ];

        $thumb = get_post_thumbnail_id($post_id);
        if ( isset( $orientation ) && ( $orientation == "portrait" ) )
            $thumb = gpp_image_resize( $thumb, '', 700, 1050, true );
        elseif ( isset( $orientation ) && ( $orientation == "square" ) )
            $thumb = gpp_image_resize( $thumb, '', 700, 700, true );
        elseif ( isset( $orientation ) && ( $orientation == "landscape" ) )
            $thumb = gpp_image_resize( $thumb, '', 700, 467, true );
        else
            $thumb = gpp_image_resize( $thumb, '', 700, 467, true );

        print '<img src="'.$thumb[url].'" width="'.$thumb[width].'" height="'.$thumb[height].'" alt="" />';

    }

}

/**
 * This function checks the sidebar theme option
 *
 * @since 1.0
 */

function gpp_check_sidebar() {

	global $gpp, $showsidebar, $sidebar;
	if ( isset( $gpp[ 'immersion_sidebar' ] ) )
		$sidebar = $gpp[ 'immersion_sidebar' ];
	if ( $sidebar == "true" || ( $gpp === FALSE ) ) { echo "sidebar"; } else { echo "nosidebar"; }
}

/**
 * Adds custom classes to the array of post classes.
 */
function gpp_post_class($classes) {

    global $gpp;

    if ( isset( $gpp[ 'immersion_columns' ] ) )
        $columns = $gpp[ 'immersion_columns' ];

    if ( isset($columns) && $columns == "2" && !is_singular() )
        $classes[] = "two-columns";
    elseif ( isset($columns) && $columns == "3" && !is_singular() )
        $classes[] = "three-columns";
    else $classes[] = "one-column";

    return $classes;

}

add_filter('post_class','gpp_post_class');


/*
 * Resize images dynamically using wp built in functions
 * http://core.trac.wordpress.org/ticket/15311
 *
 * php 5.2+
 *
 * Example Use
 *
 * <?php
 * $thumb = get_post_thumbnail_id();
 * $image = gpp_image_resize( $thumb, '', 140, 110, true );
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
if ( !function_exists( 'gpp_image_resize') ) {
    function gpp_image_resize( $attach_id = null, $img_url = null, $width, $height, $crop = false ) {

        // this is an attachment, so we have the ID
        if ( $attach_id ) {

            $image_src = wp_get_attachment_image_src( $attach_id, 'full' );
            $file_path = get_attached_file( $attach_id );

        // this is not an attachment, let's use the image url
        } else if ( $img_url ) {

            $file_path = parse_url( $img_url );
            $file_path = $_SERVER['DOCUMENT_ROOT'] . $file_path['path'];

            // Look for Multisite Path
            if(file_exists($file_path) === false){
                global $blog_id;
                $file_path = parse_url( $img_url );
                if (preg_match("/files/", $file_path['path'])) {
                    $path = explode('/',$file_path['path']);
                    foreach($path as $k=>$v){
                        if($v == 'files'){
                            $path[$k-1] = 'wp-content/blogs.dir/'.$blog_id;
                        }
                    }
                    $path = implode('/',$path);
                }
                $file_path = $_SERVER['DOCUMENT_ROOT'].$path;
            }
            //$file_path = ltrim( $file_path['path'], '/' );
            //$file_path = rtrim( ABSPATH, '/' ).$file_path['path'];

            $orig_size = getimagesize( $file_path );

            $image_src[0] = $img_url;
            $image_src[1] = $orig_size[0];
            $image_src[2] = $orig_size[1];
        }

        $file_info = pathinfo( $file_path );

        // check if file exists
        $base_file = $file_info['dirname'].'/'.$file_info['filename'].'.'.$file_info['extension'];
        if ( !file_exists($base_file) )
         return;

        $extension = '.'. $file_info['extension'];

        // the image path without the extension
        $no_ext_path = $file_info['dirname'].'/'.$file_info['filename'];

        $cropped_img_path = $no_ext_path.'-'.$width.'x'.$height.$extension;

        // checking if the file size is larger than the target size
        // if it is smaller or the same size, stop right here and return
        if ( $image_src[1] > $width ) {

            // the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match)
            if ( file_exists( $cropped_img_path ) ) {

                $cropped_img_url = str_replace( basename( $image_src[0] ), basename( $cropped_img_path ), $image_src[0] );

                $gpp_image = array (
                    'url' => $cropped_img_url,
                    'width' => $width,
                    'height' => $height
                );

                return $gpp_image;
            }

            // $crop = false or no height set
            if ( $crop == false OR !$height ) {

                // calculate the size proportionaly
                $proportional_size = wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height );
                $resized_img_path = $no_ext_path.'-'.$proportional_size[0].'x'.$proportional_size[1].$extension;

                // checking if the file already exists
                if ( file_exists( $resized_img_path ) ) {

                    $resized_img_url = str_replace( basename( $image_src[0] ), basename( $resized_img_path ), $image_src[0] );

                    $gpp_image = array (
                        'url' => $resized_img_url,
                        'width' => $proportional_size[0],
                        'height' => $proportional_size[1]
                    );

                    return $gpp_image;
                }
            }

            // check if image width is smaller than set width
            $img_size = getimagesize( $file_path );
            if ( $img_size[0] <= $width ) $width = $img_size[0];

            // Check if GD Library installed
            if (!function_exists ('imagecreatetruecolor')) {
                echo 'GD Library Error: imagecreatetruecolor does not exist - please contact your webhost and ask them to install the GD library';
                return;
            }

            // no cache files - let's finally resize it
            $new_img_path = image_resize( $file_path, $width, $height, $crop );
            $new_img_size = getimagesize( $new_img_path );
            $new_img = str_replace( basename( $image_src[0] ), basename( $new_img_path ), $image_src[0] );

            // resized output
            $gpp_image = array (
                'url' => $new_img,
                'width' => $new_img_size[0],
                'height' => $new_img_size[1]
            );

            return $gpp_image;
        }

        // default output - without resizing
        $gpp_image = array (
            'url' => $image_src[0],
            'width' => $width,
            'height' => $height
        );

        return $gpp_image;
    }
}