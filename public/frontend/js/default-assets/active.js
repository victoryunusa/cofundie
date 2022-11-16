(function ($) {
    'use strict';

    var $constrom_window = $(window);

    // Preloader Active Code
    $constrom_window.on('load', function () {
        $('#preloader').fadeOut('slow', function () {
            $(this).remove();
        });
    });


    // ::  Sticky Header
    window.onscroll = function () {
        scrollFunction();
    };

    function scrollFunction() {
        if (
            document.body.scrollTop > 50 ||
            document.documentElement.scrollTop > 50
        ) {
            $(".site-header--sticky").addClass("scrolling");
        } else {
            $(".site-header--sticky").removeClass("scrolling");
        }
        if (
            document.body.scrollTop > 700 ||
            document.documentElement.scrollTop > 700
        ) {
            $(".site-header--sticky.scrolling").addClass("reveal-header");
        } else {
            $(".site-header--sticky.scrolling").removeClass("reveal-header");
        }
    }

    // :: Slimscroll Active Code
    if ($.fn.slimscroll) {
        $('#checout-image, #checkout-from').slimscroll({
            height: '700px',
            size: '4px',
            position: 'right',
            color: '#ccc',
            alwaysVisible: false,
            distance: '4px',
            railVisible: false,
            wheelStep: 15
        });
    }

    // :: Slimscroll Active Code
    if ($.fn.slimscroll) {
        $('#checout-box').slimscroll({
            height: '430px',
            size: '4px',
            position: 'right',
            color: '#ccc',
            alwaysVisible: false,
            distance: '2px',
            railVisible: false,
            wheelStep: 15
        });
    }

     // :: Slimscroll Active Code
     if ($.fn.slimscroll) {
        $('#share-product').slimscroll({
            height: '580px',
            size: '4px',
            position: 'right',
            color: '#ccc',
            alwaysVisible: false,
            distance: '2px',
            railVisible: false,
            wheelStep: 15
        });
    }

    // :: Faq Active Code

    if ($.fn.owlCarousel) {
        var topsellerSlider = $('.gallery-slider');
        topsellerSlider.owlCarousel({
            items: 3,
            loop: true,
            autoplay: true,
            smartSpeed: 1500,
            margin: 30,
            dots: true,
            nav:false,

            responsive: {
                0: {
                    items: 1
                },
                 480: {
                    items: 1
                },
                768: {
                    items: 2
                },
                992: {
                    items: 2
                },
                1200: {
                    items: 3
                }
            }
        });
    }


})(jQuery)
