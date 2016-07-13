$(document).ready(function () {
    hideModals();
    settings();
    cardSlider();
    modalRecover();
    emojis();
});

function hideModals() {
    $('#loginModal').on('hide.bs.modal', function () {
        $('#loginForm').formValidation('resetForm', true);
        $("#signupForm").formValidation('resetForm', true);
        $("#signupFormEnd").formValidation('resetForm', true);
    });

    $('#edit-settings').on('hide.bs.modal', function () {
        $('#edit_settings').formValidation('resetForm', true);
    });
}

function settings() {
    $('#edit_settings')
        .formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                atual_password: {
                    validators: {
                        notEmpty: {
                            message: 'Necessitas de introduzir uma palavra-passe'
                        },
                        remote: {
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                            },
                            url: "/api/verificacoes/verificaPassword.php",
                            data: {
                                type: 'password'
                            },
                            message: 'A palavra-passe introduzida não se encontra correta',
                            type: 'POST'
                        }
                    }
                },
                new_password: {
                    validators: {
                        notEmpty: {
                            message: 'Necessitas de introduzir uma palavra-passe'
                        },
                        callback: {
                            callback: function (value, validator, $field) {
                                var password = $field.val();
                                if (password == '') {
                                    return true;
                                }

                                var result = zxcvbn(password),
                                    score = result.score,
                                    message = 'Esta palavra-passe é fraca' || 'Esta palavra-passe é fraca';

                                // Update the progress bar width and add alert class
                                var $bar = $('#strengthBar');
                                switch (score) {
                                    case 0:
                                        $bar.attr('class', 'progress-bar progress-bar-danger')
                                            .css('width', '1%');
                                        break;
                                    case 1:
                                        $bar.attr('class', 'progress-bar progress-bar-danger')
                                            .css('width', '25%');
                                        break;
                                    case 2:
                                        $bar.attr('class', 'progress-bar progress-bar-danger')
                                            .css('width', '50%');
                                        break;
                                    case 3:
                                        $bar.attr('class', 'progress-bar progress-bar-warning')
                                            .css('width', '75%');
                                        break;
                                    case 4:
                                        $bar.attr('class', 'progress-bar progress-bar-success')
                                            .css('width', '100%');
                                        break;
                                }

                                // We will treat the password as an invalid one if the score is less than 3
                                if (score < 3) {
                                    return {
                                        valid: false,
                                        message: message
                                    }
                                }

                                return true;
                            }
                        }
                    }
                },
                confirm_new_password: {
                    validators: {
                        identical: {
                            field: 'new_password',
                            message: 'As palavras-passes introduzidas não coincidem'
                        }
                    }
                }
            }
        })
        .on('success.form.fv', function (e) {
            e.preventDefault();
            submitSettings();
        });
}

function submitSettings() {
    var formData = new FormData($("#edit_settings")[0]);

    $.ajax({
        url: '/api/verificacoes/changePassword.php',
        type: 'POST',
        data: formData,
        success: function (data) {

            if (data === "yes") {
                $('#edit-settings').modal('hide');

                noty({
                    text: 'As tuas definições foram atualizadas com <b>sucesso</b>!',
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
            } else {
                noty({
                    text: 'Ocorreu um <b>problema</b> ao atualizar as tuas definições! <br/>' +
                    'Verifica se introduziste os teus dados corretamente.',
                    type: 'error',
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
        },
        cache: false,
        contentType: false,
        processData: false
    });
}

function redirectVideo(data) {
    setTimeout(function () {
        location.href = "/video/" + data;
    }, 100);
}

function redirectProjects(data) {
    setTimeout(function () {
        location.href = "/project/" + data;
    }, 100);
}

function redirectNews(data) {
    setTimeout(function () {
        location.href = "/new/" + data;
    }, 100);
}

function cardSlider() {
    $(".card-many").click(function (e) {
        var senderElement = e.target.className;

        if (senderElement == "icone pe-7s-angle-right") {
        } else {
            if (senderElement == "icone pe-7s-angle-left") {

            } else {
                var clickedId = e.currentTarget.id;
                window.location = '/new/' + clickedId;
            }
        }


        return true;
    });
}

function modalRecover() {

    $('.recover-password').on('click', function () {
        $('#loginModal').modal('hide');
        $('.registerBox-2').css('display', 'block');
        $('#recover-password').modal('show');
        $('.modal-title').html('Palavra-passe');
    });

    $('#recover_password')
        .formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                email_recover: {
                    validators: {
                        notEmpty: {
                            message: 'Necessitas de introduzir um email'
                        },
                        regexp: {
                            regexp: /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/,
                            message: 'O email introduzido não é válido'
                        },
                        remote: {
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                            },
                            url: "api/verificacoes/verificaRecuperacaoEmail.php",
                            data: {
                                type: 'username'
                            },
                            message: 'Este email não se encontra registado na nossa plataforma',
                            type: 'POST'
                        }
                    }
                }
            }
        })
        .on('success.form.fv', function (e) {
            e.preventDefault();
            submitRecover();
        });
}

function submitRecover() {
    var formData = "email=" + $('.email_recover').val();

    $.ajax({
        url: '/api/verificacoes/recuperaEmail.php',
        type: 'POST',
        data: formData,
        success: function (data) {
            if (data === "yes") {
                $('#recover-password').modal('hide');

                noty({
                    text: 'Acede ao teu email para completares a <b>recuperação</b> da tua palavra-passe',
                    type: 'success',
                    layout: 'topRight',
                    theme: 'bootstrapTheme',
                    animation: {
                        open: 'animated bounceInLeft',
                        close: 'animated bounceOutRight',
                        easing: 'swing',
                        speed: 250
                    },
                    timeout: 7000
                });
            } else {
            }
        }
    });
}

function emojis() {
    
    if ($(".wdt-emoji-bundle-enabled")[0]) {
        wdtEmojiBundle.defaults.emojiSheets = {'twitter': '/images/sheets/sheet_twitter_64.png'};
        wdtEmojiBundle.changeType('twitter');
        wdtEmojiBundle.init('.wdt-emoji-bundle-enabled');
        var ev = new Event('input');
    }

    if ($(".comment-text")[0]) {
        var users = document.getElementsByClassName('comment-text');
        for (var i = 0; i < users.length; ++i) {
            var user = users[i];
            user.innerHTML = wdtEmojiBundle.render(user.innerHTML);
        }
    }

    setTimeout(function () {
        $("h3[data-emoji-group='People']").html('Pessoas');
        $("h3[data-emoji-group='Nature']").html('Natureza');
        $("h3[data-emoji-group='Foods']").html('Comida');
        $("h3[data-emoji-group='Activity']").html('Atividades');
        $("h3[data-emoji-group='Places']").html('Espaços');
        $("h3[data-emoji-group='Objects']").html('Objetos');
        $("h3[data-emoji-group='Symbols']").html('Símbolos');
        $("h3[data-emoji-group='Flags']").html('Bandeiras');
    }, 500);
}