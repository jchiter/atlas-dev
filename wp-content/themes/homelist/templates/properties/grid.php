<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="property-container">
    <div class="property-content-list">
        <div class="property-image-list">
		    <?php if ( has_post_thumbnail() ) : ?>
			    <?php the_post_thumbnail( 'large' ); ?>
		    <?php endif; ?>
			    
			<?php $price = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'price', true ); ?>
			<?php $type = Realia_Query::get_property_type_name(); ?>
            <?php if ( ! empty( $price ) || ! empty( $type ) ) : ?>
            <div class="property-price">
                <?php if ( ! empty( $type ) ) : ?>
                <h4><?php echo esc_attr( $type ); ?></h4>
                <?php endif; ?>
				<?php if ( ! empty( $price ) ) : ?>
                <span><?php echo Realia_Price::get_property_price(); ?></span>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <?php $is_sticky = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'sticky', true ); ?>
		    <?php $is_featured = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'featured', true ); ?>
		    <?php $is_reduced = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'reduced', true ); ?>
            <?php if ( ! empty( $is_featured ) || ! empty( $is_reduced ) ) : ?>
            <div class="property-status">
		        <?php if ( $is_featured && $is_reduced ) : ?>
			        <span class="property-badge"><?php echo esc_html__( 'Featured', 'homelist' ); ?> / <?php echo esc_html__( 'Reduced', 'homelist' ); ?></span>
		        <?php elseif ( $is_featured ) : ?>
			        <span class="property-badge"><?php echo esc_html__( 'Featured', 'homelist' ); ?></span>
		        <?php elseif ( $is_reduced ) : ?>
			        <span class="property-badge"><?php echo esc_html__( 'Reduced', 'homelist' ); ?></span>
		        <?php endif; ?>

		        <?php if ( $is_sticky ) : ?>
			        <span class="property-badge property-badge-sticky"><?php echo esc_html__( 'TOP', 'homelist' ); ?></span>
		        <?php endif; ?>
            </div>
            <?php endif; ?>
            <?php $contract = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'contract', true ); ?>
            <?php if ( ! empty( $contract ) ) : ?>
            <div class="arrow-ribbon">
                <span class="property-badge"><?php echo esc_attr( Realia_Post_Type_Property::get_contract_option( $contract ) ); ?></span>
            </div>
            <?php endif; ?>
        </div>
        <div class="property-text">
            <?php $address = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'address', true ); ?>
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <?php if ( ! empty( $address ) ) : ?><small><i class="flaticon-pin-1"></i> <?php echo wp_kses( $address, wp_kses_allowed_html( 'post' ) ); ?></small><?php endif; ?></h3>
            <?php global $show_content; ?>
            <?php if ( $show_content == 'yes' || get_theme_mod( 'realia_general_show_property_archive_as_grid', null ) != '1' ) : ?>
            <div><?php echo wp_trim_words( get_the_excerpt(), 12, '...' ); ?></div>
            <?php endif; ?>

		    <?php $area = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'home_area', true ); ?>
		    <?php $status = Realia_Query::get_property_status_name(); ?>
		    <?php $rooms = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'rooms', true ); ?>
		    <?php $beds = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'beds', true ); ?>
		    <?php $baths = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'baths', true ); ?>
		    <?php $garages = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'garages', true ); ?>

            <?php if ( ! empty( $area ) || ! empty( $rooms ) || ! empty( $beds ) || ! empty( $baths ) || ! empty( $garages ) ) : ?>
            <div class="property-attributes text-center">
                <?php if ( ! empty( $rooms ) ) : ?>
                <div class="col-xs-3">
                    <h4><i class="flaticon-plans"></i> <?php echo wp_kses( $rooms, wp_kses_allowed_html( 'post' ) ); ?></h4>
                    <p class="text-overflow" title="<?php echo esc_attr__( 'Rooms', 'homelist' ); ?>"><?php echo esc_attr__( 'Rooms', 'homelist' ); ?></p>
                </div>
                <?php endif; ?>
                <?php if ( ! empty( $beds ) ) : ?>
                <div class="col-xs-3">
                    <h4><i class="flaticon-bed"></i> <?php echo wp_kses( $beds, wp_kses_allowed_html( 'post' ) ); ?></h4>
                    <p class="text-overflow" title="<?php echo esc_attr__( 'Bedrooms', 'homelist' ); ?>"><?php echo esc_html__( 'Bedrooms', 'homelist' ); ?></p>
                </div>
                <?php endif; ?>
                <?php if ( ! empty( $baths ) ) : ?>
                <div class="col-xs-3">
                    <h4><i class="flaticon-bathtub"></i> <?php echo wp_kses( $baths, wp_kses_allowed_html( 'post' ) ); ?></h4>
                    <p class="text-overflow" title="<?php echo esc_attr__( 'Bath', 'homelist' ); ?>"><?php echo esc_html__( 'Bath', 'homelist' ); ?></p>
                </div>
                <?php endif; ?>
                <?php if ( ! empty( $garages ) ) : ?>
                <div class="col-xs-3">
                    <h4><i class="flaticon-parking-1"></i> <?php echo wp_kses( $garages, wp_kses_allowed_html( 'post' ) ); ?></h4>
                    <p class="text-overflow" title="<?php echo esc_attr__( 'Garages', 'homelist' ); ?>"><?php echo esc_html__( 'Garages', 'homelist' ); ?></p>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <p><a href="<?php the_permalink(); ?>" class="btn btn-success"><?php echo esc_html__( 'More Detail &raquo;', 'homelist' ); ?></a></p>
        </div>

    </div>
</div>