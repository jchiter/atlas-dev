<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Homelist_Widget_Agencies
 */
class Homelist_Widget_Agencies extends WP_Widget {
	/**
	 * Initialize widget
	 *
	 * @access public
	 * @return void
	 */
	function __construct() {
		parent::__construct(
			'agencies_widget',
			__( 'Agencies', 'homelist' ),
			array(
				'description' => __( 'Displays agencies in multiple ways.', 'homelist' ),
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
			'post_type'         => 'agency',
			'posts_per_page'    => ! empty( $instance['count'] ) ? $instance['count'] : 3,
		) );

        $is_sticky = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'sticky', true ); ?>

        <?php $instance['per_row'] = ! empty( $instance['per_row'] ) ? $instance['per_row'] : 3; ?>
        <?php $instance['fullwidth'] = ( ! empty( $instance['fullwidth'] ) && $instance['fullwidth'] == 'on' ) ? true : false; ?>
        <?php $instance['display'] = ! empty( $instance['display'] ) ? $instance['display'] : 'small'; ?>


        <?php echo wp_kses( $args['before_widget'], wp_kses_allowed_html( 'post' ) ); ?>

        <?php if ( ! empty( $instance['classes'] ) ) : ?>
	        <div class="<?php echo esc_attr($instance['classes']); ?>">
        <?php endif; ?>

        <?php if ( ! $instance['fullwidth'] ) : ?>
            <div class="agencies_content">
              <div class="container">
        <?php endif; ?>

        <?php if ( ! empty( $instance['title'] ) ) : ?>
            <?php echo wp_kses( $args['before_title'], wp_kses_allowed_html( 'post' ) ); ?>
	        <?php echo wp_kses( $instance['title'], wp_kses_allowed_html( 'post' ) ); ?>
	        <?php if ( ! empty( $instance['description'] ) ) : ?>
		        <small>
			        <?php echo wp_kses( $instance['description'], wp_kses_allowed_html( 'post' ) ); ?>
		        </small><!-- /.description -->
	        <?php endif; ?>
            <?php echo wp_kses( $args['after_title'], wp_kses_allowed_html( 'post' ) ); ?>
        <?php endif; ?>

        <?php
        switch($instance['per_row']) {
	        case '1': $class='col-md-12'; break;
	        case '2': $class='col-md-6'; break;
	        case '3': $class='col-md-4'; break;
	        case '4': $class='col-md-3'; break;
        }	
        ?>

        <?php if ( have_posts() ) : ?>

	        <div class="type-<?php echo esc_attr( $instance['display'] ); ?> item-per-row-<?php echo esc_attr( $instance['per_row'] ); ?>">
                <div class="row">
		        <?php while ( have_posts() ) : the_post(); ?>
                    <div class="<?php echo esc_attr( $class ); ?> col-sm-6 col-xs-12">	
				        <?php include Realia_Template_Loader::locate( 'agencies/' . $instance['display'] ); ?>
                    </div><!-- /.col-md -->
		        <?php endwhile; ?>
                </div><!-- /.row -->
	        </div>
        <?php else : ?>
	        <div class="alert alert-warning">
		        <?php echo __( 'No agents found.', 'realia' ); ?>
	        </div><!-- /.alert -->
        <?php endif; ?>

        <?php if ( ! empty( $instance['classes'] ) ) : ?>
	        </div>
        <?php endif; ?>

        <?php echo wp_kses( $args['after_widget'], wp_kses_allowed_html( 'post' ) ); ?>

        <?php if ( ! $instance['fullwidth'] ) : ?>
                       </div>
                    </div>
        <?php endif; ?>

        <?php

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
    ?>

    <?php $title = ! empty( $instance['title'] ) ? $instance['title'] : ''; ?>
    <?php $description = ! empty( $instance['description'] ) ? $instance['description'] : ''; ?>
    <?php $classes = ! empty( $instance['classes'] ) ? $instance['classes'] : ''; ?>
    <?php $count = ! empty( $instance['count'] ) ? $instance['count'] : 3; ?>
    <?php $per_row = ! empty( $instance['per_row'] ) ? $instance['per_row'] : 3; ?>
    <?php $display = ! empty( $instance['display'] ) ? $instance['display'] : 'small'; ?>

    <!-- TITLE -->
    <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
            <?php echo __( 'Title', 'realia' ); ?>
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
		    <?php echo __( 'Description', 'realia' ); ?>
	    </label>

	    <textarea class="widefat"
	              rows="4"
	              id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"
	              name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>"><?php echo esc_attr( $description ); ?></textarea>
    </p>

    <!-- CLASSES -->
    <p>
	    <label for="<?php echo esc_attr( $this->get_field_id( 'classes' ) ); ?>">
		    <?php echo __( 'Classes', 'realia' ); ?>
	    </label>

	    <input  class="widefat"
	            id="<?php echo esc_attr( $this->get_field_id( 'classes' ) ); ?>"
	            name="<?php echo esc_attr( $this->get_field_name( 'classes' ) ); ?>"
	            type="text"
	            value="<?php echo esc_attr( $classes ); ?>">
	    <br>
	    <small><?php echo __( 'Additional classes e.g. <i>fullwidth background-gray</i>', 'realia' ); ?></small>
    </p>


    <!-- COUNT -->
    <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>">
            <?php echo __( 'Count', 'realia' ); ?>
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
		    <?php echo __( 'Items per row', 'realia' ); ?>
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
		    <?php echo __( 'Display as', 'realia' ); ?>
	    </label>

	    <select id="<?php echo esc_attr( $this->get_field_id( 'display' ) ); ?>"
	            name="<?php echo esc_attr( $this->get_field_name( 'display' ) ); ?>">
		    <option value="small" <?php echo ( 'small' == $display || empty( $display ) ) ? 'selected="selected"' : ''; ?>><?php echo __( 'Small', 'realia' ); ?></option>
		    <option value="box" <?php echo ( 'box' == $display ) ? 'selected="selected"' : ''; ?>><?php echo __( 'Box', 'realia' ); ?></option>
		    <option value="row" <?php echo ( 'row' == $display ) ? 'selected="selected"' : ''; ?>><?php echo __( 'Row', 'realia' ); ?></option>
	    </select>
    </p>

    <?php
	}
}
