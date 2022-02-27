<?php 

// Custom fields for WP write panel
// This code is protected under Creative Commons License: http://creativecommons.org/licenses/by-nc-nd/3.0/

function gppthemes_metabox_create() {
    global $post;
    $gpp_base_metaboxes = get_option( 'gpp_base_custom_template' );     
    $output = '';
    $output .= '<table class="gpp_base_metaboxes_table">'."\n";
    foreach ( $gpp_base_metaboxes as $gpp_base_id => $gpp_base_metabox ) {
		if (        
				$gpp_base_metabox['type'] == 'text' 
		OR      $gpp_base_metabox['type'] == 'select' 
		OR      $gpp_base_metabox['type'] == 'checkbox' 
		OR      $gpp_base_metabox['type'] == 'textarea'
		OR      $gpp_base_metabox['type'] == 'radio'
		)
				$gpp_base_metaboxvalue = get_post_meta( $post->ID, $gpp_base_metabox["name"], true );
				
				if ( $gpp_base_metaboxvalue == "" || ! isset( $gpp_base_metaboxvalue ) ) {
					$gpp_base_metaboxvalue = $gpp_base_metabox['std'];
				}
				if ( $gpp_base_metabox['type'] == 'text' ) {
				
					$output .= "\t".'<tr>';
					$output .= "\t\t".'<th class="gpp_base_metabox_names"><label for="'.$gpp_base_id.'">'.$gpp_base_metabox[ 'label' ].'</label></th>'."\n";
					$output .= "\t\t".'<td><input class="gpp_base_input_text" type="'.$gpp_base_metabox[ 'type' ].'" value="'.$gpp_base_metaboxvalue.'" name="gppthemes_'.$gpp_base_metabox[ "name" ].'" id="'.$gpp_base_id.'"/>';
					$output .= '<span class="gpp_base_metabox_desc">'.$gpp_base_metabox[ 'desc' ].'</span></td>'."\n";
					$output .= "\t".'<td></td></tr>'."\n";  
								  
				} elseif ( $gpp_base_metabox['type'] == 'textarea' ) {
				
					$output .= "\t".'<tr>';
					$output .= "\t\t".'<th class="gpp_base_metabox_names"><label for="'.$gpp_base_metabox.'">'.$gpp_base_metabox[ 'label' ].'</label></th>'."\n";
					$output .= "\t\t".'<td><textarea class="gpp_base_input_textarea" name="gppthemes_'.$gpp_base_metabox[ "name" ].'" id="'.$gpp_base_id.'">' . $gpp_base_metaboxvalue . '</textarea>';
					$output .= '<span class="gpp_base_metabox_desc">'.$gpp_base_metabox[ 'desc' ].'</span></td>'."\n";
					$output .= "\t".'<td></td></tr>'."\n";  
								  
				} elseif ( $gpp_base_metabox['type'] == 'select' ) {
						   
					$output .= "\t".'<tr>';
					$output .= "\t\t".'<th class="gpp_base_metabox_names"><label for="'.$gpp_base_id.'">'.$gpp_base_metabox[ 'label' ].'</label></th>'."\n";
					$output .= "\t\t".'<td><select class="gpp_base_input_select" id="'.$gpp_base_id.'" name="gppthemes_'. $gpp_base_metabox[ "name" ] .'">';
					$output .= '<option value="">Select to return to default</option>';
					
					$array = $gpp_base_metabox['options'];
					
					if ( $array ) {
					
						foreach ( $array as $id => $option ) {
							$selected = '';						   
														   
							if ( $gpp_base_metabox[ 'default' ] == $option && empty( $gpp_base_metaboxvalue ) ) { $selected = 'selected="selected"'; } else { $selected = ''; }
							
							if ( $gpp_base_metaboxvalue == $option ) { $selected = 'selected="selected"'; } else { $selected = ''; }  
							
							$output .= '<option value="'. $option .'" '. $selected .'>' . $option .'</option>';
						}
					}
					
					$output .= '</select><span class="gpp_base_metabox_desc">'.$gpp_base_metabox['desc'].'</span></td></td><td></td>'."\n";
					$output .= "\t".'</tr>'."\n";
				} elseif ( $gpp_base_metabox['type'] == 'checkbox' ) {
				
					if( $gpp_base_metaboxvalue == 'true' ) { $checked = ' checked="checked"'; } else { $checked = ''; }

					$output .= "\t".'<tr>';
					$output .= "\t\t".'<th class="gpp_base_metabox_names"><label for="'.$gpp_base_id.'">'.$gpp_base_metabox['label'].'</label></th>'."\n";
					$output .= "\t\t".'<td><input type="checkbox" '.$checked.' class="gpp_base_input_checkbox" value="true"  id="'.$gpp_base_id.'" name="gppthemes_'. $gpp_base_metabox["name"] .'" />';
					$output .= '<span class="gpp_base_metabox_desc" style="display:inline">'.$gpp_base_metabox['desc'].'</span></td></td><td></td>'."\n";
					$output .= "\t".'</tr>'."\n";
				} elseif ( $gpp_base_metabox['type'] == 'radio' ) {
				
					$array = $gpp_base_metabox['options'];
				
				if ( $array ) {
				
					$output .= "\t".'<tr>';
					$output .= "\t\t".'<th class="gpp_base_metabox_names"><label for="'.$gpp_base_id.'">'.$gpp_base_metabox['label'].'</label></th>'."\n";
					$output .= "\t\t".'<td>';
				
					foreach ( $array as $id => $option ) {
								  
						if ( $gpp_base_metaboxvalue == $option ) { $checked = ' checked'; } else { $checked = ''; }

							$output .= '<input type="radio" '.$checked.' value="' . $id . '" class="gpp_base_input_radio"  id="'.$gpp_base_id.'" name="gppthemes_'. $gpp_base_metabox[ "name" ] .'" />';
							$output .= '<span class="gpp_base_input_radio_desc" style="display:inline">'. $option .'</span><div class="gpp_base_spacer"></div>';
						}
						$output .=  '</td></td><td></td>'."\n";
						$output .= "\t".'</tr>'."\n";    
					 }
				} elseif ( $gpp_base_metabox['type'] == 'upload' ) {
				
					$output .= "\t".'<tr>';
					$output .= "\t\t".'<th class="gpp_base_metabox_names"><label for="'.$gpp_base_id.'">'.$gpp_base_metabox['label'].'</label></th>'."\n";
					$output .= "\t\t".'<td class="gpp_base_metabox_fields">'. gppthemes_uploader_custom_fields( $post->ID, $gpp_base_metabox["name"], $gpp_base_metabox["default"],$gpp_base_metabox["desc"] );
					$output .= '</td>'."\n";
					$output .= "\t".'</tr>'."\n";
					
				}
        }
    
    $output .= '</table>'."\n\n";
    echo $output;
}

