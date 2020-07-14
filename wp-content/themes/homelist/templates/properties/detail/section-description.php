<div class="property-content">
    <div class="property-description">
        <?php if ( ! empty( $section_title ) ): ?><h2><?php echo esc_html__( 'Property', 'homelist' ); ?> <?php echo esc_attr( $section_title ); ?></h2><?php endif; ?>
        <?php the_content( sprintf( esc_html__( 'Continue reading %s', 'homelist' ), the_title( '<span class="screen-reader-text">', '</span>', false ) ) ); ?>
    </div><!-- /.property-description -->
</div><!-- /.property-content -->