<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="entry-content">
        <div class="row">
            <div class="col-sm-4">

                <div class="agent-header">
                    <div class="agent-thumbnail">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'thumbnail' ); ?>
                        <?php endif; ?>
                    </div>

                    <div class="agent-overview">
                        <dl>
                            <?php $email = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'email', true ); ?>
                            <?php if ( ! empty( $email ) ) : ?>
                                <dt><?php echo esc_html__( 'Email', 'homelist' ); ?></dt><dd><?php echo esc_attr( $email ); ?></dd>
                            <?php endif; ?>

                            <?php $web = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'web', true ); ?>
                            <?php if ( ! empty( $web ) ) : ?>
                                <dt><?php echo esc_html__( 'Web', 'homelist' ); ?></dt><dd><?php echo esc_attr( $web ); ?></dd>
                            <?php endif; ?>

                            <?php $phone = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'phone', true ); ?>
                            <?php if ( ! empty( $phone ) ) : ?>
                                <dt><?php echo esc_html__( 'Phone', 'homelist' ); ?></dt><dd><?php echo esc_attr( $phone ); ?></dd>
                            <?php endif; ?>

                            <?php $address = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'address', true ); ?>
                            <?php if ( ! empty( $address ) ) : ?>
                                <dt><?php echo esc_html__( 'Address', 'homelist' )?></dt><dd><?php echo wp_kses( nl2br( $address ), wp_kses_allowed_html( 'post' ) ); ?></dd>
                            <?php endif; ?>
                        </dl>
                    </div><!-- /.agent-overview -->

                    <div class="agent-social-networks">
                        <?php $social_networks = apply_filters( 'realia_social_networks', array() ); ?>
                        <?php foreach( $social_networks as $key => $title ): ?>
                            <?php $network = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'social_' . $key, true ); ?>
                            <?php if ( ! empty( $network ) ) : ?>
                                <a href="<?php echo esc_attr( $network ); ?>" class="agent-social-network <?php echo esc_attr( $key ); ?>" target="_blank"></a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div><!-- /.agent-social-networks -->
                </div><!-- /.agent-header -->
            </div><!-- /.col-sm-4 -->
            <div class="col-sm-8">
                <?php the_content( sprintf( esc_html__( 'Continue reading %s', 'homelist' ), the_title( '<span class="screen-reader-text">', '</span>', false ) ) ); ?>
            </div><!-- /.col-sm-8 -->
        </div><!-- /.row -->

        <?php if ( is_single() ) : ?>
            <?php Realia_Query::loop_agent_properties(); ?>

            <?php if ( have_posts() ) : ?>
                <h2 class="section-title"><?php echo esc_html__( 'Properties', 'homelist' ); ?></h2>
                <hr>
                <div class="agent-properties">
                    <div class="row">
                        <?php $index = 0; ?>
                        <?php while ( have_posts() ) : the_post(); ?>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <?php echo Realia_Template_Loader::load( 'properties/box' ); ?>
                        </div>
                        <?php if ( 0 == ( ( $index + 1 ) % 4 ) && Realia_Query::loop_has_next() ) : ?>
                            </div><div class="row">
                        <?php endif; ?>

                        <?php $index++; ?>
                        <?php endwhile; ?>
                    </div><!-- /.row -->
                </div><!-- /.agent-properties -->
            <?php endif;?>

            <?php wp_reset_query(); ?>
        <?php endif; ?>

        <?php get_template_part( 'templates/agents/contact', 'form' ); ?>

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