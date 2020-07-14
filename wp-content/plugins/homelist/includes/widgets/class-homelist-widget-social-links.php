<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Homelist_Widget_Social_Links extends WP_Widget {
	/**
	 * Initialize widget
	 *
	 * @access public
	 * @return void
	 */
	function __construct() {
		parent::__construct(
			'homelist_social_links',
			__( 'Homelist Social Links', 'homelist' ),
			array(
				'description' => __( 'Displays social links icon.', 'homelist' ),
			)
		);
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
        
        echo wp_kses( $args['before_widget'], wp_kses_allowed_html( 'post' ) );

        if ( ! empty( $instance['classes'] ) ) : 
        ?>
	        <div class="<?php echo esc_attr($instance['classes']); ?>">
        <?php 
        endif;
        ?>

        <?php
        if ( ! empty( $instance['title'] ) ) : 
            echo wp_kses( $args['before_title'], wp_kses_allowed_html( 'post' ) ); 
	        echo wp_kses( $instance['title'], wp_kses_allowed_html( 'post' ) ); 
	        if ( ! empty( $instance['description'] ) ) : ?>
		        <small>
			        <?php echo wp_kses( $instance['description'], wp_kses_allowed_html( 'post' ) ); ?>
		        </small><!-- /.description -->
	        <?php endif;

            echo wp_kses( $args['after_title'], wp_kses_allowed_html( 'post' ) ); 
        endif; 
        ?>

        <?php homelist_social_links( 'social-links-icon', array( 'fa fa-', '' ) ); ?>

        <?php if ( ! empty( $instance['classes'] ) ) : ?>
	        </div>
        <?php endif; ?>


        <?php echo wp_kses( $args['after_widget'], wp_kses_allowed_html( 'post' ) ); 
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

    $title = ! empty( $instance['title'] ) ? $instance['title'] : '';
    $description = ! empty( $instance['description'] ) ? $instance['description'] : '';
    $classes = ! empty( $instance['classes'] ) ? $instance['classes'] : '';

    ?>

    <!-- TITLE -->
    <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
            <?php echo __( 'Title', 'homelist' ); ?>
        </label>

        <input  class="widefat"
                id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
                name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
                type="text"
                value="<?php echo esc_attr( $title ); ?>">
    </p>

    <!-- DESCRIPTION -->
    <p>
	    <label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>">
		    <?php echo __( 'Description', 'homelist' ); ?>
	    </label>

	    <textarea class="widefat"
	              rows="4"
	              id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"
	              name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>"><?php echo esc_attr( $description ); ?></textarea>
    </p>

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
	    <small><?php echo __( 'Additional classes e.g. <i>fullwidth background-gray</i>', 'homelist' ); ?></small>
    </p>

    <?php
	}
}
