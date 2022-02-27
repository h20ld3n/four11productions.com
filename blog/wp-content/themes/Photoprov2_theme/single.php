<?php get_header(); ?>
<?php get_sidebar(); ?>

<?php
/* This code retrieves all our admin options. */
global $options;
foreach ($options as $value) {
	if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>
	
<div id="single">
			
  	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<div class="post" id="post-<?php the_ID(); ?>">
		
			<?php if (!in_category('blog')) { ?>
				<!-- 3 types of condition, 1. WP2.9+ featured images, 2. timthumb, 3. no images -->
				<div class="wrap">		
					<?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) { // if has post thumbnail ?>
						<?php the_post_thumbnail('home-big', array('class' => 'post-thumbnail', 'alt' => ''.get_the_title().'')); ?>
						
					<?php } else if ( get_post_meta($post->ID, '_bigimg', true) ) { // backward compatibality for old wp less than 2.9 ?> 
						<img src="<?php bloginfo( 'template_directory' ); ?>/scripts/image.php/<?php the_ID(); ?>_big.jpg?width=700&amp;image=<?php echo Getbig($post->ID); ?>" alt="<?php the_title(); ?>" />

					<?php } else { // if no image ?> 
						<img src="<?php bloginfo('template_directory'); ?>/images/no-image.jpg" alt="" />
					<?php } ?> 
				</div>	
			<?php } ?>		
				
				

			<div class="nav_fullview_wrap">
				<div class="left">
					<div class="navigation">
						<ul>
							<li class="prev1"><?php next_post_link('%link') ?></li> 
							<li class="next1"><?php previous_post_link('%link') ?></li>
						</ul>
					</div>						
				</div><!-- .left -->
				
				<div class="right">
					<?php if (!in_category('blog')) { ?>
					<!-- FULL SIZE image -->
					
						<?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) { // if has post thumbnail ?>
							<a rel="prettyPhoto" href="<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 9999,9999 ), false, '' );
echo $src[0];
 ?>" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/full_size.png" alt=""></a>
						<?php } else if ( get_post_meta($post->ID, '_bigimg', true) ) { ?> 
							<a rel="prettyPhoto" href="<?php echo Getbig($post->ID); ?>" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/full_size.png" alt=""></a>
						<?php } else { ?>
						<?php } ?> 
					<?php } ?>
				</div><!-- .right -->
			</div><!-- .nav_fullview_wrap -->			
			
			<!-- Post title -->
			
			<h2 class="single">
				<?php edit_post_link('[EDIT]'); ?>
				<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
			</h2>
							
			
			<?php if (in_category('blog')) { ?>
				<div class="sub_blog"><span>Blog</span></div>
			<?php } ?><!-- if post in blog category, print "Blog" under the title -->
		
			
			<?php if($p_detail == 'Yes') { ?>
				<!-- Picture detail's -->
				<?php if (!in_category('blog')) { ?>
					<div class="cam-detail">	
						<ul>
						<li><strong>Camera :</strong> <?php $key = get_post_meta($post->ID, 'camera_value', true); ?><?php if($key !== '') { ?><?php echo $key; ?><?php } else { echo 'N/A'; } ?></li>
						<li><strong>Shutter speed :</strong> <?php $key = get_post_meta($post->ID, 'shutter_value', true); ?><?php if($key !== '') { ?><?php echo $key; ?><?php } else { echo 'N/A'; } ?></li>
						<li><strong>Focal length :</strong> <?php $key = get_post_meta($post->ID, 'focal_value', true); ?><?php if($key !== '') { ?><?php echo $key; ?><?php } else { echo 'N/A'; } ?></li>
						<li><strong>Aperture value :</strong> <?php $key = get_post_meta($post->ID, 'aperture_value', true); ?><?php if($key !== '') { ?><?php echo $key; ?><?php } else { echo 'N/A'; } ?></li>
						<li><strong>ISO sensitivity :</strong> <?php $key = get_post_meta($post->ID, 'iso_value', true); ?><?php if($key !== '') { ?><?php echo $key; ?><?php } else { echo 'N/A'; } ?></li>
						</ul>
					</div>
					
					<div class="clear">&nbsp;</div>
				<?php } ?>				
			<?php } ?>
			
			<div class="the-content-detail">
				<?php the_content(''); ?>
			</div>		
			
			
			<!-- The page Content -->
			<div class="meta">
			
				<div class="cat">
					Category : <?php the_category(', ') ?> 
				</div>

				<div class="postdetail">			
					<ul>
					<li><a class="tooltip" title="<?php the_time('F jS, Y') ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/date.gif" alt="date" border="0"/></a></li>
					
					<li><a class="tooltip" title="by <?php the_author() ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/user.gif" alt="user" border="0"/></a></li>
					
					<li><a class="tooltip" title="<?php comments_number('No Response', '1 Response ', '% Responses' );?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/comment.gif" alt="comments" border="0"/></a></li>
					
					<li><a class="tooltip" href="feed:<?php bloginfo('rss2_url'); ?>" title="RSS"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/rss.gif" alt="rss" border="0"/></a></li>
					
					<li><a class="tooltip" href="<?php echo get_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title_attribute(); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/permalink.gif" alt="date" border="0"/></a></li>
					</ul> 
				</div>
			
			</div><!-- .meta -->
		</div>
	
	
		<?php if($p_comment == 'Yes') { ?>	
			<!-- Comment template -->	
			<?php comments_template(); ?>
		<?php } ?>
	
	<?php endwhile; else: ?>
	
	<p>Sorry, no posts matched your criteria.</p>
	
  <?php endif; ?>
	</div>

<!-- footer template -->
<?php get_footer(); ?>