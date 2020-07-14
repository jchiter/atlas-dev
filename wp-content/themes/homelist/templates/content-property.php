<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php do_action( 'realia_before_property_detail', get_the_ID() ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="property-detail-actions">
		<?php do_action( 'property_actions', get_the_ID() ); ?>
	</div><!-- /.property-detail-actions -->

	<?php $type = Realia_Query::get_property_type_name(); ?>
	<?php $status = Realia_Query::get_property_status_name(); ?>
    <?php $contract = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'contract', true ); ?>

    <div class="property-title">
        <h2><?php the_title(); ?></h2>
        <div class="property-badge">
            <?php if ( ! empty( $contract ) ) : ?><span class="property-contract-badge"><?php echo esc_html__( 'For', 'homelist' ); ?> <?php echo esc_attr( Realia_Post_Type_Property::get_contract_option( $contract ) ); ?></span><?php endif; ?> <?php if ( ! empty( $type ) ) : ?><span class="property-type-badge"><?php echo esc_attr( $type ); ?></span><?php endif; ?><?php if ( ! empty( $type ) ) : ?><span class="property-type-badge"><?php echo esc_attr( $status ); ?></span><?php endif; ?>
        </div>
    </div>

	<?php $price = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'price', true ); ?>

    <?php if ( ! empty( $price ) ) : ?>
    <div class="property-pricing">
        <div><?php echo Realia_Price::get_property_price(); ?></div>
    </div>
    <?php endif; ?>

	<?php $area = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'home_area', true ); ?>
	<?php $rooms = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'rooms', true ); ?>
	<?php $beds = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'beds', true ); ?>
	<?php $baths = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'baths', true ); ?>
	<?php $garages = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'garages', true ); ?>

    <?php if ( ! empty( $area ) || ! empty( $rooms ) || ! empty( $beds ) || ! empty( $baths ) || ! empty( $garages ) ) : ?>
    <ul class="property-main-features">
        <?php if ( ! empty( $area ) ) : ?>
        <li class="main-detail-_area"><i class="flaticon-select-1"></i> <span><?php echo wp_kses( $area, wp_kses_allowed_html( 'post' ) ); ?></span> <div class="feature-names"><?php echo get_theme_mod( 'realia_measurement_area_unit', 'square ft.' ); ?> </div></li>
        <?php endif; ?>

        <?php if ( ! empty( $rooms ) ) : ?>
        <li class="main-detail-_rooms"><i class="flaticon-plans"></i> <span><?php echo wp_kses( $rooms, wp_kses_allowed_html( 'post' ) ); ?></span> <div class="feature-names"><?php echo esc_html__( 'Rooms', 'homelist' ); ?> </div></li>
        <?php endif; ?>

        <?php if ( ! empty( $beds ) ) : ?>
        <li class="main-detail-_bedrooms"><i class="flaticon-bed"></i> <span><?php echo wp_kses( $beds, wp_kses_allowed_html( 'post' ) ); ?></span> <div class="feature-names"><?php echo esc_html__( 'Bedrooms', 'homelist' ); ?> </div></li>
        <?php endif; ?>

        <?php if ( ! empty( $baths ) ) : ?>
        <li class="main-detail-_bathrooms"><i class="flaticon-bathtub-1"></i> <span><?php echo wp_kses( $baths, wp_kses_allowed_html( 'post' ) ); ?></span> <div class="feature-names"><?php echo esc_html__( 'Bathrooms', 'homelist' ); ?> </div></li>
        <?php endif; ?>

        <?php if ( ! empty( $garages ) ) : ?>
        <li class="main-detail-_garages"><i class="flaticon-garage"></i> <span><?php echo wp_kses( $garages, wp_kses_allowed_html( 'post' ) ); ?></span> <div class="feature-names"><?php echo esc_html__( 'Garages', 'homelist' ); ?> </div></li>
        <?php endif; ?>
    </ul>
    <?php endif; ?>

	<?php $is_child_property = Realia_Post_Types::is_child_property(); ?>
	<?php if ( $is_child_property ) : ?>
		<?php $parent_listing = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'parent_property', true ); ?>
		<a class="link-to-parent-property" href="<?php echo get_permalink( $parent_listing ); ?>"><?php echo esc_html__( 'Back to', 'homelist' ); ?> <?php echo get_the_title( $parent_listing ); ?></a>
	<?php endif; ?>

	<?php Realia_Post_Types::render_property_detail_sections(); ?>
</article><!-- #post-## -->

<?php do_action( 'realia_after_property_detail', get_the_ID() ); ?>