var searchVisible = 0;
var transparent = true;

var transparentDemo = true;
var fixedTop = false;

var navbar_initialized = false;

$(document).ready(function () {

    $('.ui-loader').html(' ');

    var window_width = $(window).width();

    // Activate Morpghing Buttons
    $('[data-toggle="morphing"]').each(function () {
        $(this).morphingButton();
    });

    //  Activate the tooltips
    $('[rel="tooltip"]').tooltip();

    //      Activate the switches with icons
    if ($('.switch').length != 0) {
        $('.switch')['bootstrapSwitch']();
    }
    //      Activate regular switches
    if ($("[data-toggle='switch']").length != 0) {
        $("[data-toggle='switch']").wrap('<div class="switch" />').parent().bootstrapSwitch();
    }

    //    Activate bootstrap-select
    if ($(".selectpicker").length != 0) {
        $(".selectpicker").selectpicker();
    }

    if ($(".tagsinput").length != 0) {
        $(".tagsinput").tagsInput();
    }

    if ($('.tagsinput-autocomplete').length != 0) {
        $(".tagsinput-autocomplete").tagsInput({
            autocomplete_url: [{"value": "Alien", "id": 1}, {"value": "Alex", "id": 2}, {
                "value": "Alexander",
                "id": 3
            }, {"value": "Alejandro", "id": 4}]
            //autocomplete_url:'test/fake_plaintext_endpoint.html' //jquery.autocomplete (not jquery ui)
        });
    }

    if ($('.datepicker').length != 0) {
        $('.datepicker').datepicker({
            weekStart: 1,
            color: '{color}'
        });
    }


    $('.btn-tooltip').tooltip();
    $('.label-tooltip').tooltip();

    // $(".carousel").swiperight(function () {
    //     $(this).carousel('prev');
    // });
    // $(".carousel").swipeleft(function () {
    //     $(this).carousel('next');
    // });

    $('.form-control').on("focus", function () {
        $(this).parent('.input-group').addClass("input-group-focus");
    }).on("blur", function () {
        $(this).parent(".input-group").removeClass("input-group-focus");
    });

    if ($('.alert-auto-close').length != 0) {
        setTimeout(function () {
            $('.alert-auto-close').fadeOut(function () {
                $(this).remove();
            });
        }, 5000);
    }

    demo.initPickColor();

    // Make the images from the card fill the hole space
    gsdk.fitBackgroundForCards();

    // Init icon search action for the navbar
    gsdk.initNavbarSearch();

    // Init popovers
    gsdk.initPopovers();

    // Init Collapse Areas
    gsdk.initCollapseArea();

    // Init Sliders
    gsdk.initSliders();

    //  Init video card actions
    gsdk.initVideoCards();

});

