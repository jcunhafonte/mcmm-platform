<?php

session_start();

require_once 'api/funcoes/utils.php';
require_once 'api/funcoes/menu.php';
require_once 'api/funcoes/footer.php';
require_once 'api/funcoes/newsCards.php';
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
    <?php metas(); ?>

    <!--FAVICON-->
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="images/favicon/green/apple-touch-icon-57x57.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/favicon/green/apple-touch-icon-114x114.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/favicon/green/apple-touch-icon-72x72.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/favicon/green/apple-touch-icon-144x144.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="images/favicon/green/apple-touch-icon-60x60.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="images/favicon/green/apple-touch-icon-120x120.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="images/favicon/green/apple-touch-icon-76x76.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="images/favicon/green/apple-touch-icon-152x152.png"/>
    <link rel="icon" type="image/png" href="images/favicon/green/favicon-196x196.png" sizes="196x196"/>
    <link rel="icon" type="image/png" href="images/favicon/green/favicon-96x96.png" sizes="96x96"/>
    <link rel="icon" type="image/png" href="images/favicon/green/favicon-32x32.png" sizes="32x32"/>
    <link rel="icon" type="image/png" href="images/favicon/green/favicon-16x16.png" sizes="16x16"/>
    <link rel="icon" type="image/png" href="images/favicon/green/favicon-128.png" sizes="128x128"/>
    <meta name="application-name" content="MCMM"/>
    <meta name="msapplication-TileColor" content="#FFFFFF"/>
    <meta name="msapplication-TileImage" content="images/favicon/green/mstile-144x144.png"/>
    <meta name="msapplication-square70x70logo" content="images/favicon/green/mstile-70x70.png"/>
    <meta name="msapplication-square150x150logo" content="images/favicon/green/mstile-150x150.png"/>
    <meta name="msapplication-wide310x150logo" content="images/favicon/green/mstile-310x150.png"/>
    <meta name="msapplication-square310x310logo" content="images/favicon/green/mstile-310x310.png"/>

    <link rel="stylesheet" href="styles/main-5071e0f3e9.css">

    <script src="scripts/vendor/modernizr-9d550bd14f.js"></script>

    <script type="text/javascript" src="http://content.jwplatform.com/libraries/pkcaXvet.js"></script>

    <style>
        #news .card-video:hover .jwplayer {
            transform: scale(1.2);
        }
        #news .card-video .jwplayer {
            transition: all .4s;
            transform: scale(1);
        }
    </style>

</head>

<body data-offset="80" data-target=".navbar" data-spy="scroll" id="news">

<?php menu('news'); ?>

