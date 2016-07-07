'use strict';

$(document).ready(function () {

    $('body').addClass(navigator.appVersion + ' is-js');

    controlNavbar();
    checkTransparent();
    editor();

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
            $(".brand-img").attr("src", "../../images/logo_green.svg");
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
                        $(".brand-img").attr("src", "../../images/logo_green.svg")
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
            $iframe.height($body.height());
        }
    }

    $('#publish-news-text')
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
                var fv = $('#publish-news-text').data('formValidation'), // FormValidation instance
                    $container = $('#publish-news-text').find('section[data-step="' + currentIndex + '"]');

                fv.validateContainer($container);

                var isValidStep = fv.isValidContainer($container);
                if (isValidStep === false || isValidStep === null) {
                    return false;
                }

                return true;
            },
            onFinishing: function (e, currentIndex) {
                var fv = $('#publish-news-text').data('formValidation'),
                    $container = $('#publish-news-text').find('section[data-step="' + currentIndex + '"]');

                fv.validateContainer($container);
                var isValidStep = fv.isValidContainer($container);
                if (isValidStep === false || isValidStep === null) {
                    return false;
                }
                return true;
            },
            onFinished: function (e, currentIndex) {
                submitNewstext();
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
                tema: {
                    validators: {
                        notEmpty: {
                            message: 'Necessitas de inserir um tema'
                        },
                        stringLength: {
                            min: 3,
                            max: 16,
                            message: 'O tema deve possuir entre 3 e 16 caracteres'
                        }
                    }
                },
                cabecalho: {
                    validators: {
                        notEmpty: {
                            message: 'Necessitas de inserir um lead (cabeçalho)'
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
        .on('success.field.fv', function (e, data) { })
        .on('err.field.fv', function (e, data) { })
});

function editor() {

    setTimeout(function () {
        
        var editor1 = new MediumEditor('.editable-1', {
            placeholder: {
                text: 'Primeiro parágrafo (Experimenta sublinhar o texto escrito)',
                hideOnClick: false
            },
            toolbar: {
                buttons: ['bold', 'italic', 'underline', 'anchor', 'quote']
            },
            anchor: {
                customClassOption: null,
                customClassOptionText: 'Button',
                linkValidation: false,
                placeholderText: 'Introduz um link',
                targetCheckbox: false,
                targetCheckboxText: 'Open in new window'
            }
        });
        var editor2 = new MediumEditor('.editable-2', {
            placeholder: {
                text: 'Segundo parágrafo (Experimenta sublinhar o texto escrito)',
                hideOnClick: false
            },
            toolbar: {
                buttons: ['bold', 'italic', 'underline', 'anchor', 'quote']
            },
            anchor: {
                customClassOption: null,
                customClassOptionText: 'Button',
                linkValidation: false,
                placeholderText: 'Introduz um link',
                targetCheckbox: false,
                targetCheckboxText: 'Open in new window'
            }
        });

        editor1.subscribe('editableInput', function (event, editable) {
            $('#para_1_hidden').val(event.srcElement.innerText);
            $('#para_1_submit').val(event.srcElement.innerHTML);
            $('#publish-news-text').formValidation('revalidateField', 'para_1');
        });

        editor2.subscribe('editableInput', function (event, editable) {
            $('#para_2_hidden').val(event.srcElement.innerText);
            $('#para_2_submit').val(event.srcElement.innerHTML);
            $('#publish-news-text').formValidation('revalidateField', 'para_2');
        });

    }, 1);

}

var firstTime = true;

function submitNewstext() {

    var formData = new FormData($("#publish-news-text")[0]);

    $.ajax({
        url: '../../api/publicar/news_text.php',
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