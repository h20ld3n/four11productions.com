<?php

// General Settings
$current = '2.0';

// Simple Reverse Comments, idea from Sudar's Simple Reverse Comments plugin: http://sudarmuthu.com/wordpress/reverse-comments
if (!function_exists('rgb_smrc_reverse_comments') && get_option('rgb_cmt_text')==1) {
	function rgb_smrc_reverse_comments($comments) {
		return array_reverse($comments);
	}
	add_filter ('comments_array', 'rgb_smrc_reverse_comments');
}

// Color Schemes
function rgb_fontcolor() {
	$color = get_option('rgb_fontcolor');
	if (get_option('rgb_fontcolor') == '')	return '#1A1A1A';
	return $color;
}

function rgb_linkcolor() {
	$linkcolor = get_option('rgb_linkcolor');
	if (get_option('rgb_linkcolor') == '')	return '#cc0033';
	return $linkcolor;
}

function rgb_hovercolor() {
	$hovercolor = get_option('rgb_hovercolor');
	if (get_option('rgb_hovercolor') == '') return '#878787';
	return $hovercolor;
}

function rgb_sidecolor() {
	$sidecolor = get_option('rgb_sidecolor');
	if (get_option('rgb_sidecolor') == '')	return '#aaaaaa';
	return $sidecolor;
}

function rgb_headerbgcolor() {
	$headerbgcolor = get_option('rgb_headerbgcolor');
	if (get_option('rgb_headerbgcolor') == '') return '#333';
	return $headerbgcolor;
}

function rgb_contentcolor() {
	$hovercolor = get_option('rgb_contentcolor');
	if (get_option('rgb_contentcolor') == '') return '#FFFFFF';
	return $hovercolor;
}

function rgb_bgcolor() {
	$bgcolor = get_option('rgb_bgcolor');
	if (get_option('rgb_bgcolor') == '') return '#333';
	return $bgcolor;
}

function rgb_sidebg() {
	$sidebg = get_option('rgb_sidebg');
	if (get_option('rgb_sidebg') == '')	return '#333';
	return $sidebg;
}

function rgb_bgimage() {
	$bgimage = 'url('.get_bloginfo('template_url') . '/images/backgrounds/' . get_option('rgb_bg_image').') '. get_option('rgb_bg_repeat'). ' center top';
	if (get_option('rgb_bg_image') == '') return '';
	return $bgimage;
}
?>
<?php
class rgbOptions {

	function rgb_init() {
		// Load the localisation text
		load_theme_textdomain('rgb');
		// Function for Sidebar Widgets
		if (function_exists('register_sidebar')) { register_sidebars(2,array('before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>','before_title' => '<h2 class="widgettitle">','after_title' => '</h2>')); }
		// Check installation
		global $current;
		if (!get_option('rgb_installed') || get_option('rgb_installed') <= $current) { rgbOptions::rgb_install(); }
		// Add menus
		add_action('admin_menu',array('rgbOptions','rgb_add_menu'));
	}
	
	function rgb_add_menu() {
		// Add the submenus
		$page = add_theme_page(__('Theme Options','rgb'), __('Theme Options','rgb'), 'edit_themes', 'theme-options', 'rgb_admin');
		// Check if this page is the one being shown,if so then add stuff to the header
		add_action("admin_head-$page",array('rgbFunctions','rgb_admin_css'));
		add_action("admin_print_scripts-$page",array('rgbFunctions','rgb_admin_js'));
	}

	// Install rgb
	function rgb_install() {
		global $current;
		if (!get_option('rgb_installed')) {
			add_option('rgb_installed',$curent);
		} else {
			update_option('rgb_installed',$current);
		}
		add_option('rgb_bg_image','');
		add_option('rgb_bg_repeat','');
		add_option('rgb_shelf','1');
		add_option('rgb_uitabs','1');
		add_option('rgb_cmt_text','0');
	}
	
