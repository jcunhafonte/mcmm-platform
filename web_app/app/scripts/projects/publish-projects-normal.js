'use strict';

$(document).ready(function () {

    $('body').addClass(navigator.appVersion + ' is-js');

    controlNavbar();
    checkTransparent();

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
            $(".brand-img").attr("src", "images/logo_yellow.svg");
        } else {
            $('#topbar').removeClass('navbar-white');
            $('#topbar').addClass('navbar-transparent');
            $(".brand-img").attr("src", "images/logo-w.svg");
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
                        $(".brand-img").attr("src", "images/logo_yellow.svg")
                    }
                } else {
                    if (!transparent) {
                        transparent = true;
                        $('nav[role="navigation"]').removeClass('navbar-white');
                        $('nav[role="navigation"]').addClass('navbar-transparent');
                        $(".brand-img").attr("src", "images/logo-w.svg")
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
            $iframe.height($body.height());
        }
    }

    $('#publish-projects-normal')
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
                var fv = $('#publish-projects-normal').data('formValidation'), // FormValidation instance
                    $container = $('#publish-projects-normal').find('section[data-step="' + currentIndex + '"]');

                fv.validateContainer($container);

                var isValidStep = fv.isValidContainer($container);
                if (isValidStep === false || isValidStep === null) {
                    return false;
                }

                return true;
            },
            onFinishing: function (e, currentIndex) {
                var fv = $('#publish-projects-normal').data('formValidation'),
                    $container = $('#publish-projects-normal').find('section[data-step="' + currentIndex + '"]');

                fv.validateContainer($container);
                var isValidStep = fv.isValidContainer($container);
                if (isValidStep === false || isValidStep === null) {
                    return false;
                }
                return true;
            },
            onFinished: function (e, currentIndex) {
                submitProjectNormal();
                $('#myPleaseWait').modal('show');
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
                image: {
                    validators: {
                        notEmpty: {
                            message: 'Necessitas de inserir uma imagem'
                        },
                        file: {
                            message: 'Os formatos de imagem suportadas são JPEG, JPG ou PNG e não devem exceder os 10MB',
                            extension: 'jpeg,jpg,png',
                            type: 'image/jpeg,image/png',
                            maxSize: 10000000
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

            if (data.field === 'image') {

                firstTime = false;
                var file = $('#my_image')[0].files[0];
                var type = file.type;
                var name = file.name;
                var url = URL.createObjectURL(file);

                $('#label_my_image').html("Imagem<br>" + name);
                $('#upload_img').attr('src', url);
            }

        })
        .on('err.field.fv', function (e, data) {
            if (!firstTime) {
                if (data.field === 'image') {

                    $('#label_my_image').html("Imagem<br>(JPEG, JPG ou PNG)");
                    $('#upload_img').attr('src', '../images/backgrounds/default_background.png');

                    firstTime = true;
                }
            }
        });
});

var firstTime = true;

function submitProjectNormal() {

    var formData = new FormData($("#publish-projects-normal")[0]);

    $.ajax({
        url: 'http://178.62.86.141/api/publicar/projects_normal.php',
        type: 'POST',
        data: formData,
        xhr: function () {
            var myXhr = $.ajaxSettings.xhr();
            if (myXhr.upload) {
                myXhr.upload.addEventListener('progress', progress, false);
            }
            return myXhr;
        },
        success: function (data) {
            $('#myPleaseWait').modal('hide');
        },
        cache: false,
        contentType: false,
        processData: false
    });

    return false;
}

function progress() {
    var percent = Math.round((event.loaded / event.total) * 100);
    $('#progress_bar').css('width', percent + '%');
}