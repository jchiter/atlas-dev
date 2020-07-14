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

<div class="item <?php if ( 0 == $wp_query->current_post ) { echo 'active'; } ?>">
    <!-- Slide Background -->
    <img src="<?php echo esc_attr( $image ); ?>" alt="<?php the_title(); ?>" class="slide-image">
    <div class="bs-slider-overlay"></div>
    <div class="container">
        <div class="row">
            <!-- Slide Text Layer -->
            <div class="slide-text slide_style_left">
                <h1 data-animation="animated zoomInRight" class=""><?php the_title(); ?></h1>
                <p data-animation="animated fadeInLeft" class=""><?php echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?> </p>
                <a href="#" class="button button-icon" data-animation="animated fadeInLeft" tabindex="-1"><i class="fa fa-angle-right"></i><?php echo esc_html__( 'View Property', 'homelist' ); ?></a>
            </div>
        </div>
    </div>
</div>
