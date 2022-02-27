<?php get_header(); ?>
<?php global $gpp; ?>
<!-- Makes for better pagination. -->
<?php if ( $paged < 1 ) { ?>

<?php if(!$gpp || $gpp['gpp_slider']<>"" ) { 
    get_template_part('slider');
} ?>

<?php if ( $gpp['gpp_slider_posts'] == 'true' ) { 
    get_template_part('/apps/slider-posts');
} ?>

<?php if(!$gpp || $gpp['gpp_featured']<>"" ) { 
    get_template_part('featured');
} ?>

<!-- End Better Pagination -->
<?php } ?>

<?php if ( $gpp['gpp_blog'] == 'true' ) { 
    get_template_part('/apps/blog');
} ?>

<?php if(!$gpp || $gpp['gpp_category_columns']<>"" ) { 
    get_template_part('category-stack');
} ?>

<!-- Begin Footer -->
<?php get_footer(); ?>