<?php get_header(); ?>
<div class="column span-15 first">
	<div class="content">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<!-- <div class="navigation small">
					<div class="alignleft"><?php previous_post_link('&laquo; %link') ?></div>
					<div class="alignright"><?php next_post_link('%link &raquo;') ?></div>
				</div> 
				<div style="padding-bottom: 15px;"></div> -->
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h2 class="entry-title"><a href="<?php echo get_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>"> <?php the_title(); ?></a></h2> 
			<p class="small">
<?php the_time('F jS, Y') ?>
				&nbsp;|&nbsp; 
<!-- by <?php the_author() ?> -->
				Published in 
<?php
							the_category(', ');
							if($post->comment_count > 0) { 
									echo ' &nbsp;|&nbsp; ';
									if($post->comment_count > 1) { 
										echo '<a href="#comments">' . $post->comment_count . ' Comments</a>';
									} else {
										echo '<a href="#comments">1 Comment</a>';
									}
							}
							edit_post_link('Edit', ' &nbsp;|&nbsp; ', '');
						?>
			</p>
			<div class="entry">
<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			</div>
		</div>
<?php comments_template(); ?>
<?php endwhile; else: ?>
		<p>
			Sorry, no posts matched your criteria. 
		</p>
<?php endif; ?>
	</div>
</div>
</div>
<div class="column span-8 prepend-1 last">
<hr class="space" />
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar-Single') ) : ?>
<?php endif; ?>
</div>
<hr />
<?php get_sidebar(); ?>
<?php get_footer(); ?>