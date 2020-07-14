<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Homelist_Customizations_General {
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
		// Show header contact info
		$wp_customize->add_setting( 'homelist_general_show_header_contact', array(
			'default'           => false,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( 'homelist_general_show_header_contact', array(
			'type'      => 'checkbox',
			'label'     => __( 'Show header contact info', 'homelist' ),
			'section'   => 'homelist_general',
			'settings'  => 'homelist_general_show_header_contact',
		) );


		// Blog Style
		$wp_customize->add_setting( 'homelist_general_blog_style', array(
			'default'           => 'single-select',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( 'homelist_general_blog_style', array(
			'type'      => 'select',
			'label'     => __( 'Blog Style', 'homelist' ),
			'section'   => 'homelist_general',
			'settings'  => 'homelist_general_blog_style',
			'choices'	=> array(
				'blog-fullwidth'	        => __( 'Blog Fullwidth', 'homelist'),
				'blog-grid'	                => __( 'Blog Grid', 'homelist'),
				'blog-grid-left-sidebar'	=> __( 'Blog Grid Left Sidebar', 'homelist'),
				'blog-grid-right-sidebar'	=> __( 'Blog Grid Right Sidebar', 'homelist'),
				'blog-left-sidebar'     	=> __( 'Blog Left Sidebar', 'homelist'),
				'blog-right-sidebar'	    => __( 'Blog Right Sidebar', 'homelist'),
			)
		) );
	}
}

Homelist_Customizations_General::init();
