jQuery(document).ready(function($){
    
    // Like Icon
	if($('.like-count').length) {
		$('.like-count a').live('click',function() {
			var id = $(this).attr('id');
			id = id.split('like-');
			$.ajax({
				url: bandit.ajaxurl,
				type: "POST",
				dataType: 'json',
				data: { action : 'bandit_liked_ajax', id : id[1] },
				success:function(data) {
					if(true==data.success) {
						$('#like-'+data.postID).html('<i class="icon"></i> '+data.count);
						$('#like-'+data.postID).addClass('active');
					}
				}
			});
			return false;
		});
	}


});