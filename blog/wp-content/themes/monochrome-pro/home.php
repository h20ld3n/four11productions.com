<?php get_header(); ?>
<!--START LEFT SIDE-->
<div id="feature" class="column span-15 first">
<!--BEGIN FEATURED POSTS--> 

 <div class="flexslider">

         
 <?php 
    // Grab Option Tree theme options 
    if (function_exists( 'get_option_tree') ) { $options = get_option_tree( 'option_tree'); }
    
    // Start Slider
    if (function_exists( 'get_option_tree') && get_option_tree( 'monochromepro_homepage',$options) == 'Upload images') { 
        
        $home_images = get_option_tree('monochromepro_home_images',$options,false,true); ?>
         
       <ul class="slides"> 
           <?php if($home_images <> '') { 
                
               foreach( $home_images as $image ) { ?>
        
            <li>
            <h4><a href="<?php if( $image['link'] <> '') { echo $image['link']; } else { echo "#"; } ?>"><?php echo $image['title']; ?></a></h4>
                       <img src="<?php echo $image['image']; ?>" alt="<?php echo $image['title']; ?>" width="575" height="350" /> 
            	
            	
            	<p><?php echo $image['description']; ?></p>
            </li>
           <?php }
           } ?>
         </ul>
         <hr class="space" />   
            
        <?php } else { 
                  
    
    if ( function_exists( 'get_option_tree') && get_option_tree( 'monochromepro_top_left') <> '') { 
    
        $dt_top_left_cat =  get_option_tree( 'monochromepro_top_left'); 
    
        } else {  
            
            $dt_top_left_cat = get_option('dt_top_left_cat'); }
            
    if ($dt_top_left_cat != '') {
        
    query_posts('cat='.$dt_top_left_cat.'&showposts=4');

    $cat_name = get_cat_name($dt_top_left_cat);
	
	?>
	
<ul class="slides">
<?php while (have_posts()) : the_post(); ?>
<li>
<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <span class="meta"><?php the_time('M j, Y') ?> | <?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?></span></h4>
<?php 
	if (has_post_thumbnail()) {
		the_post_thumbnail('575x350');
	} else {
		echo '<img src="'.get_bloginfo("template_url").'/images/slideshow.jpg"  alt="slide image" />';
	} ?>
	<?php the_excerpt(); ?>
</li>
<?php endwhile; ?>
</ul>
<hr class="space" />  
<?php 
    } 
}

?>
</div>
 
<!--BEGIN MIDDLE POSTS-->
	<div class="column span-7 append-1 news"> 
	    
	    
	<?php 
	if ( function_exists( 'get_option_tree') && get_option_tree( 'monochromepro_mid_left') <> '') { 
    
        $dt_mid_left_cat =  get_option_tree( 'monochromepro_mid_left'); 
    
        } else {  
            
            $dt_mid_left_cat = get_option('dt_mid_left_cat'); }
            
    if ($dt_mid_left_cat != '') {
        
    	$cat_name = get_cat_name($dt_mid_left_cat);
    	
        query_posts('cat='.$dt_mid_left_cat.'&showposts=1'); ?>

	<h6 class="category_head"><a href="<?php echo get_category_link($dt_mid_left_cat);?>"><?php echo $cat_name; ?></a></h6>
	<?php while (have_posts()) : the_post(); ?>
		<div class="post-<?php the_ID(); ?>">
			<h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
			<div class="meta"><?php the_time('M j, Y') ?> | <?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?></div>
			<?php the_excerpt(); ?>
		</div>
	<?php endwhile; ?>
	
	 <?php } ?> 
   	</div>  
	
   
	
	<div class="column span-7 last news">
    	<?php 
    	if ( function_exists( 'get_option_tree') && get_option_tree( 'monochromepro_mid_right') <> '') { 

            $dt_mid_right_cat =  get_option_tree( 'monochromepro_mid_right'); 

            } else {  

                $dt_mid_right_cat = get_option('dt_mid_right_cat'); }

        if ($dt_mid_right_cat != '') {

        	$cat_name = get_cat_name($dt_mid_right_cat);

            query_posts('cat='.$dt_mid_right_cat.'&showposts=1'); ?>
            
            
	<h6 class="category_head"><a href="<?php echo get_category_link($dt_mid_right_cat);?>"><?php echo $cat_name; ?></a></h6>
	<?php while (have_posts()) : the_post(); ?>
		<div class="post-<?php the_ID(); ?>">
			<h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
			<div class="meta"><?php the_time('M j, Y') ?> | <?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?></div>
			<?php the_excerpt(); ?>
		</div>
	<?php endwhile; ?> 
	<?php } ?>
	</div>
	<hr class="space" />
</div>
<!--END MIDDLE POSTS-->


