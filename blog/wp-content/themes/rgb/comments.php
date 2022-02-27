	<?php // Do not delete these lines
				if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
					die ('Please do not load this page directly. Thanks!');
			
				if (!empty($post->post_password)) { // if there's a password
					if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
						?>
	
	<p class="alert">This post is password protected. Enter the password to view comments.</p>
	<?php
						return;
					}
				}
			?>
	<div id="comment-section">
	  <?php if ($comments) : ?>
	  <h4 id="comments" class="section-title"><?php printf(__('%1$s %2$s to &#8220;%3$s&#8221;','rgb'), '<span id="comments">' . get_comments_number() . '</span>', (1 == $post->comment_count) ? __('Response','rgb'): __('Responses','rgb'), the_title('', '', false)); ?></h4>
	  <hr />
	  <ol id="commentlist">
		<?php foreach ($comments as $comment) : ?>
		<li id="comment-<?php comment_ID(); ?>">
          <span class="gravatar"><?php /* Avatar support for wp 2.5 */ if ( function_exists('get_avatar') && get_option('show_avatars') ) { echo get_avatar( $comment, 32 ); } ?></span>
          <span class="comment-header"><a href="#comment-<?php comment_ID(); ?>" class="counter" title="<?php _e('Permanent Link to this Comment','rgb'); ?>"><?php echo $comment_index; ?></a><?php comment_author_link() ?></span>
		  <div class="comment-content">
			<?php comment_text() ?>
		  </div>
		  <div class="comment-footer"> <span class="metacmt">
			<?php _e('Comment on ','rgb') ?>
			<a href="#comment-<?php comment_ID() ?>" title="Permalink to Comment">
			<?php comment_date(__('M jS, Y','rgb')) ?>
			<?php _e(' at ','rgb') ?>
			<?php comment_time() ?>
			</a></span>&nbsp;&nbsp;
			<?php if ( $user_ID ) { edit_comment_link(__('Edit','rgb'),'<span class="metaedit">','</span>'); } ?>
		  </div>
		  <?php if ( ! $comment->comment_approved ): ?>
		  <p class="alert"> <strong>
			<?php _e('Your comment is awaiting moderation.','rgb'); ?>
			</strong> </p>
		  <?php endif; ?>
		</li>
		<?php endforeach; /* end for each comment */ ?>
	  </ol>
	  <!-- END #commentlist -->
	  <?php else : // this is displayed if there are no comments so far ?>
	  <?php if ('open' == $post->comment_status) : ?>
	  <!-- If comments are open, but there are no comments. -->
	  <ol id="commentlist">
		<li id="leavecomment">
		  <?php _e('No Comments','rgb'); ?>
		</li>
	  </ol>
	  <?php else : // comments are closed ?>
	  <!-- If comments are closed. -->
	  <p class="alert">
		<?php _e('Comments are currently closed.','rgb'); ?>
	  </p>
	  <?php endif; ?>
	  <!-- END .comments 1 -->
	  <?php endif; ?>
	  <?php if ('open' == $post->comment_status) : ?>
      	  <div id="postComment" <?php if(get_option('rgb_shelf') == 1) { ?>style="display:none;"<?php } ?>>
	  <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
	  <p class="alert"><?php printf(__('You must <a href="%s">login</a> to post a comment.','rgb'), get_option('siteurl') . '/wp-login.php?redirect_to=' . get_permalink()); ?></p>
	  <?php else : ?>
		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
		  <?php if ( $user_ID ) : ?>
		  <p class="alert"><?php printf(__('Logged in as %s.','rgb'), '<a href="' . get_option('siteurl') . '/wp-admin/profile.php">' . $user_identity . '</a>') ?><a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php _e('Log out of this account','rgb'); ?>">
			<?php _e('Logout','rgb'); ?>
			&raquo;</a></p>
          <?php elseif ($comment_author != "") : ?>
		  <p class="alert"><?php printf(__('Welcome back <strong>%s</strong>.','rgb'), $comment_author) ?></p>
		  <?php endif; ?>
		  <?php if ( !$user_ID ) : ?>
		  <p>
			<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
			<label for="author"><strong>
			<?php _e('Name','rgb'); ?>
			</strong>
			<?php if ( $req ): _e('(Required)','rgb'); endif; ?>
			</label>
		  </p>
		  <p>
			<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
			<label for="email"><strong>
			<?php _e('Mail','rgb'); ?>
			</strong>
			<?php _e('(Will not be published)','rgb'); ?>
			<?php if ( $req ): _e('(Required)','rgb'); endif; ?>
			</label>
		  </p>
		  <p>
			<input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
			<label for="url"><strong>
			<?php _e('Website','rgb'); ?>
			</strong></label>
		  </p>
		  <?php endif; ?>
		  <p>
			<textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea>
		  </p>
		  <p>
			<input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit Comment','rgb'); ?>" />
			<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
			<?php do_action('comment_form', $post->ID); ?>
		  </p>
		</form>

	  <?php endif; // If registration required and not logged in ?>	  </div>
	  <!-- END .comments #2 -->
	  <?php endif; // if you delete this the sky will fall on your head ?>
	  <?php if((get_option('rgb_shelf') == 1)&&('open' == $post->comment_status)) { ?>
	  <span class="thickboxbtn"><a href="#TB_inline?height=400&amp;width=450&amp;inlineId=postComment" id="respond" class="thickbox" title="<?php _e('Post Your Comment (Press Esc to Close)','rgb'); ?>">
	  <?php _e('Post your comment','rgb');  ?>
	  </a></span>
	  <?php } ?>
	  <div class="clear"></div>
	</div>
	<?php include (TEMPLATEPATH . '/navigation.php'); ?>
