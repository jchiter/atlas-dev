<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-content">
        <div class="row">
            <div class="col-sm-4">
                <div class="agency-header">
                    <div class="agency-thumbnail">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'thumbnail' ); ?>
                        <?php endif; ?>
                    </div>

                    <div class="agency-overview">
                        <dl>
                            <?php $email = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'email', true ); ?>
                            <?php if ( ! empty( $email ) ) : ?>
                                <dt><?php echo esc_html__( 'Email', 'homelist' ); ?></dt><dd><?php echo esc_attr( $email ); ?></dd>
                            <?php endif; ?>

                            <?php $web = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'web', true ); ?>
                            <?php if ( ! empty( $web ) ) : ?>
                                <dt><?php echo esc_html__( 'Web', 'homelist' ); ?></dt><dd><?php echo esc_attr( $web ); ?></dd>
                            <?php endif; ?>

                            <?php $phone = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'phone', true ); ?>
                            <?php if ( ! empty( $phone ) ) : ?>
                                <dt><?php echo esc_html__( 'Phone', 'homelist' ); ?></dt><dd><?php echo esc_attr( $phone ); ?></dd>
                            <?php endif; ?>

                            <?php $address = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'address', true ); ?>
                            <?php if ( ! empty( $address ) ) : ?>
                                <dt><?php echo esc_html__( 'Address', 'homelist' )?></dt><dd><?php echo wp_kses( nl2br( $address ), wp_kses_allowed_html( 'post' ) ); ?></dd>
                            <?php endif; ?>
                        </dl>
                    </div><!-- /.agency-overview -->

                    <div class="agency-social-networks">
                        <?php $social_networks = apply_filters( 'realia_social_networks', array() ); ?>
                        <?php foreach( $social_networks as $key => $title ): ?>
                            <?php $network = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'social_' . $key, true ); ?>
                            <?php if ( ! empty( $network ) ) : ?>
                                <a href="<?php echo esc_attr( $network ); ?>" class="agency-social-network <?php echo esc_attr( $key ); ?>" target="_blank"></a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div><!-- /.agent-social-networks -->
                </div><!-- /.agency-header -->
            </div><!-- /.col-sm-4 -->
            <div class="col-sm-8">
                <?php the_content( sprintf( esc_html__( 'Continue reading %s', 'homelist' ), the_title( '<span class="screen-reader-text">', '</span>', false ) ) ); ?>
            </div><!-- /.col-sm-8 -->
        </div><!-- /.row -->
        <?php if ( is_single() ) : ?>
            <!-- Agency's location -->
            <?php $location = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'location', true ); ?>

            <?php if ( ! empty( $location ) && 2 == count( $location ) ) : ?>

                <h2 class="section-title"><?php echo esc_html__( 'Location', 'homelist' ); ?></h2>
                <hr>

                <!-- MAP -->
                <div class="map-position">
                    <div id="simple-map"
                         data-latitude="<?php echo esc_attr( $location['latitude'] ); ?>"
                         data-longitude="<?php echo esc_attr( $location['longitude'] ); ?>">
                    </div><!-- /#map-property -->
                </div><!-- /.map-property -->
            <?php endif; ?>

            <!-- Agency's agents -->
            <?php Realia_Query::loop_agency_agents(); ?>

            <?php if ( have_posts() ) : ?>
                <h2 class="section-title"><?php echo esc_html__( 'Representatives', 'homelist' ); ?></h2>
                <hr>
                <div class="agency-agents type-box item-per-row-3">
	                <div class="row">
		                <?php $index = 0; ?>
	                    <?php while ( have_posts() ) : the_post(); ?>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <?php get_template_part( 'templates/agents/box', '' ); ?>
                            </div>

			                <?php if ( 0 == ( ( $index + 1 ) % 3 ) && Realia_Query::loop_has_next() ) : ?>
		                        </div><div class="agents-row">
			                <?php endif; ?>

			                <?php $index++; ?>
	                    <?php endwhile; ?>
	                </div><!-- /.agents-row -->
                </div><!-- /.agency-agents -->
            <?php endif;?>

            <?php wp_reset_query(); ?>
        <?php endif; ?>

        <?php wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'homelist' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'homelist' ) . ' </span>%',
			'separator'   => '<span class="screen-reader-text">, </span>',
		) ); ?>

        <?php if ( comments_open() || get_comments_number() ) : ?>
            <div class="box"><?php comments_template( '', true ); ?></div>
        <?php endif; ?>
    </div><!-- .entry-content -->
</article><!-- #post-## -->
