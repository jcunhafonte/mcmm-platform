$(document).ready(function () {

    userImg();
    formValidators();

});

function userImg() {
    $(".control-img").click(function () {
        $("input[id='my_file']").click();
    });

    $("input[id='my_file']").change(function () {
        readURL(this);
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img-user').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
}

function formValidators() {
    $('#edit_profile').formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
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
                sobre: {
                    validators: {
                        stringLength: {
                            max: 300,
                            message: 'O teu sobre não deve possuir mais que 300 caracteres'
                        }
                    }
                }
            }
        })
        .on('success.form.fv', function (e) {
            e.preventDefault();
            submitProfile();
        });
}

function submitProfile() {
    var formData = new FormData($("#edit_profile")[0]);

    $.ajax({
        url: 'http://178.62.86.141/api/verificacoes/updateProfile.php',
        type: 'POST',
        data: formData,
        success: function (data) {

            var response = $.parseJSON(data);
            $('.about').html(response.sobre);
            $('.username').html(response.nome);
            var atual_image = $(".avatar").attr('src');
            $(".avatar").attr('src', atual_image + "?" + new Date().getTime());

            if (response.response === "yes") {
                $('#edit-profile').modal('hide');
                $('.about').html(data['sobre']);

                noty({
                    text: 'O teu perfil foi atualizado com <b>sucesso</b>!',
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
                    text: 'Ocorreu um <b>problema</b> ao atualizar o teu perfil! <br/>' +
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