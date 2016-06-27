'use strict';

$(document).ready(function () {

    $('body').addClass(navigator.appVersion + ' is-js');

    controlNavbar();
    checkTransparent();

    $(window).resize(function () {
        controlNavbar();
        checkTransparent();
        testLargeProject();
    });

    //TOPBAR
    $('#topbar').scrollupbar();

    function controlNavbar() {
        if ($(window).width() < 992) {
            $('#topbar').addClass('navbar-white');
            $('#topbar').removeClass('navbar-transparent');
            $(".brand-img").attr("src", "images/logo_yellow.svg");
        } else {
            $('#topbar').removeClass('navbar-white');
            $('#topbar').addClass('navbar-transparent');
            $(".brand-img").attr("src", "images/logo-w.svg");
        }
    }

    if ($(window).width() < 768) {
        $(".project-large").hover3d({
            selector: ".project__card",
            perspective: 0,
            invert: true
        });
        $(".project-small").hover3d({
            selector: ".project__card",
            perspective: 0,
            invert: true
        });
    } else {
        $(".project-large").hover3d({
            selector: ".project__card",
            perspective: 1680,
            invert: true
        });
    }
}); // Document ready

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
                        $(".brand-img").attr("src", "images/logo_yellow.svg")
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

function testLargeProject() {
    if ($(window).width() < 768) {
        $(".project-large").hover3d({
            selector: ".project__card",
            perspective: 0,
            invert: true
        });
        $(".project-small").hover3d({
            selector: ".project__card",
            perspective: 0,
            invert: true
        });
    } else {
        $(".project-large").hover3d({
            selector: ".project__card",
            perspective: 1680,
            invert: true
        });
    }
}