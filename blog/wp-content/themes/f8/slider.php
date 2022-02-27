<!-- Begin slider --> 
<?php global $gpp; ?>   
<?php
$slider_cat_ID = $gpp['gpp_slider_cat'];
?>

<div id="slider-section">
	<div class="sliderGallery">
		<?php $slider = 0; $my_query = new WP_Query("showposts=-1&cat=$slider_cat_ID"); ?>
		<ul class="items">
			<?php while ($my_query->have_posts() && $slider<10) : $my_query->the_post(); $do_not_duplicate = $post->ID; $slider++ ?>
			<li class="post-<?php the_ID(); ?> slider-item">
				<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s','gpp_i18n'),the_title_attribute('echo=0')); ?>"><?php the_post_thumbnail('310x150'); ?><span class="slider-title"><?php the_title() ?></span></a>
			</li>
			<?php endwhile; wp_reset_query(); $slider=0 ?>
		</ul>
	</div>
</div>

<div id="slider-handle">
	<div id="content-slider"></div>
</div>