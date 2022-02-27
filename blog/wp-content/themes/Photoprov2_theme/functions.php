<?php

$functions_path = TEMPLATEPATH . '/functions/';
// Options panel variables and functions
require_once ($functions_path . 'ganeral.php');
require_once ($functions_path . 'metabox.php');
require_once ($functions_path . 'uploadthumb.php');

// Options panel variables and functions
add_action('admin_head', 'classic_css');

function classic_css() { // Adds Dashboard Head Style ?>

<script type="text/javascript">
jQuery(function () {
    var tabContainers = jQuery('div.tabs > div');
    
    jQuery('div.tabs ul.tabNavigation a').click(function () {
        tabContainers.hide().filter(this.hash).show();
        
        jQuery('div.tabs ul.tabNavigation a').removeClass('selected');
        jQuery(this).addClass('selected');
        
        return false;
    }).filter(':first').click();
});
</script>

<style type="text/css">

.clear {
height:1px;
font-size:1px;
line-height:1px;
}

.tabs .tabNavigation {
width: 694px;
background: #eee;
overflow: hidden;
padding: 6px 0 0 6px;
margin: 0px;
height: 35px;
position: relative;
}

.tabs .tabNavigation li {
float: left;
display: inline;
margin-right: 4px;
}

.tabs .tabNavigation li.submit_tab {
position: absolute;
padding: 8px 6px;
top: 0px;
right: 0px;
z-index: 22;
}

.tabs .tabNavigation li.submit_tab input {
background: #9bc133;
border: 1px solid #aaa;

color:  #fff;
}

.tabs .tabNavigation li a{
background: #aaa;
padding: 10px;
text-decoration: none;
display: block;
color: #fff;border: 1px solid #999;
}

.tabs .tabNavigation li a.selected {
background: #fff;
color: #111;
border: 1px solid #ddd;
font-weight: bold;
}

.p_tab {
background: #fff;
width: 700px;
padding: 40px 10px 10px 10px;
}



</style>


   
<?php
} 

$themename = "Photopro";
$shortname = "p";


$options = array (


	array(	"type" => "div_open1"),
	array(	"type" => "open"),

	array(	"name" => "RSS URL",
			"desc" => "Enter Feedburner URL here if you have.",
			"id" => $shortname."_feedburner_url",
			"std" => "",
			"type" => "text"),
				
	array(	"name" => "Header scripts",
			"desc" => "If you need to add some stats script like Mint tracking code, this is the right place. This will be added into the header template of your theme.",
			"id" => $shortname."_header_scripts",
			"std" => "",
			"type" => "textarea"),

	array(	"name" => "Footer scripts",
			"desc" => "Please paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
			"id" => $shortname."_footer_scripts",
			"std" => "",
			"type" => "textarea"),
	
	array(	"type" => "close"),
	array(	"type" => "div_close"),
	

	
	array(	"type" => "div_open2"),
	array(	"type" => "open"),	

	array(	"name" => "Picture",
			"desc" => "Upload your image somewhere, and paste the url here (http://www.yoursite.com/logo.jpg)",
            "id" => $shortname."_pic",
            "std" => "http://frozr.com/junk/kim.jpg",
            "type" => "text"),	
			
	array(	"name" => "Name",
			"desc" => "",
			"std" => "My name",
            "id" => $shortname."_name",
            "type" => "text"),

	array(	"name" => "Location",
			"desc" => "",
			"std" => "Location",
            "id" => $shortname."_location",
            "type" => "text"),
            
	array(	"name" => "Job",
			"desc" => "",
			"std" => "Photographer",
            "id" => $shortname."_job",
            "type" => "text"),            
            
	array(	"name" => "Phone",
			"desc" => "",
			"std" => "0123456789",
            "id" => $shortname."_phone",
            "type" => "text"),
            
	array(	"name" => "Email",
			"desc" => "",
			"std" => "asd@email.com",
            "id" => $shortname."_email",
            "type" => "text"),	
            	
	array(	"name" => "About Me Snippet",
			"desc" => "Include a little snippet about yourself.",
            "id" => $shortname."_about_detail",
            "type" => "textarea"),

	array(	"type" => "close"),			
	array(	"type" => "div_close"),
	
	
	
	array(	"type" => "div_open3"),
	array(	"type" => "open"),	
	
	array(	"name" => "Custom Logo",
			"desc" => "Upload your logo somewhere, and paste the url here (http://www.yoursite.com/logo.jpg)",
            "id" => $shortname."_logo",
            "std" => "http://frozr.com/junk/photoprov2.png",
            "type" => "text"),	

	array(	"name" => "About me",
			"desc" => "Small *About Me* widget on the sidebar. Do you want to activate it?",
            "id" => $shortname."_aboutme",
           	"options" => array("Yes","No"),
            "type" => "select"), 
            	
	array(	"name" => "Photo detail",
			"desc" => "Photo detail is a section where it will shows the photo's exif data(camera, aperture...) (In single.php) Do you want to activate it?",
            "id" => $shortname."_detail",
           	"options" => array("Yes","No"),
            "type" => "select"),
            
	array(	"name" => "Comment section",
			"desc" => "Display or hide the comment template. If you do not want visitors to see or post comments, select *NO*.",
            "id" => $shortname."_comment",
           	"options" => array("Yes","No"),
            "type" => "select"),		

	array(	"name" => "Blog Widget",
			"desc" => "Enalble blog widget?",
            "id" => $shortname."_blog_widget",
           	"options" => array("Yes","No"),
            "type" => "select"),
            
	array(	"type" => "close"),            	
	array(	"type" => "div_close")
);

