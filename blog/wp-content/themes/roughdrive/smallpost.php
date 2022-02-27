<div class="postwrap">
    <div class="leftmeta">
        <!--div class="date"><?php the_time('F jS')?> <?php the_time('Y')?></div>
        <div class="author">by <?php the_author_posts_link(); ?></div-->
    </div>

    <div class="post" id="post-<?php the_ID(); ?>">
        <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

        <div class="entry">
            <?php the_content('read more &raquo;'); ?>
        </div>

        <p class="postmetadata">Posted at <?php the_time('g:i a'); ?> on <?php the_time('F jS, Y')?>. <?php edit_post_link('Edit this post.', '(', ')'); ?> <?php comments_popup_link('No comments... &#187;', 'One comment... &#187;', '% comments... &#187;'); ?>
        <br />
            <?php if (!is_page()) { ?> Categories: <?php the_category(', '); ?>. <?php /* } */?>
            <?php if (get_the_tags()) the_tags('Tags: ', ', ', '.'); ?> <? } ?>
        </p>
    </div>
</div>
<div class="clearer"></div>

<?php comments_template(); ?>
