<?php

session_start();

require_once 'api/funcoes/utils.php';
require_once 'api/funcoes/menu.php';
require_once 'api/funcoes/footer.php';
require_once 'api/connection/mysql.php';

checkSession();

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
    <?php metas() ?>

    <!--FAVICON-->
    <!--FAVICON-->
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="images/favicon/yellow/apple-touch-icon-57x57.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/favicon/yellow/apple-touch-icon-114x114.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/favicon/yellow/apple-touch-icon-72x72.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/favicon/yellow/apple-touch-icon-144x144.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="images/favicon/yellow/apple-touch-icon-60x60.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="images/favicon/yellow/apple-touch-icon-120x120.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="images/favicon/yellow/apple-touch-icon-76x76.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="images/favicon/yellow/apple-touch-icon-152x152.png"/>
    <link rel="icon" type="image/png" href="images/favicon/yellow/favicon-196x196.png" sizes="196x196"/>
    <link rel="icon" type="image/png" href="images/favicon/yellow/favicon-96x96.png" sizes="96x96"/>
    <link rel="icon" type="image/png" href="images/favicon/yellow/favicon-32x32.png" sizes="32x32"/>
    <link rel="icon" type="image/png" href="images/favicon/yellow/favicon-16x16.png" sizes="16x16"/>
    <link rel="icon" type="image/png" href="images/favicon/yellow/favicon-128.png" sizes="128x128"/>
    <meta name="application-name" content="MCMM"/>
    <meta name="msapplication-TileColor" content="#FFFFFF"/>
    <meta name="msapplication-TileImage" content="images/favicon/yellow/mstile-144x144.png"/>
    <meta name="msapplication-square70x70logo" content="images/favicon/yellow/mstile-70x70.png"/>
    <meta name="msapplication-square150x150logo" content="images/favicon/yellow/mstile-150x150.png"/>
    <meta name="msapplication-wide310x150logo" content="images/favicon/yellow/mstile-310x150.png"/>
    <meta name="msapplication-square310x310logo" content="images/favicon/yellow/mstile-310x310.png"/>

    <link rel="stylesheet" href="styles/main-5071e0f3e9.css">

    <script src="scripts/vendor/modernizr-9d550bd14f.js"></script>

</head>

<body data-offset="80" data-target=".navbar" data-spy="scroll" id="projects">

<?php menu('projects') ?>

