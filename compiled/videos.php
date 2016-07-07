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
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="images/favicon/red/apple-touch-icon-57x57.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/favicon/red/apple-touch-icon-114x114.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/favicon/red/apple-touch-icon-72x72.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/favicon/red/apple-touch-icon-144x144.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="images/favicon/red/apple-touch-icon-60x60.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="images/favicon/red/apple-touch-icon-120x120.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="images/favicon/red/apple-touch-icon-76x76.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="images/favicon/red/apple-touch-icon-152x152.png"/>
    <link rel="icon" type="image/png" href="images/favicon/red/favicon-196x196.png" sizes="196x196"/>
    <link rel="icon" type="image/png" href="images/favicon/red/favicon-96x96.png" sizes="96x96"/>
    <link rel="icon" type="image/png" href="images/favicon/red/favicon-32x32.png" sizes="32x32"/>
    <link rel="icon" type="image/png" href="images/favicon/red/favicon-16x16.png" sizes="16x16"/>
    <link rel="icon" type="image/png" href="images/favicon/red/favicon-128.png" sizes="128x128"/>
    <meta name="application-name" content="MCMM"/>
    <meta name="msapplication-TileColor" content="#FFFFFF"/>
    <meta name="msapplication-TileImage" content="images/favicon/red/mstile-144x144.png"/>
    <meta name="msapplication-square70x70logo" content="images/favicon/red/mstile-70x70.png"/>
    <meta name="msapplication-square150x150logo" content="images/favicon/red/mstile-150x150.png"/>
    <meta name="msapplication-wide310x150logo" content="images/favicon/red/mstile-310x150.png"/>
    <meta name="msapplication-square310x310logo" content="images/favicon/red/mstile-310x310.png"/>


    <link rel="stylesheet" href="styles/main-5071e0f3e9.css">

    <script src="scripts/vendor/modernizr-9d550bd14f.js"></script>

    <script type="text/javascript" src="http://content.jwplatform.com/libraries/pkcaXvet.js"></script>

    <style>
        @media screen and (max-width: 992px) {
            .video-header .contents .container .description .title {
                top: 60%;
                transform: translateY(-60%);
                margin: 0 !important;
                font-size: 60px !important;
            }
        }
        @media screen and (max-width: 768px) {
            .video-header .contents .container .description .title {
                top: 60%;
                transform: translateY(-60%);
                margin: 0 !important;
                font-size: 40px !important;
            }
        }
        /*.card-video:hover .play {*/
            /*width: 90px !important;*/
            /*height: 90px !important;*/
            /*font-size: 55px !important;*/
        /*}*/
        /*.card-video .play{*/
            /*transition: .4s !important;*/
        /*}*/
    </style>

</head>

<body data-offset="80" data-target=".navbar" data-spy="scroll" id="video">

<?php menu('videos') ?>

<div id="platform">

    <div class="video-header">
        <div class="contents">
            <div id="video-background"
                 data-vide-bg="mp4: video/video.mp4, webm: video/video.webm, ogg: video/video.ogg, poster: video/video.jpg"
                 data-vide-options="posterType: jpg, position: 0% 0%">
            </div>
            <div class="container">
                <div class="row">
                    <div class="description">
                        <h2 class="title">A dinâmica dos nossos</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section section-gray" style="padding-bottom: 0">
        <div class="container-fluid">
            <div class="row">

                <?php

                $result = $conn->prepare("
                SELECT videos.id_videos, videos.titulo, videos.ref_id_utilizador, videos.data_publicacao,
                videos.ativo, videos.extensao, utilizadores.nome_utilizador, utilizadores.id_utilizador,
                utilizadores.id_user
                FROM videos 
                INNER JOIN utilizadores 
                ON utilizadores.id_utilizador = videos.ref_id_utilizador
                WHERE videos.ativo = 1
                ORDER BY videos.data_publicacao DESC");

                $result->execute();
                $result->bind_result($idVideos, $titulo, $refIdUT,
                    $dataPub, $ativo, $extensao, $nomeUtilizador, $idUtilizador, $idUser);

                $numberVideo = 0;

                while($result->fetch()){

                    $numberVideo++;

                    $result2 = $conn2->prepare("
                    SELECT COUNT(comentarios_videos.id_comentarios_videos)
                    FROM comentarios_videos 
                    WHERE comentarios_videos.ref_id_videos = ?");

                    $result2->bind_param('s', $idVideos);
                    $result2->execute();
                    $result2->bind_result($totalComentarios);
                    $result2->fetch();
                    $result2->close();

                    $result2 = $conn2->prepare("
                    SELECT COUNT(gostos_videos.id_gostos_videos)
                    FROM gostos_videos 
                    WHERE gostos_videos.ref_id_videos = ?");

                    $result2->bind_param('s', $idVideos);
                    $result2->execute();
                    $result2->bind_result($totalGostos);
                    $result2->fetch();
                    $result2->close();

                    $dataP = strtotime($dataPub);
                    $dataP = date('Y-m-j', $dataP);

                    $meses = array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
                    $data = explode("-", $dataP);

                    $dia = $data[2];
                    $mes = $data[1];
                    $ano = $data[0];
                    $textoData = $dia . " de " . $meses[($mes) - 1] . ", " . $ano;

                    echo "
                    
                       <div class=\"col-xs-12 col-sm-6 col-md-4 col-lg-4\"
                       onclick=\"window.location='/video/$idVideos'\">
                    <div class=\"video card card-background card-video\" data-video=\"video-player-$numberVideo\">
                        <div class=\"video\" id=\"video-player-$numberVideo\"
                        data-url='api/utilizadores/videos/$idVideos.$extensao'>   
                        </div>
                        <div class=\"play\">
                        <span class=\"pe-7s-play\"></span>
                        </div>
                        <div class=\"content\">
                            <p class=\"category\">
                                $textoData
                            </p>
                            <h4 class=\"title\">"; echo h($titulo); echo "</h4>
                        </div>

                        <div class=\"footer\">
                            <div class=\"author\">
                                <a class=\"card-link\" href=\"/@$idUser\">
                                    <img src=\"api/utilizadores/perfis/$idUtilizador.jpg\" class=\"avatar\">
                                    <span>"; echo h($nomeUtilizador); echo "</span>
                                </a>
                            </div>
                            <div class=\"stats pull-right\">
                                <div class=\"card-link\">
                                    <i class=\"fa fa-comment-o\"></i> $totalComentarios
                                </div>
                                <div class=\"card-link\">
                                    <i class=\"fa fa-heart-o\"></i> $totalGostos
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    
                    ";
                }

                $result->close();

                ?>

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

<script src="scripts/videos-18ee42149d.js"></script>

<script src="scripts/main.js"></script>

</body>
</html>
