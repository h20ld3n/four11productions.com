=== WP Post Formats ===
Contributors: casben79
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=A294B29ULQHUU&lc=AU&item_name=Wp%20Post%20Formats%20Donation&item_number=wppf%20donation&currency_code=AUD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted
Tags: post formats, wordpress 3.1
Requires at least: 3.1
Tested up to: 3.1
Stable tag: 0.2

Allows You To Easily Edit Post Formats display.

== Description ==

WP Post Formats creates a visual interface for modifying and editing how your post formats are formatted.

There Are A Number Of Tags Available To Use In Your Loops And You Can Add More Via A Hook.

**Tags:**


{_permalink_}
{_content, more_link_text, stripteaser_} 
{_excerpt_}
{_title, before, after_} 
{_tags, before, sep, after_} 
{_author_} 
{_category, seperator, parents_} 
{_time_}
{_post-thumbnail, size_}
{_term-list, taxonomy, before, sep, after_}
{_post-class_}


**Hooks:**

`do_action( 'wppf_tags' );` - Runs Right After The Tags Are Handled, Allowing You To Add More As You Please ( Let Me Know Ill Put Them In The Next Release)

`apply_filters( 'wppf_before_tag' , '{_' );` - Allows you to filter the Start Tag used
`apply_filters( 'wppf_after_tag' , '_}' );` - Allows you to filter the End Tag used

If You Have Any Feedback Or Suggestions, Feel Free To Drop Me A Line At [Tiger Strike Media]( http://www.tigerstrikemedia.com/ )

== Installation ==

1. Upload The wp-post-formats folder to the `/wp-content/plugins/` directory on your server
2. Activate the plugin in the admin interface
3. insert the Template Tag `<?php if( function_exists( 'display_wp_post_format' ) ) { display_wp_post_format() ; } ?>` in between the loop in your theme where you want the post format differences to be displayed.

== Screenshots ==

1. The Admin Interface Of WP Post Formats

== Changelog ==

= 0.2 =
* Security Release . Significant Enhancements To Plugin Security With The Introduction Of A Tag System And The Removal Of eval() Usage.

= 0.1 =
* Initial Release


== Upgrade Notice ==

= 0.2 = 
* Security Release, It Is Highly Recommended You Upgrade Now.

= 0.1 = 
* Initial Release
