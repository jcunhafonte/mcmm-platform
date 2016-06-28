<?php

session_start();

if (!isset($_SESSION['ativoAdmin'])) {

    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    header("location:entrar.php?url=$actual_link");

}

require_once('php/connection/dbconnection.php');


echo "<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <title>BN, Lda</title>
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no'/>
    <meta name='apple-mobile-web-app-capable' content='yes'/>

    <link rel='shortcut icon' href='assets/img/favicon.png'>
    <link rel='apple-touch-icon' href='assets/img/favicon.png'/>
    <link rel='apple-touch-icon' sizes='57x57' href='assets/img/apple-touch-icon-57x57.png'/>
    <link rel='apple-touch-icon' sizes='72x72' href='assets/img/apple-touch-icon-72x72.png'/>
    <link rel='apple-touch-icon' sizes='76x76' href='assets/img/apple-touch-icon-76x76.png'/>
    <link rel='apple-touch-icon' sizes='114x114' href='assets/img/apple-touch-icon-114x114.png'/>
    <link rel='apple-touch-icon' sizes='120x120' href='assets/img/apple-touch-icon-114x114.png'/>
    <link rel='apple-touch-icon' sizes='144x144' href='assets/img/apple-touch-icon-144x144.png'/>
    <link rel='apple-touch-icon' sizes='152x152' href='assets/img/apple-touch-icon-152x152.png'/>

    <!-- Base Css Files -->
    <link href='assets/libs/jqueryui/ui-lightness/jquery-ui-1.10.4.custom.min.css' rel='stylesheet'/>
    <link href='assets/libs/bootstrap/css/bootstrap.min.css' rel='stylesheet'/>
    <link href='assets/libs/font-awesome/css/font-awesome.min.css' rel='stylesheet'/>
    <link href='assets/libs/fontello/css/fontello.css' rel='stylesheet'/>
    <link href='assets/libs/animate-css/animate.min.css' rel='stylesheet'/>
    <link href='assets/libs/nifty-modal/css/component.css' rel='stylesheet'/>
    <link href='assets/libs/magnific-popup/magnific-popup.css' rel='stylesheet'/>
    <link href='assets/libs/ios7-switch/ios7-switch.css' rel='stylesheet'/>
    <link href='assets/libs/pace/pace.css' rel='stylesheet'/>
    <link href='assets/libs/sortable/sortable-theme-bootstrap.css' rel='stylesheet'/>
    <link href='assets/libs/bootstrap-datepicker/css/datepicker.css' rel='stylesheet'/>
    <link href='assets/libs/jquery-icheck/skins/all.css' rel='stylesheet'/>
    <!-- Code Highlighter for Demo -->
    <link href='assets/libs/prettify/github.css' rel='stylesheet'/>

    <!-- Extra CSS Libraries Start -->
    <link href='assets/libs/jquery-datatables/css/dataTables.bootstrap.css' rel='stylesheet' type='text/css'/>
    <link href='assets/libs/jquery-datatables/extensions/TableTools/css/dataTables.tableTools.css' rel='stylesheet'
          type='text/css'/>
    <link href='assets/css/style.css' rel='stylesheet' type='text/css'/>
    <!-- Extra CSS Libraries End -->
    <link href='assets/css/style-responsive.css' rel='stylesheet'/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js'></script>
    <script src='https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js'></script>
    <![endif]-->
</head>
<body class='fixed-left'>
<!-- Modal Start -->

<!-- Modal Logout -->
<div class='md-modal md-just-me' id='logout-modal'>
    <div class='md-content'>
        <h3>Confirmação da <strong>Saída</strong></h3>

        <div>
            <p class='text-center'>Tem a certeza que pretende abandonar a Plataforma de Gestão dos Recursos Humanos da
                Bento & Nascimento?</p>

            <p class='text-center'>
                <button class='btn btn-danger md-close'>Não</button>
                <a href='php/verificacoes/sair.php' class='btn btn-success md-close'>Sim, tenho a certeza</a>
            </p>
        </div>
    </div>
</div>
<!-- Modal End -->

<!-- Begin page -->
<div id='wrapper'>";

require_once('php/includes/menus.php');
Menus('presenca', 'registoPresenca');

