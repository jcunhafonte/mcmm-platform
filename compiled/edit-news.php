<?php

session_start();

if ($name == NULL) {
    header('location:/publications');
}

require_once 'api/funcoes/utils.php';
require_once 'api/funcoes/menu.php';
require_once 'api/funcoes/footer.php';
require_once 'api/funcoes/newsText.php';
require_once 'api/connection/mysql.php';

checkSession();

if (isset($name)) {

    $result = $conn->prepare("
    SELECT noticias.id_noticias, noticias.para_1, noticias.para_2, noticias.titulo, noticias.tema,
     noticias.ref_id_utilizador, noticias.data_publicacao, noticias.ativo, utilizadores.nome_utilizador, 
     utilizadores.id_utilizador, utilizadores.id_user, noticias.tipo, noticias.cabecalho, noticias.extensao, 
     noticias.preview
    FROM noticias
    INNER JOIN utilizadores ON utilizadores.id_utilizador = noticias.ref_id_utilizador
    WHERE noticias.id_noticias = ?");

    $result->bind_param('s', $name);
    $result->execute();
    $result->bind_result($idNoticias, $para1, $para2, $titulo, $tema, $refIdUT,
        $dataPub, $ativo, $nomeUtilizador, $idUtilizador, $idUser, $tipo, $cabecalho, $extensao, $preview);
    $result->fetch();
    $result->close();

    if ($ativo == 0) {
        header('location:/publications');
    }

    if ($refIdUT != $_SESSION['idUtilizador']) {
        header('location:/publications');
    }

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
    <?php metas() ?>

    <!--FAVICON-->
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="/images/favicon/green/apple-touch-icon-57x57.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/images/favicon/green/apple-touch-icon-114x114.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/images/favicon/green/apple-touch-icon-72x72.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/images/favicon/green/apple-touch-icon-144x144.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="/images/favicon/green/apple-touch-icon-60x60.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="/images/favicon/green/apple-touch-icon-120x120.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="/images/favicon/green/apple-touch-icon-76x76.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="/images/favicon/green/apple-touch-icon-152x152.png"/>
    <link rel="icon" type="image/png" href="/images/favicon/green/favicon-196x196.png" sizes="196x196"/>
    <link rel="icon" type="image/png" href="/images/favicon/green/favicon-96x96.png" sizes="96x96"/>
    <link rel="icon" type="image/png" href="/images/favicon/green/favicon-32x32.png" sizes="32x32"/>
    <link rel="icon" type="image/png" href="/images/favicon/green/favicon-16x16.png" sizes="16x16"/>
    <link rel="icon" type="image/png" href="/images/favicon/green/favicon-128.png" sizes="128x128"/>
    <meta name="application-name" content="MCMM"/>
    <meta name="msapplication-TileColor" content="#FFFFFF"/>
    <meta name="msapplication-TileImage" content="/images/favicon/green/mstile-144x144.png"/>
    <meta name="msapplication-square70x70logo" content="/images/favicon/green/mstile-70x70.png"/>
    <meta name="msapplication-square150x150logo" content="/images/favicon/green/mstile-150x150.png"/>
    <meta name="msapplication-wide310x150logo" content="/images/favicon/green/mstile-310x150.png"/>
    <meta name="msapplication-square310x310logo" content="/images/favicon/green/mstile-310x310.png"/>

    <link rel="stylesheet" href="/styles/main-5071e0f3e9.css">

    <script src="/scripts/vendor/modernizr-9d550bd14f.js"></script>

    <?php
    if ($tipo == "video") echo "<script type=\"text/javascript\" src=\"http://content.jwplatform.com/libraries/G1vj4svv.js\"></script>";
    ?>

</head>

<body data-offset="80" data-target=".navbar" data-spy="scroll" id="news">

<?php menu('', '../../') ?>

<div id="platform">

    <div class="projects-header">
        <div class="contents" style="background-image: url(/images/backgrounds/publicar_noticia_normal.jpg)">
            <div class="container">
                <div class="row">
                    <div class="description">
                        <h2 class="title">
                            <?php
                            switch ($tipo) {
                                case "normal":
                                    echo "Normal";
                                    break;
                                case "slider":
                                    echo "Slider";
                                    break;
                                case "text":
                                    echo "Texto";
                                    break;
                                case "video":
                                    echo "Vídeo";
                                    break;
                            } ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section section-gray">
        <div class="container">
            <div class="row">

                <div class="col-xs-12 steps-wrapper">

                    <?php

                    switch ($tipo) {
                        case "normal":
                            echo "
                                <form id=\"publish-news-normal\" method=\"post\" class=\"form-horizontal\" enctype=\"multipart/form-data\">
         
                                    <h2>Identificação</h2>
                                    <section data-step=\"0\">
                                    
                                        <input type='hidden' name='id_news' value='$idNoticias'>
            
                                        <div class=\"col-xs-12 col-md-6\">
                                            <div class=\"form-group\">
                                                <div class=\"col-xs-12\">
                                                    <input id=\"titulo\" class=\"form-control\" value='$titulo'
                                                           type=\"text\" placeholder=\"Título\" name=\"titulo\">
                                                </div>
                                            </div>
                                        </div>
            
                                        <div class=\"col-xs-12 col-md-6\">
                                            <div class=\"form-group\">
                                                <div class=\"col-xs-12\">
                                                    <input id=\"tema\" class=\"form-control\" value='$tema'
                                                           type=\"text\" placeholder=\"Tema\" name=\"tema\">
                                                </div>
                                            </div>
                                        </div>
            
                                        <div class=\"col-xs-12\">
                                            <div class=\"form-group\">
                                                <div class=\"col-xs-12 text-area\">
                                                    <textarea id=\"cabecalho\" class=\"form-control\" rows=\"4\"
                                                              placeholder=\"Lead (Cabeçalho)\"
                                                              name=\"cabecalho\">$cabecalho</textarea>
                                                </div>
                                            </div>
                                        </div>
            
                                        <div class=\"input col-xs-12 no-padding\">
                                            <div class=\"col-xs-12\">
                                                <div class=\"image text-center\">
                                                    <img id=\"upload_img\" 
                                                         style=\"height:700px !important; max-height: 700px !important;\"
                                                         src=\"/api/utilizadores/noticias/$idNoticias.jpg\">
                                                </div>
                                            </div>
                                        </div>
            
            
                                    </section>
            
                                    <h2>Descrição</h2>
                                    <section data-step=\"1\">
            
                                        <div class=\"col-xs-12\">
                                            <div class=\"form-group\">
                                                <div class=\"col-xs-12\">
                                                    <div class=\"editable-1 medium-editable\" data-name=\"para_1\">$para1</div>
                                                    
                                                    <input type=\"text\" id=\"para_1_hidden\" name=\"para_1\" class=\"input-off\"
                                                    value='" . strip_tags($para1) . "'/>
                                                    
                                                    <input type=\"hidden\" id=\"para_1_submit\" name=\"para_1_submit\" 
                                                    value='$para1' class=\"input-off\"/>
                                                </div>
                                            </div>
                                        </div>
            
                                        <div class=\"col-xs-12\">
                                            <hr>
                                        </div>
            
                                        <div class=\"col-xs-12\">
                                            <div class=\"form-group\">
                                                <div class=\"col-xs-12\">
                                                    <div class=\"editable-2 medium-editable\" data-name=\"para_2\">$para2</div>
                                                    
                                                    <input type=\"text\" id=\"para_2_hidden\" name=\"para_2\" class=\"input-off\"
                                                    value='" . strip_tags($para2) . "'/>
                                                    
                                                    <input type=\"hidden\" id=\"para_2_submit\" name=\"para_2_submit\" 
                                                    value='$para2' class=\"input-off\"/>
                                                </div>
                                            </div>
                                        </div>
            
                                    </section>
            
                                </form>
                            ";
                            break;
                        case "text":
                            echo "
                            <form id=\"publish-news-text\" method=\"post\" class=\"form-horizontal\" enctype=\"multipart/form-data\">
        
                                <h2>Identificação</h2>
                                <section data-step=\"0\">
        
                                    <input type='hidden' name='id_news' value='$idNoticias'>
        
                                    <div class=\"col-xs-12 col-md-6\">
                                        <div class=\"form-group\">
                                            <div class=\"col-xs-12\">
                                                <input id=\"titulo\" class=\"form-control\" value='$titulo'
                                                       type=\"text\" placeholder=\"Título\" name=\"titulo\">
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class=\"col-xs-12 col-md-6\">
                                        <div class=\"form-group\">
                                            <div class=\"col-xs-12\">
                                                <input id=\"tema\" class=\"form-control\" value='$tema'
                                                       type=\"text\" placeholder=\"Tema\" name=\"tema\">
                                            </div>
                                        </div>
                                    </div>
        
                                </section>
        
                                <h2>Descrição</h2>
                                <section data-step=\"1\">
        
                                    <div class=\"col-xs-12\">
                                        <div class=\"form-group\">
                                            <div class=\"col-xs-12\">
                                                <div class=\"editable-1 medium-editable\" data-name=\"para_1\">$para1</div>
                                                <input type=\"text\" id=\"para_1_hidden\" name=\"para_1\" class=\"input-off\"
                                                value='" . strip_tags($para1) . "'/>
                                                <input type=\"hidden\" id=\"para_1_submit\" name=\"para_1_submit\" class=\"input-off\"
                                                value='$para1'/>
                                            </div>
                                        </div>
                                    </div>
        
                                </section>
        
                            </form>";
                            break;
                        case "slider":
                            echo "
                                <form id=\"publish-news-slider\" method=\"post\" class=\"form-horizontal\" enctype=\"multipart/form-data\">
         
                                    <h2>Identificação</h2>
                                    <section data-step=\"0\">
                                    
                                        <input type='hidden' name='id_news' value='$idNoticias'>
            
                                        <div class=\"col-xs-12 col-md-6\">
                                            <div class=\"form-group\">
                                                <div class=\"col-xs-12\">
                                                    <input id=\"titulo\" class=\"form-control\" value='$titulo'
                                                           type=\"text\" placeholder=\"Título\" name=\"titulo\">
                                                </div>
                                            </div>
                                        </div>
            
                                        <div class=\"col-xs-12 col-md-6\">
                                            <div class=\"form-group\">
                                                <div class=\"col-xs-12\">
                                                    <input id=\"tema\" class=\"form-control\" value='$tema'
                                                           type=\"text\" placeholder=\"Tema\" name=\"tema\">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class=\"col-xs-12 input no-padding\">";

                            for ($i = 1; $i <= 4; $i++) {
                                if (file_exists("api/utilizadores/noticias/" . $idNoticias . "_$i.jpg")) {
                                    echo "
                                                <div class=\"col-xs-12 col-md-3\">
                                                    <div class=\"form-group\">
                                                        <div class=\"col-xs-12\">
                                                            <div class=\"multiple-image text-center\">
                                                                <img src=\"/api/utilizadores/noticias/" . $idNoticias . "_$i.jpg\">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>";
                                }
                            }

                            echo "
                                        </div>
                                    </section>
            
                                    <h2>Descrição</h2>
                                    <section data-step=\"1\">
            
                                        <div class=\"col-xs-12\">
                                            <div class=\"form-group\">
                                                <div class=\"col-xs-12\">
                                                    <div class=\"editable-1 medium-editable\" data-name=\"para_1\">$para1</div>
                                                    
                                                    <input type=\"text\" id=\"para_1_hidden\" name=\"para_1\" class=\"input-off\"
                                                    value='" . strip_tags($para1) . "'/>
                                                    
                                                    <input type=\"hidden\" id=\"para_1_submit\" name=\"para_1_submit\" 
                                                    value='$para1' class=\"input-off\"/>
                                                </div>
                                            </div>
                                        </div>
            
                                        <div class=\"col-xs-12\">
                                            <hr>
                                        </div>
            
                                        <div class=\"col-xs-12\">
                                            <div class=\"form-group\">
                                                <div class=\"col-xs-12\">
                                                    <div class=\"editable-2 medium-editable\" data-name=\"para_2\">$para2</div>
                                                    
                                                    <input type=\"text\" id=\"para_2_hidden\" name=\"para_2\" class=\"input-off\"
                                                    value='" . strip_tags($para2) . "'/>
                                                    
                                                    <input type=\"hidden\" id=\"para_2_submit\" name=\"para_2_submit\" 
                                                    value='$para2' class=\"input-off\"/>
                                                </div>
                                            </div>
                                        </div>
            
                                    </section>
            
                                </form>
                            ";
                            break;
                        case "video":
                            echo "
                            <form id=\"publish-news-video\" method=\"post\" class=\"form-horizontal\" enctype=\"multipart/form-data\">
        
                                <h2>Identificação</h2>
                                <section data-step=\"0\">
                                
                                    <input type='hidden' name='id_news' value='$idNoticias'>
        
                                    <div class=\"col-xs-12 col-md-6\">
                                        <div class=\"form-group\">
                                            <div class=\"col-xs-12\">
                                                <input id=\"titulo\" class=\"form-control\" value='$titulo'
                                                       type=\"text\" placeholder=\"Título\" name=\"titulo\">
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class=\"col-xs-12 col-md-6\">
                                        <div class=\"form-group\">
                                            <div class=\"col-xs-12\">
                                                <input id=\"tema\" class=\"form-control\" value='$tema'
                                                       type=\"text\" placeholder=\"Tema\" name=\"tema\">
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class=\"input col-xs-12 no-padding\">
        
                                        <div class=\"col-xs-12\">
                                           
                                            <div class=\"video\">
                                                <div id=\"video-upload\">
        
                                                </div>
                                            </div>
        
                                            <script>
                                                window.onload = function () {
                                                    var url = \"/api/utilizadores/noticias/$idNoticias.$extensao\";
                                                    jwplayer(\"video-upload\").setup({
                                                        file: url,
                                                        autostart: false
                                                    });
                                                };
                                            </script>   
                                        </div>
                                    </div>
        
                                </section>
        
                                <h2>Descrição</h2>
                                <section data-step=\"1\">
        
                                    <div class=\"col-xs-12\">
                                        <div class=\"form-group\">
                                            <div class=\"col-xs-12\">
                                                <div class=\"editable-1 medium-editable\" data-name=\"para_1\">$para1</div>
                                                <input type=\"text\" id=\"para_1_hidden\" name=\"para_1\" class=\"input-off\"
                                                value='" . strip_tags($para1) . "'/>
                                                <input type=\"hidden\" id=\"para_1_submit\" name=\"para_1_submit\" class=\"input-off\"
                                                value='$para1'/>
                                            </div>
                                        </div>
                                    </div>
        
                                </section>
        
                            </form>
                            ";
                            break;
                    }

                    ?>

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
                    A Editar...
                </h4>
            </div>
            <div class="modal-body">
                <div class="progress">
                    <div id="progress_bar" class="progress-bar progress-bar-green progress-bar-striped active"
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

<?php

switch ($tipo) {
    case "normal":
        echo "<script src='/scripts/edit/news-normal.js'></script>";
        break;
    case "slider":
        echo "<script src='/scripts/edit/news-slider.js'></script>";
        break;
    case "text":
        echo "<script src='/scripts/edit/news-text.js'></script>";
        break;
    case "video":
        echo "<script src='/scripts/edit/news-video.js'></script>";
        break;
}

?>

<script src="/scripts/main.js"></script>

</body>
</html>