<!--BEGIN RIGHT SIDE-->
<div class="column span-8 prepend-1 last news">
	<div id="home_right">
		<div class="news-block"> 
		    
		    <?php  if ( function_exists( 'get_option_tree') && get_option_tree( 'monochromepro_top_right') <> '') { 
		        
		   $dt_top_right_cat =  get_option_tree( 'monochromepro_top_right'); 
		   
		   } else { 
		       
		       $dt_top_right_cat =  get_option( 'dt_top_right_cat'); }
		   
		     if ($dt_top_right_cat != '') {

               	$cat_name = get_cat_name($dt_top_right_cat);
		                                       
		        query_posts('cat='.$dt_top_right_cat.'&showposts=3'); 
		  
			?>
			<h6 class="category_head"><a href="<?php echo get_category_link($dt_top_right_cat);?>"><?php echo $cat_name; ?></a></h6>
			<?php while (have_posts()) : the_post(); ?>
	<div class="column span-4 first">
		<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_post_thumbnail(); ?></a>
	</div>
	<div class="column span-4 last">
		<h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6> 
		<div class="meta"><?php the_time('M j, Y') ?> | <?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?></div>
		<?php the_excerpt(); ?>
	</div> 
   
<hr />
<?php endwhile; ?> 
<?php } ?>
	</div> 
	
<!-- ABOUT BOX -->
<div class="box">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar-Home') ) : ?>
<?php endif; ?>
</div>
</div>
</div>
<hr class="space" />
<!--END RIGHT SIDE-->   


<!-- BOTTOM LEFT FIVE CATEGORY LISTINGS -->
<div id="gray_bg" class="five_posts">
    
<?php $i = 0; ?> 
<?php 
    
    if (function_exists( 'get_option_tree') && get_option_tree( 'monochromepro_bottom_1') <> '') { 
        $dt_bot_1st_cat = get_option_tree( 'monochromepro_bottom_1'); 
        } else { 
            $dt_bot_1st_cat = get_option('dt_bot_1st_cat'); } 

        if (function_exists( 'get_option_tree') && get_option_tree( 'monochromepro_bottom_2') <> '') { 
            $dt_bot_2nd_cat = get_option_tree( 'monochromepro_bottom_2'); 
            } else { 
                $dt_bot_2nd_cat = get_option('dt_bot_2nd_cat'); }    
                                                                    

        if (function_exists( 'get_option_tree') && get_option_tree( 'monochromepro_bottom_3') <> '') { 
            $dt_bot_3rd_cat = get_option_tree( 'monochromepro_bottom_3'); 
            } else { 
                $dt_bot_3rd_cat = get_option('dt_bot_3rd_cat'); }
                
        if (function_exists( 'get_option_tree') && get_option_tree( 'monochromepro_bottom_4') <> '') { 
            $dt_bot_4th_cat = get_option_tree( 'monochromepro_bottom_4'); 
            } else { 
                $dt_bot_4th_cat = get_option('dt_bot_4th_cat'); }
                
        if (function_exists( 'get_option_tree') && get_option_tree( 'monochromepro_bottom_5') <> '') { 
            $dt_bot_5th_cat = get_option_tree( 'monochromepro_bottom_5'); 
            } else { 
                $dt_bot_5th_cat = get_option('dt_bot_5th_cat'); }
 

$display_categories = array("$dt_bot_1st_cat","$dt_bot_2nd_cat","$dt_bot_3rd_cat","$dt_bot_4th_cat","$dt_bot_5th_cat");

foreach ($display_categories as $category) { $i++; ?> 

<div class="column span-4 post-<?php the_ID(); ?><?php if ($i < 5) { ?> append-1<?php  } ?><?php if ($i == 5) { ?> last<?php $i = 0; } ?>">   
        
<?php query_posts("showposts=1&cat=$category"); ?>

<?php while (have_posts()) : the_post(); ?>
    

    
<h6 class="category_head"><a href="<?php echo get_category_link($category);?>"><?php single_cat_title(); ?></a></h6>

<h6><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title() ?></a></h6>

<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_post_thumbnail(); ?></a>

<div class="excerpt_small"><?php the_excerpt(); ?></div>  

<p class="postmetadata"><?php the_time('M d, Y') ?> | <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p> 

<?php endwhile; ?>

<h6 class="category_more"><a href="<?php echo get_category_link($category);?>">More in <?php single_cat_title(); ?></a></h6>


<?php query_posts("showposts=5&offset=1&cat=$category"); ?>
<div class="more-posts-wrap">
<?php while (have_posts()) : the_post(); ?>
<span class="more-posts"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>" class="title"><?php the_title(); ?></a></span>
<?php endwhile; ?>
</div>

</div>
<?php } ?>
<div class="clear"></div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
