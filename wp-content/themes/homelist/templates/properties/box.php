<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<?php global $show_content, $show_price; ?>

<?php $property = isset( $property ) ? $property : get_post(); ?>

<?php $is_sticky = get_post_meta( $property->ID, REALIA_PROPERTY_PREFIX . 'sticky', true ); ?>

<div class="property-container">
    <div class="property-image <?php if ( ! has_post_thumbnail( $property ) ) { echo 'without-image'; } ?>">
        
	    <?php
	    /**
	    * realia_before_property_box_image
	    */
	    do_action( 'realia_before_property_box_image', $property->ID );
	    ?>

        <?php $add_gallery_to_box = get_post_meta( $property->ID, REALIA_PROPERTY_PREFIX . 'add_gallery_to_box', true ); ?>
        <?php if ( $add_gallery_to_box ) : ?>
            <?php $gallery = get_post_meta( $property->ID, REALIA_PROPERTY_PREFIX . 'gallery', true ); ?>
            <?php if ( ! empty( $gallery ) ) : ?>
            <div class="slick-slider slider">
            <?php foreach ( $gallery as $id => $src ) : ?>
                <div>
                    <img src="<?php echo esc_url( $src ); ?>" alt="<?php echo get_the_title( $property ) ?>">
                </div>
            <?php endforeach; ?>
            </div>
            <?php endif; ?>
        <?php else: ?>
            <?php if ( has_post_thumbnail( $property ) ) : ?>
		        <?php echo get_the_post_thumbnail( $property, 'large', array( 'class' => 'property-box-thumbnail' ) ); ?>
            <?php endif; ?>
        <?php endif; ?>
        <a href="<?php the_permalink( $property ); ?>" class="property-box-image-inner <?php if ( ! empty( $agent ) ) : ?>has-agent<?php endif; ?>">
	    <?php
	    /**
	    * realia_after_property_box_image
	    */
	    do_action( 'realia_after_property_box_image', $property->ID );
	    ?>
	    <?php $type = Realia_Query::get_property_type_name( $property->ID ); ?>
	    <?php $price = Realia_Price::get_property_price( $property->ID ); ?>
        <?php if ( ! empty( $type ) && ! empty( $price ) ) : ?>
        <div class="property-price">
		    <?php
		    /**
		    * realia_before_property_box_body
		    */
		    do_action( 'realia_before_property_box_body', $property->ID );
		    ?>

	        <?php if ( ! empty( $type ) ) : ?>
	            <h4>
	                <?php echo wp_kses( $type, wp_kses_allowed_html( 'post' ) ); ?>
	            </h4><!-- /.property-box-type -->
	        <?php endif; ?>

	        <?php if ( ! empty( $price ) && $show_price == 'yes' ) : ?>
	            <span>
	                <?php echo wp_kses( $price, wp_kses_allowed_html( 'post' ) ); ?>
	            </span><!-- /.property-box-price -->
	        <?php endif; ?>

		    <?php
		    /**
		    * realia_after_property_box_body
		    */
		    do_action( 'realia_after_property_box_body', $property->ID );
		    ?>
        </div>
        <?php endif; ?>
        <?php $is_featured = get_post_meta( $property->ID, REALIA_PROPERTY_PREFIX . 'featured', true ); ?>
        <?php $is_reduced = get_post_meta( $property->ID, REALIA_PROPERTY_PREFIX . 'reduced', true ); ?>
        <?php if ( $is_featured || $is_reduced ) : ?>
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
        </a>
    </div>
    <div class="property-content">
	    <?php
	    /**
	    * realia_before_property_box_title
	    */
	    do_action( 'realia_before_property_box_title', $property->ID );
	    ?>

        <?php $address = get_post_meta( $property->ID, REALIA_PROPERTY_PREFIX . 'address', true ); ?>
        <h3><a href="<?php the_permalink( $property ); ?>"><?php echo get_the_title( $property ) ?></a> <?php if ( ! empty( $address ) ) : ?><small><i class="flaticon-pin-1"></i> <?php echo wp_kses( $address, wp_kses_allowed_html( 'post' ) ); ?></small><?php endif; ?></h3>
        
        <?php if ( $show_content == 'yes' ) : ?>
        <p><?php echo wp_trim_words( get_the_content(), 20, '...' ); ?></p>
        <?php endif; ?>

	    <?php
	    /**
	    * realia_after_property_box_title
	    */
	    do_action( 'realia_after_property_box_title', $property->ID );
	    ?>
    </div>
    <?php $rooms = get_post_meta( $property->ID, REALIA_PROPERTY_PREFIX . 'rooms', true ); ?>
    <?php $beds = get_post_meta( $property->ID, REALIA_PROPERTY_PREFIX . 'beds', true ); ?>
    <?php $baths = get_post_meta( $property->ID, REALIA_PROPERTY_PREFIX . 'baths', true ); ?>
    <?php if ( ! empty( $rooms ) || ! empty( $beds ) || ! empty( $baths ) ) : ?>
   <div class="property-attributes text-center">
         <?php if ( ! empty( $rooms ) ) : ?>
        <div class="col-xs-4">
            <h4><i class="flaticon-plans"></i> <?php echo wp_kses( $rooms, wp_kses_allowed_html( 'post' ) ); ?></h4>
            <p class="text-overflow" title="<?php echo esc_attr__( 'Rooms', 'homelist' ); ?>"><?php echo esc_html__( 'Rooms', 'homelist' ); ?></p>
        </div>
        <?php endif; ?>
        <?php if ( ! empty( $beds ) ) : ?>
        <div class="col-xs-4">
            <h4><i class="flaticon-bed"></i> <?php echo wp_kses( $beds, wp_kses_allowed_html( 'post' ) ); ?></h4>
            <p class="text-overflow" title="<?php echo esc_attr__( 'Bedrooms', 'homelist' ); ?>"><?php echo esc_html__( 'Bedrooms', 'homelist' ); ?></p>
        </div>
        <?php endif; ?>
        <?php if ( ! empty( $baths ) ) : ?>
        <div class="col-xs-4">
            <h4><i class="flaticon-bathtub"></i> <?php echo wp_kses( $baths, wp_kses_allowed_html( 'post' ) ); ?></h4>
            <p class="text-overflow" title="<?php echo esc_attr__( 'Bath', 'homelist' ); ?>"><?php echo esc_html__( 'Bath', 'homelist' ); ?></p>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>
    <div class="property-buttons">
        <a href="<?php the_permalink( $property ); ?>" class="property-btn"><?php echo esc_html__( 'Browse', 'homelist' ); ?></a>
    </div>
</div><!-- /.property-container -->



