$(window).load(function () {

    $('#conclusion-google').modal('show');

    $('#signup_google')
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
            submitSignupGoogle();
        });

    setTimeout(function () {
        $('#signup_google').formValidation('validateField', 'nome');

        $('#click-agree-1').on('click', function () {

            if ($('#agree-1').val() == 'no') {
                $('#agree-1').val('yes');
            } else {
                $('#agree-1').val('no');
            }

            $('#signup_google')
                .formValidation('revalidateField', 'agree');
        });

    }, 500);

});

function submitSignupGoogle() {

    var formData = "email=" + $('#email_google').val() + "&id_user=" + $('.user_id').val()
        + "&id_google=" + $('#id_google').val() + "&url_imagem=" + $('#image').val()
        + "&nome=" + $('#nome').val();

    $.ajax({
        url: 'api/verificacoes/registoGoogle.php',
        type: 'POST',
        data: formData,
        success: function (data) {
            $('#conclusion-google').modal('hide');

            setTimeout(function () {
                window.location = "/@" + data;
            }, 500);
        }
    });

}