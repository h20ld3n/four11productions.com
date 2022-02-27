<?php 
/*
	Template Name: Navigation
*/ 
?>
<?php if (is_single()) { ?>
	<div class="navigation">
	  <div class="alignleft"><?php previous_post_link('&laquo; %link') ?></div>
	  <div class="alignright"><?php next_post_link('%link &raquo;') ?></div>
	  <div class="clear"></div>
	</div>
	<?php } else { ?>
	<div class="navigation">
	  <div class="alignleft"><?php next_posts_link('&laquo; '.__('Previous Entries','rgb').''); ?></div>
	  <div class="alignright"><?php previous_posts_link(''.__('Next Entries','rgb').' &raquo;'); ?></div>
	  <div class="clear"></div>
	</div>
<?php } ?>
