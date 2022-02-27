<?php function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
	<div id="div-comment-<?php comment_ID(); ?>">

    	<!--Gravatar-->
    	<?php if (function_exists('get_avatar')) { echo get_avatar($comment, $size='30', $default = '' ); } else {
    	$grav_url = "http://www.gravatar.com/avatar.php?gravatar_id=" . md5($email) . "&default=" . urlencode($default) . "&size=" . $size; echo " ";}?>
    	<!--Gravatar end-->

 		<div class="name"><?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?></div>

		<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','') ?>
		
		<span class="reply">
	 		<?php comment_reply_link(array_merge( $args, array('add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</span>

      	<?php if ($comment->comment_approved == '0') : ?>
         	<em><?php _e('Your comment is awaiting moderation.') ?></em>
         	<br />
     	 <?php endif; ?>
     	 
      	<?php comment_text() ?>
             
     </div><!-- #div-comment -->
	<!-- do not close li -->
<?php } ?>


<div id="commentssection">
	<?php	function list_pings($comment, $args, $depth) {
	   		$GLOBALS['comment'] = $comment;	?>
	   		         
	  		<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>
	<?php 	} ?>
	
	<h3 class="comment_header" id="comments" ><a href="#respond">Comments</a></h3>
	
	<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
	if ( post_password_required() ) { ?>
		<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
	<?php
		return;
	}
	
	// add a microid to all the comments
	function comment_add_microid($classes) {
		$c_email=get_comment_author_email();
		$c_url=get_comment_author_url();
		if (!empty($c_email) && !empty($c_url)) {
			$microid = 'microid-mailto+http:sha1:' . sha1(sha1('mailto:'.$c_email).sha1($c_url));
			$classes[] = $microid;
		}
		return $classes;	
	}
	add_filter('comment_class','comment_add_microid');
	
	
	// show the comments
	if ( have_comments() ) : ?>
	
	    <h3><?php comments_number('No Responses', '1 Response', '% Responses' );?> to <em><?php the_title(); ?></em></h3>
	    
	    <!-- print comments -->
		<ol class="commentlist" id="singlecomments">
			<?php wp_list_comments(array('type'=>'comment','avatar_size'=>36, 'reply_text'=>'Reply', 'callback'=>'mytheme_comment')); ?>
		</ol>
		
		<!-- print trackback -->
		<ol class="ping">
			<?php wp_list_comments(array('type'=>'pings', 'callback'=>'list_pings')); ?>
	    </ol>
		
		<!-- comment navigation -->
		<div class="navigation">
			<ul>
				<li class="prev1"><?php next_comments_link() ?></li> 
				<li class="next1"><?php previous_comments_link() ?></li>
			</ul>
		</div>
	    
	    
	<?php else : // this is displayed if there are no comments so far ?>
	
		<?php if ('open' == $post->comment_status) :
			// If comments are open, but there are no comments.
			 
		else : 
			// comments are closed 
		endif;
	endif; 
	
	if ('open' == $post-> comment_status) : 
	
	// show the form
	?>

</div><!-- commentssection -->


<div class="commentform">
	<div id="respond">
	
		<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
			<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
		
		<?php else : ?>
			
		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
		
			<div id="cancel-comment-reply">
				<small><?php cancel_comment_reply_link(); ?></small>
			</div>
		
		
			<?php if ( $user_ID ) : ?>
				<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>.
				<a href="<?php echo wp_logout_url(); ?>" title="Log out of this account">Logout &raquo;</a></p>
		
			<?php else : ?>
				<p><input class="form1" type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
				<label for="author">Name <?php if ($req) echo "(required)"; ?></label></p>
		
				<p><input class="form1" type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
				<label for="email">Mail (will not be published) <?php if ($req) echo "(required)"; ?></label></p>
		
				<p><input class="form1" type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
				<label for="url">Website</label></p>
		
			<?php endif; ?>
		
			<div>
				<?php comment_id_fields(); ?>
				<input type="hidden" name="redirect_to" value="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]); ?>" />
			</div>
		
			<p><textarea class="form1" name="comment" id="commentbox" cols="100%" rows="10" tabindex="4"></textarea></p>
		
			<?php if (get_option("comment_moderation") == "1") { ?>
				<p><small><strong>Please note:</strong> Comment moderation is enabled and may delay your comment. There is no need to resubmit your comment.</small></p>
			<?php } ?>
		
			<p><input class="form1" name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" /></p>
		
			<?php do_action('comment_form', $post->ID); ?>
		</form>
		
		<?php endif; ?>
	
	</div><!-- #respond -->
</div><!-- comment form -->


<?php endif;
// do not touch