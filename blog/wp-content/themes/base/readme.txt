== Installation ==
If you are reading these instructions inside of your WordPress Dashboard, then you can skip down to the Theme Options section below.  You already have this theme installed.

	1. Download Base from your Graph Paper Press [member dashboard](https://graphpaperpress.com/members/member.php) to your Desktop.
	2. Unzip base.zip to your Desktop.	
		* Note: make sure that the extracted folder is `base` and that your ZIP file has not created two levels of folders (for example, `base/base`).
	
	3. Go to `/wp-content/themes/` and make sure that you do not already have a `base` folder installed. If you do, then back it up and remove it from `/wp-content/themes/` before uploading your copy of Base.
	4. Upload `base` to `/wp-content/themes/`.
	5. Activate Base through the Appearance -> Themes menu in your WordPress Dashboard.
	6. Go to Settings -> Media and make sure to enter the following values:	
		* Image sizes		
			** Thumbnail size
				*** Width: 200
				*** Height: 150
				*** [checked] Crop thumbnails to exact dimensions (normally thumbnails are proportional)
				
			** Medium size
				*** Max Width: 620
				*** Max Height: 0
				
			** Large size
				*** Max Width: 940
				*** Max Height: 0
				
		
		* Embeds
			** [checked] When possible, embed the media content from a URL directly onto the page. For example: links to Flickr and YouTube.
			** Maximum embed size
				*** Width: 940
				*** Height: 0
				
	7. Regenerate your thumbnails with the [Regenerate Thumbnails](http://wordpress.org/extend/plugins/regenerate-thumbnails/) WordPress plugin.
		
= Installation Troubleshooting =
If you've performed a clean install of Base and are having problems, make sure that the following conditions have been met: 
			* Make sure that you've installed the theme properly. You should use an FTP program like FileZilla, WinSCP, or Fetch to upload your files. Do not use WordPress' Install a theme in .zip format option.
			* Permissions: On most servers, the theme files should be set to 644 and folders should be set to 755
			* Make sure that you've deactivated all of your plugins before installing and/or upgrading if you continue to have theme activation problems.
			* Your Base folder should be named `base`. Do not rename this folder.
			* If you are upgrading your version of Base, make sure to backup first and completely delete your old version of Base from your server before uploading the new version of Base to your server. With version 1.1 and above, the upgrading has been made simpler. You can go to Base -> Updates in your menu, add your API key from your [member dashboard](https://graphpaperpress.com/members/member.php) and click the Update button.
			* Base uses jQuery for much of its functionality. If parts of your theme appear broken or unresponsive, then you likely have a JavaScript conflict being caused by an active plugin. Deactivate your plugins, one-by-one, to determine which plugin is conflicting with jQuery.

= Theme Options =
This theme comes with Theme Options for controlling many aspects of the design, fonts, widgets, etc. Visit Appearance -> Base Options to get started.

= Menus =
This theme supports two menus - Main Menu and a Top Menu. In case you don't see menu while you activate your theme, go to Appearance -> Menus and add new menus. On the left side box where it says Theme Locations, choose your menu to place it on appropriate region. You can then add categories, pages and custom links to this new menu. You can also drag and drop menus around to make sub menus or reorder them. [Watch video tutorial](http://vimeo.com/16432328).

= Header Images =
This also supports Custom Header feature, which is a great way to change the custom header image of you choice. Add yours by clicking Appearance -> Header.

= Backgrounds =
Custom background is another great feature of WordPress that is supported in Base. Add yours by clicking Appearance -> Background.

= Widgets: =
There are six widgetized areas in Base (Home, Footer Widget 1, Footer Widget 2, Footer Widget 3, Footer Widget 4, and Sidebar). You can add a variety of Widgets to this theme on the Appearance -> Widgets tab in WordPress. We create plugins that add Widgets to your site, such as a Welcome Message, About Section, Testimonials Section, Slideshows, etc. Many of these plugins were made specifically for Base and Base child themes. You can [download these plugins](http://wordpress.org/extend/plugins/tags/graphpaperpress) from the WordPress repository.

= Slideshows: =
Slideshows can be added using the new [GPP Slideshow plugin](http://wordpress.org/extend/plugins/gpp-slideshow/). [Download the plugin](http://wordpress.org/extend/plugins/gpp-slideshow/), upload it into your plugins folder, and then activate the plugin in WordPress. After creating a gallery slideshow, visit your Appearance -> Widgets page and drag the GPP Slideshow Widget into the Homepage widget area. Select the gallery you want to display for your Homepage slideshow and click Save.

= Page Templates: =
This theme comes packaged with three page templates: Default, Blog and Wide Page. The Default template inherits the Sidebar settings on your theme options. The Blog template pulls in all Blog posts onto one page so you can create a page url like this: http://graphpaperpress.com/blog/. You need to specify your Blog category on the theme options page before creating this Blog page. Simply create a Page called Blog and assign it to the Blog page template (located to the right underneath the Page Attributes section. If the Page Attributes section is not visible, you can click the isn't visible, toggle the Screen Options tab located in the upper right and check the Page Attributes checkbox.) Publish the Page out (it will not have any content). The Wide Page template does not have a Sidebar. Use it for creating Pages with Column Shortcodes (more info about shortcodes in next section).

= Built-in HD video player for self-hosted HD-quality videos; multiple videos per Post or Page are supported: =
The built-in video player plays FLV files. To add a video to a Post or Page, create a custom field key/value pair of `video | http://your-domain.com/path/to/your/video/file.flv`.  In order to set a thumbnail for your video player, create a custom field key/value pair of `video-thumb | http://your-domain.com/path/to/your/video/thumbnail.jpg`  For multiple videos within a Post or Page, enter more than 1 custom field key/value pair for `video|URL` and `video-thumb|URL`, for example:
	* `video | http://your-domain.com/path/to/your/video/file.flv`
	* `video-thumb | http://your-domain.com/path/to/your/video/thumbnail.jpg`
	* `video | http://your-domain.com/path/to/your/video/file-2.flv`
	* `video-thumb | http://your-domain.com/path/to/your/video/thumbnail-2.jpg`

= Mobile Video: =
To serve mobile-friendly video files to users with Flash either disabled or not available, first enable the Mobile Video option on the theme options page. Then, follow these instructions:

	1. Compress your video file into one of the recommended mobile-friendly video formats.
	2. Upload the file to your server using your favorite method. Use FTP for large files. Use WordPress' built-in media upload tools for small files.
	3. Copy and paste the link to the file into a custom field called iphone.
	4. If you haven't done so already, add a video thumbnail. You can do this the exact way that you add regular thumbnails, except, you will want to add an image large enough to fit the maximum size of the video player. If you have the sidebar enabled, you will want to copy the url to the 620 pixel wide image. For sites with sidebars disabled, use the 940px wide image. Add the video thumbnail to a custom field with key value video-thumb.


= Embed multimedia into Posts or Pages: =
For externally hosted videos (for example a YouTube or Vimeo video), you can directly paste the link of your video page into the content editor. You do not have to paste the embed code. WordPress will automatically embed the video from the link.

= Theme Internationalization: =
Base is currently only available in English (US). It does have a default.pot file which you can use to translate to any other language you want.  See [WordPress in Your Language](http://codex.wordpress.org/WordPress_in_Your_Language) for more information on using a different language than English with your copy of Base.

== Credits ==
* [Chandra Maharzan](http://graphpaperpress.com/about), designer/developer
* [Sanam Maharjan](http://graphpaperpress.com/about), developer
* [Thad Allender](http://graphpaperpress.com/about), founder/designer/developer