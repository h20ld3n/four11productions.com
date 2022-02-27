<!-- Begin Category Stack Section --> 
<?php global $gpp; ?>
<div class="app">
<div class="double-border"></div>
<div id="category-stack">
<div class="span-24 first last">
<?php
$cat_1 = $gpp['gpp_category_column_1'];
$cat_2 = $gpp['gpp_category_column_2'];
$cat_3 = $gpp['gpp_category_column_3'];
$cat_4 = $gpp['gpp_category_column_4'];
$cat_5 = $gpp['gpp_category_column_5'];

// set default categories
if($cat_1===FALSE || $cat_1=="0") {$cat_1 = "";}
if($cat_2===FALSE || $cat_2=="0") {$cat_2 = "";}
if($cat_3===FALSE || $cat_3=="0") {$cat_3 = "";}
if($cat_4===FALSE || $cat_4=="0") {$cat_4 = "";}
if($cat_5===FALSE || $cat_5=="0") {$cat_5 = "";}

$categories_stack = array();

if($cat_1 != "") {array_push($categories_stack,"$cat_1");}
if($cat_2 != "") {array_push($categories_stack,"$cat_2");}
if($cat_3 != "") {array_push($categories_stack,"$cat_3");}
if($cat_4 != "") {array_push($categories_stack,"$cat_4");}
if($cat_5 != "") {array_push($categories_stack,"$cat_5");}

$default_thumb1 = get_stylesheet_directory_uri() . "/images/default-cat-thumb1.jpg";
$default_thumb2 = get_stylesheet_directory_uri() . "/images/default-cat-thumb2.jpg";
$default_thumb3 = get_stylesheet_directory_uri() . "/images/default-cat-thumb3.jpg";
$default_thumb4 = get_stylesheet_directory_uri() . "/images/default-cat-thumb4.jpg";
$default_thumb5 = get_stylesheet_directory_uri() . "/images/default-cat-thumb5.jpg";

$default_thumbarr = array($default_thumb1,$default_thumb2,$default_thumb3,$default_thumb4,$default_thumb5);
$j = 0; // for default array

foreach ($categories_stack as $category) { ?>
<?php $cat_query = new WP_Query("posts_per_page=1&cat=$category"); ?>
<?php while ($cat_query->have_posts()) : $cat_query->the_post(); ?>
<h3 class="sub"><a href="<?php echo get_category_link($category);?>" title="<?php printf(__('More in %s','gpp_i18n'),get_category($category)->name); ?>"><?php echo get_category($category)->name; ?></a></h3>
<div class="span-16 colborder first">
	<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s','gpp_i18n'),the_title_attribute('echo=0')); ?>"><?php the_post_thumbnail('310x150'); ?></a>
	<h6><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s','gpp_i18n'),the_title_attribute('echo=0')); ?>"><?php the_title() ?></a></h6>
	<p class="byline"><?php the_time(__('M d, Y', 'gpp_i18n')) ?> | <a href="<?php the_permalink(); ?>"><?php _e('Read','gpp_i18n');?></a> | <?php comments_popup_link(__('Discuss','gpp_i18n'), __('1 Comment','gpp_i18n'), _n('% Comment', '% Comments', get_comments_number(), 'gpp_i18n')); ?></p>
	<p><?php echo substr(get_the_excerpt(),0,325); ?>&hellip;</p>
</div>
<?php endwhile; ?>

<?php query_posts("posts_per_page=5&offset=1&cat=$category"); ?>
<div class="span-7 more last">
<ul>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s','gpp_i18n'),the_title_attribute('echo=0')); ?>" class="title"><?php the_title(); ?></a></li>
<?php endwhile; ?>
</ul>
</div>
<div class="double-border"></div>
<?php } wp_reset_query(); ?>
</div>
</div>
</div>
<hr />