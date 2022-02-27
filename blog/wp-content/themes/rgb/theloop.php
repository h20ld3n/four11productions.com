	<?php 
			/* 
				This is the loop, which fetches entries from your database.
				It is a delicate piece of machinery. Be gentle! 
				
				This structure originally comes from the Great K2 theme: http://getk2.com
			*/ 
	?>
	<?php /* Headlines for archives */ if ((!is_single() && !is_home()) || is_paged()) { ?>
	
	<h2 class="pagetitle">
	  <?php if (is_category()) {
					  printf(__('Archive for the \'%s\' Category', 'rgb'), single_cat_title('', false));
					} elseif (is_day()) {
					  printf(__('Archive for %s', 'rgb'), get_the_time(__('F jS, Y', 'rgb')));
					} elseif (is_month()) {
					  printf(__('Archive for %s', 'rgb'), get_the_time(__('F, Y', 'rgb')));
					} elseif (is_year()) {
					  printf(__('Archive for %s', 'rgb'), get_the_time(__('Y', 'rgb')));
					} elseif (is_search()) {
					  printf(__('Search Results for \'%s\'','rgb'), attribute_escape(stripslashes(get_query_var('s'))));
					} elseif (function_exists('is_tag') && is_tag()) {
				  	  if (function_exists('single_tag_title')) {
					  printf(__('Tag Archive for \'%s\'','rgb'), single_tag_title('', false));
					} else {
					  printf(__('Tag Archive for \'%s\'','rgb'), get_query_var('tag') );
					}
					} elseif (is_paged() && ($paged > 1)) {
					  printf(__('Archive Page %s', 'rgb'), $paged);
					}
				?>
	</h2>
	<?php } ?>
	<?php if (!is_single() && is_paged()) include (TEMPLATEPATH . '/navigation.php'); ?>
	<?php /* Start the loop */ if (have_posts()) { while (have_posts()) { the_post(); ?>
	<?php /* Permalink nav has to be inside loop */ if (is_single()) include (TEMPLATEPATH . '/navigation.php'); ?>
	<div id="post-<?php the_ID(); ?>" class="entry">
	  <h3 class="entry-header"><a href="<?php the_permalink() ?>" rel="bookmark" title='Permanent Link to "<?php strip_tags(the_title()); ?>"'>
		<?php the_title(); ?>
		</a></h3>
	  <?php comments_popup_link('<span class="entry-cmt"><span class="metacmt">'.__('Add a comment','rgb').'</span></span>', '<span class="entry-cmt"><span class="metacmt">1&nbsp;'.__('Comment','rgb').'</span></span>', '<span class="entry-cmt"><span class="metacmt">%&nbsp;'.__('Comments','rgb').'</span></span>', '', '<span class="entry-cmt"><span class="metacmt">'.__('Closed','rgb').'</span></span>'); ?>
	  <div class="entry-date"><?php printf(__('%1$s by %2$s ','rgb'), the_time(__(' F jS, Y','rgb')), get_the_author()) ?></div>
      <div class="entry-content">
	  <?php if (is_search() || (function_exists('is_tag') && is_tag())) {
						the_excerpt();
					} else {
						the_content(sprintf(__("Continue reading '%s'", 'rgb'), the_title('', 'rgb', false)));
					} ?>
	  <?php wp_link_pages('before=<p><strong>' . __('Pages:','rgb') . '</strong>&after=</p>'); ?>
	  <!-- <?php trackback_rdf(); ?> -->
      </div>
	  <?php if (is_home() || is_archive()) { ?>
	  <div class="entry-footer">
		<?php edit_post_link(__('Edit','rgb'),'<span class="metaedit">','</span>&nbsp;&nbsp;'); ?>
        <span class="metacat"><?php the_category(','); ?></span>
		<?php the_tags('<span class="metatag">', ', ', '.</span>'); ?>
	  </div>
	  <?php } elseif (is_single()) { ?>
	  <p class="intro">
		<?php _e('This entry is filed under ','rgb')?><?php the_category(', ') ?><?php _e('. ','rgb')?><?php the_tags(__(' And tagged with ','rgb'),', ','.') ?>
		<?php _e('You can follow any responses to this entry through ','rgb') ?><?php comments_rss_link(__('RSS 2.0','rgb')) ?><?php _e('. ','rgb')?>
		<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) { /* Both Comments and Pings are open */ ?>
		<?php _e('You can <a href="#respond">leave a response</a>, or ','rgb')?><a href="<?php trackback_url(true); ?>" rel="trackback"><?php _e('trackback','rgb')?></a><?php _e(' from your own site. ','rgb')?>
		<?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) { /* Only Pings are Open */ ?>
		<?php _e('Responses are currently closed, but you can ','rgb') ?><a href="<?php trackback_url(true); ?> " rel="trackback"><?php _e('trackback','rgb')?></a>		<?php _e(' from your own site. ','rgb') ?>
		<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) { /* Comments are open, Pings are not */ ?>
		<?php _e('You can skip to the end and leave a response. Pinging is currently not allowed. ','rgb') ?>
		<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) { /* Neither Comments, nor Pings are open */ ?>
		<?php _e('Both comments and pings are currently closed. ','rgb') ?>
		<?php } edit_post_link(__('Edit this entry.','rgb')); ?>
	  </p>
	  <?php } ?>
	</div>
	<?php  } /* End The Loop */ ?>
	<?php /* Insert Paged Navigation */ if (!is_single()) { include (TEMPLATEPATH.'/navigation.php'); } ?>
	<?php /* If there is nothing to loop */  } else { ?>
	<h2 class="center">
	  <?php _e('Not Found','rgb'); ?>
	</h2>
	<div class="entry">
	  <p>
		<?php _e('Oh no! You\'re looking for something which just isn\'t here! Fear not however, errors are to be expected, and luckily there are tools on the sidebar for you to use in your search for what you need.','rgb'); ?>
	  </p>
	</div>
	<?php /* End Loop Init  */ } ?>
