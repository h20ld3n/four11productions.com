<?php
/**
 * The template for displaying posts in the Gallery Post Format on index and archive pages
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 *
 * @package WordPress
 * @subpackage Immersion
 * @since Immersion 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php $args = array(
		'post_type' 	=> 'attachment',
		'numberposts' 	=> -1,
		'post_status' 	=> null,
		'post_parent' 	=> $post->ID,
		//'post__not_in'	=> array($thumb_id),
		'post_mime_type'=> 'image',
		'orderby'		=> 'menu_order',
		'order'			=> 'ASC'
	);
	$attachments = get_posts($args); ?>

    <div class="post-format-content">
        <div class="flexslider">
            <ul class="slides">

			<?php foreach ( $attachments as $attachment ) :
				$_post = & get_post( $attachment->ID );
				$url = wp_get_attachment_url($_post->ID);
				$post_title = esc_attr($_post->post_title);
				$large_image = wp_get_attachment_image($attachment->ID, 'large');
                $caption = get_post_field('post_excerpt', $attachment->ID);
            ?>

                <li>
                	<?php echo '<a href="'.$url.'" title="'.$post_title.'"></a>'; ?>
                	<?php echo $large_image; ?>
                    <?php if ($caption) {
                        echo '<p class="flex-caption">'.$caption.'</p>';
                    } ?>
                </li>

            <?php endforeach;   ?>

            </ul><!-- .slides -->

      	</div><!-- .flexslider -->
    </div><!-- .post-format-content -->

	<header class="entry-header">
		<?php do_action( 'gpp_before_title' ); ?>
		<?php if ( is_singular() ) { ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php } else { ?>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'immersion' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		<?php } ?>
		<?php do_action( 'gpp_after_title' ); ?>
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for search pages ?>
	<div class="entry-summary">
		<?php do_action( 'gpp_before_content' ); ?>
		<?php the_excerpt(); ?>
		<?php do_action( 'gpp_after_content' ); ?>
	</div><!-- .entry-summary -->
	<?php elseif ( is_singular() ) : // Display content on single pages ?>
	<div class="entry-content">
		<?php do_action( 'gpp_before_content' ); ?>
		<?php the_content(); ?>
		<?php do_action( 'gpp_after_content' ); ?>
	</div><!-- .entry-content -->
	<?php else : ?>
	<div class="entry-content">
		<?php do_action( 'gpp_before_content' ); ?>
		<?php if ( post_password_required() ) : ?>
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'immersion' ) ); ?>
		<?php else : ?>
			<?php gpp_custom_content(); ?>
		<?php endif; ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'immersion' ), 'after' => '</div>' ) ); ?>
		<?php do_action( 'gpp_after_content' ); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>

    <?php get_template_part( 'entry', 'footer' ); ?>

</article><!-- #post-<?php the_ID(); ?> -->