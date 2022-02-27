= About =

Immersion is a responsive one, two or three column WordPress theme, with post format support, alternative color styles and cool gallery features.


= Installation =

	1. Download Immersion from your Graph Paper Press [member dashboard](https://graphpaperpress.com/members/member.php) to your Desktop.
	2. Unzip immersion.zip to your Desktop.	
		* Note: make sure that the extracted folder is `immersion` and that your ZIP file has not created two levels of folders (for example, `immersion/immersion`).
	
	3. Go to `/wp-content/themes/` and make sure that you do not already have a `retouch-pro` folder installed. If you do, then back it up and remove it from `/wp-content/themes/` before uploading your copy of Immersion.
	4. Upload `Immersion` to `/wp-content/themes/`.
	5. Activate Immersion through the Appearance -> Themes menu in your WordPress Dashboard.
	6. Go to Settings -> Media and make sure the following values are set:	
		* Image sizes		
			** Thumbnail size
				*** Width: 150
				*** Height: 150
				*** [checked] Crop thumbnails to exact dimensions (normally thumbnails are proportional)
				
			** Medium size
				*** Max Width: 700
				*** Max Height: 0
				
			** Large size
				*** Max Width: 1000
				*** Max Height: 0
				
		* Embeds
			** [checked] When possible, embed the media content from a URL directly onto the page. For example: links to Flickr and YouTube.
			** Maximum embed size
				*** Width: 700
				*** Height: 0

	7. Regenerate your thumbnails with the [Regenerate Thumbnails](http://wordpress.org/extend/plugins/regenerate-thumbnails/) WordPress plugin.


= Always Set Featured Images =
This theme relies heavily on Featured Images. If your post is missing a Featured Image, the post might not show up on the homepage or on archive pages. The Post Formats section below explains .


= Post Formats =
Immersion supports the following "post formats" which are basically unique layouts for specific types of posts: gallery, image, audio, video, quote, link, standard. This will come in really handy if you want to post slideshows (use the gallery post format) or screenshots of projects (use the image post format), videos (for video content), audio (for playing mp3s in html5 format), links (for quick updates where a full blog post isn't needed), quotes (for referencing someone and providing a link back to their site) or standard (for normal blog posts). Each post format has their own unique layout on the homepage, on their respective post format archive page and on their individual single post pages.

In order to use these theme features, you must activate the WP Post Format plugin. You will be prompted to activate this plugin after activating the theme. Once activated, you will see new fields/tabs appearing above the Post Title area. Each Post Format has specific fields that will be shown. Fill out the respective Post Format tab and click save.

* Image Post Formats - If you only want to show one image, upload the image using the Add Media button and assign it as the Featured Image for the post. DO NOT INSERT THE IMAGE into the visual editor. If you do, the image will appear again in the Info dropdown tab.

* Gallery Post Formats - If you want to show a slideshow of images (an image gallery), upload as many images as you like using the Add Media button and be sure 
to assign a Featured Image for that post. DO NOT INSERT THE GALLERY into the visual editor. If you do, the gallery will appear twice. All posts assigned to the Gallery Post Format will then assume a specific style, with the Gallery shown above and with any text content inserted into the visual editor shown below on the single post template.

* Video Post Formats - Paste EMBED code into the Video Tab. The video will be shown above all post content on the homepage, single and archive pages. This works for all interatives (video, maps, panoramas) that have embed code.

* Audio Post Formats - Upload an MP3 using the ADD MEDIA tool and paste the URL to the MP3 file into the Audio File Field. An HTML5 audio player will show up at the top of the post.

* Quote Post Formats - Fill out the fields and the assigned Quote will show up styled as a block quote on the homepage, single and archive pages.

* Link Post Formats - Provide a link and title for the link. A minimalist link post will be displayed.

* Standard Post Formats - Use the Standard Post Format to show whatever you insert into the visual editor on the homepage and on single posts. Be sure to upload and assign and image for each post and assign an image as the Featured Image for the post.


= Theme Options =
Visit the Appearance -> Theme Options page to setup your theme, upload a logo, select alternative styles and add custom css. If you want to hide the description of your site, simple paste this code into the custom css box: `#site-description { display: none; }`.


= Widgets =
There are 3 widgetized areas in Immersion (Footer Widget 1, Footer Widget 2, Footer Widget 3). You can choose how many Footer widgets you want to show on the Appearance -> Theme Options -> Layout tab.  After you have selected the number of widgets you want to show, you can add a variety of Widgets to this theme on the Appearance -> Widgets tab in WordPress.


= Menus =
Visit the Appearance -> Menus page to create custom navigational menus. Here is a video tutorial on creating custom menus: http://vimeo.com/16432328

This theme supports 4 Theme Locations for your Menus: Main (the main navigation for your website), Top Right Social (used to display social media icons on the demo site), Top Right Secondary (used to display Pages on the demo site) and Footer.  Theme Locations are specific areas in this theme where your menus can appear.  After creating your menu, be sure you add it to a Theme Location.

== Social Media Icons == 
The Social Menu Theme Location requires some special treatment in order to generate the icons for each link.  When you are on the Appearance -> Menu admin panel, click on the Screen Options link at the top right of the page and select CSS Classes from the `Show Advanced Menu Properties` sub-section.  This theme supports a total of six custom icons.  Specify the following CSS Classes underneath each menu item to generate the corresponding social media icon: facebook, twitter, youtube, vimeo, apple, rss. See [this screenshot] (http://images.graphpaperpress.com.s3.amazonaws.com/wp-menus-social-media-class.jpg) for an example of a properly filled out Social Media Menu link for Facebook.


= Embed multimedia into Posts or Pages =
For externally hosted videos (for example a YouTube or Vimeo video), you can directly paste the link of your video page into the content editor. You do not have to paste the embed code. WordPress will automatically embed the video from the link.


= Hooks =

If you are a developer, you can use the following hooks to modify different areas of this theme:

gpp_before_page
gpp_before_header
gpp_after_header
gpp_before_article
gpp_after_article
gpp_before_title
gpp_after_title
gpp_before_content
gpp_after_content
gpp_before_meta
gpp_after_meta
gpp_before_sidebar
gpp_after_sidebar
gpp_before_footer
gpp_credits
gpp_after_footer


= Known Issues =
None yet.