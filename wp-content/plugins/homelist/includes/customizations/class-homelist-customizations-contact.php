<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Homelist_Customizations_Contact_Us {
	/**
	 * Initialize customization type
	 *
	 * @access public
	 * @return void
	 */
	public static function init() {
		add_action( 'customize_register', array( __CLASS__, 'customizations' ) );
	}

	/**
	 * Customizations
	 *
	 * @access public
	 * @param object $wp_customize
	 * @return void
	 */
	public static function customizations( $wp_customize ) {
		$wp_customize->add_section( 'homelist_contact', array(
			'title'     => __( 'Homelist Contact Us', 'homelist' ),
			'priority'  => 1,
		) );

		// Phone 1
		$wp_customize->add_setting( 'homelist_contact_phone1', array(
			'default'           => '',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( 'homelist_contact_phone1', array(
			'label'     => __( 'Phone 1', 'homelist' ),
			'section'   => 'homelist_contact',
			'settings'  => 'homelist_contact_phone1',
		) );

		// Phone 2
		$wp_customize->add_setting( 'homelist_contact_phone2', array(
			'default'           => '',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( 'homelist_contact_phone2', array(
			'label'     => __( 'Phone 2', 'homelist' ),
			'section'   => 'homelist_contact',
			'settings'  => 'homelist_contact_phone2',
		) );

		// E-Mail 1
		$wp_customize->add_setting( 'homelist_contact_email1', array(
			'default'           => '',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( 'homelist_contact_email1', array(
			'label'     => __( 'E-Mail 1', 'homelist' ),
			'section'   => 'homelist_contact',
			'settings'  => 'homelist_contact_email1',
		) );


		// E-Mail 2
		$wp_customize->add_setting( 'homelist_contact_email2', array(
			'default'           => '',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( 'homelist_contact_email2', array(
			'label'     => __( 'E-Mail 2', 'homelist' ),
			'section'   => 'homelist_contact',
			'settings'  => 'homelist_contact_email2',
		) );


		// Address 1
		$wp_customize->add_setting( 'homelist_contact_address1', array(
			'default'           => '',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( 'homelist_contact_address1', array(
			'label'     => __( 'Address 1', 'homelist' ),
			'section'   => 'homelist_contact',
			'settings'  => 'homelist_contact_address1',
		) );

		// Address 2
		$wp_customize->add_setting( 'homelist_contact_address2', array(
			'default'           => '',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( 'homelist_contact_address2', array(
			'label'     => __( 'Address 2', 'homelist' ),
			'section'   => 'homelist_contact',
			'settings'  => 'homelist_contact_address2',
		) );

		// Opening Hours
		$wp_customize->add_setting( 'homelist_contact_opening_hours', array(
			'default'           => '',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( 'homelist_contact_opening_hours', array(
			'label'     => __( 'Opening Hours', 'homelist' ),
			'section'   => 'homelist_contact',
			'settings'  => 'homelist_contact_opening_hours',
		) );

		// Map Key
		$wp_customize->add_setting( 'homelist_contact_google_map_key', array(
			'default'           => '',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( 'homelist_contact_google_map_key', array(
			'label'     => __( 'Google Map Key', 'homelist' ),
			'section'   => 'homelist_contact',
			'settings'  => 'homelist_contact_google_map_key',
		) );

		// Latitude
		$wp_customize->add_setting( 'homelist_contact_latitude', array(
			'default'           => '',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( 'homelist_contact_latitude', array(
			'label'     => __( 'Latitude', 'homelist' ),
			'section'   => 'homelist_contact',
			'settings'  => 'homelist_contact_latitude',
		) );

		// Longitude
		$wp_customize->add_setting( 'homelist_contact_longitude', array(
			'default'           => '',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( 'homelist_contact_longitude', array(
			'label'     => __( 'Longitude', 'homelist' ),
			'section'   => 'homelist_contact',
			'settings'  => 'homelist_contact_longitude',
		) );

		// Zoom
		$wp_customize->add_setting( 'homelist_contact_zoom', array(
			'default'           => '',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( 'homelist_contact_zoom', array(
			'label'     => __( 'Zoom', 'homelist' ),
			'section'   => 'homelist_contact',
			'settings'  => 'homelist_contact_zoom',
		) );

		// Height
		$wp_customize->add_setting( 'homelist_contact_height', array(
			'default'           => '',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( 'homelist_contact_height', array(
			'label'     => __( 'Height', 'homelist' ),
			'section'   => 'homelist_contact',
			'settings'  => 'homelist_contact_height',
		) );


		// Contact Title Text
		$wp_customize->add_setting( 'homelist_contact_title_text', array(
			'default'           => '',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( 'homelist_contact_title_text', array(
			'label'     => __( 'Contact Title Text', 'homelist' ),
			'section'   => 'homelist_contact',
			'settings'  => 'homelist_contact_title_text',
		) );

	}
}

Homelist_Customizations_Contact_Us::init();
