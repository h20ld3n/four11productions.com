<?php
$gpp = get_option( 'gpp_base_options' );

/*-----------------------------------------------------------------------------------*/
/* CONTENT - HOME WIDGETS */
/*-----------------------------------------------------------------------------------*/

function gpp_base_home_widgets() { 
	global $gpp, $showhomewidget, $homewidget;
	if ( isset( $gpp[ 'gpp_base_home_widget' ] ) )
		$homewidget = $gpp[ 'gpp_base_home_widget' ];
	if ( $homewidget == "true" || ( $gpp === FALSE && $showhomewidget == "true" ) ) {
?>
		<div id="homewidget">
			<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'Home' ) ) : ?>
			<?php endif; ?>	
		</div>
<?php } 
}
add_action( 'gpp_base_home_widgets_hook', 'gpp_base_home_widgets' );


/*-----------------------------------------------------------------------------------*/
/* CONTENT - SIDEBAR CHECK */
/*-----------------------------------------------------------------------------------*/

function gpp_base_check_sidebar() {
	global $gpp, $showsidebar, $sidebar;
	if ( isset( $gpp[ 'gpp_base_sidebar' ] ) )
		$sidebar = $gpp[ 'gpp_base_sidebar' ];
	if ( $sidebar == "true" || ( $gpp === FALSE && $showsidebar == "true" ) ) { echo "sidebar"; } else { echo "nosidebar"; }
}
add_action( 'gpp_base_check_sidebar_hook', 'gpp_base_check_sidebar' );


/*-----------------------------------------------------------------------------------*/
/* CONTENT - SIDEBAR */
/*-----------------------------------------------------------------------------------*/

function gpp_base_sidebar() {
	get_sidebar();
}
add_action( 'gpp_base_sidebar_hook', 'gpp_base_sidebar' );


/*-----------------------------------------------------------------------------------*/
/* CONTENT - LOOP WRAPPER */
/*-----------------------------------------------------------------------------------*/

function gpp_base_loop_wrapper() { ?>
	<section id="primary">
	<div id="content" role="main" class="<?php gpp_base_check_sidebar_hook(); ?>">
	<?php				
		// action hook creating the index loop
	    gpp_base_index_loop_hook();
				
		// create the navigation above the content
	    gpp_base_navigation_hook();
	?>
	</div>
	</section>
<?php }
add_action( 'gpp_base_loop_hook', 'gpp_base_loop_wrapper' );


/*-----------------------------------------------------------------------------------*/
/* CONTENT - NAVIGATING POSTS */
/*-----------------------------------------------------------------------------------*/

function gpp_base_navigation() {
		global $max_pages;
		
		if ( is_attachment() ) { ?>
			<div class="navigation">
			<div class="nav-previous"><?php previous_image_link( false ); ?></div>
			<div class="nav-next"><?php next_image_link( false ); ?></div>
			<div class="clear"></div>
		</div><!-- .navigation -->
<?php
		} elseif ( is_single() ) {
		
?>
		<div  class="navigation">
				<div class="nav-previous"><?php gpp_base_previous_post_link(); ?></div>
				<div class="nav-next"><?php gpp_base_next_post_link(); ?></div>
				<div class="clear"></div>
			</div>
		
		<?php } else { ?>
			<div  class="navigation">                 
				<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'gpp_base_lang' ), $max_pages ); ?></div>
				<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'gpp_base_lang' ), $max_pages ); ?></div>
				<div class="clear"></div>
			</div>	
<?php
		}
}
add_action( 'gpp_base_navigation_hook', 'gpp_base_navigation', 2 );


/*-----------------------------------------------------------------------------------*/
/* CONTENT - PREVIOUS POST LINK */
/*-----------------------------------------------------------------------------------*/

function gpp_base_previous_post_link() {
	$args = array (	
				'format' 				=> '%link',
				'link'                	=> '<span class="meta-nav">&laquo;</span> %title',
				'in_same_cat'         	=> FALSE,
				'excluded_categories' 	=> ''
			);
	$args = apply_filters( 'gpp_base_previous_post_link_args', $args );
	previous_post_link( $args['format'], $args['link'], $args['in_same_cat'], $args['excluded_categories'] );
} // end gpp_base_previous_post_link


/*-----------------------------------------------------------------------------------*/
/* CONTENT - NEXT POST LINK */
/*-----------------------------------------------------------------------------------*/

