<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="col-sm-3">
    <div class="facts-counter-item">
        <div class="facts-counter-item-image">
            <i class="<?php echo esc_attr( get_post_meta( get_the_ID(), HOMELIST_PREFIX . 'select', true ) ); ?>"></i>
        </div> 
        <div class="facts-counter-item-text">
            <h1><span class="counter"><?php echo esc_html( get_post_meta( get_the_ID(), HOMELIST_PREFIX . 'count', true ) ); ?></span></h1>
            <p><?php the_title() ?></p>
        </div>  
    </div>  
</div>