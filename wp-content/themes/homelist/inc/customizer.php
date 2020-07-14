<?php

function homelist_custom_header_and_background() {
	$color_scheme             = homelist_get_color_scheme();
	$default_background_color = trim( $color_scheme[0], '#d82460' );
	$default_text_color       = trim( $color_scheme[3], '#d82460' );
    
	add_theme_support( 'custom-background', apply_filters( 'homelist_custom_background_args', array(
		'default-color' => $default_background_color,
	) ) );
}
add_action( 'after_setup_theme', 'homelist_custom_header_and_background' );


function homelist_customize_register( $wp_customize ) {
	$color_scheme = homelist_get_color_scheme();

	// Add color scheme setting and control.
	$wp_customize->add_setting( 'color_scheme', array(
		'default'           => 'default',
		'sanitize_callback' => 'homelist_sanitize_color_scheme',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'color_scheme', array(
		'label'    => __( 'Base Color Scheme', 'homelist' ),
		'section'  => 'colors',
		'type'     => 'select',
		'choices'  => homelist_get_color_scheme_choices(),
		'priority' => 1,
	) );

	// Add page background color setting and control.
	$wp_customize->add_setting( 'object_background_color', array(
		'default'           => $color_scheme[1],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'object_background_color', array(
		'label'       => __( 'Object Background Color', 'homelist' ),
		'section'     => 'colors',
	) ) );

	// Remove the core header textcolor control, as it shares the main text color.
	$wp_customize->remove_control( 'header_textcolor' );
    /*
	// Add link color setting and control.
	$wp_customize->add_setting( 'link_color', array(
		'default'           => $color_scheme[2],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
		'label'       => __( 'Link Color', 'homelist' ),
		'section'     => 'colors',
	) ) );
    */
	// Add main text color setting and control.
	$wp_customize->add_setting( 'main_text_color', array(
		'default'           => $color_scheme[3],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_text_color', array(
		'label'       => __( 'Main Text Color', 'homelist' ),
		'section'     => 'colors',
	) ) );

}
add_action( 'customize_register', 'homelist_customize_register', 11 );


function homelist_get_color_schemes() {
	return apply_filters( 'homelist_color_schemes', array(
		'default' => array(
			'label'  => __( 'Default', 'homelist' ),
			'colors' => array(
				'#ffffff',
				'#d82460',
				'#d82460',
				'#d82460',
				'#d82460',
			),
		),
		'dark' => array(
			'label'  => __( 'Dark', 'homelist' ),
			'colors' => array(
				'#f7f7f7',
				'#1a1a1a',
				'#9adffd',
				'#444444',
				'#c1c1c1',
			),
		),
		'gray' => array(
			'label'  => __( 'Purple', 'homelist' ),
			'colors' => array(
				'#ffffff',
				'#d824a1',
				'#d824a1',
				'#d824a1',
				'#d824a1',
			),
		),
		'red' => array(
			'label'  => __( 'Red', 'homelist' ),
			'colors' => array(
				'#ffffff',
				'#ff675f',
				'#640c1f',
				'#ff675f',
				'#402b30',
			),
		),
		'yellow' => array(
			'label'  => __( 'Yellow', 'homelist' ),
			'colors' => array(
				'#3b3721',
				'#ffb606',
				'#774e24',
				'#ffb606',
				'#5b4d3e',
			),
		),
	) );
}

if ( ! function_exists( 'homelist_get_color_scheme' ) ) :
    function homelist_get_color_scheme() {
	    $color_scheme_option = get_theme_mod( 'color_scheme', 'default' );
	    $color_schemes       = homelist_get_color_schemes();

	    if ( array_key_exists( $color_scheme_option, $color_schemes ) ) {
		    return $color_schemes[ $color_scheme_option ]['colors'];
	    }

	    return $color_schemes['default']['colors'];
    }
endif; // homelist_get_color_scheme


if ( ! function_exists( 'homelist_get_color_scheme_choices' ) ) :
    function homelist_get_color_scheme_choices() {
	    $color_schemes                = homelist_get_color_schemes();
	    $color_scheme_control_options = array();

	    foreach ( $color_schemes as $color_scheme => $value ) {
		    $color_scheme_control_options[ $color_scheme ] = $value['label'];
	    }

	    return $color_scheme_control_options;
    }
endif; // homelist_get_color_scheme_choices


if ( ! function_exists( 'homelist_sanitize_color_scheme' ) ) :
    function homelist_sanitize_color_scheme( $value ) {
	    $color_schemes = homelist_get_color_scheme_choices();

	    if ( ! array_key_exists( $value, $color_schemes ) ) {
		    return 'default';
	    }

	    return $value;
    }
