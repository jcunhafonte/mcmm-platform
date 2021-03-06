"use strict";
function checkTransparent() {
    var e = !0, a = !1;
    $(document).ready(function () {
        $('nav[role="navigation"]').hasClass("navbar-transparent") && (a = !0)
    }), $(document).scroll(function () {
        a && $(window).width() > 992 && ($(this).scrollTop() > 280 ? e && (e = !1, $('nav[role="navigation"]').removeClass("navbar-transparent"), $('nav[role="navigation"]').addClass("navbar-white"), $(".brand-img").attr("src", "images/logo_red.svg")) : e || (e = !0, $('nav[role="navigation"]').removeClass("navbar-white"), $('nav[role="navigation"]').addClass("navbar-transparent"), $(".brand-img").attr("src", "images/logo-w.svg")))
    })
}
function videoCards() {
    var e = $(".card-video").length, a = "api/utilizadores/videos/video.mp4";
    for (i = 1; e >= i; i++)jwplayer("video-player-" + i).setup({
        file: $('#video-player-'+i).attr('data-url'),
        controls: !1,
        autostart: !0,
        mute: !0,
        loop: !0
    }), firstTime["video-player-" + i] = !0, checkIfPlays(i);
    $(".card-video").hover(function (e) {
        var a = $(this).data("video");
        "playing" == jwplayer(a).getState() ? jwplayer(a).pause() : jwplayer(a).play()
    })
}
function checkIfPlays(e) {
    1 == firstTime["video-player-" + e] && ("playing" !== jwplayer("video-player-" + e).getState() ? setTimeout(function () {
        checkIfPlays(e)
    }, 400) : (firstTime["video-player-" + e] = !1, setTimeout(function () {
        jwplayer("video-player-" + e).pause()
    }, 5e3)))
}
function debounce(e, a, t) {
    var o;
    return function () {
        var r = this, i = arguments;
        clearTimeout(o), o = setTimeout(function () {
            o = null, t || e.apply(r, i)
        }, a), t && !o && e.apply(r, i)
    }
}
function showRegisterForm2() {
    $("#strengthBar").css("width", "0%"), $(".registerBox-2").fadeIn("fast"), $(".social").fadeOut("fast"), $(".division").fadeOut("fast"), $(".loginBox").fadeOut("fast", function () {
        $(".registerBox").fadeOut("fast"), resetForm2(), $(".login-footer").fadeOut("fast", function () {
            $(".register-footer").fadeIn("fast")
        }), $(".modal-title").html("Registar")
    }), $(".error").removeClass("alert alert-danger").html("")
}
function showRegisterForm() {
    $(".registerBox-2").fadeOut("fast"), $(".social").fadeIn("fast"), $(".division").fadeIn("fast"), $(".loginBox").fadeOut("fast", function () {
        $(".registerBox").fadeIn("fast"), resetForm1(), $(".login-footer").fadeOut("fast", function () {
            $(".register-footer").fadeIn("fast")
        }), $(".modal-title").html("Registar")
    }), $(".error").removeClass("alert alert-danger").html("")
}
function resetForm1() {
    $("#signupForm").data("formValidation").resetForm(), $("#email_signup").val(""), $("#email_signupEnd").val("")
}
function resetForm2() {
    $("#password").val(""), $("#confirmPassword").val(""), $("#nome_signupEnd").val(""), $("#utilizador_signupEnd").val(""), $("#signupFormEnd").formValidation("resetForm", !0)
}
function showLoginForm() {
    $(".social").fadeIn("fast"), $(".division").fadeIn("fast"), $(".registerBox-2").fadeOut("fast"), $("#loginModal .registerBox").fadeOut("fast", function () {
        $(".loginBox").fadeIn("fast"), $(".register-footer").fadeOut("fast", function () {
            $(".login-footer").fadeIn("fast")
        }), $(".modal-title").html("Entrar")
    }), $(".error").removeClass("alert alert-danger").html("")
}
function openLoginModal() {
    showLoginForm(), setTimeout(function () {
        $("#loginModal").modal("show")
    }, 230)
}
function openRegisterModal() {
    showRegisterForm(), setTimeout(function () {
        $("#loginModal").modal("show")
    }, 230)
}
function shakeModal() {
    $("#loginModal .modal-dialog").addClass("shake"), setTimeout(function () {
        $("#loginModal .modal-dialog").removeClass("shake")
    }, 1e3)
}
function submitLogin() {
    var e = $("#login_email").val(), a = $("#login_password").val(), t = $("#keep_connected").is(":checked") ? 1 : 0, o = "emailUtilizador=" + e + "&palavraPasseUtilizador=" + a + "&continuarLogado=" + t;
    $.ajax({
        type: "POST", url: "api/verificacoes/verificaLogin.php", data: o, success: function (e) {
            return e.startsWith("entrar") === !1 && e.startsWith("bloqueado") === !1 && e.startsWith("validado") === !1 ? ($("#loginModal").modal("toggle"), window.location.href = e, !0) : "entrar=2" == e ? (shakeModal(), $("#login_email").val(""), $(".error").addClass("alert alert-danger").html("Verifica se o email que introduziste é válido."), !0) : "entrar=3" == e ? (shakeModal(), $(".error").addClass("alert alert-info").html("Para acederes a esta página precisas de estar autenticado."), !0) : "entrar=4" == e ? (shakeModal(), $("#login_password").val(""), $(".error").addClass("alert alert-danger").html("Verifica se a palavra-passe que introduziste está correta."), !0) : "validado=0" == e ? (shakeModal(), $(".error").addClass("alert alert-info").html("Necessitas de aceder ao teu email para validar esta conta."), !0) : "bloqueado=1" == e ? (shakeModal(), $(".error").addClass("alert alert-warning").html("Esta conta encontra-se bloqueada pela administração."), !0) : "entrar=5" == e ? (shakeModal(), $(".error").addClass("alert alert-info").html("O email que introduziste não se encontra registado."), !0) : void 0
        }
    })
}
function submitSignup() {
    var e = $("#email_signup").val();
    return $("#email_signupEnd").val(e), showRegisterForm2(), !0
}
function submitSignup2() {
    var e = $("#email_signup").val(), a = "emailUtilizador=" + e;
    $.ajax({
        type: "POST", url: "api/verificacoes/verificaRegistoEmail.php", data: a, success: function (a) {
            return "registo=0" == a ? (shakeModal(), $(".error").addClass("alert alert-danger").html("O email introduzido já encontra registado."), !0) : "registo=1" == a ? ($("#email_signupEnd").val(e), showRegisterForm2(), !0) : "registo=2" == a ? (shakeModal(), $(".error").addClass("alert alert-danger").html("Verifica se o email que introduziste é válido."), !0) : "registo=3" == a ? (shakeModal(), $(".error").addClass("alert alert-info").html("Para acederes a esta página precisas de estar autenticado."), !0) : void 0
        }
    })
}
function submitRegist() {
    var e = $("#email_signupEnd").val(), a = $("#password").val(), t = $("#confirmPassword").val(), o = $("#nome_signupEnd").val(), r = $("#utilizador_signupEnd").val(), i = "emailUtilizador=" + e + "&palavraPasseUtilizador=" + a + "&confirmarPalavraPasseUtilizador=" + t + "&nomeUtilizador=" + o + "&utilizadorId=" + r;
    $.ajax({
        type: "POST", url: "api/verificacoes/verificaRegisto.php", data: i, success: function (e) {
            return "registo=0" == e ? (shakeModal(), $(".error").addClass("alert alert-danger").html("O email introduzido já encontra registado."), !0) : ("registo=1" == e && ($("#loginModal").modal("hide"), noty({
                text: "O teu registo foi concluído com <b>sucesso</b>! <br> Acede ao <b>email inserido</b> para validares a tua conta.",
                type: "success",
                layout: "topRight",
                theme: "bootstrapTheme",
                animation: {
                    open: "animated bounceInLeft",
                    close: "animated bounceOutRight",
                    easing: "swing",
                    speed: 250
                },
                timeout: 1e4
            })), "registo=3" == e ? (shakeModal(), $(".error").addClass("alert alert-danger").html("Verifica se as palavras-passes que introduziste coincidem."), !0) : "registo=4" == e ? (shakeModal(), $(".error").addClass("alert alert-danger").html("Verifica se o email introduzido é válido."), !0) : "registo=3" == e ? (shakeModal(), $(".error").addClass("alert alert-info").html("Para acederes a esta página precisas de estar autenticado."), !0) : void 0)
        }
    })
}
$(document).ready(function () {
    function e() {
        $(window).width() < 992 ? ($("#topbar").addClass("navbar-white"), $("#topbar").removeClass("navbar-transparent"), $(".brand-img").attr("src", "images/logo_red.svg")) : ($("#topbar").removeClass("navbar-white"), $("#topbar").addClass("navbar-transparent"), $(".brand-img").attr("src", "images/logo-w.svg"))
    }

    $("body").addClass(navigator.appVersion + " is-js"), e(), checkTransparent(), $(window).resize(function () {
        e(), checkTransparent()
    }), $("#topbar").scrollupbar(), videoCards()
});
var i = 1, firstTime = {}, id = "", searchVisible = 0, transparent = !0, transparentDemo = !0, fixedTop = !1, navbar_initialized = !1;
$(document).ready(function () {
    $(".ui-loader").html(" ");
    $(window).width();
    $('[data-toggle="morphing"]').each(function () {
        $(this).morphingButton()
    }), $('[rel="tooltip"]').tooltip(), 0 != $(".switch").length && $(".switch").bootstrapSwitch(), 0 != $("[data-toggle='switch']").length && $("[data-toggle='switch']").wrap('<div class="switch" />').parent().bootstrapSwitch(), 0 != $(".selectpicker").length && $(".selectpicker").selectpicker(), 0 != $(".tagsinput").length && $(".tagsinput").tagsInput(), 0 != $(".tagsinput-autocomplete").length && $(".tagsinput-autocomplete").tagsInput({
        autocomplete_url: [{
            value: "Alien",
            id: 1
        }, {value: "Alex", id: 2}, {value: "Alexander", id: 3}, {value: "Alejandro", id: 4}]
    }), 0 != $(".datepicker").length && $(".datepicker").datepicker({
        weekStart: 1,
        color: "{color}"
    }), $(".btn-tooltip").tooltip(), $(".label-tooltip").tooltip(), $(".form-control").on("focus", function () {
        $(this).parent(".input-group").addClass("input-group-focus")
    }).on("blur", function () {
        $(this).parent(".input-group").removeClass("input-group-focus")
    }), 0 != $(".alert-auto-close").length && setTimeout(function () {
        $(".alert-auto-close").fadeOut(function () {
            $(this).remove()
        })
    }, 5e3), demo.initPickColor(), gsdk.fitBackgroundForCards(), gsdk.initNavbarSearch(), gsdk.initPopovers(), gsdk.initCollapseArea(), gsdk.initSliders()
});
var gsdk = {
    misc: {navbar_menu_visible: 0}, fitBackgroundForCards: function () {
        $(".card").each(function () {
            if (!$(this).hasClass("card-many") && !$(this).hasClass("card-user")) {
                var e = $(this).find(".image img");
                e.hide();
                var a = e.attr("src");
                $(this).find(".image").css({
                    "background-image": "url('" + a + "')",
                    "background-position": "center center",
                    "background-size": "cover"
                })
            }
        })
    }, initPopovers: function () {
        0 != $('[data-toggle="popover"]').length && ($("body").append('<div class="popover-filter"></div>'), $('[data-toggle="popover"]').popover().on("show.bs.popover", function () {
            $(".popover-filter").click(function () {
                $(this).removeClass("in"), $('[data-toggle="popover"]').popover("hide")
            }), $(".popover-filter").addClass("in")
        }).on("hide.bs.popover", function () {
            $(".popover-filter").removeClass("in")
        }))
    }, initCollapseArea: function () {
        $('[data-toggle="gsdk-collapse"]').each(function () {
            var e = $(this).attr("data-target");
            $(e).addClass("gsdk-collapse")
        }), $('[data-toggle="gsdk-collapse"]').hover(function () {
            var e = $(this).attr("data-target");
            $(this).hasClass("state-open") || ($(this).addClass("state-hover"), $(e).css({height: "30px"}))
        }, function () {
            var e = $(this).attr("data-target");
            $(this).removeClass("state-hover"), $(this).hasClass("state-open") || $(e).css({height: "0px"})
        }).click(function (e) {
            e.preventDefault();
            var a = $(this).attr("data-target"), t = $(a).children(".panel-body").height();
            $(this).hasClass("state-open") ? ($(a).css({height: "0px"}), $(this).removeClass("state-open")) : ($(a).css({height: t + 30}), $(this).addClass("state-open"))
        })
    }, initSliders: function () {
        0 != $("#slider-range").length && $("#slider-range").slider({
            range: !0,
            min: 0,
            max: 500,
            values: [75, 300]
        }), 0 != $("#refine-price-range").length && $("#refine-price-range").slider({
            range: !0,
            min: 0,
            max: 999,
            values: [100, 850],
            slide: function (e, a) {
                var t = a.values[0], o = a.values[1];
                $(this).siblings(".price-left").html("&euro; " + t), $(this).siblings(".price-right").html("&euro; " + o)
            }
        }), 0 == $("#slider-default").length && 0 == $("#slider-default2").length || $("#slider-default, #slider-default2").slider({
            value: 70,
            orientation: "horizontal",
            range: "min",
            animate: !0
        })
    }, initNavbarSearch: function () {
        $('[data-toggle="search"]').click(function () {
            0 == searchVisible ? (searchVisible = 1, $(this).parent().addClass("active"), $(".navbar-search-form").fadeIn(function () {
                $(".navbar-search-form input").focus()
            })) : (searchVisible = 0, $(this).parent().removeClass("active"), $(this).blur(), $(".navbar-search-form").fadeOut(function () {
                $(".navbar-search-form input").blur()
            }))
        })
    }
}, demo = {
    initPickColor: function () {
        $(".pick-class-label").click(function () {
            var e = $(this).attr("new-class"), a = $("#display-buttons").attr("data-class"), t = $("#display-buttons");
            if (t.length) {
                var o = t.find(".btn");
                o.removeClass(a), o.addClass(e), t.attr("data-class", e)
            }
        })
    }
}, examples = {
    initContactUsMap: function () {
        var e = new google.maps.LatLng(44.43353, 26.093928), a = {
            zoom: 14,
            center: e,
            scrollwheel: !1
        }, t = new google.maps.Map(document.getElementById("contactUsMap"), a), o = new google.maps.Marker({
            position: e,
            title: "Hello World!"
        });
        o.setMap(t)
    }
};
NProgress.configure({showSpinner: !1}), $(window).load(function () {
    NProgress.done()
}), $(document).ready(function () {
    NProgress.start()
}), !function (e) {
    var a = function (e, a) {
        this.init(e, a)
    };
    a.prototype = {
        constructor: a, init: function (a, t) {
            var o = this.$element = e(a);
            this.options = e.extend({}, e.fn.checkbox.defaults, t), o.before(this.options.template), this.setState()
        }, setState: function () {
            var e = this.$element, a = e.closest(".checkbox");
            e.prop("disabled") && a.addClass("disabled"), e.prop("checked") && a.addClass("checked")
        }, toggle: function () {
            var a = "checked", t = this.$element, o = t.closest(".checkbox"), r = t.prop(a), i = e.Event("toggle");
            0 == t.prop("disabled") && (o.toggleClass(a) && r ? t.removeAttr(a) : t.prop(a, a), t.trigger(i).trigger("change"))
        }, setCheck: function (a) {
            var t = "checked", o = this.$element, r = o.closest(".checkbox"), i = "check" == a, s = e.Event(a);
            r[i ? "addClass" : "removeClass"](t) && i ? o.prop(t, t) : o.removeAttr(t), o.trigger(s).trigger("change")
        }
    };
    var t = e.fn.checkbox;
    e.fn.checkbox = function (t) {
        return this.each(function () {
            var o = e(this), r = o.data("checkbox"), i = e.extend({}, e.fn.checkbox.defaults, o.data(), "object" == typeof t && t);
            r || o.data("checkbox", r = new a(this, i)), "toggle" == t && r.toggle(), "check" == t || "uncheck" == t ? r.setCheck(t) : t && r.setState()
        })
    }, e.fn.checkbox.defaults = {template: '<span class="icons"><span class="first-icon fa fa-square-o"></span><span class="second-icon fa fa-check-square-o"></span></span>'}, e.fn.checkbox.noConflict = function () {
        return e.fn.checkbox = t, this
    }, e(document).on("click.checkbox.data-api", "[data-toggle^=checkbox], .checkbox", function (a) {
        var t = e(a.target);
        "A" != a.target.tagName && (a && a.preventDefault() && a.stopPropagation(), t.hasClass("checkbox") || (t = t.closest(".checkbox")), t.find(":checkbox").checkbox("toggle"))
    }), e(function () {
        e('[data-toggle="checkbox"]').each(function () {
            var a = e(this);
            a.checkbox()
        })
    })
}(window.jQuery), $(document).ready(function () {
    $("#login_email").keyup(function () {
        $(".error").removeClass("alert alert-danger").html(""), $(".error").removeClass("alert alert-info").html(""), $(".error").removeClass("alert alert-info").html("")
    }), $("#login_password").keyup(function () {
        $(".error").removeClass("alert alert-danger").html(""), $(".error").removeClass("alert alert-info").html(""), $(".error").removeClass("alert alert-info").html("")
    }), $("#loginForm").formValidation({
        framework: "bootstrap",
        icon: {
            valid: "glyphicon glyphicon-ok",
            invalid: "glyphicon glyphicon-remove",
            validating: "glyphicon glyphicon-refresh"
        },
        fields: {
            email_login: {
                validators: {
                    notEmpty: {message: "Necessitas de introduzir um email"},
                    regexp: {
                        regexp: /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/,
                        message: "O email introduzido não é válido"
                    }
                }
            }, password_login: {validators: {notEmpty: {message: "Necessitas de introduzir uma palavra-passe"}}}
        }
    }).on("success.form.fv", function (e) {
        e.preventDefault(), submitLogin()
    }), $("#signupForm").formValidation({
        framework: "bootstrap",
        icon: {
            valid: "glyphicon glyphicon-ok",
            invalid: "glyphicon glyphicon-remove",
            validating: "glyphicon glyphicon-refresh glyphicon-refresh-animate"
        },
        fields: {
            email_signup: {
                validators: {
                    notEmpty: {message: "Necessitas de introduzir um email"},
                    regexp: {
                        regexp: /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/,
                        message: "O email introduzido não é válido"
                    },
                    remote: {
                        headers: {"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"},
                        url: "api/verificacoes/verificaRegistoEmail.php",
                        data: {type: "username"},
                        message: "O email introduzido já se encontra registado",
                        type: "POST"
                    }
                }
            }
        }
    }).on("success.form.fv", function (e) {
        e.preventDefault(), submitSignup()
    }), $("#signupFormEnd").formValidation({
        framework: "bootstrap",
        icon: {
            valid: "glyphicon glyphicon-ok",
            invalid: "glyphicon glyphicon-remove",
            validating: "glyphicon glyphicon-refresh"
        },
        fields: {
            nome_signupEnd: {
                validators: {
                    notEmpty: {message: "Necessitas de introduzir um nome"},
                    regexp: {
                        regexp: /^[A-zÀ-ú]+[\s|,][A-zÀ-ú]{1,19}$/,
                        message: "Deves introduzir um nome próprio e apelido válidos"
                    },
                    stringLength: {max: 38, message: "O teu nome não deve possuir mais que 38 caracteres"}
                }
            },
            utilizador_signupEnd: {
                validators: {
                    notEmpty: {message: "Necessitas de introduzir um nome de utilizador"},
                    remote: {
                        headers: {"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"},
                        url: "api/verificacoes/verificaUserID.php",
                        data: {type: "username"},
                        message: "O nome de utilizador introduzido já se encontra registado",
                        type: "POST"
                    }
                }
            },
            agree: {
                excluded: !1,
                validators: {
                    callback: {
                        message: "Deves concordar com os termos e condições",
                        callback: function (e, a, t) {
                            return "yes" === e
                        }
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {message: "Necessitas de introduzir uma palavra-passe"},
                    callback: {
                        callback: function (e, a, t) {
                            var o = t.val();
                            if ("" == o)return !0;
                            var r = zxcvbn(o), i = r.score, s = "Esta palavra-passe é fraca", n = $("#strengthBar");
                            switch (i) {
                                case 0:
                                    n.attr("class", "progress-bar progress-bar-danger").css("width", "1%");
                                    break;
                                case 1:
                                    n.attr("class", "progress-bar progress-bar-danger").css("width", "25%");
                                    break;
                                case 2:
                                    n.attr("class", "progress-bar progress-bar-danger").css("width", "50%");
                                    break;
                                case 3:
                                    n.attr("class", "progress-bar progress-bar-warning").css("width", "75%");
                                    break;
                                case 4:
                                    n.attr("class", "progress-bar progress-bar-success").css("width", "100%")
                            }
                            return 3 > i ? {valid: !1, message: s} : !0
                        }
                    }
                }
            },
            confirmPassword: {
                validators: {
                    identical: {
                        field: "password",
                        message: "As palavras-passes introduzidas não coincidem"
                    }
                }
            }
        }
    }).on("success.form.fv", function (e) {
        e.preventDefault(), submitRegist()
    }), $("#click-agree").on("click", function () {
        "no" == $("#agree").val() ? $("#agree").val("yes") : $("#agree").val("no"), $("#signupFormEnd").formValidation("revalidateField", "agree")
    })
});