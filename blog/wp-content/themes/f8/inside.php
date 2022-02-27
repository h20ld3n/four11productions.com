<!-- Begin more inside -->  
<?php global $gpp; ?>
<?php
	$featured_category_ID = $gpp['gpp_featured_cat'];
	$featured_category = get_cat_name($featured_category_ID);
	if($featured_category_ID=="0") {$featured_category = __('Latest','gpp_i18n');}
	$default_thumb = get_stylesheet_directory_uri() . "/images/default-thumb.jpg"; 
?>
<div id="inside-wrap">
<div class="pusher png_bg" id="slideToggle"><a class="more"><?php _e('View Work','gpp_i18n'); ?></a></div>
<div class="mover">
<?php if ( $gpp['gpp_welcome'] == 'true' || $gpp['gpp_welcome'] === FALSE) { 
     get_template_part('/apps/welcome');
} ?>

<!-- Begin portfolio -->
<h3 class="sub"><?php echo "$featured_category"; ?></h3>
<?php $my_query = new WP_Query("cat='$featured_category_ID'&showposts=9"); ?>
	<?php $inside = 0; ?>
	<?php while ($my_query->have_posts()) : $my_query->the_post();
		$do_not_duplicate = $post->ID; $inside++; ?>
			<div class="span-8<?php if ($inside == 3) { ?> last<?php $inside = 0; } ?>">
			<div class="post-<?php the_ID(); ?> portfolio-image-wrapper">
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s','gpp_i18n'),the_title_attribute('echo=0')); ?>"><?php the_post_thumbnail('310x150'); ?></a>
			<div class="category-overlay"><?php if (the_category(', '))  the_category(); ?></div>
			<h6 class="title-overlay"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s','gpp_i18n'),the_title_attribute('echo=0')); ?>"><?php the_title() ?></a></h6>
			</div>
			<div class="clear"></div>
			</div>
	<?php endwhile; wp_reset_query(); ?>
<div class="clear"></div>
</div>
</div>
<div class="clear"></div>