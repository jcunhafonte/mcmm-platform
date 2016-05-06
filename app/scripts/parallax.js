'use strict';

$(document).ready(function () {

    redrawDotNav();

    /* Scroll event handler */
    $(window).bind('scroll', function (e) {
        redrawDotNav();
    });

    $('a.sobre').click(function () {
        $('html, body').animate({
            scrollTop: $('#sobre').offset().top
        }, 1000, function () {
        });
        return false;
    });
    $('a.candidaturas').click(function () {
        $('html, body').animate({
            scrollTop: $('#candidaturas').offset().top
        }, 1000, function () {
        });
        return false;
    });
    $('a.programa-curricular').click(function () {
        $('html, body').animate({
            scrollTop: $('#programa-curricular').offset().top
        }, 1000, function () {
        });
        return false;
    });
    $('a.canal').click(function () {
        $('html, body').animate({
            scrollTop: $('#canal').offset().top
        }, 1000, function () {
        });
        return false;
    });
    $('a.noticias').click(function () {
        $('html, body').animate({
            scrollTop: $('#noticias').offset().top
        }, 1000, function () {
        });
        return false;
    });
    $('a.projetos').click(function () {
        $('html, body').animate({
            scrollTop: $('#projetos').offset().top
        }, 1000, function () {
        });
        return false;
    });
    $('a.alunos').click(function () {
        $('html, body').animate({
            scrollTop: $('#alunos').offset().top
        }, 1000, function () {
        });
        return false;
    });
    $('a.aplicacao').click(function () {
        $('html, body').animate({
            scrollTop: $('#aplicacao').offset().top
        }, 1000, function () {
        });
        return false;
    });
    $('a.informacoes').click(function () {
        $('html, body').animate({
            scrollTop: $('#informacoes').offset().top
        }, 1000, function () {
        });
        return false;
    });

    /* Show/hide dot lav labels on hover */
    $('nav#primary a').hover(
        function () {
            $(this).prev('h1').show();
        },
        function () {
            $(this).prev('h1').hide();
        }
    );

});

/* Set navigation dots to an active state as the user scrolls */
function redrawDotNav() {
    var section1Top = $('#sobre').offset().top - (($('#video').offset().top));
    var section2Top = $('#candidaturas').offset().top - (($('#programa-curricular').offset().top - $('#candidaturas').offset().top) / 2);
    var section3Top = $('#programa-curricular').offset().top - (($('#canal').offset().top - $('#programa-curricular').offset().top) / 2);
    var section4Top = $('#canal').offset().top - (($('#noticias').offset().top - $('#canal').offset().top) / 2);
    var section5Top = $('#noticias').offset().top - (($('#projetos').offset().top - $('#noticias').offset().top) / 2);
    var section6Top = $('#projetos').offset().top - (($('#alunos').offset().top - $('#projetos').offset().top) / 2);
    var section7Top = $('#alunos').offset().top - (($('#aplicacao').offset().top - $('#alunos').offset().top) / 2);
    var section8Top = $('#aplicacao').offset().top - (($('#informacoes').offset().top - $('#aplicacao').offset().top) / 2);
    var section9Top = $('#informacoes').offset().top - (($(document).height() - $('#informacoes').offset().top) / 2);

    $('nav#primary a').removeClass('active');
    if ($(document).scrollTop() >= section1Top && $(document).scrollTop() < section2Top) {
        $('nav#primary a.sobre').addClass('active');
    } else if ($(document).scrollTop() >= section2Top && $(document).scrollTop() < section3Top) {
        $('nav#primary a.candidaturas').addClass('active');
    } else if ($(document).scrollTop() >= section3Top && $(document).scrollTop() < section4Top) {
        $('nav#primary a.programa-curricular').addClass('active');
    } else if ($(document).scrollTop() >= section4Top && $(document).scrollTop() < section5Top) {
        $('nav#primary a.canal').addClass('active');
    } else if ($(document).scrollTop() >= section5Top && $(document).scrollTop() < section6Top) {
        $('nav#primary a.noticias').addClass('active');
    } else if ($(document).scrollTop() >= section6Top && $(document).scrollTop() < section7Top) {
        $('nav#primary a.projetos').addClass('active');
    } else if ($(document).scrollTop() >= section7Top && $(document).scrollTop() < section8Top) {
        $('nav#primary a.alunos').addClass('active');
        console.log('C')
    } else if ($(document).scrollTop() >= section8Top && $(document).scrollTop() < section9Top) {
        console.log('b')
        $('nav#primary a.aplicacao').addClass('active');
    } else if ($(document).scrollTop() >= section9Top) {
        console.log('a')
        $('nav#primary a.informacoes').addClass('active');
    }

}
