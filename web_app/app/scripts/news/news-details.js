'use strict';

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

    if (!Modernizr.touch) {
         $('.parallax-background').parallax("50%", 0.5);
    }

    $('.next-page').mousemove(function(e){
        var amountMovedX = (e.pageX * -1 / 15);
        var amountMovedY = (e.pageY * -1 / 15);
        $('.image').css('background-position', amountMovedX + 'px ' + amountMovedY + 'px');
    });

    window.addEventListener('scroll', scrollBanner);

});

function scrollBanner() {
    var scrollPos = window.scrollY;
    var headerText = document.querySelector('.informations .texts');
    headerText.style.marginTop = -(scrollPos/3)+"px";
    headerText.style.opacity = 1-(scrollPos/480);
}

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