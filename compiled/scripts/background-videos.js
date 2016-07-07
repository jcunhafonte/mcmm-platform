'use strict';

$(document).ready(function () {
    videoCards();
});

var i = 1;
var firstTime = {};
var id = "";

function videoCards() {

    var videos = $('.card-video').length;

    for (i = 1; i <= videos; i++) {
        jwplayer("video-player-" + i).setup({
            file: $('#video-player-' + i).attr('data-url'),
            controls: false,
            autostart: true,
            mute: true,
            loop: true
        });
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

    setTimeout(function () {
        var elem = document.querySelector('.masonry-container');
        var msnry = new Masonry(elem, {
            columnWidth: '.masonry',
            itemSelector: '.masonry'
        });
    }, 200)
}

function checkIfPlays(i) {
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