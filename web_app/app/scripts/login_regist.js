function showRegisterForm2() {
    
    $("#strengthBar").css('width','0%')
    $('.registerBox-2').fadeIn('fast');

    $('.social').fadeOut('fast');
    $('.division').fadeOut('fast');

    $('.loginBox').fadeOut('fast', function () {
        $('.registerBox').fadeOut('fast');
        resetForm2();
        $('.login-footer').fadeOut('fast', function () {
            $('.register-footer').fadeIn('fast');
        });
        $('.modal-title').html('Registar');
    });
    $('.error').removeClass('alert alert-danger').html('');
}

function showRegisterForm() {
    $('.registerBox-2').fadeOut('fast');
    $('.social').fadeIn('fast');
    $('.division').fadeIn('fast');

    $('.loginBox').fadeOut('fast', function () {
        $('.registerBox').fadeIn('fast');
        resetForm1();
        $('.login-footer').fadeOut('fast', function () {
            $('.register-footer').fadeIn('fast');
        });
        $('.modal-title').html('Registar');
    });
    $('.error').removeClass('alert alert-danger').html('');
}

function resetForm1() {
    $("#signupForm").data('formValidation').resetForm();
    $("#email_signup").val('');
    $("#email_signupEnd").val('');
}

function resetForm2() {
    $("#password").val('');
    $("#confirmPassword").val('');
    $("#nome_signupEnd").val('');
    $("#utilizador_signupEnd").val('');
    $("#signupFormEnd").formValidation('resetForm', true);
}

function showLoginForm() {
    $('.social').fadeIn('fast');
    $('.division').fadeIn('fast');
    $('.registerBox-2').fadeOut('fast');

    $('#loginModal .registerBox').fadeOut('fast', function () {
        $('.loginBox').fadeIn('fast');
        $('.register-footer').fadeOut('fast', function () {
            $('.login-footer').fadeIn('fast');
        });

        $('.modal-title').html('Entrar');
    });
    $('.error').removeClass('alert alert-danger').html('');
}

function openLoginModal() {
    showLoginForm();
    setTimeout(function () {
        $('#loginModal').modal('show');
    }, 230);
}
function openRegisterModal() {
    showRegisterForm();
    setTimeout(function () {
        $('#loginModal').modal('show');
    }, 230);

}

function shakeModal() {
    $('#loginModal .modal-dialog').addClass('shake');
    setTimeout(function () {
        $('#loginModal .modal-dialog').removeClass('shake');
    }, 1000);
}

!function ($) {

    /* CHECKBOX PUBLIC CLASS DEFINITION
     * ============================== */

    var Checkbox = function (element, options) {
        this.init(element, options);
    };

    Checkbox.prototype = {

        constructor: Checkbox

        , init: function (element, options) {
            var $el = this.$element = $(element)

            this.options = $.extend({}, $.fn.checkbox.defaults, options);
            $el.before(this.options.template);
            this.setState();
        }

        , setState: function () {
            var $el = this.$element
                , $parent = $el.closest('.checkbox');

            $el.prop('disabled') && $parent.addClass('disabled');
            $el.prop('checked') && $parent.addClass('checked');
        }

        , toggle: function () {
            var ch = 'checked'
                , $el = this.$element
                , $parent = $el.closest('.checkbox')
                , checked = $el.prop(ch)
                , e = $.Event('toggle')

            if ($el.prop('disabled') == false) {
                $parent.toggleClass(ch) && checked ? $el.removeAttr(ch) : $el.prop(ch, ch);
                $el.trigger(e).trigger('change');
            }
        }

        , setCheck: function (option) {
            var d = 'disabled'
                , ch = 'checked'
                , $el = this.$element
                , $parent = $el.closest('.checkbox')
                , checkAction = option == 'check' ? true : false
                , e = $.Event(option)

            $parent[checkAction ? 'addClass' : 'removeClass'](ch) && checkAction ? $el.prop(ch, ch) : $el.removeAttr(ch);
            $el.trigger(e).trigger('change');
        }

    }


    /* CHECKBOX PLUGIN DEFINITION
     * ======================== */

    var old = $.fn.checkbox

    $.fn.checkbox = function (option) {
        return this.each(function () {
            var $this = $(this)
                , data = $this.data('checkbox')
                , options = $.extend({}, $.fn.checkbox.defaults, $this.data(), typeof option == 'object' && option);
            if (!data) $this.data('checkbox', (data = new Checkbox(this, options)));
            if (option == 'toggle') data.toggle()
            if (option == 'check' || option == 'uncheck') data.setCheck(option)
            else if (option) data.setState();
        });
    }

    $.fn.checkbox.defaults = {
        template: '<span class="icons"><span class="first-icon fa fa-square-o"></span><span class="second-icon fa fa-check-square-o"></span></span>'
    }


    /* CHECKBOX NO CONFLICT
     * ================== */

    $.fn.checkbox.noConflict = function () {
        $.fn.checkbox = old;
        return this;
    }


    /* CHECKBOX DATA-API
     * =============== */

    $(document).on('click.checkbox.data-api', '[data-toggle^=checkbox], .checkbox', function (e) {
        var $checkbox = $(e.target);
        if (e.target.tagName != "A") {
            e && e.preventDefault() && e.stopPropagation();
            if (!$checkbox.hasClass('checkbox')) $checkbox = $checkbox.closest('.checkbox');
            $checkbox.find(':checkbox').checkbox('toggle');
        }
    });

    $(function () {
        $('[data-toggle="checkbox"]').each(function () {
            var $checkbox = $(this);
            $checkbox.checkbox();
        });
    });

}(window.jQuery);

