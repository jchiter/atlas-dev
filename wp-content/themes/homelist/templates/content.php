<?php
/**
 * Template part for displaying posts.
 *
 * @package homelist
 */

?>
<div class="blog-container">
    <?php if ( has_post_thumbnail() ) : ?>
    <?php
        $thumbnail_url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), array('220','220'), true );
        $thumbnail_url = $thumbnail_url[0];
    ?>
    <div class="blog-image" style="background-image: url(<?php echo esc_attr( $thumbnail_url ); ?>);">
    </div>
    <?php endif; ?>
    <div class="blog-content">
        <div class="blog-title">
            <?php if ( ! is_single() ) : ?>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title( ); ?></a></h2>
            <?php endif; ?>
        </div>
        <div class="blog-features">
            <span><i class="fa fa-user"></i> <?php echo get_the_author(); ?></span>
            <span><i class="fa fa-clock-o"></i> <?php echo get_the_date(); ?></span>
            <?php 
            $categories = get_the_category(); 
            if ( ! empty( $categories ) ) :
            ?>
            <span><i class="fa fa-bars"></i> <?php echo esc_html( $categories[0]->name ); ?></span>
            <?php endif; ?>
            <span><i class="fa fa-comments-o"></i> <?php comments_number( 'no responses', 'one response', '% responses' ); ?></span>
        </div>
        <div class="blog-text">
		    <?php the_content( sprintf(
			    wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'homelist' ), array( 'span' => array( 'class' => array() ) ) ),
			    the_title( '<span class="screen-reader-text">"', '"</span>', false )
		    ) ); ?>

            <?php wp_link_pages( array(
	            'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'homelist' ) . '</span>',
	            'after'       => '</div>',
	            'link_before' => '<span>',
	            'link_after'  => '</span>',
	            ) );
            ?>

            <?php if ( ! is_single() ) { ?>
            <p class="text-left"><a href="<?php the_permalink(); ?>" class="btn-read-more"><?php echo esc_html__( 'Read more', 'homelist' ); ?> <i class="fa fa fa-angle-right"></i></a></p>
            <div class="border-bottom"></div>
            <?php } ?>
        </div>
    </div>
</div>
<!-- break -->
