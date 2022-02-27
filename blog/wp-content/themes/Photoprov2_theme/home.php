<?php get_header(); ?>
<?php get_sidebar(); ?>

<div id="content">
	<!-- main image from custom field -->
	<div class="post" id="post-<?php the_ID(); ?>">
	
		<?php 	$blog = get_cat_id('blog'); 
				$q = "cat=-" . $blog; 
				query_posts($q.'&showposts=1'); ?> 
		    
		<?php if ( have_posts() ) : 
			while ( have_posts() ) : the_post(); ?>
		
				<div class="wrap">	
					<!-- 3 types of condition: 1. WP2.9+ featured images, 2. timthumb, 3. no images -->
					<?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) { // if has post thumbnail?>
						   <a class="tooltip" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_post_thumbnail('home-big', array('class' => 'post-thumbnail', 'alt' => ''.get_the_title().'')); ?></a> 
					
					<?php }	else if ( get_post_meta($post->ID, '_bigimg', true) ) { // backward compatibality for old wp less than 2.9 ?> 
						<a class="tooltip" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php bloginfo( 'template_directory' ); ?>/scripts/image.php/<?php the_ID(); ?>_big.jpg?width=700&amp;image=<?php echo Getbig($post->ID); ?>" alt="<?php the_title(); ?>" /></a>
						
					<?php } else { // if no image ?> 
						
						<a class="tooltip" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/no-image.jpg" alt="" /></a>
						
					<?php } ?> 
					
				</div><!-- .wrap -->
				
			<?php endwhile; ?>
		<?php else : ?>
		
			<h2>Not Found</h2>
			<p>Sorry, but you are looking for something that isn't here.</p>
			<?php include (TEMPLATEPATH . "/searchform.php"); ?>
		
		<?php endif; ?>
			
	</div><!-- .post -->

	<div id="jq" class="box">						
	<div class="carousel example-5">
		<?php 
		$blog = get_cat_id('blog');  		 
		$q = "cat=-" . $blog;  
		
		query_posts($q.'&showposts=30'); ?>  
		<ul>
		<?php if (have_posts()) : while (have_posts()) : the_post(); $loopcounter++; $key = Getbig($post->ID); ?> 
			<li>
				<?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) { ?>
					<a class="tooltip" href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail(); ?></a>
					
				<?php }  else if($key !== '') { ?>
					<a class="tooltip" href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><img src="<?php bloginfo( 'template_directory' ); ?>/scripts/image.php/<?php the_ID(); ?>.jpg?width=100&amp;height=70&amp;cropratio=1.42857:1&amp;image=<?php echo Getbig($post->ID); ?>" alt="<?php the_title(); ?>" /></a>
			
				<?php } else { ?>
						
					<a class="tooltip" href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><img src="<?php bloginfo( 'template_directory' ); ?>/images/thumb.jpg" alt="" /></a>
			
				<?php } ?>                      
			</li>
		<?php endwhile; else: ?>
		<?php endif; ?>
		</ul>
	</div>
	</div>	

</div><!-- content -->



<?php get_footer(); ?>