	// Update options
	function rgb_update() {
		if (!empty($_POST)) {
			if (isset($_POST['bg_file'])) {
				update_option('rgb_bg_image',$_POST['bg_file']);
				wp_cache_flush();
			}
			if (isset($_POST['bg_repeat'])) {
				update_option('rgb_bg_repeat',$_POST['bg_repeat']);
			}
			if (isset($_POST['shelf'])) {
				update_option('rgb_shelf','1');
			} else {
				update_option('rgb_shelf','0');
			}
			if (isset($_POST['uitabs'])) {
				update_option('rgb_uitabs','1');
			} else {
				update_option('rgb_uitabs','0');
			}
			if (isset($_POST['cmt_text'])) {
				update_option('rgb_cmt_text','1');
			} else {
				update_option('rgb_cmt_text','0');
			}
			if (isset($_POST['headerheight'])) { 
				update_option('rgb_headerheight',$_POST['headerheight']); 
			}
			if (isset($_POST['headerwidth'])) { 
				update_option('rgb_headerwidth',$_POST['headerwidth']); 
			}
			if (isset($_POST['fontcolor'])) { 
				update_option('rgb_fontcolor',$_POST['fontcolor']); 
			}
			if (isset($_POST['linkcolor'])) { 
				update_option('rgb_linkcolor',$_POST['linkcolor']); 
			}
			if (isset($_POST['hovercolor'])) { 
				update_option('rgb_hovercolor',$_POST['hovercolor']); 
			}
			if (isset($_POST['sidecolor'])) { 
				update_option('rgb_sidecolor',$_POST['sidecolor']); 
			}
			if (isset($_POST['headerbgcolor'])) { 
				update_option('rgb_headerbgcolor',$_POST['headerbgcolor']); 
			}
			if (isset($_POST['bgcolor'])) { 
				update_option('rgb_bgcolor',$_POST['bgcolor']); 
			}
			if (isset($_POST['contentcolor'])) { 
				update_option('rgb_contentcolor',$_POST['contentcolor']); 
			}
			if (isset($_POST['sidebg'])) { 
				update_option('rgb_sidebg',$_POST['sidebg']); 
			}
			if (isset($_POST['rss'])) { 
				update_option('rgb_rss',$_POST['rss']); 
			}
			if (isset($_POST['hidepages'])) { 
				update_option('rgb_hidepages',$_POST['hidepages']); 
			}
			if (isset($_POST['uninstall'])) {
				rgbOptions::rgb_uninstall();
			}
		}
	}

	// Uninstall rgb
	function rgb_uninstall() {
		global $wpdb;
		// Remove the options from the database
		$cleanup = $wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE 'rgb%'");
		// Flush the dang cache
		wp_cache_flush();
		// Activate the default Wordpress theme
		switch_theme('default', 'default');
		// Return to the default theme page.
		echo '<meta http-equiv="refresh" content="0;URL=themes.php?activated=true">';
		echo "<script> self.location(\"themes.php?activated=true\");</script>";
		exit;
	}
}
?>
<?php
class rgbFunctions {
	
	//I get Files scan functions from the great K2: http://getk2.com/
	function files_scan($path,$ext = false,$depth = 1,$relative = true) {
		$files = array();
		// Scan for all matching files
		rgbFunctions::_files_scan($path,'',$ext,$depth,$relative,$files);
		return $files;
	}

	function _files_scan($base_path,$path,$ext,$depth,$relative,&$files) {
		if (!empty($ext)) {
			if (!is_array($ext)) {
				$ext = array($ext);
			}
			$ext_match = implode('|',$ext);
		}

		// Open the directory
		if(($dir = @dir($base_path . $path)) !== false) {
			// Get all the files
			while(($file = $dir->read()) !== false) {
				// Construct an absolute & relative file path
				$file_path = $path . $file;
				$file_full_path = $base_path . $file_path;
				// If this is a directory,and the depth of scan is greater than 1 then scan it
				if(is_dir($file_full_path) and $depth > 1 and !($file == '.' or $file == '..')) {
					rgbFunctions::_files_scan($base_path,$file_path . '/',$ext,$depth - 1,$relative,$files);
				// If this is a matching file then add it to the list
				} elseif(is_file($file_full_path) and (empty($ext) or preg_match('/\.(' . $ext_match . ')$/i',$file))) {
					$files[] = $relative ? $file_path : $file_full_path;
				}
			}
			// Close the directory
			$dir->close();
		}
	}

