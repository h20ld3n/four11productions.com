<?php global $gpp; ?>   
<?php
$featured_category_ID = $gpp['gpp_featured_cat'];
$featured_category = get_cat_name($featured_category_ID);
if($featured_category_ID=="0") {$featured_category = __('Latest','gpp_i18n');}

$blog_number = $gpp['gpp_blog_number'];
$blog_category_ID = $gpp['gpp_blog_cat'];
$blog_category = get_cat_name($blog_category_ID);
if($blog_category_ID=="0") {$blog_category = __('Blog','gpp_i18n');}

$featured_columns = $gpp['gpp_featured_columns'];
if($featured_columns=="true"){$col=3;$span="span-24 last";$noposts=9;}else{$col=2;$span="span-16 colborder home";$noposts=8;}
?>

<div class="<?php echo $span; ?>">

<h3 class="sub"><?php echo "$featured_category"; ?></h3>

	<?php $my_query = new WP_Query("cat='$featured_category_ID'&showposts=$noposts"); ?>
	<?php $featured = 0; ?>
	<?php while ($my_query->have_posts()) : $my_query->the_post(); $do_not_duplicate = $post->ID; $featured++; ?>
	
			<div class="span-8<?php if (($featured%$col)==0) { ?> last<?php } ?>">
			<div class="post-<?php the_ID(); ?> portfolio-image-wrapper">
					
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s','gpp_i18n'),the_title_attribute('echo=0')); ?>"><?php the_post_thumbnail('310x150'); ?></a>
			
			<div class="category-overlay"><?php if (the_category(', '))  the_category(); ?></div>
			<h6 class="title-overlay"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s','gpp_i18n'),the_title_attribute('echo=0')); ?>"><?php the_title() ?></a></h6>
			</div>
			<div class="clear"></div>
			</div>
			
	<?php endwhile; wp_reset_query(); ?>
</div>

<?php if($featured_columns!="true") { ?>
<div class="span-7 last">
<div id="sidebar">
<h3 class="sub"><?php _e('Latest Blog Entry','gpp_i18n'); ?></h3>
	<?php $my_query = new WP_Query("cat='$blog_category_ID'&showposts=1"); ?>
		<?php while ($my_query->have_posts()) : $my_query->the_post();
		$do_not_duplicate = $post->ID; ?>
			<h6><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s','gpp_i18n'),the_title_attribute('echo=0')); ?>"><?php the_title() ?></a></h6>
			<p class="byline"><?php the_time(__('M d, Y', 'gpp_i18n')); ?> | <?php comments_popup_link(__('Discuss','gpp_i18n'), __('1 Comment','gpp_i18n'), _n('% Comment', '% Comments', get_comments_number(), 'gpp_i18n')); ?></p>
			<?php the_excerpt(); ?>
			<?php endwhile; ?>
<h3 class="sub"><?php _e('Previous Blog Entries','gpp_i18n'); ?></h3>
	<?php $my_query = new WP_Query("cat='$blog_category_ID'&showposts=5&offset=1"); ?>
	<ul>
		<?php while ($my_query->have_posts()) : $my_query->the_post();
		$do_not_duplicate = $post->ID; ?>
			<li class="post" id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s','gpp_i18n'),the_title_attribute('echo=0')); ?>"><?php the_title() ?></a></li>
		<?php endwhile; ?>
	</ul>
</div>
	

</div>
<?php } ?>
<hr />