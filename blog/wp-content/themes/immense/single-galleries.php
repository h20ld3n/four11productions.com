<?php get_header(); ?>

<div id="content grid_<?php gpp_base_check_sidebar_hook(); ?>">
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<?php gpp_base_content(); ?>
	
		<?php $i = 0;
			$attachments =&get_children('post_type=attachment&post_mime_type=image&post_parent=' . $post->ID.'&order=DESC&orderby=menu_order ID' );		
			if ($attachments) {
				foreach ( $attachments as $attachment ) {
				
					$imageTitle = $attachment->post_title;
					$imageCaption = $attachment->post_excerpt;
					$imageDescription = $attachment->post_content;
					//echo $imageDescription."<br />"; ?>
					<div id="post<?php echo $i; ?>" class="eachposts">
						<h3><?php echo $imageTitle; ?></h3>
						<p><?php echo $imageDescription; ?></p>
					</div>
			<?php $i++;		
				}
			}		
			
	 endwhile; else :		
				gpp_base_not_found_hook();	
			endif;
	
	?> 
	
	<?php //gpp_base_single_post_hook(); ?>
	<?php //gpp_base_after_single_post_hook(); ?>
	<?php //gpp_base_comments(); ?>	
	
</div><!-- .content -->

<?php  //gpp_base_sidebar_hook(); ?>

<?php get_footer(); ?>