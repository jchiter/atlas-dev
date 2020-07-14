<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="agency-container">
        <div class="agency-content-list">
            <div class="agency-image-list md-4">
                <?php if ( has_post_thumbnail() ) : ?>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail( 'large' ); ?>
                    </a>
                <?php endif; ?>
	            <?php $email = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'email', true ); ?>
                <div class="agency-actions">
	                <?php if ( ! empty( $email ) ) : ?>
                    <a href="mailto:<?php echo esc_attr( $email ); ?>" title="<?php esc_attr_e( 'Send Email', 'homelist' ); ?>"><i class="flaticon-new-email-outline"></i>  <?php echo esc_html__( 'E-mail', 'homelist' ); ?></a>
                    <?php endif; ?>
                    <a href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'View Detail', 'homelist' ); ?>"><?php echo esc_html__( 'View', 'homelist' ); ?> <i class="flaticon-right-arrow"></i></a>
                </div>
            </div>
            <div class="agency-text md-4">
                <?php $address = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'address', true ); ?>
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <?php if ( ! empty( $address ) ) : ?><small><?php echo esc_html( $address ); ?></small><?php endif; ?></h3>
                <?php the_excerpt(); ?>
                <div class="agency-attributes">
	                <?php $agents_count = Realia_Query::get_agency_agents()->post_count; ?>

	                <?php if ( $agents_count > 0 ) : ?>
			                <?php if ( ! empty( $agents_count ) ) : ?>
                                <span><i class="fa fa-user"></i> <?php echo esc_attr( $agents_count ); ?> <?php echo esc_html__( 'agents', 'homelist' ); ?></span>
			                <?php endif; ?>
	                <?php endif; ?>
                    <?php $properties_count = homelist_get_agency_properties( )->post_count; ?>
                    <span><i class="fa fa-home"></i> <?php echo esc_attr( $properties_count ); ?> <?php echo esc_html__( 'properties', 'homelist' ); ?></span>
                </div>
            </div>
            <div class="agency-text md-4">
	            <?php $web = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'web', true ); ?>
	            <?php $phone = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'phone', true ); ?>
	            <?php $address = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'address', true ); ?>

	            <?php if ( ! empty( $email ) || ! empty( $web ) || ! empty( $phone ) || ! empty( $address ) ) : ?>
		            <div class="agency-row-overview">
		                <h3 class="agency-row-overview-title">
			                <?php echo esc_html__( 'Contact Information', 'homelist' ); ?>
		                </h3><!-- /.agency-row-overview -->

	                    <dl>
	                        <?php if ( ! empty( $email ) ) : ?>
	                            <dt><?php echo esc_html__( 'Email', 'homelist' ); ?></dt>
		                        <dd>
			                        <a href="mailto:<?php echo esc_attr( $email ); ?>">
			                            <?php echo esc_attr( $email ); ?>
			                        </a>
		                        </dd>
	                        <?php endif; ?>

	                        <?php if ( ! empty( $web ) ) : ?>
	                            <dt><?php echo esc_html__( 'Web', 'homelist' ); ?></dt>
		                        <dd>
			                        <a href="<?php echo esc_attr( $web ); ?>">
			                            <?php echo esc_attr( $web ); ?>
			                        </a>
		                        </dd>
	                        <?php endif; ?>

	                        <?php if ( ! empty( $phone ) ) : ?>
	                            <dt><?php echo esc_html__( 'Phone', 'homelist' ); ?></dt><dd><?php echo esc_attr( $phone ); ?></dd>
	                        <?php endif; ?>

	                        <?php if ( ! empty( $address ) ) : ?>
	                            <dt><?php echo esc_html__( 'Address', 'homelist' )?></dt><dd><?php echo wp_kses( nl2br( $address ), wp_kses_allowed_html( 'post' ) ); ?></dd>
	                        <?php endif; ?>
	                    </dl>
	                </div><!-- /.agency-row-overview -->
	            <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- break -->
