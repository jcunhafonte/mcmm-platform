'use strict';

$(document).ready(function () {

    $('#card-many-carousel-1').carousel({interval: 5000});
    $('#card-many-carousel-2').carousel({interval: 5000});
    $('#card-many-carousel-3').carousel({interval: 5000});

    var totalItems1 = $("#card-many-carousel-1 .item").length;
    var currentIndex1 = $("#card-many-carousel-1 div.active").index() + 1;
    $("#slide-number-1").html('' + currentIndex1 + '/' + totalItems1 + '');
    $("#card-many-carousel-1").bind('slid', function () {
        currentIndex1 = $("#card-many-carousel-1 div.active").index() + 1;
        $("#slide-number-1").html('' + currentIndex1 + '/' + totalItems1 + '');
    });

    var totalItems2 = $("#card-many-carousel-2 .item").length;
    var currentIndex2 = $("#card-many-carousel-2 div.active").index() + 1;
    $("#slide-number-2").html('' + currentIndex2 + '/' + totalItems2 + '');
    $("#card-many-carousel-2").bind('slid', function () {
        currentIndex2 = $("#card-many-carousel-2 div.active").index() + 1;
        $("#slide-number-2").html('' + currentIndex2 + '/' + totalItems2 + '');
    });

    var totalItems3 = $("#card-many-carousel-3 .item").length;
    var currentIndex3 = $("#card-many-carousel-3 div.active").index() + 1;
    $("#slide-number-3").html('' + currentIndex3 + '/' + totalItems3 + '');
    $("#card-many-carousel-3").bind('slid', function () {
        currentIndex3 = $("#card-many-carousel-3 div.active").index() + 1;
        $("#slide-number-3").html('' + currentIndex3 + '/' + totalItems3 + '');
    });

    var elem = document.querySelector('.masonry-container');
    var msnry = new Masonry(elem, {
        columnWidth: '.masonry',
        itemSelector: '.masonry'
    });
});

$(document).ready(function () {

    $('body').addClass(navigator.appVersion + ' is-js');

    controlNavbar();
    checkTransparent();

    $(window).resize(function () {
        controlNavbar();
        checkTransparent();
    });

    //TOPBAR
    $('#topbar').scrollupbar();

    function controlNavbar() {
        if ($(window).width() < 992) {
            $('#topbar').addClass('navbar-white');
            $('#topbar').removeClass('navbar-transparent');
            $(".brand-img").attr("src", "images/logo_green.svg");
        } else {
            $('#topbar').removeClass('navbar-white');
            $('#topbar').addClass('navbar-transparent');
            $(".brand-img").attr("src", "images/logo-w.svg");
        }
    }

    // Carousel
    $('.owl-carousel').owlCarousel({
        items: 1,
        loop: true,
        nav: false,
        dots: true,
        dotsContainer: '.dots-wrapper',
    });

    $('.owl-dots, #carousel .titles').addClass('container');
});

function checkTransparent() {

    var transparent = true;
    var hasTransparent = false;

    $(document).ready(function () {
        if ($('nav[role="navigation"]').hasClass('navbar-transparent')) {
            hasTransparent = true;
        }
    });

    $(document).scroll(function () {
        if (hasTransparent) {
            if ($(window).width() > 992) {
                if ($(this).scrollTop() > 280) {
                    if (transparent) {
                        transparent = false;
                        $('nav[role="navigation"]').removeClass('navbar-transparent');
                        $('nav[role="navigation"]').addClass('navbar-white');
                        $(".brand-img").attr("src", "images/logo_green.svg")
                    }
                } else {
                    if (!transparent) {
                        transparent = true;
                        $('nav[role="navigation"]').removeClass('navbar-white');
                        $('nav[role="navigation"]').addClass('navbar-transparent');
                        $(".brand-img").attr("src", "images/logo-w.svg")
                    }
                }
            }
        }
    });
}