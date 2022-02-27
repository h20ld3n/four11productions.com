<?php get_header(); ?>
<?php get_sidebar(); ?>
	
	<div id="single">
	<?php if (have_posts()) : ?>

		<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
		 
		<?php /* If this is a category archive */ if (is_category()) { ?>				
		<h2 class="archivetitle">Archive for the '<?php echo single_cat_title(); ?>' Category</h2>
		
		<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h2 class="archivetitle">Archive for <?php the_time('F jS, Y'); ?></h2>
		
		<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h2 class="archivetitle">Archive for <?php the_time('F, Y'); ?></h2>

		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h2 class="archivetitle">Archive for <?php the_time('Y'); ?></h2>
		
		<?php /* If this is a search */ } elseif (is_search()) { ?>
		<h2 class="archivetitle">Search Results</h2>
		
		<?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h2 class="archivetitle">Author Archive</h2>

		<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h2 class="archivetitle">Blog Archive</h2>

		<?php } ?>

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
			</div><!-- image_thumb -->
			
			<div class="archieve_detail">
				<ul>
					<li class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></li>
					<li><?php the_time('F jS, Y') ?></li>
					<li><?php comments_number('No comment', '1 comment', '% comments' );?></li>
				</ul>
			</div><!-- archieve_detail -->
		</div><!-- post2 -->

	<?php endwhile; ?>
			
		<div class="clear">&nbsp;</div>
		
		<div class="navigation">
			<ul>
				<li class="prev1"><?php previous_posts_link('Next &raquo;') ?></li>
				<li class="next1"><?php next_posts_link('&laquo; Previous') ?></li>
			</ul>
		</div><!-- navigation -->
	
	<?php else : ?>

		<h2>Not Found</h2>
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>
		
	<?php endif; ?>
		
	</div><!-- single -->

<?php get_footer(); ?>