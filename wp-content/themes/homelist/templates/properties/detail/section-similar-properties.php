<!-- SIMILAR PROPERTIES -->
<?php Realia_Query::loop_properties_similar(); ?>

<?php if ( have_posts() ) : ?>
    <div class="similar-properties">
        <?php if ( ! empty( $section_title ) ): ?><h2><?php echo esc_attr( $section_title ); ?></h2><?php endif; ?>

        <div class="type-box item-per-row-3">
            <div class="row">
                <?php $index = 0; ?>
                <?php while ( have_posts() ) : the_post(); ?>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <?php echo Realia_Template_Loader::load( 'properties/box' ); ?>
                </div>

                <?php if ( 0 == ( ( $index + 1 ) % 3 ) && Realia_Query::loop_has_next() ) : ?>
            </div><div class="row">
                <?php endif; ?>
                <?php $index++; ?>
                <?php endwhile; ?>
            </div>
        </div>
    </div><!-- /.similar-properties -->
<?php endif?>

<?php wp_reset_query(); ?>