function mytheme_add_admin() {

    global $themename, $shortname, $options;

    if ( $_GET['page'] == basename(__FILE__) ) {
    
        if ( 'save' == $_REQUEST['action'] ) {

                foreach ($options as $value) {
                    update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

                foreach ($options as $value) {
                    if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }

                header("Location: themes.php?page=functions.php&saved=true");
                die;

        } else if( 'reset' == $_REQUEST['action'] ) {

            foreach ($options as $value) {
                delete_option( $value['id'] ); }

            header("Location: themes.php?page=functions.php&reset=true");
            die;

        }
    }

    add_theme_page($themename." Options", "".$themename." Options", 'edit_themes', basename(__FILE__), 'mytheme_admin');

}

function mytheme_admin() {

    global $themename, $shortname, $options;

    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
    if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
    
?>











<h2><?php echo $themename; ?> settings</h2>

<form method="post">
<div class="tabs">
  <ul class="tabNavigation">
    <li><a href="#1">Ganeral Option</a></li>
    <li><a href="#2">About Me</a></li>
    <li><a href="#3">Layout Option</a></li>
    
    <li class="submit_tab">
		<input name="save" type="submit" value="Save changes" />    
		<input type="hidden" name="action" value="save" />
	</li>
    
  </ul>
	
	<div class="clear"></div>
	
<?php foreach ($options as $value) { 
    
	switch ( $value['type'] ) {
	
		case "open":
		?>
			<table class="p_tab" border="0">
		
		<?php break;
		case "close":
		?>
			</table><br />
 
		<?php break;
		case "title":
		?>
			<?php echo $value['name']; ?>
		
		<?php break;
		case "div_open1":
		?>
			  <div id="1">
					
		
		<?php break;
		case "div_open2":
		?>
			  <div id="2">
    				
		
		<?php break;
		case "div_open3":
		?>
			  <div id="3">
					
		
		<?php break;
		
		case "div_close":
		?>
			</div>
		
		<?php break;
		case "saperate":
		?>
		
			<tr><td rowspan="2" valign="middle"><h2><?php echo $value['name']; ?></h2></td></tr>
			<tr><td><small><?php echo $value['desc']; ?></small></td>
			</tr><tr><td colspan="2" style="margin-bottom:2px;border-bottom:1px solid #ddd;">&nbsp;</td></tr>
			<tr><td colspan="2">&nbsp;</td></tr>
            
            		       
		<?php break;
		case 'text':
		?>
        
        <tr>
            <td width="22%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="78%"><input style="width:400px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" /></td>
        </tr>

        <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
        </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px solid #ddd;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

		<?php 
		break;
		
		case 'textarea':
		?>
        
        <tr>
            <td width="22%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="78%">
            
            <textarea name="<?php echo $value['id']; ?>" style="width:400px; height:110px;" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings($value['id'])); } else { echo $value['std']; } ?></textarea>
           
            </td>
            
        </tr>

        <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
        </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px solid #ddd;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

		<?php 
		break;
		
		case 'select':
		?>
        <tr>
            <td width="22%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="78%"><select style="width:240px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php foreach ($value['options'] as $option) { ?><option<?php if ( get_settings( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?></select></td>
       </tr>
                
       <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
       </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px solid #ddd;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

		<?php
        break;
            
		case "checkbox":
		?>
            <tr>
            <td width="22%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
                <td width="78%"><? if(get_settings($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
                        <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
                        </td>
            </tr>
                        
            <tr>
                <td><small><?php echo $value['desc']; ?></small></td>
           </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px solid #ddd;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>
            
        <?php break;
	
 
} 
}
?>

<!--</table>-->
<p class="submit">
<input name="save" type="submit" value="Save changes" />    
<input type="hidden" name="action" value="save" />
</p>

</form>
<form method="post">
<p class="submit">
<input name="reset" type="submit" value="Reset" />
<input type="hidden" name="action" value="reset" />
</p></div>
</form>

<?php
}
add_action('admin_menu', 'mytheme_add_admin');


?>
