<?php if (!is_search()) {
		// Default search text
		$search_text = "Search";
	} else { global $s; $search_text = "$s"; }
?>
<div id="search">
	<form method="get" id="searchform" action="<?php echo home_url(); ?>/">
		<div>
			<input type="text" name="s" id="s" value="<?php echo esc_html($search_text, 1); ?>" onfocus="clearInput('s', '<?php echo esc_html($search_text, 1); ?>')" onblur="clearInput('s', '<?php echo esc_html($search_text, 1); ?>')" /> 
		</div>
	</form>
</div>
