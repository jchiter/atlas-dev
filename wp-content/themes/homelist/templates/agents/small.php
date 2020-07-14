<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="agent-container">
    <div class="agent-content-list">
        <div class="agent-image-list">
		    <?php if ( has_post_thumbnail() ) : ?>
			    <?php the_post_thumbnail( 'large' ); ?>
		    <?php endif; ?>
		    <?php $agent_title = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'title', true ); ?>
		    <?php if ( ! empty( $agent_title ) ) : ?>
            <div class="agent-title">
                <h4><?php echo esc_html( $agent_title ); ?></h4>
            </div>
            <?php endif; ?>
        </div>
        <div class="agent-text">
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <?php if ( ! empty( $agent_title ) ) : ?><small><?php echo esc_html( $agent_title ); ?></small><?php endif; ?></h3>

		    <?php $email = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'email', true ); ?>
		    <?php if ( ! empty( $email ) ) : ?>
			    <div class="agent-email">
				    <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_attr( $email ); ?></a>
			    </div><!-- /.agent-small-email -->
		    <?php endif; ?>

		    <?php $phone = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'phone', true ); ?>
		    <?php if ( ! empty( $phone ) ) : ?>
			    <div class="agent-phone">
				    <?php echo esc_attr( $phone ); ?>
			    </div><!-- /.agent-small-phone -->
		    <?php endif; ?>
        </div>
    </div>
</div><!-- /.agent-container -->