<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php
$latitude = ! empty( $instance['latitude'] ) ? $instance['latitude'] : 37.439826;
$longitude = ! empty( $instance['longitude'] ) ? $instance['longitude'] : -122.132088;
$zoom = ! empty( $instance['zoom'] ) ? $instance['zoom'] : 11;
$grid_size = ! empty( $instance['grid_size'] ) ? $instance['grid_size'] : 60;
$style = ! empty( $instance['style'] ) ? $instance['style'] : '';
$height = ! empty( $instance['height'] ) ? $instance['height'] : '400px';
$classes = ! empty( $instance['classes'] ) ? $instance['classes'] : '';
$geolocation = ! empty( $instance['geolocation'] ) ? $instance['geolocation'] : '';
?>


<!-- LATITUDE -->
<p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'latitude' ) ); ?>">
        <?php echo esc_html__( 'Latitude', 'homelist' ); ?>
    </label>

    <input  class="widefat"
            id="<?php echo esc_attr( $this->get_field_id( 'latitude' ) ); ?>"
            name="<?php echo esc_attr( $this->get_field_name( 'latitude' ) ); ?>"
            type="text"
            value="<?php echo esc_attr( $latitude ); ?>">
</p>

<!-- LONGITUDE -->
<p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'longitude' ) ); ?>">
        <?php echo esc_html__( 'Longitude', 'homelist' ); ?>
    </label>

    <input  class="widefat"
            id="<?php echo esc_attr( $this->get_field_id( 'longitude' ) ); ?>"
            name="<?php echo esc_attr( $this->get_field_name( 'longitude' ) ); ?>"
            type="text"
            value="<?php echo esc_attr( $longitude ); ?>">
</p>


<!-- ZOOM -->
<p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'zoom' ) ); ?>">
        <?php echo esc_html__( 'Zoom', 'homelist' ); ?>
    </label>

    <input  class="widefat"
            id="<?php echo esc_attr( $this->get_field_id( 'zoom' ) ); ?>"
            name="<?php echo esc_attr( $this->get_field_name( 'zoom' ) ); ?>"
            type="text"
            value="<?php echo esc_attr( $zoom ); ?>">
</p>

<!-- GRID SIZE -->
<p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'grid_size' ) ); ?>">
        <?php echo esc_html__( 'Grid size', 'homelist' ); ?>
    </label>

    <input  class="widefat"
            id="<?php echo esc_attr( $this->get_field_id( 'grid_size' ) ); ?>"
            name="<?php echo esc_attr( $this->get_field_name( 'grid_size' ) ); ?>"
            type="text"
            value="<?php echo esc_attr( $grid_size ); ?>">
</p>

<!-- STYLE-->
<p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'style' ) ); ?>">
        <?php echo esc_html__( 'Style', 'homelist' ); ?>
    </label>

    <select id="<?php echo esc_attr( $this->get_field_id( 'style' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'style' ) ); ?>">
        <option value=""><?php echo esc_html__( 'Default', 'homelist' ); ?></option>
        <?php $maps = Realia_Google_Maps_Styles::styles(); ?>
        <?php if ( is_array( $maps ) ) : ?>
            <?php foreach ( $maps as $map ) :   ?>
                <option <?php if ( $style == $map['slug'] ) : ?>selected="selected"<?php endif; ?>value="<?php echo esc_attr( $map['slug'] ); ?>"><?php echo esc_html( $map['title'] ); ?></option>
            <?php endforeach; ?>
        <?php endif; ?>
    </select>
</p>

<!-- HEIGHT -->
<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'height' ) ); ?>">
		<?php echo esc_html__( 'Height', 'homelist' ); ?>
	</label>

	<input  class="widefat"
	        id="<?php echo esc_attr( $this->get_field_id( 'height' ) ); ?>"
	        name="<?php echo esc_attr( $this->get_field_name( 'height' ) ); ?>"
	        type="text"
	        value="<?php echo esc_attr( $height ); ?>">
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
	<small><?php echo esc_html__( 'Additional classes appended to body class and separated by , e.g. <i>transparent-header, property-map-append-top</i>', 'homelist' ); ?></small>
</p>

<!-- GEOLOCATION -->
<label for="<?php echo esc_attr( $this->get_field_id( 'geolocation' ) ); ?>">
<input 	type="checkbox"
		<?php if ( ! empty( $geolocation ) ) : ?>checked="checked"<?php endif; ?>
		name="<?php echo esc_attr( $this->get_field_name( 'geolocation' ) ); ?>"
		id="<?php echo esc_attr( $this->get_field_id( 'geolocation' ) ); ?>">

		<?php echo esc_html__( 'Geolocation', 'homelist' ); ?>
</label>
