=== Tumblr Importer ===
Contributors: Otto42, wordpressdotorg, dd32, westi
Tags: tumblr, import
Requires at least: 3.2
Tested up to: 3.3
Stable tag: trunk

== Description ==

Imports a Tumblr blog into a WordPress blog.

* Correctly handles post formats
* WP-Cron based background importing: start it up, then come back later to see how far it's gotten
* Duplicate checking, will not create duplicate imported posts
* Imports posts, drafts, and pages
* Media Sideloading (for audio, video, and image posts)

== Installation ==

1. Upload the files to the `/wp-content/plugins/tumblr-importer/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Go to Tools->Import and use the new importer.

== Upgrade Notice ==

== Changelog ==
= 0.5 =
* Fix edge cases for tumblr photos where tumblr isn't returning expected headers for filenames

= 0.4 =
* Map multi-image posts to Gallery post format
* Import Tags
* Import Media to server (Images, Audio, Custom uploaded Video's)
* Set the date on Media imports for easier management

= 0.3 = 
* Handle multi-image posts
* Handle question/answer posts
* Handle video posts somewhat better
* Speedup (reduce importer delay from 3 minutes to 1 minute)

= 0.2 = 
* The audio, video, and image formats no longer use the caption for the titles. Tumblr seems to facilitate putting all sorts of crazy stuff into the caption fields as part of their reblogging system. So instead, these types of posts will have no titles at all. Sorry, but Tumblr simply doesn't have any sort of title fields here to work with, and no data that can be used to "create" a title for them.
* Minor debug error cleanup.
* Sideloading now done on drafts and pages as well.

= 0.1 =
* First version, not meant to be used except for testing.
