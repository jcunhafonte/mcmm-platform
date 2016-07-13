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

    <!--METAS-->
    <?php metas(); ?>

    <!--FAVICON-->
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="images/favicon/normal/apple-touch-icon-57x57.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/favicon/normal/apple-touch-icon-114x114.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/favicon/normal/apple-touch-icon-72x72.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/favicon/normal/apple-touch-icon-144x144.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="images/favicon/normal/apple-touch-icon-60x60.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="images/favicon/normal/apple-touch-icon-120x120.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="images/favicon/normal/apple-touch-icon-76x76.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="images/favicon/normal/apple-touch-icon-152x152.png"/>
    <link rel="icon" type="image/png" href="images/favicon/normal/favicon-196x196.png" sizes="196x196"/>
    <link rel="icon" type="image/png" href="images/favicon/normal/favicon-96x96.png" sizes="96x96"/>
    <link rel="icon" type="image/png" href="images/favicon/normal/favicon-32x32.png" sizes="32x32"/>
    <link rel="icon" type="image/png" href="images/favicon/normal/favicon-16x16.png" sizes="16x16"/>
    <link rel="icon" type="image/png" href="images/favicon/normal/favicon-128.png" sizes="128x128"/>
    <meta name="application-name" content="MCMM"/>
    <meta name="msapplication-TileColor" content="#FFFFFF"/>
    <meta name="msapplication-TileImage" content="images/favicon/normal/mstile-144x144.png"/>
    <meta name="msapplication-square70x70logo" content="images/favicon/normal/mstile-70x70.png"/>
    <meta name="msapplication-square150x150logo" content="images/favicon/normal/mstile-150x150.png"/>
    <meta name="msapplication-wide310x150logo" content="images/favicon/normal/mstile-310x150.png"/>
    <meta name="msapplication-square310x310logo" content="images/favicon/normal/mstile-310x310.png"/>

    <link rel="stylesheet" href="styles/main-5071e0f3e9.css">

    <script src="scripts/vendor/modernizr-9d550bd14f.js"></script>

</head>

<body data-offset="80" data-target=".navbar" data-spy="scroll">

<?php menu() ?>

<div id="platform">

    <div class="projects-header">
        <div class="contents" style="background-image: url(/images/backgrounds/publicar_geral.jpg)">
            <div class="container">
                <div class="row">
                    <div class="description">
                        <h2 class="title">Publicar</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section section-gray">
        <div class="container">
            <div class="row">
                <div class="publish">

                    <div class="first">

                        <div class="col-lg-12 no-padding">

                            <div class="col-xs-12 col-sm-4 col-lg-3">
                                <h2 class="red">Vídeo</h2>
                                <div class="card-publish">
                                    <div class="img img-video"></div>
                                    <a href="/publish/video" class="btn btn-info btn-publish btn-publish-red">Normal</a>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-4 col-lg-3 hidden-xs hidden-sm hidden-md"></div>

                            <div class="col-xs-12 col-sm-4 col-lg-3">
                                <h2 class="yellow">Projeto</h2>
                                <div class="card-publish">
                                    <div class="img img-projects-normal"></div>
                                    <a href="/publish/project/normal" class="btn btn-info btn-publish btn-publish-yellow">Normal</a>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-lg-3">
                                <h2 class="yellow hidden-xs">&nbsp;</h2>
                                <div class="card-publish">
                                    <div class="img img-projects-slider"></div>
                                    <a href="/publish/project/slider" class="btn btn-info btn-publish btn-publish-yellow">Slider</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="second">
                        <div class="col-lg-12 no-padding">
                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                                <h2 class="green">Notícia</h2>
                                <div class="card-publish">
                                    <div class="img img-news-normal"></div>
                                    <a href="/publish/new/normal" class="btn btn-info btn-publish btn-publish-green">Normal</a>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                                <h2 class="green hidden-xs">&nbsp;</h2>
                                <div class="card-publish">
                                    <div class="img img-news-text"></div>
                                    <a href="/publish/new/text" class="btn btn-info btn-publish btn-publish-green">Texto</a>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                                <h2 class="green hidden-xs">&nbsp;</h2>
                                <div class="card-publish">
                                    <div class="img img-news-slider"></div>
                                    <a href="/publish/new/slider" class="btn btn-info btn-publish btn-publish-green">Slider</a>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                                <h2 class="green hidden-xs">&nbsp;</h2>
                                <div class="card-publish">
                                    <div class="img img-news-video"></div>
                                    <a href="/publish/new/video" class="btn btn-info btn-publish btn-publish-green">Vídeo</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php footer(); ?>
    <?php channel() ?>

</div>

<?php

require_once 'api/funcoes/modals.php';
//modals();

?>

<script src="scripts/vendor-c259ccb7d9.js"></script>

<script src="scripts/plugins-aaf19e1ea7.js"></script>

<script src="scripts/publish-e4ad0a494d.js"></script>

<script src="scripts/main.js"></script>

</body>
</html>
