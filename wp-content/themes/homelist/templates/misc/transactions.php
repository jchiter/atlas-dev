<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php $paged = ( get_query_var( 'paged' )) ? get_query_var( 'paged' ) : 1; ?>

<?php query_posts( array(
	'post_type' 	=> 'transaction',
	'paged'         => $paged,
	'author'        => get_current_user_id(),
) ); ?>

<?php if ( have_posts() ) : ?>
	<table class="transactions-table">
		<thead>
			<th><?php echo esc_html__( 'ID', 'homelist' ); ?></th>
			<th><?php echo esc_html__( 'Price', 'homelist' ); ?></th>
			<th><?php echo esc_html__( 'Gateway', 'homelist' ); ?></th>
			<th><?php echo esc_html__( 'Object', 'homelist' ); ?></th>
			<th><?php echo esc_html__( 'Payment Type', 'homelist' ); ?></th>
			<th><?php echo esc_html__( 'Date', 'homelist' ); ?></th>
		</thead>

		<tbody>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php
				$object = get_post_meta( get_the_ID(), REALIA_TRANSACTION_PREFIX . 'object', true );
				$object = unserialize( $object );
				$object_id = get_post_meta( get_the_ID(), REALIA_TRANSACTION_PREFIX . 'object_id', true );
				$payment_type = get_post_meta( get_the_ID(), REALIA_TRANSACTION_PREFIX . 'payment_type', true );
				?>

				<tr>
					<td><b>#<?php the_ID(); ?></b></td>
					<td><?php echo wp_kses( $object['price_formatted'], wp_kses_allowed_html( 'post' ) ); ?></td>
					<td><?php echo esc_html( $object['gateway'] ); ?></td>
					<td><?php echo sprintf( '<a href="%s">%s</a>', get_permalink( $object_id ), get_the_title( $object_id ) ); ?></td>
					<td>
						<?php
						switch ( $payment_type ) {
							case 'pay_for_featured':
								echo esc_html__( 'Feature property', 'homelist' );
								break;
							case 'pay_for_sticky':
								echo esc_html__( 'TOP property', 'homelist' );
								break;
							case 'pay_per_post':
								echo esc_html__( 'Pay per post', 'homelist' );
								break;
							case 'package':
								echo esc_html__( 'Package', 'homelist' );
								break;
							default:
								echo esc_html( $payment_type );
								break;
						}
						?>
					</td>
					<td><?php the_date(); ?> <?php the_time(); ?></td>
				</tr>
			<?php endwhile; ?>
		</tbody>
	</table>

	<?php the_posts_pagination( array(
		'prev_text'          => esc_html__( 'Previous page', 'homelist' ),
		'next_text'          => esc_html__( 'Next page', 'homelist' ),
		'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'homelist' ) . ' </span>',
	) ); ?>
<?php else : ?>
	<div class="alert alert-warning"><?php echo esc_html__( 'No transactions found.', 'homelist' ); ?></div>
<?php endif; ?>

<?php wp_reset_query(); ?>
