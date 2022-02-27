// Switches out the main site nav#access with a select box
// Minimizes nav#access on mobile devices
// Now lets load the JS when the DOM is ready
jQuery(document).ready(function($){

    // adds parent class to main nav items with child lists
    $("nav#access li:has(ul)").addClass("parent");

    // Generic show and hide wrapper class
    $(".wrap").hover(function(){
      $(".hide", this).fadeTo(300, 1.0); // This sets 100% on hover
      $(".fade", this).fadeTo(300, 0.7); // This sets 70% on hover
      $(".show", this).fadeTo(300, 0.2); // This sets 100% on hover
    },function(){
      $(".hide", this).fadeTo(300, 0); // This should set the opacity back to 0% on mouseout
      $(".fade", this).fadeTo(300, 1.0); // This sets 80% on hover
      $(".show", this).fadeTo(300, 1.0); // This should set the opacity back to 0% on mouseout
    });

    // Zebra stipes for tables
    $(".half:nth-child(2n+2)").addClass("end");
    $(".third:nth-child(3n+3)").addClass("end");
    $("td:odd").addClass("odd");

    // FitVids
    $(".post-format-content").fitVids();

    // prettyPhoto
    $("a[rel^='prettyPhoto']").prettyPhoto({
       show_title: false,
       theme: 'light_square',
       autoplay: true
    });

    // FlexSlider
    $('.flexslider').flexslider({
     manualControls: '.flex-control-nav li',
     controlNav: true
    });

    // Opacity Effects
    var $SingleItem = $('.post-format-content');
    $SingleItem.hover(function(){

    	$(this).find('.img-entry').stop(true, true).animate({opacity: 0.6},200);
    }, function(){
    	$(this).find('.img-entry').stop(true, true).animate({opacity: 1},200);

    });

    // Like Icons
    if($('.like-count').length) {
    	$('.like-count').live('click',function() {
    		var id = $(this).attr('id');
    		id = id.split('like-');
    		$.ajax({
    			url: gpp.ajaxurl,
    			type: "POST",
    			dataType: 'json',
    			data: { action : 'gpp_liked_ajax', id : id[1] },
    			success:function(data) {
    				if(true==data.success) {
    					$('#like-'+data.postID).text(data.count);
    					$('#like-'+data.postID).addClass('active');
    				}
    			}
    		});
    		return false;
    	});
    }
	
	// Like Active Class
	$('.like-count').each(function() {
	    var $like_count = 0;
		var $like_count = $(this).text();
		if($like_count != 0) {
	        $(this).addClass('active');
	    }
	});


});