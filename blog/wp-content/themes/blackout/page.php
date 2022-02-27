<?php

get_header(); ?>

	<div id="main-content">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
		<div class="title-background">
			<h1><?php the_title(); ?></h1>
		</div>
			<p>
				<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

			</p>
		</div>
		<?php endwhile; endif; ?>


			<?php edit_post_link('Edit', '<div class="postmetadata">', '</div>'); ?>



			<?php comments_template(); ?>
		</div>




<?php get_sidebar(); ?>

<?php get_footer(); ?>