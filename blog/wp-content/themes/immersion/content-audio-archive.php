<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<!--  Start Audio Player  -->
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

	<header class="entry-header">
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
					</div>
				</div>
			</div>

		<!--  End Audio Player  -->
		
	<?php do_action( 'gpp_before_title' ); ?>
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'immersion' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<?php do_action( 'gpp_after_title' ); ?>						
	<div class="entry-meta">
	    <div class="right">
	        <?php if ( comments_open() || ( '0' != get_comments_number() && ! comments_open() ) ) : ?>
	        <?php comments_popup_link( __( '0', 'immersion' ), __( '1', 'immersion' ), __( '%', 'immersion' ), 'comments-link icon comment_alt2_fill' ); ?>
	        <?php endif; ?>
	        <a id="like-<?php the_ID(); ?>" class="like-count icon heart_fill" href="#" <?php gpp_liked_class(); ?>>
	            <?php gpp_post_liked_count(); ?>
	        </a>
	    </div>
	</div>
	</header><!-- .entry-header -->
</article><!-- #post-<?php the_ID(); ?> -->