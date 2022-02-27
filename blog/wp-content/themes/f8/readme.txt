=== F8 ===

** NOTE: F8 is a child theme for Modularity, a multimedia theme framework for WordPress. You must have Modularity installed for F8 to work. **


== Installation ==
This section describes how to install F8 and get it working. 

	1. Download F8 from your Graph Paper Press [member dashboard](https://graphpaperpress.com/members/member.php) to your Desktop.
	2. Unzip f8.zip to your Desktop.	
		* Note: make sure that the extracted folder is `f8` and that your ZIP file has not created two levels of folders (for example, `f8/f8`).
	
	3. Go to `/wp-content/themes/` and make sure that you do not already have a `f8` folder installed. If you do, then back it up and remove it from `/wp-content/themes/` before uploading your copy of F8.
	4. Upload `f8` to `/wp-content/themes/`.
	5. Activate F8 through the Appearance -> Themes menu in your WordPress Dashboard.
	6. Go to Settings -> Media and make sure to enter the following values:	
		* Image sizes		
			** Thumbnail size
				*** Width: 310
				*** Height: 150
				*** [checked] Crop thumbnails to exact dimensions (normally thumbnails are proportional)
				
			** Medium size
				*** Max Width: 590
				*** Max Height: 0
				
			** Large size
				*** Max Width: 950
				*** Max Height: 0
				
		
		* Embeds
			** [checked] When possible, embed the media content from a URL directly onto the page. For example: links to Flickr and YouTube.
			** Maximum embed size
				*** Width: 620
				*** Height: 0
		

= Theme Options =

This theme has seven optional homepage designs:

	* Slideshow Section - A full page slideshow
	* HD Video Section - A full page video presentation
	* Featured Sliding Posts - A horizontal slider that reveals six 	featured posts
	* Thumbnail Slider - A horizontal list of thumbnails representing 	recent posts
	* Featured Section - A main post at left, with three earlier posts 	at right
	* Blog Section- A normal tubular list of posts
	* Categories Section - A five column grid of selected categories

Please activate each option and view your new homepage design. Remember, less is more.

= Thumbnails =

Every Post needs to have a Featured Image assigned to it.  You can assign a Featured Image by uploading an image to the Post, and then click the "Use as featured image" button to make the image the Featured Image for that post.  [Watch a video tutorial](http://vimeo.com/8462281).

If you are migrating from an old theme to a new theme and your thumbnails look squished or distorted, you might need to re-upload the image you plan on using for the post thumbnail. This is because WordPress creates your image sizes based on the dimensions you specified above. Old thumbnails will not be automatically resized.  You can regenerate your thumbnails with the [Regenerate Thumbnails](http://wordpress.org/extend/plugins/regenerate-thumbnails/) WordPress plugin.


= Video =

Paste the link to your video onto any page or post and WordPress will automatically embed the video from the link.

= Menus = 

This theme has built-in support for WordPress' new Menu system, which will be released in version 3.0. This new system, which can be accessed at Appearance -> Menus, allows you to drag and drop menu items with total ease. You can also add custom links.


= Widgets: =

	* There are a total of three widgetized areas on this theme, depending on which options you activate on the Theme Options panel. Three widgetized areas appear on the bottom and there is one sidebar widget. You can add and delete widgets by clicking Design - Widgets, from within your Wordpress admin panel..

= Advertising =

	* This theme has two built-in spots for advertising: One in the sidebar, which measures 310 pixels wide, and one underneath the main post, which measures 590 pixels wide. You can add your adversing code on the Theme Options panel.

= Blog Archive Display =

	* This theme contains a file called category-blog.php. This file determines the layout of your blog category archive page. This layout is a tubular layout, different from the three-column thumbnail grid archive page that shows by default. To use the Blog Archive template, just create a category called "blog" and you are good to go. If you want to have other categories use this archive template layout, just duplicate the category-blog.php file and change the ending word "blog" to the name of your desired category.

