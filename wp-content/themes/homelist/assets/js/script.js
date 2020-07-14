jQuery.noConflict();
jQuery(document).ready(function ($) {
    'use strict';

    $('.navbar a.dropdown-toggle').on('click', function (e) {
        var $el = $(this);
        var $parent = $(this).offsetParent(".dropdown-menu");
        $(this).parent("li").toggleClass('open');

        if (!$parent.parent().hasClass('nav')) {
            $el.next().css({ "top": $el[0].offsetTop, "left": $parent.outerWidth() - 4 });
        }

        $('.nav li.open').not($(this).parents("li")).removeClass("open");

        return false;
    });

    $('#bootstrap-touch-slider').bsTouchSlider();

    $(".slick-slider").slick({
        dots: false,
        autoplay: true,
        autoplaySpeed: 3000,
        pauseOnFocus: false,
        pauseOnHover: false,
        pauseOnDotsHover: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        cssEase: 'linear'
    });

    /* carousel testimony */
    $('#testimonials').carousel({
        interval: 6000
    });

    /* scrolltop */
    $('.scroltop').on('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });


    /* masonry layout */
    var $container = $('.container-properties');
    $container.imagesLoaded( function(){
        $container.masonry();
    });


    /* modal */
    $('.modal').on('shown.bs.modal', function () {
        var curModal = this;
        $('.modal').each(function(){
            if(this != curModal){
                $(this).modal('hide');
            }
        });
    });


    /* tooltip */
    $('[rel="tooltip"]').tooltip();

    /* carousel single */
    $('#slider-property').carousel({
        interval: 6500
    });


    /*----------------------------------------------------*/
    /*  Mortgage Calculator
	/*----------------------------------------------------*/

    // Gets property price
    var propertyPricing = parseFloat($('.property-price').text().replace(/[^0-9\.]+/g, ""));
    if (propertyPricing > 0) {
        $('.pick-price').on('click', function () {
            $('#amount').val(parseInt(propertyPricing));
        });
    }

    // replacing comma with dot

    $('.mortgage-calculator').on('change', '#interest', function () {
        $("#interest").val($("#interest").val().replace(/,/g, '.'));
    });

    // Calculator
    function calculate_mortgage() {

        var amount = parseFloat($("#amount").val().replace(/[^0-9\.]+/g, "")),
			months = parseFloat($("#years").val().replace(/[^0-9\.]+/g, "") * 12),
			down = parseFloat($("#downpayment").val().replace(/[^0-9\.]+/g, "")),
			annInterest = parseFloat($("#interest").val().replace(/[^0-9\.]+/g, "")),
			monInt = annInterest / 1200,
			calculation = ((monInt + monInt / (Math.pow(1 + monInt, months) - 1)) * (amount - (down || 0))).toFixed(2);

        if (calculation > 0) {
            $(".calc-output-container").css({ 'opacity': '1', 'max-height': '200px' });
            $(".calc-output").hide().html(calculation + ' ' + $('.mortgage-calculator').attr("data-calc-currency")).fadeIn(300);
        }
    }

    // Calculate
    $('.calc-button').on('click', function () {
        calculate_mortgage();
    });
});