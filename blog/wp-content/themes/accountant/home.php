<?php get_header() ?>



<div id="container">
<div id="content">

<?php if (have_posts()) : ?>
<?php query_posts('showposts=1'); ?>
<?php while (have_posts()) : the_post(); ?>
<div class="post" id="custom_frontpage_post">
<h1 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php printf(__('Permalink to %s', 'sandbox'), wp_specialchars(get_the_title(), 1)) ?>" rel="bookmark"><?php the_title() ?></a></h1>
<div class="entry-date"><?php the_time('d M, Y'); ?></div>
<div class="entry"><?php the_excerpt(); ?></div>
<div class="readmore"><a href="<?php the_permalink() ?>" title="<?php printf(__('Permalink to %s', 'sandbox'), wp_specialchars(get_the_title(), 1)) ?>" rel="bookmark">Read More</a></div>
</div>
<?php endwhile; endif;?>

	</div><!-- #content -->
</div><!-- #container -->
<?php get_sidebar() ?>
<?php get_footer() ?>