<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Homelist_Widget_Services extends WP_Widget {
	/**
	 * Initialize widget
	 *
	 * @access public
	 * @return void
	 */
	function __construct() {
		parent::__construct(
			'homelist_services_widget',
			__( 'Homelist Services', 'homelist' ),
			array(
				'description' => __( 'Displays services in multiple ways.', 'homelist' ),
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
		query_posts( array(
			'post_type'         => 'homelist_service',
			'posts_per_page'    => ! empty( $instance['count'] ) ? $instance['count'] : 3,
		) );

        $instance['per_row'] = ! empty( $instance['per_row'] ) ? $instance['per_row'] : 3;
        $instance['display'] = ! empty( $instance['display'] ) ? $instance['display'] : 'style-1';

        echo wp_kses( $args['before_widget'], wp_kses_allowed_html( 'post' ) );

        if ( ! empty( $instance['classes'] ) ) : ?>
	        <div class="<?php echo esc_attr($instance['classes']); ?>">
        <?php endif; ?>


        <div id="service">
          <div class="container">

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
        
        if ( have_posts() ) : ?>
		    <?php while ( have_posts() ) : the_post(); ?>
                <?php include Realia_Template_Loader::locate( 'services/' . $instance['display'] ); ?>
		    <?php endwhile; ?>

        <?php else : ?>
	        <div class="alert alert-warning">
		        <?php echo __( 'No services found.', 'homelist' ); ?>
	        </div><!-- /.alert -->
        <?php endif; ?>

          </div>  
        </div>

        <?php if ( ! empty( $instance['classes'] ) ) : ?>
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

        $title = ! empty( $instance['title'] ) ? $instance['title'] : ''; 
        $description = ! empty( $instance['description'] ) ? $instance['description'] : ''; 
        $classes = ! empty( $instance['classes'] ) ? $instance['classes'] : ''; 
        $count = ! empty( $instance['count'] ) ? $instance['count'] : 3; 
        $per_row = ! empty( $instance['per_row'] ) ? $instance['per_row'] : 1; 
        $display = ! empty( $instance['display'] ) ? $instance['display'] : 'style-1'; 
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


        <!-- COUNT -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>">
                <?php echo __( 'Count', 'homelist' ); ?>
            </label>

            <input  class="widefat"
                    id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"
                    name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>"
                    type="text"
                    value="<?php echo esc_attr( $count ); ?>">
        </p>

        <!-- PER ROW -->
        <p>
	        <label for="<?php echo esc_attr( $this->get_field_id( 'per_row' ) ); ?>">
		        <?php echo __( 'Items per row', 'homelist' ); ?>
	        </label>

	        <select id="<?php echo esc_attr( $this->get_field_id( 'per_row' ) ); ?>"
	                name="<?php echo esc_attr( $this->get_field_name( 'per_row' ) ); ?>">
		        <option value="1" <?php echo ( '1' == $per_row ) ? 'selected="selected"' : ''; ?>>1</option>
		        <option value="2" <?php echo ( '2' == $per_row ) ? 'selected="selected"' : ''; ?>>2</option>
		        <option value="3" <?php echo ( '3' == $per_row ) ? 'selected="selected"' : ''; ?>>3</option>
		        <option value="4" <?php echo ( '4' == $per_row ) ? 'selected="selected"' : ''; ?>>4</option>
		        <option value="6" <?php echo ( '5' == $per_row ) ? 'selected="selected"' : ''; ?>>5</option>
		        <option value="6" <?php echo ( '6' == $per_row ) ? 'selected="selected"' : ''; ?>>6</option>
	        </select>
        </p>

        <!-- DISPLAY -->
        <p>
	        <label for="<?php echo esc_attr( $this->get_field_id( 'display' ) ); ?>">
		        <?php echo __( 'Display as', 'homelist' ); ?>
	        </label>

	        <select id="<?php echo esc_attr( $this->get_field_id( 'display' ) ); ?>"
	                name="<?php echo esc_attr( $this->get_field_name( 'display' ) ); ?>">
		        <option value="style-1" <?php echo ( 'style-1' == $display || empty( $display ) ) ? 'selected="selected"' : ''; ?>><?php echo __( 'Style 1', 'homelist' ); ?></option>
		        <option value="style-2" <?php echo ( 'style-2' == $display ) ? 'selected="selected"' : ''; ?>><?php echo __( 'Style 2', 'homelist' ); ?></option>
	        </select>
        </p>
        <?php
	}
}
