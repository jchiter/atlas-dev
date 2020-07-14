<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


class Homelist_Like_It {

	public static function init() {
        add_action( 'wp_ajax_like_it', array( get_called_class(), 'process_like_request' ) );
        add_action( 'wp_ajax_dislike_it', array( get_called_class(), 'process_dislike_request' ) );
        add_filter( 'the_content', array( __CLASS__, 'display_like_link' ), 10, 2 );
        add_action( 'wp_enqueue_scripts', array( __CLASS__, 'front_end_js' ) );
	}

    // check whether a user has liked an item
    public static function user_has_liked_post($user_id, $post_id) {

	    // get all item IDs the user has liked
	    $liked = get_user_option('homelist_user_likes', $user_id);
	    if(is_array($liked) && in_array($post_id, $liked)) {
		    return true; // user has liked post
	    }
	    return false; // user has not liked post
    }

    // adds the liked ID to the users meta so they can't like it again
    public static function update_post_id_for_user($user_id, $post_id, $remove = false) {
	    $liked = get_user_option('homelist_user_likes', $user_id);
        
        if ( ! $remove ) {
	        if(is_array($liked)) {
		        $liked[] = $post_id;
	        } else {
		        $liked = array($post_id);
	        }
        } else {
		    if(($key = array_search($post_id, $liked)) !== false) {
			    unset($liked[$key]);
		    }
        }

	    update_user_option($user_id, 'homelist_user_likes', $liked);
    }

    // increments a like count
    public static function mark_post_as_liked($post_id, $user_id) {

	    // retrieve the like count for $post_id	
	    $like_count = get_post_meta($post_id, '_homelist_like_count', true);
	    if($like_count)
		    $like_count = $like_count + 1;
	    else
		    $like_count = 1;
	
	    if(update_post_meta($post_id, '_homelist_like_count', $like_count)) {	
		    // store this post as liked for $user_id	
		    self::update_post_id_for_user($user_id, $post_id);
		    return true;
	    }
	    return false;
    }

    // decrease like count
    public static function mark_post_as_disliked($post_id, $user_id) {

	    // retrieve the like count for $post_id	
	    $like_count = get_post_meta($post_id, '_homelist_like_count', true);
	    if($like_count)
		    $like_count = $like_count - 1;
	    else
		    $like_count = 0;
	
	    if(update_post_meta($post_id, '_homelist_like_count', $like_count)) {	
		    // store this post as liked for $user_id	
		    self::update_post_id_for_user($user_id, $post_id, true);
		    return true;
	    }
	    return false;
    }

    // returns a like count for a post
    public static function get_like_count($post_id) {
	    $like_count = get_post_meta($post_id, '_homelist_like_count', true);
	    if($like_count)
		    return $like_count;
	    return 0;
    }

    // processes the ajax request
    public static function process_like_request() {
	    if ( isset( $_POST['item_id'] ) && wp_verify_nonce($_POST['like_it_nonce'], 'like-it-nonce') ) {
		    if(self::mark_post_as_liked($_POST['item_id'], $_POST['user_id'])) {
			    echo 'liked';
		    } else {
			    echo 'failed';
		    }
	    }
	    die();
    }

    public static function process_dislike_request() {
	    if ( isset( $_POST['item_id'] ) && wp_verify_nonce($_POST['like_it_nonce'], 'like-it-nonce') ) {
		    if(self::mark_post_as_disliked($_POST['item_id'], $_POST['user_id'])) {
			    echo 'disliked';
		    } else {
			    echo 'failed';
		    }
	    }
	    die();
    }

    // outputs the like it link
    public static function like_content_link($like_text = null, $liked_text = null) {

	    global $user_ID, $post;

	    // only show the link when user is logged in and on a singular page
	    if( is_user_logged_in() ) {

		    ob_start();
	
		    // retrieve the total like count for this item
		    $like_count = self::get_like_count( $post->ID );
		
		    // our wrapper DIV
		    echo '<div class="like-it-content">';
		
			    $like_text = is_null( $like_text ) ? __( 'Love It', 'homelist' ) : $like_text;
			    $liked_text = is_null( $liked_text ) ? __( 'You have liked this', 'homelist' ) : $liked_text;
			
			    // only show the Love It link if the user has NOT previously liked this item
			    if( ! self::user_has_liked_post( $user_ID, get_the_ID() ) ) {
				    echo '<a href="#" class="like-it" data-post-id="' . esc_attr( get_the_ID() ) . '" data-user-id="' .  esc_attr( $user_ID ) . '">' . $like_text . '</a> (<span class="like-count">' . $like_count . '</span>)';
			    } else {
				    // show a message to users who have already liked this item
				    echo '<span class="liked">' . $liked_text . ' (<span class="like-count">' . $like_count . '</span>)</span>';
			    }
		
		    // close our wrapper DIV
		    echo '</div>';
		
		    // append our "Love It" link to the item content.
		    $link = ob_get_clean();
	    }
	    return $link;
    }

    public static function like_link($post_id) {

	    global $user_ID;

	    // only show the link when user is logged in and on a singular page
	    if( is_user_logged_in() ) {			
			// only show the Love It link if the user has NOT previously liked this item
			if( ! self::user_has_liked_post( $user_ID, $post_id ) ) {
				echo '<a href="#" class="like-it" data-post-id="' . esc_attr( $post_id ) . '" data-user-id="' .  esc_attr( $user_ID ) . '" title="' . __( 'Add to Favorite', 'homelist' ) . '"><i class="flaticon-heart-1"></i></a>';
			} else {
				// show a message to users who have already liked this item
				echo '<a href="#" class="liked" data-post-id="' . esc_attr( $post_id ) . '" data-user-id="' .  esc_attr( $user_ID ) . '" title="' . __( 'Remove From Favorites', 'homelist' ) . '"><i class="flaticon-heart-1"></i></a>';
			}
	    }
    }

    // adds the Love It link and count to post/page content automatically
    public static function display_like_link( $content ) {

	    $types = apply_filters( 'display_like_links_on', array( 'post' ) );

	    if( is_singular( $types ) && is_user_logged_in() ) {
		    $content .= self::like_content_link();
	    }
	    return $content;
    }

    public static function front_end_js() {
	    if(is_user_logged_in()) {
            wp_enqueue_script( 'like-it', plugins_url( '/homelist/assets/js/like-it.js' ), array( 'jquery' ), false, true );

		    wp_localize_script( 'like-it', 'like_it_vars', 
			    array( 
				    'ajaxurl' => admin_url( 'admin-ajax.php' ),
				    'nonce' => wp_create_nonce('like-it-nonce'),
				    'liked_message' => __('This has been successfully added to your favorite list.', 'homelist'),
				    'disliked_message' => __('This has been successfully removed from your favorite list.', 'homelist'),
				    'already_liked_message' => __('You have already liked this item.', 'homelist'),
				    'error_message' => __('Sorry, there was a problem processing your request.', 'homelist')
			    ) 
		    );	
	    }
    }
}

Homelist_Like_It::init();
