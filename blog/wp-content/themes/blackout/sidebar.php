	<div id="sidebar">



	<?php 	/* Widgetized sidebar, if you have the plugin installed. */
					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>



			<h2>Archives</h2>

				<ul>
				<?php wp_get_archives('type=monthly'); ?>
				</ul>


			<h2>Categories</h2>

			<ul>
			<?php wp_list_categories('title_li'); ?>
			</ul>


			<h2>Recent Posts</h2>

			<ul>
			<?php $myposts = get_posts('numberposts=10');
			foreach($myposts as $post) :?>
			<li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>

			<?php endforeach; ?>
			</ul>


			<h2>Blogroll</h2>

			<ul>
			<?php wp_list_bookmarks('categorize=0&title_li='); ?>
			</ul>


			<h2>Meta</h2>

			<ul>
				<?php wp_register(); ?>
				<li><?php wp_loginout(); ?></li>
				<li><a href="http://validator.w3.org/check/referer" title="This page validates as XHTML 1.0 Transitional">Valid <abbr title="eXtensible HyperText Markup Language">XHTML</abbr></a></li>
				<li><a href="http://gmpg.org/xfn/"><abbr title="XHTML Friends Network">XFN</abbr></a></li>
				<li><a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>
				<?php wp_meta(); ?>
			</ul>



			<?php endif; ?>

	</div>