$(document).ready(function () {

    $('#login_email').keyup(function () {
        $('.error').removeClass('alert alert-danger').html('');
        $('.error').removeClass('alert alert-info').html('');
        $('.error').removeClass('alert alert-info').html('');
    });

    $('#login_password').keyup(function () {
        $('.error').removeClass('alert alert-danger').html('');
        $('.error').removeClass('alert alert-info').html('');
        $('.error').removeClass('alert alert-info').html('');
    });

    $('#loginForm')
        .formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                email_login: {
                    validators: {
                        notEmpty: {
                            message: 'Necessitas de introduzir um email'
                        },
                        regexp: {
                            regexp: /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/,
                            message: 'O email introduzido não é válido'
                        }
                    }
                },
                password_login: {
                    validators: {
                        notEmpty: {
                            message: 'Necessitas de introduzir uma palavra-passe'
                        }
                    }
                }
            }
        })
        .on('success.form.fv', function (e) {
            e.preventDefault();
            submitLogin();
        });

    $('#signupForm')
        .formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh glyphicon-refresh-animate'
            },
            fields: {
                email_signup: {
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
                            url: mcmm_dns + "api/verificacoes/verificaRegistoEmail.php",
                            data: {
                                type: 'username'
                            },
                            message: 'O email introduzido já se encontra registado',
                            type: 'POST'
                        }
                    }
                }
            }
        })
        .on('success.form.fv', function (e) {
            e.preventDefault();
            submitSignup();
        });

    $('#signupFormEnd')
        .formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                nome_signupEnd: {
                    validators: {
                        notEmpty: {
                            message: 'Necessitas de introduzir um nome'
                        },
                        regexp: {
                            regexp: /^[A-zÀ-ú]+[\s|,][A-zÀ-ú]$/,
                            message: 'Deves introduzir um nome próprio e apelido válidos'
                        },
                        stringLength: {
                            max: 39,
                            message: 'O teu nome não deve possuir mais que 39 caracteres'
                        }
                    }
                },
                utilizador_signupEnd: {
                    validators: {
                        notEmpty: {
                            message: 'Necessitas de introduzir um nome de utilizador'
                        },
                        remote: {
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                            },
                            url: mcmm_dns + "api/verificacoes/verificaUserID.php",
                            data: {
                                type: 'username'
                            },
                            message: 'O nome de utilizador introduzido já se encontra registado',
                            type: 'POST'
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
                },
                password: {
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
                confirmPassword: {
                    validators: {
                        identical: {
                            field: 'password',
                            message: 'As palavras-passes introduzidas não coincidem'
                        }
                    }
                }
            }
        })
        .on('success.form.fv', function (e) {
            e.preventDefault();
            submitRegist();
        });

    // Update the value of "agree" input when clicking the Agree/Disagree button
    $('#click-agree').on('click', function () {

        if ($('#agree').val() == 'no') {
            $('#agree').val('yes');
        } else {
            $('#agree').val('no');
        }

        $('#signupFormEnd')
            .formValidation('revalidateField', 'agree');
    });

});

