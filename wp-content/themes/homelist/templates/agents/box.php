<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php $is_sticky = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'sticky', true ); ?>

<div class="agent-container">
    <div class="agent-content-list">
        <div class="agent-image-list">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'large' ); ?>
            <?php endif; ?>
		    <?php $agent_title = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'title', true ); ?>
            <?php $email = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'email', true ); ?>
        </div>
        <div class="agent-text">
            <h3><a href="<?php the_permalink(); ?>"><?php the_title() ?></a> <?php if ( ! empty( $agent_title ) ) : ?><small><?php echo esc_html( $agent_title ); ?></small><?php endif; ?></h3>

            <?php $email = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'email', true ); ?>
            <?php if ( ! empty( $email ) ) : ?>
                <div class="agent-email">
	                <a href="mailto:<?php echo esc_attr( $email ); ?>">
                        <?php echo esc_attr( $email ); ?>
	                </a>
                </div><!-- /.agent-box-email -->
            <?php endif; ?>

            <?php $phone = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'phone', true ); ?>
            <?php if ( ! empty( $phone ) ) : ?>
                <div class="agent-phone">
                    <?php echo esc_attr( $phone ); ?>
                </div><!-- /.agent-box-phone -->
            <?php endif; ?>

	        <?php $web = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'web', true ); ?>
	        <?php if ( ! empty( $web ) ) : ?>
		        <div class="agent-web">
			        <a href="<?php echo esc_attr( $web ); ?>">
			            <?php echo esc_attr( $web ); ?>
			        </a>
		        </div><!-- /.agent-box-web -->
	        <?php endif; ?>

            <div class="agent-social-networks">
                <?php $social_networks = apply_filters( 'realia_social_networks', array() ); ?>
                <?php foreach( $social_networks as $key => $title ): ?>
                    <?php $network = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'social_' . $key, true ); ?>
                    <?php if ( ! empty( $network ) ) : ?>
                        <a href="<?php echo esc_attr( $network ); ?>" class="agent-social-network <?php echo esc_attr( $key ); ?>"></a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div><!-- /.agent-social-networks -->
        </div>
    </div>
</div><!-- /.agent-container -->