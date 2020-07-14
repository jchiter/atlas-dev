<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Homelist_Customizations_Social_Networks {
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
		$wp_customize->add_section( 'homelist_social_links', array(
			'title'     => __( 'Homelist Social Networks', 'homelist' ),
			'priority'  => 1,
		) );


		// Facebook
		$wp_customize->add_setting( 'homelist_social_links_facebook', array(
			'default'           => null,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( 'homelist_social_links_facebook', array(
			'type'          => 'text',
			'label'         => __( 'Facebook URL', 'homelist' ),
			'section'       => 'homelist_social_links',
			'settings'      => 'homelist_social_links_facebook',
		) );


		// Twitter
		$wp_customize->add_setting( 'homelist_social_links_twitter', array(
			'default'           => null,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( 'homelist_social_links_twitter', array(
			'type'          => 'text',
			'label'         => __( 'Twitter URL', 'homelist' ),
			'section'       => 'homelist_social_links',
			'settings'      => 'homelist_social_links_twitter',
		) );


		// Google Plus
		$wp_customize->add_setting( 'homelist_social_links_google-plus', array(
			'default'           => null,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( 'homelist_social_links_google-plus', array(
			'type'          => 'text',
			'label'         => __( 'Google Plus URL', 'homelist' ),
			'section'       => 'homelist_social_links',
			'settings'      => 'homelist_social_links_google-plus',
		) );


		// Linkedin
		$wp_customize->add_setting( 'homelist_social_links_linkedin', array(
			'default'           => null,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( 'homelist_social_links_linkedin', array(
			'type'          => 'text',
			'label'         => __( 'Linkedin URL', 'homelist' ),
			'section'       => 'homelist_social_links',
			'settings'      => 'homelist_social_links_linkedin',
		) );


		// Pinterest
		$wp_customize->add_setting( 'homelist_social_links_pinterest', array(
			'default'           => null,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( 'homelist_social_links_pinterest', array(
			'type'          => 'text',
			'label'         => __( 'Pinterest URL', 'homelist' ),
			'section'       => 'homelist_social_links',
			'settings'      => 'homelist_social_links_pinterest',
		) );


		// Youtube
		$wp_customize->add_setting( 'homelist_social_links_youtube', array(
			'default'           => null,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( 'homelist_social_links_youtube', array(
			'type'          => 'text',
			'label'         => __( 'Youtube URL', 'homelist' ),
			'section'       => 'homelist_social_links',
			'settings'      => 'homelist_social_links_youtube',
		) );

		// Instagram
		$wp_customize->add_setting( 'homelist_social_links_instagram', array(
			'default'           => null,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( 'homelist_social_links_instagram', array(
			'type'          => 'text',
			'label'         => __( 'Instagram URL', 'homelist' ),
			'section'       => 'homelist_social_links',
			'settings'      => 'homelist_social_links_instagram',
		) );
	}
}

Homelist_Customizations_Social_Networks::init();
