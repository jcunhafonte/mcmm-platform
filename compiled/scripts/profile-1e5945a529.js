"use strict";
function scrollBanner() {
    var e = window.scrollY, a = document.querySelector(".informations .texts");
    a.style.marginTop = -(e / 5) + "px", a.style.opacity = 1 - e / 380
}
function checkTransparent() {
    var e = !0, a = !1;
    $(document).ready(function () {
        $('nav[role="navigation"]').hasClass("navbar-transparent") && (a = !0)
    }), $(document).scroll(function () {
        a && $(window).width() > 992 && ($(this).scrollTop() > 280 ? e && (e = !1, $('nav[role="navigation"]').removeClass("navbar-transparent"), $('nav[role="navigation"]').addClass("navbar-white"), $(".brand-img").attr("src", "images/logo.svg")) : e || (e = !0, $('nav[role="navigation"]').removeClass("navbar-white"), $('nav[role="navigation"]').addClass("navbar-transparent"), $(".brand-img").attr("src", "images/logo-w.svg")))
    })
}
function debounce(e, a, t) {
    var s;
    return function () {
        var i = this, o = arguments;
        clearTimeout(s), s = setTimeout(function () {
            s = null, t || e.apply(i, o)
        }, a), t && !s && e.apply(i, o)
    }
}
function userImg() {
    function e(e) {
        if (e.files && e.files[0]) {
            var a = new FileReader;
            a.onload = function (e) {
                $("#img-user").attr("src", e.target.result)
            }, a.readAsDataURL(e.files[0])
        }
    }

    $(".control-img").click(function () {
        $("input[id='my_file']").click()
    }), $("input[id='my_file']").change(function () {
        e(this)
    })
}
function formValidators() {
    $("#edit_profile").formValidation({
        framework: "bootstrap",
        icon: {
            valid: "glyphicon glyphicon-ok",
            invalid: "glyphicon glyphicon-remove",
            validating: "glyphicon glyphicon-refresh"
        },
        fields: {
            nome: {
                validators: {
                    notEmpty: {message: "Necessitas de introduzir um nome"},
                    regexp: {
                        regexp: /^[A-zÀ-ú]+[\s|,][A-zÀ-ú]{1,19}$/,
                        message: "Deves introduzir um nome próprio e apelido válidos"
                    },
                    stringLength: {max: 38, message: "O teu nome não deve possuir mais que 38 caracteres"}
                }
            },
            sobre: {
                validators: {
                    stringLength: {
                        max: 300,
                        message: "O teu sobre não deve possuir mais que 300 caracteres"
                    }
                }
            },
            image:{
                validators: {
                    notEmpty: {message: "Necessitas de inserir uma imagem"},
                    file: {
                        message: "Os formatos de imagem suportadas são JPEG, JPG ou PNG e não devem exceder os 10MB",
                        extension: "jpeg,jpg,png",
                        type: "image/jpeg,image/png",
                        maxSize: 1e7
                    }
                }
            }
        }
    }).on("success.form.fv", function (e) {
        e.preventDefault(), submitProfile()
    })
}
function submitProfile() {
    var e = new FormData($("#edit_profile")[0]);
    $('#myPleaseWait').modal('show');
    $("#edit-profile").modal("hide");

    $.ajax({
        url: "api/verificacoes/updateProfile.php", type: "POST", data: e,   xhr: function () {
            var myXhr = $.ajaxSettings.xhr();
            if (myXhr.upload) {
                myXhr.upload.addEventListener('progress', progress, false);
            }
            return myXhr;
        }, success: function (e) {
            var a = $.parseJSON(e);
            var t = $(".avatar").attr("src");
            "yes" === a.response ? (
                
                $(".avatar").attr("src", t + "?" + (new Date).getTime()), $(".about").html(a.sobre), $(".username").html(a.nome),$('#myPleaseWait').modal('hide'),

            noty({
                text: "O teu perfil foi atualizado com <b>sucesso</b>!",
                type: "success",
                layout: "topRight",
                theme: "bootstrapTheme",
                animation: {
                    open: "animated bounceInLeft",
                    close: "animated bounceOutRight",
                    easing: "swing",
                    speed: 250
                },
                timeout: 5e3
            })) : (noty({
                text: "Ocorreu um <b>problema</b> ao atualizar o teu perfil! <br/>Verifica se introduziste os teus dados corretamente.",
                type: "error",
                layout: "topRight",
                theme: "bootstrapTheme",
                animation: {
                    open: "animated bounceInLeft",
                    close: "animated bounceOutRight",
                    easing: "swing",
                    speed: 250
                },
                timeout: 5e3
            }), $("#edit-profile").modal("hide"),

                $('#edit_profile')
                    .formValidation('revalidateField', 'image')
            )
        }, cache: !1, contentType: !1, processData: !1
    })
}

