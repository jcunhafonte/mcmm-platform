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
            $(".brand-img").attr("src", "images/logo_red.svg");
        } else {
            $('#topbar').removeClass('navbar-white');
            $('#topbar').addClass('navbar-transparent');
            $(".brand-img").attr("src", "images/logo-w.svg");
        }
    }

    videoCards();

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
                        $(".brand-img").attr("src", "images/logo_red.svg")
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

var i = 1;
var firstTime = {};
var id = "";

function videoCards() {

    var videos = $('.card-video').length;
    var url = "http://178.62.86.141/api/utilizadores/videos/video.mp4";

    for (i = 1; i <= videos; i++) {

        jwplayer("video-player-" + i).setup
        (
            {
                file: url,
                controls: false,
                autostart: true,
                mute: true,
                loop: true
            }
        );

        firstTime["video-player-" + i] = true;
        checkIfPlays(i);
    }

    $('.card-video').hover(function (event) {
        var video = $(this).data('video');

        if (jwplayer(video).getState() == "playing") {
            jwplayer(video).pause();
        } else {
            jwplayer(video).play();
        }
    });
}

function checkIfPlays(i) {
console.log(jwplayer("video-player-" + i).getState())
        if (firstTime["video-player-" + i] == true) {
            if (jwplayer("video-player-" + i).getState() !== "playing") {

                setTimeout(function () {
                    checkIfPlays(i);
                }, 400);

            } else {
                firstTime["video-player-" + i] = false;
                setTimeout(function () {
                    jwplayer("video-player-" + i).pause();
                }, 5000);
            }
        }
}