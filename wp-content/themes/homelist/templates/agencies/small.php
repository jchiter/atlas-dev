<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="agency-container">
    <div class="agency-content-list">
        <div class="agency-image-list">
		    <?php if ( has_post_thumbnail() ) : ?>
			    <?php the_post_thumbnail( 'large' ); ?>
		    <?php endif; ?>
		    <?php $agency_title = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'title', true ); ?>
		    <?php if ( ! empty( $agency_title ) ) : ?>
            <div class="agency-title">
                <h4><?php echo esc_html( $agency_title ); ?></h4>
            </div>
            <?php endif; ?>
        </div>
        <div class="agency-text">
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <?php if ( ! empty( $agency_title ) ) : ?><small><?php echo esc_html( $agency_title ); ?></small><?php endif; ?></h3>

		    <?php $email = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'email', true ); ?>
		    <?php if ( ! empty( $email ) ) : ?>
			    <div class="agency-email">
				    <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_attr( $email ); ?></a>
			    </div><!-- /.agency-small-email -->
		    <?php endif; ?>

		    <?php $phone = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'phone', true ); ?>
		    <?php if ( ! empty( $phone ) ) : ?>
			    <div class="agency-phone">
				    <?php echo esc_attr( $phone ); ?>
			    </div><!-- /.agency-small-phone -->
		    <?php endif; ?>
        </div>
    </div>
</div><!-- /.agency-container -->