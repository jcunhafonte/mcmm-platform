'use strict';

$(document).ready(function () {

    $('body').addClass(navigator.appVersion + ' is-js');

    controlNavbar();
    checkTransparent();
    $('*').tooltip();

    $(window).resize(function () {
        controlNavbar();
        checkTransparent();
    });

    //TOPBAR
    $('#topbar').scrollupbar();

    function controlNavbar() {
        if ($(window).width() < 992) {
            $('#topbar').addClass('navbar-white');
            $('#topbar').removeClass('navbar-transparent');
            $(".brand-img").attr("src", "../../images/logo_yellow.svg");
        } else {
            $('#topbar').removeClass('navbar-white');
            $('#topbar').addClass('navbar-transparent');
            $(".brand-img").attr("src", "../../images/logo-w.svg");
        }
    }

});

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
                        $(".brand-img").attr("src", "../../images/logo_yellow.svg")
                    }
                } else {
                    if (!transparent) {
                        transparent = true;
                        $('nav[role="navigation"]').removeClass('navbar-white');
                        $('nav[role="navigation"]').addClass('navbar-transparent');
                        $(".brand-img").attr("src", "../../images/logo-w.svg")
                    }
                }
            }
        }
    });
}

$(document).ready(function () {
    function adjustIframeHeight() {
        var $body = $('body'),
            $iframe = $body.data('iframe.fv');
        if ($iframe) {
            // Adjust the height of iframe
            $iframe.height($body.height());
        }
    }

    $('#edit-projects')
        .steps({
            headerTag: 'h2',
            bodyTag: 'section',
            onStepChanged: function (e, currentIndex, priorIndex) {
                adjustIframeHeight();
                if (currentIndex > 0) {
                    $('.actions > ul > li:first-child').attr('style', '');
                } else {
                    $('.actions > ul > li:first-child').attr('style', 'display:none');
                }
            },
            onInit: function (event, current) {
                $('.actions > ul > li:first-child').attr('style', 'display:none');
            },
            labels: {
                finish: 'Concluir',
                next: 'Seguinte',
                previous: 'Anterior'
            },
            onStepChanging: function (e, currentIndex, newIndex) {
                var fv = $('#edit-projects').data('formValidation'), // FormValidation instance
                    $container = $('#edit-projects').find('section[data-step="' + currentIndex + '"]');

                fv.validateContainer($container);

                setTimeout(function () {
                    $('#edit-projects')
                        .formValidation('validateField', 'titulo')
                        .formValidation('validateField', 'uc')
                        .formValidation('validateField', 'ac')
                        .formValidation('validateField', 'para_1')
                        .formValidation('validateField', 'para_2');
                }, 100);

                var isValidStep = fv.isValidContainer($container);
                if (isValidStep === false || isValidStep === null) {
                    return false;
                }

                return true;
            },
            onFinishing: function (e, currentIndex) {
                var fv = $('#edit-projects').data('formValidation'),
                    $container = $('#edit-projects').find('section[data-step="' + currentIndex + '"]');

                fv.validateContainer($container);
                var isValidStep = fv.isValidContainer($container);
                if (isValidStep === false || isValidStep === null) {
                    return false;
                }
                return true;
            },
            onFinished: function (e, currentIndex) {
                $('#myPleaseWait').modal('show');
                $('#edit-projects').submit();
                e.preventDefault();
            }
        })
        .formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                titulo: {
                    validators: {
                        notEmpty: {
                            message: 'Necessitas de inserir o título'
                        },
                        stringLength: {
                            min: 6,
                            max: 22,
                            message: 'O título deve possuir entre 6 e 22 caracteres'
                        }
                    }
                },
                uc: {
                    validators: {
                        notEmpty: {
                            message: 'Necessitas de inserir a/as unidades curriculares'
                        }
                    }
                },
                ac: {
                    validators: {
                        notEmpty: {
                            message: 'Necessitas de inserir a/as áreas científicas'
                        }
                    }
                },
                para_1: {
                    validators: {
                        notEmpty: {
                            message: 'Necessitas de introduzir um parágrafo'
                        }
                    }
                },
                para_2: {
                    validators: {
                        notEmpty: {
                            message: 'Necessitas de introduzir um parágrafo'
                        }
                    }
                }
            }
        })
        .on('success.field.fv', function (e, data) {
        })
        .on('err.field.fv', function (e, data) {
        });

    setTimeout(function () {
        $('#edit-projects')
            .formValidation('validateField', 'titulo')
            .formValidation('validateField', 'uc')
            .formValidation('validateField', 'ac')
            .formValidation('validateField', 'para_1')
            .formValidation('validateField', 'para_2');
    }, 100);
});

var firstTime = true;

$('#edit-projects').submit(function (e) {

    var formData = new FormData($("#edit-projects")[0]);
    $.ajax({
        type: 'POST',
        url: '/api/edit/projects_slider.php',
        data: formData,
        xhr: function () {
            var myXhr = $.ajaxSettings.xhr();
            if (myXhr.upload) {
                myXhr.upload.addEventListener('progress', progress, false);
            }
            return myXhr;
        },
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            $('#myPleaseWait').modal('hide');
            noty({
                text: 'O projeto foi editado com <b>sucesso</b>!',
                type: 'success',
                layout: 'topRight',
                theme: 'bootstrapTheme',
                animation: {
                    open: 'animated bounceInLeft',
                    close: 'animated bounceOutRight',
                    easing: 'swing',
                    speed: 250
                },
                timeout: 7000
            });
        }
    });
    e.preventDefault();
});

function progress(e) {
    var percent = Math.round((event.loaded / event.total) * 100);
    $('#progress_bar').css('width', percent + '%');
}