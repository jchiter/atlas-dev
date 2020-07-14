<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php $icon = get_post_meta( get_the_ID(), HOMELIST_PREFIX . 'select', true ); ?>
<div class="col-md-3 col-sm-6 col-xs-12">
    <div class="service-container">
        <div class="service-icon">
            <a href="<?php the_permalink( ); ?>"><i class="fa <?php echo esc_attr( $icon ); ?>"></i></a>
        </div>
        <div class="service-content">
            <h3><?php the_title() ?></h3>
            <p><?php echo esc_html( wp_trim_words( get_the_content(), 16, '...' ) ); ?></p>
        </div>
    </div>
</div>
<!-- break -->

