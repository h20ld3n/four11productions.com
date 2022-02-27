<?php

	$form = '<form method="get" id="searchform" action="' . get_option('home') . '/" >
	<div><input type="text" value="' . attribute_escape(apply_filters('the_search_query', get_search_query())) . '" name="s" id="s" />
	<input type="submit" id="searchsubmit" value="Search" />
	</div>
	</form>';

	echo apply_filters('get_search_form', $form);

?>