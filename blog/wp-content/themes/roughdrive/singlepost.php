<div class="singlepostwrap">
    <div class="leftmeta"></div>

    <h2 class="pagetitle"><?php the_title(); ?></h2>
    <div class="singlepost" id="post-<?php the_ID(); ?>">
        Written by <?php the_author_posts_link(); ?>. Posted at <?php the_time('g:i a'); ?> on <?php the_time('F jS, Y')?>
        
        <div class="entry">
            <?php the_content('read more &raquo;'); ?>
        </div>

        <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

        <p class="singlepostmetadata">
            <?php if (!is_page()) { ?> Categories: <?php the_category(', '); ?>. <?php /* } */?>
            <?php if (get_the_tags()) the_tags('Tags: ', ', ', '.'); ?> <? } ?>
            <?php edit_post_link('Edit this post.', '(', ')'); ?> <?php comments_popup_link('No comments... &#187;', 'One comment... &#187;', '% comments... &#187;'); ?>
        </p>
    </div>
</div>

<div class="clearer"></div>
<?php comments_template(); ?>