function gppthemes_uploader_custom_fields( $pID, $id, $std, $desc ) {

    // Start Uploader
    $upload = get_post_meta( $pID, $id, true );
    $uploader .= '<input class="gpp_base_input_text" name="'.$id.'" type="text" value="'.$upload.'" />';
    $uploader .= '<div class="clear"></div>'."\n";
    $uploader .= '<input type="file" name="attachement_'.$id.'" />';
    $uploader .= '<input type="submit" class="button button-highlighted" value="Save" name="save"/>';
    $uploader .= '<span class="gpp_base_metabox_desc">'.$desc.'</span></td>'."\n".'<td class="gpp_base_metabox_image"><a href="'. $upload .'"><img src="'.get_template_directory_uri().'/includes/timthumb.php?src='.$upload.'&w=150&h=80&zc=1" alt="" /></a>';

	return $uploader;
}

function gppthemes_metabox_handle() {   
    
    global $globals;
    $gpp_base_metaboxes = get_option( 'gpp_base_custom_template' );     
    $pID = $_POST['post_ID'];
    $upload_tracking = array();
    
    if ( $_POST['action'] == 'editpost' ) {                                   
        foreach ( $gpp_base_metaboxes as $gpp_base_metabox ) { // On Save.. this gets looped in the header response and saves the values submitted
			if ( $gpp_base_metabox['type'] == 'text' OR $gpp_base_metabox['type'] == 'select' OR $gpp_base_metabox['type'] == 'checkbox' OR $gpp_base_metabox['type'] == 'textarea' ) { // Normal Type Things...
					$var = "gppthemes_".$gpp_base_metabox["name"];
					if ( isset( $_POST[$var] ) ) {            
						if ( get_post_meta( $pID, $gpp_base_metabox["name"] ) == "" )
							add_post_meta( $pID, $gpp_base_metabox["name"], $_POST[ $var ], true );
						elseif ( $_POST[$var] != get_post_meta( $pID, $gpp_base_metabox["name"], true ) )
							update_post_meta( $pID, $gpp_base_metabox["name"], $_POST[$var] );
						elseif ( $_POST[$var] == "" ) {
						   delete_post_meta( $pID, $gpp_base_metabox["name"], get_post_meta( $pID, $gpp_base_metabox["name"], true ) );
						}
					} elseif ( ! isset( $_POST[$var] ) && $gpp_base_metabox['type'] == 'checkbox' ) { 
						update_post_meta($pID, $gpp_base_metabox["name"], 'false'); 
					} else {
						delete_post_meta( $pID, $gpp_base_metabox[ "name" ], get_post_meta( $pID, $gpp_base_metabox[ "name" ], true ) ); // Deletes check boxes OR no $_POST
					}    
			} elseif ( $gpp_base_metabox['type'] == 'upload' ) { // So, the upload inputs will do this rather
				
				$id = $gpp_base_metabox['name'];
				$override['action'] = 'editpost';
				if ( ! empty( $_FILES['attachement_' . $id]['name'] ) ) { //New upload          
					   $uploaded_file = wp_handle_upload( $_FILES['attachement_' . $id], $override ); 
					   $uploaded_file['option_name']  = $gpp_base_metabox['label'];
					   $upload_tracking[] = $uploaded_file;
					   update_post_meta( $pID, $id, $uploaded_file['url'] );
				} elseif ( empty( $_FILES['attachement_' . $id]['name'] ) && isset( $_POST[$id] ) ) {
					update_post_meta( $pID, $id, $_POST[$id] ); 
				} elseif ( $_POST[$id] == '' ) {
					delete_post_meta( $pID, $id, get_post_meta( $pID, $id, true ) );
				}
			}
		   // Error Tracking - File upload was not an Image
		   update_option( 'gpp_base_custom_upload_tracking', $upload_tracking );
		}
	}
}

