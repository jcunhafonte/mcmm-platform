$(document).ready(function () {
    modalSettings();
});

function modalSettings() {
    $('#edit_settings')
        .formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                atual_password:{
                    validators: {
                        notEmpty: {
                            message: 'Necessitas de introduzir uma palavra-passe'
                        },
                        remote: {
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                            },
                            url: "http://178.62.86.141/api/verificacoes/verificaPassword.php",
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
        url: 'http://178.62.86.141/api/verificacoes/changePassword.php',
        type: 'POST',
        data: formData,
        success: function (data) {
            
            if(data === "yes"){
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
            }else{
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