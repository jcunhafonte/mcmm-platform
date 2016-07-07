<?php

session_start();

require_once 'api/funcoes/utils.php';
require_once 'api/funcoes/menu.php';
require_once 'api/funcoes/footer.php';
require_once 'api/connection/mysql.php';

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

    <style>
        #platform .table > tbody > tr > td {
            color: #2b2e33;
        }
    </style>

</head>

<body data-offset="80" data-target=".navbar" data-spy="scroll">

<?php menu() ?>

<div id="platform">

    <div class="projects-header">
        <div class="contents" style="background-image: url(/images/backgrounds/publicacoes.jpg)">
            <div class="container">
                <div class="row">
                    <div class="description">
                        <h2 class="title">Publicações</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section section-gray">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="publications">

                        <div class="news">
                            <h2>Notícias</h2>

                            <?php

                            $result = $conn->prepare("
                            SELECT noticias.id_noticias, noticias.titulo, noticias.ref_id_utilizador, 
                            noticias.data_publicacao, noticias.ativo
                            FROM noticias
                            WHERE noticias.ativo = 1
                            AND noticias.ref_id_utilizador = ?
                            ORDER BY noticias.data_publicacao DESC ");

                            $result->bind_param('s', $_SESSION['idUtilizador']);
                            $result->execute();
                            $result->store_result();
                            $row_number = $result->num_rows;

                            if ($row_number > 0) {

                                $result->close();

                                echo "  
                                <div class=\"table-responsive\">
                                    <table class=\"table\">
                                        <thead>
                                        <tr>
                                            <th>Título</th>
                                            <th class=\"text-right\">Gestão</th>
                                        </tr>
                                        </thead>
                                        <tbody>";

                                $result = $conn->prepare("
                                SELECT noticias.id_noticias, noticias.titulo, noticias.ref_id_utilizador, 
                                noticias.data_publicacao, noticias.ativo
                                FROM noticias
                                WHERE noticias.ativo = 1
                                AND noticias.ref_id_utilizador = ?
                                ORDER BY noticias.data_publicacao DESC");

                                $result->bind_param('s', $_SESSION['idUtilizador']);
                                $result->execute();
                                $result->bind_result($idNoticias, $titulo, $refIdUT, $dataPub, $ativo);

                                while ($result->fetch()) {

                                    echo "
                                    <tr id='new-list-$idNoticias'>
                                        <td>" . h($titulo) . "</td>
                                        <td class=\"text-right\">
                                            <button type=\"button\" onclick=\"window.location='/new/$idNoticias'\"
                                                    class=\"btn btn-info btn-simple\"
                                                    data-placement=\"top\" rel=\"tooltip\" title=\"Visualizar\">
                                                <i class=\"fa fa-eye\"></i>
                                            </button>
                                            <button type=\"button\" onclick=\"window.location='/edit/new/$idNoticias'\"
                                                    rel=\"tooltip\"
                                                    class=\"btn btn-success btn-simple\"
                                                    data-original-title=\"Editar\">
                                                <i class=\"fa fa-edit\"></i>
                                            </button>
                                            <button type=\"button\" rel=\"tooltip\"
                                                    class=\"btn btn-danger btn-simple remove-new\"
                                                    data-original-title=\"Remover\"
                                                    data-toggle=\"modal\" data-target=\".modal-remove-new\"
                                                    data-new='$idNoticias'>
                                                <i class=\"fa fa-times\"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    ";
                                }
                                $result->close();

                                echo "
                                        </tbody>
                                    </table>
                                </div>";
                            } else {
                                $result->close();
                                echo "<p style=\"color: #2b2e33\">Ainda não publicaste notícias</p>";
                            }
                            ?>

                        </div>

                        <div class="projects">
                            <h2>Projetos</h2>

                            <?php
                            $result = $conn->prepare("
                            SELECT projetos.id_projetos, projetos.titulo, projetos.ref_id_utilizador, 
                            projetos.data_publicacao, projetos.ativo
                            FROM projetos
                            WHERE projetos.ativo = 1
                            AND projetos.ref_id_utilizador = ?
                            ORDER BY projetos.data_publicacao DESC ");

                            $result->bind_param('s', $_SESSION['idUtilizador']);
                            $result->execute();
                            $result->store_result();
                            $row_number = $result->num_rows;

                            if ($row_number > 0) {
                                $result->close();

                                echo "  
                                <div class=\"table-responsive\">
                                    <table class=\"table\">
                                        <thead>
                                        <tr>
                                            <th>Título</th>
                                            <th class=\"text-right\">Gestão</th>
                                        </tr>
                                        </thead>
                                        <tbody>";

                                $result = $conn->prepare("
                                SELECT projetos.id_projetos, projetos.titulo, projetos.ref_id_utilizador, 
                                projetos.data_publicacao, projetos.ativo
                                FROM projetos
                                WHERE projetos.ativo = 1
                                AND projetos.ref_id_utilizador = ?
                                ORDER BY projetos.data_publicacao DESC");

                                $result->bind_param('s', $_SESSION['idUtilizador']);
                                $result->execute();
                                $result->bind_result($idProjetos, $titulo, $refIdUT, $dataPub, $ativo);

                                while ($result->fetch()) {
                                    echo "
                                    <tr id='project-list-$idProjetos'>
                                        <td>" . h($titulo) . "</td>
                                        <td class=\"text-right\">
                                            <button type=\"button\" onclick=\"window.location='/project/$idProjetos'\"
                                                    class=\"btn btn-info btn-simple\"
                                                    data-placement=\"top\" rel=\"tooltip\" title=\"Visualizar\">
                                                <i class=\"fa fa-eye\"></i>
                                            </button>
                                            <button type=\"button\" onclick=\"window.location='/edit/project/$idProjetos'\"
                                                    rel=\"tooltip\"
                                                    class=\"btn btn-success btn-simple\"
                                                    data-original-title=\"Editar\">
                                                <i class=\"fa fa-edit\"></i>
                                            </button>
                                            <button type=\"button\" rel=\"tooltip\"
                                                    class=\"btn btn-danger btn-simple remove-project\"
                                                    data-original-title=\"Remover\"
                                                    data-toggle=\"modal\" data-target=\".modal-remove-project\"
                                                    data-project='$idProjetos'>
                                                <i class=\"fa fa-times\"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    ";
                                }
                                $result->close();
                                echo "
                                        </tbody>
                                    </table>
                                </div>";
                            } else {
                                $result->close();
                                echo "<p style=\"color: #2b2e33\">Ainda não publicaste projetos</p>";
                            }
                            ?>

                        </div>

                        <div class="videos">
                            <h2>Vídeos</h2>

                            <?php
                            $result = $conn->prepare("
                            SELECT videos.id_videos, videos.titulo, videos.ref_id_utilizador, 
                            videos.data_publicacao, videos.ativo
                            FROM videos
                            WHERE videos.ativo = 1
                            AND videos.ref_id_utilizador = ?
                            ORDER BY videos.data_publicacao DESC");

                            $result->bind_param('s', $_SESSION['idUtilizador']);
                            $result->execute();
                            $result->store_result();
                            $row_number = $result->num_rows;

                            if ($row_number > 0) {

                                $result->close();

                                echo "  
                                <div class=\"table-responsive\">
                                    <table class=\"table\">
                                        <thead>
                                        <tr>
                                            <th>Título</th>
                                            <th class=\"text-right\">Gestão</th>
                                        </tr>
                                        </thead>
                                        <tbody>";

                                $result = $conn->prepare("
                                SELECT videos.id_videos, videos.titulo, videos.ref_id_utilizador, 
                                videos.data_publicacao, videos.ativo
                                FROM videos
                                WHERE videos.ativo = 1
                                AND videos.ref_id_utilizador = ?
                                ORDER BY videos.data_publicacao DESC");

                                $result->bind_param('s', $_SESSION['idUtilizador']);
                                $result->execute();
                                $result->bind_result($idVideos, $titulo, $refIdUT, $dataPub, $ativo);

                                while ($result->fetch()) {

                                    echo "
                                    <tr id='video-list-$idVideos'>
                                        <td>" . h($titulo) . "</td>
                                        <td class=\"text-right\">
                                            <button type=\"button\" onclick=\"window.location='/video/$idVideos'\"
                                                    class=\"btn btn-info btn-simple\"
                                                    data-placement=\"top\" rel=\"tooltip\" title=\"Visualizar\">
                                                <i class=\"fa fa-eye\"></i>
                                            </button>
                                            <button type=\"button\" onclick=\"window.location='/edit/video/$idVideos'\"
                                                    rel=\"tooltip\"
                                                    class=\"btn btn-success btn-simple\"
                                                    data-original-title=\"Editar\">
                                                <i class=\"fa fa-edit\"></i>
                                            </button>
                                            <button type=\"button\" rel=\"tooltip\"
                                                    class=\"btn btn-danger btn-simple remove-video\"
                                                    data-original-title=\"Remover\"
                                                    data-toggle=\"modal\" data-target=\".modal-remove-video\"
                                                    data-video='$idVideos'>
                                                <i class=\"fa fa-times\"></i>
                                            </button>
                                        </td>
                                    </tr>";
                                }
                                $result->close();
                                echo "
                                        </tbody>
                                    </table>
                                </div>";
                            } else {
                                $result->close();
                                echo "<p style=\"color: #2b2e33\">Ainda não publicaste vídeos</p>";
                            }
                            ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php footer(); ?>

</div>

<?php

require_once 'api/funcoes/modals.php';
//modals();

?>

<div class="container">
    <div id="modal-socials">
        <div class="modal fade modal-remove-new" id="remove-new">
            <button type="button" class="out-close close hidden-xs" data-dismiss="modal"
                    aria-hidden="true">&times;</button>
            <div class="modal-dialog vertical-align-center animated">
                <div class="modal-content">
                    <form method="post" accept-charset="UTF-8" id="remove_new" enctype="multipart/form-data">
                        <div class="modal-header">
                            <button type="button" class="close hidden-sm hidden-md hidden-lg" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            <h4 class="modal-title text-center">Remover</h4>
                        </div>

                        <div class="modal-body text-center" style="padding: 15px">
                            <h5>
                                Tens a certeza que pretendes remover esta notícia?
                            </h5>
                            <h5>
                                Esta ação não pode ser revertida.<br>
                            </h5>
                            <input type="hidden" value="" id="remove_new_input">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-simple btn-cancel" data-dismiss="modal">
                                Cancelar
                            </button>
                            <button type="submit" class="btn btn-info btn-simple btn-save">Confirmar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade modal-remove-project" id="remove-project">
            <button type="button" class="out-close close hidden-xs" data-dismiss="modal"
                    aria-hidden="true">&times;</button>
            <div class="modal-dialog vertical-align-center animated">
                <div class="modal-content">
                    <form method="post" accept-charset="UTF-8" id="remove_project" enctype="multipart/form-data">
                        <div class="modal-header">
                            <button type="button" class="close hidden-sm hidden-md hidden-lg" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            <h4 class="modal-title text-center">Remover</h4>
                        </div>

                        <div class="modal-body text-center" style="padding: 15px">
                            <h5>
                                Tens a certeza que pretendes remover este projeto?
                            </h5>
                            <h5>
                                Esta ação não pode ser revertida.<br>
                            </h5>
                            <input type="hidden" value="" id="remove_project_input">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-simple btn-cancel" data-dismiss="modal">
                                Cancelar
                            </button>
                            <button type="submit" class="btn btn-info btn-simple btn-save">Confirmar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade modal-remove-video" id="remove-video">
            <button type="button" class="out-close close hidden-xs" data-dismiss="modal"
                    aria-hidden="true">&times;</button>
            <div class="modal-dialog vertical-align-center animated">
                <div class="modal-content">
                    <form method="post" accept-charset="UTF-8" id="remove_video" enctype="multipart/form-data">
                        <div class="modal-header">
                            <button type="button" class="close hidden-sm hidden-md hidden-lg" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            <h4 class="modal-title text-center">Remover</h4>
                        </div>

                        <div class="modal-body text-center" style="padding: 15px">
                            <h5>
                                Tens a certeza que pretendes remover este vídeo?
                            </h5>
                            <h5>
                                Esta ação não pode ser revertida.<br>
                            </h5>
                            <input type="hidden" value="" id="remove_video_input">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-simple btn-cancel" data-dismiss="modal">
                                Cancelar
                            </button>
                            <button type="submit" class="btn btn-info btn-simple btn-save">Confirmar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="scripts/vendor-c259ccb7d9.js"></script>

<script src="/scripts/plugins-aaf19e1ea7.js"></script>

<script src="scripts/publications-e4ad0a494d.js"></script>

<script src="scripts/main.js"></script>

<script src="scripts/publications.js"></script>

</body>
</html>