function submitLogin() {

    var username = $("#login_email").val();
    var pass = $("#login_password").val();
    var cookie = $("#keep_connected").is(':checked') ? 1 : 0;

    var informacao = "emailUtilizador=" + username + "&palavraPasseUtilizador="
        + pass + "&continuarLogado=" + cookie;

    $.ajax({
        type: "POST",
        url: mcmm_dns + "api/verificacoes/verificaLogin.php",
        data: informacao,

        success: function (html) {

            if (html == 'entrar=1') {
                $('#loginModal').modal('toggle');
                return true;
            }

            if (html == 'entrar=2') {
                shakeModal();
                $("#login_email").val('');
                $('.error').addClass('alert alert-danger').html('Verifica se o email que introduziste é válido.');
                return true;
            }

            if (html == 'entrar=3') {
                shakeModal();
                $('.error').addClass('alert alert-info').html('Para acederes a esta página precisas de estar autenticado.');
                return true;
            }

            if (html == 'entrar=4') {
                shakeModal();
                $("#login_password").val('');
                $('.error').addClass('alert alert-danger').html('Verifica se a palavra-passe que introduziste está correta.');
                return true;
            }

            if (html == 'validado=0') {
                shakeModal();
                $('.error').addClass('alert alert-info').html('Necessitas de aceder ao teu email para validar esta conta.');
                return true;
            }

            if (html == 'bloqueado=1') {
                shakeModal();
                $('.error').addClass('alert alert-warning').html('Esta conta encontra-se bloqueada pela administração.');
                return true;
            }

            if (html == 'entrar=5') {
                shakeModal();
                $('.error').addClass('alert alert-info').html('O email que introduziste não se encontra registado.');
                return true;
            }
        }
    });
}

function submitSignup() {
    var email = $("#email_signup").val();
    $('#email_signupEnd').val(email);
    showRegisterForm2();
    return true;
}

function submitSignup2() {

    var email = $("#email_signup").val();
    var informacao = "emailUtilizador=" + email;

    $.ajax({
        type: "POST",
        url: mcmm_dns + "api/verificacoes/verificaRegistoEmail.php",
        data: informacao,

        success: function (html) {

            if (html == 'registo=0') {
                shakeModal();
                $('.error').addClass('alert alert-danger').html('O email introduzido já encontra registado.');
                return true;
            }

            if (html == 'registo=1') {
                $('#email_signupEnd').val(email);
                showRegisterForm2();
                return true;
            }

            if (html == 'registo=2') {
                shakeModal();
                $('.error').addClass('alert alert-danger').html('Verifica se o email que introduziste é válido.');
                return true;
            }

            if (html == 'registo=3') {
                shakeModal();
                $('.error').addClass('alert alert-info').html('Para acederes a esta página precisas de estar autenticado.');
                return true;
            }
        }
    });
}

function submitRegist() {

    var email = $("#email_signupEnd").val();
    var pass = $("#password").val();
    var confirmPass = $("#confirmPassword").val();
    var nome = $("#nome_signupEnd").val();
    var utilizador = $("#utilizador_signupEnd").val();

    var informacao = "emailUtilizador=" + email + "&palavraPasseUtilizador=" + pass +
        "&confirmarPalavraPasseUtilizador=" + confirmPass + "&nomeUtilizador=" + nome + "&utilizadorId=" + utilizador;

    $.ajax({
        type: "POST",
        url: mcmm_dns + "api/verificacoes/verificaRegisto.php",
        data: informacao,

        success: function (html) {

            if (html == 'registo=0') {
                shakeModal();
                $('.error').addClass('alert alert-danger').html('O email introduzido já encontra registado.');
                return true;
            }

            if (html == 'registo=1') {
                $('#loginModal').modal('hide');
                noty({
                    text: 'O teu registo foi concluído com <b>sucesso</b>! <br>' +
                    ' Acede ao <b>email inserido</b> para validares a tua conta.',
                    type: 'success',
                    layout: 'topRight',
                    theme: 'bootstrapTheme',
                    animation: {
                        open: 'animated bounceInLeft',
                        close: 'animated bounceOutRight',
                        easing: 'swing',
                        speed: 250
                    },
                    timeout: 10000
                });
            }

            if (html == 'registo=3') {
                shakeModal();
                $('.error').addClass('alert alert-danger').html('Verifica se as palavras-passes que introduziste coincidem.');
                return true;
            }

            if (html == 'registo=4') {
                shakeModal();
                $('.error').addClass('alert alert-danger').html('Verifica se o email introduzido é válido.');
                return true;
            }

            if (html == 'registo=3') {
                shakeModal();
                $('.error').addClass('alert alert-info').html('Para acederes a esta página precisas de estar autenticado.');
                return true;
            }
        }
    });
}