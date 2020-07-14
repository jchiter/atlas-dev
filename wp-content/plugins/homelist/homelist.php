<?php
/*
Plugin Name: Homelist Plugin
Plugin URI: 
Description: This plugin provides an easy to use interface for creating and administrating custom post types and taxonomies in WordPress.
Version: 1.0.0
Author: OngoingThemes
Author URI: http://ongoingthemes.com/
License: 
*/

define( 'HOMELIST_DIR', plugin_dir_path( __FILE__ ) );
define( 'HOMELIST_PROPERTY_PREFIX', 'property_' );
define( 'HOMELIST_AGENCY_PREFIX', 'agency_' );
define( 'HOMELIST_PREFIX', 'homelist_' );
defined( 'REALIA_PROPERTY_PREFIX' ) or define( 'REALIA_PROPERTY_PREFIX', 'property_' );
defined( 'REALIA_AGENT_PREFIX' ) or define( 'REALIA_AGENT_PREFIX', 'agent_' );

require_once HOMELIST_DIR . 'includes/class-homelist-customizations.php';
require_once HOMELIST_DIR . 'includes/class-homelist-widgets.php';
require_once HOMELIST_DIR . 'includes/class-homelist-post-like.php';
require_once HOMELIST_DIR . 'includes/class-homelist-shortcodes.php';

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( ! is_plugin_active( 'realia/realia.php' ) ) {
	wp_die( esc_html__( 'You should first install and activate Realia plugin.', 'homelist' ) );
}

// action to loaded the plugin translation file
add_action('plugins_loaded', 'homelist_plugin_textdomain');
if( !function_exists('homelist_plugin_textdomain') ){
	function homelist_plugin_textdomain() {
		load_plugin_textdomain( 'homelist', false, dirname(plugin_basename( __FILE__ ))  . '/languages/' ); 
	}
}

function homelist_tinymce_css() {
    wp_enqueue_script( 'admin-script', plugins_url( '/assets/js/admin-script.js', __FILE__ ), array( 'jquery' ) ); // the wp-color-picker javascript file
    wp_enqueue_style('thickbox');
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
}
add_action('admin_enqueue_scripts', 'homelist_tinymce_css');

