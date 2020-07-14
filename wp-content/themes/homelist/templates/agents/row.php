<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="agent-container">
        <div class="agent-content-list">
            <div class="agent-image-list md-4">
	            <?php if ( has_post_thumbnail() ) :   ?>
			        <?php if ( has_post_thumbnail() ) : ?>
				        <a href="<?php the_permalink() ?>">
					        <?php the_post_thumbnail( 'large' ); ?>
				        </a>
			        <?php endif; ?>
	            <?php endif; ?>
                <div class="agent-actions">
                    <a href="mailto:<?php echo esc_attr( $email ); ?>" title="<?php esc_attr_e( 'Send E-mail', 'homelist' ); ?>"><i class="fa fa-at"></i>  <?php echo esc_html__( 'E-mail', 'homelist' ); ?></a>
                    <a href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'View Detail', 'homelist' ); ?>"><?php echo esc_html__( 'View', 'homelist' ); ?> <i class="flaticon-right-arrow-1"></i></a>
                </div>
            </div>
		    <?php $agent_title = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'title', true ); ?>
            <div class="agent-text md-4">
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <?php if ( ! empty( $agent_title ) ) : ?><small><?php echo esc_html( $agent_title ); ?></small><?php endif; ?></h3>
                <p><?php echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?></p>
                <div class="agent-attributes">
		            <?php $properties_count = Realia_Query::get_agent_properties()->post_count; ?>
		            <?php if ( $properties_count > 0 ) : ?>
			            <?php if ( ! empty( $properties_count ) ) : ?>
				            <span><i class="fa fa-home"></i> <?php echo esc_attr( $properties_count ); ?> <?php echo esc_html__( 'properties', 'homelist' ); ?></span>
			            <?php endif; ?>
		            <?php endif; ?>
                    <span><i class="fa fa-check"></i> 0 <?php echo esc_html__( 'sales', 'homelist' ); ?></span>
                </div>
            </div>
            <div class="agent-text md-4">
                <?php $email = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'email', true ); ?>
                <?php $web = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'web', true ); ?>
                <?php $phone = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'phone', true ); ?>
                <?php $address = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'address', true ); ?>

                <?php if ( ! empty( $email ) && ! empty( $web ) && ! empty( $phone ) && ! empty( $address ) ) :?>
                    <div class="agent-row-overview">
    	                <h3 class="agent-row-overview-title">
    		                <?php echo esc_html__( 'Contact Information', 'homelist' ); ?>
    	                </h3><!-- /.agency-row-overview -->

                        <dl>
                            <?php if ( ! empty( $email ) ) : ?>
                                <dt><?php echo esc_html__( 'Email', 'homelist' ); ?></dt>
    	                        <dd>
    		                        <a href="mailto:<?php echo esc_attr( $email ); ?>">
    		                            <?php echo esc_html( $email ); ?>
    		                        </a>
    	                        </dd>
                            <?php endif; ?>

                            <?php if ( ! empty( $web ) ) : ?>
                                <dt><?php echo esc_html__( 'Web', 'homelist' ); ?></dt>
    	                        <dd>
    		                        <a href="<?php echo esc_attr( $web ); ?>">
    		                            <?php echo esc_attr( $web ); ?>
    		                        </a>
    	                        </dd>
                            <?php endif; ?>

                            <?php if ( ! empty( $phone ) ) : ?>
                                <dt><?php echo esc_html__( 'Phone', 'homelist' ); ?></dt><dd><?php echo esc_attr( $phone ); ?></dd>
                            <?php endif; ?>

                            <?php if ( ! empty( $address ) ) : ?>
                                <dt><?php echo esc_html__( 'Address', 'homelist' )?></dt><dd><?php echo wp_kses( nl2br( $address ), wp_kses_allowed_html( 'post' ) ); ?></dd>
                            <?php endif; ?>
                        </dl>
                    </div><!-- /.agent-row-overview -->
                <?php endif;?>
            </div>
        </div>
    </div>
</div>
<!-- break -->

