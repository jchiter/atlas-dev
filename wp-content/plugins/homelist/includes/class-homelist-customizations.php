<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Homelist_Customizations {
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
		require_once HOMELIST_DIR . 'includes/customizations/class-homelist-customizations-contact.php';
		require_once HOMELIST_DIR . 'includes/customizations/class-homelist-customizations-social-links.php';
		require_once HOMELIST_DIR . 'includes/customizations/class-homelist-customizations-general.php';
	}
}

Homelist_Customizations::init();
