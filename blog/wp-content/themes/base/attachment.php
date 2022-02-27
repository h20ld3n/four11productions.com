<?php get_header(); ?>

	<section id="primary">
		<div id="content" role="main">

			<?php gpp_base_attachment_loop_hook(); ?>

			<?php gpp_base_navigation_hook(); ?>

			<?php comments_template(); ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_footer(); ?>
