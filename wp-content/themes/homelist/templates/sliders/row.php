<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $wp_query;
?>

<?php $image_id = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'slider_image_id', true ); ?>
<?php $image_thumbnail_src = wp_get_attachment_image_src( $image_id, $instance['size']  ); ?>
<?php $image = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'slider_image', true ); ?>
<?php $address = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'address', true ); ?>

<div class="item <?php if (0 == $wp_query->current_post) { echo 'active'; } ?>" style="background-image: url(<?php echo esc_attr( $image ); ?>);">
    <div class="carousel-caption hidden-xs">
        <h3><?php the_title(); ?></h3>
        <?php if ( ! empty( $address ) ) : ?>
        <p><i class="fa fa-map-marker"></i> <?php echo wp_trim_words( $address, 20, '...' ); ?></p>
        <?php endif; ?>

		<?php $price = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'price', true ); ?>
		<?php $area = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'home_area', true ); ?>
		<?php $status = Realia_Query::get_property_status_name(); ?>
		<?php $type = Realia_Query::get_property_type_name(); ?>
		<?php $beds = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'beds', true ); ?>
		<?php $baths = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'baths', true ); ?>
		<?php $garages = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'garages', true ); ?>
        <?php if ( ! empty( $type ) || ! empty( $area ) || ! empty( $beds ) || ! empty( $baths ) || ! empty( $garages ) ) : ?>
        <ul class="list-inline list-features">
            <?php if ( ! empty( $type ) ) : ?>
            <li><?php echo esc_attr( $type ); ?></li>
            <?php endif; ?>

            <?php if ( ! empty( $area ) ) : ?>
            <li><i class="fa fa-home"></i> <?php echo esc_attr( $area ); ?> <?php echo get_theme_mod( 'realia_measurement_area_unit', 'sqft' ); ?></li>
            <?php endif; ?>

            <?php if ( ! empty( $beds ) ) : ?>
            <li><i class="fa fa-hdd-o"></i> <?php echo esc_attr( $beds ); ?> <?php echo esc_html__( 'Bed', 'homelist' ); ?></li>
            <?php endif; ?>

            <?php if ( ! empty( $baths ) ) : ?>
            <li><i class="fa fa-male"></i> <?php echo esc_attr( $baths ); ?> <?php echo esc_html__( 'Bath', 'homelist' ); ?></li>
            <?php endif; ?>

            <?php if ( ! empty( $garages ) ) : ?>
            <li><i class="fa fa-car"></i> <?php echo esc_attr( $garages ); ?> <?php echo esc_html__( 'Garages', 'homelist' ); ?></li>
            <?php endif; ?>
        </ul>
        <?php endif; ?>
        <div class="carousel-btn">
            <a href="<?php the_permalink(); ?>" class="btn btn-success btn-lg"><?php echo esc_html__( 'View Detail', 'homelist' ); ?></a>
        </div>
    </div>
</div>