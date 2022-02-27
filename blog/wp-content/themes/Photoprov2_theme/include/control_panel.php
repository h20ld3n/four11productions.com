<?php 
	global $user_ID, $user_identity, $user_level; 
	if ( $user_ID ) : ?>

	<div class="cp">
		<ul>
			<li class="cphead">Control Panel</li>
		    <li><a class="dashboard" href="<?php bloginfo('url') ?>/wp-admin/">Dashboard</a></li>
		
		    <?php if ( $user_level >= 1 ) : ?>
		    <li><a href="<?php bloginfo('url') ?>/wp-admin/post-new.php">Add New Post</a></li>
		    <li><a href="<?php bloginfo('url') ?>/wp-admin/edit.php">Edit</a></li>
		    <?php endif // $user_level >= 1 ?>
		
		    <li><a href="<?php bloginfo('url') ?>/wp-admin/profile.php">Profile Options</a></li>
		    <li><a href="<?php bloginfo('url') ?>/wp-admin/edit-comments.php">Comments</a></li>
		    <li><a href="<?php bloginfo('url') ?>/wp-admin/themes.php">Themes</a></li>
		    <li><a href="<?php bloginfo('url') ?>/wp-admin/themes.php?page=functions.php">Photopro Option</a></li>

		</ul>
	        
	    <div class="clear"></div>
	</div>

<?php elseif ( get_option('users_can_register') ) : ?>

<?php endif // get_option('users_can_register') ?>

