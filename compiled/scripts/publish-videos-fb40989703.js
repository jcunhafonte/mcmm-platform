"use strict";
function checkTransparent() {
    var e = !0, a = !1;
    $(document).ready(function () {
        $('nav[role="navigation"]').hasClass("navbar-transparent") && (a = !0)
    }), $(document).scroll(function () {
        a && $(window).width() > 992 && ($(this).scrollTop() > 280 ? e && (e = !1, $('nav[role="navigation"]').removeClass("navbar-transparent"), $('nav[role="navigation"]').addClass("navbar-white"), $(".brand-img").attr("src", "../images/logo_red.svg")) : e || (e = !0, $('nav[role="navigation"]').removeClass("navbar-white"), $('nav[role="navigation"]').addClass("navbar-transparent"), $(".brand-img").attr("src", "../images/logo-w.svg")))
    })
}
function progress(e) {
    var a = Math.round(event.loaded / event.total * 100);
    $("#progress_bar").css("width", a + "%")
}
function debounce(e, a, t) {
    var i;
    return function () {
        var s = this, o = arguments;
        clearTimeout(i), i = setTimeout(function () {
            i = null, t || e.apply(s, o)
        }, a), t && !i && e.apply(s, o)
    }
}
$(document).ready(function () {
    function e() {
        $(window).width() < 992 ? ($("#topbar").addClass("navbar-white"), $("#topbar").removeClass("navbar-transparent"), $(".brand-img").attr("src", "../images/logo_red.svg")) : ($("#topbar").removeClass("navbar-white"), $("#topbar").addClass("navbar-transparent"), $(".brand-img").attr("src", "../images/logo-w.svg"))
    }

    $("body").addClass(navigator.appVersion + " is-js"), e(), checkTransparent(), $(window).resize(function () {
        e(), checkTransparent()
    }), $("#topbar").scrollupbar()
}), $(document).ready(function () {
    function e() {
        var e = $("body"), a = e.data("iframe.fv");
        a && a.height(e.height())
    }

    $("#publish-video").steps({
        headerTag: "h2", bodyTag: "section", onStepChanged: function (a, t, i) {
            e(), t > 0 ? $(".actions > ul > li:first-child").attr("style", "") : $(".actions > ul > li:first-child").attr("style", "display:none")
        }, onInit: function (e, a) {
            $(".actions > ul > li:first-child").attr("style", "display:none")
        }, labels: {finish: "Concluir", next: "Seguinte", previous: "Anterior"}, onStepChanging: function (e, a, t) {
            var i = $("#publish-video").data("formValidation"), s = $("#publish-video").find('section[data-step="' + a + '"]');
            i.validateContainer(s);
            var o = i.isValidContainer(s);
            return o !== !1 && null !== o
        }, onFinishing: function (e, a) {
            var t = $("#publish-video").data("formValidation"), i = $("#publish-video").find('section[data-step="' + a + '"]');
            t.validateContainer(i);
            var s = t.isValidContainer(i);
            return s !== !1 && null !== s
        }, onFinished: function (e, a) {
            $("#myPleaseWait").modal("show"), $("#publish-video").submit(), e.preventDefault()
        }
    }).formValidation({
        framework: "bootstrap",
        icon: {
            valid: "glyphicon glyphicon-ok",
            invalid: "glyphicon glyphicon-remove",
            validating: "glyphicon glyphicon-refresh"
        },
        fields: {
            titulo: {
                validators: {
                    notEmpty: {message: "Necessitas de inserir o título"},
                    stringLength: {min: 6, max: 22, message: "O título deve possuir entre 6 e 22 caracteres"}
                }
            },
            uc: {validators: {notEmpty: {message: "Necessitas de inserir a/as unidades curriculares"}}},
            tipologia: {validators: {notEmpty: {message: "Necessitas de inserir a/as tipologias"}}},
            video: {
                validators: {
                    notEmpty: {message: "Necessitas de inserir um vídeo"},
                    file: {
                        extension: "mp4,webm,flv",
                        type: "video/mp4,video/webm,video/x-flv",
                        message: "Os formatos de vídeos suportados são MP4, WebM ou FLV e não devem exceder os 50MB",
                        maxSize: 5e7
                    }
                }
            },
            para_1: {validators: {notEmpty: {message: "Necessitas de introduzir um parágrafo"}}},
            para_2: {validators: {notEmpty: {message: "Necessitas de introduzir um parágrafo"}}}
        }
    }).on("success.field.fv", function (e, a) {
        if ("video" === a.field) {
            firstTime = !1;
            var t = $("#my_video")[0].files[0], i = t.type, s = t.name, o = URL.createObjectURL(t);
            $("#label_my_video").html("Vídeo<br>" + s), jwplayer("video-upload").setup({
                file: o,
                type: i,
                autostart: !0,
                mute: true
            })
        }
    }).on("err.field.fv", function (e, a) {
        if (!firstTime && "video" === a.field) {
            $("#label_my_video").html("Vídeo<br>(MP4, WebM ou FLV)"), firstTime = !0;
            var t = "api/utilizadores/videos/video.mp4", i = "../images/logo_red.svg";
            jwplayer("video-upload").setup({image: i, file: t, controls: !1, mute: true})
        }
    })
});
var firstTime = !0;
$("#publish-video").submit(function (e) {
    var a = new FormData($("#publish-video")[0]);
    $.ajax({
        type: "POST", url: "../api/publicar/videos_normal.php", data: a, xhr: function () {
            var e = $.ajaxSettings.xhr();
            return e.upload && e.upload.addEventListener("progress", progress, !1), e
        }, cache: !1, contentType: !1, processData: !1, success: function (e) {
            $("#myPleaseWait").modal("hide"), redirectVideo(e)
        }
    }), e.preventDefault()
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
                var t = a.values[0], i = a.values[1];
                $(this).siblings(".price-left").html("&euro; " + t), $(this).siblings(".price-right").html("&euro; " + i)
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
                var i = t.find(".btn");
                i.removeClass(a), i.addClass(e), t.attr("data-class", e)
            }
        })
    }
}, examples = {
    initContactUsMap: function () {
        var e = new google.maps.LatLng(44.43353, 26.093928), a = {
            zoom: 14,
            center: e,
            scrollwheel: !1
        }, t = new google.maps.Map(document.getElementById("contactUsMap"), a), i = new google.maps.Marker({
            position: e,
            title: "Hello World!"
        });
        i.setMap(t)
    }
};
NProgress.configure({showSpinner: !1}), $(window).load(function () {
    NProgress.done()
}), $(document).ready(function () {
    NProgress.start()
});