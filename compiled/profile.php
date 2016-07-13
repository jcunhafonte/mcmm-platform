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


if (isset($name)) {

    if ($_SESSION['idUser'] !== $name) {

        $result = $conn->prepare("SELECT id_utilizador FROM utilizadores WHERE id_user = ?");
        $result->bind_param('s', $name);
        $result->execute();
        $result->store_result();
        $row_number = $result->num_rows;

        if ($row_number > 0) {
            $result->close();
        } else {
            $result->close();
            header('location:/@' . $_SESSION['idUser']);
        }

        $result = $conn->prepare("UPDATE utilizadores SET num_visitas = (num_visitas + 1) WHERE id_user = ?");
        $result->bind_param('s', $name);
        $result->execute();
        $result->close();

        $result = $conn->prepare("
SELECT id_utilizador, nome_utilizador, email, data_registo, ultima_visita, num_visitas, sobre, id_user, ativo, validado 
FROM utilizadores WHERE id_user = ?");

        $result->bind_param('s', $name);
        $result->execute();
        $result->bind_result($idUtilizador, $nomeUtilizador, $emailUtilizador, $dataRegisto,
            $ultimaVisitaUtilizador, $numVisitasPerfil, $sobreUtilizador, $idUser, $ativo, $validado);
        $result->fetch();
        $result->close();

        if ($validado == 0) {
            header('location:/@' . $_SESSION['idUser']);
        }

        if ($ativo == 0) {
            header('location:/@' . $_SESSION['idUser']);
        }

    } else {

        $result = $conn->prepare("SELECT id_utilizador, nome_utilizador, email, data_registo, ultima_visita,
                    num_visitas, sobre, id_user
                    FROM utilizadores WHERE email = ?");
        $result->bind_param('s', $_SESSION['emailUtilizador']);
        $result->execute();
        $result->bind_result($idUtilizador, $nomeUtilizador, $emailUtilizador, $dataRegisto,
            $ultimaVisitaUtilizador, $numVisitasPerfil, $sobreUtilizador, $idUser);
        $result->fetch();
        $result->close();

        // Variável ID Utilizador
        $_SESSION['idUtilizador'] = $idUtilizador;

        // Variável Email Utilizador
        $_SESSION['emailUtilizador'] = $emailUtilizador;

        // Variável Sessão Nome
        $_SESSION['nomeUtilizador'] = $nomeUtilizador;

        // Varíavel Sessão Data Registo
        $dataRegistoUtilizador = DateTime::createFromFormat('Y-m-d H:i:s', $dataRegisto);
        $dataRegistoUtilizador = $dataRegistoUtilizador->format('Y-m-d');
        $_SESSION['dataRegistoUtilizador'] = $dataRegistoUtilizador;

        // Variável Sessão Hora Visita
        $_SESSION['diasUltimaVisitaUtilizador'] = $ultimaVisitaUtilizador;

        $ultimaVisitaUtilizador = new DateTime($ultimaVisitaUtilizador);
        $dataAtual = new DateTime(date('Y-m-d H:i:s'));
        $diferenca = $dataAtual->diff($ultimaVisitaUtilizador);
        $ultimaVisitaHoras = $diferenca->h;
        $ultimaVisitaHoras = $ultimaVisitaHoras + ($diferenca->days * 24);
        $_SESSION['horaUltimaVisitaUtilizador'] = $ultimaVisitaHoras;

        $_SESSION['visualizacoesPerfil'] = $numVisitasPerfil;
        $_SESSION['sobreUtilizador'] = $sobreUtilizador;
        $_SESSION['idUser'] = $idUser;

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
    <? metas() ?>

    <!--FAVICON-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

    <div class="users-header">
        <div class="contents" style="background-image: url(/images/backgrounds/perfil.jpg)">
            <div class="container">
                <div class="row">
                    <div class="informations">
                        <div class="texts">
                            <div class="principal">

                                <?php

                                if (isset($name)) {

                                    if ($_SESSION['idUser'] == $name) {

                                        echo "<img class='img-circle avatar' ";
                                        echo "src='/api/utilizadores/perfis/";
                                        echo $_SESSION['idUtilizador'];
                                        echo ".jpg'";
                                        echo " />";
                                        echo "<h2 class=\"username\">";
                                        echo h($_SESSION['nomeUtilizador']);
                                        echo "</h2>";

                                    } else {

                                        echo "<img class='img-circle avatar' ";
                                        echo "src='/api/utilizadores/perfis/";
                                        echo $idUtilizador;
                                        echo ".jpg'";
                                        echo " />";
                                        echo "<h2 class=\"username\">";
                                        echo h($nomeUtilizador);
                                        echo "</h2>";

                                    }
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section section-gray">
        <div class="users-profile">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 no-padding">
                        <div class="header col-xs-4">
                            <h2>Sobre</h2>
                        </div>

                        <div class="col-xs-8">

                            <?php

                            if (isset($name)) {

                                if ($_SESSION['idUser'] == $name) {

                                    echo
                                    "<a href=\"#\" class=\"btn btn-info btn-edit-profile pull-right\" data-toggle=\"modal\"
                               data-target=\".modal-settings\">Definições</a>
                                
                               <a style=\"margin-right: 10px\" href=\"#\" class=\"btn btn-info btn-edit-profile pull-right\"
                               data-toggle=\"modal\"
                               data-target=\".modal-profile\">Editar</a>";

                                }

                            }
                            ?>

                        </div>

                    </div>

                    <div class="col-xs-12 no-padding">

                        <div class="wrapper">
                            <div class="text">
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                    <p class="about">
                                        <?php

                                        if (isset($name)) {

                                            if ($_SESSION['idUser'] == $name) {

                                                if ($_SESSION['sobreUtilizador'] > "") {
                                                    echo h($_SESSION['sobreUtilizador']);
                                                } else {
                                                    echo "Ainda não adicionaste um texto sobre ti.";
                                                }

                                            } else {
                                                if ($sobreUtilizador > "") {
                                                    echo h($sobreUtilizador);
                                                } else {
                                                    echo "Este utilizador ainda não adicionou um texto sobre si.";
                                                }
                                            }
                                        }
                                        ?>
                                    </p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 topics">

                                    <?php

                                    if (isset($name)) {

                                        if ($_SESSION['idUser'] == $name) {

                                            $diasPassados = date_create()->diff(date_create($_SESSION['diasUltimaVisitaUtilizador']))->days;

                                            if ($diasPassados == 0) {
                                                $diasPassados = "Hoje";
                                            } else {
                                                if ($diasPassados == 1) {
                                                    $diasPassados = "Ontem";
                                                } else {
                                                    $diasPassados = "há " . $diasPassados . " dias";
                                                }
                                            }

                                            $dataReg = strtotime($_SESSION['dataRegistoUtilizador']);
                                            $dataReg = date('Y-m-j', $dataReg);

                                            $meses = array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
                                            $data = explode("-", $dataReg);

                                            $dia = $data[2];
                                            $mes = $data[1];
                                            $ano = $data[0];
                                            $textoData = $dia . " de " . $meses[($mes) - 1] . ", " . $ano;

                                            echo "
                                             <div>
                                        </div>
                                    <div>
                                        <div class=\"col-sm-4 col-md-4 nopadding\">
                                            <h4>Registo</h4>
                                            <p>";
                                            echo $textoData;
                                            echo "</p>
                                        </div>

                                        <div class=\"col-sm-4 col-md-4 nopadding\">
                                            <h4>Última Visita</h4>
                                            <p>$diasPassados</p>
                                        </div>
                                        <div class=\"col-sm-4 col-md-4 nopadding\">
                                            <h4>Visualizações</h4>
                                            <p>";
                                            echo $_SESSION['visualizacoesPerfil'];
                                            echo "</p>
                                        </div>
                                    </div>";

                                        } else {

                                            $diasPassados = date_create()->diff(date_create($ultimaVisitaUtilizador))->days;

                                            if ($diasPassados == 0) {
                                                $diasPassados = "Hoje";
                                            } else {
                                                if ($diasPassados == 1) {
                                                    $diasPassados = "Ontem";
                                                } else {
                                                    $diasPassados = "há " . $diasPassados . " dias";
                                                }
                                            }

                                            $dataReg = strtotime($dataRegisto);
                                            $dataReg = date('Y-m-j', $dataReg);

                                            $meses = array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
                                            $data = explode("-", $dataReg);

                                            $dia = $data[2];
                                            $mes = $data[1];
                                            $ano = $data[0];
                                            $textoData = $dia . " de " . $meses[($mes) - 1] . ", " . $ano;

                                            echo "
                                             <div>
                                        <div class=\"col-sm-4 col-md-4 nopadding\">
                                            <h4>Publicações</h4>
                                            <p>Night Sky Desktop</p>
                                        </div>

                                        <div class=\"col-sm-4 col-md-4 nopadding\">
                                            <h4>Seguidores</h4>
                                            <p>Desktop II</p>
                                        </div>
                                        <div class=\"col-sm-4 col-md-4 nopadding\">
                                            <h4>Seguindo</h4>
                                            <p>Desktop II</p>
                                        </div>
                                    </div>
                                    <div>
                                        <div class=\"col-sm-4 col-md-4 nopadding\">
                                            <h4>Registo</h4>
                                            <p>";
                                            echo $textoData;
                                            echo "</p>
                                        </div>

                                        <div class=\"col-sm-4 col-md-4 nopadding\">
                                            <h4>Última Visita</h4>
                                            <p>$diasPassados</p>
                                        </div>
                                        <div class=\"col-sm-4 col-md-4 nopadding\">
                                            <h4>Visualizações</h4>
                                            <p>";
                                            echo $numVisitasPerfil;
                                            echo "</p>
                                        </div>
                                    </div>";

                                        }
                                    }

                                    ?>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php footer() ?>
    <?php channel() ?>
</div>

<!--MODALS-->
<?php

require_once 'api/funcoes/modals.php';
//modals();

echo "<div class=\"container\">
    <div id=\"modal-socials\">
        <div class=\"modal fade modal-profile\" id=\"edit-profile\">
            <button type=\"button\" class=\"out-close close hidden-xs\" data-dismiss=\"modal\"
                    aria-hidden=\"true\">&times;</button>
            <div class=\"modal-dialog vertical-align-center animated\">
                <div class=\"modal-content\">

                    <form method=\"post\" accept-charset=\"UTF-8\" id=\"edit_profile\" enctype=\"multipart/form-data\">
                        <div class=\"modal-header\">
                            <button type=\"button\" class=\"close hidden-sm hidden-md hidden-lg\" data-dismiss=\"modal\"
                                    aria-hidden=\"true\">&times;</button>
                            <h4 class=\"modal-title text-center\">Editar</h4>
                        </div>

                        <div class=\"modal-body\">
                            <div class=\"content\">
                                <div class=\"form\">

                                    <div class=\"form-group\">
                                        <div class=\"col-xs-12 text-center\">
                                            <img class=\"img-circle\"
                                                 src=\"/api/utilizadores/perfis/";
echo $_SESSION['idUtilizador'];
echo ".jpg\"
                                                 id=\"img-user\"/>
                                            <input accept=\"image/jpg, image/jpeg, image/png\" name=\"image\" type=\"file\"
                                                   id=\"my_file\" style=\"display:none;\"/>
                                            <div class=\"control-img\">
                                                <img src=\"images/icons/photo-camera.png\">
                                            </div>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <div class=\"col-xs-12\">
                                            <input id=\"nome\" class=\"form-control\"
                                                   type=\"text\" placeholder=\"Nome\" name=\"nome\" value='";
echo h($_SESSION['nomeUtilizador']);
echo "'>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <div class=\"col-xs-12\">
                                            <textarea id=\"sobre\" class=\"form-control\" placeholder=\"Sobre\"
                                                      rows=\"5\" name=\"sobre\">";
echo h($_SESSION['sobreUtilizador']);
echo "</textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class=\"modal-footer\">
                            <button type=\"button\" class=\"btn btn-default btn-simple btn-cancel\" data-dismiss=\"modal\">
                                Cancelar
                            </button>
                            <button type=\"submit\" class=\"btn btn-info btn-simple btn-save\">Guardar</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>";
?>

<div class="modal fade" id="myPleaseWait" tabindex="-1"
     role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">
                    A Guardar...
                </h4>
            </div>
            <div class="modal-body">
                <div class="progress" style="margin-right: 15px;margin-left: 15px">
                    <div id="progress_bar" class="progress-bar progress-bar-green progress-bar-striped active"
                         style="width: 0%">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="scripts/vendor-c259ccb7d9.js"></script>

<script src="scripts/plugins-aaf19e1ea7.js"></script>

<script src="scripts/profile-1e5945a529.js"></script>

<script src="scripts/main.js"></script>

</body>
</html>
