'use strict';

$(document).ready(function () {

    //TYPED
    $("#typed").typed({
        strings: ["research", "develop", "learn", "improve", "living", "happiness"],
        typeSpeed: 100,
        backDelay: 4000,
        loop: true,
        contentType: 'html',
        loopCount: false
    });
    
    var owl = $('.alunos_section .owl-carousel');
    owl.owlCarousel({
        center: true,
        autoPlay: true,
        singleItem: false,
        items: 3,
        loop: true,
        margin: 10,
        addClassActive: true,
        centerClass: 'center',
        dots: true,
        responsive: {
            0: {
                items: 1
            },
            1000: {
                items: 2
            }
        }
    });

    var owl = $('.sponsors .owl-carousel');
    owl.owlCarousel({
        singleItem: false,
        center: true,
        loop: true,
        margin: 30,
        dots: false,
        autoplay: true,
        autoplayTimeout: 5000,
        responsive: {
            0: {
                items: 2
            },
            992: {
                items: 6
            }
        }
    });
    
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
    });
    
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
    
    
    if (!Modernizr.touch) {
        $('.parallax-section-2').parallax("50%", 0.5);
        $('.parallax-section-3').parallax("50%", 0.5);
        $('#programs').parallax("50%", 0.5);
        $('.parallax-section-1').parallax("50%", 0.1);
    }
    
    $('.skills').waypoint(function (direction) {
        setTimeout(function () {
            $('.skills-animated').each(function () {
                var persent = $(this).attr('data-percent');
                $(this).find('.progress').animate({
                    width: persent + '%'
                }, 300);
            });
        }, 1000);
    }, {
        offset: '100%',
        triggerOnce: true
    });

    bouncy_filter($('.cd-programa-container'));
    var old_selected = 'first';

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
                if (selected_filter == old_selected) return false;
                old_selected = selected_filter;
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
    
});

var animationStarted = false;
$(document).ready(function () {
    $('.researchareas').waypoint(function () {
        if (animationStarted == false) {
            animationStarted = true;
            new Vivus('tec-com_svg', {
                type: 'scenario',
                duration: 200,
                start: 'autostart',
                dashGap: 200
            });
            setTimeout(function () {
                $('.researchareas svg').css('display', 'block');
                new Vivus('social-sci_svg', {
                    type: 'scenario',
                    duration: 200,
                    start: 'autostart',
                    dashGap: 200
                });
                new Vivus('design_svg', {
                    type: 'scenario',
                    duration: 200,
                    start: 'autostart',
                    dashGap: 200
                });
            }, 300);

        }
    }, {
        offset: '100%',
        triggerOnce: true
    });

});

NProgress.configure({showSpinner: false});
$(window).load(function () {
    NProgress.done();
});
$(document).ready(function () {
    NProgress.start();
});