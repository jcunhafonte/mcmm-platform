$(document).ready(function() {
    
    userImg();
    formValidators();
    
});

function userImg() {
    $(".control-img").click(function () {
        $("input[id='my_file']").click();
    });

    $("input[id='my_file']").change(function(){
        readURL(this);
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img-user').attr('src', e.target.result);
            }

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
                        max: 39,
                        message: 'O teu nome não deve possuir mais que 39 caracteres'
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
    });
}