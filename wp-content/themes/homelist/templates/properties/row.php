<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $wp_query;
?>
<div class="post-container <?php if ( ( $wp_query->current_post +1 ) == ( $wp_query->post_count ) ) { echo 'post-noborder'; } ?>">
    <?php
    if ( has_post_thumbnail() ) {
        $feat_image_url = wp_get_attachment_url( get_post_thumbnail_id() );
    ?>
        <?php $contract = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'contract', true ); ?>
        <div class="post-img" style="background: url(<?php echo esc_url( $feat_image_url ); ?>);"><h3><?php echo esc_attr( Realia_Post_Type_Property::get_contract_option( $contract ) ); ?></h3></div>
    <?php
    }
    ?>
    <div class="post-content">
        <?php $location = Realia_Query::get_property_location_name(); ?>
        <div class="heading-title">
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <?php if ( ! empty( $location ) ) : ?><small><?php echo wp_kses( $location, wp_kses_allowed_html( 'post' ) ); ?></small><?php endif; ?></h2>
        </div>

		<?php $area = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'home_area', true ); ?>
		<?php $rooms = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'rooms', true ); ?>
		<?php $beds = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'beds', true ); ?>
		<?php $baths = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'baths', true ); ?>
		<?php $garages = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'garages', true ); ?>

        <?php if ( ! empty( $area ) || ! empty( $status ) ) : ?>
        <div class="post-meta">
            <span><i class="fa fa-home"></i> <?php echo esc_attr( $area ); ?> <?php echo get_theme_mod( 'realia_measurement_area_unit', 'sqft' ); ?> &nbsp; </span>
            <span><i class="fa fa-hdd-o"></i> <?php echo esc_attr( $beds ); ?>  <?php echo esc_html__( 'Bed', 'homelist' ); ?> &nbsp; </span>
            <span><i class="fa fa-male"></i> <?php echo esc_attr( $baths ); ?>  <?php echo esc_html__( 'Bath', 'homelist' ); ?> &nbsp; </span>
            <span><i class="fa fa-building-o"></i> <?php echo esc_attr( $rooms ); ?> <?php echo esc_html__( 'Rooms', 'homelist' ); ?> &nbsp; </span>
            <span><i class="fa fa-car"></i> <?php echo esc_attr( $garages ); ?> <?php echo esc_html__( 'Garages', 'homelist' ); ?> &nbsp; </span>
        </div>
        <?php endif; ?>
    </div>
</div>
<!-- break -->
