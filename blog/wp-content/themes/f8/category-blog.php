<?php get_header(); rewind_posts(); ?>
<div class="span-<?php if ($gpp['gpp_sidebar'] == 'true' || $gpp['gpp_sidebar'] === FALSE) { echo "15 colborder home"; } else { echo "24 last"; } ?>">

	<?php if (have_posts()) : ?>

 	  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
 	  <?php /* If this is a category archive */ if (is_category()) { ?>
		<h3 class="sub"><?php single_cat_title(); ?></h3>
 	  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<h3 class="sub"><?php printf(__('Posts Tagged &#8216;%s&#8217;','gpp_i18n'),single_tag_title('',false)); ?></h3>
 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h3 class="sub"><?php printf(__('Archive for %s','gpp_i18n'),get_the_time(__('F jS, Y','gpp_i18n'))); ?></h3>
 	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h3 class="sub"><?php printf(__('Archive for %s','gpp_i18n'),get_the_time(__('F, Y','gpp_i18n'))); ?></h3>
 	  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h3 class="sub"><?php printf(__('Archive for %s','gpp_i18n'),get_the_time(__('Y','gpp_i18n'))); ?></h3>
	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h3 class="sub"><?php _e('Author Archive','gpp_i18n'); ?></h3>
 	  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h3 class="sub"><?php _e('Blog Archive','gpp_i18n'); ?></h3>
 	  <?php } ?>
 	  
<div class="content">
<?php while (have_posts()) : the_post(); ?>
<div <?php if(function_exists('post_class')) : ?><?php post_class(); ?><?php else : ?>class="post post-<?php the_ID(); ?>"<?php endif; ?>>
<h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s','gpp_i18n'),the_title_attribute('echo=0')); ?>"><?php the_title() ?></a></h2>
<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s','gpp_i18n'),the_title_attribute('echo=0')); ?>"><?php the_post_thumbnail('310x150'); ?></a>
<?php the_excerpt(); ?>
<div class="clear"></div>
<p class="postmetadata"><?php the_time(__('M d, Y', 'gpp_i18n')); ?> | <?php _e('Categories:','gpp_i18n'); if (the_category(', '))  the_category(); ?> <?php if (get_the_tags()) the_tags(__('| Tags: ','gpp_i18n')); ?> | <?php comments_popup_link(__('Leave A Comment &#187;', 'gpp_i18n'), __('1 Comment &#187;', 'gpp_i18n'),_n('% Comment &#187;', '% Comments &#187;',get_comments_number (),'gpp_i18n')); ?> <?php edit_post_link(__('Edit','gpp_i18n'), '| ', ''); ?> </p>
</div>
<hr />
<?php endwhile; ?>

<div class="clear"></div>

<div class="nav-interior">
			<div class="prev"><?php next_posts_link(__('&laquo; Older Entries','gpp_i18n')); ?></div>
			<div class="next"><?php previous_posts_link(__('Newer Entries &raquo;','gpp_i18n')); ?></div>
		</div>
<div class="clear"></div>

	<?php else : ?>

		<h2 class="center"><?php _e('Not Found','gpp_i18n'); ?></h2>
		<?php get_search_form(); ?>

	<?php endif; ?>
</div>
</div>
		
<?php if ($gpp['gpp_sidebar'] == 'true' || $gpp['gpp_sidebar'] === FALSE) { get_sidebar(); } ?>

<!-- Begin Footer -->
<?php get_footer(); ?>