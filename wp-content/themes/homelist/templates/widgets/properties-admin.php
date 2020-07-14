<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php $title = ! empty( $instance['title'] ) ? $instance['title'] : ''; ?>
<?php $description = ! empty( $instance['description'] ) ? $instance['description'] : ''; ?>
<?php $classes = ! empty( $instance['classes'] ) ? $instance['classes'] : ''; ?>
<?php $count = ! empty( $instance['count'] ) ? $instance['count'] : 3; ?>
<?php $per_row = ! empty( $instance['per_row'] ) ? $instance['per_row'] : 1; ?>
<?php $show_content = ! empty( $instance['show_content'] ) ? $instance['show_content'] : 'no'; ?>
<?php $show_price = ! empty( $instance['show_price'] ) ? $instance['show_price'] : 'no'; ?>
<?php $attribute = ! empty( $instance['attribute'] ) ? $instance['attribute'] : ''; ?>
<?php $display = ! empty( $instance['display'] ) ? $instance['display'] : ''; ?>
<?php $orderby = ! empty( $instance['orderby'] ) ? $instance['orderby'] : ''; ?>
<?php $fullwidth = ! empty( $instance['fullwidth'] ) ? $instance['fullwidth'] : ''; ?>

<!-- TITLE -->
<p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
        <?php echo esc_html__( 'Title', 'homelist' ); ?>
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
		<?php echo esc_html__( 'Description', 'homelist' ); ?>
	</label>

	<textarea class="widefat"
	          rows="4"
	          id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"
	          name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>"><?php echo esc_attr( $description ); ?></textarea>
</p>

<!-- CLASSES -->
<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'classes' ) ); ?>">
		<?php echo esc_html__( 'Classes', 'homelist' ); ?>
	</label>

	<input  class="widefat"
	        id="<?php echo esc_attr( $this->get_field_id( 'classes' ) ); ?>"
	        name="<?php echo esc_attr( $this->get_field_name( 'classes' ) ); ?>"
	        type="text"
	        value="<?php echo esc_attr( $classes ); ?>">
	<br>
	<small><?php echo esc_html__( 'Additional classes e.g. <i>fullwidth background-gray</i>', 'homelist' ); ?></small>
</p>

<!-- COUNT -->
<p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>">
        <?php echo esc_html__( 'Count', 'homelist' ); ?>
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
        <?php echo esc_html__( 'Items per row', 'homelist' ); ?>
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

<!-- SHOW CONTENT -->
<p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'show_content' ) ); ?>">
        <?php echo esc_html__( 'Show Content', 'homelist' ); ?>
    </label>

    <select id="<?php echo esc_attr( $this->get_field_id( 'show_content' ) ); ?>"
            name="<?php echo esc_attr( $this->get_field_name( 'show_content' ) ); ?>">
        <option value="no" <?php echo ( 'no' == $show_content ) ? 'selected="selected"' : ''; ?>><?php echo esc_html__( 'No', 'homelist' ); ?></option>
        <option value="yes" <?php echo ( 'yes' == $show_content ) ? 'selected="selected"' : ''; ?>><?php echo esc_html__( 'Yes', 'homelist' ); ?></option>
    </select>
</p>

<!-- SHOW PRICE -->
<p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'show_price' ) ); ?>">
        <?php echo esc_html__( 'Show Price', 'homelist' ); ?>
    </label>

    <select id="<?php echo esc_attr( $this->get_field_id( 'show_price' ) ); ?>"
            name="<?php echo esc_attr( $this->get_field_name( 'show_price' ) ); ?>">
        <option value="no" <?php echo ( 'no' == $show_price ) ? 'selected="selected"' : ''; ?>><?php echo esc_html__( 'No', 'homelist' ); ?></option>
        <option value="yes" <?php echo ( 'yes' == $show_price ) ? 'selected="selected"' : ''; ?>><?php echo esc_html__( 'Yes', 'homelist' ); ?></option>
    </select>
</p>

<!-- ATTRIBUTE -->
<p>
    <strong><?php echo esc_html__( 'Choose attribute', 'homelist' ); ?></strong><br>
    <ul>
        <li>
            <label>
                <input  type="radio"
                        class="radio"
                        <?php echo ( empty( $attribute ) || 'on' == $attribute ) ? 'checked="checked"' : ''; ?>
                        id="<?php echo esc_attr( $this->get_field_id( 'attribute' ) ); ?>"
                        name="<?php echo esc_attr( $this->get_field_name( 'attribute' ) ); ?>">
                <?php echo esc_html__( 'It doesn\'t matter', 'homelist' ); ?>
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
                <?php echo esc_html__( 'Featured only', 'homelist' ); ?>
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

                <?php echo esc_html__( 'Reduced only', 'homelist' ); ?>
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

                <?php echo esc_html__( 'TOP only', 'homelist' ); ?>
            </label>
        </li>
    </ul>
</p>

<!-- DISPLAY -->
<p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'display' ) ); ?>">
        <?php echo esc_html__( 'Display as', 'homelist' ); ?>
    </label>

    <select id="<?php echo esc_attr( $this->get_field_id( 'display' ) ); ?>"
            name="<?php echo esc_attr( $this->get_field_name( 'display' ) ); ?>">
        <option value="small" <?php echo ( 'small' == $display || empty( $display ) ) ? 'selected="selected"' : ''; ?>><?php echo esc_html__( 'Small', 'homelist' ); ?></option>
        <option value="box" <?php echo ( 'box' == $display ) ? 'selected="selected"' : ''; ?>><?php echo esc_html__( 'Box', 'homelist' ); ?></option>
        <option value="row" <?php echo ( 'row' == $display ) ? 'selected="selected"' : ''; ?>><?php echo esc_html__( 'Row', 'homelist' ); ?></option>
        <option value="grid" <?php echo ( 'grid' == $display ) ? 'selected="selected"' : ''; ?>><?php echo esc_html__( 'Grid', 'homelist' ); ?></option>
    </select>
</p>

<!-- ORDER BY -->
<p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>">
        <?php echo esc_html__( 'Order by', 'homelist' ); ?>
    </label>

    <select id="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>"
            name="<?php echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>">
        <option value="date" <?php echo ( 'date' == $orderby || empty( $orderby ) ) ? 'selected="selected"' : ''; ?>><?php echo esc_html__( 'Date', 'homelist' ); ?></option>
        <option value="rand" <?php echo ( 'rand' == $orderby ) ? 'selected="selected"' : ''; ?>><?php echo esc_html__( 'Random', 'homelist' ); ?></option>
    </select>
</p>


<!-- FULLWIDTH -->
<p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'fullwidth' ) ); ?>">
    <input 	type="checkbox"
		    <?php if ( ! empty( $fullwidth ) ) : ?>checked="checked"<?php endif; ?>
		    name="<?php echo esc_attr( $this->get_field_name( 'fullwidth' ) ); ?>"
		    id="<?php echo esc_attr( $this->get_field_id( 'fullwidth' ) ); ?>">

		    <?php echo esc_html__( 'Fullwidth', 'homelist' ); ?>
    </label>
</p>

