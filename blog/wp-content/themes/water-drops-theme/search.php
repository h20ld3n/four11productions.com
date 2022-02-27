<?php get_header();?>

<div id="content">
	<div class="left"><div class="padding">
		<?php get_sidebar(); ?>
	</div></div>
	<div class="right"><div class="padding">
		<?php if (have_posts()) : ?>
			
		<div style="margin: 10px;"><h3>Search Results</h3></div>

		<?php next_posts_link('&laquo; Previous Entries') ?>

		<?php previous_posts_link('Next Entries &raquo;') ?>

		<?php while (have_posts()) : the_post(); ?>
		


		<div class="title">
			<h1><a href="<?php the_permalink() ?>" target="_self"><?php the_title(); ?></a></h1>
			<h4><?php the_time('dS F Y'); ?></h4>
			<div class="clear"></div>
		</div>
		
				
		<?php the_content(__('(more...)')); ?>
		<div class="clear"></div>
		
		<div class="tags">TAGS: <?php the_tags('', ', ', ''); ?></div>
		<div class="permalink"><?php _e("Posted in:"); ?> <?php the_category(',') ?> | <?php edit_post_link(__('Edit')); ?><?php comments_popup_link(__('Comments (0)'), __('Comments (1)'), __('Comments (%)')); ?></div>
		
		
		<?php endwhile; ?>

		<div align="center">
			<?php next_posts_link('&laquo; Previous Entries') ?>

			<?php previous_posts_link('Next Entries &raquo;') ?>
		</div>	
		
		<?php else : ?>
	<br/>
			<div style="margin: 10px;"><h4>Nothing found. Try again.</h4></div>
			
			<?php/* include (TEMPLATEPATH . '/searchform.php'); */?>

		<div class="div1"></div>
		<?php endif; ?>

	</div></div>
	<div class="clear"></div>
</div>

<?php get_footer(); ?>
