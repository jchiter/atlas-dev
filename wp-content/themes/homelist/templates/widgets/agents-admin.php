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
<?php $display = ! empty( $instance['display'] ) ? $instance['display'] : 'small'; ?>
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