function gpp_base_next_post_link() {
	$args = array (	
				'format' 				=> '%link',
				'link'                	=> '%title <span class="meta-nav">&raquo;</span>',
				'in_same_cat'         	=> FALSE,
				'excluded_categories' 	=> ''
			);
	$args = apply_filters( 'gpp_base_next_post_link_args', $args );
	next_post_link( $args['format'], $args['link'], $args['in_same_cat'], $args['excluded_categories'] );
} // end gpp_base_next_post_link


/*-----------------------------------------------------------------------------------*/
/* CONTENT - INDEX LOOP */
/*-----------------------------------------------------------------------------------*/

function gpp_base_index_loop() {
	global $gpp;
	while ( have_posts() ) : the_post();
		get_template_part( 'content', get_post_format() );		
	endwhile; 
}

add_action( 'gpp_base_index_loop_hook', 'gpp_base_index_loop' );
//add_action( 'gpp_base_archive_loop_hook', 'gpp_base_index_loop' );
//add_action( 'gpp_base_author_loop_hook', 'gpp_base_index_loop' );	
//add_action( 'gpp_base_search_loop_hook', 'gpp_base_index_loop' );


/*-----------------------------------------------------------------------------------*/
/* CONTENT - POST DATE & AUTHOR */
/*-----------------------------------------------------------------------------------*/

function gpp_base_posted_on() {
	printf( __( '%2$s', 'gpp_base_lang' ),
		'class="meta-prep meta-prep-author"',
		sprintf( '<span class="entry-date">%3$s</span> <span class="meta-sep"></span>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( ' <span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s','gpp_base_lang' ), get_the_author() ),
			get_the_author()
		)
	);
}

add_action( 'gpp_base_posted_on_hook', 'gpp_base_posted_on' );


/*-----------------------------------------------------------------------------------*/
/* CONTENT - POST BELOW TITLE */
/*-----------------------------------------------------------------------------------*/

function gpp_base_below_title() {
	echo '<span class="entry-meta">';
		gpp_base_posted_on_hook(); gpp_base_post_author_hook();
	echo '</span>';
}

add_action( 'gpp_base_above_title_hook', 'gpp_base_below_title' );


/*-----------------------------------------------------------------------------------*/
/* CONTENT - POST AUTHOR */
/*-----------------------------------------------------------------------------------*/

function gpp_base_post_author() {
	printf( __( '%2$s', 'gpp_base_lang' ),
		'class="meta-prep meta-prep-author"',
		sprintf( '<span class="by">' . __( 'by', 'gpp_base_lang' ) . '</span> <span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s','gpp_base_lang' ), get_the_author() ),
			get_the_author()
		)
	);
}

add_action( 'gpp_base_post_author_hook', 'gpp_base_post_author' );


/*-----------------------------------------------------------------------------------*/
/* CONTENT - POST METADATA */
/*-----------------------------------------------------------------------------------*/

