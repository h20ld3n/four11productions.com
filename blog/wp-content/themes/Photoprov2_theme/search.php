<?php get_header(); ?>
<?php get_sidebar(); ?>
	
	<div id="content">
	<?php if (have_posts()) : ?>

		<div class="search_box">
			<?php include (TEMPLATEPATH . '/sform2.php'); ?>
		</div>

		<h2 class="result_stats">Search Result for <?php /* Search Count */ $allsearch = &new WP_Query("s=$s&showposts=-1"); $key = wp_specialchars($s, 1); $count = $allsearch->post_count; _e(''); _e('<span class="search-terms">'); echo '<span class="key">'.$key.'</span>'; _e('</span>'); _e(' &#61; '); echo $count . ' '; wp_reset_query(); ?></h2>
		


		<?php while (have_posts()) : the_post(); $key = Getbig($post->ID); ?>	
		<div class="post2" id="post-<?php the_ID(); ?>">
			<div class="image_thumb">
			
				<?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) { ?>				
					<a class="tooltip" href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail(); ?></a>
								
				<?php } else if($key !== '') { ?>
				
		  			<a class="tooltip" href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><img src="<?php bloginfo( 'template_directory' ); ?>/scripts/image.php/<?php the_ID(); ?>.jpg?width=100&amp;height=70&amp;cropratio=1.42857:1&amp;image=<?php echo Getbig($post->ID); ?>" alt="<?php the_title(); ?>" /></a>
	
				<?php } else { ?>
	        			
					<?php if(in_category('blog')) { ?> 
						<a class="tooltip" href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><img src="<?php bloginfo( 'template_directory' ); ?>/images/blog.jpg" alt="" /></a>
					
					<?php } else { ?> 
						<a class="tooltip" href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><img src="<?php bloginfo( 'template_directory' ); ?>/images/thumb.jpg" alt="" /></a>
					
					<?php } ?>
		
				<?php } ?>
			
			</div>
			
			<div class="archieve_detail">
				<ul>
					<li class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></li>
					<li><?php the_time('F jS, Y') ?></li>
					<li><?php comments_number('No comment', '1 comment', '% comments' );?></li>
				</ul>
			</div>
			
		</div>	
	
		<?php endwhile; ?>

			<div class="clear">&nbsp;</div>
			
			<div class="navigation">
				<ul>
					<li class="prev1"><?php previous_posts_link('Next &raquo;') ?></li>
					<li class="next1"><?php next_posts_link('&laquo; Previous') ?></li>
				</ul>
			</div>
	
	<?php else : ?>

		<div class="search_box">
			<?php include (TEMPLATEPATH . '/sform2.php'); ?>
		</div>

		<h2 class="result_stats">Not Found</h2>
		<p class="result_stats">Ops, Sorry, but nothing matched your search criteria. Please try again with some different keywords.</p>
		<br/>
		

	<?php endif; ?>
		
	</div>



<?php get_footer(); ?>