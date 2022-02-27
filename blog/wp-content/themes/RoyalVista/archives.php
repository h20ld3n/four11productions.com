<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>

<div id="content" class="narrowcolumn">
<div class="post">
<h2>Archives by Month:</h2>
  <ul>
    <?php wp_get_archives('type=monthly'); ?>
  </ul>

<h2>Archives by Subject:</h2>
  <ul>
     <?php wp_list_cats(); ?>
  </ul>
                                <div class="spacer"></div>
</div>	</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
