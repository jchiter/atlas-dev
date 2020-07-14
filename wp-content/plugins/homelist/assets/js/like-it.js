jQuery(document).ready( function($) {	
	$('.like-it').on('click', function() {	
	    var $this = $(this);
		if($this.hasClass('liked')) {
			alert(like_it_vars.already_liked_message);
			return false;
		}	
		var post_id = $this.data('post-id');
		var user_id = $this.data('user-id');
		var post_data = {
			action: 'like_it',
			item_id: post_id,
			user_id: user_id,
			like_it_nonce: like_it_vars.nonce
		};
		$.post(like_it_vars.ajaxurl, post_data, function(response) {
			if(response == 'liked') {
			    $this.addClass('liked');
			    alert(like_it_vars.liked_message);
			} else {
				alert(like_it_vars.error_message);
			}
		});
		return false;
	});
	$('.liked').on('click', function() {
	    //alert(like_it_vars.already_liked_message);
	    var $this = $(this);
	    var post_id = $this.data('post-id');
	    var user_id = $this.data('user-id');
	    var post_data = {
	        action: 'dislike_it',
	        item_id: post_id,
	        user_id: user_id,
	        like_it_nonce: like_it_vars.nonce
	    };
	    $.post(like_it_vars.ajaxurl, post_data, function (response) {
	        if (response == 'disliked') {
	            $this.removeClass('liked');
	            $this.addClass('like-it');
	            alert(like_it_vars.disliked_message);
	        } else {
	            alert(like_it_vars.error_message);
	        }
	    });
	    
	    return false;
	});
});