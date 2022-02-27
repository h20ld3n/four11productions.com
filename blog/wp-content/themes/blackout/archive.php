<?php

get_header();
?>

		<div id="main-content">

		<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>
		<div <?php post_class() ?>>
				<div class="title-background">
					<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
					</div>

					<div class="info-background">
					<small><?php the_time('F jS, Y') ?> by <?php the_author() ?> </small>
				</div>

				<p>
				<?php the_content(); ?>
				</p>

				<div class="postmetadata">

					Posted in <?php the_category(', ') ?> | <?php the_tags(); ?> <?php edit_post_link('Edit', '', ''); ?>
					<div class="sep">
						<?php comments_popup_link('No Comments &#187; Leave one now!', '1 Comment &#187; Add another!', '% Comments &#187; Join the fun!'); ?>
					</div>
				</div>

			</div>

		<?php endwhile; ?>

		<div class="browse">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>
	<?php else :

		if ( is_category() ) { // If this is a category archive
			printf("<p>Sorry, but there aren't any posts in the %s category yet.</p>", single_cat_title('',false));
		} else if ( is_date() ) { // If this is a date archive
			echo("<p>Sorry, but there aren't any posts with this date.</p>");
		} else if ( is_author() ) { // If this is a category archive
			$userdata = get_userdatabylogin(get_query_var('author_name'));
			printf("<p>Sorry, but there aren't any posts by %s yet.</p>", $userdata->display_name);
		} else {
			echo("<p>No posts found.</p>");
		}


	endif;
?>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
