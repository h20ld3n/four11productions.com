<div id="bottom_wrap">
    <div id="bottombar">

        <div id="column1">
        <h2>Links</h2>
			      <ul>
				        <?php get_links(-1, '<li>', '</li>', ' - '); ?>
			      </ul>
        </div>
    

        <div id="column2">
          <ul>
            <?php wp_list_categories('show_count=1&title_li=<h2>Categories</h2>'); ?>
          </ul>
        </div>

        <div id="column3">
          <!--h2>Archives</h2>
          <ul>
            <?php wp_get_archives('type=monthly'); ?>
          </ul-->
        </div>

        <div id="column4">
            <h2>Stay in touch</h2>
            <ul>
                <li><a href="<?php bloginfo('rss2_url'); ?>"  title="<?php bloginfo('name'); ?> RSS Feed">RSS Feed</a></li>
                <li><a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php bloginfo('name'); ?> Comments RSS Feed">RSS Comments Feed</a></li>    
                <li><a href="mailto:<?php bloginfo('admin_email'); ?>" title="<?php bloginfo('name'); ?> Admin E-Mail">Send me a mail</a></li>
            </ul>
        </div>
        <div class="clearer"></div>

    </div>
</div>
