<?php
$headingarray = array();
// Options panel stylesheet
function gpp_base_admin_head() {
	if ( isset( $_GET['page'] ) ) {
		if ( $_GET['page'] == "gppthemes" ) {
			echo '<link rel="stylesheet" type="text/css" href="'.get_template_directory_uri().'/library/functions/css/admin-style.css" media="screen" />';
		}
	}
}

// gppThemes Admin interface_exists
function gpp_base_add_admin_menu() {
    global $query_string;
    $options =  get_option( 'gpp_base_template' );
    $themename =  get_option( 'gpp_base_themename' );         
    $shortname =  get_option( 'gpp_base_shortname' ); 

    if ( isset( $_REQUEST['page'] ) && $_REQUEST['page'] == 'gppthemes' ) {
  		if ( isset( $_REQUEST['gpp_base_save'] ) && 'reset' == $_REQUEST['gpp_base_save'] ) {
            global $wpdb;
            $query = "DELETE FROM $wpdb->options WHERE option_name LIKE 'gpp\_base%' AND option_name != 'gpp_base_user_roles'";
            $wpdb->query($query);
            header( "Location: admin.php?page=gppthemes&reset=true" );
            die;
        }
    }
	
    add_theme_page( 'gppthemes', 'Theme Options', 'read', 'gppthemes', 'gppthemes_page' );
	
}

function gppthemes_page(){ 
	global $page, $themename;
    $options =  get_option( 'gpp_base_template' );      
    $shortname =  get_option( 'gpp_base_shortname' );
    $instructionsurl = get_option( 'gpp_base_instructions' );
    $supporturl =  get_option( 'gpp_base_support' );      
    
    //Version in Backend Head
    $theme_data = get_theme_data( STYLESHEETPATH . '/style.css' );
    $local_version = $theme_data[ 'Version' ];
    $update_message = '<span class="update">v.'. $local_version .'</span>';
?>
<a name="top"></a>		
<div class="wrap" id="gpp_base_options">
	<div class="happy hidden"><?php echo $themename; ?>'s Options updated!</div>
	<div class="warning hidden"><?php echo $themename; ?>'s Options reset!</div>
    <form id="adminform"  method="post"  action="" enctype="multipart/form-data">
        <h2><?php echo $themename; ?> Options <?php echo $update_message; ?></h2>
        <div class="info">
			<strong>Need help?</strong> Read the <a href="<?php echo $instructionsurl; ?>">Instructions</a> or visit <a href="<?php echo $supporturl; ?>" target="blank">Support</a>
		</div>
	
		<div id="theme_options">		
			<div id="menublock">		
				<div id="menusub">   
					<?php  echo gppthemes_menublock( $options, $page ); //Menus called here ?>
				</div>	
			</div> 
			<div class="clear"></div>         

			<div id="optionblock">
    	    	<?php echo gppthemes_machine( $options, $page);  //Options called here  ?>
			</div>
			<div style="clear:both;"></div>	
        	<?php // wp_nonce_field('reset_options'); echo "\n"; ?>
        	<p class="submit submit-footer">
        	    <input class="gppsave button-primary" name="save" type="submit" value="Save All Changes" />            
        	</p>
		</div><!-- end theme_options div -->
    </form>       
    <form action="<?php echo esc_html( $_SERVER['REQUEST_URI'] ); ?>" method="post">
        <p class="submit submit-footer submit-footer-reset">
        <input name="reset" type="submit" value="Reset Options" class="reset-button" onclick="return confirm('Click OK to reset. Any settings will be lost!');" />
        <input type="hidden" name="gpp_base_save" value="reset" />
        </p>
    </form>	
	<div style="clear:both;"></div> 
</div><!--wrap-->

<?php
}

