'use strict';

$(document).ready(function () {

// Carousel
    $('.owl-carousel').owlCarousel({
        items: 1,
        loop: true,
        nav: false,
        dots: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            }
        }
    });

    $('.owl-dots, #carousel h2').addClass('container');

});