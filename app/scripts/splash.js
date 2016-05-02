'use strict';

$(document).ready(function () {
    
    js_height_init();
    controlNavbar();
    checkTransparent();

    // Preloader
    $(window).on('load', function () {
        var $preloader = $('#page-preloader'),
            $spinner = $preloader.find('.spinner');
        $spinner.fadeOut();
        $preloader.delay(350).fadeOut(800);
    });

    $(window).resize(function () {
        js_height_init();
        controlNavbar();
        checkTransparent();
    });

    //TYPED
    $("#typed").typed({
        strings: ["Typed", "sentences.", "them.", "it out!"],
        typeSpeed: 100,
        backDelay: 4000,
        loop: true,
        contentType: 'html',
        loopCount: false
    });

    //TOPBAR
    $('#topbar').scrollupbar();

    /* ---------------------------------------------
     Height 100%
     --------------------------------------------- */
    function js_height_init() {
        (function ($) {
            $(".js-height-full").height($(window).height());
            $(".js-height-parent").each(function () {
                $(this).height($(this).parent().first().height());
            });
        })(jQuery);
    }

    // Hovers in dream team for touch screen
    if (Modernizr.touch) {
        $(document).on('touchend', '.wrap-dream-team .list-dream-team .team-item', function () {
            $('.wrap-dream-team .list-dream-team .team-item').removeClass('active');
            $(this).addClass('active');
        });
    } else {
        $('.wrap-dream-team .list-dream-team .team-item').hover(function () {
            $(this).find('.mask').css('opacity', 1);
        }, function () {
            $(this).find('.mask').css('opacity', 0);
        });
    }

    // Fancybox
    // $(".fancybox").fancybox();

    // Datepiecker
    $('#my-calendar').datepicker({
        format: 'mm/dd/yyyy',
        startDate: '-3d'
    });
    /* =============================================== */
    /* ======= Accordion panel button collapse ======= */
    /* =============================================== */
    function toggleIcon(e) {
        $(e.target)
            .prev('.panel-heading')
            .toggleClass('active')
            .find('.fa')
            .toggleClass('fa-plus-circle fa-minus-circle');
    }

    $('#accordion-two').on('hidden.bs.collapse shown.bs.collapse', toggleIcon);

    function toggleActive(e) {
        $(e.target)
            .prev('.panel-heading')
            .toggleClass('active')
    }

    $('#accordion-one').on('hidden.bs.collapse shown.bs.collapse', toggleActive);

    /* <!-- =============================================== */
    /* <!-- ======= Isotope ======= -->*/
    /* <!-- =============================================== --> */
    var $container = $('#gallery-items');

    $(window).load(function () {
        $container.isotope({
//		    resizable: false, // disable normal resizing
            transitionDuration: '0.65s',
            masonry: {
                columnWidth: $container.find('.gallery-item:not(.wide)')[0]
            }
        });

        $(window).resize(function () {
            $container.isotope('layout');
        });
    });

    // filter items on button click
    $('#filters').on('click', 'button', function (e) {
        $(e.target).toggleClass('active').siblings().removeClass("active");
        var filterValue = $(this).attr('data-filter');
        $container.isotope({filter: filterValue});
    });

    /* <!-- =============================================== --> */
    /* <!-- =============== Carousels ==================== --> */
    /* <!-- =============================================== -->  */

    //$("#testimonials-carousel").owlCarousel({
    //    singleItem: false,
    //    autoPlay: true,
    //    navigation: true,
    //    navigationText: [,],
    //    items: 3,
    //    addClassActive: true,
    //    centerClass: 'try',
    //    center: true,
    //});

    var owl = $('.owl-carousel');
    owl.owlCarousel({
        center: true,
        items: 2,
        loop: true,
        margin: 10,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            }
        }
    });

    //$("#twitter-carousel").owlCarousel({
    //    singleItem: true,
    //    autoPlay: true,
    //    transitionStyle: 'goDown'
    //});
    //$("#team-carousel").owlCarousel({
    //    items: 7,
    //    autoPlay: true,
    //    navigation: false
    //});

    /* <!-- =============================================== --> */
    /* <!-- ========== Menu Links Scroll ===+============== --> */
    /* <!-- =============================================== -->  */
    $('.scroll').click(function (e) {
        var off = 0;
        var target = this.hash;
        if ($(target).offset().top == 0) {
            off = 0;
        }
        $('html,body').scrollTo(target, 500, {
            offset: off,
            easing: 'easeInOutExpo'
        });
        e.preventDefault();
        //   ---- dissapearing menu on click
    });

    /* <!-- =============================================== --> */
    /* <!-- ===============  Scrollspy fix ================ --> */
    /* <!-- =============================================== --> */
    $(window).on('load', function () {
        var $body = $('body'),
            $navtop = $('#nav'),
            offset = $navtop.outerHeight();
        // Enable scrollSpy with correct offset based on height of navbar
        $body.scrollspy({
            target: '#nav',
            offset: offset + 50
        });
        // function to do the tweaking
        function fixSpy() {
            // grab a copy the scrollspy data for the element
            var data = $body.data('bs.scrollspy');
            // if there is data, lets fiddle with the offset value
            if (data) {
                // get the current height of the navbar
                offset = $navtop.outerHeight();
                // change the data's offset option to match
                data.options.offset = offset
                // now stick it back in the element
                $body.data('bs.scrollspy', data);
                // and finally refresh scrollspy
                $body.scrollspy('refresh');
            }
        }

        // Now monitor the resize events and make the tweaks
        var resizeTimer;
        $(window).resize(function () {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(fixSpy, 200);
        });
    });

    /* <!-- =============================================== --> */
    /* <!-- ============ Init GMap on hidden tab =========== --> */
    /* <!-- =============================================== -->  */
    function waitForVisibleMapElement() {
        setTimeout(function () {
            if ($('#on-map').is(":visible")) {
                initialize();
            } else {
                waitForVisibleMapElement();
            }
        }, 10);
    };
    waitForVisibleMapElement();

    /* <!-- =============================================== --> */
    /* <!-- ============ Prarallax =========== --> */
    /* <!-- =============================================== -->  */
    if (!Modernizr.touch) {
       $('.parallax-section-1').parallax("50%", 0.5);
       $('.parallax-section-2').parallax("50%", 0.5);
       $('.parallax-section-3').parallax("50%", 0.5);
       $('.wrap-features').parallax("50%", 0.5);
       $('.wrap-counters').parallax("50%", 0.5);
       $('.wrap-rates').parallax("50%", 0.5);
       $('.wrap-programs').parallax("50%", 0.5);
       $('#programs').parallax("50%", 0.5);
    }

    /* <!-- =============================================== --> */
    /* <!-- ============ Progress Bar Animation =========== --> */
    /* <!-- =============================================== -->  */
    $('.skills').waypoint(function (direction) {
        $('.skills-animated').each(function () {
            var persent = $(this).attr('data-percent');
            $(this).find('.progress').animate({
                width: persent + '%'
            }, 300);
        });
    }, {
        offset: '100%',
        triggerOnce: true
    });

    /* <!-- =============================================== --> */
    /* <!-- ============ Herader Animation =========== --> */
    /* <!-- =============================================== -->  */
    // $(window).scroll(function () {
    //     if ($(this).scrollTop() > 80) {
    //         $('nav').addClass("navbar-alt")
    //     } else {
    //         $('nav').removeClass("navbar-alt")
    //     }
    // });
    function controlNavbar() {
        if ($(window).width() < 992) {
            $('#topbar').addClass('navbar-white');
            $('#topbar').removeClass('navbar-transparent');
            $(".brand-img").attr("src", "/images/logo.svg")
        } else {
            $('#topbar').removeClass('navbar-white');
            $('#topbar').addClass('navbar-transparent');
            $(".brand-img").attr("src", "/images/logo-w.svg")
        }
    }

    /* <!-- =============================================== --> */
    /* <!-- ============ Tooltip  =========== --> */
    /* <!-- =============================================== -->  */
    $("[data-toggle='tooltip']").tooltip();
    $('[data-toggle="popover"]').popover({
        container: "body",
        placement: "top",
        trigger: "hover",
        delay: {show: 0, hide: 500},
        html: true,
        content: function () {
            var content = $(this).attr("data-popover-content");
            return $(content).children(".popover-body").html();
        },
    });

    /* <!-- =============================================== --> */
    /* <!-- === Switch monthly/annual programa tables  ===== --> */
    /* <!-- =============================================== -->  */
    //switch from monthly to annual programa tables
    bouncy_filter($('.cd-programa-container'));

    function bouncy_filter(container) {
        container.each(function () {
            var programa_table = $(this);
            var filter_list_container = programa_table.find('.programa-switcher'),
                filter_radios = filter_list_container.find('input[type="radio"]'),
                programa_table_wrapper = programa_table.find('.cd-programa-wrapper');
            //store programa table items
            var table_elements = {};
            filter_radios.each(function () {
                var filter_type = $(this).val();
                table_elements[filter_type] = programa_table_wrapper.find('li[data-type="' + filter_type +
                    '"]');
            });
            //detect input change event
            filter_radios.on('change', function (event) {
                event.preventDefault();
                //detect which radio input item was checked
                var selected_filter = $(event.target).val();
                //give higher z-index to the programa table items selected by the radio input
                show_selected_items(table_elements[selected_filter]);
                //rotate each cd-programa-wrapper
                //at the end of the animation hide the not-selected programa tables and rotate back the .cd-programa-wrapper
                if (!Modernizr.cssanimations) {
                    hide_not_selected_items(table_elements, selected_filter);
                    programa_table_wrapper.removeClass('is-switched');
                } else {
                    programa_table_wrapper.addClass('is-switched').eq(0).one(
                        'webkitAnimationEnd oanimationend msAnimationEnd animationend', function () {
                            hide_not_selected_items(table_elements, selected_filter);
                            programa_table_wrapper.removeClass('is-switched');
                            //change rotation direction if .cd-programa-list has the .cd-bounce-invert class
                            if (programa_table.find('.cd-programa-list').hasClass('cd-bounce-invert'))
                                programa_table_wrapper.toggleClass('reverse-animation');
                        });
                }
            });
        });
    }

    function show_selected_items(selected_elements) {
        selected_elements.addClass('is-selected');
    }

    function hide_not_selected_items(table_containers, filter) {
        $.each(table_containers, function (key, value) {
            if (key !== filter) {
                $(this).removeClass('is-visible is-selected').addClass('is-hidden');
            } else {
                $(this).addClass('is-visible').removeClass('is-hidden is-selected');
            }
        });
    }

    /* <!-- =============================================== --> */
    /* <!-- === Switch monthly/annual programa tables  ===== --> */
    /* <!-- =============================================== --> */
    // Variable to hold scroll type
    var slideDrag,
    // Width of .scroll-content ul
        slideWidth = $(".scroll-slider").width(),
    // Speed of animation in ms
        slideSpeed = 400;

    // Initialize sliders
    $(".scroll-slider").slider({
        animate: slideSpeed,
        start: checkType,
        slide: doSlide,
        max: slideWidth
    });


    function checkType(e) {
        slideDrag = $(e.originalEvent.target).hasClass("ui-slider-handle");
    }

    function doSlide(e, ui) {
//	    var target = $(e.target).prev(".scroll-content"),
        var target = $(".scroll-content"),
            maxScroll = target.prop("scrollWidth") - target.width();

        // Was it a click or drag?
        if (slideDrag === true) {
            // User dragged slider head, match position
            target.prop({scrollLeft: ui.value * (maxScroll / slideWidth)});
        }
        else {
            // User clicked on slider itself, animate to position
            target.stop().animate({
                scrollLeft: ui.value * (maxScroll / slideWidth)
            }, slideSpeed);
        }
    }

    // Popovers for map
    $('.wrap-map-item .map-marker').popover({
        container: ".wrap-map-item",
        placement: "top",
        trigger: "hover",
        delay: {"hide": 2000},
        html: true,
        content: function () {
            var content = $(this).attr("data-popover-content");
            return $(content).children(".popover-body").html();
        }
    });
}); // Document ready

