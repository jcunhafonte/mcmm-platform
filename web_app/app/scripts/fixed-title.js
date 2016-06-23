'use strict';

$(document).ready(function () {
    $(window).bind('scroll', function (e) {
        scrollPosition();
    });
    readingBar();
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