
== Installation ==
If you are reading these instructions inside of your WordPress Dashboard, then you can skip down to the Theme Options section below.  You already have this theme installed.

	1. Download Uno from your Graph Paper Press [member dashboard](https://graphpaperpress.com/members/member.php) to your Desktop.
	2. Unzip uno.zip to your Desktop.	
		* Note: make sure that the extracted folder is `uno` and that your ZIP file has not created two levels of folders (for example, `uno/uno`).
	
	3. Go to `/wp-content/themes/` and make sure that you do not already have a `uno` folder installed. If you do, then back it up and remove it from `/wp-content/themes/` before uploading your copy of Uno.
	4. Upload `uno` to `/wp-content/themes/`.
	5. Activate Uno through the Appearance -> Themes menu in your WordPress Dashboard.
	6. Go to Settings -> Media and make sure to enter the following values:	
		* Image sizes		
			** Thumbnail size
				*** Width: 300
				*** Height: 200
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
	
= Theme Options: =
This theme comes with Theme Options for controlling many aspects of the design, fonts, widgets, etc. Visit Appearance -> Theme Options to get started.

= Galleries: =
Upload images into the Post using WordPress' Add Media tool and insert the gallery into the post using the INSERT GALLERY button. Shortcode will be added into the Post Editor.  Assign a Featured Image for each Post.  This Featured Image will be used to represent this Post on your Archive Pages.  To remove an image from the slideshow, simply delete or unattach that specific image from the post. Please note that this method has been implemented since version 2.0. So, if you are upgrading from older version, you will have to revisit your posts and Insert Gallery to them otherwise your frontend will not show images/galleries.

= Categories: =
This theme relies on categories for changing the design of each post. Thus, it's best to NOT assign posts to more than one category at a time. Otherwise, navigating between posts can take users from a Gallery post directly into a Blog post, thus interrupting the flow between Galleries. Assign each post to one category and you will be good to go.

= Page Templates: =
This theme comes packaged with a Page template for displaying a list of all Posts, regardless of category. To create this Blog page, create a Page called Blog and assign it to the Blog page template (located to the right underneath the Page Attributes section. If the Page Attributes section is not visible, you can click the isn't visible, toggle the Screen Options tab located in the upper right and check the Page Attributes checkbox.)

= Menus: =
To add menu to your website, go to Appearance -> Menus and add a new menu. You can then add categories, pages and custom links to this new menu. You can also drag and drop menus around to make sub menus or reorder them. [Watch video tutorial](http://vimeo.com/16432328).

= Widgets: =
There are four widgetized areas in Uno (Footer Widget 1, Footer Widget 2, Footer Widget 3, Footer Widget 4). You can add a variety of Widgets to this theme on the Appearance -> Widgets tab in WordPress.

= Built-in HD video player: =
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
Uno is currently only available in English (US). It does have a default.pot file which you can use to translate to any other language you want.  See [WordPress in Your Language](http://codex.wordpress.org/WordPress_in_Your_Language) for more information on using a different language than English with your copy of Base.

= Installation Troubleshooting: =

If you've performed a clean install of Uno and are having problems, make sure that the following conditions have been met: 
			* Make sure that you've installed the theme properly. You should use an FTP program like FileZilla, WinSCP, or Fetch to upload your files. Do not use WordPress' Install a theme in .zip format option.
			* Permissions: On most servers, the theme files should be set to 644 and folders should be set to 755
			* Make sure that you've deactivated all of your plugins before installing and/or upgrading if you continue to have theme activation problems.
			* Your Uno folder should be named `uno`. Do not rename this folder.
			* If you are upgrading your version of Uno, make sure to backup first and completely delete your old version of Uno from your server before uploading the new version of Uno to your server. With version 1.1 and above, the upgrading has been made simpler. You can go to Uno -> Updates in your menu, add your API key from your [member dashboard](https://graphpaperpress.com/members/member.php) and click the Update button.
			* Uno uses jQuery for much of its functionality. If parts of your theme appear broken or unresponsive, then you likely have a JavaScript conflict being caused by an active plugin. Deactivate your plugins, one-by-one, to determine which plugin is conflicting with jQuery.

