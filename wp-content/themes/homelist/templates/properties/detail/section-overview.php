<div class="property-content">
    <?php if ( ! empty( $section_title ) ): ?><h2><?php echo esc_html__( 'Property', 'homelist' ); ?> <?php echo esc_attr( $section_title ); ?></h2><?php endif; ?>

    <div class="property-overview">
        <ul>
            <?php $price = Realia_Price::get_property_price(); ?>
            <?php if ( ! empty( $price ) ) : ?>
                <li><span><?php echo esc_html__( 'Price', 'homelist' )?></span><strong class="emphasize"><?php echo wp_kses( $price, wp_kses_allowed_html( 'post' ) ); ?></strong></li>
            <?php endif; ?>

            <?php $id = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'id', true ); ?>
            <?php if ( ! empty( $id ) ) : ?>
                <li><span><?php echo esc_html__( 'Reference', 'homelist' ); ?></span><strong class="emphasize"><?php echo esc_attr( $id ); ?></strong></li>
            <?php endif; ?>

            <?php $contact_name = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'contact_name', true ); ?>
            <?php if ( ! empty( $contact_name ) ) : ?>
                <li><span><?php echo esc_html__( 'Contact name', 'homelist' ); ?></span><strong><?php echo esc_attr( $contact_name ); ?></strong></li>
            <?php endif; ?>

            <?php $contact_phone = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'contact_phone', true ); ?>
            <?php if ( ! empty( $contact_phone ) ) : ?>
                <li><span><?php echo esc_html__( 'Contact phone', 'homelist' ); ?></span><strong><?php echo esc_attr( $contact_phone ); ?></strong></li>
            <?php endif; ?>

            <?php $year_built = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'year_built', true ); ?>
            <?php if ( ! empty( $year_built ) ) : ?>
                <li><span><?php echo esc_html__( 'Year built', 'homelist' ); ?></span><strong><?php echo esc_attr( $year_built ); ?></strong></li>
            <?php endif; ?>

            <?php $type = Realia_Query::get_property_type_name(); ?>
            <?php if ( ! empty( $type ) ) : ?>
                <li><span><?php echo esc_html__( 'Type', 'homelist' ); ?></span><strong><?php echo esc_attr( $type ); ?></strong></li>
            <?php endif; ?>

            <?php $sold = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'sold', true ); ?>
            <li><span><?php echo esc_html__( 'Sold', 'homelist' ); ?></span><strong>
                <?php if ( ! empty( $sold ) ) : ?>
                    <?php echo esc_html__( 'Yes', 'homelist' ); ?>
                <?php else : ?>
                    <?php echo esc_html__( 'No', 'homelist' ); ?>
                <?php endif; ?>
            </strong></li>

            <?php $contract = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'contract', true ); ?>

            <?php if ( ! empty( $contract ) ) : ?>
                <li><span><?php echo esc_html__( 'Contract', 'homelist' ); ?></span>
                <strong>
                    <?php echo esc_attr( Realia_Post_Type_Property::get_contract_option( $contract ) ); ?>
                </strong></li>
            <?php endif; ?>

            <?php $status = Realia_Query::get_property_status_name(); ?>
            <?php if ( ! empty( $status ) ) : ?>
                <li><span><?php echo esc_html__( 'Status', 'homelist' ); ?></span><strong><?php echo esc_attr( $status ); ?></strong></li>
            <?php endif; ?>

            <?php $location = Realia_Query::get_property_location_name(); ?>
            <?php if ( ! empty( $location ) ) : ?>
                <li><span><?php echo esc_html__( 'Location', 'homelist' ); ?></span><strong><?php echo wp_kses( $location, wp_kses_allowed_html( 'post' ) ); ?></strong></li>
            <?php endif; ?>

            <?php $home_area = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'home_area', true ); ?>
            <?php if ( ! empty( $home_area ) ) : ?>
                <?php $home_area = Realia_Utilities::format_number( $home_area ); ?>
                <li><span><?php echo esc_html__( 'Home area', 'homelist' ); ?></span><strong><?php echo esc_attr( $home_area ); ?>
                    <?php echo get_theme_mod( 'realia_measurement_area_unit', 'sqft' ); ?></strong></li>
            <?php endif; ?>

            <?php $lot_dimensions = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'lot_dimensions', true ); ?>
            <?php if ( ! empty( $lot_dimensions ) ) : ?>
                <li><span><?php echo esc_html__( 'Lot dimensions', 'homelist' ); ?></span><strong><?php echo esc_attr( $lot_dimensions ); ?>
                    <?php echo get_theme_mod( 'realia_measurement_distance_unit', 'ft' ); ?></strong></li>
            <?php endif; ?>

            <?php $lot_area = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'lot_area', true ); ?>
            <?php if ( ! empty( $lot_area ) ) : ?>
                <?php $lot_area = Realia_Utilities::format_number( $lot_area ); ?>
                <li><span><?php echo esc_html__( 'Lot area', 'homelist' ); ?></span><strong><?php echo esc_attr( $lot_area ); ?>
                    <?php echo get_theme_mod( 'realia_measurement_area_unit', 'sqft' ); ?></strong></li>
            <?php endif; ?>

            <?php $material = Realia_Query::get_property_material_name(); ?>
            <?php if ( ! empty( $material ) ) : ?>
                <li><span><?php echo esc_html__( 'Material', 'homelist' ); ?></span><strong><?php echo wp_kses( $material, wp_kses_allowed_html( 'post' ) ); ?></strong></li>
            <?php endif; ?>

            <?php $rooms = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'rooms', true ); ?>
            <?php if ( ! empty( $rooms ) ) : ?>
                <li><span><?php echo esc_html__( 'Rooms', 'homelist' ); ?></span><strong><?php echo esc_attr( $rooms ); ?></strong></li>
            <?php endif; ?>

            <?php $beds = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'beds', true ); ?>
            <?php if ( ! empty( $beds ) ) : ?>
                <li><span><?php echo esc_html__( 'Beds', 'homelist' ); ?></span><strong><?php echo esc_attr( $beds ); ?></strong></li>
            <?php endif; ?>

            <?php $baths = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'baths', true ); ?>
            <?php if ( ! empty( $baths ) ) : ?>
                <li><span><?php echo esc_html__( 'Baths', 'homelist' ); ?></span><strong><?php echo esc_attr( $baths ); ?></strong></li>
            <?php endif; ?>

            <?php $garages = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'garages', true ); ?>
            <?php if ( ! empty( $garages ) ) : ?>
                <li><span><?php echo esc_html__( 'Garages', 'homelist' ); ?></span><strong><?php echo esc_attr( $garages ); ?></strong></li>
            <?php endif; ?>
        </ul>
    </div><!-- /.property-overview -->
</div><!-- /.property-content -->