function progress() {
    var percent = Math.round((event.loaded / event.total) * 100);
    $('#progress_bar').css('width', percent + '%');
}

function modalSettings() {
    $("#edit_settings").formValidation({
        framework: "bootstrap",
        icon: {
            valid: "glyphicon glyphicon-ok",
            invalid: "glyphicon glyphicon-remove",
            validating: "glyphicon glyphicon-refresh"
        },
        fields: {
            atual_password: {
                validators: {
                    notEmpty: {message: "Necessitas de introduzir uma palavra-passe"},
                    remote: {
                        headers: {"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"},
                        url: "api/verificacoes/verificaPassword.php",
                        data: {type: "password"},
                        message: "A palavra-passe introduzida não se encontra correta",
                        type: "POST"
                    }
                }
            },
            new_password: {
                validators: {
                    notEmpty: {message: "Necessitas de introduzir uma palavra-passe"},
                    callback: {
                        callback: function (e, a, t) {
                            var s = t.val();
                            if ("" == s)return !0;
                            var i = zxcvbn(s), o = i.score, r = "Esta palavra-passe é fraca", n = $("#strengthBar");
                            switch (o) {
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
                            return 3 > o ? {valid: !1, message: r} : !0
                        }
                    }
                }
            },
            confirm_new_password: {
                validators: {
                    identical: {
                        field: "new_password",
                        message: "As palavras-passes introduzidas não coincidem"
                    }
                }
            }
        }
    }).on("success.form.fv", function (e) {
        e.preventDefault(), submitSettings()
    })
}

function submitSettings() {
    var e = new FormData($("#edit_settings")[0]);
    $.ajax({
        url: "api/verificacoes/changePassword.php", type: "POST", data: e, success: function (e) {
            "yes" === e ? ($("#edit-settings").modal("hide"), noty({
                text: "As tuas definições foram atualizadas com <b>sucesso</b>!",
                type: "success",
                layout: "topRight",
                theme: "bootstrapTheme",
                animation: {
                    open: "animated bounceInLeft",
                    close: "animated bounceOutRight",
                    easing: "swing",
                    speed: 250
                },
                timeout: 5e3
            })) : noty({
                text: "Ocorreu um <b>problema</b> ao atualizar as tuas definições! <br/>Verifica se introduziste os teus dados corretamente.",
                type: "error",
                layout: "topRight",
                theme: "bootstrapTheme",
                animation: {
                    open: "animated bounceInLeft",
                    close: "animated bounceOutRight",
                    easing: "swing",
                    speed: 250
                },
                timeout: 5e3
            })
        }, cache: !1, contentType: !1, processData: !1
    })
}
$(document).ready(function () {
    function e() {
        $(window).width() < 992 ? ($("#topbar").addClass("navbar-white"), $("#topbar").removeClass("navbar-transparent"), $(".brand-img").attr("src", "images/logo.svg")) : ($("#topbar").removeClass("navbar-white"), $("#topbar").addClass("navbar-transparent"), $(".brand-img").attr("src", "images/logo-w.svg"))
    }

    $("body").addClass(navigator.appVersion + " is-js"), e(), checkTransparent(), $(window).resize(function () {
        e(), checkTransparent()
    }), $("#topbar").scrollupbar(), window.addEventListener("scroll", scrollBanner)
});
var searchVisible = 0, transparent = !0, transparentDemo = !0, fixedTop = !1, navbar_initialized = !1;
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
                var t = a.values[0], s = a.values[1];
                $(this).siblings(".price-left").html("&euro; " + t), $(this).siblings(".price-right").html("&euro; " + s)
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
                var s = t.find(".btn");
                s.removeClass(a), s.addClass(e), t.attr("data-class", e)
            }
        })
    }
}, examples = {
    initContactUsMap: function () {
        var e = new google.maps.LatLng(44.43353, 26.093928), a = {
            zoom: 14,
            center: e,
            scrollwheel: !1
        }, t = new google.maps.Map(document.getElementById("contactUsMap"), a), s = new google.maps.Marker({
            position: e,
            title: "Hello World!"
        });
        s.setMap(t)
    }
};
NProgress.configure({showSpinner: !1}), $(window).load(function () {
    NProgress.done()
}), $(document).ready(function () {
    NProgress.start()
}), $(document).ready(function () {
    userImg(), formValidators()
}), $(document).ready(function () {
    modalSettings()
});