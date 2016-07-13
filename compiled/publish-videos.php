<?php

session_start();

require_once 'api/funcoes/utils.php';
require_once 'api/funcoes/menu.php';
require_once 'api/funcoes/footer.php';

checkSession();

if (!isset($_SESSION['idUtilizador'])) {
    header('location:/');
}

?>

<!DOCTYPE html>
<html lang="pt" xmlns:height="http://www.w3.org/1999/xhtml" xmlns:width="http://www.w3.org/1999/xhtml">

<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7">
<![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8">
<![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9">
<![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<!--[if lt IE 9]>
<script type="text/javascript" src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script type="text/javascript" src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<head>

    <title>MCMM</title>

    <?php metas() ?>

    <!--FAVICON-->
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="/images/favicon/red/apple-touch-icon-57x57.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/images/favicon/red/apple-touch-icon-114x114.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/images/favicon/red/apple-touch-icon-72x72.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/images/favicon/red/apple-touch-icon-144x144.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="/images/favicon/red/apple-touch-icon-60x60.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="/images/favicon/red/apple-touch-icon-120x120.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="/images/favicon/red/apple-touch-icon-76x76.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="/images/favicon/red/apple-touch-icon-152x152.png"/>
    <link rel="icon" type="image/png" href="/images/favicon/red/favicon-196x196.png" sizes="196x196"/>
    <link rel="icon" type="image/png" href="/images/favicon/red/favicon-96x96.png" sizes="96x96"/>
    <link rel="icon" type="image/png" href="/images/favicon/red/favicon-32x32.png" sizes="32x32"/>
    <link rel="icon" type="image/png" href="/images/favicon/red/favicon-16x16.png" sizes="16x16"/>
    <link rel="icon" type="image/png" href="/images/favicon/red/favicon-128.png" sizes="128x128"/>
    <meta name="application-name" content="MCMM"/>
    <meta name="msapplication-TileColor" content="#FFFFFF"/>
    <meta name="msapplication-TileImage" content="/images/favicon/red/mstile-144x144.png"/>
    <meta name="msapplication-square70x70logo" content="/images/favicon/red/mstile-70x70.png"/>
    <meta name="msapplication-square150x150logo" content="/images/favicon/red/mstile-150x150.png"/>
    <meta name="msapplication-wide310x150logo" content="/images/favicon/red/mstile-310x150.png"/>
    <meta name="msapplication-square310x310logo" content="/images/favicon/red/mstile-310x310.png"/>


    <link rel="stylesheet" href="/styles/main-5071e0f3e9.css">

    <script src="/scripts/vendor/modernizr-9d550bd14f.js"></script>

    <script type="text/javascript" src="http://content.jwplatform.com/libraries/uZA4sjXA.js"></script>

</head>

<body data-offset="80" data-target=".navbar" data-spy="scroll" id="video">

<?php menu('', '../') ?>

<div id="platform">

    <div class="projects-header">
        <div class="contents" style="background-image: url(/images/backgrounds/publicar_video.gif)">
            <div class="container">
                <div class="row">
                    <div class="description">
                        <h2 class="title">Normal</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section section-gray">
        <div class="container">
            <div class="row">

                <div class="col-xs-12 steps-wrapper">

                    <form id="publish-video" method="post" class="form-horizontal" enctype="multipart/form-data">

                        <h2>Identificação</h2>
                        <section data-step="0">

                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <input id="titulo" class="form-control"
                                               type="text" placeholder="Título" name="titulo">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <input id="uc" class="form-control"
                                               type="text" placeholder="Unidades Curriculares" name="uc">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <input id="tipologia" class="form-control"
                                               type="text" placeholder="Tipologia (Ex: Curta ou longa metragem)"
                                               name="tipologia">
                                    </div>
                                </div>
                            </div>

                            <div class="input col-xs-12 no-padding">

                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <div class="input-file-container">
                                                <input class="input-file form-control" id="my_video" type="file"
                                                       name="video">
                                                <label tabindex="0" for="my_video" id="label_my_video"
                                                       class="input-file-trigger">Vídeo<br>(MP4, WebM ou FLV)</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="video">
                                        <div id="video-upload">

                                        </div>
                                    </div>

                                    <script>
                                        window.onload = function () {
                                            var url = "../video/video.mp4";
                                            var image = "../images/logo_red.svg";
                                            jwplayer("video-upload").setup({
                                                image: image,
                                                file: url,
                                                controls: false,
                                                autostart: false
                                            });
                                        };
                                    </script>
                                </div>
                            </div>

                        </section>

                        <h2>Descrição</h2>
                        <section data-step="1">

                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <div class="col-xs-12 text-area">
                                        <textarea id="para_1" class="form-control" rows="8"
                                                  placeholder="Primeiro parágrafo"
                                                  name="para_1"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <div class="col-xs-12 text-area">
                                        <textarea id="para_2" class="form-control" rows="8"
                                                  placeholder="Segundo parágrafo"
                                                  name="para_2"></textarea>
                                    </div>
                                </div>
                            </div>

                        </section>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <?php footer() ?>
    <?php channel() ?>

</div>

<?php

require_once 'api/funcoes/modals.php';
//modals();

?>

<!-- Modal Start here-->
<div class="modal fade" id="myPleaseWait" tabindex="-1"
     role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">
                    A Publicar...
                </h4>
            </div>
            <div class="modal-body">
                <div class="progress">
                    <div id="progress_bar" class="progress-bar progress-bar-red progress-bar-striped active"
                         style="width: 0%">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal ends Here -->

<script src="/scripts/vendor-c259ccb7d9.js"></script>

<script src="/scripts/plugins-aaf19e1ea7.js"></script>

<script src="/scripts/publish-videos-fb40989703.js"></script>

<script src="/scripts/main.js"></script>

</body>
</html>
