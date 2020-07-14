<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php $create_page_id = get_theme_mod( 'realia_submission_create_page', null ); ?>

<?php if ( ! empty( $create_page_id ) ) : ?>
	<?php if ( Realia_Packages::is_allowed_to_add_submission( get_current_user_id() ) ) :   ?>
		<a href="<?php echo get_permalink( $create_page_id ); ?>" class="property-create btn btn-success"><?php echo esc_html__( 'Create Property', 'homelist' ); ?></a>
	<?php endif; ?>
<?php endif; ?>

<?php $paged = ( get_query_var( 'paged' )) ? get_query_var( 'paged' ) : 1; ?>

<?php query_posts( array(
	'post_type'     => 'property',
	'post_status'   => 'any',
	'paged'         => $paged,
	'author'        => get_current_user_id(),
) ); ?>

<?php if ( have_posts() ) : ?>
    <!-- begin:product -->
    <div class="row container-properties">
		<?php while ( have_posts() ) : the_post(); ?>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="property-container">
                    <div class="property-content-list">
                        <div class="property-image-list">
					        <?php if ( has_post_thumbnail() ) : ?>
						        <a href="<?php the_permalink(); ?>" class="property-table-info-image">
							        <?php the_post_thumbnail( 'medium' ); ?>
						        </a><!-- /.property-table-info-image -->
					        <?php else : ?>
						        <a href="<?php the_permalink(); ?>" class="property-table-info-image-none">
							        <?php echo esc_html__( 'No image', 'homelist' ); ?>
						        </a><!-- /.property-table-info-image-none -->
					        <?php endif; ?>
                            <div class="property-price">
			                    <?php $type = Realia_Query::get_property_type_name(); ?>
                                <?php if ( ! empty( $type ) ) : ?>
                                <h4><?php echo esc_attr( $type ); ?></h4>
                                <?php endif; ?>
						        <?php $price = Realia_Price::get_property_price(); ?>
						        <?php if ( ! empty( $price ) ) : ?>
							        <span>
								        <?php echo wp_kses( $price, wp_kses_allowed_html( 'post' ) ); ?>
							        </span>
						        <?php endif; ?>
                            </div>
                            <div class="property-status">
					            <?php if ( get_post_status() == 'pending' ) : ?>
						            <div class="ribbon warning">
						            </div><!-- /.ribbon -->
					            <?php elseif ( get_post_status() == 'publish' ) : ?>
						            <div class="ribbon publish"></div><!-- /.ribbon -->
					            <?php elseif ( get_post_status() == 'draft' ) : ?>
						            <div class="ribbon draft"></div><!-- /.ribbon -->
					            <?php endif; ?>
                                <?php $status = Realia_Query::get_property_status_name(); ?>
                                <?php if ( ! empty( $status ) ) : ?>
                                <span><?php echo wp_kses( $status, wp_kses_allowed_html( 'post' ) ); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="property-text">
                            <h3>
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> 
						        <?php $location = Realia_Query::get_property_location_name(); ?>
                                <?php $address = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'address', true ); ?>
						        <?php if ( ! empty( $address ) ) : ?>
							        <small>
								        <?php echo wp_kses( $address, wp_kses_allowed_html( 'post' ) ); ?>
							        </small>
						        <?php endif; ?>
                            </h3>
                            <p>
                                <?php echo wp_trim_words( get_the_content(), 10, '...' ); ?>
                            </p>

		                    <?php $area = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'home_area', true ); ?>
		                    <?php $rooms = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'rooms', true ); ?>
		                    <?php $beds = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'beds', true ); ?>
		                    <?php $baths = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'baths', true ); ?>
		                    <?php $garages = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'garages', true ); ?>

                            <?php if ( ! empty( $area ) || ! empty( $rooms ) || ! empty( $beds ) || ! empty( $baths ) || ! empty( $garages ) ) : ?>
                            <div class="property-attributes text-center">
                                <?php if ( ! empty( $area ) ) : ?>
                                <div class="col-xs-4">
                                    <h4><i class="flaticon-plans"></i> <?php echo wp_kses( $area, wp_kses_allowed_html( 'post' ) ); ?></h4>
                                    <p class="text-overflow" title="Square Feet"><?php echo get_theme_mod( 'realia_measurement_area_unit', 'Sq. Feet' ); ?></p>
                                </div>
                                <?php endif; ?>
                                <?php if ( ! empty( $beds ) ) : ?>
                                <div class="col-xs-4">
                                    <h4><i class="flaticon-bed"></i> <?php echo wp_kses( $beds, wp_kses_allowed_html( 'post' ) ); ?></h4>
                                    <p class="text-overflow" title="<?php echo esc_attr__( 'Bedrooms', 'homelist' ); ?>"><?php echo esc_html__( 'Bedrooms', 'homelist' ); ?></p>
                                </div>
                                <?php endif; ?>
                                <?php if ( ! empty( $baths ) ) : ?>
                                <div class="col-xs-4">
                                    <h4><i class="flaticon-bathtub"></i> <?php echo wp_kses( $baths, wp_kses_allowed_html( 'post' ) ); ?></h4>
                                    <p class="text-overflow" title="<?php echo esc_attr__( 'Bath', 'homelist' ); ?>"><?php echo esc_html__( 'Bath', 'homelist' ); ?></p>
                                </div>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
					        <div class="property-table-actions-inner">
						        <?php $payment_page_id = get_theme_mod( 'realia_submission_payment_page', null ); ?>

						        <?php if ( ! empty( $payment_page_id ) ) : ?>

							        <!-- STICKY -->
							        <?php $is_sticky = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'sticky', true ); ?>
							        <?php if ( ! $is_sticky ) : ?>
								        <?php $enable_sticky = get_theme_mod( 'realia_submission_enable_sticky', false ); ?>
								        <?php if ( ! empty( $enable_sticky ) ) : ?>
									        <?php $price = get_theme_mod( 'realia_submission_sticky_price', null ); ?>
									        <?php if ( ! empty( $price ) ) : ?>
										        <form method="post" action="<?php echo get_permalink( $payment_page_id ); ?>">
											        <input type="hidden" name="payment_type" value="pay_for_sticky">
											        <input type="hidden" name="object_id" value="<?php the_ID(); ?>">

											        <button type="submit" class="btn btn-success">
												        <?php echo esc_html__( 'Make TOP', 'homelist' ); ?> <span class="label label-primary"><?php echo Realia_Price::format_price( $price ); ?></span>
											        </button>
										        </form>
									        <?php endif; ?>
								        <?php endif; ?>
							        <?php else : ?>
								        <button class="disabled btn btn-success">
									        <?php echo esc_html__( 'Sticky', 'homelist' ); ?>
								        </button>
							        <?php endif; ?>

							        <!-- FEATURED -->
							        <?php $is_featured = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'featured', true ); ?>
							        <?php if ( ! $is_featured ) : ?>
								        <?php $enable_featured = get_theme_mod( 'realia_submission_enable_featured', false ); ?>
								        <?php if ( ! empty( $enable_featured ) ) : ?>
									        <?php $price = get_theme_mod( 'realia_submission_featured_price', null ); ?>

									        <?php if ( ! empty( $price ) ) : ?>
										        <form method="post" action="<?php echo get_permalink( $payment_page_id ); ?>">
											        <input type="hidden" name="payment_type" value="pay_for_featured">
											        <input type="hidden" name="object_id" value="<?php the_ID(); ?>">

											        <button type="submit" class="btn btn-success">
												        <?php echo esc_html__( 'Make featured', 'homelist' ); ?> <span class="label label-primary"><?php echo Realia_Price::format_price( $price ); ?></span>
											        </button>
										        </form>
									        <?php endif; ?>
								        <?php endif; ?>
							        <?php else : ?>
								        <button class="disabled btn btn-success">
									        <?php echo esc_html__( 'Featured', 'homelist' ); ?>
								        </button>
							        <?php endif; ?>

							        <!-- PUBLISHED -->
							        <?php $submission_type = get_theme_mod( 'realia_submission_type', false ); ?>
							        <?php $property_status = get_post_status(); ?>
							        <?php if ( 'publish' == $property_status ) : ?>
								        <button class="disabled btn btn-success">
									        <?php echo esc_html__( 'Published', 'homelist' ); ?>
								        </button>
							        <?php else : ?>
								        <!-- PAY PER POST -->
								        <?php if ( 'pay-per-post' == $submission_type ) : ?>
									        <?php $price = get_theme_mod( 'realia_submission_pay_per_post_price', null ); ?>
									        <?php if ( ! empty( $price ) ) : ?>
										        <form method="post" action="<?php echo get_permalink( $payment_page_id ); ?>">
											        <input type="hidden" name="payment_type" value="pay_per_post">
											        <input type="hidden" name="object_id" value="<?php the_ID(); ?>">

											        <button type="submit" class="btn btn-success">
												        <?php echo esc_html__( 'Publish', 'homelist' ); ?> <span class="label label-primary"><?php echo Realia_Price::format_price( $price ); ?></span>
											        </button>
										        </form>
									        <?php endif; ?>
								        <?php elseif ( 'packages' == $submission_type ) : ?>
									        <?php // Nothing to do ?>
								        <?php endif; ?>
							        <?php endif; ?>
						        <?php endif; ?>
					        </div><!-- /.property-table-actions-inner -->
                        </div>
                    </div>
                    <div class="property-actions">
					    <?php $edit_page_id = get_theme_mod( 'realia_submission_edit_page', null ); ?>

					    <?php if ( ! empty( $edit_page_id ) ) : ?>
						    <a href="<?php echo get_permalink( $edit_page_id ); ?>?id=<?php the_ID(); ?>" title="<?php esc_attr_e( 'Edit', 'homelist' ); ?>">
							    <i class="flaticon-edit"></i> <?php echo esc_html__( 'Edit', 'homelist' ); ?>
						    </a>
					    <?php endif; ?>

					    <?php $remove_page_id = get_theme_mod( 'realia_submission_remove_page', null ); ?>

					    <?php if ( ! empty( $remove_page_id ) ) : ?>
						    <a href="<?php echo get_permalink( $remove_page_id ); ?>?id=<?php the_ID(); ?>" title="<?php esc_attr_e( 'Remove', 'homelist' ); ?>" class="property-table-action property-button-delete">
							    <i class="flaticon-interface"></i> <?php echo esc_html__( 'Remove', 'homelist' ); ?>
						    </a>
					    <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- break -->
		<?php endwhile; ?>
    </div>
    <!-- end:container-properties -->

	<?php the_posts_pagination( array(
		'prev_text'          => esc_html__( 'Previous page', 'homelist' ),
		'next_text'          => esc_html__( 'Next page', 'homelist' ),
		'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'homelist' ) . ' </span>',
	) ); ?>

<?php else : ?>
	<div class="alert alert-warning">
		<p><?php echo esc_html__( 'You don\'t have any properties, yet. Start by creating new one.', 'homelist' ); ?></p>
	</div>
<?php endif; ?>
<?php wp_reset_query(); ?>