echo "<!-- Start right content -->
    <div class='content-page'>
        <!-- ============================================================== -->
        <!-- Start Content here -->
        <!-- ============================================================== -->
        <div class='content'>
            <!-- Page Heading Start -->
            <div class='page-heading'>
                <h1><i class='fa fa-hand-o-up'></i> Visualizar Presenças</h1>

                <h3>Verifique as presenças realizadas pelos seus colaboradores</h3></div>

            <div class='row'>


   <div class='col-md-12'>";

if (isset($_GET['consultaRemovida'])) {

    $colaboradorRemovido = $_GET['consultaRemovida'];

    $query = "SELECT id_colaborador, nome_completo FROM colaborador
                        WHERE id_colaborador = ?";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'i', $colaboradorRemovido);
    mysqli_stmt_bind_result($stmt, $idColaboradorRemovido, $nomeCompletoRemovido);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    echo "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
               A consulta do colaborador <b>$nomeCompletoRemovido</b> foi removida com sucesso.<br>
               <a class='alert-link'>Votos de uma excelente experiência!</a></div>";
}

if (isset($_GET['consultaRemovidaErro'])) {

    $colaboradorRemovido = $_GET['consultaRemovidaErro'];

    $query = "SELECT id_colaborador, nome_completo FROM colaborador
                        WHERE id_colaborador = ?";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'i', $colaboradorRemovido);
    mysqli_stmt_bind_result($stmt, $idColaboradorRemovido, $nomeCompletoRemovido);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    echo "<div class='alert alert-danger alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
               Ocorreu um erro ao remover a consulta do colaborador <b>$nomeCompletoRemovido</b>.<br>
               <a class='alert-link'>Votos de uma excelente experiência!</a></div>";
}


echo "
 <div class='widget col-sm-12'>
                        <div class='widget-header transparent'>
                            <h2><strong>Inserir data de consulta</strong> (Mês e Ano) e <strong>Colaborador</strong> (Opcional)</h2>

                            <div class='additional-btn'>
                                <a href='#' class='hidden reload'><i class='icon-ccw-1'></i></a>
                                <a href='#' class='widget-toggle'><i class='icon-down-open-2'></i></a>
                            </div>
                        </div>
                        <div class='widget-content padding'>
                            <form class='form-horizontal' role='form' method='get'
                                  action='registoPresencas.php'>

                                <div class='form-group'>

                                    <div class='col-sm-3'>

                        <select class='form-control selectpicker'
                                name='mesPresenca' required='required'>
                                <option disabled selected value=''>Mês</option>";
   $mes_extenso = array(
        1 => 'Janeiro',
        2 => 'Fevereiro',
        3 => 'Março',
        4 => 'Abril',
        5 => 'Maio',
        6 => 'Junho',
        7 => 'Julho',
        8 => 'Agosto',
        9 => 'Setembro',
        10 => 'Outubro',
        11 => 'Novembro',
        12 => 'Dezembro'
    );

for ($mes = 1; $mes <= 12; $mes++) {

    echo "<option ";
    if (isset($_GET['mesPresenca'])) {
        if ($mes == $_GET['mesPresenca']) {
            echo "selected";
        }
    }
    echo " name='mesPresenca' value='$mes'>";
    echo $mes_extenso[$mes];
    echo "</option>";

}

echo "</select>
                                    </div>

                                    <div class='col-sm-3'>

                        <select class='form-control selectpicker'
                                name='anoPresenca' required='required'>
                                <option disabled selected value=''>Ano</option>";

for ($ano = 2013; $ano <= date('Y'); $ano++) {

    echo "<option ";
    if (isset($_GET['anoPresenca'])) {
        if ($ano == $_GET['anoPresenca']) {
            echo "selected";
        }
    }
    echo " name='anoPresenca' value='$ano'>";
    echo $ano;
    echo "</option>";

}
echo "</select>
                                    </div>
                                      <div class='col-sm-6'>

                        <select class='form-control selectpicker' name='colaboradorPresenca'>
                                <option selected value='0'>Todos os Colaboradores</option>";

$query = "SELECT id_colaborador, nome_completo FROM colaborador";
$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_result($stmt, $idColaborador, $nomeColaborador);
mysqli_stmt_execute($stmt);

