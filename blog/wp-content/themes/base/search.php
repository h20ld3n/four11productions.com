<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Base
 * @since Base 2.0
 */
get_header(); ?>

<section id="primary">
	<div id="content" role="main" class="<?php gpp_base_check_sidebar_hook(); ?>">

		<?php if ( have_posts() ) : ?>

			<h3><?php printf( __( 'Search Results for %s', 'gpp_base_lang' ), $s ); ?></h3>
				
			<?php gpp_base_search_loop_hook(); ?>
			<div class="clear"></div>
			
			<?php gpp_base_navigation_hook(); ?>

		<?php else : ?>

			<article id="post-0" class="post no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Nothing Found', 'gpp_base_lang' ); ?></h1>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'gpp_base_lang' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		<?php endif; ?>

	</div><!-- .content -->
</section><!-- #primary -->

<?php gpp_base_sidebar_hook(); ?>

<?php get_footer(); ?>