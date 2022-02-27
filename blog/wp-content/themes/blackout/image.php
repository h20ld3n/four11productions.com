<?php


get_header();
?>

	<div id="main-content">

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="post" id="post-<?php the_ID(); ?>">
			<div class="title-background">
						<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
			</div>

			<div class="info-background">
			<small><?php the_time('F jS, Y') ?> at <?php the_time() ?> by <?php the_author() ?> </small>
			</div>

			<div class="entry">
				<p class="attachment"><a href="<?php echo wp_get_attachment_url($post->ID); ?>"><?php echo wp_get_attachment_image( $post->ID, 'medium' ); ?></a></p>
				<div class="caption"><?php if ( !empty($post->post_excerpt) ) the_excerpt(); // this is the "caption" ?></div>

				<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>

				<div class="browse>
					<div class="alignleft"><?php previous_image_link() ?></div>
					<div class="alignright"><?php next_image_link() ?></div>
				</div>
				<br class="clear" />

			<div class="postmetadata">

			Planted in <?php the_category(', ') ?>
				<div class="sep">
					Share! &#187; <img style="border:0;margin:0;padding:0;" src="<?php echo get_option('home'); ?>/wp-content/themes/CoolGreen/images/sharebuttons/gsa200m04.png" alt="" /><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink() ?>" target="_blank"><img style="border:0;margin:0;padding:0;" src="<?php echo get_option('home'); ?>/wp-content/themes/CoolGreen/images/sharebuttons/gsa201m04.png" alt="Add to Facebook" /></a><a href="http://digg.com/submit?phase=2&amp;url=<?php the_permalink() ?>&amp;title=<?php the_title(); ?>" target="_blank"><img style="border:0;margin:0;padding:0;" src="<?php echo get_option('home'); ?>/wp-content/themes/CoolGreen/images/sharebuttons/gsa202m04.png" alt="Add to Digg" /></a><a href="http://del.icio.us/post?url=<?php the_permalink() ?>&amp;title=<?php the_title(); ?>" target="_blank"><img style="border:0;margin:0;padding:0;" src="<?php echo get_option('home'); ?>/wp-content/themes/CoolGreen/images/sharebuttons/gsa203m04.png" alt="Add to Del.icio.us" /></a><a href="http://www.stumbleupon.com/submit?url=<?php the_permalink() ?>&amp;title=<?php the_title(); ?>" target="_blank"><img style="border:0;margin:0;padding:0;" src="<?php echo get_option('home'); ?>/wp-content/themes/CoolGreen/images/sharebuttons/gsa204m04.png" alt="Add to Stumbleupon" /></a><a href="http://reddit.com/submit?url=<?php the_permalink() ?>&amp;title=<?php the_title(); ?>" target="_blank"><img style="border:0;margin:0;padding:0;" src="<?php echo get_option('home'); ?>/wp-content/themes/CoolGreen/images/sharebuttons/gsa205m04.png" alt="Add to Reddit" /></a><a href="http://www.blinklist.com/index.php?Action=Blink/addblink.php&amp;Description=&amp;Url=<?php the_permalink() ?>&amp;Title=<?php the_title(); ?>" target="_blank"><img style="border:0;margin:0;padding:0;" src="<?php echo get_option('home'); ?>/wp-content/themes/CoolGreen/images/sharebuttons/gsa206m04.png" alt="Add to Blinklist" /></a><a href="http://ma.gnolia.com/bookmarklet/add?url=<?php the_permalink() ?>&amp;title=<?php the_title(); ?>" target="_blank"><img style="border:0;margin:0;padding:0;" src="<?php echo get_option('home'); ?>/wp-content/themes/CoolGreen/images/sharebuttons/gsa207m04.png" alt="Add to Ma.gnolia" /></a><a href="http://www.technorati.com/faves?add=<?php the_permalink() ?>" target="_blank"><img style="border:0;margin:0;padding:0;" src="<?php echo get_option('home'); ?>/wp-content/themes/CoolGreen/images/sharebuttons/gsa208m04.png" alt="Add to Technorati" /></a><a href="http://www.furl.net/storeIt.jsp?u=<?php the_permalink() ?>&amp;t=<?php the_title(); ?>" target="_blank"><img style="border:0;margin:0;padding:0;" src="<?php echo get_option('home'); ?>/wp-content/themes/CoolGreen/images/sharebuttons/gsa209m04.png" alt="Add to Furl" /></a><a href="http://www.newsvine.com/_wine/save?u=<?php the_permalink() ?>&amp;h=<?php the_title(); ?>" target="_blank"><img style="border:0;margin:0;padding:0;" src="<?php echo get_option('home'); ?>/wp-content/themes/CoolGreen/images/sharebuttons/gsa210m04.png" alt="Add to Newsvine" /></a><img style="border:0;margin:0;padding:0;" src="<?php echo get_option('home'); ?>/wp-content/themes/CoolGreen/images/sharebuttons/gsa211m04.png" alt="" />
				</div>
			</div>

			</div>

		</div>

	<?php comments_template(); ?>

	<?php endwhile; else: ?>

		<p>Sorry, no attachments matched your criteria.</p>

<?php endif; ?>

	</div>

<?php get_footer(); ?>