while (mysqli_stmt_fetch($stmt)) {
    echo "<option ";

    if (isset($_GET['colaboradorPresenca'])) {
        if ($idColaborador == $_GET['colaboradorPresenca']) {
            echo "selected";
        }
    }

    echo " name='colaborador' value='$idColaborador'>
$nomeColaborador</option>";
}

mysqli_stmt_close($stmt);

echo "</select>
                                    </div>
                                </div>

                                <div class='form-group'>

                                    <div class='col-sm-12'>
                                        <button type='submit' style='width: 100% !important;'
                                                class='btn btn-default input-block-level'>Avançar</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>


                </div>

                <div class='col-md-12'>";

if ((isset($_GET['mesPresenca'])) AND (isset($_GET['anoPresenca'])) AND (isset($_GET['colaboradorPresenca'])) AND ($_GET['colaboradorPresenca'] == 0)) {

    $mes = $_GET['mesPresenca'];
    $ano = $_GET['anoPresenca'];
    $colaborador = $_GET['colaboradorPresenca'];

    $mes_extenso = array(
        1 => 'Janeiro',
        2 => 'Fevereiro',
        3 => 'Março',
        4 => 'Abril',
        5 => 'Maio',
        6 => 'Junho',
        7 => 'Julho',
        8 => 'Agosto',
        9 => 'Setembro',
        10 => 'Outubro',
        11 => 'Novembro',
        12 => 'Dezembro'
    );

    //get current month for example
    $beginday = date($ano . '-' . $mes . '-01');
    $lastday  = date($ano . '-' . $mes  . '-t');

    function getWorkingDays($startDate, $endDate)
{

    $hostname = "localhost";
    $username = "bentoena_RH123";
    $password = "bentoena_RH123";
    $bd = "bentoena_RH";

    $link = mysqli_connect($hostname, $username, $password, $bd);
    mysqli_set_charset($link,"utf8");

    $contaDias = false;
    $begin = strtotime($startDate);
    $end = strtotime($endDate);

    if ($begin > $end) {

        echo "startdate is in the future! <br />";
        return 0;

    } else {

        $no_days = 0;
        $weekends = 0;

        while ($begin <= $end) {

            $contaDias = false;
            $no_days++; // no of days in the given interval
            $what_day = date("N", $begin);

            //SELECT DIAS
            $query = "SELECT id_nao_uteis, descricao, data_dia FROM nao_uteis ORDER BY data_dia ASC";

            $stmt = mysqli_prepare($link, $query);
            mysqli_stmt_bind_result($stmt, $idNaoUtil, $descricao, $dataDia);
            mysqli_stmt_execute($stmt);

            while (mysqli_stmt_fetch($stmt)) {

                $conversaoDataAcidente = new DateTime($dataDia);
                $textoDataAcidente = $conversaoDataAcidente->format('Y-m-d');

                if ($startDate == $textoDataAcidente) {
                    $weekends++;
                    $contaDias = true;
                }
            }
            mysqli_stmt_close($stmt);

            if ($contaDias == false) {

                if ($what_day > 5) { // 6 and 7 are weekend days
                    $weekends++;
                };

            }

            $begin += 86400; // +1 day

            $startDate = strtotime("+1 day", strtotime($startDate));
            $startDate = date("Y-m-d", $startDate);

        };
        $working_days = $no_days - $weekends;

        return $working_days;
    }
}

    $nr_work_days = getWorkingDays($beginday, $lastday);

    $query = "SELECT colaborador.nome_completo, colaborador.id_colaborador,
colaborador.ativo FROM colaborador WHERE colaborador.id_colaborador = ?";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'i', $_GET['colaboradorPresenca']);
    mysqli_stmt_bind_result($stmt, $apresentaNomeFormacoes,
        $idColaboradorFormacoes, $ativoFormacoes);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    echo "<div class='widget'>
                        <div class='widget-header'>
                            <h2>Registo de Presenças - <strong>$mes_extenso[$mes] de $ano</strong> - $nr_work_days Dias Úteis - <strong>Todos os Colaboradores</strong></h2>

                            <div class='additional-btn'>
                                <a href='#' class='hidden reload'><i class='icon-ccw-1'></i></a>
                                <a href='#' class='widget-toggle'><i class='icon-down-open-2'></i></a>
                                <!-- -->
                            </div>
                        </div>
                        <div class='widget-content'>
                            <br>

                            <div class='table-responsive' style='overflow-x: hidden'>
                                <form class='form-horizontal' role='form'>
                                    <table id='datatables-3' class='table table-striped table-bordered' cellspacing='0'
                                           width='100%'>
                                        <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Função</th>
                                            <th>Estado</th>
                                            <th>Presenças</th>
                                            <th>Subsídio de Alimentação</th>
                                            <th>Ações</th>
                                        </tr>
                                        </thead>
                                        <tbody>";

    $query = "SELECT COUNT(presencas.id_presencas), presencas.ref_id_colaborador,
colaborador.nome_completo, colaborador.funcao, colaborador.ativo FROM presencas INNER JOIN colaborador ON
colaborador.id_colaborador = presencas.ref_id_colaborador WHERE (MONTH( presencas.data_presenca ) = ?)
AND (YEAR(presencas.data_presenca) = ?)
GROUP BY presencas.ref_id_colaborador ORDER BY colaborador.nome_completo ASC";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'ss', $mes, $ano);

    mysqli_stmt_bind_result($stmt, $numeroPresencas, $idColaborador,
        $nomeCompletoColaborador, $funcaoPresencas, $ativoColaborador);
    mysqli_stmt_execute($stmt);

    while (mysqli_stmt_fetch($stmt)) {

        if ($ativoColaborador == 1) {
            $textoEstado = "Atual Colaborador";
        } else {
            $textoEstado = "Antigo Colaborador";
        }

        echo "<tr>
                                            <td><a href='perfilColaborador.php?colaborador=$idColaborador'>
                                            $nomeCompletoColaborador</a></td>
                                            <td>$funcaoPresencas</td>
                                            <td>$textoEstado</td>
                                            <td class='text-center'>$numeroPresencas</td>
                                              <td class='text-center'>";
        $subsidioAlimentacao = $numeroPresencas * 8;
        echo $subsidioAlimentacao; echo ",00€</td>
                                           <td class='text-center'>
                                                <div class='btn-group btn-group-xs text-center'>
                                                <a href='presencaDetalhe.php?colaborador=$idColaborador&mesPresenca=$mes&anoPresenca=$ano' data-toggle='tooltip' title='Detalhes - $nomeCompletoColaborador'
                                                       class='text-center btn btn-default'><i
                                                            class='fa fa-eye'></i></a>
                                                </div>
                                            </td>
                                        </tr>";
    }
    mysqli_stmt_close($stmt);

    echo "</tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>";
}