<div id="platform">

    <div class="projects-header">
        <div class="contents" style="background-image: url(/images/backgrounds/projetos.jpg)">
            <div class="container">
                <div class="row">
                    <div class="description">
                        <h2 class="title">As nossas produções</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section section-gray" style="padding-bottom: 0">
        <div class="container-fluid">
            <div class="row">

                <div class="first">
                    <?php
                    $result = $conn->prepare("
                    SELECT projetos.id_projetos, projetos.titulo, projetos.data_publicacao,
                    projetos.ativo, projetos.tipo
                    FROM projetos 
                    WHERE projetos.ativo = 1
                    ORDER BY projetos.data_publicacao DESC
                    LIMIT 5");

                    $result->execute();
                    $result->bind_result($idProjetos, $titulo, $dataPub, $ativo, $tipo);

                    $i = 0;

                    while ($result->fetch()) {

                        $i++;

                        if ($i == 1) {
                            echo "
                            <div class=\"col-xs-12 col-sm-6 col-md-6 col-lg-6 no-padding\">
                                <div class=\"projects-cards col-sm-12\">
                                    <div class=\"project project-large\">
                                        <div class=\"project__card\">
                                            <a href=\"/project/$idProjetos\" class=\"project__image\">";

                                            if ($tipo == "normal") {
                                                echo "<img width='431px' height='431px'
                                                                    src=\"/api/utilizadores/projetos/$idProjetos.jpg\">";
                                            } else {
                                                echo "<img width='431px' height='431px'
                                                     src=\"/api/utilizadores/projetos/" . $idProjetos . "_1.jpg\">";
                                            }

                                            echo "</a>
                                            <div class=\"project__detail\">
                                                <h2 class=\"project__title\">" . h($titulo) . "</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>";

                        } else {
                            echo "
                            <div class=\"col-xs-12 col-sm-6 col-md-3 col-lg-3 no-padding\">
                                <div class=\"projects-cards col-sm-12\">
                                    <div class=\"project project-small\">
                                        <div class=\"project__card\">
                                            <a href=\"/project/$idProjetos\" class=\"project__image\">";

                                               if ($tipo == "normal") {
                                                echo "<img width='431px' height='431px'
                                                                    src=\"/api/utilizadores/projetos/$idProjetos.jpg\">";
                                            } else {
                                                echo "<img width='431px' height='431px'
                                                     src=\"/api/utilizadores/projetos/" . $idProjetos . "_1.jpg\">";
                                            }

                                            echo "</a>
                                            <div class=\"project__detail\">
                                                <h2 class=\"project__title\">" . h($titulo) . "</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>";

                        }
                    }

                    $result->close();

                    ?>
                </div>


                <div class="middle">
                    <?php
                    $result = $conn->prepare("
                    SELECT projetos.id_projetos, projetos.titulo, projetos.data_publicacao,
                    projetos.ativo, projetos.tipo
                    FROM projetos 
                    WHERE projetos.ativo = 1
                    ORDER BY projetos.data_publicacao DESC
                    LIMIT 4 OFFSET 5");

                    $result->execute();
                    $result->bind_result($idProjetos, $titulo, $dataPub, $ativo, $tipo);

                    while ($result->fetch()) {

                            echo "
                            <div class=\"col-xs-12 col-sm-6 col-md-3 col-lg-3 no-padding\">
                                <div class=\"projects-cards col-sm-12\">
                                    <div class=\"project project-small\">
                                        <div class=\"project__card\">
                                            <a href=\"/project/$idProjetos\" class=\"project__image\">";

                            if ($tipo == "normal") {
                                echo "<img width='431px' height='431px'
                                                                    src=\"/api/utilizadores/projetos/$idProjetos.jpg\">";
                            } else {
                                echo "<img width='431px' height='431px'
                                                     src=\"/api/utilizadores/projetos/" . $idProjetos . "_1.jpg\">";
                            }

                            echo "</a>
                                            <div class=\"project__detail\">
                                                <h2 class=\"project__title\">" . h($titulo) . "</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>";
                    }

                    $result->close();

                    ?>
                </div>

                <div class="first">
                    <?php
                    $result = $conn->prepare("
                    SELECT projetos.id_projetos, projetos.titulo, projetos.data_publicacao,
                    projetos.ativo, projetos.tipo
                    FROM projetos 
                    WHERE projetos.ativo = 1
                    ORDER BY projetos.data_publicacao DESC
                    LIMIT 5 OFFSET 9");

                    $result->execute();
                    $result->bind_result($idProjetos, $titulo, $dataPub, $ativo, $tipo);

                    $i = 0;

                    while ($result->fetch()) {

                        $i++;

                        if ($i == 1) {
                            echo "
                            <div class=\"col-xs-12 col-sm-6 col-md-6 col-lg-6 no-padding\">
                                <div class=\"projects-cards col-sm-12\">
                                    <div class=\"project project-large\">
                                        <div class=\"project__card\">
                                            <a href=\"/project/$idProjetos\" class=\"project__image\">";

                            if ($tipo == "normal") {
                                echo "<img width='431px' height='431px'
                                                                    src=\"/api/utilizadores/projetos/$idProjetos.jpg\">";
                            } else {
                                echo "<img width='431px' height='431px'
                                                     src=\"/api/utilizadores/projetos/" . $idProjetos . "_1.jpg\">";
                            }

                            echo "</a>
                                            <div class=\"project__detail\">
                                                <h2 class=\"project__title\">" . h($titulo) . "</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>";

                        } else {
                            echo "
                            <div class=\"col-xs-12 col-sm-6 col-md-3 col-lg-3 no-padding\">
                                <div class=\"projects-cards col-sm-12\">
                                    <div class=\"project project-small\">
                                        <div class=\"project__card\">
                                            <a href=\"/project/$idProjetos\" class=\"project__image\">";

                            if ($tipo == "normal") {
                                echo "<img width='431px' height='431px'
                                                                    src=\"/api/utilizadores/projetos/$idProjetos.jpg\">";
                            } else {
                                echo "<img width='431px' height='431px'
                                                     src=\"/api/utilizadores/projetos/" . $idProjetos . "_1.jpg\">";
                            }

                            echo "</a>
                                            <div class=\"project__detail\">
                                                <h2 class=\"project__title\">" . h($titulo) . "</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>";

                        }
                    }

                    $result->close();

                    ?>
                </div>

            </div>
        </div>
    </div>

    <?php footer(); ?>

</div>

<!--MODALS-->
<?php

require_once 'api/funcoes/modals.php';
//modals();

?>

<script src="scripts/vendor-c259ccb7d9.js"></script>

<script src="scripts/plugins-aaf19e1ea7.js"></script>

<script src="scripts/projects-905611d916.js"></script>

<script src="scripts/main.js"></script>

</body>
</html>
