<div id="piclist">

  <div class="news_slider itemslider">
  
                <a href="#" class="prev"><img src="<?php bloginfo('template_directory'); ?>/images/left.jpg" alt="Previous" title="Previous"/></a>
                <a href="#" class="next"><img src="<?php bloginfo('template_directory'); ?>/images/right.jpg" alt="Next" title="Next"/></a>
                <div class="news_items">
                    <div class="container fl">    
                        <!-- item begin -->
                        <div class="item"> 
		              	<?php 
						$blog = get_cat_id('blog');  		 
						$q = "cat=-" . $blog;  
						
						query_posts($q.'&showposts=30'); ?>  

						<?php if (have_posts()) : while (have_posts()) : the_post(); $loopcounter++; $key = Getbig($post->ID); ?> 
						 
							<?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) { ?>
								<a class="tooltip" href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail(); ?></a>
								
							<?php }  else if($key !== '') { ?>
								<a class="tooltip" href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><img src="<?php bloginfo( 'template_directory' ); ?>/scripts/image.php/<?php the_ID(); ?>.jpg?width=100&amp;height=70&amp;cropratio=1.42857:1&amp;image=<?php echo Getbig($post->ID); ?>" alt="<?php the_title(); ?>" /></a>
				
							<?php } else { ?>
				        			
								<a class="tooltip" href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><img src="<?php bloginfo( 'template_directory' ); ?>/images/thumb.jpg" alt="" /></a>
					
							<?php } ?>
                                                   
						<?php if ($loopcounter % 6 == 0) { ?>
						
						
						
                        </div>
						
                        <!-- item end -->
                        <!-- item begin -->
                        <div class="item fl">
                        <?php } ?>
                        <?php endwhile; else: ?>
                        <?php endif; ?>
                        </div>
                        <!-- item end -->
                    </div>
                </div>
            </div>
            
</div>