if ((!isset($_GET['mesPresenca'])) AND (!isset($_GET['anoPresenca']))
    AND (!isset($_GET['colaboradorPresenca']))){

    echo "<div class='widget'>
                        <div class='widget-header'>
                            <h2><strong>Registo</strong> de Presenças</h2>

                            <div class='additional-btn'>
                                <a href='#' class='hidden reload'><i class='icon-ccw-1'></i></a>
                                <a href='#' class='widget-toggle'><i class='icon-down-open-2'></i></a>
                                <!-- -->
                            </div>
                        </div>
                        <div class='widget-content'>
                            <br>

                            <div class='table-responsive' style='overflow-x: hidden'>
                                <form class='form-horizontal' role='form'>
                                    <table id='datatables-3' class='table table-striped table-bordered' cellspacing='0'
                                           width='100%'>
                                        <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Função</th>
                                            <th>Estado</th>
                                            <th>Presenças</th>
                                            <th>Subsídio de Alimentação</th>
                                            <th style='display: none !important;'>&nbsp;</th>
                                        </tr>
                                        </thead>
                                        <tbody>";

    $query = "SELECT COUNT(presencas.id_presencas), presencas.ref_id_colaborador,
colaborador.nome_completo, colaborador.funcao, colaborador.ativo FROM presencas INNER JOIN colaborador ON
colaborador.id_colaborador = presencas.ref_id_colaborador GROUP BY presencas.ref_id_colaborador
 ORDER BY colaborador.nome_completo ASC";

    $stmt = mysqli_prepare($link, $query);

    mysqli_stmt_bind_result($stmt, $numeroPresencas, $idColaborador,
        $nomeCompletoColaboradorPresencas, $funcaoPresencas, $ativoColaborador);

    mysqli_stmt_execute($stmt);

    while (mysqli_stmt_fetch($stmt)) {

        if ($ativoColaborador == 1) {
            $textoEstado = "Atual Colaborador";
        } else {
            $textoEstado = "Antigo Colaborador";
        }

        echo "<tr>
                                             <td><a href='perfilColaborador.php?colaborador=$idColaborador'>
                                            $nomeCompletoColaboradorPresencas</a></td>
                                            <td>$funcaoPresencas</td>
                                            <td>$textoEstado</td>
                                            <td class='text-center'>$numeroPresencas</td>
                                            <td class='text-center'>";
        $subsidioAlimentacao = $numeroPresencas * 8;
        echo $subsidioAlimentacao; echo ",00€</td>
<td style='display: none!important;'>&nbsp;</td>
                                        </tr>";
    }
    mysqli_stmt_close($stmt);

    echo "</tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>";
}

