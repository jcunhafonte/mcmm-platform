'use strict';

$(document).ready(function () {
    $(window).bind('scroll', function (e) {
        scrollPosition();
    });
    readingBar();
    testTop();

    $(window).resize(function () {
        testVideo()
    });
});

var previous = window.scrollY;
var directionInfo = 'down';
var oldDirectionInfo = 'up';

function scrollPosition() {

    directionInfo = window.scrollY > previous ? 'down' : 'up';
    previous = window.scrollY;

    if (directionInfo !== '' && oldDirectionInfo !== '') {
        if (directionInfo !== oldDirectionInfo) {
            if (directionInfo == 'up' && oldDirectionInfo == 'down') {
                $('.fixed-title').fadeOut(300);
                $('#progress-wrapper').fadeOut(100);
            } else {
                if ($(window).scrollTop() >= 500) {
                    $('.fixed-title').fadeIn(300);
                    $('#progress-wrapper').fadeIn(100);

                    if ($(window).width() > 981) {
                        if (videoHeight !== 100) {
                            createBlankSplace(videoHeight);
                        }
                    } else {
                        $('.fixed-title').removeClass('fixed-title-video');
                    }
                } else {
                    scrollPosition();
                }
            }
        }
    }
    oldDirectionInfo = directionInfo;
}

function readingBar() {
    scrollProgress.set();
}

var stickySidebar;
var videoHeight = 0;

function testTop() {
    $(window).scroll(function () {
        testVideo();
    });
}

function createBlankSplace(data) {
    $('#video-wrapper').css('height', data);
}

function testVideo() {

    if ($(window).width() > 981) {

        stickySidebar = $('#header-page').offset().top - 150;
        videoHeight = $('#video-wrapper').outerHeight();

        if (directionInfo !== "up") {
            if ($(window).scrollTop() > stickySidebar) {
                $('#video-js').addClass('video-top');
                $('.fixed-title').addClass('fixed-title-video');
                $('body').addClass('fixed-title-video-ID');

            } else {
                $('.fixed-title').removeClass('fixed-title-video');
                $('#video-js').removeClass('video-top');
                $('body').removeClass('fixed-title-video-ID');
            }
        } else {
            $('#video-js').removeClass('video-top');
            $('body').removeClass('fixed-title-video-ID');
        }
    } else {
        $('.fixed-title').removeClass('fixed-title-video');
        $('#video-js').removeClass('video-top');
        $('body').removeClass('fixed-title-video-ID');
    }
}