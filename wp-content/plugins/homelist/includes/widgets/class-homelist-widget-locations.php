<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Homelist_Widget_Locations extends WP_Widget {
	/**
	 * Initialize widget
	 *
	 * @access public
	 * @return void
	 */
	function __construct() {
		parent::__construct(
			'homelist_locations_widget',
			__( 'Homelist Locations', 'homelist' ),
			array(
				'description' => __( 'Displays locations in multiple ways.', 'homelist' ),
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
        
        $instance['per_row'] = ! empty( $instance['per_row'] ) ? $instance['per_row'] : 3;
        $instance['count'] = ! empty( $instance['count'] ) ? $instance['count'] : 3;
        $instance['display'] = ! empty( $instance['display'] ) ? $instance['display'] : '';
        $instance['fullwidth'] = ( ! empty( $instance['fullwidth'] ) && $instance['fullwidth'] == 'on' ) ? true : false;

        echo wp_kses( $args['before_widget'], wp_kses_allowed_html( 'post' ) );

        if ( ! empty( $instance['classes'] ) ) : 
        ?>
	        <div class="<?php echo esc_attr($instance['classes']); ?>">
        <?php 
        endif;
        ?>

		<?php if ( 'box' == $instance['display'] ) : ?>
			<div id="property-location">
		<?php endif; ?>

        <?php if ( $instance['fullwidth'] ) : ?>
        <!-- begin:content -->
            <div class="container">
                <div class="row">
        <?php endif; ?>
                <div class="browse-location">
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

	    switch($instance['per_row']) {
		    case '1': $class='col-md-12'; break;
		    case '2': $class='col-md-6'; break;
		    case '3': $class='col-md-4'; break;
		    case '4': $class='col-md-3'; break;
	    }	

		if ( 'row' == $instance['display'] ) : ?>
            <ul>
		<?php endif;

        $terms = get_terms( array( 'taxonomy' => 'locations', 'parent' => 0, 'hide_empty' => 0, 'number' => $instance['count'] ) );
        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
            foreach ( $terms as $term ) {
                $child_terms = null;
                $child_terms = get_terms( 'locations', array('child_of' => $term->term_id, 'hide_empty' => 0, 'number' => 1 ) );
                
                if ( ! empty( $child_terms ) && ! is_wp_error( $child_terms ) ){
                    foreach ( $child_terms as $child_term ) {
                        $term_meta = get_option( "taxonomy_$child_term->slug" );
                        $term_thumbnail = ( ! empty( $term_meta['custom_term_meta'] ) ) ? $term_meta['custom_term_meta'] : '';
                       
		                if ( 'box' == $instance['display'] ) : ?>
                            <div class="<?php echo esc_attr( $class ); ?> col-sm-6 col-xs-12">
                                <!-- TOP DESTINATION : begin -->
                                <div class="top-location" style="background-image: url(<?php echo esc_url($term_thumbnail); ?>);">
                                    <img class="location-img" src="<?php echo esc_url($term_thumbnail); ?>" alt="<?php echo esc_attr($term->name) ?>">
                                    <div class="top-location-inner">
                                        <h3><a href="<?php echo  esc_url( get_term_link( $child_term ) ) ?>"><?php echo esc_html($child_term->name) ?></a></h3>
                                        <?php $listings = ( $child_term->count ) ? $child_term->count : __( 'No', 'homelist' ); ?>
                                        <span><?php echo esc_html($listings) ?> <?php echo __( 'listings', 'homelist' ); ?></span>
                                        <a class="country" href="<?php echo  esc_url( get_term_link( $term ) ) ?>"><i class="fa fa-map-marker"></i> <?php echo esc_html($term->name) ?></a>
                                    </div>
                                </div>
                                <!-- TOP DESTINATION : end -->
                            </div>
                        <?php else : ?>
                            <li><a href="<?php echo  esc_url( get_term_link( $child_term ) ) ?>"><?php echo esc_html($child_term->name) ?> / <?php echo esc_html($term->name) ?></a></li>
                        <?php endif; ?>
		                <?php
                    }
                }
            }
        }
        ?>
		<?php if ( 'row' == $instance['display'] ) : ?>
            </ul>
		<?php endif; ?>

        </div>

        <?php if ( ! empty( $instance['classes'] ) ) : ?>
	        </div>
        <?php endif; ?>

        <?php if ( $instance['fullwidth'] ) : ?>
                </div>
            </div>
        <?php endif; ?>

		<?php if ( 'box' == $instance['display'] ) : ?>
			</div>
		<?php endif; ?>
        <!-- end:content -->

        <?php echo wp_kses( $args['after_widget'], wp_kses_allowed_html( 'post' ) ); ?>
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

    $title = ! empty( $instance['title'] ) ? $instance['title'] : '';
    $description = ! empty( $instance['description'] ) ? $instance['description'] : '';
    $classes = ! empty( $instance['classes'] ) ? $instance['classes'] : '';
    $count = ! empty( $instance['count'] ) ? $instance['count'] : 3;
    $per_row = ! empty( $instance['per_row'] ) ? $instance['per_row'] : 1;
    $display = ! empty( $instance['display'] ) ? $instance['display'] : '';
    $fullwidth = ! empty( $instance['fullwidth'] ) ? $instance['fullwidth'] : '';

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
	    </select>
    </p>

    <!-- DISPLAY -->
    <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'display' ) ); ?>">
            <?php echo __( 'Display as', 'homelist' ); ?>
        </label>

        <select id="<?php echo esc_attr( $this->get_field_id( 'display' ) ); ?>"
                name="<?php echo esc_attr( $this->get_field_name( 'display' ) ); ?>">
            <option value="box" <?php echo ( 'box' == $display || empty( $display ) ) ? 'selected="selected"' : ''; ?>><?php echo __( 'Box', 'homelist' ); ?></option>
            <option value="row" <?php echo ( 'row' == $display ) ? 'selected="selected"' : ''; ?>><?php echo __( 'Row', 'homelist' ); ?></option>
        </select>
    </p>


    <!-- FULLWIDTH -->
    <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'fullwidth' ) ); ?>">
        <input 	type="checkbox"
		        <?php if ( ! empty( $fullwidth ) ) : ?>checked="checked"<?php endif; ?>
		        name="<?php echo esc_attr( $this->get_field_name( 'fullwidth' ) ); ?>"
		        id="<?php echo esc_attr( $this->get_field_id( 'fullwidth' ) ); ?>">

		        <?php echo __( 'Fullwidth', 'homelist' ); ?>
        </label>
    </p>
    <?php
	}
}