function checkTransparent() {

    var transparent = true;
    var hasTransparent = false;

    $(document).ready(function () {
        if ($('nav[role="navigation"]').hasClass('navbar-transparent')) {
            hasTransparent = true;
        }
    });

    $(document).scroll(function () {
        if (hasTransparent) {
            if ($(window).width() > 992) {
                if ($(this).scrollTop() > 280) {
                    if (transparent) {
                        transparent = false;
                        $('nav[role="navigation"]').removeClass('navbar-transparent');
                        $('nav[role="navigation"]').addClass('navbar-white');
                        $(".brand-img").attr("src", "/images/logo.svg")
                    }
                } else {
                    if (!transparent) {
                        transparent = true;
                        $('nav[role="navigation"]').removeClass('navbar-white');
                        $('nav[role="navigation"]').addClass('navbar-transparent');
                        $(".brand-img").attr("src", "/images/logo-w.svg")
                    }
                }
            }
        }
    });
}

$(document).ready(function () {

    //redrawDotNav();

    /* Scroll event handler */
    $(window).bind('scroll', function (e) {
      //  parallaxScroll();
      //  redrawDotNav();
    });

    /* Next/prev and primary nav btn click handlers */
    $('a.manned-flight').click(function () {
        $('html, body').animate({
            scrollTop: 0
        }, 1000, function () {
        });
        return false;
    });
    $('a.frameless-parachute').click(function () {
        $('html, body').animate({
            scrollTop: $('#frameless-parachute').offset().top
        }, 500, function () {
        });
        return false;
    });
    $('a.english-channel').click(function () {
        $('html, body').animate({
            scrollTop: $('#english-channel').offset().top
        }, 500, function () {
        });
        return false;
    });
    $('a.about').click(function () {
        $('html, body').animate({
            scrollTop: $('#about').offset().top
        }, 500, function () {

        });
        return false;
    });

    /* Show/hide dot lav labels on hover */
    $('nav#primary a').hover(
        function () {
            $(this).prev('h1').show();
        },
        function () {
            $(this).prev('h1').hide();
        }
    );

    $(".cd-programa-wrapper").hover(function(){
            $(this).toggleClass('panel-highlited').siblings().removeClass('panel-highlited');
    })

});