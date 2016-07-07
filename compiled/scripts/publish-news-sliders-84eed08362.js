"use strict";
function checkTransparent() {
    var e = !0, a = !1;
    $(document).ready(function () {
        $('nav[role="navigation"]').hasClass("navbar-transparent") && (a = !0)
    }), $(document).scroll(function () {
        a && $(window).width() > 992 && ($(this).scrollTop() > 280 ? e && (e = !1, $('nav[role="navigation"]').removeClass("navbar-transparent"), $('nav[role="navigation"]').addClass("navbar-white"), $(".brand-img").attr("src", "../../images/logo_green.svg")) : e || (e = !0, $('nav[role="navigation"]').removeClass("navbar-white"), $('nav[role="navigation"]').addClass("navbar-transparent"), $(".brand-img").attr("src", "../../images/logo-w.svg")))
    })
}
function editor() {
    setTimeout(function () {
        var e = new MediumEditor(".editable-1", {
            placeholder: {
                text: "Primeiro parágrafo (Experimenta sublinhar o texto escrito)",
                hideOnClick: !1
            },
            toolbar: {buttons: ["bold", "italic", "underline", "anchor", "quote"]},
            anchor: {
                customClassOption: null,
                customClassOptionText: "Button",
                linkValidation: !1,
                placeholderText: "Introduz um link",
                targetCheckbox: !1,
                targetCheckboxText: "Open in new window"
            }
        }), a = new MediumEditor(".editable-2", {
            placeholder: {
                text: "Segundo parágrafo (Experimenta sublinhar o texto escrito)",
                hideOnClick: !1
            },
            toolbar: {buttons: ["bold", "italic", "underline", "anchor", "quote"]},
            anchor: {
                customClassOption: null,
                customClassOptionText: "Button",
                linkValidation: !1,
                placeholderText: "Introduz um link",
                targetCheckbox: !1,
                targetCheckboxText: "Open in new window"
            }
        });
        e.subscribe("editableInput", function (e, a) {
            $("#para_1_hidden").val(e.srcElement.innerText), $("#para_1_submit").val(e.srcElement.innerHTML), $("#publish-news-slider").formValidation("revalidateField", "para_1")
        }), a.subscribe("editableInput", function (e, a) {
            $("#para_2_hidden").val(e.srcElement.innerText), $("#para_2_submit").val(e.srcElement.innerHTML), $("#publish-news-slider").formValidation("revalidateField", "para_2")
        })
    }, 1)
}
function submitNewsslider() {
    var e = new FormData($("#publish-news-slider")[0]);
    return $.ajax({
        url: "../../api/publicar/news_slider.php", type: "POST", data: e, xhr: function () {
            var e = $.ajaxSettings.xhr();
            return e.upload && e.upload.addEventListener("progress", progress, !1), e
        }, success: function (e) {
            $("#myPleaseWait").modal("hide"), redirectNews(e)
        }, cache: !1, contentType: !1, processData: !1
    }), !1
}
function progress() {
    var e = Math.round(event.loaded / event.total * 100);
    $("#progress_bar").css("width", e + "%")
}
function debounce(e, a, t) {
    var i;
    return function () {
        var s = this, n = arguments;
        clearTimeout(i), i = setTimeout(function () {
            i = null, t || e.apply(s, n)
        }, a), t && !i && e.apply(s, n)
    }
}
$(document).ready(function () {
    function e() {
        $(window).width() < 992 ? ($("#topbar").addClass("navbar-white"), $("#topbar").removeClass("navbar-transparent"), $(".brand-img").attr("src", "../../images/logo_green.svg")) : ($("#topbar").removeClass("navbar-white"), $("#topbar").addClass("navbar-transparent"), $(".brand-img").attr("src", "../../images/logo-w.svg"))
    }

    $("body").addClass(navigator.appVersion + " is-js"), e(), checkTransparent(), editor(), $(window).resize(function () {
        e(), checkTransparent()
    }), $("#topbar").scrollupbar()
}), $(document).ready(function () {
    function e() {
        var e = $("body"), a = e.data("iframe.fv");
        a && a.height(e.height())
    }

    $("#publish-news-slider").steps({
        headerTag: "h2", bodyTag: "section", onStepChanged: function (a, t, i) {
            e(), t > 0 ? $(".actions > ul > li:first-child").attr("style", "") : $(".actions > ul > li:first-child").attr("style", "display:none")
        }, onInit: function (e, a) {
            $(".actions > ul > li:first-child").attr("style", "display:none")
        }, labels: {finish: "Concluir", next: "Seguinte", previous: "Anterior"}, onStepChanging: function (e, a, t) {
            var i = $("#publish-news-slider").data("formValidation"), s = $("#publish-news-slider").find('section[data-step="' + a + '"]');
            i.validateContainer(s);
            var n = i.isValidContainer(s);
            return n !== !1 && null !== n
        }, onFinishing: function (e, a) {
            var t = $("#publish-news-slider").data("formValidation"), i = $("#publish-news-slider").find('section[data-step="' + a + '"]');
            t.validateContainer(i);
            var s = t.isValidContainer(i);
            return s !== !1 && null !== s
        }, onFinished: function (e, a) {
            submitNewsslider(), $("#myPleaseWait").modal("show"), e.preventDefault()
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
            tema: {
                validators: {
                    notEmpty: {message: "Necessitas de inserir um tema"},
                    stringLength: {min: 3, max: 16, message: "O tema deve possuir entre 3 e 16 caracteres"}
                }
            },
            image_1: {
                validators: {
                    notEmpty: {message: "Necessitas de inserir uma imagem"},
                    file: {
                        message: "Os formatos de imagem suportadas são JPEG, JPG ou PNG e não devem exceder os 10MB",
                        extension: "jpeg,jpg,png",
                        type: "image/jpeg,image/png",
                        maxSize: 1e7
                    }
                }
            },
            image_2: {
                validators: {
                    notEmpty: {message: "Necessitas de inserir uma imagem"},
                    file: {
                        message: "Os formatos de imagem suportadas são JPEG, JPG ou PNG e não devem exceder os 10MB",
                        extension: "jpeg,jpg,png",
                        type: "image/jpeg,image/png",
                        maxSize: 1e7
                    }
                }
            },
            image_3: {
                validators: {
                    file: {
                        message: "Os formatos de imagem suportadas são JPEG, JPG ou PNG e não devem exceder os 10MB",
                        extension: "jpeg,jpg,png",
                        type: "image/jpeg,image/png",
                        maxSize: 1e7
                    }
                }
            },
            image_4: {
                validators: {
                    file: {
                        message: "Os formatos de imagem suportadas são JPEG, JPG ou PNG e não devem exceder os 10MB",
                        extension: "jpeg,jpg,png",
                        type: "image/jpeg,image/png",
                        maxSize: 1e7
                    }
                }
            },
            para_1: {validators: {notEmpty: {message: "Necessitas de introduzir um parágrafo"}}},
            para_2: {validators: {notEmpty: {message: "Necessitas de introduzir um parágrafo"}}}
        }
    }).on("success.field.fv", function (e, a) {
        if ("image_1" === a.field) {
            firstTime1 = !1;
            var t = $("#my_image_1")[0].files[0], i = (t.type, t.name), s = URL.createObjectURL(t);
            $("#label_my_image_1").html("Imagem<br>" + i), $("#upload_img_1").attr("src", s)
        }
        if ("image_2" === a.field) {
            firstTime2 = !1;
            var t = $("#my_image_2")[0].files[0], i = (t.type, t.name), s = URL.createObjectURL(t);
            $("#label_my_image_2").html("Imagem<br>" + i), $("#upload_img_2").attr("src", s)
        }
        if ("image_3" === a.field && "undefined" != typeof $("#my_image_3")[0].files[0]) {
            firstTime3 = !1;
            var t = $("#my_image_3")[0].files[0], i = (t.type, t.name), s = URL.createObjectURL(t);
            $("#label_my_image_3").html("Imagem<br>" + i), $("#upload_img_3").attr("src", s)
        }
        if ("image_4" === a.field && "undefined" != typeof $("#my_image_4")[0].files[0]) {
            firstTime4 = !1;
            var t = $("#my_image_4")[0].files[0], i = (t.type, t.name), s = URL.createObjectURL(t);
            $("#label_my_image_4").html("Imagem<br>" + i), $("#upload_img_4").attr("src", s)
        }
        e.preventDefault()
    }).on("err.field.fv", function (e, a) {
        firstTime1 || "image_1" === a.field && ($("#label_my_image_1").html("Imagem Necessária<br>(JPEG, JPG ou PNG)"), $("#upload_img_1").attr("src", "../images/backgrounds/default_background.png"), firstTime1 = !0), firstTime2 || "image_2" === a.field && ($("#label_my_image_2").html("Imagem Necessária<br>(JPEG, JPG ou PNG)"), $("#upload_img_2").attr("src", "../images/backgrounds/default_background.png"), firstTime2 = !0), firstTime3 || "image_3" === a.field && ($("#label_my_image_3").html("Imagem Necessária<br>(JPEG, JPG ou PNG)"), $("#upload_img_3").attr("src", "../images/backgrounds/default_background.png"), firstTime3 = !0), firstTime4 || "image_4" === a.field && ($("#label_my_image_4").html("Imagem Necessária<br>(JPEG, JPG ou PNG)"), $("#upload_img_4").attr("src", "../images/backgrounds/default_background.png"), firstTime4 = !0)
    })
});
var firstTime1 = !0, firstTime2 = !0, firstTime3 = !0, firstTime4 = !0, searchVisible = 0, transparent = !0, transparentDemo = !0, fixedTop = !1, navbar_initialized = !1;
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