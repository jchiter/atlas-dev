<div class="property-content">
    <?php $amenities = get_categories( array(
        'taxonomy' 		=> 'amenities',
        'hide_empty' 	=> false,
    ) ); ?>

    <?php $hide = get_theme_mod( 'realia_general_hide_unassigned_amenities', false ); ?>
    <?php if ( ! empty( $amenities ) ) : ?>
        <div class="property-amenities">
            <?php if ( ! empty( $section_title ) ): ?><h2><?php echo esc_html__( 'Property', 'homelist' ); ?> <?php echo esc_attr( $section_title ); ?></h2><?php endif; ?>

            <ul>
                <?php foreach ( $amenities as $amenity ) : ?>
                    <?php $has_term = has_term( $amenity->term_id, 'amenities' ); ?>

                    <?php if ( ! $hide || ( $hide  && $has_term ) ) : ?>
                    <?php $term_meta = get_option( "taxonomy_$amenity->slug" ); ?>
                        <li <?php if ( $has_term ) : ?>class="yes"<?php else : ?>class="no"<?php endif; ?>><?php if ( ! empty( $term_meta['custom_term_meta'] ) ): ?><i class="<?php echo esc_attr( $term_meta['custom_term_meta'] ); ?>"></i> <?php endif; ?><?php echo esc_html( $amenity->name ); ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div><!-- /.property-amenities -->
    <?php endif; ?>
</div><!-- /.property-content -->