function gppthemes_metabox_add() {
    if ( function_exists( 'add_meta_box' ) ) {
        add_meta_box( 'gppthemes-settings', get_option( 'gpp_base_themename' ) . ' Custom Settings', 'gppthemes_metabox_create', 'post', 'normal' );
        add_meta_box( 'gppthemes-settings', get_option( 'gpp_base_themename' ) . ' Custom Settings', 'gppthemes_metabox_create', 'page', 'normal' );
    }
}

function gppthemes_metabox_header() {
?>
	<script type="text/javascript">

		jQuery(document).ready( function() {
			jQuery('form#post').attr('enctype','multipart/form-data');
			jQuery('form#post').attr('encoding','multipart/form-data');
			jQuery('.gpp_base_metaboxes_table th:last, .gpp_base_metaboxes_table td:last').css('border','0');
			var val = jQuery('input#title').attr('value');
			if ( val == '' ) { 
				jQuery('.gpp_base_metabox_fields .button-highlighted').after("<em class='gpp_base_red_note'>Please add a Title before uploading a file</em>");
			};
			<?php //Errors
			$error_occurred = false;
			$upload_tracking = get_option( 'gpp_base_custom_upload_tracking' );
			if ( ! empty( $upload_tracking ) ) {
				$output = '<div style="clear:both;height:20px;"></div><div class="errors"><ul>' . "\n";
				$error_shown == false;
				foreach( $upload_tracking as $array ) {
					 if ( array_key_exists( 'error', $array ) ) {
							$error_occurred = true;
							?>
							jQuery('form#post').before('<div class="updated fade"><p>gppThemes Upload Error: <strong><?php echo $array['option_name'] ?></strong> - <?php echo $array['error'] ?></p></div>');
							<?php
					}
				}
			}
			delete_option( 'gpp_base_upload_custom_errors' );
			?>
		});

	</script>
	<style type="text/css">
		.gpp_base_input_text { margin:0 0 10px 0; background:#f4f4f4; color:#444; width:80%; font-size:11px; padding: 5px;}
		.gpp_base_input_select { margin:0 0 10px 0; background:#f4f4f4; color:#444; width:60%; font-size:11px; padding: 5px;}
		.gpp_base_input_checkbox { margin:0 10px 0 0; }
		.gpp_base_input_radio { margin:0 10px 0 0; }
		.gpp_base_input_radio_desc { font-size: 12px; color: #666 ; }
		.gpp_base_spacer { display: block; height:5px}
		.gpp_base_metabox_desc { font-size:10px; color:#aaa; display:block}
		.gpp_base_metaboxes_table{ border-collapse:collapse; width:100%}
		.gpp_base_metaboxes_table tr:hover th,
		.gpp_base_metaboxes_table tr:hover td { background:#f8f8f8}
		.gpp_base_metaboxes_table th,
		.gpp_base_metaboxes_table td{ border-bottom:1px solid #ddd; padding:10px 10px;text-align: left; vertical-align:top}
		.gpp_base_metabox_names { width:20%}
		.gpp_base_metabox_fields { width:70%}
		.gpp_base_metabox_image { text-align: right;}
		.gpp_base_red_note { margin-left: 5px; color: #c77; font-size: 10px;}
		.gpp_base_input_textarea { width:80%; height:120px;margin:0 0 10px 0; background:#f0f0f0; color:#444;font-size:11px;padding: 5px;}
	</style>
<?php
}
add_action( 'edit_post', 'gppthemes_metabox_handle' );
add_action( 'admin_menu', 'gppthemes_metabox_add' ); // Triggers gppthemes_metabox_create
add_action( 'admin_head', 'gppthemes_metabox_header' );
?>