<?php

/*
Template Name: Contact
*/

get_header(); ?>


<section class="contact-section">
    <?php $title_text = get_theme_mod( 'homelist_contact_title_text' ); ?>
    <?php if ( ! empty( $title_text ) ) : ?>
    <div class="title-text"><?php echo esc_html( $title_text ) ?></div>
    <?php endif; ?>

    <div class="row clearfix">

        <!--Contact Info-->
        <?php $address1 = get_theme_mod( 'homelist_contact_address1' ); ?>
        <?php $address2 = get_theme_mod( 'homelist_contact_address2' ); ?>
        <?php if ( ! empty( $address1 ) || ! empty( $address2 ) ) : ?>
        <div class="contact-info col-md-4 col-sm-6 col-xs-12">
            <div class="inner">
                <div class="icon-box">
                    <span class="flaticon-pin"></span>
                </div>
                <h3><?php esc_html_e( 'Our Address', 'homelist' ); ?></h3>
                <div class="text"><?php echo esc_html( $address1 ) ?> <br> <?php echo esc_html( $address2 ) ?></div>
            </div>
        </div>
        <?php endif; ?>

        <!--Contact Info-->
        <?php $phone1 = get_theme_mod( 'homelist_contact_phone1' ); ?>
        <?php $email1 = get_theme_mod( 'homelist_contact_email1' ); ?>
        <?php if ( ! empty( $phone1 ) || ! empty( $email1 ) ) : ?>
        <div class="contact-info col-md-4 col-sm-6 col-xs-12">
            <div class="inner">
                <div class="icon-box">
                    <span class="flaticon-headset"></span>
                </div>
                <h3><?php esc_html_e( 'Phone &amp; Email', 'homelist' ); ?></h3>
                <div class="text"><?php echo esc_html( $phone1 ) ?><br> <?php echo esc_html( $email1 ) ?></div>
            </div>
        </div>
        <?php endif; ?>

        <!--Contact Info-->
        <?php $twitter = get_theme_mod( 'homelist_social_links_twitter' ); ?>
        <?php $google_plus = get_theme_mod( 'homelist_social_links_google-plus' ); ?>
        <?php $pinterest = get_theme_mod( 'homelist_social_links_pinterest' ); ?>
        <?php if ( ! empty( $twitter ) || ! empty( $google_plus ) || ! empty( $pinterest ) ) : ?>
        <div class="contact-info col-md-4 col-sm-6 col-xs-12">
            <div class="inner">
                <div class="icon-box">
                    <span class="flaticon-share-1"></span>
                </div>
                <h3><?php esc_html_e( 'Stay In Touch', 'homelist' ); ?></h3>
                <div class="text"><?php esc_html_e( 'Also find us on social Media', 'homelist' ); ?></div>

                <div class="social-icon-three clearfix">
                    <a href="<?php echo esc_url( $email1 ) ?>"><span class="fa fa-twitter"></span></a>
                    <a href="<?php echo esc_url( $google_plus ) ?>"><span class="fa fa-google-plus"></span></a>
                    <a href="<?php echo esc_url( $pinterest ) ?>"><span class="fa fa-pinterest"></span></a>
                </div>

            </div>
        </div>
        <?php endif; ?>
    </div>
    
</section>


<div class="contact-form-section">
    
    <div class="row clearfix">
        <div class="column col-md-7 col-sm-12 col-xs-12">
            <!--Contact Form-->
            <div class="contact-form">
                <h3 class="heading"><?php esc_html_e( 'What is your question about?', 'homelist' ); ?></h3>
                <?php
                if ( have_posts() ) :
	                while ( have_posts() ) : the_post();
		                the_content();
	                endwhile;
                else :
	                esc_html_e( 'Sorry, no posts were found', 'homelist' );
                endif;
                ?>
            </div>
            <!--End Contact Form-->
        </div>
        <!--Column-->
        <div class="column col-md-5 col-sm-12 col-xs-12">
            <div class="contact-content">
                <h3><?php esc_html_e( 'Have You Any Question About Us?', 'homelist' ); ?></h3>
                <div class="text">
                    <p><?php esc_html_e( 'Any kind of business solution and consultion don\'t hesitate to contact with us for imiditate customer support. We are love to hear from you', 'homelist' ); ?></p>
                    <p><span><?php esc_html_e( 'Office Hours:', 'homelist' ); ?></span> <?php esc_html_e( 'We are alwyes open excpet Saturday and Sunday from 10:00am to 8:00pm', 'homelist' ); ?></p>
                </div>
            </div>
        </div>
    </div>
    
</div>


<section class="map-section">
    <!--Map Outer-->
    <div class="map-outer">
        <!--Map Canvas-->
        <?php if (function_exists('homelist_google_map')) { ?>
        <?php echo homelist_google_map(); ?>
        <?php } ?>
    </div>
</section>

<?php get_footer(); ?>
