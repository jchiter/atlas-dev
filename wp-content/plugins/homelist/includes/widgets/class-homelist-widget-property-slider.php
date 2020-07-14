<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Homelist_Widget_Property_Slider extends WP_Widget {
	/**
	 * Initialize widget
	 *
	 * @access public
	 * @return void
	 */
	function __construct() {
		parent::__construct(
			'property_slider',
			__( 'Homelist Property Slider', 'homelist' ),
			array(
				'description' => __( 'Displays properties in slider', 'homelist' ),
			)
		);

		add_action( 'body_class', array( __CLASS__, 'add_body_class' ) );
	}

	/**
	 * Adds classes to body
	 *
	 * @param $classes array
	 *
	 * @access public
	 * @return array
	 */
	public static function add_body_class( $classes ) {
		$settings = get_option( 'widget_property_slider' );

		if ( is_array( $settings ) ) {
			foreach ( $settings as $key => $value ) {
				if ( is_active_widget( false, 'property_slider-' . $key, 'property_slider' ) ) {
					if ( ! empty( $value['classes'] ) ) {
						$parts   = explode( ',', $value['classes'] );
						$classes = array_merge( $classes, $parts );
					}
				}
			}
		}

		return $classes;
	}

	/**
	 * Frontend
	 *
	 * @access public
	 * @param array $args
	 * @param array $instance
	 * @return void
	 */
	function widget( $args, $instance ) {
		query_posts( array(
			'post_type'         => 'property',
			'post_status'       => 'publish',
			'posts_per_page'    => -1,
	        'meta_query' => array(
		        array(
			        'key'     => 'property_add_to_slider',
			        'value'   => 'on',
			        'compare' => '=',
		        ),
	        ),
			'orderby'           => 'post__in'
		) );

        echo wp_kses( $args['before_widget'], wp_kses_allowed_html( 'post' ) ); ?>

        <?php if ( ! empty( $instance['title'] ) ) : ?>
	        <?php echo wp_kses( $args['before_title'], wp_kses_allowed_html( 'post' ) ); ?>
	        <?php echo wp_kses( $instance['title'], wp_kses_allowed_html( 'post' ) ); ?>
	        <?php echo wp_kses( $args['after_title'], wp_kses_allowed_html( 'post' ) ); ?>
        <?php endif; ?>

        <?php if ( 'box' == $instance['display'] ) : ?>
	    <div class="property-slider">
		    <div id="remp-carousel" class="carousel slide carousel-fade" data-ride="carousel">
			    <div class="carousel-inner">
        <?php endif; ?>

        <?php if ( 'row' == $instance['display'] ) : ?>
        <div id="header" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner">
        <?php endif; ?>

        <?php if ( 'flat' == $instance['display'] ) : ?>
	    <div id="bootstrap-touch-slider" class="carousel bs-slider slide fade control-round indicators-line" data-ride="carousel" data-pause="hover" data-interval="5000">
            <div class="carousel-inner" role="listbox">
        <?php endif; ?>

                <?php if ( have_posts() ) :  ?>
		            <?php while ( have_posts() ) : the_post(); ?>
                        <?php include Realia_Template_Loader::locate( 'sliders/' . $instance['display'] ); ?>
		            <?php endwhile; ?>
                <?php endif; ?>

        <?php if ( 'box' == $instance['display'] ) : ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if ( 'row' == $instance['display'] ) : ?>
            </div>
            <a class="left carousel-control" href="#header" role="button" data-slide="prev">
                <span class="fa fa-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#header" role="button" data-slide="next">
                <span class="fa fa-chevron-right"></span>
            </a>
        </div>
        <?php endif; ?>

        <?php if ( 'flat' == $instance['display'] ) : ?>
                </div>
                <!-- Left Control -->
                <a class="left carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="prev">
                    <span class="fa fa-angle-left" aria-hidden="true"></span>
                    <span class="sr-only"><?php echo __( 'Previous', 'homelist' ); ?></span>
                </a>
                <!-- Right Control -->
                <a class="right carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="next">
                    <span class="fa fa-angle-right" aria-hidden="true"></span>
                    <span class="sr-only"><?php echo __( 'Next', 'homelist' ); ?></span>
                </a>
            </div>
        <?php endif; ?>


        <?php echo wp_kses( $args['after_widget'], wp_kses_allowed_html( 'post' ) ); 

		wp_reset_query();
	}

	/**
	 * Update
	 *
	 * @access public
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	function update( $new_instance, $old_instance ) {
		return $new_instance;
	}

	/**
	 * Backend
	 *
	 * @access public
	 * @param array $instance
	 * @return void
	 */
	function form( $instance ) {
        $height = ! empty( $instance['height'] ) ? $instance['height'] : '500px';
        $size = ! empty( $instance['size'] ) ? $instance['size'] : 'thumbnail';
        $classes = ! empty( $instance['classes'] ) ? $instance['classes'] : '';
        $show_arrows = ! empty( $instance['show_arrows'] ) ? $instance['show_arrows'] : '';
        $disable_dots = ! empty( $instance['disable_dots'] ) ? $instance['disable_dots'] : '';
        $autoplay = ! empty( $instance['autoplay'] ) ? $instance['autoplay'] : '';
        $autoplay_timeout = ! empty( $instance['autoplay_timeout'] ) ? $instance['autoplay_timeout'] : '';
        $display = ! empty( $instance['display'] ) ? $instance['display'] : 'box';
        ?>

        <!-- CLASSES -->
        <p>
	        <label for="<?php echo esc_attr( $this->get_field_id( 'classes' ) ); ?>">
		        <?php echo __( 'Classes', 'homelist' ); ?>
	        </label>

	        <input  class="widefat"
	                id="<?php echo esc_attr( $this->get_field_id( 'classes' ) ); ?>"
	                name="<?php echo esc_attr( $this->get_field_name( 'classes' ) ); ?>"
	                type="text"
	                value="<?php echo esc_attr( $classes ); ?>">
	        <br>
	        <small><?php echo __( 'Additional classes appended to body class and separated by , e.g. <i>transparent-header, property-slider-append-top</i>', 'homelist' ); ?></small>
        </p>

        <!-- HEIGHT -->
        <p>
	        <label for="<?php echo esc_attr( $this->get_field_id( 'height' ) ); ?>">
		        <?php echo __( 'Container height', 'homelist' ); ?>
	        </label>

	        <input  class="widefat"
	                id="<?php echo esc_attr( $this->get_field_id( 'height' ) ); ?>"
	                name="<?php echo esc_attr( $this->get_field_name( 'height' ) ); ?>"
	                type="text"
	                value="<?php echo esc_attr( $height ); ?>">
	        <br>
	        <small><?php echo __( 'Default value 500px.', 'homelist' ); ?></small>
        </p>

        <!-- SIZE -->
        <?php $sizes = get_intermediate_image_sizes(); ?>

        <?php if ( ! empty( $sizes ) ) : ?>
	        <p>
		        <label for="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>">
			        <?php echo __( 'Thumbnail size', 'homelist' ); ?>
		        </label>

		        <select id="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'size' ) ); ?>">
			        <?php foreach ( $sizes as $thumb_size ) : ?>
				        <option value="<?php echo esc_attr( $thumb_size ); ?>" <?php echo ( $size == $thumb_size ) ? 'selected="selected"' : ''; ?>>
					        <?php echo esc_attr( $thumb_size ); ?>
				        </option>
			        <?php endforeach; ?>
		        </select>
	        </p>
        <?php endif; ?>

        <!-- TEMPLATES -->
        <?php $templates = array('box' =>  __( 'Style - 1', 'homelist' ), 'row' =>  __( 'Style - 2', 'homelist' ), 'flat' =>  __( 'Style - 3', 'homelist' )); ?>

        <?php if ( ! empty( $templates ) ) : ?>
	        <p>
		        <label for="<?php echo esc_attr( $this->get_field_id( 'display' ) ); ?>">
			        <?php echo __( 'Templates', 'homelist' ); ?>
		        </label>

		        <select id="<?php echo esc_attr( $this->get_field_id( 'display' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'display' ) ); ?>">
			        <?php foreach ( $templates as $key => $value ) : ?>
				        <option value="<?php echo esc_attr( $key ); ?>" <?php echo ( $display == $key ) ? 'selected="selected"' : ''; ?>>
					        <?php echo esc_attr( $value ); ?>
				        </option>
			        <?php endforeach; ?>
		        </select>
	        </p>
        <?php endif; ?>

        <!-- SHOW ARROWS -->
        <p>
	        <input  type="checkbox"
	                class="checkbox"
			        <?php echo ! empty( $show_arrows ) ? 'checked="checked"' : ''; ?>
	                id="<?php echo esc_attr( $this->get_field_id( 'show_arrows' ) ); ?>"
	                name="<?php echo esc_attr( $this->get_field_name( 'show_arrows' ) ); ?>">

	        <label for="<?php echo esc_attr( $this->get_field_id( 'show_arrows' ) ); ?>">
		        <?php echo __( 'Show arrows', 'homelist' ); ?>
	        </label>
        </p>

        <!-- DISABLE DOTS -->
        <p>
	        <input  type="checkbox"
	                class="checkbox"
			        <?php echo ! empty( $disable_dots ) ? 'checked="checked"' : ''; ?>
	                id="<?php echo esc_attr( $this->get_field_id( 'disable_dots' ) ); ?>"
	                name="<?php echo esc_attr( $this->get_field_name( 'disable_dots' ) ); ?>">

	        <label for="<?php echo esc_attr( $this->get_field_id( 'disable_dots' ) ); ?>">
		        <?php echo __( 'Disable dots', 'homelist' ); ?>
	        </label>
        </p>

        <!-- AUTOPLAY -->
        <p>
	        <input  type="checkbox"
	                class="checkbox"
			        <?php echo ! empty( $autoplay ) ? 'checked="checked"' : ''; ?>
	                id="<?php echo esc_attr( $this->get_field_id( 'autoplay' ) ); ?>"
	                name="<?php echo esc_attr( $this->get_field_name( 'autoplay' ) ); ?>">

	        <label for="<?php echo esc_attr( $this->get_field_id( 'autoplay' ) ); ?>">
		        <?php echo __( 'Autoplay', 'homelist' ); ?>
	        </label>
        </p>

        <!-- AUTOPLAY TIMEOUT -->
        <p>
	        <label for="<?php echo esc_attr( $this->get_field_id( 'autoplay_timeout' ) ); ?>">
		        <?php echo __( 'Autoplay timeout', 'homelist' ); ?>
	        </label>

	        <input  class="widefat"
	                id="<?php echo esc_attr( $this->get_field_id( 'autoplay_timeout' ) ); ?>"
	                name="<?php echo esc_attr( $this->get_field_name( 'autoplay_timeout' ) ); ?>"
	                type="integer"
	                value="<?php echo esc_attr( $autoplay_timeout ); ?>">
	        <br>
	        <small><?php echo __( 'Default value 2000.', 'homelist' ); ?></small>
        </p>
        <?php
	}
}