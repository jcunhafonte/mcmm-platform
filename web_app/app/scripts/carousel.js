'use strict';

$(document).ready(function () {

// Carousel
    $('.owl-carousel').owlCarousel({
        items: 1,
        loop: true,
        nav: false,
        dots: true,
        dotsContainer: '.dots-wrapper',
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            }
        }
    });

    $('.owl-dots, #carousel .titles').addClass('container');

});