function gppthemes_machine( $options, $page ) {
	global $page,$appsdirectorys,$arraycount,$headingarray;		
	$gpp = get_option( 'gpp_base_options' );	
	$gpp_settings = get_option( 'gpp_base_settings' );	
	if(isset($gpp_settings) && $gpp_settings != ""){
		$importgpp = unserialize(base64_decode($gpp_settings));
		//update_option('gpp_base_options',$importgpp);
		if(!isset($gpp) || $gpp == ""){ $gpp = array();}
		$newgpp = array_merge($gpp,$importgpp);
		update_option('gpp_base_options',$newgpp);		
	}  
	$gpp = get_option('gpp_base_options');
    $counter = 0;
    $output = "";
	$saved_std = "";
    foreach ( $options as $value ) {        

        	$counter++;
        	$val = '';
        	//Start Heading
        	if ( $value['type'] != "heading" ) {
        	    $output .= '<div class="option option-'. $value['type'] .'">'."\n".'<div class="option-inner">'."\n";
        	    if ( $value['type'] != "help" ) {
        	    	$output .= '<label class="titledesc">'. $value['name'] .'</label>'."\n";
        	    	$output .= '<div class="formcontainer">'."\n".'<div class="forminp">'."\n";
        	    }
        	} 
        	//End Heading
        	$select_value = '';                                   
        	switch ( $value['type'] ) {
        		case 'text':				
        	    if ( ! isset( $gpp[ $value['id'] ] ) ) { $val = $value['std']; } else { $val = stripslashes( stripslashes( $gpp[ $value['id'] ] ) ); }            
            	$textclass="";
            	if ( isset( $value['pid'] ) ) { $textclass = $value['pid']; }
            	$app="";
            	if ( isset( $value['app'] ) ) { $app = $value['app']; }
            	$output .= '<input class="'.$textclass.' '.$app.'" name="'. $value['id'] .'" id="'. $value['id'] .'" type="'. $value['type'] .'" value="'. $val .'" />';
       			break;
        
        		case 'select':				
            	$selectclass="";
            	if ( isset( $value['pid'] ) ) { $selectclass = $value['pid']; }
            	$output .= '<select class="'.$selectclass.'" name="'. $value['id'] .'" id="'. $value['id'] .'">';        
           		if ( isset( $gpp[ $value['id'] ] ) ) 
           			$select_value = $gpp[ $value['id'] ];               
            	foreach ( $value['options'] as $key => $option ) {  
                	$selected = '';                
                    if ( $select_value != '' ) {
                        if ( $select_value == $key ) { $selected = ' selected="selected"'; } 
                   	} else {
                   		if ( $value['std'] == $key ) { $selected = ' selected="selected"'; }
                   	}                  
                	$output .= '<option value="'. $key .'" '. $selected .'>';
               		$output .= $option;
                	$output .= '</option>';
             	} 
             	$output .= '</select>';
				break;
            
       			case 'textarea':            		
            	if ( ! isset( $gpp[$value['id']] ) || ( $gpp[$value['id']] == "" ) ) { $ta_value = $value['std']; } else { $ta_value = stripslashes( stripslashes( $gpp[$value['id']] ) ); } 
            	$textareaclass="";
            	if ( isset( $value['pid'] ) ) { $textareaclass = $value['pid']; }
            	$output .= '<textarea class="'.$textareaclass.'" name="'. $value['id'] .'" id="'. $value['id'] .'" cols="" rows="8">'.$ta_value.'</textarea>';            
        		break;
				
        		case "radio":				
            	$select_value = $gpp[ $value['id'] ];                   
             	foreach ( $value['options'] as $key => $option ) {
					$checked = '';
                    if ( $select_value != '' ) {
                        if ( $select_value == $key ) { $checked = ' checked'; } 
                   	} else {
                    	if ( $value['std'] == $key ) { $checked = ' checked'; }
                   	}
                	$output .= '<input class="'.$value['pid'].'" type="radio" name="'. $value['id'] .'" value="'. $key .'" '. $checked .' />' . $option .'<br />';
            
            	}             
        		break;
				
        		case "checkbox": 			
          		$std = $value['std'];    
          		if ( isset( $gpp[$value['id']] ) )      
           			$saved_std = $gpp[$value['id']];           
           		$checked = '';				
            	if ( $gpp ) {
                	if ( $saved_std == 'true' ) {
                		$checked = 'checked="checked"';
                	} else {
                   		$checked = '';
                	}
            	} elseif ( $std == 'true' ) {
               		$checked = 'checked="checked"';
          		} else {
					$checked = '';
            	}
            	$checkclass="";
            	if ( isset( $value['pid'] ) ) { $checkclass = $value['pid']; }
				$output .= '<input class="'.$checkclass.' checkbox" type="checkbox"  name="'.  $value['id'] .'" id="'. $value['id'] .'" value="true" '. $checked .' />';
        		break;
				
       			case "multicheck":        
            	$std =  $value['std'];				
            	if ( isset( $gpp[$value['id']] ) ) 
					$saved_std = $gpp[$value['id']];					
				if ( ! empty( $saved_std ) ) {						
					$std_values = explode( ",", $saved_std );
				}				
            	foreach ( $value['options'] as $key => $option ) {                                             
            		$gpp_base_key = $value['id'] . '_' . $key;					
					
            		if ( ! empty( $saved_std ) ) { 
                 		if ( in_array( $key, $std_values ) ) {
							$checked = 'checked="checked"';								
						} else {
                      		$checked = '';     
                  		}    
           			} elseif ( $std == $key || $std == "all" ) {
               			$checked = 'checked="checked"';
           			} else {
               			$checked = '';
					}            
            		$output .= '<input class="'.$value['pid'].' '. $value['id'].' checkbox" type="checkbox" name="'. $gpp_base_key .'" id="'. $gpp_base_key .'" value="true" '. $checked .' /><label for="'. $gpp_base_key .'">'. $option .'</label><br />';                                        
				}
            	break;
        
       			case "upload":   
       			$valuepid = "";
            	if ( isset( $value['pid'] ) ) { $valuepid = $value['pid']; }         
           		$output .= gppthemes_uploader_function( $value['id'], $valuepid, $value['std'], 'options' );
            	break;
            	
				case 'image':				
        	    if ( ! isset( $gpp[$value['id']] ) ) { $val = $value['std']; } else { $val = stripslashes( stripslashes( $gpp[$value['id']] ) ); } 				
            	$imageclass="";
            	if ( isset( $value['pid'] ) ) { $imageclass = $value['pid']; }
            	$app="";
            	if ( isset($value['app'] ) ) { $app = $value['app']; }
            	$output .= '<input class="upload-input-text '.$imageclass.' '.$app.'" name="'. $value['id'] .'" id="'. $value['id'] .'" type="text" value="'. $val .'" /><a href="'.get_option('siteurl').'/wp-admin/admin-ajax.php?action=choice&width=150&height=100" id="'.$value['id'].'_button" class="button">Upload</a><br /><br /><!--<span class=\"description\">After uploading click the <strong>INSERT INTO POST</strong> button.  Your image will appear here after you have saved the options below.</span>-->';
            	$output .= '<div class="clear"></div><div class="previewimg">';
				if ( $val != "" ){$output .= '<img class="uploadedimg" id="image_'.$value['id'].'" src="'.$val.'" />';}
				$output .= '</div>';
       			break;
        
				case "dragdrop":
				if ( ! isset( $gpp[$value['id']] ) ) { 
					$val = $value['std']; 
				} elseif ( isset( $gpp[$value['id']] ) &&( strlen( $value['std'] ) > strlen( $gpp[$value['id']] ) ) ) {
					$val = $value['std']; 
				}else{ 
					$val = stripslashes( stripslashes( $gpp[$value['id']] ) ); 
				} 									
				$appsorder= str_split( $val );
			
				$output .= '<ul id="sortableapps">';				
				foreach( $appsorder as $application ){
					if ( isset( $appsdirectorys[$application] ) ) {
						if ( in_array( ucwords( str_replace( "-", " ", trim($appsdirectorys[$application] ) ) ), $headingarray ) ) {
							$output .= '<li class="sortapps" id="'.$application.'" style="width:150px;margin-bottom:5px;cursor:move;text-align:center;">' . ucwords( str_replace( "-", " ", trim( $appsdirectorys[$application] ) ) ).'</li>';
						}
					}
				}
				$output .= '</ul>';
				$output .= '<input type="hidden" name="'. $value['id'].'" value="'.$val.'" id="appsorder">';				
       			break;
       			
       			case "help":                   	
            	$output .= '<p class="help" id="'.str_replace( " ", "_", $value['name'] ).'">'. $value['desc'] .'</p>'."\n";
        		break;
				
				case "hidden": 
				if ( ! isset($gpp[$value['id']])) { $val = $value['std']; } else { $val = stripslashes( stripslashes( $gpp[$value['id']] ) ); } 				
            	$output .= '<input class="'.$value['pid'].'" type="hidden" id ="'. $value['id'].'" name="'. $value['id'].'" value="'.$val.'">';
        		break;
				
				case "heading":          
             	if ( $counter >= 2 ) {
              		$output .= '</div>'."\n";
            	}           	
            	$output .= '<div class="option_content" id="'.str_replace( " ", "_", $value['name'] ).'">'."\n";
			 	$output .= '<a class="anchor" name="'.str_replace( " ", "_", $value['name'] ).'"></a><h3>'. $value['name'] .'</h3>'."\n";
        		break;
				
       			case "group":     
            	$output .= '<div class="gpp_base_group">'; 
            	$output .= '</div>'."\n";
            	$output .= '<div class="option_content">'."\n";
        		break;
				
       			case "groupEnd":
            	$output .= '</div>'."\n";
        		break;                               
       		} 
        
        	if ( is_array( $value['type'] ) ) {            
            	foreach( $value['type'] as $array ) {            
               		$id =   $array['id']; 
                	$std =   $array['std'];
                	$saved_std = get_option( $id );
                	if ( $saved_std != $std && ! empty( $saved_std ) ){ $std = $saved_std; } 
                	$meta =   $array['meta'];                    
                	if ( $array['type'] == 'text' ) { // Only text at this point                         
                	    $output .= '<input class="input-text-small" name="'. $id .'" id="'. $id .'" type="text" value="'. $std .'" />';  
                	    $output .= '<span class="meta-two">'.$meta.'</span>';
                	}
            	}
        	}
        
        	if ( $value['type'] != "heading" ) { 
            	if ( $value['type'] != "checkbox" ) { 
            		$output .= '<br/>';
          		}
          		if ( $value['type'] != "help" ) {
            		$output .= '</div><div class="desc">'. $value['desc'] .'</div></div>'."\n";
            	}
            	$output .= '</div></div><!--<div class="clear"></div>-->'."\n";        
            }
        
    }
    
    $output .= '</div>';
    return $output;
    
}

