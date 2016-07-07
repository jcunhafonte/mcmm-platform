$(document).ready(function () {
    comments();
    likes();
});

function comments() {
    $('.btn-comments').click(function () {
        $('html, body').animate({
            scrollTop: $('#comments').offset().top - 160
        }, 750);
    });

    $('#submit_comment')
        .formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                comment: {
                    validators: {
                        notEmpty: {
                            message: 'Necessitas de introduzir um comentário'
                        }
                    }
                }
            }
        })
        .on('success.form.fv', function (e) {
            e.preventDefault();
            submitComment();
        });

    $(document).on('click', '.remove-comment', function (e) {
        $('#remove_comment_input').val($(this).attr('data-comment'));
    });

    $('#remove_comment').on('submit', function (e) {
        e.preventDefault();
        var commentRemoved = $('#remove_comment_input').val();
        $('#remove-comment').modal('hide');

        $.ajax({
            url: '/api/verificacoes/noticia/removerComentario.php',
            type: 'POST',
            data: 'comentario=' + commentRemoved + "&noticia=" + $('#id_noticia_comment').val(),
            success: function (data) {

                $('#comment-list-' + commentRemoved).fadeOut(1000);

                if (data == "1") {
                    var textoComentario = "1 Comentário";
                } else {
                    var textoComentario = data + " Comentários";
                }

                $('.total-comments').html(textoComentario);
                $('.number-comments').html(data);

                noty({
                    text: 'O teu comentário foi removido com <b>sucesso</b>!',
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


    $('.alert-comment').click(function () {
        $('#alert_comment_input').val($(this).attr('data-comment'));
    });

    $('#alert_comment').on('submit', function (e) {
        e.preventDefault();
        var commentAlert = $('#alert_comment_input').val();
        $('#alert-comment').modal('hide');

        $.ajax({
            url: '/api/verificacoes/noticia/denunciarComentario.php',
            type: 'POST',
            data: 'comentario=' + commentAlert + "&noticia=" + $('#id_noticia').val(),
            success: function (data) {
                noty({
                    text: 'A tua denúncia foi realizada com <b>sucesso</b>!',
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

}

function submitComment() {
    $.ajax({
        url: '/api/verificacoes/noticia/adicionarComentario.php',
        type: 'POST',
        data: 'noticia=' + $('#id_noticia_comment').val() + '&comentario=' + $('#comment').val(),
        success: function (data) {

            $('#comment').val('');
            $("#submit_comment").formValidation('resetForm', true);
            $(data).hide().appendTo('#box-comments').fadeIn(1000);

            var atualComments = (parseInt($('.total-comments').html()) +1);

            if (atualComments == 1) {
                var textoComentario = "1 Comentário";
            } else {
                var textoComentario = atualComments + " Comentários";
            }

            $('.total-comments').html(textoComentario);
            $('.number-comments').html(atualComments);

            noty({
                text: 'O teu comentário foi submetido com <b>sucesso</b>!',
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
}

function likes() {
    $('.heart-click').click(function (e) {

        e.stopImmediatePropagation();
        e.preventDefault();

        if ($('button .heart').hasClass("fa-heart-o")) {

            $('button .heart').switchClass("fa-heart-o", "fa-heart");

            $.ajax({
                url: '/api/verificacoes/noticia/adicionarGosto.php',
                type: 'POST',
                data: 'like=' + $('#id_noticia').val(),

                success: function (data) {
                    $('.total-likes').html(data);
                    noty({
                        text: 'O teu gosto foi submetido com <b>sucesso</b>!',
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

        } else {

            $('button .heart').switchClass("fa-heart", "fa-heart-o");

            $.ajax({
                url: '/api/verificacoes/noticia/removerGosto.php',
                type: 'POST',
                data: 'like=' + $('#id_noticia').val(),

                success: function (data) {
                    $('.total-likes').html(data);
                    noty({
                        text: 'O teu gosto foi removido com <b>sucesso</b>!',
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
        }

    });
}