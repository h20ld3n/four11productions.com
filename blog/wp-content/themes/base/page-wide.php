<?php
/*
Template Name: Wide Page
*/
?>
<?php get_header(); ?>

<section id="primary">
	<div id="content" role="main">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
			<?php gpp_base_page_hook(); ?>
		
		<?php endwhile; endif; ?>

	</div><!-- .content -->
</section><!-- #primary -->

<?php get_footer(); ?>