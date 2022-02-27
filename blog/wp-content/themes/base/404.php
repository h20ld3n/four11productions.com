<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Base
 * @since Base 1.3
 */
 get_header(); ?>

	<div id="primary">
		<div id="content" role="main" class="<?php gpp_base_check_sidebar_hook(); ?>">
			<article id="post-0" class="post error404 not-found">
				<h2><?php _e( 'Whoops! Whatever you are looking for cannot be found.', 'gpp_base_lang' ); ?></h2>
			</article>
		</div><!--#content-->
	</div><!--#primary-->

<?php gpp_base_sidebar_hook(); ?>

<?php get_footer(); ?>