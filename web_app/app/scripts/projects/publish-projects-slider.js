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

    $('#publish-projects-slider')
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
                var fv = $('#publish-projects-slider').data('formValidation'), // FormValidation instance
                    $container = $('#publish-projects-slider').find('section[data-step="' + currentIndex + '"]');

                fv.validateContainer($container);

                var isValidStep = fv.isValidContainer($container);
                if (isValidStep === false || isValidStep === null) {
                    return false;
                }

                return true;
            },
            onFinishing: function (e, currentIndex) {
                var fv = $('#publish-projects-slider').data('formValidation'),
                    $container = $('#publish-projects-slider').find('section[data-step="' + currentIndex + '"]');

                fv.validateContainer($container);
                var isValidStep = fv.isValidContainer($container);
                if (isValidStep === false || isValidStep === null) {
                    return false;
                }
                return true;
            },
            onFinished: function (e, currentIndex) {
                e.preventDefault();
                e.stopImmediatePropagation();

                $('#myPleaseWait').modal('show');
                submitProjectSlider();
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
                image_1: {
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
                image_2: {
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
                image_3: {
                    validators: {
                        file: {
                            message: 'Os formatos de imagem suportadas são JPEG, JPG ou PNG e não devem exceder os 10MB',
                            extension: 'jpeg,jpg,png',
                            type: 'image/jpeg,image/png',
                            maxSize: 10000000
                        }
                    }
                },
                image_4: {
                    validators: {
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

            if (data.field === 'image_1') {

                firstTime1 = false;
                var file = $('#my_image_1')[0].files[0];
                var type = file.type;
                var name = file.name;
                var url = URL.createObjectURL(file);

                $('#label_my_image_1').html("Imagem<br>" + name);
                $('#upload_img_1').attr('src', url);
            }


            if (data.field === 'image_2') {

                firstTime2 = false;
                var file = $('#my_image_2')[0].files[0];
                var type = file.type;
                var name = file.name;
                var url = URL.createObjectURL(file);

                $('#label_my_image_2').html("Imagem<br>" + name);
                $('#upload_img_2').attr('src', url);
            }

            if (data.field === 'image_3') {

                if (typeof $('#my_image_3')[0].files[0] !== 'undefined') {

                    firstTime3 = false;
                    var file = $('#my_image_3')[0].files[0];
                    var type = file.type;
                    var name = file.name;
                    var url = URL.createObjectURL(file);

                    $('#label_my_image_3').html("Imagem<br>" + name);
                    $('#upload_img_3').attr('src', url);
                }
            }


            if (data.field === 'image_4') {

                if (typeof $('#my_image_4')[0].files[0] !== 'undefined') {

                    firstTime4 = false;
                    var file = $('#my_image_4')[0].files[0];
                    var type = file.type;
                    var name = file.name;
                    var url = URL.createObjectURL(file);

                    $('#label_my_image_4').html("Imagem<br>" + name);
                    $('#upload_img_4').attr('src', url);
                }
            }

            e.preventDefault();

        })
        .on('err.field.fv', function (e, data) {
            if (!firstTime1) {
                if (data.field === 'image_1') {

                    $('#label_my_image_1').html("Imagem Necessária<br>(JPEG, JPG ou PNG)");
                    $('#upload_img_1').attr('src', '../images/backgrounds/default_background.png');

                    firstTime1 = true;
                }
            }

            if (!firstTime2) {
                if (data.field === 'image_2') {

                    $('#label_my_image_2').html("Imagem Necessária<br>(JPEG, JPG ou PNG)");
                    $('#upload_img_2').attr('src', '../images/backgrounds/default_background.png');

                    firstTime2 = true;
                }
            }

            if (!firstTime3) {
                if (data.field === 'image_3') {

                    $('#label_my_image_3').html("Imagem Necessária<br>(JPEG, JPG ou PNG)");
                    $('#upload_img_3').attr('src', '../images/backgrounds/default_background.png');

                    firstTime3 = true;
                }
            }

            if (!firstTime4) {
                if (data.field === 'image_4') {

                    $('#label_my_image_4').html("Imagem Necessária<br>(JPEG, JPG ou PNG)");
                    $('#upload_img_4').attr('src', '../images/backgrounds/default_background.png');

                    firstTime4 = true;
                }
            }
        });
});

var firstTime1 = true;
var firstTime2 = true;
var firstTime3 = true;
var firstTime4 = true;

function submitProjectSlider() {

    var formData = new FormData($("#publish-projects-slider")[0]);

    $.ajax({
        url: 'http://178.62.86.141/api/publicar/projects_slider.php',
        type: 'POST',
        data: formData,
        success: function (data) {
            $('#myPleaseWait').modal('hide');
        },
        xhr: function () {
            var myXhr = $.ajaxSettings.xhr();
            if (myXhr.upload) {
                myXhr.upload.addEventListener('progress', progress, false);
            }
            return myXhr;
        },
        cache: false,
        contentType: false,
        processData: false
    });
}

function progress(e) {
    var percent = Math.round((event.loaded / event.total) * 100);
    $('#progress_bar').css('width', percent + '%');
}