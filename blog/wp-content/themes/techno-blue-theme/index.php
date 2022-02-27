<?php get_header();?>

<div id="content">
	<div class="left">
		<?php get_sidebar(); ?>
	</div>
	<div class="right">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		
		
		<div class="title"><h1><a href="<?php the_permalink() ?>" target="_self"><?php the_title(); ?></a></h1><?php the_date('d/m/y','<h4>','</h4>'); ?><div class="clear"></div></div>
		
		<?php the_content(__('(more...)')); ?>
		<div class="clear"></div>
        <div class="tags1"><div class="tags2">Post tags: <?php the_tags('', ', ', ''); ?></div></div>
            
		<div class="permalink"><?php _e("Posted in:"); ?> <?php the_category(',') ?> | <?php edit_post_link(__('Edit')); ?> | <?php comments_popup_link(__('Comments (0)'), __('Comments (1)'), __('Comments (%)')); ?></div>
		        
		<?php comments_template(); // Get wp-comments.php template ?>
		
		<div class="div1"></div>
	<?php endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<div class="div1"></div>
	<?php endif; ?>

	<?php posts_nav_link(' &#8212; ', __('&laquo; Older Posts'), __('Newer Posts &raquo;')); ?>
	

	</div>
	<div class="clear"></div>
</div>

<?php get_footer(); ?>