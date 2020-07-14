<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="profile-box">
    <div class="profile-header">
        <div class="profile-img">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'large' ); ?>
		<?php endif; ?>
        </div>
        <h5 class="profile-title"><?php the_title(); ?></h5>
    </div>
	<?php $email = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'email', true ); ?>
	<?php $phone = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'phone', true ); ?>
    <ul class="profile-contact">
        <?php if ( ! empty( $email ) ) : ?>
        <li><i class="flaticon-email"></i> <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_attr( $email ); ?></a></li>
        <?php endif; ?>
        <?php if ( ! empty( $phone ) ) : ?>
        <li><i class="flaticon-telephone"></i> <?php echo esc_attr( $phone ); ?></li>
        <?php endif; ?>
    </ul>
</div>