endif; // homelist_sanitize_color_scheme


function homelist_color_scheme_css() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );

	// Don't do anything if the default color scheme is selected.
	if ( 'default' === $color_scheme_option ) {
		return;
	}

	$color_scheme = homelist_get_color_scheme();

	// Convert main text hex color to rgba.
	$color_textcolor_rgb = homelist_hex2rgb( $color_scheme[3] );

	// If the rgba values are empty return early.
	if ( empty( $color_textcolor_rgb ) ) {
		return;
	}

	// If we get this far, we have a custom color scheme.
	$colors = array(
		'background_color'      => $color_scheme[0],
		'object_background_color' => $color_scheme[1],
		//'link_color'            => $color_scheme[2],
		'main_text_color'       => $color_scheme[3],
		'border_color'          => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.2)', $color_textcolor_rgb ),

	);

	$color_scheme_css = homelist_get_color_scheme_css( $colors );

	wp_add_inline_style( 'homelist-style', $color_scheme_css );
}
add_action( 'wp_enqueue_scripts', 'homelist_color_scheme_css' );


function homelist_customize_control_js() {
	wp_enqueue_script( 'color-scheme-control', get_template_directory_uri() . '/assets/js/color-scheme-control.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '20160816', true );
	wp_localize_script( 'color-scheme-control', 'colorScheme', homelist_get_color_schemes() );
}
add_action( 'customize_controls_enqueue_scripts', 'homelist_customize_control_js' );


function homelist_customize_preview_js() {
	wp_enqueue_script( 'homelist-customize-preview', get_template_directory_uri() . '/assets/js/customize-preview.js', array( 'customize-preview' ), '20160816', true );
}
add_action( 'customize_preview_init', 'homelist_customize_preview_js' );


function homelist_get_color_scheme_css( $colors ) {
	$colors = wp_parse_args( $colors, array(
		'background_color'      => '',
		'object_background_color' => '',
		//'link_color'            => '',
		'main_text_color'       => '',
		'border_color'          => '',
	) );

	return <<<CSS
	/* Color Scheme */

	/* Background Color */

	/* Object Background Color */
    .btn-success,
    .navbar-default .navbar-nav > .active > a::before,
    .signin,
    .button,
    .signout:hover,
    .signout:focus,
    .signout:active,
    .main-search input[type="submit"].btn-block, 
    .main-search button.btn-block, 
    .button-primary,
    .property-container .property-text .btn-success:hover,
    .property-table-actions-inner .btn-success:hover,
    .label-primary,
    .post-img h3,
    .single.single-property .property-content h2:after, 
    .similar-properties h2:after, 
    .section-title:after,
    .property-amenities li.yes:after,
    .cmb2-wrap .button-secondary, 
    .cmb2-wrap button,
    .contact-form input[type="button"], 
    .contact-form input[type="reset"], 
    .contact-form input[type="submit"],
    table thead th,
    .nav-links .nav-previous > a:hover,
    .nav-links .nav-next > a:hover,
    .nav-tabs.nav-justified > li > a,
    .property-buttons .property-btn:hover, 
    .btn-read-more:hover,
    .property-slider .carousel-inner .item figure figcaption .slider-details span.sticker,
    .property-slider .carousel-inner .item figure figcaption .slider-details .slide-controls .control-left:hover, 
    .property-slider .carousel-inner .item figure figcaption .slider-details .slide-controls .control-right:hover,
    .bs-slider .button, .bs-slider input[type="submit"],
    .property-title .property-badge .property-contract-badge,
    .login-box .button-primary, 
    .register-box .button-primary,
    .widget-tags a:hover, 
    .tagcloud a:hover,
    .social-links-icon li a:hover,
    .nav-tabs.nav-justified > li > a  {
		background-color: {$colors['object_background_color']} !important;
	}

    .btn-success,
    .signout,
    .property-container .property-text .btn-success:hover,
    .property-table-actions-inner .btn-success:hover,
    .nav-links .nav-previous > a:hover,
    .nav-links .nav-next > a:hover,
    .social-links-icon li a,
    .contact-info .inner .social-icon-three a
    {
	    border-color: {$colors['object_background_color']};
    }

    .has-gradient {
        background-image: -webkit-linear-gradient(to right, #4b68da, {$colors['object_background_color']});
        background-image: -webkit-gradient(linear, left top, left bottom, from(to right), color-stop(#4b68da), to({$colors['object_background_color']}));
        background-image: linear-gradient(to right, #4b68da, {$colors['object_background_color']});
        color: #fff
    }

    .arrow-ribbon {
        background-image: linear-gradient(to right, rgba(216, 36, 96, 0.6) , {$colors['object_background_color']});
    }

    .property-valuation dd .bar-valuation {
        background-color: #894ea3;
        background: -moz-linear-gradient(left, rgba(109,0,160,1) 0%, rgba(109,0,160,0.8) 37%, rgba(34,84,232,0.47) 100%);
        background: -webkit-linear-gradient(left, rgba(109,0,160,1) 0%,rgba(109,0,160,0.8) 37%,rgba(34,84,232,0.47) 100%);
        background: linear-gradient(to right, {$colors['object_background_color']} 0%,#fff 75%,#fff 100%);
    }

	/* Link Color */


	/* Main Text Color */
    .signout,
    .service-icon a > i,
    .property-container .property-content h3 a,
    .property-container .property-text h3 a,
    .agent-content h3 a,
    .agent-text h3 a,
    .agency-content h3 a,
    .agency-text h3 a,
    .property-actions a:hover, .agent-actions a:hover, .agency-actions a:hover,
    .property-actions a:focus, .agent-actions a:focus, .agency-actions a:focus,
    .blog-title h2 a,
    .testimonial-box .testimonial-info .name, 
    .testimonial-box-2 .testimonial-info .name, 
    .testimonial-box-3 .testimonial-info .name,
    .testimonial-box .testimonial-quote-icon,
    .rating-stars li i,
    .not-found .page-header h1,
    .property-slider .carousel-inner .item figure figcaption .slider-details p span,
    .property-slider .carousel-inner .item figure figcaption .slider-details ul li span:first-child,
    .property-slider .carousel-inner .item figure figcaption .slider-details .slide-controls .control-left, 
    .property-slider .carousel-inner .item figure figcaption .slider-details .slide-controls .control-right,
    .property-small-head a,
    #footer .widget h2,
    .contact-info .inner h3,
    .contact-info .inner .social-icon-three a,
    #property-location .browse-location .top-location .country {
		color: {$colors['main_text_color']};
	}


	/* Border Color */


CSS;
}


function homelist_color_scheme_css_template() {
	$colors = array(
		'background_color'      => '{{ data.background_color }}',
		'object_background_color' => '{{ data.object_background_color }}',
		//'link_color'            => '{{ data.link_color }}',
		'main_text_color'       => '{{ data.main_text_color }}',
		'border_color'          => '{{ data.border_color }}',
	);
	?>
	<script type="text/html" id="tmpl-homelist-color-scheme">
		<?php echo homelist_get_color_scheme_css( $colors ); ?>
	</script>
	<?php
}
add_action( 'customize_controls_print_footer_scripts', 'homelist_color_scheme_css_template' );


function homelist_object_background_color_css() {
	$color_scheme          = homelist_get_color_scheme();
	$default_color         = $color_scheme[1];
	$object_background_color = get_theme_mod( 'object_background_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $object_background_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Page Background Color */

        .btn-success,
        .navbar-default .navbar-nav > .active > a::before,
        .signin,
        .button,
        .signout:hover,
        .signout:focus,
        .signout:active,
        .main-search input[type="submit"].btn-block, 
        .main-search button.btn-block, 
        .button-primary,
        .property-container .property-text .btn-success:hover,
        .property-table-actions-inner .btn-success:hover,
        .label-primary,
        .post-img h3,
        .single.single-property .property-content h2:after, 
        .similar-properties h2:after, 
        .section-title:after,
        .property-amenities li.yes:after,
        .cmb2-wrap .button-secondary, 
        .cmb2-wrap button,
        .contact-form input[type="button"], 
        .contact-form input[type="reset"], 
        .contact-form input[type="submit"],
        table thead th,
        .nav-links .nav-previous > a:hover,
        .nav-links .nav-next > a:hover,
        .nav-tabs.nav-justified > li > a,
        .property-buttons .property-btn:hover, 
        .btn-read-more:hover,
        .property-slider .carousel-inner .item figure figcaption .slider-details span.sticker,
        .property-slider .carousel-inner .item figure figcaption .slider-details .slide-controls .control-left:hover, 
        .property-slider .carousel-inner .item figure figcaption .slider-details .slide-controls .control-right:hover,
        .bs-slider .button, .bs-slider input[type="submit"],
        .property-title .property-badge .property-contract-badge,
        .login-box .button-primary, 
        .register-box .button-primary,
        .widget-tags a:hover, 
        .tagcloud a:hover,
        .social-links-icon li a:hover,
        .nav-tabs.nav-justified > li > a  {
			background-color: %1$s !important;
		}

        .btn-success,
        .signout,
        .property-container .property-text .btn-success:hover,
        .property-table-actions-inner .btn-success:hover,
        .nav-links .nav-previous > a:hover,
        .nav-links .nav-next > a:hover,
        .social-links-icon li a,
        .contact-info .inner .social-icon-three a
        {
	        border-color: %1$s;
        }

        .has-gradient {
            background-image: -webkit-linear-gradient(to right, #4b68da, %1$s);
            background-image: -webkit-gradient(linear, left top, left bottom, from(to right), color-stop(#4b68da), to(%1$s));
            background-image: linear-gradient(to right, #4b68da, %1$s);
            color: #fff
        }

        .arrow-ribbon {
            background-image: linear-gradient(to right, rgba(216, 36, 96, 0.6) , %1$s);
        }

        .property-valuation dd .bar-valuation {
            background-color: %1$s;
            background-image: linear-gradient(to left, #fff, %1$s);
        }

	';

	wp_add_inline_style( 'homelist-style', sprintf( $css, $object_background_color ) );
}
add_action( 'wp_enqueue_scripts', 'homelist_object_background_color_css', 11 );

/*
function homelist_link_color_css() {
	$color_scheme    = homelist_get_color_scheme();
	$default_color   = $color_scheme[2];
	$link_color = get_theme_mod( 'link_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $link_color === $default_color ) {
		return;
	}

	$css = '
        .signout,
        .service-icon a > i,
        .property-container .property-content h3 a,
        .property-container .property-text h3 a,
        .agent-content h3 a,
        .agent-text h3 a,
        .agency-content h3 a,
        .agency-text h3 a,
        .property-actions a:hover, .agent-actions a:hover, .agency-actions a:hover,
        .property-actions a:focus, .agent-actions a:focus, .agency-actions a:focus,
        .blog-title h2 a,
        .property-small-head a {
			color: %1$s;
		}


	';

	wp_add_inline_style( 'homelist-style', sprintf( $css, $link_color ) );
}
add_action( 'wp_enqueue_scripts', 'homelist_link_color_css', 11 );
*/

function homelist_main_text_color_css() {
	$color_scheme    = homelist_get_color_scheme();
	$default_color   = $color_scheme[3];
	$main_text_color = get_theme_mod( 'main_text_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $main_text_color === $default_color ) {
		return;
	}

	// Convert main text hex color to rgba.
	$main_text_color_rgb = homelist_hex2rgb( $main_text_color );

	// If the rgba values are empty return early.
	if ( empty( $main_text_color_rgb ) ) {
		return;
	}

	// If we get this far, we have a custom color scheme.
	$border_color = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.2)', $main_text_color_rgb );

	$css = '
		/* Custom Main Text Color */
        .signout,
        .service-icon a > i,
        .property-container .property-content h3 a,
        .property-container .property-text h3 a,
        .agent-content h3 a,
        .agent-text h3 a,
        .agency-content h3 a,
        .agency-text h3 a,
        .property-actions a:hover, .agent-actions a:hover, .agency-actions a:hover,
        .property-actions a:focus, .agent-actions a:focus, .agency-actions a:focus,
        .blog-title h2 a,
        .testimonial-box .testimonial-info .name, 
        .testimonial-box-2 .testimonial-info .name, 
        .testimonial-box-3 .testimonial-info .name,
        .testimonial-box .testimonial-quote-icon,
        .rating-stars li i,
        .not-found .page-header h1,
        .property-slider .carousel-inner .item figure figcaption .slider-details p span,
        .property-slider .carousel-inner .item figure figcaption .slider-details ul li span:first-child,
        .property-slider .carousel-inner .item figure figcaption .slider-details .slide-controls .control-left, 
        .property-slider .carousel-inner .item figure figcaption .slider-details .slide-controls .control-right,
        .property-small-head a,
        #footer .widget h2,
        .contact-info .inner h3,
        .contact-info .inner .social-icon-three a,
        .property-amenities li.no:after,
        #property-location .browse-location .top-location .country {
			color: %1$s
		}

	';

	wp_add_inline_style( 'homelist-style', sprintf( $css, $main_text_color, $border_color ) );
}
add_action( 'wp_enqueue_scripts', 'homelist_main_text_color_css', 11 );
