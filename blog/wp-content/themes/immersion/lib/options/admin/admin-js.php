<?php 
//searching a value through a multidimensionnal array
function gpp_recursive_array_search( $haystack, $needle, $index = null ) { 
    if ( $haystack ) {
		$aIt = new RecursiveArrayIterator( $haystack ); 
		$it = new RecursiveIteratorIterator( $aIt ); 
    
		while ( $it->valid() ) {        
			if ( ( ( isset( $index ) AND ( $it->key() == $index ) ) OR ( ! isset( $index ) ) ) AND ( $it->current() == $needle ) ) { 
				return $aIt->key(); 
			} 
			
			$it->next(); 
		} 
    }
    return false;    
    
} 
$options =  get_option( GPP_THEME_SHORTNAME.'_template' );

$ifupload = gpp_recursive_array_search( $options, 'upload' );	
$ifselect = gpp_recursive_array_search( $options, 'select' );
$ifcheckbox = gpp_recursive_array_search( $options, 'checkbox' );
$ifvideo = gpp_recursive_array_search( $options, 'video' );


function gpp_admin_ajaxupload_js() {
	global 	$ifupload;
	// only show on gppthemes admin page
	if ( isset( $_GET['page'] ) ) {
		if ( $_GET['page'] == "gppthemes" && $ifupload!="false" ) {
			wp_enqueue_script( 'ajaxupload', GPP_OPTIONS_URL.'apps/uploader/ajaxupload.js', array('jquery'));	
		}
	}
	if ( is_admin() ) wp_enqueue_script( 'jquery-ui-sortable' );
}

add_action( 'init', 'gpp_admin_ajaxupload_js',13 );

