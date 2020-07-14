<?php

/**
 * Libraries
 */
require get_parent_theme_file_path('assets/libraries/class-tgm-plugin-activation.php');

/**
 * Constants
 */
define( 'HOMELIST_PROPERTY_EXCERPT_LENGTH', 22 );
define( 'HOMELIST_AGENCY_EXCERPT_LENGTH', 20 );

/**
 * Custom excerpt length
 *
 * @param $length
 * @return int
 */
function homelist_excerpt_length( $length ) {
	global $post;

	if ( $post->post_type == 'property' ) {
		return HOMELIST_PROPERTY_EXCERPT_LENGTH;
	} elseif ( $post->post_type == 'agency' ) {
		return HOMELIST_AGENCY_EXCERPT_LENGTH;
	}

	return $length;
}
add_filter('excerpt_length', 'homelist_excerpt_length' );


if ( ! function_exists( 'homelist_fonts_url' ) ) :
/**
 * Register Google fonts for Homelist.
 *
 * Create your own homelist_fonts_url() function to override in a child theme.
 *
 * @since Homelist 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function homelist_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Nunito, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Nunito font: on or off', 'homelist' ) ) {
		$fonts[] = 'Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i';
	}

	/* translators: If there are characters in your language that are not supported by Abril Fatface, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Abril Fatface font: on or off', 'homelist' ) ) {
		$fonts[] = 'Abril Fatface';
	}

	/* translators: If there are characters in your language that are not supported by Caveat Brush, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Caveat Brush font: on or off', 'homelist' ) ) {
		$fonts[] = 'Caveat Brush';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Homelist 1.0
 */
function homelist_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'homelist_javascript_detection', 0 );


/**
 * Enqueue scripts & styles
 *
 * @return void
 */
function homelist_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'homelist-fonts', homelist_fonts_url(), array(), null );

	// Add Bootstrap, used in the main stylesheet.
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css', array(), null );

	wp_enqueue_style( 'animate', get_template_directory_uri() . '/assets/css/animate.min.css', array(), null );

    wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/css/slick.css', array(), null );
    wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/assets/css/slick-theme.css', array(), null );

	// Add Icons, used in the main stylesheet.
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), null );
	wp_enqueue_style( 'flaticon', get_template_directory_uri() . '/assets/fonts/flaticon/flaticon.css', array(), null );

	// Theme stylesheet.
	wp_enqueue_style( 'wp-style', get_stylesheet_uri() );

	// Theme stylesheet.
	wp_enqueue_style( 'homelist-style', get_template_directory_uri() . '/assets/css/style.css', array(), null );

	// Reset styles.
	wp_enqueue_style( 'homelist-reset', get_template_directory_uri() . '/assets/css/reset.css', array(), null );

	// Add mobile friendly styles.
	wp_enqueue_style( 'homelist-responsive', get_template_directory_uri() . '/assets/css/responsive.css', array(), null );

	// Load the html5 shiv.
	wp_enqueue_script( 'homelist-html5', get_template_directory_uri() . '/assets/js/html5shiv.js', array(), '3.7.3' );
	wp_script_add_data( 'homelist-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.js', array( 'jquery' ), null, true );

	wp_enqueue_script( 'bootstrap-touch-slider', get_template_directory_uri() . '/assets/js/bootstrap-touch-slider.js', array( 'jquery' ), null, true );

	wp_enqueue_script( 'jquery.easing', get_template_directory_uri() . '/assets/js/jquery.easing.js', array( 'jquery' ), null, true );

    wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/js/slick.min.js', array( 'jquery' ), null, true );

    wp_enqueue_script('masonry');

	wp_enqueue_script( 'homelist-script', get_template_directory_uri() . '/assets/js/script.js', array( 'jquery' ), null, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'homelist_scripts' );


/**
 * Additional after theme setup functions
 *
 * @return void
 */
function homelist_after_theme_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/homelist
	 * If you're building a theme based on Homelist, use a find and replace
	 * to change 'homelist' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'homelist', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for custom logo.
	 *
	 *  @since Homelist 1.2
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', homelist_fonts_url() ) );

	add_theme_support( 'custom-background' );

	add_theme_support( 'custom-header' );

	add_theme_support( 'realia-custom-styles' );

    //add_theme_support( 'menus' );

    register_nav_menus();

	if ( ! isset( $content_width ) ) {
		$content_width = 1170;
	}

}
add_action( 'after_setup_theme', 'homelist_after_theme_setup' );

/**
 * Register menus
 *
 * @return void
 */