function homelist_register_post_types() {
	$labels = array(
		'name'               => __( 'Services', 'homelist' ),
		'singular_name'      => __( 'Service', 'homelist' ),
		'menu_name'          => __( 'Services', 'homelist' ),
		'name_admin_bar'     => __( 'Service', 'homelist' ),
		'add_new'            => __( 'Add New', 'service', 'homelist' ),
		'add_new_item'       => __( 'Add New Service', 'homelist' ),
		'new_item'           => __( 'New Service', 'homelist' ),
		'edit_item'          => __( 'Edit Service', 'homelist' ),
		'view_item'          => __( 'View Service', 'homelist' ),
		'all_items'          => __( 'All Services', 'homelist' ),
		'search_items'       => __( 'Search Services', 'homelist' ),
		'parent_item_colon'  => __( 'Parent Services:', 'homelist' ),
		'not_found'          => __( 'No services found.', 'homelist' ),
		'not_found_in_trash' => __( 'No services found in Trash.', 'homelist' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Description.', 'homelist' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'service' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
        'menu_icon'          => 'dashicons-screenoptions',
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);

	register_post_type( 'homelist_service', $args );


    $labels = array(
        'name'               => __( 'Testimonials', 'homelist' ),
        'singular_name'      => __( 'Testimonial', 'homelist' ),
        'add_new'            => __( 'Add New', 'homelist' ),
        'add_new_item'       => __( 'Add New Testimonial', 'homelist' ),
        'edit_item'          => __( 'Edit Testimonial', 'homelist' ),
        'new_item'           => __( 'New Testimonial', 'homelist' ),
        'all_items'          => __( 'All Testimonials', 'homelist' ),
        'view_item'          => __( 'View Testimonial', 'homelist' ),
        'search_items'       => __( 'Search Testimonials', 'homelist' ),
        'not_found'          => __( 'No testimonial found', 'homelist' ),
        'not_found_in_trash' => __( 'No testimonials found in the Trash', 'homelist' ), 
        'parent_item_colon'  => '',
        'menu_name'          => __( 'Testimonials', 'homelist' ),
    );
    $args = array(
        'labels'        => $labels,
        'public'        => true,
        'menu_position' => 6,
        'menu_icon'     => 'dashicons-testimonial',
        'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
        'has_archive'   => true,
    );
    register_post_type( 'homelist_testimonial', $args ); 

	$labels = array(
		'name'               => __( 'Facts', 'homelist' ),
		'singular_name'      => __( 'Fact', 'homelist' ),
		'menu_name'          => __( 'Facts', 'homelist' ),
		'name_admin_bar'     => __( 'Fact', 'homelist' ),
		'add_new'            => __( 'Add New', 'homelist' ),
		'add_new_item'       => __( 'Add New Fact', 'homelist' ),
		'new_item'           => __( 'New Fact', 'homelist' ),
		'edit_item'          => __( 'Edit Fact', 'homelist' ),
		'view_item'          => __( 'View Fact', 'homelist' ),
		'all_items'          => __( 'All Facts', 'homelist' ),
		'search_items'       => __( 'Search Facts', 'homelist' ),
		'parent_item_colon'  => __( 'Parent Facts:', 'homelist' ),
		'not_found'          => __( 'No facts found.', 'homelist' ),
		'not_found_in_trash' => __( 'No facts found in Trash.', 'homelist' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Description.', 'homelist' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'fact' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
        'menu_icon'          => 'dashicons-megaphone',
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);

	register_post_type( 'homelist_fact', $args );

	$property_facilities_labels = array(
		'name'              => __( 'Facilities', 'homelist' ),
		'singular_name'     => __( 'Facility', 'homelist' ),
		'search_items'      => __( 'Search Facility', 'homelist' ),
		'all_items'         => __( 'All Facilities', 'homelist' ),
		'parent_item'       => __( 'Parent Facility', 'homelist' ),
		'parent_item_colon' => __( 'Parent Facility:', 'homelist' ),
		'edit_item'         => __( 'Edit Facility', 'homelist' ),
		'update_itm'        => __( 'Update Facility', 'homelist' ),
		'add_new_item'      => __( 'Add New Facility', 'homelist' ),
		'new_item_name'     => __( 'New Facility', 'homelist' ),
		'menu_name'         => __( 'Facilities', 'homelist' ),
	);

	register_taxonomy( 'facilities', 'property', array(
		'labels'            => $property_facilities_labels,
		'hierarchical'      => true,
		'query_var'         => 'facility',
		'rewrite'           => array( 'slug' => __( 'facility', 'homelist' ) ),
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
	) );

	$property_valuations_labels = array(
		'name'              => __( 'Valuations', 'homelist' ),
		'singular_name'     => __( 'Valuation', 'homelist' ),
		'search_items'      => __( 'Search Valuation', 'homelist' ),
		'all_items'         => __( 'All Valuations', 'homelist' ),
		'parent_item'       => __( 'Parent Valuation', 'homelist' ),
		'parent_item_colon' => __( 'Parent Valuation:', 'homelist' ),
		'edit_item'         => __( 'Edit Valuation', 'homelist' ),
		'update_itm'        => __( 'Update Valuation', 'homelist' ),
		'add_new_item'      => __( 'Add New Valuation', 'homelist' ),
		'new_item_name'     => __( 'New Valuation', 'homelist' ),
		'menu_name'         => __( 'Valuations', 'homelist' ),
	);

	register_taxonomy( 'valuations', 'property', array(
		'labels'            => $property_valuations_labels,
		'hierarchical'      => true,
		'query_var'         => 'valuation',
		'rewrite'           => array( 'slug' => __( 'valuation', 'homelist' ) ),
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
	) );

}
add_action( 'init', 'homelist_register_post_types' );


add_action( 'cmb2_admin_init', 'homelist_register_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function homelist_register_metabox() {
	$cmb = new_cmb2_box( array(
		'id'            => HOMELIST_PREFIX . 'metabox',
		'title'         => esc_html__( 'Select Icon', 'homelist' ),
		'object_types'  => array( 'homelist_service', 'homelist_fact' ), // Post type
		// 'show_on_cb' => 'homelist_show_if_front_page', // function should return a bool value
		// 'context'    => 'normal',
		// 'priority'   => 'high',
		// 'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
		// 'classes'    => 'extra-class', // Extra homelist-wrap classes
		// 'classes_cb' => 'homelist_add_some_classes', // Add classes through a callback.
	) );

	$cmb->add_field( array(
		'name'             => esc_html__( 'Icon', 'homelist' ),
		'id'               => HOMELIST_PREFIX . 'select',
		'type'             => 'select',
		'show_option_none' => true,
		'options'          => homelist_get_icon_packs(),
	) );


	$cmb = new_cmb2_box( array(
		'id'            => HOMELIST_PREFIX . 'fact_metabox',
		'title'         => __( 'General', 'homelist' ),
		'object_types'  => array( 'homelist_fact' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // Keep the metabox closed by default
	) );

	$cmb->add_field( array(
		'name'       => __( 'Count', 'homelist' ),
		'desc'       => __( 'Please enter a number', 'homelist' ),
		'id'         => HOMELIST_PREFIX . 'count',
		'type'       => 'text',
		'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
		// 'on_front'        => false, // Optionally designate a field to wp-admin only
		// 'repeatable'      => true,
	) );


	$cmb = new_cmb2_box( array(
		'id'            => HOMELIST_PREFIX . 'testimonial_metabox',
		'title'         => __( 'General', 'homelist' ),
		'object_types'  => array( 'homelist_testimonial', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );

	$cmb->add_field( array(
		'name'       => __( 'Author Name', 'homelist' ),
		'id'         => HOMELIST_PREFIX . 'testimonial_author_name',
		'type'       => 'text',
	) );

	$cmb->add_field( array(
		'name'       => __( 'Author\'s Title', 'homelist' ),
		'id'         => HOMELIST_PREFIX . 'testimonial_author_title',
		'type'       => 'text',
	) );

	$cmb->add_field( array(
		'name'       => __( 'Author\'s Company', 'homelist' ),
		'id'         => HOMELIST_PREFIX . 'testimonial_author_company',
		'type'       => 'text',
	) );

}

if ( is_plugin_active( 'realia/realia.php' ) ) {
    function homelist_add_metabox_fields( $metaboxes ) {
	    $metaboxes[REALIA_PROPERTY_PREFIX . 'general']['fields'][] = array(
		    'name'              => __( 'Add Gallery To Box', 'homelist' ),
		    'id'                => REALIA_PROPERTY_PREFIX . 'add_gallery_to_box',
		    'type'              => 'checkbox',
	    );

	    $metaboxes[REALIA_PROPERTY_PREFIX . 'general']['fields'][] = array(
		    'name'              => __( 'Add To Slider', 'homelist' ),
		    'id'                => REALIA_PROPERTY_PREFIX . 'add_to_slider',
		    'type'              => 'checkbox',
	    );

	    $metaboxes[REALIA_PROPERTY_PREFIX . 'general']['fields'][] = array(
		    'name'              => __( 'Image for slider', 'homelist' ),
		    'id'                => REALIA_PROPERTY_PREFIX . 'slider_image',
		    'description'       => __( 'Use large images which has at least 1920px width and 1080px height.', 'homelist' ),
		    'type'              => 'file',
	    );

	    $metaboxes[REALIA_PROPERTY_PREFIX . 'general']['fields'][] = array(
		    'name'              => __( 'Header Background Image', 'homelist' ),
		    'id'                => REALIA_PROPERTY_PREFIX . 'header_background_image',
		    'description'       => __( 'Use large images which has at least 1920px width and 1080px height.', 'homelist' ),
		    'type'              => 'file',
	    );

		$metaboxes[ REALIA_AGENT_PREFIX . 'agent_details' ] = array(
			'id'              	=> REALIA_AGENT_PREFIX . 'agent_details',
			'title'           	=> __( 'Agent details', 'homelist' ),
			'object_types'    	=> array( 'agent' ),
			'context'         	=> 'normal',
			'priority'        	=> 'high',
			'show_names'      	=> true,
			'show_in_rest'		=> true,
			'fields'          	=> array(
				array(
					'id'                => REALIA_AGENT_PREFIX . 'title',
					'name'              => __( 'Title', 'homelist' ),
					'type'              => 'text',
				),
			),
		);



        if ( ! is_admin() ) {

		    $metaboxes[ REALIA_PROPERTY_PREFIX . 'front' ]['fields'][] = array(
			    'name'              => __( 'Public facilities', 'homelist' ),
			    'object_types'      => array( 'property' ),
			    'id'                => REALIA_PROPERTY_PREFIX . 'public_facilities_group',
			    'type'              => 'group',
			    'fields'            => array(
				    array(
					    'id'                => REALIA_PROPERTY_PREFIX . 'public_facilities_key',
					    'name'              => __( 'Facility', 'homelist' ),
	                    'type'              => 'select',
                        'show_option_none'  => true,
	                    'options_cb'         => 'cmb2_get_term_options',
	                    'get_terms_args'    => array(
		                    'taxonomy'      => 'facilities',
		                    'hide_empty'    => false,
	                    ),
	                    //'taxonomy'          => 'facilities',
	                    //'type'              => 'taxonomy_select',
				    ),
				    array(
					    'id'                => REALIA_PROPERTY_PREFIX . 'public_facilities_value',
					    'name'              => __( 'Value', 'homelist' ),
                        'desc'              => __( 'For example: 3 min,  20 km', 'homelist' ),
					    'type'              => 'text',
				    )
			    )
		    );

		    $metaboxes[ REALIA_PROPERTY_PREFIX . 'front' ]['fields'][] = array(
			    'name'              => __( 'Land Valuation', 'homelist' ),
			    'object_types'      => array( 'property' ),
			    'id'                => REALIA_PROPERTY_PREFIX . 'valuation_group',
			    'type'              => 'group',
			    'fields'            => array(
				    array(
					    'id'                => REALIA_PROPERTY_PREFIX . 'valuation_key',
					    'name'              => __( 'Valuation', 'homelist' ),
                        'type'              => 'select',
                        'show_option_none'  => true,
                        // Use a callback to avoid performance hits on pages where this field is not displayed (including the front-end).
                        'options_cb'        => 'cmb2_get_term_options',
                        // Same arguments you would pass to `get_terms`.
                        'get_terms_args'    => array(
	                        'taxonomy'      => 'valuations',
	                        'hide_empty'    => false,
                        ),
	                    //'taxonomy'          => 'valuations',
	                    //'type'              => 'taxonomy_select',
				    ),
				    array(
					    'id'                => REALIA_PROPERTY_PREFIX . 'valuation_value',
					    'name'              => __( 'Value', 'homelist' ),
					    'type'              => 'text',
					    'attributes' 	    => array(
						    'type' 				=> 'number',
						    'min'				=> 0,
						    'pattern' 			=> '\d*',
					    )
				    )
			    )
		    );

	        $metaboxes[ REALIA_PROPERTY_PREFIX . 'front' ]['fields'][ REALIA_PROPERTY_PREFIX . 'title' ] = array(
				'name'              => __( 'Title', 'homelist' ),
				'id'                => REALIA_PROPERTY_PREFIX . 'title',
				'type'              => 'text',
				'default'           => ! empty( $post ) ? $post->post_title : '',
				'attributes'		=> array(
                    'placeholder'   => __( 'Please enter the title of your property', 'homelist' ),
					'required'		=> 'required'
				)
			);


        } else {
		    $metaboxes[ REALIA_PROPERTY_PREFIX . 'valuation' ] = array(
			    'id'                        => REALIA_PROPERTY_PREFIX . 'valuation',
			    'title'                     => __( 'Valuation', 'homelist' ),
			    'object_types'              => array( 'property' ),
			    'context'                   => 'normal',
			    'priority'                  => 'high',
			    'show_names'                => true,
			    'show_in_rest'				=> true,
			    'fields'                    => array(
				    array(
					    'id'                => REALIA_PROPERTY_PREFIX . 'valuation_group',
					    'type'              => 'group',
					    'fields'            => array(
						    array(
							    'id'                => REALIA_PROPERTY_PREFIX . 'valuation_key',
							    'name'              => __( 'Valuation', 'homelist' ),
                                'type'              => 'select',
                                'show_option_none'  => true,
                                'options_cb'        => 'cmb2_get_term_options',
                                'get_terms_args'    => array(
	                                'taxonomy'      => 'valuations',
	                                'hide_empty'    => false,
                                ),
	                            //'taxonomy'          => 'valuations',
	                            //'type'              => 'taxonomy_select',
						    ),
						    array(
							    'id'                => REALIA_PROPERTY_PREFIX . 'valuation_value',
							    'name'              => __( 'Value', 'homelist' ),
							    'type'              => 'text',
							    'attributes' 	    => array(
								    'type' 				=> 'number',
								    'min'				=> 0,
								    'pattern' 			=> '\d*',
							    )
						    ),
					    ),
				    ),
			    ),
		    );

		    $metaboxes[ REALIA_PROPERTY_PREFIX . 'public_facilities' ] = array(
			    'id'                        => REALIA_PROPERTY_PREFIX . 'public_facilities',
			    'title'                     => __( 'Public facilities', 'homelist' ),
			    'object_types'              => array( 'property' ),
			    'context'                   => 'normal',
			    'priority'                  => 'high',
			    'show_names'                => true,
			    'show_in_rest'				=> true,
			    'fields'                    => array(
				    array(
					    'id'                => REALIA_PROPERTY_PREFIX . 'public_facilities_group',
					    'type'              => 'group',
					    'fields'            => array(
						    array(
							    'id'                => REALIA_PROPERTY_PREFIX . 'public_facilities_key',
							    'name'              => __( 'Key', 'homelist' ),
	                            'type'              => 'select',
                                'show_option_none'  => true,
                                'default'           => '',
	                            'options_cb'        => 'cmb2_get_term_options',
	                            'get_terms_args'    => array(
		                            'taxonomy'      => 'facilities',
		                            'hide_empty'    => false,
	                            ),
	                            //'taxonomy'          => 'facilities',
	                            //'type'              => 'taxonomy_select',
						    ),
						    array(
							    'id'                => REALIA_PROPERTY_PREFIX . 'public_facilities_value',
							    'name'              => __( 'Value', 'homelist' ),
                                'desc'              => 'For example: 3 min,  20 km',
							    'type'              => 'text',
						    ),
					    ),
				    ),
			    ),
		    );
        }

	    return $metaboxes;
    }

    add_action( 'cmb2_meta_boxes', 'homelist_add_metabox_fields', 9999 );
}

function homelist_get_icon_packs() {
    $pattern = '/\.(flaticon-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';

    ob_start();
    include 'assets/css/flaticon.css';
    $subject = ob_get_contents();
    ob_end_clean();

    preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);

    $icons = array();

    foreach($matches as $match){
        $icons[$match[1]] = $match[1];
    }
    asort($icons);

    return $icons;
}

function homelist_scrape_instagram( $username ) {

	$username = strtolower( $username );
	$username = str_replace( '@', '', $username );

	if ( false === ( $instagram = get_transient( 'instagram-a5-'.sanitize_title_with_dashes( $username ) ) ) ) {

		$remote = wp_remote_get( 'http://instagram.com/'.trim( $username ) );

		if ( is_wp_error( $remote ) )
			return new WP_Error( 'site_down', esc_html__( 'Unable to communicate with Instagram.', 'homelist' ) );

		if ( 200 != wp_remote_retrieve_response_code( $remote ) )
			return new WP_Error( 'invalid_response', esc_html__( 'Instagram did not return a 200.', 'homelist' ) );

		$shards = explode( 'window._sharedData = ', $remote['body'] );
		$insta_json = explode( ';</script>', $shards[1] );
		$insta_array = json_decode( $insta_json[0], TRUE );

		if ( ! $insta_array )
			return new WP_Error( 'bad_json', esc_html__( 'Instagram has returned invalid data.', 'homelist' ) );

		if ( isset( $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'] ) ) {
			$images = $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'];
		} else {
			return new WP_Error( 'bad_json_2', esc_html__( 'Instagram has returned invalid data.', 'homelist' ) );
		}

		if ( ! is_array( $images ) )
			return new WP_Error( 'bad_array', esc_html__( 'Instagram has returned invalid data.', 'homelist' ) );

		$instagram = array();

		foreach ( $images as $image ) {

			$image['thumbnail_src'] = preg_replace( '/^https?\:/i', '', $image['thumbnail_src'] );
			$image['display_src'] = preg_replace( '/^https?\:/i', '', $image['display_src'] );

			// handle both types of CDN url
			if ( ( strpos( $image['thumbnail_src'], 's640x640' ) !== false ) ) {
				$image['thumbnail'] = str_replace( 's640x640', 's160x160', $image['thumbnail_src'] );
				$image['small'] = str_replace( 's640x640', 's320x320', $image['thumbnail_src'] );
			} else {
				$urlparts = wp_parse_url( $image['thumbnail_src'] );
				$pathparts = explode( '/', $urlparts['path'] );
				array_splice( $pathparts, 3, 0, array( 's160x160' ) );
				$image['thumbnail'] = '//' . $urlparts['host'] . implode( '/', $pathparts );
				$pathparts[3] = 's320x320';
				$image['small'] = '//' . $urlparts['host'] . implode( '/', $pathparts );
			}

			$image['large'] = $image['thumbnail_src'];

			if ( $image['is_video'] == true ) {
				$type = 'video';
			} else {
				$type = 'image';
			}

			$caption = __( 'Instagram Image', 'homelist' );
			if ( ! empty( $image['caption'] ) ) {
				$caption = $image['caption'];
			}

			$instagram[] = array(
				'description'   => $caption,
				'link'		  	=> trailingslashit( '//instagram.com/p/' . $image['code'] ),
				'time'		  	=> $image['date'],
				'comments'	  	=> $image['comments']['count'],
				'likes'		 	=> $image['likes']['count'],
				'thumbnail'	 	=> $image['thumbnail'],
				'small'			=> $image['small'],
				'large'			=> $image['large'],
				'original'		=> $image['display_src'],
				'type'		  	=> $type
			);
		}

		// do not set an empty transient - should help catch private or empty accounts
		if ( ! empty( $instagram ) ) {
			$instagram = base64_encode( serialize( $instagram ) );
			set_transient( 'instagram-a5-'.sanitize_title_with_dashes( $username ), $instagram, apply_filters( 'null_instagram_cache_time', HOUR_IN_SECONDS*2 ) );
		}
	}

	if ( ! empty( $instagram ) ) {

		return unserialize( base64_decode( $instagram ) );

	} else {

		return new WP_Error( 'no_images', esc_html__( 'Instagram did not return any images.', 'homelist' ) );

	}
}

function homelist_set_post_views($postID) {
    $count_key = 'homelist_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

function homelist_track_post_views ($post_id) {
    if ( !is_single() ) return;
    if ( empty ( $post_id) ) {
        global $post;
        $post_id = $post->ID;    
    }
    homelist_set_post_views($post_id);
}
add_action( 'wp_head', 'homelist_track_post_views');

function homelist_get_post_views($postID){
    $count_key = 'homelist_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0".__( ' View', 'homelist' );
    }
    return $count.__( ' Views', 'homelist' );
}

function homelist_get_pages($default = '') {
    $pages = get_pages(); 
    $option = '';
    foreach ( $pages as $page ) {
        $selected = ( $page->ID == $default ) ? ' selected="selected"' : '';
        $option .= '<option value="' . get_page_link( $page->ID ) . '"' . $selected . '>';
        $option .= $page->post_title;
        $option .= '</option>';
    }
    return $option;
}

function homelist_get_posts($default = '') {
    $posts = get_posts( 'orderby=menu_order&sort_order=asc' );
    $option = '';
    foreach ( $posts as $post ) {
        $selected = ( $post->ID == $default ) ? ' selected="selected"' : '';
        $option .= '<option value="' . get_permalink( $post->ID ) . '"' . $selected . '>';
        $option .= $post->post_title;
        $option .= '</option>';

    }
    return $option;
}

function homelist_mail($recipient, $subject, $message) {
	$headers='MIME-Version: 1.0'.PHP_EOL;
	$headers.='Content-Type: text/html; charset=UTF-8'.PHP_EOL;
	$subject='=?UTF-8?B?'.base64_encode($subject).'?=';

	if(wp_mail($recipient, $subject, $message, $headers)) {
		return true;
	}

	return false;
}

function homelist_str_replace($string, $keywords) {
	foreach($keywords as $search => $replace) {
		$string=str_replace('%'.$search.'%', $replace, $string);
	}

	return $string;
}


function homelist_add_new_image_meta_field() {
	// this will add the custom meta field to the add new term page
	?>
	<div class="form-field">
		<label for="term_meta[custom_term_meta]"><?php esc_html_e( 'Image', 'homelist' ); ?></label>
		<input type="text" name="term_meta[custom_term_meta]" id="custom_term_image_meta" value="">
        <input id="custom_term_image_button" type="button"  class="upload_button button" value="<?php esc_html_e( 'Upload Image', 'homelist' ); ?>" />
		<p class="description"><?php esc_html_e( 'Upload a image','homelist' ); ?></p>
	</div>
<?php
}
add_action( 'locations_add_form_fields', 'homelist_add_new_image_meta_field', 10, 2 );


// Edit term page
function homelist_edit_image_meta_field($term) {
 
	// put the term ID into a variable
	$t_id = $term->slug;
 
	// retrieve the existing value(s) for this meta field. This returns an array
	$term_meta = get_option( "taxonomy_$t_id" ); ?>
	<tr class="form-field">
	<th scope="row" valign="top"><label for="term_meta[custom_term_meta]"><?php esc_html_e( 'Image', 'homelist' ); ?></label></th>
		<td>
			<input type="text" name="term_meta[custom_term_meta]" id="custom_term_image_meta" value="<?php echo esc_attr( $term_meta['custom_term_meta'] ) ? esc_attr( $term_meta['custom_term_meta'] ) : ''; ?>">
            <input id="custom_term_image_button" type="button"  class="upload_button button" value="<?php esc_html_e( 'Upload Image', 'homelist' ); ?>" />
			<p class="description"><?php esc_html_e( 'Enter a value for this field','homelist' ); ?></p>
		</td>
	</tr>

<?php
}
add_action( 'locations_edit_form_fields', 'homelist_edit_image_meta_field', 10, 2 );


function homelist_add_new_icon_meta_field() {
	// this will add the custom meta field to the add new term page
	?>
	<div class="form-field">
		<label for="term_meta[custom_term_meta]"><?php esc_html_e( 'Icon', 'homelist' ); ?></label>
		<select name="term_meta[custom_term_meta]" id="custom_term_icon_meta">
        <?php $items = homelist_get_icon_packs(); ?>
        <?php foreach($items as $item): ?>
            <option value="<?php echo $item; ?>"><?php echo $item; ?></option>
        <?php endforeach;?>
        </select>
		<p class="description"><?php esc_html_e( 'Select an icon','homelist' ); ?></p>
	</div>
<?php
}
add_action( 'amenities_add_form_fields', 'homelist_add_new_icon_meta_field', 10, 2 );

// Edit term page
function homelist_edit_icon_meta_field($term) {
 
	// put the term ID into a variable
	$t_id = $term->slug;
 
	// retrieve the existing value(s) for this meta field. This returns an array
	$term_meta = get_option( "taxonomy_$t_id" ); ?>
	<tr class="form-field">
	<th scope="row" valign="top"><label for="term_meta[custom_term_meta]"><?php esc_html_e( 'Image', 'homelist' ); ?></label></th>
		<td>
		    <select name="term_meta[custom_term_meta]" id="custom_term_icon_meta">
            <?php $items = homelist_get_icon_packs(); ?>
            <?php foreach($items as $item): ?>
                <option value="<?php echo $item; ?>" <?php echo selected($item, $term_meta['custom_term_meta'], false); ?>><?php echo $item; ?></option>
            <?php endforeach;?>
            </select>
			<p class="description"><?php esc_html_e( 'Enter a value for this field','homelist' ); ?></p>
		</td>
	</tr>

<?php
}
add_action( 'amenities_edit_form_fields', 'homelist_edit_icon_meta_field', 10, 2 );


// Save extra taxonomy fields callback function.
function homelist_save_taxonomy_custom_meta( $term_id ) {
	if ( isset( $_POST['term_meta'] ) ) {
		$t_id = $term_id;
        $slug = ( !empty( $_POST['slug'] ) ) ? sanitize_text_field( $_POST['slug'] ) : sanitize_title( sanitize_text_field( $_POST['tag-name'] ) );
		$term_meta = get_option( "taxonomy_$t_id" );
		$cat_keys = array_keys( $_POST['term_meta'] );
		foreach ( $cat_keys as $key ) {
			if ( isset ( $_POST['term_meta'][$key] ) ) {
				$term_meta[$key] = $_POST['term_meta'][$key];
			}
		}
		// Save the option array.
		update_option( "taxonomy_$slug", $term_meta );
	}
}  
add_action( 'edited_locations', 'homelist_save_taxonomy_custom_meta', 10, 2 );  
add_action( 'create_locations', 'homelist_save_taxonomy_custom_meta', 10, 2 );

add_action( 'edited_amenities', 'homelist_save_taxonomy_custom_meta', 10, 2 );  
add_action( 'create_amenities', 'homelist_save_taxonomy_custom_meta', 10, 2 );


function homelist_google_map() {
    $key = get_theme_mod( 'homelist_contact_google_map_key', null );
    $latitude = get_theme_mod( 'homelist_contact_latitude', null );
    $longitude = get_theme_mod( 'homelist_contact_longitude', null );
    $zoom = get_theme_mod( 'homelist_contact_zoom', 16 );
    $height = get_theme_mod( 'homelist_contact_height', 300 );
    $style = '';
    $description = '';

	wp_enqueue_script('google-map', 'http://maps.google.com/maps/api/js?sensor=false&key='.$key.'&callback=initMap');

	?>
    <script>
      function initMap() {
        var myLatLng = {lat: <?php echo $latitude; ?>, lng: <?php echo $longitude; ?>};

        // Create a map object and specify the DOM element for display.
        var map = new google.maps.Map(document.getElementById('google-map'), {
          center: myLatLng,
          scrollwheel: false,
          zoom: <?php echo esc_attr( $zoom ); ?>
        });

        // Create a marker and set its position.
        var marker = new google.maps.Marker({
          map: map,
          position: myLatLng,
          title: 'Google Map'
        });

        map.setOptions({styles: [<?php echo $style; ?>]});
      }
    </script>
    <?php 

	$out='<div class="google-map-container"><div class="google-map" id="google-map" style="height:'.esc_attr( $height ).'px"></div><input type="hidden" class="map-latitude" value="'.esc_attr( $latitude ).'" />';
	$out.='<input type="hidden" class="map-longitude" value="'.esc_attr( $longitude ).'" /><input type="hidden" class="map-zoom" value="'.esc_attr( $zoom ).'" /><input type="hidden" class="map-description" value="'.esc_attr( $description ).'" /></div>';

    return $out;
}


/*
 * Derived From: Very Simple Contact Form
 * Author: Guido van der Leest
 */
// function to get ip of user
function homelist_get_the_ip() {
	if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
		return $_SERVER["HTTP_X_FORWARDED_FOR"];
	}
	elseif (isset($_SERVER["HTTP_CLIENT_IP"])) {
		return $_SERVER["HTTP_CLIENT_IP"];
	}
	else {
		return $_SERVER["REMOTE_ADDR"];
	}
}

// The shortcode
function homelist_shortcode($homelist_atts) {
    // Start session for captcha validation
    if (!isset ($_SESSION)) session_start(); 
    $_SESSION['homelist-rand'] = isset($_SESSION['homelist-rand']) ? $_SESSION['homelist-rand'] : rand(100, 999);


	$homelist_atts = shortcode_atts( array( 
		"email_to" => get_bloginfo('admin_email'),
		"label_name" => __('Name', 'very-simple-contact-form'),
		"label_email" => __('Email', 'very-simple-contact-form'),
		"label_subject" => __('Subject', 'very-simple-contact-form'),
		"label_message" => __('Message', 'very-simple-contact-form'),
		"label_captcha" => __('Enter number %s', 'very-simple-contact-form'),
		"label_submit" => __('Submit', 'very-simple-contact-form'),
		"error_name" => __('Please enter at least 2 characters', 'very-simple-contact-form'),
		"error_subject" => __('Please enter at least 2 characters', 'very-simple-contact-form'),
		"error_message" => __('Please enter at least 10 characters', 'very-simple-contact-form'),
		"error_captcha" => __('Please enter the correct number', 'very-simple-contact-form'),
		"error_email" => __('Please enter a valid email', 'very-simple-contact-form'),
		"message_success" => __('Thank you! You will receive a response as soon as possible.', 'very-simple-contact-form'),
		"message_error" => __('Error! Could not send form. This might be a server issue.', 'very-simple-contact-form'),
		"hide_subject" => '',
		"hide_captcha" => '',
		"hide_firstname" => '',
		"hide_lastname" => ''
	), $homelist_atts);

	// Set variables 
	$form_data = array(
		'form_name' => '',
		'form_email' => '',
		'form_subject' => '',
		'form_captcha' => '',
		'form_firstname' => '',
		'form_lastname' => '',
		'form_message' => ''
	);
	$error = false;
	$sent = false;
	$fail = false;
	$info = '';

	if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['homelist_send']) ) {
	
		// Sanitize content
		$post_data = array(
			'form_name' => sanitize_text_field($_POST['homelist_name']),
			'form_email' => sanitize_email($_POST['homelist_email']),
			'form_subject' => sanitize_text_field($_POST['homelist_subject']),
			'form_message' => wp_kses_post($_POST['homelist_message']),
			'form_captcha' => sanitize_text_field($_POST['homelist_captcha']),
			'form_firstname' => sanitize_text_field($_POST['homelist_firstname']),
			'form_lastname' => sanitize_text_field($_POST['homelist_lastname'])
		);

		// Validate name
		$value = $post_data['form_name'];
		if ( strlen($value)<2 ) {
			$error_class['form_name'] = true;
			$error = true;
		}
		$form_data['form_name'] = $value;

		// Validate email
		$value = $post_data['form_email'];
		if ( empty($value) ) {
			$error_class['form_email'] = true;
			$error = true;
		}
		$form_data['form_email'] = $value;

		// Validate subject
		if ($homelist_atts['hide_subject'] != "yes") {		
			$value = $post_data['form_subject'];
			if ( strlen($value)<2 ) {
				$error_class['form_subject'] = true;
				$error = true;
			}
			$form_data['form_subject'] = $value;
		}

		// Validate message
		$value = $post_data['form_message'];
		if ( strlen($value)<10 ) {
			$error_class['form_message'] = true;
			$error = true;
		}
		$form_data['form_message'] = $value;

		// Validate captcha
        if ($homelist_atts['hide_captcha'] != "yes") {	
		    $value = $post_data['form_captcha'];
		    if ( $value != $_SESSION['homelist-rand'] ) { 
			    $error_class['form_captcha'] = true;
			    $error = true;
		    }
		    $form_data['form_captcha'] = $value;
        }

		// Validate first honeypot field
		if ($homelist_atts['hide_firstname'] != "yes") {		
		    $value = $post_data['form_firstname'];
		    if ( strlen($value)>0 ) {
			    $error = true;
		    }
		    $form_data['form_firstname'] = $value;
        }

		// Validate second honeypot field
		if ($homelist_atts['hide_lastname'] != "yes") {		
		    $value = $post_data['form_lastname'];
		    if ( strlen($value)>0 ) {
			    $error = true;
		    }
		    $form_data['form_lastname'] = $value;
        }

		// Sending form to admin
		if ($error == false) {
			// Hook to support plugin Contact Form DB
			do_action( 'homelist_before_send_mail', $form_data );
			$to = $homelist_atts['email_to'];
			if ($homelist_atts['hide_subject'] != "yes") {
				$subject = "(".get_bloginfo('name').") " . $form_data['form_subject'];
			} else {
				$subject = get_bloginfo('name');
			}
			$message = $form_data['form_name'] . "\r\n\r\n" . $form_data['form_email'] . "\r\n\r\n" . $form_data['form_message'] . "\r\n\r\n" . sprintf( esc_attr__( 'IP: %s', 'very-simple-contact-form' ), homelist_get_the_ip() ); 
			$headers = "Content-Type: text/plain; charset=UTF-8" . "\r\n";
			$headers .= "Content-Transfer-Encoding: 8bit" . "\r\n";
			$headers .= "From: ".$form_data['form_name']." <".$form_data['form_email'].">" . "\r\n";
			$headers .= "Reply-To: <".$form_data['form_email'].">" . "\r\n";
			if( wp_mail($to, $subject, $message, $headers) ) { 
				$result = $homelist_atts['message_success'];
				$sent = true;
			} else {
				$result = $homelist_atts['message_error'];
				$fail = true;
			}		
		}
	}

	// Display info
	if(!empty($result)) {
		$info = '<p class="homelist-info">'.esc_attr($result).'</p>';
	}

	// Contact form
	$email_form = '<form class="homelist-contact" id="homelist-contact" method="post">
		<div class="form-group"><label for="homelist_name" class="sr-only">'.esc_attr($homelist_atts['label_name']).': <span class="'.(isset($error_class['form_name']) ? "error" : "hide").'" >'.esc_attr($homelist_atts['error_name']).'</span></label>
		<input type="text" name="homelist_name" id="homelist_name" class="form-control input-lg required '.(isset($error_class['form_name']) ? ' error' : '').'" maxlength="50" value="'.esc_attr($form_data['form_name']).'" placeholder="'.esc_html__( 'Enter your name', 'homelist' ).'" />
        '.(isset($error_class['form_name']) ? '<label for="'.esc_attr($homelist_atts['label_name']).'" class="error">'.esc_attr($homelist_atts['error_name']).'</label>' : '').'</div>
		
		<div class="form-group"><label for="homelist_email" class="sr-only">'.esc_attr($homelist_atts['label_email']).': <span class="'.(isset($error_class['form_email']) ? "error" : "hide").'" >'.esc_attr($homelist_atts['error_email']).'</span></label>
		<input type="text" name="homelist_email" id="homelist_email" class="form-control input-lg required '.(isset($error_class['form_email']) ? ' error' : '').'" maxlength="50" value="'.esc_attr($form_data['form_email']).'" placeholder="'.esc_html__( 'Enter your email', 'homelist' ).'" />
        '.(isset($error_class['form_email']) ? '<label for="'.esc_attr($homelist_atts['label_email']).'" class="error">'.esc_attr($homelist_atts['error_email']).'</label>' : '').'</div>
		
		<div class="form-group"><label for="homelist_subject" '.($homelist_atts['hide_subject'] == "yes" ? ' class="hide"' : '').' class="sr-only">'.esc_attr($homelist_atts['label_subject']).': <span class="'.(isset($error_class['form_subject']) ? "error" : "hide").'" >'.esc_attr($homelist_atts['error_subject']).'</span></label>
		<input type="text" name="homelist_subject" id="homelist_subject" class="form-control input-lg required '.($homelist_atts['hide_subject'] == "yes" ? ' hide' : ''). (isset($error_class['form_subject']) ? ' error' : '').'" maxlength="50" value="'.esc_attr($form_data['form_subject']).'" placeholder="'.esc_html__( 'Enter your subject', 'homelist' ).'" />
        '.(isset($error_class['form_subject']) ? '<label for="'.esc_attr($homelist_atts['label_subject']).'" class="error">'.esc_attr($homelist_atts['error_subject']).'</label>' : '').'</div>
		
		<div class="form-group '.($homelist_atts['hide_captcha'] == "yes" ? ' hide' : '').'"><label for="homelist_captcha">'.sprintf(esc_attr($homelist_atts['label_captcha']), $_SESSION['homelist-rand']).': <span class="'.(isset($error_class['form_captcha']) ? "error" : "hide").'" >'.esc_attr($homelist_atts['error_captcha']).'</span></label>
		<input type="text" name="homelist_captcha" id="homelist_captcha"  class="form-control input-lg required '.(isset($error_class['form_captcha']) ? ' error' : '').'" maxlength="50" value="'.esc_attr($form_data['form_captcha']).'" placeholder="'.esc_html__( 'Enter captcha', 'homelist' ).'" />
        '.(isset($error_class['form_captcha']) ? '<label for="'.esc_attr($homelist_atts['label_name']).'" class="error">'.esc_attr($homelist_atts['error_captcha']).'</label>' : '').'</div>
		
		<div class="form-group '.($homelist_atts['hide_firstname'] == "yes" ? ' hide' : '').'"><input type="text" name="homelist_firstname" id="homelist_firstname" class="form-control input-lg" maxlength="50" value="'.esc_attr($form_data['form_firstname']).'" placeholder="'.esc_html__( 'Enter your firstname', 'homelist' ).'" /></div>
		
		<div class="form-group '.($homelist_atts['hide_lastname'] == "yes" ? ' hide' : '').'"><input type="text" name="homelist_lastname" id="homelist_lastname" class="form-control input-lg" maxlength="50" value="'.esc_attr($form_data['form_lastname']).'" placeholder="'.esc_html__( 'Enter your lastname', 'homelist' ).'" /></div>
		
		<div class="form-group"><label for="homelist_message" class="sr-only">'.esc_attr($homelist_atts['label_message']).': <span class="'.(isset($error_class['form_message']) ? "error" : "hide").'" >'.esc_attr($homelist_atts['error_message']).'</span></label>
		<textarea name="homelist_message" id="homelist_message" rows="10" class="form-control input-lg required '.(isset($error_class['form_message']) ? ' error' : '').'" placeholder="'.esc_html__( 'Enter your message', 'homelist' ).'">'.wp_kses_post($form_data['form_message']).'</textarea>
        '.(isset($error_class['form_message']) ? '<label for="'.esc_attr($homelist_atts['label_message']).'" class="error">'.esc_attr($homelist_atts['error_message']).'</label>' : '').'</div>
		
		<div class="form-group"><input type="submit" class="btn btn-success" value="'.esc_attr($homelist_atts['label_submit']).'" name="homelist_send" id="homelist_send" /></div>
	</form><br>';
	
	// Send form and unset captcha or display error
	if ($sent == true) {
		unset($_SESSION['homelist-rand']);
		return $info;
	} elseif ($fail == true) {
		return $info;
	} else {
		return $email_form;
	}
} 
add_shortcode('contact', 'homelist_shortcode');


/**
 * Gets a number of terms and displays them as options
 * @param  CMB2_Field $field 
 * @return array An array of options that matches the CMB2 options array
 */
function cmb2_get_term_options( $field ) {
	$args = $field->args( 'get_terms_args' );
	$args = is_array( $args ) ? $args : array();

	$args = wp_parse_args( $args, array( 'taxonomy' => 'category' ) );

	$taxonomy = $args['taxonomy'];

	$terms = (array) cmb2_utils()->wp_at_least( '4.5.0' )
		? get_terms( $args )
		: get_terms( $taxonomy, $args );

	// Initate an empty array
	$term_options = array();
	if ( ! empty( $terms ) ) {
		foreach ( $terms as $term ) {
			$term_options[ $term->term_id ] = $term->name;
		}
	}

	return $term_options;
}
?>