function gpp_admin_main_js() {

	// only show on gppthemes admin page
	if ( isset( $_GET['page'] ) ) {
		if ( $_GET['page'] == "gppthemes" || $_GET['page'] == "gppthemes-transport" ) {

		global 	$ifupload, $ifselect, $ifcheckbox, $ifvideo;
		
		$doc_ready_script = '
		<script type="text/javascript">
			jQuery(document).ready(function(){
				';
				
		$doc_ready_script .= 'jQuery(".happy").hide();
			jQuery(".warning").hide();      
			jQuery("#optionblock").css("display","block");
			// Checkbox background change
			jQuery(":checkbox").change(function() {
				if(!jQuery(this).parents(".option-inner").parent().hasClass("option-multicheck")){		
					if ( this.checked ) {
						jQuery(this).parents(".option-inner").animate({backgroundColor:"#ccffcc"},100).animate({backgroundColor:"#fff"},1000);
					} else {
						jQuery(this).parents(".option-inner").animate({backgroundColor:"#ffcccc"},100).animate({backgroundColor:"#fff"},1000);
					}
				}
			}); 

		//Ajax Save
		jQuery(".gppsave").click(function(){
			jQuery(this).attr("value","Saving Options...");		
			var save_position = screencenter();		
			jQuery(".happy").css("top",save_position);	  		
			jQuery.post(ajaxurl, {action: "my_special_action", settings: jQuery("#adminform").serialize()}, function(response) {			
				//alert(response);
				if(response == 1){					
					jQuery(".happy").removeClass("hidden").show().fadeOut(2500);
					jQuery(".gppsave").attr("value","Save All Changes");					
				}
			});
			return false; 
		});';
		
		if ( isset( $_REQUEST["reset"] ) ) { $reset=$_REQUEST["reset"]; } else { $reset = "false"; }
			
		$doc_ready_script .= '
		//Show Reset message popup after refresh 
		if("'.$reset.'" == "true"){				
			var myFile = document.location.toString();		
			var save_position = screencenter();	
			jQuery(".warning").css("top",save_position);';

				$doc_ready_script .= 'jQuery(".warning").removeClass("hidden").show().fadeOut(4000);
				';

			
		$doc_ready_script .= ' }	
		
		//Sticky side menu options
		if(jQuery(document.body).hasClass("toplevel_page_gppthemes")){
			var top = jQuery(".nav-tab-wrapper").offset().top - parseFloat(jQuery(".nav-tab-wrapper").css("marginTop").replace(/auto/, 0));
			top = (top-10);		
		}	

		jQuery(window).scroll(function (event) {    		
			var y = jQuery(this).scrollTop();   			
			if (y >= top) {   	  		
				jQuery(".nav-tab-wrapper").addClass("fixed");			
			} else {   	   		
				jQuery(".nav-tab-wrapper").removeClass("fixed");			
			}	
		});	

		
			';
		if ( $ifupload != "false" ) {
			$doc_ready_script .= '
				//Ajax upload photo
				jQuery(".upload_browse").each(function(){			
					var browseid = jQuery(this).attr("id");
					var au = new AjaxUpload("#"+browseid, {	
						action: "'.admin_url( "admin-ajax.php" ).'",
						name: browseid, // File upload name
						data: { // Additional data to send
							action: "my_special_action",
							type: "upload",
							data: browseid },					
						autoSubmit: false,
						onChange: function(file, extension){
							jQuery("#"+browseid).parent().find(".upload_input").attr("value",file);						
						},
						onSubmit : function(file , ext){		
						jQuery("#"+browseid).parent().find(".upload_save").attr("value","Uploading...");					
						},		
						onComplete : function(file,response){				
							response = response.substring(0, response.length - 1);					
							jQuery("#"+browseid).parent()
								.find(".upload_save").attr("value","Upload").end()
								.find(".upload-input-text").attr("value",response).end()
								.find(".previewimg").html("<img class=\'uploadedimg\' src=\'"+response+"\' style=\'width:275px\'/>").end()				
								.find(".previewimg").show().end()
								.find("img").show();
														
						}	
					});
					//Upload when Upload button is clicked
					jQuery(".upload_save").bind("click", function(e) { 					
						au.submit();	
					});
				});	
			
				//Show delete option upon hover to the preview picture(toggle)
			jQuery("#adminform .previewimg").hover(function(){
				var thisitem = jQuery(this);
				if(thisitem.find("img").hasClass("uploadedimg")){
					thisitem
						.append("<img id=\'delete\' src=\''. GPP_OPTIONS_URL."/images/delete.png".'\' title=\'Delete Image\'/>")		
						.find(".uploadedimg").css("opacity","0.7").end()		
						.css("background","#000000");					
				}
				thisitem.find("#delete").addClass("hover");
			},function(){
				var thisitem = jQuery(this);
				thisitem
					.find("#delete").remove().end()	
					.find(".uploadedimg").css("opacity","1").end()
					.css("background","none");		
			});  	
			
						
			//As .live is deprecated since jQuery 1.7
			jQuery("body").on("mouseover", "#delete", function(){
			  jQuery(this).css("opacity","1");
			});
			jQuery("body").on("mouseout", "#delete", function(){
			  jQuery(this).css("opacity","0.75");
			});
			
			//Delete the picture uploaded from the preview screen			
			jQuery("body").on("click", "#delete", function(){   //As .live is deprecated since jQuery 1.7
				var thisitem = jQuery(this);
				thisitem.parent().parent()
					.find(".upload_input").attr("value","").end()
					.find(".upload-input-text").attr("value","");
				thisitem.parent()	
					.css("background","#FFAFAF").slideUp(800)
					.find("img").fadeOut(500,function(){
						var thisitem = jQuery(this).parent();
						thisitem
							.find("img").attr("value","").attr("src","").end()
							.css("background","#FFFFFF");
					});		
			});	
			
			';
		}
								
		if ( ( $ifselect != "false" ) || ( $ifcheckbox != "false" ) ) {
		$doc_ready_script .= '
		//hide all submenus at first.		
		jQuery(".pid").parent().parent().parent().parent().hide();
		
		//show and hide the submenus	
		jQuery("h2.nav-tab-wrapper a").click(function(event){ 			
			if(!jQuery(this).hasClass("nav-tab-active")){
				jQuery(".nav-tab-wrapper").removeClass("fixed");
				jQuery("h2.nav-tab-wrapper a").each(function(){				
					var blockid = jQuery(this).html().replace(/ /g,"_");
					jQuery(this).attr("href","#"+blockid);
				});						
				var blockid = jQuery(this).html().replace(/ /g,"_");							
				jQuery(".option_content").hide();			
				jQuery("h2.nav-tab-wrapper a").removeClass("nav-tab-active");
				jQuery(this).addClass("nav-tab-active").removeAttr("href");				
				jQuery("div#optionblock #"+blockid).fadeIn(700);			
				jQuery("#"+blockid+" .option").find("input.checkbox").each(function(){
				//alert(jQuery(this).attr("id"));
					if(jQuery(this).attr("checked")){ 				
						var pidclass = jQuery(this).attr("id");
						jQuery("."+pidclass).each(function(){
							if(jQuery(this).hasClass("ipid")){
								jQuery(this).parent().parent().parent().parent().hide();
								var ipidclass = jQuery(this).attr("id");
								jQuery("."+ipidclass).each(function(){
									jQuery(this).parent().parent().parent().parent().hide();
								});
							} else {
								var allclass = jQuery(this).attr("class");
								var preipid = allclass.split(" ");							
								//alert(preipid[0]);
								if(jQuery("#"+preipid[0]).is(":visible")){
									jQuery(this).parent().parent().parent().parent().show();
								} else {
									jQuery(this).parent().parent().parent().parent().hide();
								}						
							}					
						});					
					} else {
						var pidclass = jQuery(this).attr("id");
						jQuery("."+pidclass).each(function(){
							if(jQuery(this).hasClass("ipid")){
								jQuery(this).parent().parent().parent().parent().show();
								var ipidclass = jQuery(this).attr("id");
								if(jQuery(this).is(":checked")){								
									jQuery("."+ipidclass).each(function(){
										jQuery(this).parent().parent().parent().parent().show();							
									});
								} else {
									jQuery("."+ipidclass).each(function(){
										jQuery(this).parent().parent().parent().parent().hide();							
									});
								}
							} else {
								jQuery(this).parent().parent().parent().parent().hide();
							}
						});					
					}	
				});
				
			}
			selectcheck();
		});	
		
		jQuery("h2.nav-tab-wrapper a").each(function(){				
			var blockid = jQuery(this).html().replace(/ /g,"_");
			jQuery("div#optionblock #"+blockid+" div.forminp input.checkbox").click(function(){				
				if(jQuery(this).is(":checked")){					
					var pidclass = jQuery(this).attr("id");
					jQuery("."+pidclass).each(function(){
						if(jQuery(this).hasClass("ipid")){
							jQuery(this).parent().parent().parent().parent().hide();
							var ipidclass = jQuery(this).attr("id");
							jQuery("."+ipidclass).each(function(){
								jQuery(this).parent().parent().parent().parent().hide();							
							});
						} else {
							jQuery("."+pidclass).parent().parent().parent().parent().slideDown("fast");
						}
					
					});					
					jQuery("."+pidclass).each(function(){						
						var subclass = jQuery(this).attr("id");						
						var optselected = jQuery("select#"+subclass+" option:selected").val();
						if(jQuery('.'+subclass).hasClass(optselected)){						
							jQuery('.'+subclass).each(function(){
								if(jQuery(this).hasClass(optselected)){								
									jQuery(this).parent().parent().parent().parent().slideDown("fast");									
								}  else {
									jQuery(this).parent().parent().parent().parent().hide();
								}		
							});
						}					
					});
				} else {				
					var pidclass = jQuery(this).attr("id");
					jQuery("."+pidclass).each(function(){
						if(jQuery(this).hasClass("ipid")){
							jQuery(this).parent().parent().parent().parent().slideDown("fast");
							var ipidclass = jQuery(this).attr("id");
							if(jQuery(this).is(":checked")){								
								jQuery("."+ipidclass).each(function(){
									jQuery(this).parent().parent().parent().parent().slideDown("fast");							
								});
							} else {
								jQuery("."+ipidclass).each(function(){
									jQuery(this).parent().parent().parent().parent().hide();							
								});
							}
						} else {
							jQuery("."+pidclass).parent().parent().parent().parent().hide();
						}
					});		
				}				
			});		
			selectcheck();		
		});

		
		
		//call function to check the sub options selected
		if(jQuery(document.body).hasClass("toplevel_page_gppthemes")){
			selectcheck();
		}
		
		jQuery("select").change(function () {
			var optselected = jQuery(this).val();		
			var pidclass = jQuery(this).attr("id");		
			if(jQuery("."+pidclass).hasClass(optselected)){
				jQuery("."+pidclass).each(function(){
					if(jQuery(this).hasClass(optselected)){
						if(!jQuery(this).parent().parent().parent().parent().hasClass("slidehide")){
							jQuery(this).parent().parent().parent().parent().slideDown("fast");
						}						
					} else {
						jQuery(this).parent().parent().parent().parent().hide();
					}			
				});			
			} else {
				jQuery("."+pidclass).each(function(){				
					jQuery(this).parent().parent().parent().parent().hide();							
				});
			}			
		});		

	';
	}

				
		//Main Required always
		$doc_ready_script .= '
			//refresh to the current page
		var myFile = document.location.toString();
		if (myFile.match("#")) { // the URL contains an anchor
			// click the navigation item corresponding to the anchor
			var myAnchor = "#" + myFile.split("#")[1];	  
			jQuery("h2.nav-tab-wrapper a[href=\'"+myAnchor+"\']").click();						
		} else {
			// click the first navigation item	  
			jQuery("h2.nav-tab-wrapper a:first").click();
		}	
		';
	//Sorting application
		$doc_ready_script .= '
			jQuery(function() {			
				jQuery( "#sortableapps" ).sortable({
					placeholder: "ui-state-highlight",
					stop: function(event, ui) {
							var appsarray = "";
							jQuery("#sortableapps li").each(function(){
								var appid = jQuery(this).attr("id");
								appsarray = appsarray + appid;
							});
							//alert(appsarray);
							jQuery("#appsorder").attr("value",appsarray);
						}
				});
				jQuery( "#sortableapps" ).disableSelection();				
			});
			if(jQuery("#sortableapps li").length < 2){
				jQuery("#sortableapps").parent().parent().parent().parent().hide();
			}		
		';

		//Ending script
		$doc_ready_script .= '
		
	});
			//screen center find out
			var screencenter = function(){	
				var screen_center = jQuery(window).height();		 
				var y_axis = (screen_center/2)-70;	
				var save_position = jQuery(window).scrollTop();		
				save_position = (save_position+y_axis)+"px";
				return save_position;
			}
			
			//check the select options value for suboptions to display.
	var selectcheck = function(){
		jQuery("select option:selected").each(function(){
			var optselected = jQuery(this).val();
			var pidclass = jQuery(this).parent().attr("id");
			if (jQuery("#"+pidclass).is(":visible")) {					
				if(jQuery("."+pidclass).hasClass(optselected)){
					jQuery("."+pidclass).each(function(){
						if(jQuery(this).hasClass(optselected)){				
							jQuery(this).parent().parent().parent().parent().show();						
						} else {
							jQuery(this).parent().parent().parent().parent().hide();
						}			
					});
				} 
			}
		});
	}

			
	</script>
			';
					
	echo $doc_ready_script;

		}
	}
}
add_action( 'admin_head', 'gpp_admin_main_js' );

/*
*
* Adds the WP Add Media thickbox overlay to image upload fields on theme options
*
*/

function gpp_thickbox_js_dom() {

	$options = get_option( 'immersion_template' );

			echo '
	<script type="text/javascript">
	 jQuery(document).ready(function(){
		var pID = jQuery("#post_ID").val();';
				
		foreach ( $options as $value ) {
			if ( $value['type'] == 'image' ) {
				$id = $value['id'];
			
			echo '
		jQuery("#' . $id . '_button").click(function () {
				window.send_to_editor = function (html) {
					imgurl = jQuery("img", html).attr("src");
					jQuery("#' . $id . '").val(imgurl);
					jQuery("#'.$id.'").parent().find(".previewimg").css({"display":"block"}).html("<img width=\"275\" class=\"uploadedimg\" id=\"image_'.$id.'\" src="+imgurl+">");
					tb_remove();
				}
				tb_show("", "media-upload.php?post_id=" + pID + "&type=image&TB_iframe=true&width=650&height=500&id='.$id.'");
				return false;
			});
			jQuery("#' . $id . '_button","#' . $id . '")
			.val("");';
					
			}
		}
		
			echo '});
	</script>',"\n\n";

}

if ( isset( $_GET['page'] ) ) {
	if ( $_GET['page'] == "gppthemes" ) {
		add_action( 'admin_head', 'gpp_thickbox_js_dom' );
		add_action( 'admin_init', 'gpp_load_thickbox_js' );
		add_action( 'admin_print_styles','gpp_load_thickbox_style' );
	}
}
	
/*
*
* Add Thickbox JS to Theme Options page
*
*/

function gpp_load_thickbox_js() {
    wp_enqueue_script( 'thickbox' );            
}

/*
*
* Add Thickbox CSS to Theme Options page
*
*/

function gpp_load_thickbox_style() {
	wp_enqueue_style( 'thickbox' );
}