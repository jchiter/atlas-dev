<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="col-sm-6 col-md-4">
    <div class="testimonial-box-3">
        <div class="col-sm-6 col-md-5">
            <div class="testimonial-image"><?php the_post_thumbnail( 'full' ); ?></div>
        </div>
        <div class="col-sm-6 col-md-7">
        <div class="testimonial-title"><?php the_title() ?></div>
            <div class="testimonial-info"><span class="name"><?php echo esc_html( get_post_meta( get_the_ID(), HOMELIST_PREFIX . 'testimonial_author_name', true ) ); ?></span> - <?php echo esc_html( get_post_meta( get_the_ID(), HOMELIST_PREFIX . 'testimonial_author_title', true ) ); ?> @ <?php echo esc_html( get_post_meta( get_the_ID(), HOMELIST_PREFIX . 'testimonial_author_company', true ) ); ?>  &nbsp;&nbsp;<ul class="rating-stars"><li><i class="fa fa-star"></i></li> <li><i class="fa fa-star"></i></li> <li><i class="fa fa-star"></i></li> <li><i class="fa fa-star"></i></li> <li><i class="fa fa-star"></i></li></ul></div>
        </div>
        <div class="testimonial-details"><?php echo esc_html( wp_trim_words( get_the_content(), 20, '...' ) ); ?></div>
    </div>
</div>
<!-- break -->
