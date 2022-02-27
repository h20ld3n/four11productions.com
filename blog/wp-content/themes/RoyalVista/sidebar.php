<div id="sidebar">

	<ul>	
	<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar() ) : ?>			
		
	
	

	
<?php wp_list_pages('title_li=<h2>Main Menu</h2>' ); ?>	
		
<li><h2><?php _e('Advertisement'); ?></h2>			
<div class="ad">
<script type="text/javascript"><!--
google_ad_client = "pub-";
google_ad_width = 200;
google_ad_height = 200;
google_ad_format = "200x200_as";
google_ad_type = "text";
google_ad_channel = "";
google_color_border = "d70101";
google_color_bg = "d70101";
google_color_link = "eeeeee";
google_color_text = "eeeeee";
google_color_url = "eeeeee";
//-->
</script>
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></div>	</li>	


			<li><h2><?php _e('Categories'); ?></h2>
				<ul>
				<?php wp_list_cats('sort_column=name'); ?>
				</ul>
			</li>

			<li><h2><?php _e('Archives'); ?></h2>
				<ul>
				<?php wp_get_archives('type=monthly'); ?>
				</ul>
			</li>

<?php get_links_list(); ?>
				
				<li><h2><?php _e('Meta'); ?></h2>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<li><a href="http://validator.w3.org/check/referer" title="<?php _e('This page validates as XHTML 1.0 Transitional'); ?>"><?php _e('Valid <abbr title="eXtensible HyperText Markup Language">XHTML</abbr>'); ?></a></li>

					<li><a href="http://jigsaw.w3.org/css-validator/validator?uri=http://www.nikynik.com/wpstyles"><?php _e('Valid  <abbr title="Valid Css!">CSS</abbr>'); ?></a></li>
					<li><a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS 2.0'); ?>"><?php _e('<abbr title="Really Simple Syndication">RSS</abbr> 2.0'); ?></a></li>
					<li><a href="http://wordpress.org/" title="<?php _e('Powered by WordPress, state-of-the-art semantic personal publishing platform.'); ?>">WordPress</a></li>

					<?php wp_meta(); ?>

				</ul>
				</li>

<?php endif; ?>
		</ul> 

	</div>

