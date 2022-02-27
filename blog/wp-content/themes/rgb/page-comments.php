<?php
/*
Template Name: Page with Comments
*/
?>
<?php get_header(); ?>

		<div id="primary-content">
		  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		  <div class="entry" id="post-<?php the_ID(); ?>">
			<h2 class="pagetitle"><?php the_title(); ?></h2>
			<?php the_content(); ?>
			<?php link_pages('<p><strong>'.__('Pages:','rgb').'</strong> ', '</p>', 'number'); ?>
			<?php edit_post_link(__('Edit','rgb'), '<span class="metaedit">','</span>'); ?>
		  </div>
		  <?php endwhile; endif; ?>
		  <?php comments_template(); ?>
		</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
