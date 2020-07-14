<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Homelist_Widgets {
	/**
	 * Initialize widgets
	 *
	 * @access public
	 * @return void
	 */
	public static function init() {
		self::includes();
		add_action( 'widgets_init', array( __CLASS__, 'register' ) );

	}

	/**
	 * Include widget classes
	 *
	 * @access public
	 * @return void
	 */
	public static function includes() {
		require_once HOMELIST_DIR . 'includes/widgets/class-homelist-widget-locations.php';
		require_once HOMELIST_DIR . 'includes/widgets/class-homelist-widget-properties.php';
		require_once HOMELIST_DIR . 'includes/widgets/class-homelist-widget-services.php';
		require_once HOMELIST_DIR . 'includes/widgets/class-homelist-widget-testimonials.php';
		require_once HOMELIST_DIR . 'includes/widgets/class-homelist-widget-property-slider.php';
		require_once HOMELIST_DIR . 'includes/widgets/class-homelist-widget-facts.php';
		require_once HOMELIST_DIR . 'includes/widgets/class-homelist-widget-social-links.php';
		require_once HOMELIST_DIR . 'includes/widgets/class-homelist-widget-calculator.php';
		require_once HOMELIST_DIR . 'includes/widgets/class-homelist-widget-recent-posts.php';
		require_once HOMELIST_DIR . 'includes/widgets/class-homelist-widget-popular-posts.php';
		require_once HOMELIST_DIR . 'includes/widgets/class-homelist-widget-agencies.php';
	}

	/**
	 * Register widgets
	 *
	 * @access public
	 * @return void
	 */
	public static function register() {
		register_widget( 'Homelist_Widget_Locations' );
		register_widget( 'Homelist_Widget_Properties' );
		register_widget( 'Homelist_Widget_Services' );
		register_widget( 'Homelist_Widget_Testimonials' );
        register_widget( 'Homelist_Widget_Property_Slider' );
		register_widget( 'Homelist_Widget_Facts' );
		register_widget( 'Homelist_Widget_Social_Links' );
		register_widget( 'Homelist_Widget_Calculator' );
		register_widget( 'Homelist_Widget_Recent_Posts' );
		register_widget( 'Homelist_Widget_Popular_Posts' );
		register_widget( 'Homelist_Widget_Agencies' );
	}
}

Homelist_Widgets::init();