function gpp_base_meta() { ?>
	<footer class="entry-meta">
		<?php $show_sep = false; ?>
		<?php
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( __( ', ', 'gpp_base_lang' ) );
			if ( $categories_list ):
		?>
		<span class="cat-links">
			<?php printf( __( '<span class="%1$s">Posted in</span> %2$s', 'gpp_base_lang' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list );
			$show_sep = true; ?>
		</span>
		<?php endif; // End if categories ?>
		<?php
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', __( ', ', 'gpp_base_lang' ) );
			if ( $tags_list ):
			if ( $show_sep ) : ?>
		<span class="meta-sep"> &#183; </span>
			<?php endif; // End if $show_sep ?>
		<span class="tag-links">
			<?php printf( __( '<span class="%1$s">Tagged</span> %2$s', 'gpp_base_lang' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );
			$show_sep = true; ?>
		</span>
		<?php endif; // End if $tags_list ?>

		<?php if ( comments_open() ) : ?>
		<?php if ( $show_sep ) : ?>
		<span class="meta-sep"> &#183; </span>
		<?php endif; // End if $show_sep ?>
		<span class="comments-link"><?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a Reply', 'gpp_base_lang' ) . '</span>', __( '<b>1</b> Reply', 'gpp_base_lang' ), __( '<b>%</b> Replies', 'gpp_base_lang' ) ); ?></span>
		<?php endif; // End if comments_open() ?>
		<span class="meta-sep"> &#183; </span>
		<?php edit_post_link( __( 'Edit', 'gpp_base_lang' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- #entry-meta -->
<?php }

add_action( 'gpp_base_meta_hook', 'gpp_base_meta' );	


/*-----------------------------------------------------------------------------------*/
/* CONTENT - THE CONTENT */
/*-----------------------------------------------------------------------------------*/

function gpp_base_content() {
	global $content;
	if ( is_home() || is_front_page() ) { 
		$content = 'full';
	//} elseif (is_single() && has_post_format(get_post_format())) {
		//$content = 'format';
	} elseif ( is_single() ) {
		$content = 'full';
	} elseif ( is_tag() ) {
		$content = 'excerpt';
	} elseif ( is_search() ) {
		$content = 'excerpt';	
	} elseif ( is_category() ) {
		$content = 'full';
	} elseif ( is_author() ) {
		$content = 'excerpt';
	} elseif ( is_archive() ) {
		$content = 'excerpt';
	} else { 
		$content = 'full';
	}
	
	$content = apply_filters( 'gpp_base_content', $content );

	if ( strtolower( $content ) == 'full' ) {
		$post = get_the_content( more_text() );
		$post = apply_filters( 'the_content', $post );
		$post = str_replace( ']]>', ']]&gt;', $post );
	} elseif ( strtolower( $content ) == 'excerpt' ) {
		$post = get_the_excerpt();
	//} elseif ( strtolower($content) == 'format') {
		//$post = get_template_part( 'format', get_post_format() );
	} elseif ( strtolower( $content ) == 'none') {
	} else {
		$post = get_the_content( more_text() );
		$post = apply_filters( 'the_content', $post );
		$post = str_replace( ']]>', ']]&gt;', $post );
	}
	echo apply_filters( 'gpp_base_post', $post );
} // end gpp_base_content


/*-----------------------------------------------------------------------------------*/
/* CONTENT - THE CONTENT MORE LINK */
/*-----------------------------------------------------------------------------------*/

function more_text() {
	$content = ''. __( 'Read More <span class="meta-nav">&raquo;</span>','gpp_base_lang' ).'';
	return apply_filters( 'more_text', $content );
} // end more_text


/*-----------------------------------------------------------------------------------*/
/* CONTENT - COMMENTS */
/*-----------------------------------------------------------------------------------*/

function gpp_base_comments() { ?>
	<div id="commentsbox">
		<?php comments_template( '', true ); ?>
	</div>
<?php } //end gpp_base_comments


/*-----------------------------------------------------------------------------------*/
/* CONTENT - SINGLE POST */
/*-----------------------------------------------------------------------------------*/

function gpp_base_single_post() { 
	if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<?php gpp_base_above_title_hook(); ?>			
				<h2 class="entry-title"><?php the_title(); ?></h2>								
				<?php gpp_base_below_title_hook(); ?>
			</header>
			<?php gpp_base_above_content_hook(); ?>
				
			<div class="entry-content">
				<?php get_template_part('video'); 
				gpp_base_content();
				wp_link_pages( 'before=<div class="page-link">' . __('Pages:','gpp_base_lang') . '&after=</div>' ) ?>
			</div>
			
			<?php gpp_base_below_content_hook(); ?>
			<div class="clear"></div>					
			<?php gpp_base_single_meta_hook(); ?>
						
		</article><!-- .post -->
	<?php endwhile; else :		
			gpp_base_not_found_hook();	
		endif;
	wp_reset_query();
	gpp_base_navigation_hook();
}

add_action( 'gpp_base_single_post_hook', 'gpp_base_single_post' );

/*-----------------------------------------------------------------------------------*/
/* CONTENT - SINGLE POST METADATA */
/*-----------------------------------------------------------------------------------*/

function gpp_base_single_meta() {
	echo '<div class="entry-utility">';
		_e( 'Posted in ','gpp_base_lang' );  the_category( ', ' ); the_tags( __( ' and tagged with ', 'gpp_base_lang' ) ); echo ". ";
		 printf( __( '<a href="%1$s" title="%2$s feed">%2$s</a> feed. ', 'gpp_base_lang' ), get_post_comments_feed_link(), __( 'RSS 2.0', 'gpp_base_lang' ) ); 
		 edit_post_link( __( 'Edit this entry', 'gpp_base_lang' ), '', '.' ); 
	echo '</div>';
}
add_action( 'gpp_base_single_meta_hook', 'gpp_base_single_meta' );	


/*-----------------------------------------------------------------------------------*/
/* CONTENT - POST FORMATS */
/*-----------------------------------------------------------------------------------*/

function gpp_base_post_format() {
	if ( function_exists( 'get_post_format' ) ) {
		get_template_part( 'format', get_post_format() );
	}
}


/*-----------------------------------------------------------------------------------*/
/* CONTENT - NOT FOUND LOOP */
/*-----------------------------------------------------------------------------------*/

function gpp_base_not_found() { ?>
	<h2 class="center"><?php _e( 'Not Found', 'gpp_base_lang' ); ?></h2>
	<p class="center"><?php _e( 'Sorry, but you are looking for something that isn\'t here.', 'gpp_base_lang' ); ?></p>
	<?php get_search_form(); ?>

<?php
}
add_action( 'gpp_base_not_found_hook', 'gpp_base_not_found' );


/*-----------------------------------------------------------------------------------*/
/* CONTENT - PAGE LOOP */
/*-----------------------------------------------------------------------------------*/

function gpp_base_page() {
	global $gpp, $videos, $post;
	$videos = get_post_meta($post->ID, "video", false);
		 ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">				
					<?php gpp_base_above_title_hook(); ?>				
					<h2 class="entry-title"><?php the_title(); ?></h2>				
					<?php gpp_base_below_title_hook(); ?>
				</header>
				<div class="entry-content">
					<?php if ( $videos ) get_template_part( 'video' ); ?>
					<?php gpp_base_content(); ?>
					<?php wp_link_pages( 'before=<div class="page-link">' . __( 'Pages:', 'gpp_base_lang' ) . '&after=</div>' ); ?>
				</div><!-- .entry-content -->	
				<div class="clear"></div>
				<?php edit_post_link( __( 'Edit this entry', 'gpp_base_lang' ), '<div class="entry-utility">', '</div>' ); ?>
			</article><!-- #post -->
<?php
		
}
add_action( 'gpp_base_page_hook', 'gpp_base_page' );


/*-----------------------------------------------------------------------------------*/
/* CONTENT - PAGE BLOG LOOP */
/*-----------------------------------------------------------------------------------*/

function gpp_base_page_blog() {
	global $gpp, $paged, $wp_query;
?>
	<section id="primary">
	<div id="content" class="<?php gpp_base_check_sidebar(); ?>">	
		<h3 class="entry-title"><?php the_title(); ?></h3>
		<?php 
		global $more; 
		$blogcat = "";
		if ( isset( $gpp[ 'gpp_base_blog_cat' ] ) )
			$blogcat = $gpp[ 'gpp_base_blog_cat' ];
		$temp = $wp_query;
		$wp_query = NULL;
		$wp_query = new WP_Query();
		$wp_query->query( '&cat='.$blogcat.'&paged='.$paged );
		$tb_counter = 1;
		while ($wp_query->have_posts()) : $wp_query->the_post();
			$more = false;	
		?>

		<?php get_template_part( 'content', get_post_format() );	?>	
		<?php //gpp_base_meta_hook(); ?>
		<?php $tb_counter++; endwhile; $more = true; ?>
		<?php gpp_base_navigation_hook(); ?>
		<?php $wp_query = NULL; $wp_query = $temp; ?>
	
	</div><!-- #content -->
	
	</section>

<?php
		
}
add_action( 'gpp_base_page_blog_hook', 'gpp_base_page_blog' );


/*-----------------------------------------------------------------------------------*/
/* CONTENT - PAGE TITLE */
/*-----------------------------------------------------------------------------------*/

function gpp_base_page_title() { ?>
 	<header class="page-header">
	
		<?php /* If this is a category archive */ if ( is_category() ) { ?>
		<h1 class="page-title"><?php single_cat_title(); ?></h1>
		<?php /* If this is a tag archive */ } elseif ( is_tag() ) { ?>
		<h1 class="page-title"><?php printf( __( 'Posts Tagged %s', 'gpp_base_lang' ), single_tag_title( '', false ) ); ?></h1>
		<?php /* If this is a daily archive */ } elseif ( is_day() ) { ?>
		<h1 class="page-title"><?php printf( __( '%s archives', 'gpp_base_lang' ), get_the_time( __( 'F jS, Y', 'gpp_base_lang' ) ) ); ?></h1>		
		<?php /* If this is a monthly archive */ } elseif ( is_month() ) { ?>
		<h1 class="page-title"><?php printf( __( '%s archives', 'gpp_base_lang' ), get_the_time( __( 'F Y', 'gpp_base_lang' ) ) ); ?></h1>
		<?php /* If this is a yearly archive */ } elseif ( is_year() ) { ?>
		<h1 class="page-title"><?php printf( __( '%s archives', 'gpp_base_lang' ), get_the_time( __( 'Y', 'gpp_base_lang' ) ) ); ?></h1>
		<?php /* If this is an author archive */ } elseif ( is_author() ) { ?>
		<h1 class="page-title author"><?php _e( 'Author Archive', 'gpp_base_lang' ); ?></h1>
		<?php /* If this is a paged archive */ } elseif ( isset( $_GET[ 'paged' ] ) && ! empty( $_GET[ 'paged' ] ) ) { ?>
		<h1 class="page-title"><?php _e( 'Blog Archive', 'gpp_base_lang' ); ?></h1>
		<?php /* If this is a taxonomy archive */ } elseif ( is_tax() ) {
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>
		<h1 class="page-title"><?php echo $term->name; ?></h1>
		<?php } ?>
 	  
 	 </header> 
<?php
} // end gpp_base_page_title
add_action( 'gpp_base_page_title_hook', 'gpp_base_page_title' );


/*-----------------------------------------------------------------------------------*/
/* CONTENT - ARCHIVE LOOP */
/*-----------------------------------------------------------------------------------*/

function gpp_base_archive_loop() { ?>
	<?php while ( have_posts() ) : the_post(); ?>	
			<article <?php post_class(); ?>>
				
				<header class="entry-header">	
					<h3 class="entry-format"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'gpp_base_lang' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php _e( 'Archive', 'gpp_base_lang' ); ?></a></h3>
				</header>
				
				<div class="entry-content">
				
					<?php gpp_base_above_title_hook(); ?>
					<h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf( __( 'Permanent Link to %s', 'gpp_base_lang' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h2>
					<?php gpp_base_below_title_hook(); ?>
					<?php gpp_base_above_content_hook(); ?>
					<?php gpp_base_content(); ?>
					<?php gpp_base_below_content_hook(); ?>
					
				</div>
				<?php gpp_base_meta_hook(); ?>
			</article><!-- .post -->
	<?php endwhile; ?>	
<?php
}
add_action( 'gpp_base_archive_loop_hook', 'gpp_base_archive_loop' ); 


/*-----------------------------------------------------------------------------------*/
/* CONTENT - SEARCH LOOP */
/*-----------------------------------------------------------------------------------*/

function gpp_base_search_loop() { ?>
	<?php while ( have_posts() ) : the_post(); ?>	
		<div <?php post_class(); ?>>
			<?php gpp_base_above_title_hook(); ?>
			<h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf( __( 'Permanent Link to %s', 'gpp_base_lang' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h2>
			<?php gpp_base_below_title_hook(); ?>
			<div class="clear"></div>
			<?php gpp_base_content(); ?>
		</div><!-- .post -->
	<?php endwhile; ?>	
<?php
}
add_action( 'gpp_base_search_loop_hook', 'gpp_base_search_loop' ); 


/*-----------------------------------------------------------------------------------*/
/* CONTENT - AUTHOR LOOP */
/*-----------------------------------------------------------------------------------*/

function gpp_base_author_loop() { ?>
	<?php while ( have_posts() ) : the_post(); ?>	
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php gpp_base_above_title_hook(); ?>
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'gpp_base_lang' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<?php gpp_base_below_title_hook(); ?>
				<?php gpp_base_content(); ?>		
			</div>
	<?php endwhile; ?>
<?php }
add_action( 'gpp_base_author_loop_hook', 'gpp_base_author_loop' );


/*-----------------------------------------------------------------------------------*/
/* CONTENT - ATTACHMENT LOOP */
/*-----------------------------------------------------------------------------------*/

function gpp_base_attachment_loop() { 
	global $post; ?>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h2 class="entry-title"><?php the_title(); ?></h2>
			<div class="entry-meta">
				<?php gpp_base_attach_entry_meta(); ?>		
			</div><!-- .entry-meta -->
			<div class="entry-content">
				<div class="entry-attachment">
					<?php if ( wp_attachment_is_image() ) :
							$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
							foreach ( $attachments as $k => $attachment ) {
								if ( $attachment->ID == $post->ID )
									break;
							}
							$k++;
							// If there is more than 1 image attachment in a gallery
							if ( count( $attachments ) > 1 ) {
								if ( isset( $attachments[ $k ] ) )
									// get the URL of the next image attachment
									$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
								else
									// or get the URL of the first image attachment
									$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
							} else {
								// or, if there's only 1 image attachment, get the URL of the image
								$next_attachment_url = wp_get_attachment_url();
							}
					?>
							<p class="attachment"><a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php
								$attachment_size = apply_filters( 'gpp_base_attachment_size', 'large' );
								echo wp_get_attachment_image( $post->ID, array( $attachment_size, 9999 ) ); // filterable image width with, essentially, no limit for image height.
							?></a></p>

							<!--<div id="nav-below" class="navigation">
								<div class="nav-previous"><?php //previous_image_link( false ); ?></div>
								<div class="nav-next"><?php //next_image_link( false ); ?></div>
							</div> #nav-below -->
					<?php else : ?>
							<a href="<?php echo wp_get_attachment_url(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php echo basename( get_permalink() ); ?></a>
					<?php endif; ?>
				</div><!-- .entry-attachment -->
				<div class="entry-caption"><?php if ( !empty( $post->post_excerpt ) ) the_excerpt(); ?></div>

				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>','gpp_base_lang' ) ); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:','gpp_base_lang' ), 'after' => '</div>' ) ); ?>

			</div><!-- .entry-content -->
			<div class="clear"></div>
			<div class="entry-utility">
				<?php gpp_base_posted_on_hook(); ?>
				<?php edit_post_link( __( 'Edit','gpp_base_lang' ), ' <span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-utility -->
		</div><!-- #post-## -->
					
	<?php endwhile; else : ?>
		<?php gpp_base_not_found_hook(); ?>
		
	<?php endif; ?>	
	<?php }
add_action( 'gpp_base_attachment_loop_hook', 'gpp_base_attachment_loop' );


/*-----------------------------------------------------------------------------------*/
/* CONTENT - POSTED IN */
/*-----------------------------------------------------------------------------------*/

function gpp_base_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'gpp_base_lang' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'gpp_base_lang' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'gpp_base_lang' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}


/*-----------------------------------------------------------------------------------*/
/* CONTENT - ATTACHMENT METADATA */
/*-----------------------------------------------------------------------------------*/

function gpp_base_attach_entry_meta() {
	printf( __( '<span class="%1$s">By</span> %2$s', 'gpp_base_lang' ),
			'meta-prep meta-prep-author',
			sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
				get_author_posts_url( get_the_author_meta( 'ID' ) ),
				sprintf( esc_attr__( 'View all posts by %s', 'gpp_base_lang' ), get_the_author() ),
				get_the_author()
			)
		);
	?>
	<span class="meta-sep">&#183;</span>
	<?php
		printf( __( '<span class="%1$s">Published</span> %2$s', 'gpp_base_lang' ),
			'meta-prep meta-prep-entry-date',
			sprintf( '<span class="entry-date"><abbr class="published" title="%1$s">%2$s</abbr></span>',
				esc_attr( get_the_time() ),
				get_the_date()
			)
		);
		if ( wp_attachment_is_image() ) {
			echo ' <span class="meta-sep">&#183;</span> ';
			$metadata = wp_get_attachment_metadata();
			printf( __( 'Full size is %s pixels', 'gpp_base_lang' ),
				sprintf( '<a href="%1$s" title="%2$s">%3$s &times; %4$s</a>',
					wp_get_attachment_url(),
					esc_attr( __( 'Link to full-size image', 'gpp_base_lang' ) ),
					$metadata['width'],
					$metadata['height']
				)
			);
		}
	?>
	<?php edit_post_link( __( 'Edit', 'gpp_base_lang' ), '<span class="meta-sep">&#183;</span> <span class="edit-link">', '</span>' );
	
}
	

/*-----------------------------------------------------------------------------------*/
/* CONTENT - VIDEO PLAYER - SINGLE POSTS */
/*-----------------------------------------------------------------------------------*/

function gpp_base_video_player() {

	global $gpp, $post, $sidebar;
	//grab multiple values for same key
	$videos = get_post_meta( $post->ID, "video", false );
	$iphones = get_post_meta( $post->ID, "iphone", false );
	$videothumbs = get_post_meta( $post->ID, "video-thumb", false );
	
	//custom dimensions
	$height = get_post_meta( $post->ID, "height", false );
	$width = get_post_meta( $post->ID, "width", false );

	//check sidebar and set appropriate dimensions
	if ( isset( $gpp[ 'gpp_base_sidebar' ] ) )
		$sidebar = $gpp[ 'gpp_base_sidebar' ];
	if ( $sidebar =='true' || $sidebar === FALSE ) {
		$videowidth = 600; $videoheight = 362;
	} else {
		$videowidth = 940; $videoheight = 544;
	}	
	
	if ( $videos != "" ) { // if video custom field exists
		for ( $video = 0; $video < count( $videos ); $video++ ) {
			if ( ! empty( $height ) ) {			
				$videoheight = $height[ $video ] + 20;
			}
			if ( ! empty( $width ) ) {
				$videowidth = $width[ $video ];
			}

	?>

			<div id="flashcontent-<?php the_ID(); ?>-<?php echo $video; ?>" class="clearfix">
				<?php
					if ( get_option( 'gpp_base_iphone' ) == 'false' ) {
						_e( '<div class="box"><p>Please install the free <a href="http://www.adobe.com/products/flashplayer/">Adobe Flash Player</a> to view this content.</p></div>', 'gpp_base_lang' );
					}
				?>
			</div>

			<script type="text/javascript">
				var flashvars = {};
				flashvars.imagePath = "<?php echo $videothumbs[$video]; ?>";
				flashvars.videoPath = "<?php echo $videos[$video]; ?>";
				flashvars.autoStart = "false";
				flashvars.autoHide = "false";
				flashvars.autoHideTime = "5";
				flashvars.hideLogo = "true";
				flashvars.volAudio = "60";
				flashvars.newWidth = "<?php echo $videowidth; ?>";
				flashvars.newHeight = "<?php echo $videoheight; ?>";
				flashvars.disableMiddleButton = "false";
				flashvars.playSounds = "false";
				flashvars.soundBarColor = "0x0066FF";
				flashvars.barColor = "0x0066FF";
				flashvars.barShadowColor = "0x91BBFB";
				flashvars.subbarColor = "0xffffff";
				
				var params = {};
				params.wmode = "transparent";
				params.allowFullScreen = "true";

				var attributes = {};
				
				swfobject.embedSWF("<?php get_template_directory_uri(); ?>/library/includes/video/flvPlayer.swf", "flashcontent-<?php the_ID(); ?>-<?php echo $video; ?>", "<?php echo $videowidth; ?>", "<?php echo $videoheight; ?>", "9", "<?php get_template_directory_uri(); ?>/library/includes/video/expressInstall.swf", flashvars, params, attributes);
						
			</script>

			<?php if ( $gpp[ 'gpp_base_iphone' ] == 'true' && ( count( $iphones ) > 0 ) ) { ?>
			
				<script type="text/javascript">
					<!--
					if ( ( navigator.userAgent.match(/iPhone/i) ) || ( navigator.userAgent.match(/iPod/i) ) || ( navigator.userAgent.match(/iPad/i) ) ) {
						 document.getElementById( "flashcontent-<?php the_ID(); ?>-<?php echo $video; ?>" ).innerHTML = "<div class=\"play\"><a href=\"<?php echo $iphones[ $video ]; ?>\"><img src=\"<?php echo $videothumbs[ $video ]; ?>\" /><span></span></a></div>";
					}
					-->
				</script>
			
				<?php
			}
		}
	}
} 


/*-----------------------------------------------------------------------------------*/
/* CONTENT - MULTIMEDIA CUSTOM FIELDS */
/*-----------------------------------------------------------------------------------*/

function gpp_base_multimedia() {
	$values = get_post_custom_values( "multimedia" );
	if ( isset( $values[ 0 ] ) ) {

		echo '<div class="multimedia clearfix">';
		$values = get_post_custom_values( "multimedia" ); 
		echo $values[ 0 ];
		echo '</div>';
	}
}

?>