<div id="platform">
    <div class="header-page">
        <div id="carousel" class="carousel">
            <div class="owl-carousel">

                <?php

                $result = $conn->prepare("
                SELECT noticias.id_noticias, noticias.titulo, noticias.ref_id_utilizador, 
                noticias.data_publicacao, noticias.ativo, noticias.extensao, noticias.tipo, noticias.tema
                FROM noticias 
                WHERE noticias.ativo = 1 AND destacado = 1
                ORDER BY noticias.data_publicacao DESC");

                $result->execute();
                $result->bind_result($idNoticias, $titulo, $refIdUT,
                    $dataPub, $ativo, $extensao, $tipo, $tema);

                while ($result->fetch()) {

                    echo "
                    
                    <div class=\"item\">
                        <div class=\"background-img\">";
                            
                           switch ($tipo){
                               case "normal":
                                   echo "<img src='/api/utilizadores/noticias/$idNoticias.jpg' />";
                                   break;
                               case "slider":
                                   echo "<img src='/api/utilizadores/noticias/" . $idNoticias . "_1.jpg' />";
                                   break;
                               case "text":
                                   echo "<img src='/images/backgrounds/default.jpg' />";
                                   break;
                               case "video":
                                   echo "<img src='/images/backgrounds/default.jpg' />";
                                   break;
                           }
                        
                        echo "</div>
                        <div class=\"titles\">
                            <div class=\"control-title\">
                                <span>" . h($tema) . "</span>
                                <h2 style='transition: .3s; margin-top: 40px !important;' 
                                onclick=\"window.location='/new/$idNoticias'\">" . h($titulo) . "</h2>
                            </div>
                        </div>
                    </div>
                    
                    ";

                }

                $result->close();

                ?>

            </div>
            <div class="container">
                <div class="dots-wrapper">

                </div>
            </div>
        </div>
    </div>

    <div class="section section-gray" style="padding-bottom: 0">
        <div class="container-fluid">
            <div class="row masonry-container" id="blog-cards">

                <?php

                $result = $conn->prepare("
                SELECT noticias.id_noticias, noticias.titulo, noticias.ref_id_utilizador, 
                noticias.data_publicacao, noticias.ativo, noticias.extensao, noticias.tipo, 
                noticias.tema, noticias.para_1, noticias.para_2, noticias.cabecalho,
                utilizadores.nome_utilizador, utilizadores.id_utilizador, utilizadores.id_user, noticias.preview
                FROM noticias 
                INNER JOIN utilizadores 
                ON utilizadores.id_utilizador = noticias.ref_id_utilizador
                WHERE noticias.ativo = 1
                ORDER BY noticias.data_publicacao DESC
                LIMIT 20");

                $result->execute();
                $result->bind_result($idNoticias, $titulo, $refIdUT,
                    $dataPub, $ativo, $extensao, $tipo, $tema, $para_1, $para_2,
                    $cabecalho, $nomeUtilizador, $idUtilizador, $idUser, $preview);

                $numberVideo = 0;
                $numberSlider = 0;

                while ($result->fetch()) {

                    $data = beautifulDate($dataPub);

                    $result2 = $conn2->prepare("
                    SELECT COUNT(comentarios_noticias.id_comentarios_noticias)
                    FROM comentarios_noticias 
                    WHERE comentarios_noticias.ref_id_noticia = ?");

                    $result2->bind_param('s', $idNoticias);
                    $result2->execute();
                    $result2->bind_result($totalComentarios);
                    $result2->fetch();
                    $result2->close();

                    $result2 = $conn2->prepare("
                    SELECT COUNT(gostos_noticias.id_gostos_noticias)
                    FROM gostos_noticias 
                    WHERE gostos_noticias.ref_id_noticias = ?");

                    $result2->bind_param('s', $idNoticias);
                    $result2->execute();
                    $result2->bind_result($totalGostos);
                    $result2->fetch();
                    $result2->close();

                    switch ($tipo) {
                        case "normal":
                            $excerto = substr($cabecalho, 0, 100) . '...';
                            cardNormal($idNoticias, $tema, $data, $titulo, $excerto, $nomeUtilizador,
                                $idUtilizador, $idUser, $totalComentarios, $totalGostos);
                            break;
                        case "slider":
                            $numberSlider++;
                            $excerto = substr($preview, 0, 200) . '...';
                            cardSlider($numberSlider, $idNoticias, $tema, $data, $titulo, $excerto, $nomeUtilizador,
                                $idUtilizador, $idUser, $totalComentarios, $totalGostos);
                            break;
                        case "video":
                            $numberVideo++;
                            $excerto = substr($preview, 0, 100) . '...';
                            cardVideo($numberVideo, $idNoticias, $tema, $data, $titulo, $excerto, $nomeUtilizador,
                                $idUtilizador, $idUser, $totalComentarios, $totalGostos, $extensao);
                            break;
                        case "text":
                            $excerto = substr($preview, 0, 300) . '...';
                            cardText($idNoticias, $nomeUtilizador, $excerto);
                            break;
                    }
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

<script src="scripts/background-videos.js"></script>

<script src="scripts/news-8f845b3542.js"></script>

<script src="scripts/main.js"></script>

</body>
</html>
