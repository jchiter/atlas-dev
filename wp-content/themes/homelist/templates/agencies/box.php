<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php $is_sticky = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'sticky', true ); ?>

<div class="agency-container">
    <div class="agency-content-list">
        <div class="agency-image-list">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'large' ); ?>
            <?php endif; ?>
		    <?php if ( ! empty( $agency_title ) ) : ?>
            <div class="agency-title">
                <h4><?php echo esc_html( $agency_title ); ?></h4>
            </div>
            <?php endif; ?>
            <?php $email = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'email', true ); ?>
            <div class="agency-actions">
                <a href="mailto:<?php echo esc_attr( $email ); ?>" title="<?php echo __( 'Send E-mail', 'homelist' ); ?>"><i class="flaticon-envelope"></i></a>
                <a href="<?php the_permalink(); ?>" title="<?php echo __( 'View Detail', 'homelist' ); ?>"><i class="flaticon-right-arrow"></i></a>
            </div>
        </div>
        <div class="agency-text">
		    <?php $agency_address = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'address', true ); ?>
            <h3><a href="<?php the_permalink(); ?>"><?php the_title() ?></a> <?php if ( ! empty( $agency_address ) ) : ?><small><?php echo esc_html( $agency_address ); ?></small><?php endif; ?></h3>

            <?php $email = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'email', true ); ?>
            <?php if ( ! empty( $email ) ) : ?>
                <div class="agency-email">
	                <a href="mailto:<?php echo esc_attr( $email ); ?>">
                        <?php echo esc_attr( $email ); ?>
	                </a>
                </div><!-- /.agency-box-email -->
            <?php endif; ?>

            <?php $phone = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'phone', true ); ?>
            <?php if ( ! empty( $phone ) ) : ?>
                <div class="agency-phone">
                    <?php echo esc_attr( $phone ); ?>
                </div><!-- /.agency-box-phone -->
            <?php endif; ?>

	        <?php $web = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'web', true ); ?>
	        <?php if ( ! empty( $web ) ) : ?>
		        <div class="agency-web">
			        <a href="<?php echo esc_attr( $web ); ?>">
			            <?php echo esc_attr( $web ); ?>
			        </a>
		        </div><!-- /.agency-box-web -->
	        <?php endif; ?>

            <div class="agency-social-networks">
                <?php $social_networks = apply_filters( 'realia_social_networks', array() ); ?>
                <?php foreach( $social_networks as $key => $title ): ?>
                    <?php $network = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'social_' . $key, true ); ?>
                    <?php if ( ! empty( $network ) ) : ?>
                        <a href="<?php echo esc_attr( $network ); ?>" class="agency-social-network <?php echo esc_attr( $key ); ?>"></a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div><!-- /.agency-social-networks -->
        </div>
    </div>
</div><!-- /.agency-container -->