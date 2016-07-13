$(window).load(function () {

    $('#conclusion-facebook').modal('show');

    $('#signup_facebook')
        .formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh glyphicon-refresh-animate'
            },
            fields: {
                utilizador_signupEnd: {
                    validators: {
                        notEmpty: {
                            message: 'Necessitas de introduzir um nome de utilizador'
                        },
                        remote: {
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                            },
                            url: "api/verificacoes/verificaUserID.php",
                            data: {
                                type: 'username'
                            },
                            message: 'O nome de utilizador introduzido já se encontra registado',
                            type: 'POST'
                        }
                    }
                },
                nome: {
                    validators: {
                        notEmpty: {
                            message: 'Necessitas de introduzir um nome'
                        },
                        regexp: {
                            regexp: /^[A-zÀ-ú]+[\s|,][A-zÀ-ú]{1,19}$/,
                            message: 'Deves introduzir um nome próprio e apelido válidos'
                        },
                        stringLength: {
                            max: 38,
                            message: 'O teu nome não deve possuir mais que 38 caracteres'
                        }
                    }
                },
                agree: {
                    excluded: false,
                    validators: {
                        callback: {
                            message: 'Deves concordar com os termos e condições',
                            callback: function (value, validator, $field) {
                                return value === 'yes';
                            }
                        }
                    }
                }
            }
        })
        .on('success.form.fv', function (e) {
            e.preventDefault();
            submitSignupFacebook();
        });

    setTimeout(function () {
        $('#signup_facebook').formValidation('validateField', 'nome');

        $('#click-agree-1').on('click', function () {

            if ($('#agree-1').val() == 'no') {
                $('#agree-1').val('yes');
            } else {
                $('#agree-1').val('no');
            }

            $('#signup_facebook')
                .formValidation('revalidateField', 'agree');
        });

    }, 500);

});

function submitSignupFacebook() {

    var formData = "email=" + $('#email_facebook').val() + "&id_user=" + $('.user_id').val()
        + "&id_facebook=" + $('#id_facebook').val() + "&url_imagem=" + $('#image').val()
        + "&nome=" + $('#nome').val();

    $.ajax({
        url: 'api/verificacoes/registoFacebook.php',
        type: 'POST',
        data: formData,
        success: function (data) {
            $('#conclusion-facebook').modal('hide');

            setTimeout(function () {
                window.location = "/@" + data;
            }, 500);
        }
    });

}