function homelist_menus() {
	register_nav_menu( 'primary', esc_html__( 'Primary', 'homelist' ) );
}
add_action( 'init', 'homelist_menus' );

/**
 * Custom widget areas
 *
 * @return void
 */
function homelist_sidebars() {
	register_sidebar( array( 'name' => esc_html__( 'Primary', 'homelist' ), 'id' => 'sidebar-1', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>', 'before_title'  => '<div class="widget-header"><h3>', 'after_title'   => '</h3></div>' ) );
	register_sidebar( array( 'name' => esc_html__( 'Content Fullwidth', 'homelist' ), 'id' => 'sidebar-top-fullwidth', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
	register_sidebar( array( 'name' => esc_html__( 'Content Left', 'homelist' ), 'id' => 'sidebar-left-fullwidth', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
	register_sidebar( array( 'name' => esc_html__( 'Content Right', 'homelist' ), 'id' => 'sidebar-right-fullwidth', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
	register_sidebar( array( 'name' => esc_html__( 'Footer First', 'homelist' ), 'id' => 'footer-first', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h3>', 'after_title' => '</h3>' ) );
	register_sidebar( array( 'name' => esc_html__( 'Footer Second', 'homelist' ), 'id' => 'footer-second', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h3>', 'after_title' => '</h3>' ) );
	register_sidebar( array( 'name' => esc_html__( 'Footer Third', 'homelist' ), 'id' => 'footer-third', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h3>', 'after_title' => '</h3>' ) );
	register_sidebar( array( 'name' => esc_html__( 'Footer Fourth', 'homelist' ), 'id' => 'footer-fourth', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h3>', 'after_title' => '</h3>' ) );
	register_sidebar( array( 'name' => esc_html__( 'Footer Bottom Left', 'homelist' ), 'id' => 'footer-bottom-left', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h3>', 'after_title' => '</h3>' ) );
	register_sidebar( array( 'name' => esc_html__( 'Footer Bottom Right', 'homelist' ), 'id' => 'footer-bottom-right', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h3>', 'after_title' => '</h3>' ) );
}
add_action( 'widgets_init', 'homelist_sidebars' );

/**
 * Disable admin's bar top margin
 *
 * @return void
 */
function homelist_disable_admin_bar_top_margin() {
	remove_action( 'wp_head', '_admin_bar_bump_cb' );
}
add_action( 'get_header', 'homelist_disable_admin_bar_top_margin' );

/**
 * Read more for post excerpt
 *
 * @param $more
 * @return void|string
 */
function homelist_excerpt_read_more( $more ) {
	global $post;

	if ( $post->post_type == 'property' || $post->post_type == 'agency' ) {
		return null;
	}

	return '<a class="post-read-more" href="'. get_permalink( $post->ID ) . '">' . esc_html__( 'Read more', 'homelist' ) . '</a>';
}
add_filter( 'excerpt_more', 'homelist_excerpt_read_more' );


/**
 * Customizations
 *
 * @param $wp_customize
 * @return void
 */
function homelist_customizations( $wp_customize ) {
	$wp_customize->add_section( 'homelist_general', array( 'title' => esc_html__( 'Homelist General', 'homelist' ), 'priority' => 0 ) );

	$wp_customize->add_setting( 'homelist_general_logo', array( 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'header_logo', array(
		'label'         => esc_html__( 'Logo', 'homelist' ),
		'section'       => 'homelist_general',
		'settings'      => 'homelist_general_logo',
		'description'   => esc_html__( 'Logo displayed in header. By default it has some opacity added by CSS which will change after hover.', 'homelist' ),
	) ) );
}
add_action( 'customize_register', 'homelist_customizations' );

/**
 * Register plugins
 *
 * @return void
 */
function homelist_register_required_plugins() {
	$plugins = array(
		array(
            'name'                  => 'Realia',
            'slug'                  => 'realia',
            'source'                => get_template_directory() . '/plugins/realia.zip',
            'required'              => true,
            'force_deactivation'    => true,
            'is_automatic'          => false,
            'version'               => '0.1.0',
        ),
		array(
            'name'                  => 'Homelist Plugin',
            'slug'                  => 'homelist',
            'source'                => get_template_directory() . '/plugins/homelist.zip',
            'required'              => true,
            'force_deactivation'    => true,
            'is_automatic'          => false,
            'version'               => '0.1.0',
        ),
		array(
            'name'                  => 'WP Options Importer',
            'slug'                  => 'options-importer',
            'source'                => get_template_directory() . '/plugins/options-importer.5.zip',
            'required'              => true,
            'force_deactivation'    => true,
            'is_automatic'          => false,
            'version'               => '0.1.0',
        ),
		array(
            'name'      			=> 'CMB2',
            'slug'      			=> 'cmb2',
            'is_automatic'          => false,
            'required'  			=> false,
        ),
		array(
            'name'      			=> 'Widget Logic',
            'slug'      			=> 'widget-logic',
            'is_automatic'          => false,
            'required'  			=> false,
        ),
		array(
            'name'      			=> 'Contact Form 7',
            'slug'      			=> 'contact-form-7',
            'is_automatic'          => false,
            'required'  			=> false,
        ),
		array(
            'name'      			=> 'One Click Demo Import',
            'slug'      			=> 'one-click-demo-import',
            'is_automatic'          => false,
            'required'  			=> true,
        ),
		array(
            'name'      			=> 'WordPress Colorbox Lightbox',
            'slug'      			=> 'wp-colorbox',
            'is_automatic'          => false,
            'required'  			=> false,
        ),

	);

	tgmpa( $plugins );
}
add_action( 'tgmpa_register', 'homelist_register_required_plugins' );


if ( ! function_exists( 'homelist_get_tag_list' ) ) :
/**
 * Prints HTML with category and tags for current post.
 *
 * Create your own homelist_entry_taxonomies() function to override in a child theme.
 *
 * @since Resta 1.0
 */
function homelist_get_tag_list() {
	$tags_list = get_the_tag_list( '', _x( ' ', 'Used between list items, there is a space after the comma.', 'homelist' ) );
	if ( $tags_list ) {
		printf( '<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
			_x( 'Tags', 'Used before tag names.', 'homelist' ),
			$tags_list
		);
	}
}
endif;


function homelist_remove_responsive_images( $attr ) {
	if( isset( $attr['sizes'] ) ) {
		unset( $attr['sizes'] );
	}

	if( isset( $attr['srcset'] ) ) {
		unset( $attr['srcset'] );
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'homelist_remove_responsive_images', 9999 );


function homelist_social_links($ul_class = '', $i_class = '' ) {
    $social_networks = array(
	    'delicious'		=> esc_html__('Delicius','homelist'), 
	    'deviantart'	=> esc_html__('Deviant Art','homelist'), 
	    'digg'			=> esc_html__('Digg','homelist'),
	    'twitter' 		=> esc_html__('Twitter','homelist'),
	    'facebook'		=> esc_html__('Facebook','homelist'), 
	    'flickr'		=> esc_html__('Flickr','homelist'),
	    'google-plus' 	=> esc_html__('Google Plus','homelist'),				
	    'linkedin' 		=> esc_html__('Linkedin','homelist'),
	    'picasa' 		=> esc_html__('Picasa','homelist'),
	    'pinterest' 	=> esc_html__('Pinterest','homelist'),
	    'rss' 			=> esc_html__('Rss','homelist'),
	    'skype'			=> esc_html__('Skype','homelist'),
	    'stumbleupon' 	=> esc_html__('Stumble Upon','homelist'),
	    'tumblr' 		=> esc_html__('Tumblr','homelist'),
	    'vimeo' 		=> esc_html__('Vimeo','homelist'),
	    'youtube' 		=> esc_html__('Youtube','homelist'),
	    'instagram'     => esc_html__('Instagram','homelist'),
    );
    $prefix = 'homelist_social_links_';
    echo '<ul class="' . esc_attr( $ul_class ) . '">';
	foreach( $social_networks as $key => $text_domain ) {
        $link = get_theme_mod( $prefix.$key, null ); 
        if( !empty( $link ) ) {
            if ( is_array( $i_class ) ) {
                echo '<li><a href="' . esc_url( $link ) . '" title="' . esc_attr( $text_domain ) . '"><i class="' . esc_attr( $i_class[0].$key.$i_class[1]) . '"></i></a></li> ';
            } else {
                echo '<li><a href="' . esc_url( $link ) . '" title="' . esc_attr( $text_domain ) . '"><i class="' . esc_attr( $i_class.$key) . '"></i></a></li> ';
            }
        } 
	}
    echo '</ul>';
}


function homelist_get_agency_properties( $post_id = null ) {
	if ( null == $post_id ) {
		$post_id = get_the_ID();
	}

	$args = array(
		'post_type'         => 'property',
		'posts_per_page'    => -1,
		'meta_query'        => array(
			array(
				'key'       => 'property_agents',
				'value'     => '"' . $post_id . '"',
				'compare'   => 'LIKE',
			),
		),
	);

	return new WP_Query( $args );
}

if ( ! function_exists( 'the_homelist_title' ) ) :
/**
 * Shim for `the_homelist_title()`.
 *
 * Display the archive title based on the queried object.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function the_homelist_title( $before = '', $after = '' ) {
	if ( is_home() ) {
        $blog_title = get_bloginfo();
		$title = empty($blog_title) ? esc_html__( 'Home Page', 'homelist' ) : $blog_title . ' ' . __( 'Blog', 'homelist' );
	} elseif ( is_search() ) {
		$title = esc_html__( 'Search', 'homelist' );
	} elseif ( is_category() ) {
		$title = sprintf( esc_html__( 'Category: %s', 'homelist' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( esc_html__( 'Tag: %s', 'homelist' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( esc_html__( 'Author: %s', 'homelist' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( esc_html__( 'Year: %s', 'homelist' ), get_the_date( _x( 'Y', 'yearly archives date format', 'homelist' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( esc_html__( 'Month: %s', 'homelist' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'homelist' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( esc_html__( 'Day: %s', 'homelist' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'homelist' ) ) );
	} elseif ( is_tax( 'post_format', 'post-format-aside' ) ) {
		$title = _x( 'Asides', 'post format archive title', 'homelist' );
	} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
		$title = _x( 'Galleries', 'post format archive title', 'homelist' );
	} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
		$title = _x( 'Images', 'post format archive title', 'homelist' );
	} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
		$title = _x( 'Videos', 'post format archive title', 'homelist' );
	} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
		$title = _x( 'Quotes', 'post format archive title', 'homelist' );
	} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
		$title = _x( 'Links', 'post format archive title', 'homelist' );
	} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
		$title = _x( 'Statuses', 'post format archive title', 'homelist' );
	} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
		$title = _x( 'Audio', 'post format archive title', 'homelist' );
	} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
		$title = _x( 'Chats', 'post format archive title', 'homelist' );
	} elseif ( is_post_type_archive() ) {
        if ( function_exists( 'is_woocommerce' ) ) { 
            $title = post_type_archive_title( '', false );
        } else {
            if ( ! empty( $_GET['filter-contract'] ) ) {
                $archive_title  = ( 'SALE' == $_GET['filter-contract'] ) ? esc_html__( 'SALE', 'homelist' ) : esc_html__( 'RENT', 'homelist' );
            } else {
                $archive_title  = post_type_archive_title( '', false );
            }
		    $title = sprintf( esc_html__( '%s', 'homelist' ), $archive_title );
        }
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( esc_html__( '%1$s: %2$s', 'homelist' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} elseif ( is_404() ) {
		$title = esc_html__( 'Page not found', 'homelist' );
	} else {
		$title = the_title( '<h2>', '</h2>' );
		//$title = esc_html__( 'Archives', 'homelist' );
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_homelist_title', $title );

	if ( ! empty( $title ) ) {
		echo wp_kses_post( $before . $title . $after );
	}
}
endif;

function homelist_add_query_vars_filter( $vars ){
  $vars[] = "display";
  return $vars;
}
add_filter( 'query_vars', 'homelist_add_query_vars_filter' );


function homelist_get_breadcrumb() {
    echo '<div class="breadcrumb">';
    echo '<a href="'.home_url().'" rel="nofollow">'.__( 'Home', 'homelist' ).'</a>';

    if ( is_home() ) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
        echo esc_html__( 'Blog', 'homelist' );
    } elseif ( is_category() || is_single() || is_archive() ) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
        the_category(' &bull; ');
        if ( is_single() ) {
            echo " &nbsp;&nbsp;&#187;&nbsp;&nbsp; ";
            the_title();
        }
    } elseif ( is_page() ) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
        echo the_title();
    } elseif ( is_search() ) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;".__( 'Search Results for...', 'homelist' );
        echo '"<em>';
        echo the_search_query();
        echo '</em>"';
    }
    echo '</div>"';
}

function homelist_check_realia_plugin(  ) {
    if( !function_exists('is_plugin_active') ) {		
        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    }
    if ( is_plugin_active( 'realia/realia.php' ) ) {
        return true;
    }
    return false;
}

function homelist_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}


require_once(get_template_directory() . '/inc/wp_bootstrap_navwalker.php');
require_once(get_template_directory() . '/inc/wp_bootstrap_pagination.php');
require_once(get_template_directory() . '/inc/comments.php');
require_once(get_template_directory() . '/inc/customizer.php');
