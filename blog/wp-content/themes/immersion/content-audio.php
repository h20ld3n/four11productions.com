<?php
/**
 * The template for displaying posts in the Aside Post Format on index and archive pages
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 *
 * @package WordPress
 * @subpackage Immersion
 * @since Immersion 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php $audio = get_post_meta($post->ID, '_format_audio_embed', true);  ?>

<!--  Start Audio Player  -->
    <script type="text/javascript">
    jQuery(document).ready(function($){

    		$("#jquery_jplayer_<?php the_ID(); ?>").jPlayer({

    			ready: function () {
    				$(this).jPlayer("setMedia", {

    					<?php if($audio != '') { echo 'mp3: "'.$audio.'",'."\n"; } ?>

    				});
    			},
    			swfPath: "<?php echo get_template_directory_uri(); ?>/lib/js",
    			cssSelectorAncestor: "#jp_interface_<?php the_ID(); ?>",
    			supplied: "<?php echo 'mp3'; ?>",
    			wmode: "window"
    		});

    });
    </script>
    			<div class="entry-format audio">
    				<div id="jquery_jplayer_<?php the_ID(); ?>" class="jp-jplayer"></div>
    				<div class="jp-audio">
    					<div id="jp_interface_<?php the_ID(); ?>" class="jp-interface">

    					    <div class="jp-play-container">
    						<ul class="jp-controls">
    							<li><a href="#" class="jp-play" tabindex="1"><?php _e('play', 'immersion'); ?></a></li>
    							<li><a href="#" class="jp-pause" tabindex="1"><?php _e('pause', 'immersion'); ?></a></li>
    						</ul>
    						</div>

    						<div class="jp-progress-container">
    							<div class="jp-progress">
    								<div class="jp-seek-bar">
    									<div class="jp-play-bar"></div>
    								</div>
    							</div>
    						</div>

    					    <div class="jp-volume-bar-container">
    					        <ul class="jp-controls">
    							    <li><a href="#" class="jp-mute" tabindex="1"><?php _e('mute', 'immersion'); ?></a></li>
    							    <li><a href="#" class="jp-unmute" tabindex="1"><?php _e('unmute', 'immersion'); ?></a></li>
    						    </ul>
    							<div class="jp-volume-bar">
    								<div class="jp-volume-bar-value"></div>
    							</div>
    						</div>

    					</div>
    				</div>
    			</div>
<!--  End Audio Player  -->

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
	<?php else : ?>
	<div class="entry-content">
		<?php do_action( 'gpp_before_content' ); ?>
        <?php if ( is_singular() ) { ?>
          <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'immersion' ) ); ?>
        <?php } else { ?>
            <?php gpp_custom_content(); ?>
        <?php } ?>
        <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'immersion' ), 'after' => '</div>' ) ); ?>
		<?php do_action( 'gpp_after_content' ); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>

    <?php get_template_part( 'entry', 'footer' ); ?>

</article><!-- #post-<?php the_ID(); ?> -->
