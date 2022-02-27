
== Installation ==
If you are reading these instructions inside of your WordPress Dashboard, then you can skip down to the Theme Options section below.  You already have this theme installed.

	1. Download Immense from your Graph Paper Press [member dashboard](https://graphpaperpress.com/members/member.php) to your Desktop.
	2. Unzip immense.zip to your Desktop.	
		* Note: make sure that the extracted folder is `immense` and that your ZIP file has not created two levels of folders (for example, `immense/immense`).
	
	3. Go to `/wp-content/themes/` and make sure that you do not already have a `immense` folder installed. If you do, then back it up and remove it from `/wp-content/themes/` before uploading your copy of Immense.
	4. Upload `immense` to `/wp-content/themes/`.
	5. Activate Immense through the Appearance -> Themes menu in your WordPress Dashboard.
	6. Go to Settings -> Media and make sure to enter the following values:	
		* Image sizes		
			** Thumbnail size
				*** Width: 150
				*** Height: 150
				*** [checked] Crop thumbnails to exact dimensions (normally thumbnails are proportional)
				
			** Medium size
				*** Max Width: 620
				*** Max Height: 0
				
			** Large size
				*** Max Width: 940
				*** Max Height: 800
				
		
		* Embeds
			** [checked] When possible, embed the media content from a URL directly onto the page. For example: links to Flickr and YouTube.
			** Maximum embed size
				*** Width: 940
				*** Height: 0
				
	
	
	7. Regenerate your thumbnails with the [Regenerate Thumbnails](http://wordpress.org/extend/plugins/regenerate-thumbnails/) WordPress plugin.
		
= Installation Troubleshooting =

If you've performed a clean install of Immense and are having problems, make sure that the following conditions have been met: 
			* Make sure that you've installed the theme properly. You should use an FTP program like FileZilla, WinSCP, or Fetch to upload your files. Do not use WordPress' Install a theme in .zip format option.
			* Permissions: On most servers, the theme files should be set to 644 and folders should be set to 755
			* Make sure that you've deactivated all of your plugins before installing and/or upgrading if you continue to have theme activation problems.
			* Your Immense folder should be named `immense`. Do not rename this folder.
			* If you are upgrading your version of Immense, make sure to backup first and completely delete your old version of Immense from your server before uploading the new version of Immense to your server. With version 1.1 and above, the upgrading has been made simpler. You can go to Immense -> Updates in your menu, add your API key from your [member dashboard](https://graphpaperpress.com/members/member.php) and click the Update button.
			* Immense uses jQuery for much of its functionality. If parts of your theme appear broken or unresponsive, then you likely have a JavaScript conflict being caused by an active plugin. Deactivate your plugins, one-by-one, to determine which plugin is conflicting with jQuery.
			
= Known Issues =

		*IE7 next previous navigation is opposite than it should be. A fix will be sought at a later time.

			
== Usage ==
This section contains info for using the unique features of this theme.  If you are new to using WordPress, please checkout our [video tutorials](http://vimeo.com/graphpaperpress/videos).

= Theme Options =
This theme comes with Theme Options for controlling many aspects of the design, fonts, widgets, etc. Visit Appearance -> Immense Options to get started.

= Slideshows: =
Slideshows can be added to Posts, Pages and Galleries (a new custom post type built specifically for Immense).  To add a Slideshow to a Post, Page, or Gallery custom post type, use WordPress' Upload button to upload images.  After uploading, writing captions and sorting into your preferred order, click Save All Changes.  On the next page, click the Insert Gallery button.  After the gallery is inserted into the post, you will see the gallery shortcode.  The shortcode looks like this: [gallery].  Publish out the post and view your gallery.

By default, the content of your Post or Page will appear on top of your Gallery.  This is only for Posts and Pages.  Use the Gallery custom post type if you want to hide the content by default.

= Menus =
To add menu to your website, go to Appearance -> Menus and add a new menu. You can then add categories, pages and custom links to this new menu. You can also drag and drop menus around to make sub menus or reorder them. [Watch video tutorial](http://vimeo.com/16432328).

= Widgets: =
There are five widgetized areas in Immense (Footer Widget 1, Footer Widget 2, Footer Widget 3, Footer Widget 4, and Sidebar). You can add a variety of Widgets to this theme on the Appearance -> Widgets tab in WordPress.

= Backgrounds =
Custom background is another great feature of WordPress that is supported in Immense. Add yours by clicking Appearance -> Background.  This will replace the default Brick background image.

= Built-in HD video player for self-hosted HD-quality videos; multiple videos per Post or Page are supported: =
The built-in video player plays FLV files. To add a video to a Post or Page, create a custom field key/value pair of `video | http://your-domain.com/path/to/your/video/file.flv`.  In order to set a thumbnail for your video player, create a custom field key/value pair of `video-thumb | http://your-domain.com/path/to/your/video/thumbnail.jpg`  For multiple videos within a Post or Page, enter more than 1 custom field key/value pair for `video|URL` and `video-thumb|URL`, for example:
	* `video | http://your-domain.com/path/to/your/video/file.flv`
	* `video-thumb | http://your-domain.com/path/to/your/video/thumbnail.jpg`
	* `video | http://your-domain.com/path/to/your/video/file-2.flv`
	* `video-thumb | http://your-domain.com/path/to/your/video/thumbnail-2.jpg`


= Embed multimedia into Posts or Pages: =
For externally hosted videos (for example a YouTube or Vimeo video), you can directly paste the link of your video page into the content editor. You do not have to paste the embed code. WordPress will automatically embed the video from the link.

= Theme Internationalization: =
Immense is currently only available in English (US). It does have a default.pot file which you can use to translate to any other language you want.  See [WordPress in Your Language](http://codex.wordpress.org/WordPress_in_Your_Language) for more information on using a different language than English with your copy of Base.
