//VIDEO
$(document).on('click', '.remove-video', function (e) {
    $('#remove_video_input').val($(this).attr('data-video'));
});

$('#remove_video').on('submit', function (e) {
    e.preventDefault();
    var videoRemoved = $('#remove_video_input').val();
    $('#remove-video').modal('hide');

    $.ajax({
        url: '/api/verificacoes/video/remover.php',
        type: 'POST',
        data: "video=" + videoRemoved,
        success: function (data) {

            if (data == 0) {
                $('.videos .table-responsive').fadeOut(500);
                $('<p style="color: #2b2e33">Ainda não publicaste vídeos</p>').hide().appendTo('.videos').fadeIn(1000);

            } else {
                $('#video-list-' + videoRemoved).fadeOut(500);
            }

            noty({
                text: 'O teu vídeo foi removido com <b>sucesso</b>!',
                type: 'success',
                layout: 'topRight',
                theme: 'bootstrapTheme',
                animation: {
                    open: 'animated bounceInLeft',
                    close: 'animated bounceOutRight',
                    easing: 'swing',
                    speed: 250
                },
                timeout: 5000
            });
        }
    });
});

//PROJETO
$(document).on('click', '.remove-project', function (e) {
    $('#remove_project_input').val($(this).attr('data-project'));
});

$('#remove_project').on('submit', function (e) {
    e.preventDefault();
    var projectRemoved = $('#remove_project_input').val();
    $('#remove-project').modal('hide');

    $.ajax({
        url: '/api/verificacoes/projeto/remover.php',
        type: 'POST',
        data: "projeto=" + projectRemoved,
        success: function (data) {

            if (data == 0) {
                $('.projects .table-responsive').fadeOut(500);
                $('<p style="color: #2b2e33">Ainda não publicaste projetos</p>').hide().appendTo('.projects').fadeIn(500);

            } else {
                $('#project-list-' + projectRemoved).fadeOut(500);
            }

            noty({
                text: 'O teu projeto foi removido com <b>sucesso</b>!',
                type: 'success',
                layout: 'topRight',
                theme: 'bootstrapTheme',
                animation: {
                    open: 'animated bounceInLeft',
                    close: 'animated bounceOutRight',
                    easing: 'swing',
                    speed: 250
                },
                timeout: 5000
            });
        }
    });
});

//NOTICIA
$(document).on('click', '.remove-new', function (e) {
    $('#remove_new_input').val($(this).attr('data-new'));
});

$('#remove_new').on('submit', function (e) {
    e.preventDefault();
    var newRemoved = $('#remove_new_input').val();
    $('#remove-new').modal('hide');

    $.ajax({
        url: '/api/verificacoes/noticia/remover.php',
        type: 'POST',
        data: "noticia=" + newRemoved,
        success: function (data) {

            if (data == 0) {
                $('.news .table-responsive').fadeOut(500);
                $('<p style="color: #2b2e33">Ainda não publicaste notícias</p>').hide().appendTo('.news').fadeIn(500);

            } else {
                $('#new-list-' + newRemoved).fadeOut(500);
            }

            noty({
                text: 'A tua notícia foi removida com <b>sucesso</b>!',
                type: 'success',
                layout: 'topRight',
                theme: 'bootstrapTheme',
                animation: {
                    open: 'animated bounceInLeft',
                    close: 'animated bounceOutRight',
                    easing: 'swing',
                    speed: 250
                },
                timeout: 5000
            });
        }
    });
});