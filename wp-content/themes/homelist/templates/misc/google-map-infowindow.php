<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="infobox">
	<a class="infobox-image" href="<?php the_permalink(); ?>">
		<?php the_post_thumbnail( 'thumbnail' ); ?>

		<?php $price = Realia_Price::get_property_price(); ?>
		<?php if ( ! empty( $price ) ) : ?>
			<div class="infobox-content-price"><?php echo wp_kses( $price, wp_kses_allowed_html( 'post' ) ); ?></div>
		<?php endif; ?>
	</a>

	<div class="infobox-content">
		<div class="infobox-content-title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</div>

		<div class="infobox-content-body">
			<div class="infobox-content-body-location">
				<?php echo Realia_Query::get_property_location_name(); ?>
			</div>

            <?php $rooms = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'rooms', true ); ?>
			<?php if ( ! empty( $rooms ) ) : ?>
            <div class="col-xs-4">
				<div class="infobox-content-body-attr">
					<strong><i class="flaticon-plans"></i> <?php echo wp_kses( $rooms, wp_kses_allowed_html( 'post' ) ); ?></strong>
					<span><?php echo esc_html__( 'Rooms', 'homelist' ); ?> </span>
				</div>
            </div>
			<?php endif; ?>

			<?php $beds = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'beds', true ); ?>
			<?php if ( ! empty( $beds ) ) : ?>
            <div class="col-xs-4">
				<div class="infobox-content-body-attr">
					<strong><i class="flaticon-bed"></i> <?php echo esc_attr( $beds ); ?></strong>
					<span><?php echo esc_html__( 'Beds', 'homelist' ); ?> </span>
				</div>
            </div>
			<?php endif; ?>

			<?php $baths = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'baths', true ); ?>
			<?php if ( ! empty( $baths ) ) : ?>
            <div class="col-xs-4">
				<div class="infobox-content-body-attr">
					<strong><i class="flaticon-bathtub"></i> <?php echo esc_attr( $baths ); ?></strong>
					<span><?php echo esc_html__( 'Baths', 'homelist' ); ?></span>
				</div>
            </div>
			<?php endif; ?>
		</div>
	</div>
</div>