if ((isset($_GET['mesPresenca'])) AND (isset($_GET['anoPresenca'])) AND (!isset($_GET['colaboradorPresenca']))) {

    $mes = $_GET['mesPresenca'];
    $ano = $_GET['anoPresenca'];

    $mes_extenso = array(
        1 => 'Janeiro',
        2 => 'Fevereiro',
        3 => 'Março',
        4 => 'Abril',
        5 => 'Maio',
        6 => 'Junho',
        7 => 'Julho',
        8 => 'Agosto',
        9 => 'Setembro',
        10 => 'Outubro',
        11 => 'Novembro',
        12 => 'Dezembro'
    );

    //get current month for example
    $beginday = date($ano . '-' . $mes . '-01');
    $lastday  = date($ano . '-' . $mes  . '-t');

    function getWorkingDays($startDate, $endDate)
{

    $hostname = "localhost";
    $username = "bentoena_RH123";
    $password = "bentoena_RH123";
    $bd = "bentoena_RH";

    $link = mysqli_connect($hostname, $username, $password, $bd);
    mysqli_set_charset($link,"utf8");

    $contaDias = false;
    $begin = strtotime($startDate);
    $end = strtotime($endDate);

    if ($begin > $end) {

        echo "startdate is in the future! <br />";
        return 0;

    } else {

        $no_days = 0;
        $weekends = 0;

        while ($begin <= $end) {

            $contaDias = false;
            $no_days++; // no of days in the given interval
            $what_day = date("N", $begin);

            //SELECT DIAS
            $query = "SELECT id_nao_uteis, descricao, data_dia FROM nao_uteis ORDER BY data_dia ASC";

            $stmt = mysqli_prepare($link, $query);
            mysqli_stmt_bind_result($stmt, $idNaoUtil, $descricao, $dataDia);
            mysqli_stmt_execute($stmt);

            while (mysqli_stmt_fetch($stmt)) {

                $conversaoDataAcidente = new DateTime($dataDia);
                $textoDataAcidente = $conversaoDataAcidente->format('Y-m-d');

                if ($startDate == $textoDataAcidente) {
                    $weekends++;
                    $contaDias = true;
                }
            }
            mysqli_stmt_close($stmt);

            if ($contaDias == false) {

                if ($what_day > 5) { // 6 and 7 are weekend days
                    $weekends++;
                };

            }

            $begin += 86400; // +1 day

            $startDate = strtotime("+1 day", strtotime($startDate));
            $startDate = date("Y-m-d", $startDate);

        };
        $working_days = $no_days - $weekends;

        return $working_days;
    }
}

    $nr_work_days = getWorkingDays($beginday, $lastday);

    echo "<div class='widget'>
                        <div class='widget-header'>
                            <h2>Registo de Presenças - <strong>$mes_extenso[$mes] de $ano</strong> - $nr_work_days Dias Úteis</h2>

                            <div class='additional-btn'>
                                <a href='#' class='hidden reload'><i class='icon-ccw-1'></i></a>
                                <a href='#' class='widget-toggle'><i class='icon-down-open-2'></i></a>
                                <!-- -->
                            </div>
                        </div>
                        <div class='widget-content'>
                            <br>

                            <div class='table-responsive' style='overflow-x: hidden'>
                                <form class='form-horizontal' role='form'>
                                    <table id='datatables-3' class='table table-striped table-bordered' cellspacing='0'
                                           width='100%'>
                                        <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Função</th>
                                            <th>Estado</th>
                                            <th>Presenças</th>
                                            <th>Subsídio de Alimentação</th>
                                            <th>Ações</th>
                                        </tr>
                                        </thead>
                                        <tbody>";

    $query = "SELECT COUNT(presencas.id_presencas), presencas.ref_id_colaborador,
colaborador.nome_completo, colaborador.funcao, colaborador.ativo FROM presencas INNER JOIN colaborador ON
colaborador.id_colaborador = presencas.ref_id_colaborador WHERE (MONTH( presencas.data_presenca ) = ?)
AND (YEAR(presencas.data_presenca) = ?) GROUP BY presencas.ref_id_colaborador ORDER BY colaborador.nome_completo ASC";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'ss', $mes, $ano);

    mysqli_stmt_bind_result($stmt, $numeroPresencas, $idColaborador,
        $nomeCompletoColaborador, $funcaoPresencas, $ativoColaborador);
    mysqli_stmt_execute($stmt);

    while (mysqli_stmt_fetch($stmt)) {

        if ($ativoColaborador == 1) {
            $textoEstado = "Atual Colaborador";
        } else {
            $textoEstado = "Antigo Colaborador";
        }

        echo "<tr>
                                             <td><a href='perfilColaborador.php?colaborador=$idColaborador'>
                                            $nomeCompletoColaborador</a></td>
                                            <td>$funcaoPresencas</td>
                                            <td>$textoEstado</td>
                                            <td class='text-center'>$numeroPresencas</td>
                                             <td class='text-center'>";
        $subsidioAlimentacao = $numeroPresencas * 8;
        echo $subsidioAlimentacao; echo ",00€</td>
                                            <td class='text-center'>
                                                <div class='btn-group btn-group-xs text-center'>
                                                <a href='presencaDetalhe.php?colaborador=$idColaborador&mesPresenca=$mes&anoPresenca=$ano' data-toggle='tooltip' title='Detalhes - $nomeCompletoColaborador'
                                                       class='text-center btn btn-default'><i
                                                            class='fa fa-eye'></i></a>
                                                </div>
                                            </td>
                                        </tr>";
    }
    mysqli_stmt_close($stmt);

    echo "</tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>";
}

