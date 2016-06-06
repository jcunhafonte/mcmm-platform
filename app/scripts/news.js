'use strict';

$(document).ready(function () {
    var totalItems = $('#card-many-carousel .item').length;
    var currentIndex = $('#card-many-carousel div.active').index() + 1;

    $('#card-many-carousel').carousel({
        interval: 10000
    });

    $('.slide-number').html(''+currentIndex+'/'+totalItems+'');
    $('#card-many-carousel').bind('slid', function() {
        currentIndex = $('#card-many-carousel div.active').index() + 1;
        $('.slide-number').html(''+currentIndex+'/'+totalItems+'');
    });
});