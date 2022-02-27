<?php
/* This code retrieves all our admin options. */
global $options;
foreach ($options as $value) {
	if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>

<div id="sidebar">
	<?php if($p_aboutme == 'Yes') { ?>
		<div class="user">
			<div class="photo">
				<?php if($p_pic != "") { ?><img src="<?php echo $p_pic; ?>" alt="<?php echo $p_name; ?>" border="0"/><?php } ?>
			</div>
		
			<div class="detail">
				<ul>
					<?php if($p_name != "") { ?><li><h2><?php echo $p_name; ?> </h2></li><?php } ?>
					<?php if($p_location != "") { ?><li><?php echo $p_location; ?></li><?php } ?>
					<?php if($p_job != "") { ?><li><?php echo $p_job; ?></li><?php } ?>
					<?php if($p_email != "") { ?><li><?php echo $p_email; ?></li><?php } ?>
					<?php if($p_phone != "") { ?><li><?php echo $p_phone; ?></li><?php } ?>
					
				</ul>
				
				<?php if($p_name != "") { ?><p><?php if($p_about_detail != "") echo $p_about_detail; ?></p><?php } ?>
			</div>
		</div>
	<?php } ?>

  
<!-- category dropdown -->
	<div class="cat-link-box">
		<a id="clist" href="#" title="Category">Category</a> 
	</div>
	<div id="categorylist">
		<ul>
			 <?php wp_list_categories('&title_li='); ?>
		</ul>
	</div>    

<!-- searchform -->
	<div class="sform">
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>
	</div>
	
	<?php if($p_blog_widget == 'Yes') { ?>
		<div class="side_blog">
			<div class="t">Blog</div>
			<?php
			$blog = get_cat_id('blog');  
			$q = "cat=" . $blog . "&showposts=4"; 
			$my_query = new WP_Query($q);
			
			if ($my_query->have_posts()) : while ($my_query->have_posts()) :
			$my_query->the_post();
			$do_not_duplicate = $post->ID;
			?>
			 
			<div class="block2">
				<div class="comment">
				<?php comments_number('0', '1', '%' );?>
				</div>
				
				<div class="title">
					<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a><br />
					<small><?php the_time('F jS, Y') ?></small>
				</div>
			</div>
			<div class="clear"></div>
			 
			<?php endwhile; else: ?>
			<?php endif; ?>
		</div>	
	<?php } ?>

<ul>	
	<?php 	/* Widgetized sidebar, if you have the plugin installed. */
	if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
	
	<?php endif; ?>
</ul>
	
</div><!-- #sidebar -->

