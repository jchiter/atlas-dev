<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="col-lg-3 col-md-3 col-sm-6">
	<div class="facts-category">
		<a href="#" title="">
			<i class="<?php echo esc_attr( get_post_meta( get_the_ID(), HOMELIST_PREFIX . 'select', true ) ); ?>"></i>
			<span><?php the_title() ?></span>
			<p>(<?php echo esc_html( get_post_meta( get_the_ID(), HOMELIST_PREFIX . 'count', true ) ); ?>)</p>
		</a>
	</div>
</div>