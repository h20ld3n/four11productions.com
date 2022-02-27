<?php




// meta box add/edit page

$new_meta_boxes = 
array(
"camera" => array(
"name" => "camera",
"type" => "input",
"std" => "",
"title" => "Camera",
"description" => ""),

"shutter" => array(
"name" => "shutter",
"type" => "input",
"std" => "",
"title" => "Shutter value",
"description" => ""),

"focal" => array(
"name" => "focal",
"type" => "input",
"std" => "",
"title" => "Focal",
"description" => ""),

"aperture" => array(
"name" => "aperture",
"type" => "input",
"std" => "",
"title" => "Aperture",
"description" => ""),

"iso" => array(
"name" => "iso",
"type" => "input",
"std" => "",
"title" => "ISO",
"description" => "")

);


function new_meta_boxes() {
global $post, $new_meta_boxes;
	
	echo '<table class="form-table">
<tbody>';
	foreach($new_meta_boxes as $meta_box) {
		
		echo'<tr valign="top"><input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
		
		echo '<td class="first">'.$meta_box['title'].'</td>';
		
		if( $meta_box['type'] == "input" ) { 
		
			$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);
		
			if($meta_box_value == "")
				$meta_box_value = $meta_box['std'];
		
			echo'<td><input type="text" name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" size="30" />';
			
		} elseif ( $meta_box['type'] == "select" ) {
			
			echo'<select name="'.$meta_box['name'].'_value">';
			
			foreach ($meta_box['options'] as $option) {
                
				echo'<option';
				if ( get_post_meta($post->ID, $meta_box['name'].'_value', true) == $option ) { 
					echo ' selected="selected"'; 
				} elseif ( $option == $meta_box['std'] ) { 
					echo ' selected="selected"'; 
				} 
				echo'>'. $option .'</option>';
			
			}
			
			echo'</select>';
			
		}
		
		echo'<p><label for="'.$meta_box['name'].'_value">'.$meta_box['description'].'</label></p></td>';
	}

echo '</tr>
</tbody>
</table>';

}


function create_meta_box() {
global $theme_name, $new_meta_boxes;
	if (function_exists('add_meta_box') ) {
	add_meta_box( 'new-meta-boxes', 'Picture Info', 'new_meta_boxes', 'post', 'normal', 'high' );
	}
}

function save_postdata( $post_id ) {
	global $post, $new_meta_boxes;  
		foreach($new_meta_boxes as $meta_box) {  
		
		// Verify  
		if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {  
		return $post_id;  
		}  
	
	if ( 'page' == $_POST['post_type'] ) {  
	if ( !current_user_can( 'edit_page', $post_id ))  
	return $post_id;  
	} else {  
	if ( !current_user_can( 'edit_post', $post_id ))  
	return $post_id;  
	}  
	
	$data = $_POST[$meta_box['name'].'_value'];  
	
	if(get_post_meta($post_id, $meta_box['name'].'_value') == "")  
	add_post_meta($post_id, $meta_box['name'].'_value', $data, true);  
	elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))  
	update_post_meta($post_id, $meta_box['name'].'_value', $data);  
	elseif($data == "")  
	delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));  
	}
}

add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_postdata');


?>