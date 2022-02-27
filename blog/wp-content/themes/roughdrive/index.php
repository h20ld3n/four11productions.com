<div id="wrapper">
<?php get_header(); ?>

<?php /* this is to deal with author pages */
if(isset($_GET['author_name'])) :
$curauth = get_userdatabylogin($author_name); // NOTE: 2.0 bug requires get_userdatabylogin(get_the_author_login());
else :
$curauth = get_userdata(intval($author));
endif;
?>

    <div id="content">

<?php if (have_posts()) : ?>

<!--?php if (!is_single() && !is_page()) echo "< h2 class=\"pagetitle\">";
    if (is_home()) {
    echo 'Latest posts';
    } elseif (is_category()) {
    echo 'Posts categorized &#8220;' . single_cat_title('', false) . '&#8221;';
    } elseif (is_tag()) {
    echo 'Posts tagged  &#8220;' . single_tag_title('', false) . '&#8221;';
    } elseif (is_author()) {
    echo 'Posts by ' . $curauth->nickname;
    } elseif (is_day()) {
    echo 'Posts from ' . get_the_time('F jS, Y');
    } elseif (is_month()) {
    echo 'Posts from ' . get_the_time('F Y');
    } elseif (is_year()) {
    echo 'Posts from ' . get_the_time('Y');
    } elseif (is_time()) {
    echo 'Posts from a particular time on ' . get_the_time('F, jS, Y');
    } ;
if (!is_single() && !is_page()) echo ".</h2>"; ?-->


<?php while (have_posts()) : the_post() ?>
    <?php if (is_single() || is_page()) { /* for single-item pages, make that thing big */ ?>
        <?php include(TEMPLATEPATH."/singlepost.php");?>
    <?php } else { /* otherwise, make it small since you'll have one of the headings above */ ?>
        <?php include(TEMPLATEPATH."/smallpost.php");?>
    <?php } ?>
<?php endwhile; ?>

<?php if (!is_single() && !is_page()) { ?>
        <div class="navigation">
            <div class="goback"><?php next_posts_link('&laquo; older'); ?></div>
            <div class="goforward"><?php previous_posts_link('newer &raquo;'); ?></div>
            <div class="clearer"></div>
        </div>
<?php } ?>
<?php else : ?>
        <h2>Not Found</h2>
        <p>Sorry, but you are looking for something that isn't here.</p>
<?php endif; ?>
    </div> <!-- content -->

<?php get_sidebar(); ?>

</div> <!-- wrapper end -->
<div class="clearer"></div>

<?php include(TEMPLATEPATH."/bottombar.php");?>
<div class="clearer">&nbsp;</div>

<?php get_footer(); ?>