	function rgb_admin_js() { // Color Picker from WordPress Default 1.6
?>
<script type="text/javascript" src="../wp-includes/js/colorpicker.js"></script>
<script type='text/javascript'>
// <![CDATA[
function pickColor(color) {
	ColorPicker_targetInput.value = color;
	colorUpdate(ColorPicker_targetInput.id);
}
function PopupWindow_populate(contents) {
	contents += '<br /><p style="text-align:center;margin-top:0px;"><input type="button" value="<?php _e('Close Color Picker','rgb') ?>" onclick="cp.hidePopup(\'prettyplease\')"></input></p>';
	this.contents = contents;
	this.populated = false;
}
function PopupWindow_hidePopup(magicword) {
	if (magicword != 'prettyplease')
		return false;
	if (this.divName != null) {
		if (this.use_gebi) {
			document.getElementById(this.divName).style.visibility = "hidden";
		}
		else if (this.use_css) {
			document.all[this.divName].style.visibility = "hidden";
		}
		else if (this.use_layers) {
			document.layers[this.divName].visibility = "hidden";
		}
	}
	else {
		if (this.popupWindow && !this.popupWindow.closed) {
			this.popupWindow.close();
			this.popupWindow = null;
		}
	}
	return false;
}
function colorSelect(t,p) {
	if (cp.p == p && document.getElementById(cp.divName).style.visibility != "hidden")
		cp.hidePopup('prettyplease');
	else {
		cp.p = p;
		cp.select(t,p);
	}
}
var cp = new ColorPicker();
function advUpdate(val,obj) {
	document.getElementById(obj).value = val;
	colorUpdate(obj);
}
function colorUpdate(oid) {
	if ('fontcolor' == oid) {
		document.getElementById('rgbfontcolor').style.color = document.getElementById('fontcolor').value;
		document.getElementById('advfontcolor').value = document.getElementById('fontcolor').value;
	}
	
	if ('linkcolor' == oid) {
		document.getElementById('rgblinkcolor').style.color = document.getElementById('linkcolor').value;
		document.getElementById('advlinkcolor').value = document.getElementById('linkcolor').value;
	}
	
	if ('hovercolor' == oid) {
		document.getElementById('rgbhovercolor').style.color = document.getElementById('hovercolor').value;
		document.getElementById('advhovercolor').value = document.getElementById('hovercolor').value;
	}
	
	if ('sidecolor' == oid) {
		document.getElementById('rgbsidecolor').style.color = document.getElementById('sidecolor').value;
		document.getElementById('advsidecolor').value = document.getElementById('sidecolor').value;
	}
	
	if ('headerbgcolor' == oid) {
		document.getElementById('rgbheaderbgcolor').style.background = document.getElementById('headerbgcolor').value;
		document.getElementById('advheaderbgcolor').value = document.getElementById('headerbgcolor').value;
	}
	
	if ('bgcolor' == oid) {
		document.getElementById('rgbbgcolor').style.background = document.getElementById('bgcolor').value;
		document.getElementById('advbgcolor').value = document.getElementById('bgcolor').value;
	}
	
	if ('contentcolor' == oid) {
		document.getElementById('rgbcontentcolor').style.background = document.getElementById('contentcolor').value;
		document.getElementById('advcontentcolor').value = document.getElementById('contentcolor').value;
	}
	
	if ('sidebg' == oid) {
		document.getElementById('rgbsidebg').style.background = document.getElementById('sidebg').value;
		document.getElementById('advsidebg').value = document.getElementById('sidebg').value;
	}
}
function toggleAdvanced() {
	a = document.getElementById('advanced');
	if (a.style.display == 'none')
		a.style.display = 'block';
	else
		a.style.display = 'none';
}
function toggleStyle() {
	m = document.getElementById('togglestyle');
	if (m.style.display == 'none')
		m.style.display = 'block';
	else
		m.style.display = 'none';
}
function toggleMisc() {
	m = document.getElementById('togglemisc');
	if (m.style.display == 'none')
		m.style.display = 'block';
	else
		m.style.display = 'none';
}
function colorDefaults() {
	document.getElementById('rgbfontcolor').style.color = '#1A1A1A';
	document.getElementById('rgblinkcolor').style.color = '#cc0033';
	document.getElementById('rgbhovercolor').style.color = '#878787';
	document.getElementById('rgbsidecolor').style.color = '#AAAAAA';
	document.getElementById('rgbheaderbgcolor').style.background = '#333';
	document.getElementById('rgbbgcolor').style.background = '#333';
	document.getElementById('rgbcontentcolor').style.background = '#FFFFFF';
	document.getElementById('rgbsidebg').style.background = '#333';
	document.getElementById('advfontcolor').value = document.getElementById('fontcolor').value = '#1A1A1A';
	document.getElementById('advlinkcolor').value = document.getElementById('linkcolor').value = '#cc0033';
	document.getElementById('advhovercolor').value = document.getElementById('hovercolor').value = '#878787';
	document.getElementById('advsidecolor').value = document.getElementById('sidecolor').value = '#AAAAAA';
	document.getElementById('advheaderbgcolor').value = document.getElementById('headerbgcolor').value = '#333';
	document.getElementById('advbgcolor').value = document.getElementById('bgcolor').value = '#333';
	document.getElementById('advcontentcolor').value = document.getElementById('contentcolor').value = '#FFFFFF';
	document.getElementById('advsidebg').value = document.getElementById('sidebg').value = '#333';
}
// ]]>
</script>
<?php } function rgb_admin_css() { ?>
<style type="text/css">	
body {font:62.5% "Lucida Grande", Segoe UI, Verdana, Arial, sans-serif;}
h2 {font:2.4em Georgia, "Times New Roman", Times, serif;border:0;margin:5px 0 !important;}
h3 {font:1.8em Georgia, "Times New Roman", Times, serif;margin:5px 0;color:#333333;}
h4 {font:1.5em Georgia, "Times New Roman", Times, serif;margin:5px 0 0;color:#333333;}
small {color:#777;font-size:.9em;}
.wrap {font-size:1.2em;}
.rgbcontainer {width:900px;margin:0 auto;text-align:left;color:#333333;}
.rgbcontainer p {margin:4px 0 0;padding:0;}
.rgbcontainer input[type=checkbox],.rgbcontainer input[type=radio] {border:0;}
.rgboptions {clear:both;width:870px;margin:0 0 20px;padding:15px;border:1px solid #ccc;}
.floatleft {float:left;width:400px;padding:0;margin:5px;}
#bg_file {width:300px;}
#bg_file,#bg_repeat {margin:10px 15px 0 0;padding:3px;font-size:.9em;}
#rgbheaderbgcolor {height:50px;width:443px !important;width:458px;margin:5px 8px !important;margin:5px 8px 5px 15px;border:1px solid #ccc;}
#rgbcontentcolor {float:left;width:315px;height:165px;margin:3px 4px 0 8px;border:1px solid #ccc;}
#rgbsidebg {float:right;width:105px;height:165px;margin:3px 8px 0 4px;border:1px solid #ccc;}
#rgbbgcolor {height:240px;width:460px;font-size:.9em;margin:8px auto;border:1px solid #ccc;}
#rgbmain {float:left;width:280px !important;width:270px;margin:5px;padding:15px 0 15px 15px;}
#rgbfontcolor,#rgblinkcolor,#rgbhovercolor  {margin:0 0 8px; }
#rgbsidecolor {margin:29px 30px 5px 30px;}
#advanced,#togglestyle {margin:5px 0;}5
#colorPickerDiv a,#colorPickerDiv a:hover {padding:1px;text-decoration: none;border-bottom: 0px;}
.savebtn {margin:10px 0;font:1.5 Georgia, "Times New Roman", Times, serif;color:#fff !important;background:#cc0033 !important;border:none;padding:4px 8px;}
.cssbtn {margin:2px;font:1em Georgia, "Times New Roman", Times, serif;color:#fff !important;background:#cc0033 !important;border:none;padding:2px;}
.savebtn:hover, .cssbtn:hover, .savebtn:focus, .cssbtn:focus {background:#878787 !important;}
.clear {clear:both;}
</style>
<?php } } function rgb_admin() {
	global $wpdb;
	$update = rgbOptions::rgb_update();
	$bg_image = get_option('rgb_bg_image');
	$bg_files = rgbFunctions::files_scan(TEMPLATEPATH . '/images/backgrounds/',array('gif','jpeg','jpg','png'),2);
	$bg_repeat = get_option('rgb_bg_repeat');
?>
<?php if(isset($_POST['submit'])) { ?>

<div id="message2" class="updated fade">
  <p>
    <?php _e('Options have been updated.','rgb'); ?>
  </p>
</div>
<?php } ?>
<div class="wrap">
  <h2>
    <?php _e('Theme Options','rgb'); ?>
  </h2>
  <p style="margin-left:5px;"><small><?php printf(__('You can always get the latest version <a href="http://xuyiyang.com/wordpress-themes/rgb/">here</a>.','rgb')) ?></small></p>
  <div class="rgbcontainer">
    <form name="dofollow" action="" method="post">
      <input type="hidden" name="action" value="<?php echo attribute_escape($update); ?>" />
      <input type="hidden" name="page_options" value="'dofollow_timeout'" />
      <p>
        <input class="savebtn" type="submit" name="submit" value="<?php echo attribute_escape(__('Update Options &raquo;','rgb')); ?>" />
      </p>
      <br class="clear" />
      <h3>
        <?php _e('Custom Styles','rgb'); ?>
      </h3>
      <div class="rgboptions">
        <div style="padding:0 5px;margin:5px;clear:both;">
          <h4>
            <?php _e('Color Scheme','rgb'); ?>
          </h4>
          <div id="rgbbgcolor" style="background:<?php echo rgb_bgcolor(); ?>;">
            <div id="rgbheaderbgcolor" style="background:<?php echo rgb_headerbgcolor(); ?>;"></div>
            <div id="rgbcontentcolor" style="background:<?php echo rgb_contentcolor(); ?>">
              <div id="rgbmain">
                <p id="rgbfontcolor" style="color:<?php echo rgb_fontcolor(); ?>;">
                  <?php _e('Just click the buttons below and pick up your desirable colors for the text and the backgrounds from the colorpicker, or use the "Advanced" button to input the color codes directly.','rgb'); ?>
                </p>
                <p id="rgblinkcolor" style="color:<?php echo rgb_linkcolor(); ?>;">
                  <?php _e('Link Color','rgb'); ?>
                </p>
                <p id="rgbhovercolor" style="color:<?php echo rgb_hovercolor(); ?>;">
                  <?php _e('Link Hover Color','rgb'); ?>
                </p>
              </div>
            </div>
            <div id="rgbsidebg" style="background:<?php echo rgb_sidebg(); ?>;">
              <p id="rgbsidecolor" style="color:<?php echo rgb_sidecolor(); ?>;">
                <?php _e('Sidebar Text','rgb'); ?>
              </p>
            </div>
          </div>
          <br class="clear" />
          <input class="cssbtn" type="button" onclick="colorSelect(document.getElementById('fontcolor'),'pick1');return false;" name="pick1" id="pick1" value="<?php echo attribute_escape(__('Text','rgb')); ?>" />
          <input class="cssbtn" type="button" onclick="colorSelect(document.getElementById('linkcolor'),'pick2');return false;" name="pick2" id="pick2" value="<?php echo attribute_escape(__('Link','rgb')); ?>" />
          <input class="cssbtn" type="button" onclick="colorSelect(document.getElementById('hovercolor'),'pick3');return false;" name="pick3" id="pick3" value="<?php echo attribute_escape(__('Link Hover','rgb')); ?>" />
          <input class="cssbtn" type="button" onclick="colorSelect(document.getElementById('sidecolor'),'pick4');return false;" name="pick4" id="pick4" value="<?php echo attribute_escape(__('Sidebar Text','rgb')); ?>" />
          <input class="cssbtn" type="button" onclick="colorSelect(document.getElementById('headerbgcolor'),'pick5');return false;" name="pick5" id="pick5" value="<?php echo attribute_escape(__('Header Background','rgb')); ?>" />
          <input class="cssbtn" type="button" onclick="colorSelect(document.getElementById('bgcolor'),'pick6');return false;" name="pick6" id="pick6" value="<?php echo attribute_escape(__('Main Background','rgb')); ?>" />
          <input class="cssbtn" type="button" onclick="colorSelect(document.getElementById('contentcolor'),'pick7');return false;" name="pick7" id="pick7" value="<?php echo attribute_escape(__('Content Background','rgb')); ?>" />
          <input class="cssbtn" type="button" onclick="colorSelect(document.getElementById('sidebg'),'pick8');return false;" name="pick8" id="pick8" value="<?php echo attribute_escape(__('Sidebar Background','rgb')); ?>" />
          <input class="cssbtn" type="button" name="default" value="<?php echo attribute_escape(__('Defaults','rgb')); ?>" onclick="colorDefaults()" />
          <input class="cssbtn" type="button" value="<?php echo attribute_escape(__('Advanced &raquo;','rgb')); ?>" onclick="toggleAdvanced()" />
          <input type="hidden" name="fontcolor" id="fontcolor" value="<?php echo attribute_escape(get_option('rgb_fontcolor')); ?>" />
          <input type="hidden" name="linkcolor" id="linkcolor" value="<?php echo attribute_escape(get_option('rgb_linkcolor')); ?>" />
          <input type="hidden" name="hovercolor" id="hovercolor" value="<?php echo attribute_escape(get_option('rgb_hovercolor')); ?>" />
          <input type="hidden" name="sidecolor" id="sidecolor" value="<?php echo attribute_escape(get_option('rgb_sidecolor')); ?>" />
          <input type="hidden" name="headerbgcolor" id="headerbgcolor" value="<?php echo attribute_escape(get_option('rgb_headerbgcolor')); ?>" />
          <input type="hidden" name="bgcolor" id="bgcolor" value="<?php echo attribute_escape(get_option('rgb_bgcolor')); ?>" />
          <input type="hidden" name="contentcolor" id="contentcolor" value="<?php echo attribute_escape(get_option('rgb_contentcolor')); ?>" />
          <input type="hidden" name="sidebg" id="sidebg" value="<?php echo attribute_escape(get_option('rgb_sidebg')); ?>" />
          <div id="colorPickerDiv" style="z-index:100;background:#eee;border:1px solid #ccc;position:absolute;visibility:hidden;"></div>
          <div id="advanced" style="display:none;clear:both;">
            <label for="advfontcolor">
            <?php _e('Text:','rgb'); ?>
            </label>
            <input type="text" id="advfontcolor" onchange="advUpdate(this.value,'fontcolor')" value="<?php echo attribute_escape(get_option('rgb_fontcolor')); ?>" />
            <br />
            <label for="advlinkcolor">
            <?php _e('Link:','rgb'); ?>
            </label>
            <input type="text" id="advlinkcolor" onchange="advUpdate(this.value,'linkcolor')" value="<?php echo attribute_escape(get_option('rgb_linkcolor')); ?>" />
            <br />
            <label for="advhovercolor">
            <?php _e('Link Hover:','rgb'); ?>
            </label>
            <input type="text" id="advhovercolor" onchange="advUpdate(this.value,'hovercolor')" value="<?php echo attribute_escape(get_option('rgb_hovercolor')); ?>" />
            <br />
            <label for="advsidecolor">
            <?php _e('Sidebar Text:','rgb'); ?>
            </label>
            <input type="text" id="advsidecolor" onchange="advUpdate(this.value,'sidecolor')" value="<?php echo attribute_escape(get_option('rgb_sidecolor')); ?>" />
            <br />
            <label for="advheaderbgcolor">
            <?php _e('Header Background:','rgb'); ?>
            </label>
            <input type="text" id="advheaderbgcolor" onchange="advUpdate(this.value,'headerbgcolor')" value="<?php echo attribute_escape(get_option('rgb_headerbgcolor')); ?>" />
            <br />
            <label for="advbgcolor">
            <?php _e('Main Background:','rgb'); ?>
            </label>
            <input type="text" id="advbgcolor" onchange="advUpdate(this.value,'bgcolor')" value="<?php echo attribute_escape(get_option('rgb_bgcolor')); ?>" />
            <br />
            <label for="advcontentcolor">
            <?php _e('Content Background:','rgb'); ?>
            </label>
            <input type="text" id="advcontentcolor" onchange="advUpdate(this.value,'contentcolor')" value="<?php echo attribute_escape(get_option('rgb_contentcolor')); ?>" />
            <br />
            <label for="advsidebg">
            <?php _e('Sidebar Background:','rgb'); ?>
            </label>
            <input type="text" id="advsidebg" onchange="advUpdate(this.value,'sidebg')" value="<?php echo attribute_escape(get_option('rgb_sidebg')); ?>" />
          </div>
        </div>
        <div style="padding:0 5px;margin:20px 5px 10px 5px;clear:both;">
          <h4>
            <?php _e('Background Images','rgb'); ?>
          </h4>
          <select id="bg_file" name="bg_file">
            <option value="" <?php selected($bg_image, ''); ?>>
            <?php _e('No Image','rgb'); ?>
            </option>
            <?php foreach($bg_files as $bg_file) { ?>
            <option value="<?php echo attribute_escape($bg_file); ?>" <?php selected($bg_image, $bg_file); ?>><?php echo($bg_file); ?></option>
            <?php } ?>
          </select>
          <select id="bg_repeat" name="bg_repeat">
            <option value="" <?php selected($bg_repeat,''); ?>>
            <?php _e('repeat','rgb'); ?>
            </option>
            <option value="<?php echo attribute_escape('no-repeat'); ?>" <?php selected($bg_repeat,'no-repeat'); ?>>
            <?php _e('no-repeat','rgb'); ?>
            </option>
            <option value="<?php echo attribute_escape('repeat-x'); ?>" <?php selected($bg_repeat,'repeat-x'); ?>>
            <?php _e('repeat-x','rgb'); ?>
            </option>
            <option value="<?php echo attribute_escape('repeat-y'); ?>" <?php selected($bg_repeat,'repeat-y'); ?>>
            <?php _e('repeat-y','rgb'); ?>
            </option>
          </select>
          <p><small>
            <?php _e('Upload the pictures to the folder "/images/backgrounds/" and selcet one as background image.','rgb');?>
            </small></p>
        </div>
        <br class="clear" />
      </div>
      <span style="float:right">
      <input style='margin:2px 0;font:1.1 Georgia, "Times New Roman", Times, serif;color:#fff !important;background:#cc0033 !important;border:none;padding:4px;' type="button" value="<?php _e('More Options','rgb'); ?> &raquo;" onclick="toggleMisc()" />
      </span>
      <h3>
        <?php _e('Miscellaneous','rgb'); ?>
      </h3>
      <div class="rgboptions">
        <div class="floatleft">
          <h4>
            <?php _e('Sidebar','rgb'); ?>
          </h4>
          <p>
            <input name="shelf" id="shelf" type="checkbox" value="1" <?php checked('1',get_option('rgb_shelf')); ?> />
            <label for="shelf">
            <?php _e('Enable Thickbox','rgb'); ?>
            </label>
          <p><small>
            <?php _e('Enable <a href="http://jquery.com/demo/thickbox/">Thickbox</a> on your sidebar and you can use widgets to arrange the items.','rgb');?>
            </small></p>
          <br />
          <input name="uitabs" id="uitabs" type="checkbox" value="1" <?php checked('1',get_option('rgb_uitabs')); ?> />
          <label for="uitabs">
          <?php _e('Enable jQuery UI Tabs','rgb'); ?>
          </label>
          <p><small>
            <?php _e('Enable <a href="http://docs.jquery.com/UI/Tabs">jQuery UI Tabs</a> on your sidebar.<br/><strong>Note:</strong> Items on the tabs do not support widgets, so you have to edit the code in sidebar.php by yourself.','rgb');?>
            </small></p>
          </p>
        </div>
        <div class="floatleft">
          <h4>
            <?php _e('Reverse Comments','rgb'); ?>
          </h4>
          <p>
            <input name="cmt_text" id="cmt_text" type="checkbox" value="1" <?php checked('1',get_option('rgb_cmt_text')); ?> />
            <label for="cmt_text">
            <?php _e('Reverse Comments','rgb'); ?>
            </label>
          <p><small>
            <?php _e('Display the comments in reverse order (latest on top). Idea from <a href="http://sudarmuthu.com/wordpress/reverse-comments">Simple Reverse Comments</a>. Thanks to <a href="http://sudarmuthu.com/">Sudar</a>.','rgb');?>
            </small></p>
          </p>
        </div>
        <div class="floatleft">
          <h4>
            <?php _e('Feed Address','rgb'); ?>
          </h4>
          <p>
            <input type="text" style="width:300px;" name="rss" value="<?php echo attribute_escape(get_option('rgb_rss')); ?>" />
          </p>
          <p><small>
            <?php _e('Use your burned feed to replace the default RSS 2.0. For example: http://feeds.feedburner.com/yourfeed','rgb'); ?>
            </small></p>
        </div>
        <div id="togglemisc" style="display:none;">
          <div class="floatleft">
            <h4>
              <?php _e('Navigations','rgb'); ?>
            </h4>
            <p>
              <label for="hidepages">
              <?php _e('Hide Certain Pages','rgb'); ?>
              </label>
              <input type="text" style="width:64px;" id="hidepages" name="hidepages" value="<?php echo attribute_escape(get_option('rgb_hidepages')); ?>" />
            </p>
            <p><small>
              <?php _e('Fill the blank with the Page IDs to exclude certain pages from the navigation bar.<br />Separate the Page IDs with commas: 1, 2.','rgb'); ?>
              </small></p>
            <br class="clear" />
          </div>
          <div class="floatleft">
            <h4>
              <?php _e('Header Size','rgb'); ?>
            </h4>
            <p>
              <label for="headerheight">
              <?php _e('Header Height','rgb'); ?>
              </label>
              <input type="text" style="width:32px;" id="headerheight" name="headerheight" value="<?php echo attribute_escape(get_option('rgb_headerheight')); ?>" />
              px. <br />
              <label for="headerwidth">
              <?php _e('Header Width','rgb'); ?>
              </label>
              <input type="text" style="width:32px;" id="headerwidth" name="headerwidth" value="<?php echo attribute_escape(get_option('rgb_headerwidth')); ?>" />
              px.<br />
            </p>
            <p> <small>
              <?php _e('Set the size of the header to suit your requirements when you <a href="themes.php?page=custom-header">upload an image</a>. Leave blank for the default setting.','rgb'); ?>
              </small> </p>
          </div>
        </div>
        <br class="clear" />
      </div>
      <p>
        <input class="savebtn" type="submit" name="submit" value="<?php echo attribute_escape(__('Update Options &raquo;','rgb')); ?>" />
      </p>
    </form>
    <h3>
      <?php _e('Donate','rgb'); ?>
    </h3>
    <p><?php printf(__('Consider make a donation with <a href="http://www.paypal.com">Paypal</a> to keep the project going. Any and all donations are sincerely appreciated. Thanks.','rgb')) ?></p>
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
      <p>
        <input type="hidden" name="cmd" value="_s-xclick" />
        <input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but21.gif" style="border:0;" name="submit" alt="Make payments with PayPal - it's fast, free and secure!" />
        <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----" />
      </p>
    </form>
    <h3>
      <?php _e('Uninstall','rgb'); ?>
    </h3>
    <p><?php printf(__('Press the uninstall button to clean things up in the database. You will be redirected to the <a href="themes.php">Themes admin interface</a>. <br />This may not remove your settings of custom image header,you can restore original header in <a href="themes.php?page=custom-header">this page</a>.','rgb')) ?></p>
    <form action="" method="post">
      <p>
        <input class="savebtn" name="uninstall" id="uninstall" type="submit" value="<?php echo attribute_escape(__('Uninstall Theme &raquo;','rgb')); ?>" />
      </p>
    </form>
    <br class="clear" />
  </div>
</div>
<?php  } 

// Custom Image Header Functions
define('HEADER_TEXTCOLOR','FFFFFF');
define('HEADER_IMAGE',''); // %s is theme dir uri
if (get_option('rgb_headerheight') == "") { define('HEADER_IMAGE_HEIGHT',160);
} else {
define('HEADER_IMAGE_HEIGHT',get_option('rgb_headerheight'));
}
if (get_option('rgb_headerwidth') == "") { define('HEADER_IMAGE_WIDTH',940);
} else {
define('HEADER_IMAGE_WIDTH',get_option('rgb_headerwidth'));
}

function custom_css() { // Custom CSS
?>
<style type="text/css">
body {
color:<?php echo rgb_fontcolor(); ?>;
background:<?php echo rgb_bgimage(); ?> <?php echo rgb_bgcolor(); ?>;
}
a, a:link, a:active, a:visited {
color:<?php echo rgb_linkcolor(); ?>;
}
a:hover {
color:<?php echo rgb_hovercolor(); ?>;
}
h1, h2, h3, h4, .entry-header a,.entry-header a:hover,.entry-footer a {
color:<?php echo rgb_fontcolor(); ?>;
}
#headerimg {
height:<?php echo HEADER_IMAGE_HEIGHT; ?>px;
background:url(<?php header_image() ?>) repeat top center <?php echo rgb_headerbgcolor();?>;
}
<?php if (get_header_textcolor()=='blank' ) { ?>
#header h1, .description {
display:none;
}
<?php } else { ?>
#header h1 a, .description {
color:#<?php header_textcolor() ?>;
}
<?php } ?>
.entry-date {
color:<?php echo rgb_contentcolor();?>;
background:<?php echo rgb_linkcolor();?>;
}
.entry-cmt {
border-right:8px solid <?php echo rgb_linkcolor();?>;
}
#primary-content {
background-color:<?php echo rgb_contentcolor();?>;
}
#sidebar {
color:<?php echo rgb_sidecolor();?>;
background-color:<?php echo rgb_sidebg();?>;
}
#sidebar .tabs li a, #sidebar .tabs li a:link, #sidebar .tabs li a:visited {
color:<?php echo rgb_hovercolor();?>;
}
#sidebar .tabs li a:hover {
color:<?php echo rgb_linkcolor();?>;
}
#footer {
background:<?php echo rgb_headerbgcolor();?>;
}
<?php if(get_bloginfo('language')=='zh-CN') {?>
.entry-footer, .entry-date, .comment-footer {
font-size:.8em;
}
<?php } else { ?>
.entry-footer, .entry-date, .comment-footer {
font-size:.7em;
}
<?php } ?>
#footer {
border-left:8px solid <?php echo rgb_linkcolor();?>;
border-right:8px solid <?php echo rgb_linkcolor();?>;
}
</style>
<?php }
function admin_header_style() { // Styles for options page
?>
<style type="text/css">
#headimg {
background-image:url(<?php header_image() ?>);
background-repeat:repeat !important;
background-color:<?php echo rgb_headerbgcolor();?>;
height:<?php echo HEADER_IMAGE_HEIGHT; ?>px;
width:<?php echo HEADER_IMAGE_WIDTH;?>px;
margin:0 0 10px;
}
#headimg h1 {
font-family:"Trebuchet MS", "Tahoma", sans-serif;
font-size:2em;
text-align:left;
margin:0;
padding:33px 0 0 20px;
text-transform:uppercase;
}
#headimg h1 a {
color:#<?php header_textcolor() ?>;
text-decoration:none;
border-bottom:none;
}
#headimg #desc {
color:#<?php header_textcolor() ?>;
text-align:left;
padding:5px 0 5px 22px;
font-size:.9em;
}
<?php if ('blank' == get_header_textcolor()) { ?>
#headimg h1, #headimg #desc {
display:none;
}
#headimg h1 a, #headimg #desc {
color:#<?php echo HEADER_TEXTCOLOR ?>;
}
<?php } ?>
</style>
<?php }

rgbOptions::rgb_init();
// Load Custom styles
add_custom_image_header('custom_css','admin_header_style');
?>