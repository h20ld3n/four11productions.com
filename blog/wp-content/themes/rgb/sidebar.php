    <hr />
    <div id="sidebar">
      <?php /* Category Archive */ if (is_category()) { ?>
      <p class="intro"><?php printf(__('You are currently browsing the %1$s weblog archives for the %2$s category.','rgb'), '<a href="' . get_settings('siteurl') .'">' . get_bloginfo('name') . '</a>', single_cat_title('', false) ) ?></p>
      <?php /* Day Archive */ } elseif (is_day()) { ?>
      <p class="intro"><?php printf(__('You are currently browsing the %1$s weblog archives for the day %2$s.','rgb'), '<a href="' . get_settings('siteurl') .'">' . get_bloginfo('name') . '</a>', get_the_time(__('l, F jS, Y','rgb'))) ?></p>
      <?php /* Monthly Archive */ } elseif (is_month()) { ?>
      <p class="intro"><?php printf(__('You are currently browsing the %1$s weblog archives for the month %2$s.','rgb'), '<a href="'.get_settings('siteurl').'">'.get_bloginfo('name').'</a>', get_the_time(__('F, Y','rgb'))) ?></p>
      <?php /* Yearly Archive */ } elseif (is_year()) { ?>
      <p class="intro"><?php printf(__('You are currently browsing the %1$s weblog archives for the year %2$s.','rgb'), '<a href="'.get_settings('siteurl').'">'.get_bloginfo('name').'</a>', get_the_time('Y')) ?></p>
      <?php /* Search */ } elseif (is_search()) { ?>
      <p class="intro"><?php printf(__('You have searched the %1$s weblog archives for \'<strong>%2$s</strong>\'.','rgb'),'<a href="'.get_settings('siteurl').'">'.get_bloginfo('name').'</a>', wp_specialchars($s)) ?></p>
      <?php /* Paged Archive */ } elseif (is_paged()) { ?>
      <p class="intro"><?php printf(__('You are currently browsing the %s weblog archives.','rgb'), '<a href="'.get_settings('siteurl').'">'.get_bloginfo('name').'</a>') ?></p>
      <?php } elseif (function_exists('is_tag') && is_tag()) { ?>
      <p class="intro">
        <?php if (function_exists('single_tag_title')) { 
                                                        printf(__('You are currently browsing the %1$s weblog archives for \'%2$s\' tag.','rgb'), '<a href="'.get_settings('siteurl').'">'.get_bloginfo('name').'</a>', single_tag_title('', false) ); 
                                                    } elseif (!function_exists('single_tag_title')) { 
                                                        printf(__('You are currently browsing the %1$s weblog archives for \'%2$s\' tag.','rgb'), '<a href="'.get_settings('siteurl').'">'.get_bloginfo('name').'</a>', get_query_var('tag') ); } ?>
      </p>
      <?php } ?>
      <?php if (is_search()) { ?>
      <p class="intro">
        <?php _e('Longer entries are truncated. Click the headline of an entry to read it in its entirety.','rgb'); ?>
      </p>
      <?php } ?>
      <?php if(get_option('rgb_uitabs') == 1) { ?>
      <ul id="ui-tabs">
        <li><a href="#tab-1">
          <?php _e('Latest','rgb'); ?>
          </a></li>
        <li><a href="#tab-2">
          <?php _e('Categories','rgb'); ?>
          </a></li>
        <li><a href="#tab-3">
          <?php _e('Meta','rgb'); ?>
          </a></li>
        <li><a href="#tab-4">
          <?php _e('Blogroll','rgb'); ?>
          </a></li>
        <?php /* Menu for subpages of current page. Code from the great K2: http://getk2.com */
            global $notfound;
            if (is_page() and ($notfound != '1')) {
                $current_page = $post->ID;
                while($current_page) {
                    $page_query = $wpdb->get_row("SELECT ID, post_title, post_status, post_parent FROM $wpdb->posts WHERE ID = '$current_page'");
                    $current_page = $page_query->post_parent;
                }
                $parent_id = $page_query->ID;
                $parent_title = $page_query->post_title;
    
                $page_menu = wp_list_pages('echo=0&sort_column=menu_order&title_li=&child_of='. $parent_id);
                if ($page_menu) { ?>
        <li><a href="#tab-5">
          <?php _e('Subpages','rgb'); ?>
          </a></li>
        <?php } } ?>
      </ul>
      <div class="tabs">
        <div id="tab-1">
          <h2>
            <?php _e('Latest','rgb'); ?>
          </h2>
          <ul>
            <?php wp_get_archives('type=postbypost&limit=10'); ?>
          </ul>
        </div>
        <div id="tab-2">
          <h2>
            <?php _e('Categories','rgb'); ?>
          </h2>
          <ul>
            <?php if (function_exists('wp_list_categories')) {
                                        
                                        wp_list_categories('title_li=&show_count=1&hierarchical=0');
                                    
                                    } else {
                                    
                                        list_cats(0, '', 'name', 'asc', '', 1, 0, 1, 1, 1, 1, 0, '', '', '', '', '');
                                    }
                                ?>
          </ul>
        </div>
        <div id="tab-3">
          <h2>
            <?php _e('Meta','rgb'); ?>
          </h2>
          <ul>
            <?php wp_register(); ?>
            <li>
              <?php wp_loginout(); ?>
            </li>
            <li><a href="http://validator.w3.org/check/referer" title="This page validates as XHTML 1.1">Valid <abbr title="eXtensible HyperText Markup Language">XHTML</abbr></a></li>
            <li><a href="http://gmpg.org/xfn/"><abbr title="XHTML Friends Network">XFN</abbr></a></li>
            <li><a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>
            <?php wp_meta(); ?>
          </ul>
        </div>
        <div id="tab-4">
          <ul>
            <?php wp_list_bookmarks('title_before=<h2>&title_after=</h2>'); ?>
          </ul>
        </div>
        <?php if (($wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_parent = '$parent_id' AND post_status != 'attachment'")) && is_page()) { ?>
        <div id="tab-5">
          <h2>
            <?php _e('Subpages','rgb'); ?>
          </h2>
          <ul>
            <?php echo $page_menu; ?>
            <?php if ($parent_id != $post->ID) { ?>
            <li> <a href="<?php echo get_permalink($parent_id); ?>"><?php printf(__('Back to %s','rgb'), apply_filters('the_title',$parent_title) ); ?></a> </li>
            <?php } ?>
          </ul>
        </div>
        <?php } ?>
      </div>
      <?php } ?>
      <?php if(get_option('rgb_shelf') == 1) { ?>
      <span class="thickboxbtn"> <a href="#TB_inline?height=300&amp;width=400&amp;inlineId=sidebarwidgets" id="togglewidgets" class="thickbox" title="<?php _e('More (Press Esc to Close)','rgb'); ?>">
      <?php _e('More','rgb'); ?>
      </a></span>
      <?php } ?>
      <ul id="sidebarwidgets" <?php if(get_option('rgb_shelf') == 1) { ?>style="display:none;"<?php } ?>>
        <?php /* if the Sidebar Widgets plugin is enabled */ if ( function_exists('dynamic_sidebar') && dynamic_sidebar(1) ) : else : ?>
        <li>
          <h2>Meta</h2>
          <ul>
            <li>
              <?php _e('Please use widgets to arrange your sidebar items.','rgb'); ?>
            </li>
          </ul>
        </li>
        <?php /* end for Sidebar Widgets */ endif; ?>
      </ul>
    </div>
    <div class="clear"></div>