<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php $icon = get_post_meta( get_the_ID(), HOMELIST_PREFIX . 'select', true ); ?>
<div class="col-sm-3 col-xs-12">
	<div class="single-service">
		<div class="icon"><i class="<?php echo esc_attr( $icon ); ?>"></i></div>
		<h5><a href="<?php the_permalink( ); ?>"><?php the_title() ?></a></h5>
		<p><?php echo esc_html( wp_trim_words( get_the_content(), 16, '...' ) ); ?></p>
	</div>
</div>
<!-- break -->
