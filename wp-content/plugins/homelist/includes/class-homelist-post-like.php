<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Homelist_Post_Like {
	/**
	 * Initialize customizations
	 *
	 * @access public
	 * @return void
	 */
	public static function init() {
		self::includes();
	}

	/**
	 * Include all customizations
	 *
	 * @access public
	 * @return void
	 */
	public static function includes() {
		require_once HOMELIST_DIR . 'includes/post-like/class-homelist-like-it.php';
	}
}

Homelist_Post_Like::init();