if ((isset($_GET['mesPresenca'])) AND (isset($_GET['anoPresenca'])) AND (isset($_GET['colaboradorPresenca'])) AND ($_GET['colaboradorPresenca'] != 0)) {

    $mes = $_GET['mesPresenca'];
    $ano = $_GET['anoPresenca'];
    $colaborador = $_GET['colaboradorPresenca'];

    $mes_extenso = array(
        1 => 'Janeiro',
        2 => 'Fevereiro',
        3 => 'Março',
        4 => 'Abril',
        5 => 'Maio',
        6 => 'Junho',
        7 => 'Julho',
        8 => 'Agosto',
        9 => 'Setembro',
        10 => 'Outubro',
        11 => 'Novembro',
        12 => 'Dezembro'
    );

    //get current month for example
    $beginday = date($ano . '-' . $mes . '-01');
    $lastday  = date($ano . '-' . $mes  . '-t');

    function getWorkingDays($startDate, $endDate)
{

    $hostname = "localhost";
    $username = "bentoena_RH123";
    $password = "bentoena_RH123";
    $bd = "bentoena_RH";

    $link = mysqli_connect($hostname, $username, $password, $bd);
    mysqli_set_charset($link,"utf8");

    $contaDias = false;
    $begin = strtotime($startDate);
    $end = strtotime($endDate);

    if ($begin > $end) {

        echo "startdate is in the future! <br />";
        return 0;

    } else {

        $no_days = 0;
        $weekends = 0;

        while ($begin <= $end) {

            $contaDias = false;
            $no_days++; // no of days in the given interval
            $what_day = date("N", $begin);

            //SELECT DIAS
            $query = "SELECT id_nao_uteis, descricao, data_dia FROM nao_uteis ORDER BY data_dia ASC";

            $stmt = mysqli_prepare($link, $query);
            mysqli_stmt_bind_result($stmt, $idNaoUtil, $descricao, $dataDia);
            mysqli_stmt_execute($stmt);

            while (mysqli_stmt_fetch($stmt)) {

                $conversaoDataAcidente = new DateTime($dataDia);
                $textoDataAcidente = $conversaoDataAcidente->format('Y-m-d');

                if ($startDate == $textoDataAcidente) {
                    $weekends++;
                    $contaDias = true;
                }
            }
            mysqli_stmt_close($stmt);

            if ($contaDias == false) {

                if ($what_day > 5) { // 6 and 7 are weekend days
                    $weekends++;
                };

            }

            $begin += 86400; // +1 day

            $startDate = strtotime("+1 day", strtotime($startDate));
            $startDate = date("Y-m-d", $startDate);

        };
        $working_days = $no_days - $weekends;

        return $working_days;
    }
}

    $nr_work_days = getWorkingDays($beginday, $lastday);

    $query = "SELECT colaborador.nome_completo, colaborador.id_colaborador,
colaborador.ativo FROM colaborador WHERE colaborador.id_colaborador = ?";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'i', $_GET['colaboradorPresenca']);
    mysqli_stmt_bind_result($stmt, $apresentaNomeFormacoes,
        $idColaboradorFormacoes, $ativoFormacoes);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    echo "<div class='widget'>
                        <div class='widget-header'>
                            <h2>Registo de Presenças - <strong>$mes_extenso[$mes] de $ano</strong> - $nr_work_days Dias Úteis - <strong>$apresentaNomeFormacoes</strong></h2>

                            <div class='additional-btn'>
                                <a href='#' class='hidden reload'><i class='icon-ccw-1'></i></a>
                                <a href='#' class='widget-toggle'><i class='icon-down-open-2'></i></a>
                                <!-- -->
                            </div>
                        </div>
                        <div class='widget-content'>
                            <br>

                            <div class='table-responsive' style='overflow-x: hidden'>
                                <form class='form-horizontal' role='form'>
                                    <table id='datatables-3' class='table table-striped table-bordered' cellspacing='0'
                                           width='100%'>
                                        <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Função</th>
                                            <th>Estado</th>
                                            <th>Presenças</th>
                                            <th>Subsídio de Alimentação</th>
                                            <th>Ações</th>
                                        </tr>
                                        </thead>
                                        <tbody>";

    $query = "SELECT COUNT(presencas.id_presencas), presencas.ref_id_colaborador,
colaborador.nome_completo, colaborador.funcao, colaborador.ativo FROM presencas INNER JOIN colaborador ON
colaborador.id_colaborador = presencas.ref_id_colaborador WHERE (MONTH( presencas.data_presenca ) = ?)
AND (YEAR(presencas.data_presenca) = ?) AND (presencas.ref_id_colaborador = ?)
GROUP BY presencas.ref_id_colaborador ORDER BY colaborador.nome_completo ASC";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'sss', $mes, $ano, $colaborador);

    mysqli_stmt_bind_result($stmt, $numeroPresencas, $idColaborador,
        $nomeCompletoColaborador, $funcaoPresencas, $ativoColaborador);
    mysqli_stmt_execute($stmt);

    while (mysqli_stmt_fetch($stmt)) {

        if ($ativoColaborador == 1) {
            $textoEstado = "Atual Colaborador";
        } else {
            $textoEstado = "Antigo Colaborador";
        }

        echo "<tr>
                                              <td><a href='perfilColaborador.php?colaborador=$idColaborador'>
                                            $nomeCompletoColaborador</a></td>
                                            <td>$funcaoPresencas</td>
                                            <td>$textoEstado</td>
                                            <td class='text-center'>$numeroPresencas</td>
                                              <td class='text-center'>";
        $subsidioAlimentacao = $numeroPresencas * 8;
        echo $subsidioAlimentacao; echo ",00€</td>
                                           <td class='text-center'>
                                                <div class='btn-group btn-group-xs text-center'>
                                                <a href='presencaDetalhe.php?colaborador=$idColaborador&mesPresenca=$mes&anoPresenca=$ano' data-toggle='tooltip' title='Detalhes - $nomeCompletoColaborador'
                                                       class='text-center btn btn-default'><i
                                                            class='fa fa-eye'></i></a>
                                                </div>
                                            </td>
                                        </tr>";
    }
    mysqli_stmt_close($stmt);

    echo "</tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>";
}

