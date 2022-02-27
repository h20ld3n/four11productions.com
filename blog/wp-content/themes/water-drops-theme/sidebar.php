
<!-- begin sidebar -->
		
		<?php 	/* Widgetized sidebar, if you have the plugin installed. */
		if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
			
		<div class="title"><h1>Graphic Design</h1></div>
		<ul>
			<li class="page_item page-item-2">
			<a title="Old Dominion University" href="http://www.four11productions.com/blog/?page_id=2">Old Dominion University</a></li>
			<li class="page_item page-item-2">
			<a title="CBS MarketWatch" href="http://www.four11productions.com/blog/?page_id=2">CBS Marketwatch</a></li>
			<li class="page_item page-item-2">
			<a title="Golden Gateway" href="http://www.four11productions.com/blog/?page_id=2">Golden Gateway</a></li>
			<li class="page_item page-item-2">
			<a title="REO Company" href="http://www.four11productions.com/blog/?page_id=2">REO Company</a></li>
			<li class="page_item page-item-2">
			<a title="Muscular Dystrophy Association" href="http://www.four11productions.com/blog/?page_id=2">Muscular Dystrophy</a></li>
			<li class="page_item page-item-2">
			<a title="Web Design" href="http://www.four11productions.com/blog/?page_id=2">Web Design</a></li>
			<li class="page_item page-item-2">
			<a title="CD, DVD and Poster Design" href="http://www.four11productions.com/blog/?page_id=2">CD, DVD &amp; Posters</a></li>
			<li class="page_item page-item-2">
			<a title="Experimentation" href="http://www.four11productions.com/blog/?page_id=2">Experimentation</a></li>
		</ul>
		<div class="title"><h1>Films &amp; Video</h1></div>
		<ul>
			<li class="page_item page-item-2">
			<a title="Show Reel" href="http://www.four11productions.com/movies06.html">Showreel</a></li>
			<li class="page_item page-item-2">
			<a title="Other Film Work" href="http://www.four11productions.com/blog/?page_id=2">Other Film Work</a></li>
		</ul>
				<div class="title"><h1>Resume</h1></div>
		<ul>
			<?php wp_list_pages('title_li='); ?>
		</ul>
		<div class="title"><h1>Social Networks</h1></div>
		<ul>
			<li class="page_item page-item-2">
			<a title="Facebook" href="http://www.facebook.com/profile.php?id=563194602" target="_blank">Facebook</a></li>
			<li class="page_item page-item-2">
			<a title="Flickr" href="http://www.flickr.com/photos/24607684@N00" target="_blank">Flickr</a></li>
			<li class="page_item page-item-2">
			<a title="MySpace" href="http://www.myspace.com/h0ld3n" target="_blank">MySpace</a></li>
			<li class="page_item page-item-2">
			<a title="Pandora" href="http://www.pandora.com/people/h0ld3n" target="_blank">Pandora</a></li>	
			<li class="page_item page-item-2">
			<a title="YouTube" href="http://www.youtube.com/user/h0ld3n06" target="_blank">YouTube</a></li>
			<li class="page_item page-item-2">
			<a title="Wayne" href="http://h0ld3n.wayn.com" target="_blank">Wayne</a></li>	
		</ul>	
		<!-- div class="title"><h1>Categories</h1></div>
		<ul>
			 <?php wp_list_cats('sort_column=name'); ?>
		</ul>
		<div class="title"><h1>Archives</h1></div>
		<ul>
			 <?php wp_get_archives('type=monthly'); ?>
		</ul>
		
		<div class="title"><h1>Meta</h1></div>
		<ul>
			<?php wp_register(); ?>
			<li><?php wp_loginout(); ?></li>
			<li><a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS'); ?>"><?php _e('<abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>
			<li><a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php _e('The latest comments to all posts in RSS'); ?>"><?php _e('Comments <abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>
			<li><a href="http://validator.w3.org/check/referer" title="<?php _e('This page validates as XHTML 1.0 Transitional'); ?>"><?php _e('Valid <abbr title="eXtensible HyperText Markup Language">XHTML</abbr>'); ?></a></li>
			<li><a href="http://gmpg.org/xfn/"><abbr title="XHTML Friends Network">XFN</abbr></a></li>
			<li><a href="http://wordpress.org/" title="<?php _e('Powered by WordPress, state-of-the-art semantic personal publishing platform.'); ?>"><abbr title="WordPress">WP</abbr></a></li>
			<?php wp_meta(); ?>
		</ul-->
		
		<?php endif; ?>
<!-- end sidebar -->
