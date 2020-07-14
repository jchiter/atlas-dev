<?php $gallery = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'gallery', true ); ?>

<?php if ( ! empty( $gallery ) ) : ?>
    <div class="property-gallery">
        <div id="slider-property" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php $index = 0; ?>
                <?php foreach ( $gallery as $id => $src ) : ?>
                    <li data-target="#slider-property" data-slide-to="<?php echo esc_attr( $index ); ?>" <?php echo ( 0 == $index ) ? 'class="active"' : ''; ?>>
                        <img src="<?php echo esc_url( $src ); ?>" alt="">
                        <?php $index++; ?>
                    </li>
                <?php endforeach; ?>
            </ol>
            <div class="carousel-inner">
                <?php $index = 0; ?>
                <?php foreach ( $gallery as $id => $src ) : ?>
                    <div class="item <?php echo ( 0 == $index ) ? 'active' : ''; ?>">
                        <img src="<?php echo esc_url( $src ); ?>" alt="">
                        <?php $index++; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <a class="left carousel-control" href="#slider-property" data-slide="prev">
                <span class="fa fa-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#slider-property" data-slide="next">
                <span class="fa fa-chevron-right"></span>
            </a>
        </div>
    </div><!-- /.property-gallery -->
<?php endif; ?>