echo "</div>
            </div>
            <!-- Footer Start -->
            <footer>
                Bento & Nascimento &copy; 2015
                <div class='footer-links pull-right'>
                    <a>Plataforma de Gestão dos Recursos Humanos</a>
                </div>
            </footer>
            <!-- Footer End -->
        </div>
        <!-- ============================================================== -->
        <!-- End content here -->
        <!-- ============================================================== -->

    </div>
    <!-- End right content -->

</div>
<!-- End of page -->
<!-- the overlay modal element -->
<div class='md-overlay'></div>
<!-- End of eoverlay modal -->
<script>
    var resizefunc = [];
</script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src='assets/libs/jquery/jquery-1.11.1.min.js'></script>
<script src='assets/libs/bootstrap/js/bootstrap.min.js'></script>
<script src='assets/libs/jqueryui/jquery-ui-1.10.4.custom.min.js'></script>
<script src='assets/libs/jquery-ui-touch/jquery.ui.touch-punch.min.js'></script>
<script src='assets/libs/jquery-detectmobile/detect.js'></script>
<script src='assets/libs/jquery-animate-numbers/jquery.animateNumbers.js'></script>
<script src='assets/libs/ios7-switch/ios7.switch.js'></script>
<script src='assets/libs/fastclick/fastclick.js'></script>
<script src='assets/libs/jquery-blockui/jquery.blockUI.js'></script>
<script src='assets/libs/bootstrap-bootbox/bootbox.min.js'></script>
<script src='assets/libs/jquery-slimscroll/jquery.slimscroll.js'></script>
<script src='assets/libs/jquery-sparkline/jquery-sparkline.js'></script>
<script src='assets/libs/nifty-modal/js/classie.js'></script>
<script src='assets/libs/nifty-modal/js/modalEffects.js'></script>
<script src='assets/libs/sortable/sortable.min.js'></script>
<script src='assets/libs/bootstrap-fileinput/bootstrap.file-input.js'></script>
<script src='assets/libs/bootstrap-select/bootstrap-select.min.js'></script>
<script src='assets/libs/bootstrap-select2/select2.min.js'></script>
<script src='assets/libs/magnific-popup/jquery.magnific-popup.min.js'></script>
<script src='assets/libs/pace/pace.min.js'></script>
<script src='assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.js'></script>
<script src='assets/libs/jquery-icheck/icheck.min.js'></script>