// gppThemes Uploader
function gppthemes_uploader_function( $id, $pid, $std ) {
	$gpp = get_option( 'gpp_base_options' );	
	global $val;
	$upload = "";
	$uploader = "";
    $uploader .= '<input id="attachement_'.$id.'" class="'.$pid.' upload_input" type="text" name="attachement_'.$id.'" value="'. $val .'">';
	$uploader .= '<input type="button" class="button upload_browse" id="'. $id .'_upload" value="Browse">';
    $uploader .= '<input name="save" type="button" value="Upload" class="button upload_save" />';
    if ( isset( $gpp[$id] ) ) 
    	$upload = $gpp[$id];    
    $uploader .= '<div class="clear"></div>';  
    $uploader .= '<input class="upload-input-text" name="'.$id.'" value="'.$upload.'"/>';
    $uploader .= '<div class="clear"></div><div class="previewimg">';  
    if ( ! empty( $upload ) ) {
		$uploader .= '<img class="uploadedimg" id="image_'.$id.'" src="'.$upload.'"/>';
	}
	$uploader .= '</div>'; 
	return $uploader;
}

//Floating Menu Options
function gppthemes_menublock( $options, $page ) {
	global $page,$headingarray;
	$headingarray = array();
 	$output1 = '<ul class="menulist">';
	foreach ( $options as $value ) {
		if ( $value['type'] == "heading" ) {          
            $output1 .= '<li><a href="#' . str_replace( " ", "_", $value['name'] ) . '">' . $value['name'] . '</a></li>' . "\n"; 
			array_push( $headingarray, ucwords( trim( $value['name'] ) ) );         	
		}		
	}
	$output1 .= '</ul>' . "\n";
return $output1;
}

