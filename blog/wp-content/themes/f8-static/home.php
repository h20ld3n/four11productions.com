<?php get_header(); ?>

<?php $i = 0; ?>

		<?php 
		$temp = $wp_query;
		$wp_query = NULL;
		$wp_query = new WP_Query();
		$wp_query->query('&paged='.$paged);
		while ($wp_query->have_posts()) : $wp_query->the_post(); $i++; ?>
		<div class="span-8 post-<?php the_ID(); ?><?php if ($i == 3) { ?> last<?php  } ?>">
			<h6 class="archive-header"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title() ?></a></h6>
			<?php get_the_image( array( 'custom_key' => array( 'thumbnail' ), 'default_size' => 'thumbnail', 'width' => '310', 'height' => '150' ) ); ?>	
			<?php the_excerpt(); ?>
			<p class="postmetadata"><?php the_time( get_option( 'date_format' ) ); ?> | <?php comments_popup_link('Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
		</div>
		<?php if ($i == 3) { ?><div class="archive-stack clear"></div><?php $i = 0; } ?>
		<?php endwhile; ?>
		<div class="clear"></div>
		<div class="navigation clearfix">
			<div><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div><div class="clear"></div>
		<?php $wp_query = NULL; $wp_query = $temp;?>
		




<?php get_template_part( 'bottom' ); ?>
<?php get_footer(); ?>