var gsdk = {
    misc: {
        navbar_menu_visible: 0
    },

    fitBackgroundForCards: function () {
        $('.card').each(function () {
            if (!$(this).hasClass('card-many') && !$(this).hasClass('card-user')) {
                var image = $(this).find('.image img');

                image.hide();
                var image_src = image.attr('src');

                $(this).find('.image').css({
                    "background-image": "url('" + image_src + "')",
                    "background-position": "center center",
                    "background-size": "cover"
                });
            }
        });
    },
    initPopovers: function () {
        if ($('[data-toggle="popover"]').length != 0) {
            $('body').append('<div class="popover-filter"></div>');

            //    Activate Popovers
            $('[data-toggle="popover"]').popover().on('show.bs.popover', function () {
                $('.popover-filter').click(function () {
                    $(this).removeClass('in');
                    $('[data-toggle="popover"]').popover('hide');
                });
                $('.popover-filter').addClass('in');
            }).on('hide.bs.popover', function () {
                $('.popover-filter').removeClass('in');
            });

        }
    },
    initCollapseArea: function () {
        $('[data-toggle="gsdk-collapse"]').each(function () {
            var thisdiv = $(this).attr("data-target");
            $(thisdiv).addClass("gsdk-collapse");
        });

        $('[data-toggle="gsdk-collapse"]').hover(function () {
                var thisdiv = $(this).attr("data-target");
                if (!$(this).hasClass('state-open')) {
                    $(this).addClass('state-hover');
                    $(thisdiv).css({
                        'height': '30px'
                    });
                }

            },
            function () {
                var thisdiv = $(this).attr("data-target");
                $(this).removeClass('state-hover');

                if (!$(this).hasClass('state-open')) {
                    $(thisdiv).css({
                        'height': '0px'
                    });
                }
            }).click(function (event) {
            event.preventDefault();

            var thisdiv = $(this).attr("data-target");
            var height = $(thisdiv).children('.panel-body').height();

            if ($(this).hasClass('state-open')) {
                $(thisdiv).css({
                    'height': '0px',
                });
                $(this).removeClass('state-open');
            } else {
                $(thisdiv).css({
                    'height': height + 30,
                });
                $(this).addClass('state-open');
            }
        });
    },
    initSliders: function () {
        // Sliders for demo purpose in refine cards section
        if ($('#slider-range').length != 0) {
            $("#slider-range").slider({
                range: true,
                min: 0,
                max: 500,
                values: [75, 300],
            });
        }
        if ($('#refine-price-range').length != 0) {
            $("#refine-price-range").slider({
                range: true,
                min: 0,
                max: 999,
                values: [100, 850],
                slide: function (event, ui) {
                    var min_price = ui.values[0];
                    var max_price = ui.values[1];
                    $(this).siblings('.price-left').html('&euro; ' + min_price);
                    $(this).siblings('.price-right').html('&euro; ' + max_price)
                }
            });
        }
        if ($('#slider-default').length != 0 || $('#slider-default2').length != 0) {
            $("#slider-default, #slider-default2").slider({
                value: 70,
                orientation: "horizontal",
                range: "min",
                animate: true
            });
        }
    },
    initVideoCards: function () {
        $('[data-toggle="video"]').click(function () {
            var id_video = $(this).data('video');
            var video = $('#' + id_video).get(0);

            var card_parent = $(this).closest('.card');

            if (video.paused) {
                video.play();
                $(this).html('<i class="fa fa-pause"></i> Pause');
                card_parent.addClass('state-play');
            } else {
                video.pause();
                $(this).html('<i class="fa fa-play"></i> Play');
                card_parent.removeClass('state-play');
            }
        });
    },
    initNavbarSearch: function () {
        $('[data-toggle="search"]').click(function () {
            if (searchVisible == 0) {
                searchVisible = 1;
                $(this).parent().addClass('active');
                $('.navbar-search-form').fadeIn(function () {
                    $('.navbar-search-form input').focus();
                });
            } else {
                searchVisible = 0;
                $(this).parent().removeClass('active');
                $(this).blur();
                $('.navbar-search-form').fadeOut(function () {
                    $('.navbar-search-form input').blur();
                });
            }
        });
    }
}

var demo = {
    initPickColor: function () {
        $('.pick-class-label').click(function () {
            var new_class = $(this).attr('new-class');
            var old_class = $('#display-buttons').attr('data-class');
            var display_div = $('#display-buttons');
            if (display_div.length) {
                var display_buttons = display_div.find('.btn');
                display_buttons.removeClass(old_class);
                display_buttons.addClass(new_class);
                display_div.attr('data-class', new_class);
            }
        });
    }
};

var examples = {
    initContactUsMap: function () {
        var myLatlng = new google.maps.LatLng(44.433530, 26.093928);
        var mapOptions = {
            zoom: 14,
            center: myLatlng,
            scrollwheel: false, //we disable de scroll over the map, it is a really annoing when you scroll through page
        }
        var map = new google.maps.Map(document.getElementById("contactUsMap"), mapOptions);

        var marker = new google.maps.Marker({
            position: myLatlng,
            title: "Hello World!"
        });

        // To add the marker to the map, call setMap();
        marker.setMap(map);
    }
};

function debounce(func, wait, immediate) {
    var timeout;
    return function () {
        var context = this, args = arguments;
        clearTimeout(timeout);
        timeout = setTimeout(function () {
            timeout = null;
            if (!immediate) func.apply(context, args);
        }, wait);
        if (immediate && !timeout) func.apply(context, args);
    };
}

NProgress.configure({showSpinner: false});
$(window).load(function () {
    NProgress.done();
});
$(document).ready(function () {
    NProgress.start();
});