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

<div class="item <?php if (0 == $wp_query->current_post) { echo 'active'; } ?>">
	<figure>
		<img src="<?php echo esc_attr( $image ); ?>" alt="<?php the_title(); ?>" class="img-responsive"/>
		<figcaption>
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="slider-details">
							<h1>
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h1>
							<p><span class="flaticon-map-marker"></span> <?php echo wp_trim_words( $address, 20, '...' ); ?></p>
			                <?php $price = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'price', true ); ?>
			                <?php $area = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'home_area', true ); ?>
			                <?php $status = Realia_Query::get_property_status_name(); ?>
			                <?php $type = Realia_Query::get_property_type_name(); ?>
			                <?php $beds = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'beds', true ); ?>
			                <?php $baths = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'baths', true ); ?>
			                <?php $garages = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'garages', true ); ?>
                            <?php if ( ! empty( $area ) || ! empty( $beds ) || ! empty( $baths ) ) : ?>
							<ul class="list-unstyled">
                                <?php if ( ! empty( $area ) ) : ?>
								<li>
									<span class="flaticon-select-1"></span>
									<span> <?php echo esc_attr( $area ); ?> <br /> <?php echo get_theme_mod( 'realia_measurement_area_unit', 'Square Ft' ); ?></span>
								</li>
                                <?php endif; ?>

                                <?php if ( ! empty( $beds ) ) : ?>
								<li>
									<span class="flaticon-bed"></span>
									<span> <?php echo esc_attr( $beds ); ?> <br /> <?php echo esc_html__( 'Bedroom', 'homelist' ); ?></span>
								</li>
                                <?php endif; ?>

                                <?php if ( ! empty( $baths ) ) : ?>
								<li>
									<span class="flaticon-bathtub-1"></span>
									<span> <?php echo esc_attr( $garages ); ?> <br /> <?php echo esc_html__( 'Bathroom', 'homelist' ); ?></span>
								</li>
                                <?php endif; ?>
							</ul>
                            <?php endif; ?>
                            <?php $contract = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'contract', true ); ?>
                            <?php $contract = ( $contract == 'SALE' ) ? esc_html__( 'SALE', 'homelist' ) : esc_html__( 'RENT', 'homelist' ); ?>
							<span class="sticker"><?php echo esc_html( $contract ); ?></span>
							<h2><?php echo esc_html( Realia_Price::format_price( $price ) ); ?></h2>
											
							<div class="slide-controls">
								<a class="control-left" href="#remp-carousel" data-slide="prev"><i class="fa fa-angle-left"></i></a>
								<a class="control-right" href="#remp-carousel" data-slide="next"><i class="fa fa-angle-right"></i></a>
							</div>
						</div><!-- Ends: .slider-details -->
					</div>
				</div>
			</div>
		</figcaption>
	</figure>
</div><!-- Ends: .item -->