// Load Javascript
require_once( $functions_path . 'admin-js.php' );

add_action( 'wp_ajax_my_special_action', 'my_action_callback' ); 

function my_action_callback() {
	global $wpdb;	
	$themename = get_option( 'template' ) . "_";
	if ( isset( $_POST['type'] ) ) {
		//Picture upload
		if ( $_POST['type'] == 'upload' ) {		
			$browseid = $_POST['data']; // Acts as the name
			$filename = $_FILES[$browseid];
			$override['test_form'] = false;
			$override['action'] = 'wp_handle_upload';    
			$uploaded_file = wp_handle_upload( $filename, $override );			 
					//$upload_tracking[] = $browseid;
					//update_option( $browseid , $uploaded_file['url'] );					
			 if ( ! empty( $uploaded_file['error'] ) ) { echo 'Upload Error: ' . $uploaded_file['error']; } else { echo $uploaded_file['url']; } // Is the Response 
		
		}
	} else {
	//Save settings in database
		$data = $_POST['settings'];	
//print_r($data);		
		parse_str( $data, $output );		
		$options =  get_option( 'gpp_base_template' );
//print_r($options);		
		foreach( $options as $option_array ) {	
			if ( isset( $option_array['id'] ) ) { 			
				$id = $option_array['id'];				
				$new_value = '';				
				if ( $option_array['type'] == "multicheck" ) {
					$options = $option_array['options'];
					foreach ( $options as $options_id => $options_value ) {					
						$multicheck_id = $id . "_" . $options_id;						
						if ( isset( $output[$multicheck_id] ) ) {							
							$new_value .= $options_id.",";
						}
					}											
				} else {
					if ( isset( $output[$id] ) ) {
						$new_value = strip_tags( $output[$id], '<a><b><em>' );
					}								
				}
				$gppoptions[$id] = $new_value;						
			}			
		} 		
		update_option( 'gpp_base_options', $gppoptions );		
		echo "1";//success
		die();  
	}	
}