<?php


get_header();
?>

	<div id="main-content">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<div class="title-background">
			<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
			</div>

			<div class="info-background">
			<small><?php the_time('F jS, Y') ?> at <?php the_time() ?> by <?php the_author() ?> </small>
			</div>

			<p>
				<?php the_content('Read the rest of this entry &raquo;'); ?>
			</p>
			<div class="postmetadata">

			Posted in <?php the_category(', ') ?> | <?php the_tags(); ?> <?php edit_post_link('Edit', '', ''); ?>

			</div>
		</div>


	<?php comments_template(); ?>

	<?php endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>

<?php endif; ?>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
