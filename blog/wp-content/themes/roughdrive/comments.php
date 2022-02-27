<?php // Do not delete these lines
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
			?>

			<p class="nocomments">This post is password protected. Enter the password to view comments.</p>

			<?php
			return;
		}
	}
	
	/* you can start editing here */
?>

<?php if ($comments) : ?>
	<h3 id="comments"><?php comments_number('No comments.', 'One comment.', '% comments.'); ?></h3>

	<ol class="commentlist">
	<?php foreach ($comments as $comment) : ?>
		<li id="comment-<?php comment_ID(); ?>" class="commentlistitem">
			<?php if ($comment->comment_approved == '0') : ?>
				<p><em>Your comment is awaiting moderation.</em></p>
            <?php endif; ?>

            <div class="commentleft">
                <a href="<?php comment_author_url(); ?>"><?php echo get_avatar( $comment, 45 ); ?></a>
                <div class="commentauthor"><?php comment_author_link(); ?></div>
                <div class="commentdate"><a href="#comment-<?php comment_ID(); ?>" title="Permanent Link to this comment"><?php comment_date('F jS, Y'); ?></a></div>
            </div>
            <div class="commenttext">
                <?php comment_text(); ?>
                <br />
                <?php edit_comment_link('Edit this comment.', '(', ')'); ?>
            </div>
            <div class="clearer"></div>

		</li>
	<?php endforeach; /* end for each comment */ ?>
	</ol>

 <?php else : // this is displayed if there are no comments so far ?>
	<?php if ('open' == $post->comment_status) : // comments are open, but there aren't any ?>
	<?php else : // comments are closed ?>
	<?php endif; ?>
<?php endif; ?>

<?php if ('open' == $post->comment_status) : ?>

<h3 id="respond">Post a comment.</h3>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
<?php else : ?>

<div id="commentblock"><form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform"></div>

<?php if ( $user_ID ) : ?>

<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Logout &raquo;</a></p>

<?php else : ?>

<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
<label for="author"><small>Name <?php if ($req) echo "(required)"; ?></small></label></p>

<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
<label for="email"><small>Mail (will not be published) <?php if ($req) echo "(required)"; ?></small></label></p>

<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
<label for="url"><small>Website</small></label></p>

<?php endif; ?>

<p><textarea name="comment" id="comment" cols="65" rows="10" tabindex="4"></textarea></p>

<p><input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" />
<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
</p>
<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>
