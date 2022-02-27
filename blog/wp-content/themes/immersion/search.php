<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Immersion
 * @since Immersion 1.0
 */

get_header(); ?>

		<section id="primary" class="<?php gpp_check_sidebar(); ?>">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'immersion' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header>

				<?php gpp_content_nav( 'nav-above' ); ?>
                <div id="content-inner">
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'search' ); ?>

				<?php endwhile; ?>
                </div><!-- #content-inner -->
				<?php gpp_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'immersion' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'immersion' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</section><!-- #primary -->

<?php get_footer(); ?>