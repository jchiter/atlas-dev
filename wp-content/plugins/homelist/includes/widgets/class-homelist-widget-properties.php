<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Homelist_Widget_Properties extends WP_Widget {
	/**
	 * Initialize widget
	 *
	 * @access public
	 * @return void
	 */
	function __construct() {
		parent::__construct(
			'homelist_properties_widget',
			__( 'Homelist Properties', 'homelist' ),
			array(
				'description' => __( 'Displays properties in multiple ways.', 'homelist' ),
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
		$query = array(
			'post_type'         => 'property',
			'posts_per_page'    => ! empty( $instance['count'] ) ? $instance['count'] : 3,
		);

		if ( ! empty( $instance['attribute'] ) ) {
			if ( 'featured' == $instance['attribute'] ) {
				$query['meta_query'][] = array(
					'key'       => HOMELIST_PROPERTY_PREFIX . 'featured',
					'value'     => 'on',
					'compare'   => '==',
				);
			} elseif ( 'reduced' == $instance['attribute'] ) {
				$query['meta_query'][] = array(
					'key'       => HOMELIST_PROPERTY_PREFIX . 'reduced',
					'value'     => 'on',
					'compare'   => '==',
				);
			} elseif ( 'sticky' == $instance['attribute'] ) {
				$query['meta_query'][] = array(
					'key'       => HOMELIST_PROPERTY_PREFIX . 'sticky',
					'value'     => 'on',
					'compare'   => '==',
				);
			}
		}

		// order queryset
		$orderby = empty( $instance['orderby'] ) ? 'date' : $instance['orderby'];
		$query['orderby'] = $orderby;

		// exclude subproperties
		$query['meta_query'][] = array(
			'key'       => HOMELIST_PROPERTY_PREFIX . 'parent_property',
			'compare'   => 'NOT EXISTS',
		);

		query_posts( $query );

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
    $attribute = ! empty( $instance['attribute'] ) ? $instance['attribute'] : ''; 
    $display = ! empty( $instance['display'] ) ? $instance['display'] : ''; 
    $orderby = ! empty( $instance['orderby'] ) ? $instance['orderby'] : ''; 

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

    <!-- ATTRIBUTE -->
    <p>
        <strong><?php echo __( 'Choose attribute', 'homelist' ); ?></strong><br>
        <ul>
            <li>
                <label>
                    <input  type="radio"
                            class="radio"
                            <?php echo ( empty( $attribute ) || 'on' == $attribute ) ? 'checked="checked"' : ''; ?>
                            id="<?php echo esc_attr( $this->get_field_id( 'attribute' ) ); ?>"
                            name="<?php echo esc_attr( $this->get_field_name( 'attribute' ) ); ?>">
                    <?php echo __( 'It doesn\'t matter', 'homelist' ); ?>
                </label>
            </li>

            <li>
                <label>
                    <input  type="radio"
                            class="radio"
                            value="featured"
                            <?php echo ( 'featured' == $attribute ) ? 'checked="checked"' : ''; ?>
                            id="<?php echo esc_attr( $this->get_field_id( 'attribute' ) ); ?>"
                            name="<?php echo esc_attr( $this->get_field_name( 'attribute' ) ); ?>">
                    <?php echo __( 'Featured only', 'homelist' ); ?>
                </label>
            </li>

            <li>
                <label>
                    <input  type="radio"
                            class="radio"
                            value="reduced"
                            <?php echo ( 'reduced' == $attribute ) ? 'checked="checked"' : ''; ?>
                            id="<?php echo esc_attr( $this->get_field_id( 'attribute' ) ); ?>"
                            name="<?php echo esc_attr( $this->get_field_name( 'attribute' ) ); ?>">

                    <?php echo __( 'Reduced only', 'homelist' ); ?>
                </label>
            </li>

            <li>
                <label>
                    <input  type="radio"
                            class="radio"
                            value="sticky"
                        <?php echo ( 'sticky' == $attribute ) ? 'checked="checked"' : ''; ?>
                            id="<?php echo esc_attr( $this->get_field_id( 'attribute' ) ); ?>"
                            name="<?php echo esc_attr( $this->get_field_name( 'attribute' ) ); ?>">

                    <?php echo __( 'TOP only', 'homelist' ); ?>
                </label>
            </li>
        </ul>
    </p>

    <!-- DISPLAY -->
    <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'display' ) ); ?>">
            <?php echo __( 'Display as', 'homelist' ); ?>
        </label>

        <select id="<?php echo esc_attr( $this->get_field_id( 'display' ) ); ?>"
                name="<?php echo esc_attr( $this->get_field_name( 'display' ) ); ?>">
            <option value="small" <?php echo ( 'small' == $display || empty( $display ) ) ? 'selected="selected"' : ''; ?>><?php echo __( 'Small', 'homelist' ); ?></option>
            <option value="box" <?php echo ( 'box' == $display ) ? 'selected="selected"' : ''; ?>><?php echo __( 'Box', 'homelist' ); ?></option>
            <option value="row" <?php echo ( 'row' == $display ) ? 'selected="selected"' : ''; ?>><?php echo __( 'Row', 'homelist' ); ?></option>
        </select>
    </p>

    <!-- ORDER BY -->
    <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>">
            <?php echo __( 'Order by', 'homelist' ); ?>
        </label>

        <select id="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>"
                name="<?php echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>">
            <option value="date" <?php echo ( 'date' == $orderby || empty( $orderby ) ) ? 'selected="selected"' : ''; ?>><?php echo __( 'Date', 'homelist' ); ?></option>
            <option value="rand" <?php echo ( 'rand' == $orderby ) ? 'selected="selected"' : ''; ?>><?php echo __( 'Random', 'homelist' ); ?></option>
        </select>
    </p>

    <?php

	}
}
