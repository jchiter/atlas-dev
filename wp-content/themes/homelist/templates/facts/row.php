<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
             
<div class="fact-box count-box col-lg-3 col-md-3 col-sm-6 col-xs-12 fact-box-xs">
    <div class="inner">
        <div class="icon-box"><span class="<?php echo esc_attr( get_post_meta( get_the_ID(), HOMELIST_PREFIX . 'select', true ) ); ?>"></span></div>
        <div class="content">
            <div class="count-outer">
                <span class="count-text counter"><?php echo esc_html( get_post_meta( get_the_ID(), HOMELIST_PREFIX . 'count', true ) ); ?></span>
            </div>
            <div class="counter-title"><?php the_title() ?></div>
        </div>
    </div>
</div>
