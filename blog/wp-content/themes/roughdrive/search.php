<div id="wrapper">
<?php get_header(); ?>

<div id="content">
<?php if (have_posts()) : ?>

	<h2 class="pagetitle">Posts matching &#8220;<?php the_search_query(); ?>&#8221;.</h2>

	<?php while (have_posts()) : the_post(); ?>
        <div class="postwrap">
            <div class="leftmeta">
                <div class="month"><?php the_time('F jS')?></div>
                <div class="year"><?php the_time('Y')?></div>
                <div class="author">by <?php the_author_posts_link(); ?></div>
            </div>
            <div class="post" id="post-<?php the_ID(); ?>">
                <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

			<div class="entry">
				<?php the_content('read more &raquo;'); ?>
			</div>
			
                <p class="postmetadata">Posted at <?php the_time('g:i a'); ?> on <?php the_time('F jS, Y')?>. <?php edit_post_link('Edit this post.', '(', ')'); ?> <?php comments_popup_link('No comments... &#187;', 'One comment... &#187;', '% comments... &#187;'); ?>
                    <br />
                    <?php /* pages don't have categories or tags */ if (!is_page()) { ?> Categories: <?php the_category(', '); ?>. <?php /* } */?>
                    <?php if (get_the_tags()) the_tags('Tags: ', ', ', '.'); ?> <? } ?>
                </p>

            </div> <!-- post -->
        </div> <!-- postwrap -->
        <div class="clearer"></div>

	<?php endwhile; ?>

	<div class="navigation">
				<div class="goback"><?php next_posts_link('&laquo; read older articles'); ?></div>
				<div class="goforward"><?php previous_posts_link('read newer articles &raquo;'); ?></div>
                <div class="clearer"></div>
	</div>

<?php else : ?>

	<h2 class="pagetitle">No posts found.</h2>

	<p>Sorry, no posts matched &#8220;<?php the_search_query(); ?>&#8221;.</p>

<?php endif; ?>

</div>

<?php get_sidebar(); ?>

</div> <!-- wrapper end -->
<div class="clearer"></div>

<?php include(TEMPLATEPATH."/bottombar.php");?>
<div class="clearer">&nbsp;</div>

<?php get_footer(); ?>