<!-- Demo Specific JS Libraries -->
<script src='assets/libs/prettify/prettify.js'></script>

<script src='assets/js/init.js'></script>
<!-- Page Specific JS Libraries -->
<script src='assets/libs/jquery-datatables/js/jquery.dataTables.min.js'></script>
<script src='assets/libs/jquery-datatables/js/dataTables.bootstrap.js'></script>
<script src='assets/libs/jquery-datatables/extensions/TableTools/js/dataTables.tableTools.min.js'></script>
<script src='assets/js/pages/datatables.js'></script>
<link rel='canonical' href='http://openexchangerates.github.io/accounting.js/'/>

<script src='assets/libs/accounting.js-master/accounting.min.js'></script>

<!-- Page Specific JS Libraries -->
<script src='assets/libs/bootstrap-select/bootstrap-select.min.js'></script>
<script src='assets/libs/bootstrap-inputmask/inputmask.js'></script>
<script src='assets/libs/summernote/summernote.js'></script>
<script src='assets/js/pages/forms.js'></script>

 <!-- Extra CSS Libraries Start -->
    <link href='assets/libs/bootstrap-select/bootstrap-select.min.css' rel='stylesheet' type='text/css'/>
    <link href='assets/libs/summernote/summernote.css' rel='stylesheet' type='text/css'/>
    <link href='assets/css/style.css' rel='stylesheet' type='text/css'/>
    <!-- Extra CSS Libraries End -->
    <link href='assets/css/style-responsive.css' rel='stylesheet'/>

</body>
</html>";