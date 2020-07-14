<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php if ( get_theme_mod( 'realia_submission_type', 'free' ) == 'packages' ) :   ?>
	<div class="package-info-wrapper">
		<?php $current_package = Realia_Packages::get_package_for_user( get_current_user_id() ); ?>

		<?php if ( empty( $current_package ) ) : ?>
			<p class="package-info">
				<?php echo esc_html__( 'Site is using packages. Before you can post property, please upgrade your package.', 'homelist' ); ?>
			</p>
		<?php else : ?>
			<div class="package-info">
				<p><?php echo sprintf( esc_html__( 'You are using <strong>%s</strong> package.', 'homelist' ), esc_attr( $current_package->post_title ) ); ?></p>

				<?php $date = Realia_Packages::get_package_valid_date_for_user( get_current_user_id() ); ?>
				<?php if ( Realia_Packages::is_package_valid_for_user( get_current_user_id() ) ) : ?>

					<?php echo sprintf( esc_html__( 'Your subscription is valid until <strong>%s</strong>.', 'homelist' ), esc_attr( $date ) ); ?>

					<?php $remaining = Realia_Packages::get_remaining_properties_count_for_user( get_current_user_id() ); ?>

					<?php if ( 'unlimited' === $remaining ) : ?>
						<?php echo esc_html__( 'You can add <strong>unlimited</strong> amount of items', 'homelist' ); ?>
					<?php elseif ( (int) $remaining < 0 ) :   ?>
						<?php echo sprintf( esc_html__( 'You can not add any properties because you spent all of your available properties. Change your package. First <strong>%s</strong> items has been disabled from listing.', 'homelist' ), esc_attr( abs( $remaining ) ) ); ?>
					<?php else : ?>
						<?php echo sprintf( esc_html__( 'You can add <strong>%s</strong> items.', 'homelist' ), esc_attr( $remaining ) ); ?>
					<?php endif; ?>
				<?php else : ?>
					<?php echo sprintf( esc_html__( 'Your subscription already expired at <strong>%s</strong>. All your items has been deactivated until you pay for new subscription.', 'homelist' ), $date ); ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php $packages = Realia_Packages::get_packages(); ?>
		<?php $package_payment_id = get_theme_mod( 'realia_submission_payment_page', false ); ?>

		<?php if ( ! $package_payment_id ) :   ?>
			<p><?php echo esc_html__( 'Payment page has been not set.', 'homelist' ); ?></p>
		<?php endif; ?>

		<?php if ( ! empty( $packages ) && ! empty( $package_payment_id ) ) : ?>
			<form method="post" action="<?php echo esc_attr( get_permalink( $package_payment_id ) ); ?>">
				<input type="hidden" name="payment_type" value="package">

				<div class="form-group">
					<select name="object_id">
						<option value=""><?php echo esc_html__( 'Select Package', 'homelist' ); ?></option>

						<?php foreach ( $packages as $package ) : ?>
							<?php $package_id = $package->ID; ?>
							<?php $package_title = $package->post_title; ?>

							<option value="<?php echo esc_attr( $package_id ); ?>" <?php if ( ! empty( $current_package->ID ) && $current_package->ID == $package_id ) : ?>selected="selected"<?php endif; ?>>
								<?php echo esc_attr( Realia_Packages::get_full_package_title( $package_id ) ); ?>
							</option>
						<?php endforeach; ?>
					</select>
				</div><!-- /.form-group -->

				<button type="submit" class="btn btn-block" name="change-package"><?php echo esc_html__( 'Upgrade', 'homelist' ); ?></button>
			</form>
		<?php endif; ?>

	</div><!-- /.package-info-wrapper -->
<?php endif; ?>
