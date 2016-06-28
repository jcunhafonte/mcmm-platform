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
    <title>BN, Lda - Relatório Acidentes de Trabalho</title>
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
Menus('exportarDados', 'qualidadeAcidentes');

echo "<!-- Start right content -->
    <div class='content-page'>
        <!-- ============================================================== -->
        <!-- Start Content here -->
        <!-- ============================================================== -->
        <div class='content'>
            <!-- Page Heading Start -->
            <div class='page-heading'>
                  <h1><i class='fa fa-table'></i> Exportar Dados - Acidentes de Trabalho</h1>

                <h3>Visualize, consulte e exporte os dados dos seus colaboradores para diversos formatos</h3>

            <div class='row'>


   <div class='col-md-12'>";

    echo "<div class='widget'>
            <div class='widget-header'>
                <h2><strong>Filtrar</strong> por Colaborador</h2>
            </div>
                    <div class='form-group'>

                        <form action='exportarDadosAcidentes.php' method='get'>
                            <div style='padding: 14px 13px 14px 13px !important;' class='col-sm-12'>
                            <select class='form-control selectpicker'
                                name='colaborador' required='required'>
                                <option value='0'>Todos os Colaboradores</option>";

$query = "SELECT id_colaborador, nome_completo FROM colaborador WHERE ativo = 1";
$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_result($stmt, $idColaborador, $nomeColaborador);
mysqli_stmt_execute($stmt);

while (mysqli_stmt_fetch($stmt)) {
    echo "<option ";

    if((isset($_GET['colaborador'])) AND
        ($_GET['colaborador'] == $idColaborador)){
        echo "selected";
    }

    echo " value='$idColaborador'>$nomeColaborador</option>";
}
mysqli_stmt_close($stmt);

echo "</select>
</div>

 <div class='col-sm-12' style='padding: 0px 13px 14px 13px !important;'>
<button type='submit' style='width: 100% !important;'
class='btn btn-default input-block-level'>Filtrar</button>
</div>
</form>

</div>
</div>
</div>

<div class='col-md-12'>
  <div class='text-right'>
                    <div class='row text-right'>
                        <div class='col-lg-4 text-right' style='float: right!important;'>
                            <a href='#' rel='contentA' class='print btn btn-primary btn-sm invoice-print'>
                                <i class='icon-print-2'></i> Imprimir</a>
                        </div>
                    </div>
                </div>
                <!-- End div .user-button -->
                <br>
</div>

                <div class='col-md-12'>";

if ((!isset($_GET['colaborador'])) || ($_GET['colaborador'] == 0)) {

    echo "<div class='widget'>
                        <div class='widget-header'>
                            <h2><strong>Acidentes de Trabalho</strong></h2>

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
                                    <table id='datatables-4' class='table table-striped table-bordered' cellspacing='0'
                                           width='100%'>
                                        <thead>
                                        <tr>
                                             <th>Nome</th>
                                            <th>Data</th>
                                         <th>Departamento</th>
                                             <th>Nº do Processo</th>
                                             <th>Atividade a Realizar</th>
                                             <th>Descrição</th>
                                               <th>Lesões</th>
                                                <th>Causas</th>
                                             <th>Categoria</th>
                                             <th>Tipologia</th>
                                             <th>Tratamento</th>
                                            <th>Ausência - Horas</th>
                                            <th>Ausência - Dias</th>
                                             <th>Eficácia</th>
                                            <th>Responsável</th>
                                             <th>Data de Fecho</th>
                                        </tr>
                                        </thead>
                                         <tfoot>
                                        <tr>
                                           <th>Nome</th>
                                            <th>Data</th>
                                         <th>Departamento</th>
                                             <th>Nº do Processo</th>
                                             <th>Atividade a Realizar</th>
                                             <th>Descrição</th>
                                               <th>Lesões</th>
                                                <th>Causas</th>
                                             <th>Categoria</th>
                                             <th>Tipologia</th>
                                             <th>Tratamento</th>
                                            <th>Ausência - Horas</th>
                                            <th>Ausência - Dias</th>
                                             <th>Eficácia</th>
                                            <th>Responsável</th>
                                             <th>Data de Fecho</th>
                                        </tr>
                                        </tfoot>
                                        <tbody>";


    $query = "SELECT acidentes.id_acidente, acidentes.ref_id_colaborador, acidentes.data_acidente,acidentes.departamento,
acidentes.numero_processo, acidentes.atividade, acidentes.descricao, acidentes.lesoes, acidentes.causas,
acidentes.categoria, acidentes.tipologia, acidentes.tratamento, acidentes.ausencia_horas, acidentes.ausencia_dias,
acidentes.acao, acidentes.numero_acao, acidentes.tipo_acao, acidentes.descricao_acao, acidentes.data_implementacao,
acidentes.resultados, acidentes.controlo, acidentes.data_conclusao, acidentes.observacoes, acidentes.eficacia,
 acidentes.responsavel, acidentes.data_fecho, colaborador.nome_completo, colaborador.ativo
FROM acidentes INNER JOIN colaborador ON acidentes.ref_id_colaborador = colaborador.id_colaborador
WHERE colaborador.ativo = 1 ORDER BY colaborador.nome_completo ASC ";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_result($stmt, $idAcidente, $refIdColaborador, $dataAcidente,
        $departamentoAcidente, $numeroProcessoAcidente, $atividadeRealizarAcidente, $descricaoAcidente, $lesoesAcidente,
        $causasAcidente, $categoriaAcidente, $tipologiaAcidente, $tratamentoAcidente, $horasAusenciaAcidente,
        $diasAusenciaAcidente, $acaoAcidente, $numeroAcao, $tipoAcaoAcidente, $descricaoAcaoAcidente,
        $dataImplementacaoAcidente, $resultadosEsperadosAcidente, $textoControloExecucaoAcidente,
        $dataConclusaoAcidente, $observacoesAcidente, $eficaciaAcidente, $responsavelAcidente,
        $dataFechoAcidente, $nomeComportamento, $ativoComportamento);
    mysqli_stmt_execute($stmt);

    while (mysqli_stmt_fetch($stmt)) {

        $conversaoDataAcidente = new DateTime($dataAcidente);
        $textoDataAcidente = $conversaoDataAcidente->format('d-m-Y');

        $conversaoDataImplementacaoAcidente  = new DateTime($dataImplementacaoAcidente);
        $textoDataImplementacaoAcidente = $conversaoDataImplementacaoAcidente->format('d-m-Y');

        $conversaoDataConclusaoAcidente = new DateTime($dataConclusaoAcidente);
        $textoDataConclusaoAcidente = $conversaoDataConclusaoAcidente->format('d-m-Y');

        $conversaoDataFechoAcidente = new DateTime($dataFechoAcidente);
        $textoDataFechoAcidente = $conversaoDataFechoAcidente->format('d-m-Y');

        echo "<tr>
                                            <td>$nomeComportamento</td>
                                            <td>$textoDataAcidente</td>
                                            <td>$departamentoAcidente</td>
                                             <td>$numeroProcessoAcidente</td>
                                                <td>$atividadeRealizarAcidente</td>
                                             <td>$descricaoAcidente</td>
                                               <td>$lesoesAcidente</td>
                                          <td>$causasAcidente</td>
                                             <td>$categoriaAcidente</td>
                                             <td>$tipologiaAcidente</td>
                                               <td>$tratamentoAcidente</td>
                                               <td>";echo $horasAusenciaAcidente; echo "H</td>
                                               <td>$diasAusenciaAcidente Dias</td>
 <td>";echo $eficaciaAcidente; echo "</td>
<td>";echo $responsavelAcidente; echo "</td>
   <td>";

        if((!empty($dataFechoAcidente)) AND ($dataFechoAcidente != "1970-01-01 00:00:00")){

            echo $textoDataFechoAcidente;

        }

        echo "</td>

                                        </tr>";
    }
    mysqli_stmt_close($stmt);

    echo "</tbody>

                                    </table>
                                </form>
                            </div>
                        </div>



                                <div class='widget-content' style='display: none !important;'>
                            <br>

                            <div class='table-responsive' style='overflow-x: hidden' id='contentA'>
                                <form class='form-horizontal' role='form'>

                                    <table width='100%'>
                                <thead>

                                </thead>
                                 <tr width='100%'>
                                                <td style='width: 70%' width='70%'>
                                                    <h4><img src='assets/img/inv-logo.png' alt='Logo'></h4>

                                                    Rua dos Caniços, Ervosas<br>
                                                    3830-252 Ílhavo<br>
                                                    <abbr title='Phone'>Telefone:</abbr> 234 940 050<br>
  	                                                <abbr title='Fax'>Fax:</abbr> 234 940 059<br>
							                        <abbr title='Email'>Email:</abbr> geral@bentoenascimento.com

                                                </td>
                                                  <td style='text-align: right' width='30%'>
                                                  Data: "; echo date('d-m-Y'); echo "</td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                             <tr>
                                            <td>
                                            <h3><strong>Acidentes de Trabalho</strong></h3>
                                            </td>
                                            </tr>
                                </table>";

    $query = "SELECT acidentes.id_acidente, colaborador.nome_completo, colaborador.ativo
FROM acidentes INNER JOIN colaborador ON acidentes.ref_id_colaborador = colaborador.id_colaborador
WHERE colaborador.ativo = 1 ORDER BY colaborador.nome_completo ASC ";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_result($stmt, $idAcidente2, $nomeComportamento, $ativoComportamento);
    mysqli_stmt_execute($stmt);

    while (mysqli_stmt_fetch($stmt)) {

        echo "<table border='1' class='table-striped table-bordered' cellspacing='0'
                                           width='100%'>
                                        <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Data</th>
                                            <th>Departamento</th>
                                            <th>Nº do Processo</th>
                                        </tr>
                                        </thead>
                                        <tbody>";

        $query2 = "SELECT acidentes.id_acidente, acidentes.ref_id_colaborador, acidentes.data_acidente,acidentes.departamento,
acidentes.numero_processo, acidentes.atividade, acidentes.descricao, acidentes.lesoes, acidentes.causas,
acidentes.categoria, acidentes.tipologia, acidentes.tratamento, acidentes.ausencia_horas, acidentes.ausencia_dias,
acidentes.acao, acidentes.numero_acao, acidentes.tipo_acao, acidentes.descricao_acao, acidentes.data_implementacao,
acidentes.resultados, acidentes.controlo, acidentes.data_conclusao, acidentes.observacoes, acidentes.eficacia,
 acidentes.responsavel, acidentes.data_fecho, colaborador.nome_completo, colaborador.ativo
FROM acidentes INNER JOIN colaborador ON acidentes.ref_id_colaborador = colaborador.id_colaborador
WHERE colaborador.ativo = 1 AND acidentes.id_acidente = ? ORDER BY colaborador.nome_completo ASC ";

        $stmt2 = mysqli_prepare($link2, $query2);
        mysqli_stmt_bind_param($stmt2, 's', $idAcidente2);
        mysqli_stmt_bind_result($stmt2, $idAcidente, $refIdColaborador, $dataAcidente,
            $departamentoAcidente, $numeroProcessoAcidente, $atividadeRealizarAcidente, $descricaoAcidente, $lesoesAcidente,
            $causasAcidente, $categoriaAcidente, $tipologiaAcidente, $tratamentoAcidente, $horasAusenciaAcidente,
            $diasAusenciaAcidente, $acaoAcidente, $numeroAcao, $tipoAcaoAcidente, $descricaoAcaoAcidente,
            $dataImplementacaoAcidente, $resultadosEsperadosAcidente, $textoControloExecucaoAcidente,
            $dataConclusaoAcidente, $observacoesAcidente, $eficaciaAcidente, $responsavelAcidente,
            $dataFechoAcidente, $nomeComportamento, $ativoComportamento);
        mysqli_stmt_execute($stmt2);

       mysqli_stmt_fetch($stmt2);
        mysqli_stmt_close($stmt2);

        $conversaoDataAcidente = new DateTime($dataAcidente);
        $textoDataAcidente = $conversaoDataAcidente->format('d-m-Y');

        $conversaoDataImplementacaoAcidente  = new DateTime($dataImplementacaoAcidente);
        $textoDataImplementacaoAcidente = $conversaoDataImplementacaoAcidente->format('d-m-Y');

        $conversaoDataConclusaoAcidente = new DateTime($dataConclusaoAcidente);
        $textoDataConclusaoAcidente = $conversaoDataConclusaoAcidente->format('d-m-Y');

        $conversaoDataFechoAcidente = new DateTime($dataFechoAcidente);
        $textoDataFechoAcidente = $conversaoDataFechoAcidente->format('d-m-Y');

        echo "<tr>
                                            <td style='border-bottom: none !important; text-align: center !important;'>$nomeComportamento</td>
                                            <td style='border-bottom: none !important; width:90px; text-align: center !important;'>$textoDataFechoAcidente</td>
                                            <td style='border-bottom: none !important; text-align: center !important;'>$departamentoAcidente</td>
                                            <td style='border-bottom: none !important; text-align: center !important;'>$numeroProcessoAcidente</td>
                                        </tr>";


        echo "</tbody>
                                    </table>

                                    <table border='1' class='table-striped table-bordered' cellspacing='0'
                                           width='100%'>
                                        <thead>
                                        <tr>
                                                <th>Atividade a Realizar</th>
                                             <th>Descrição</th>
                                               <th>Lesões</th>
                                               <th>Causas</th>
                                        </tr>
                                        </thead>
                                        <tbody>";

        echo "<tr>
                                            <td  style='border-bottom: none !important; text-align: center !important;'>$atividadeRealizarAcidente</td>
                                             <td  style='border-bottom: none !important; text-align: center !important;'>$descricaoAcidente</td>
                                               <td  style='border-bottom: none !important; text-align: center !important;'>$lesoesAcidente</td>
                                               <td  style='border-bottom: none !important; text-align: center !important;'>$causasAcidente</td>
                                        </tr>";

        echo "</tbody>
                                    </table>

                                 <table border='1' class='table-striped table-bordered' cellspacing='0'
                                           width='100%'>
                                        <thead>
                                        <tr>
                                            <th>Categoria</th>
                                             <th>Tipologia</th>
                                             <th>Tratamento</th>
                                            <th>Ausência - Horas</th>
                                            <th>Ausência - Dias</th>
                                        </tr>
                                        </thead>
                                        <tbody>";

        echo "<tr>
                                           <td  style='border-bottom: none !important; text-align: center !important;'>$categoriaAcidente</td>
                                             <td  style='border-bottom: none !important; text-align: center !important;'>$tipologiaAcidente</td>
                                               <td  style='border-bottom: none !important; text-align: center !important;'>$tratamentoAcidente</td>
                                               <td  style='border-bottom: none !important; text-align: center !important;'>";echo $horasAusenciaAcidente; echo "H</td>
                                               <td  style='border-bottom: none !important; text-align: center !important;'>$diasAusenciaAcidente Dias</td>
                                        </tr>";

        echo "</tbody>
                                    </table>

                                       <table border='1' class='table-striped table-bordered' cellspacing='0'
                                           width='100%'>
                                        <thead>
                                        <tr>
                                           <th>Ação</th>
                                            <th>Número de Ação</th>
                                             <th>Tipo de Ação</th>
                                             <th>Descrição da Ação</th>
                                        </tr>
                                        </thead>
                                        <tbody>";

        echo "<tr>
                                           <td  style='border-bottom: none !important; text-align: center !important;'>$acaoAcidente</td>
                                                 <td style='border-bottom: none !important; text-align: center !important;'>";echo $numeroAcao; echo "H</td>
                                             <td style='border-bottom: none !important; text-align: center !important;'>$tipoAcaoAcidente</td>
                                             <td style='border-bottom: none !important; text-align: center !important;'>$descricaoAcaoAcidente</td>
                                        </tr>";

        echo "</tbody>
                                    </table>


                                           <table border='1' class='table-striped table-bordered' cellspacing='0'
                                           width='100%'>
                                        <thead>
                                        <tr>
                                           <th>Data de Implementação</th>
                                            <th>Resultados Esperados/Critérios de Avaliação</th>
                                             <th>Controlo de Execução</th>
                                             <th>Data de Conclusão</th>
                                        </tr>
                                        </thead>
                                        <tbody>";

        echo "<tr>
                                           <td style='border-bottom: none !important; text-align: center !important;'>";

        if((!empty($dataImplementacaoAcidente)) AND ($dataImplementacaoAcidente != "1970-01-01 00:00:00")){

            echo $textoDataImplementacaoAcidente;

        }

        echo "</td>
                                               <td style='border-bottom: none !important; text-align: center !important;'>";echo $resultadosEsperadosAcidente; echo "</td>
                    <td style='border-bottom: none !important; text-align: center !important;'>";echo $textoControloExecucaoAcidente; echo "</td>
                                               <td style='border-bottom: none !important; text-align: center !important;'>";

        if((!empty($dataConclusaoAcidente)) AND ($dataConclusaoAcidente != "1970-01-01 00:00:00")){

            echo $textoDataConclusaoAcidente;

        }

        echo "</td>

</tr>";

        echo "</tbody>
                                    </table>


                                     <table border='1' class='table-striped table-bordered' cellspacing='0'
                                           width='100%'>
                                        <thead>
                                        <tr>
                                           <th>Observações</th>
                                             <th>Eficácia</th>
                                            <th>Responsável</th>
                                             <th>Data de Fecho</th>
                                        </tr>
                                        </thead>
                                        <tbody>";

        echo "<tr>
                                            <td style='border-bottom: none !important; text-align: center !important;'>";echo $observacoesAcidente; echo "</td>
 <td style='border-bottom: none !important; text-align: center !important;'>";echo $eficaciaAcidente; echo "</td>
<td style='border-bottom: none !important; text-align: center !important;'>";echo $responsavelAcidente; echo "</td>
   <td style='border-bottom: none !important; text-align: center !important;'>";

        if((!empty($dataFechoAcidente)) AND ($dataFechoAcidente != "1970-01-01 00:00:00")){

            echo $textoDataFechoAcidente;

        }

        echo "</td>

</tr>";

        echo "</tbody>
                                    </table>



                                    <br><br>";

    }

    mysqli_stmt_close($stmt);

    echo "<br><br><br><br>
                                        <table style='width: 100%'>
                                            <tbody>

                                            <tr>

                                                <td style='width:100%!important;  text-align: center !important; padding-top: 10px!important; padding-bottom:  15px !important;'>

                                                    <h3 style='display: inline;  padding-bottom: 10px !important;'>
                                                        ________________________________</h3><br>
                                                    <h4 style='display: inline; font-weight: normal !important; text-align: center'>(Responsável dos Recursos Humanos)</h4>

                                                </td>

                                            </tr>

                                            </tbody>
                                        </table>
                                </form>
                            </div>
                        </div>



                    </div>";
} else {

    $query = "SELECT colaborador.nome_completo, colaborador.id_colaborador
    FROM colaborador WHERE colaborador.id_colaborador = ?";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'i', $_GET['colaborador']);
    mysqli_stmt_bind_result($stmt, $nomeCompletoApresenta, $idApresenta);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    echo "<div class='widget'>
                        <div class='widget-header'>
                             <h2><strong>Acidentes de Trabalho</strong> - <strong>$nomeCompletoApresenta</strong></h2>

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
                                    <table id='datatables-4' class='table table-striped table-bordered' cellspacing='0'
                                           width='100%'>
                                              <thead>
                                        <tr>
                                        <th>Nome</th>
                                            <th>Data</th>
                                         <th>Departamento</th>
                                             <th>Nº do Processo</th>
                                             <th>Atividade a Realizar</th>
                                             <th>Descrição</th>
                                               <th>Lesões</th>
                                                <th>Causas</th>
                                             <th>Categoria</th>
                                             <th>Tipologia</th>
                                             <th>Tratamento</th>
                                            <th>Ausência - Horas</th>
                                            <th>Ausência - Dias</th>
                                             <th>Eficácia</th>
                                            <th>Responsável</th>
                                             <th>Data de Fecho</th>
                                        </tr>
                                        </thead>
                                         <tfoot>
                                        <tr>
                                           <th>Nome</th>
                                            <th>Data</th>
                                         <th>Departamento</th>
                                             <th>Nº do Processo</th>
                                             <th>Atividade a Realizar</th>
                                             <th>Descrição</th>
                                               <th>Lesões</th>
                                                <th>Causas</th>
                                             <th>Categoria</th>
                                             <th>Tipologia</th>
                                             <th>Tratamento</th>
                                            <th>Ausência - Horas</th>
                                            <th>Ausência - Dias</th>
                                             <th>Eficácia</th>
                                            <th>Responsável</th>
                                             <th>Data de Fecho</th>
                                        </tr>
                                        </tfoot>
                                        <tbody>";

    $query = "SELECT acidentes.id_acidente, acidentes.ref_id_colaborador, acidentes.data_acidente,acidentes.departamento,
acidentes.numero_processo, acidentes.atividade, acidentes.descricao, acidentes.lesoes, acidentes.causas,
acidentes.categoria, acidentes.tipologia, acidentes.tratamento, acidentes.ausencia_horas, acidentes.ausencia_dias,
acidentes.acao, acidentes.numero_acao, acidentes.tipo_acao, acidentes.descricao_acao, acidentes.data_implementacao,
acidentes.resultados, acidentes.controlo, acidentes.data_conclusao, acidentes.observacoes, acidentes.eficacia,
 acidentes.responsavel, acidentes.data_fecho, colaborador.nome_completo, colaborador.ativo
FROM acidentes INNER JOIN colaborador ON acidentes.ref_id_colaborador = colaborador.id_colaborador
WHERE colaborador.ativo = 1 AND colaborador.id_colaborador = ? ORDER BY colaborador.nome_completo ASC ";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 's', $_GET['colaborador']);
    mysqli_stmt_bind_result($stmt, $idAcidente, $refIdColaborador, $dataAcidente,
        $departamentoAcidente, $numeroProcessoAcidente, $atividadeRealizarAcidente, $descricaoAcidente, $lesoesAcidente,
        $causasAcidente, $categoriaAcidente, $tipologiaAcidente, $tratamentoAcidente, $horasAusenciaAcidente,
        $diasAusenciaAcidente, $acaoAcidente, $numeroAcao, $tipoAcaoAcidente, $descricaoAcaoAcidente,
        $dataImplementacaoAcidente, $resultadosEsperadosAcidente, $textoControloExecucaoAcidente,
        $dataConclusaoAcidente, $observacoesAcidente, $eficaciaAcidente, $responsavelAcidente,
        $dataFechoAcidente, $nomeComportamento, $ativoComportamento);
    mysqli_stmt_execute($stmt);

    while (mysqli_stmt_fetch($stmt)) {

        $conversaoDataAcidente = new DateTime($dataAcidente);
        $textoDataAcidente = $conversaoDataAcidente->format('d-m-Y');

        $conversaoDataImplementacaoAcidente  = new DateTime($dataImplementacaoAcidente);
        $textoDataImplementacaoAcidente = $conversaoDataImplementacaoAcidente->format('d-m-Y');

        $conversaoDataConclusaoAcidente = new DateTime($dataConclusaoAcidente);
        $textoDataConclusaoAcidente = $conversaoDataConclusaoAcidente->format('d-m-Y');

        $conversaoDataFechoAcidente = new DateTime($dataFechoAcidente);
        $textoDataFechoAcidente = $conversaoDataFechoAcidente->format('d-m-Y');

        echo "<tr>
                                            <td>$nomeComportamento</td>
                                            <td>$textoDataAcidente</td>
                                            <td>$departamentoAcidente</td>
                                             <td>$numeroProcessoAcidente</td>
                                                <td>$atividadeRealizarAcidente</td>
                                             <td>$descricaoAcidente</td>
                                               <td>$lesoesAcidente</td>
                                          <td>$causasAcidente</td>
                                             <td>$categoriaAcidente</td>
                                             <td>$tipologiaAcidente</td>
                                               <td>$tratamentoAcidente</td>
                                               <td>";echo $horasAusenciaAcidente; echo "H</td>
                                               <td>$diasAusenciaAcidente Dias</td>
 <td>";echo $eficaciaAcidente; echo "</td>
<td>";echo $responsavelAcidente; echo "</td>
   <td>";

        if(!empty($dataFechoAcidente)){

            echo $textoDataFechoAcidente;

        }

        echo "</td>

                                        </tr>";
    }
    mysqli_stmt_close($stmt);

    echo "</tbody>
                                    </table>
                                </form>
                            </div>
                        </div>


                             <div class='widget-content' style='display: none !important;'>
                            <br>

                            <div class='table-responsive' style='overflow-x: hidden' id='contentA'>
                                <form class='form-horizontal' role='form'>

                                    <table width='100%'>
                                <thead>

                                </thead>
                                 <tr width='100%'>
                                                <td style='width: 70%' width='70%'>
                                                    <h4><img src='assets/img/inv-logo.png' alt='Logo'></h4>

                                                    Rua dos Caniços, Ervosas<br>
                                                    3830-252 Ílhavo<br>
                                                    <abbr title='Phone'>Telefone:</abbr> 234 940 050<br>
  	                                                <abbr title='Fax'>Fax:</abbr> 234 940 059<br>
							                        <abbr title='Email'>Email:</abbr> geral@bentoenascimento.com

                                                </td>
                                                  <td style='text-align: right' width='30%'>
                                                  Data: "; echo date('d-m-Y'); echo "</td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                             <tr>
                                            <td>
                                            <h3><strong>A. de Trabalho</strong> - <strong>$nomeCompletoApresenta</strong></h3>
                                            </td>
                                            </tr>
                                </table>";

    $query = "SELECT acidentes.id_acidente, colaborador.nome_completo, colaborador.ativo
FROM acidentes INNER JOIN colaborador ON acidentes.ref_id_colaborador = colaborador.id_colaborador
WHERE colaborador.ativo = 1 AND colaborador.id_colaborador = ? ORDER BY colaborador.nome_completo ASC ";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 's', $_GET['colaborador']);
    mysqli_stmt_bind_result($stmt, $idAcidente2, $nomeComportamento, $ativoComportamento);
    mysqli_stmt_execute($stmt);

    while (mysqli_stmt_fetch($stmt)) {

        echo "<table border='1' class='table-striped table-bordered' cellspacing='0'
                                           width='100%'>
                                        <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Data</th>
                                            <th>Departamento</th>
                                            <th>Nº do Processo</th>
                                        </tr>
                                        </thead>
                                        <tbody>";

        $query2 = "SELECT acidentes.id_acidente, acidentes.ref_id_colaborador, acidentes.data_acidente,acidentes.departamento,
acidentes.numero_processo, acidentes.atividade, acidentes.descricao, acidentes.lesoes, acidentes.causas,
acidentes.categoria, acidentes.tipologia, acidentes.tratamento, acidentes.ausencia_horas, acidentes.ausencia_dias,
acidentes.acao, acidentes.numero_acao, acidentes.tipo_acao, acidentes.descricao_acao, acidentes.data_implementacao,
acidentes.resultados, acidentes.controlo, acidentes.data_conclusao, acidentes.observacoes, acidentes.eficacia,
 acidentes.responsavel, acidentes.data_fecho, colaborador.nome_completo, colaborador.ativo
FROM acidentes INNER JOIN colaborador ON acidentes.ref_id_colaborador = colaborador.id_colaborador
WHERE colaborador.ativo = 1 AND acidentes.id_acidente = ? ORDER BY colaborador.nome_completo ASC ";

        $stmt2 = mysqli_prepare($link2, $query2);
        mysqli_stmt_bind_param($stmt2, 's', $idAcidente2);
        mysqli_stmt_bind_result($stmt2, $idAcidente, $refIdColaborador, $dataAcidente,
            $departamentoAcidente, $numeroProcessoAcidente, $atividadeRealizarAcidente, $descricaoAcidente, $lesoesAcidente,
            $causasAcidente, $categoriaAcidente, $tipologiaAcidente, $tratamentoAcidente, $horasAusenciaAcidente,
            $diasAusenciaAcidente, $acaoAcidente, $numeroAcao, $tipoAcaoAcidente, $descricaoAcaoAcidente,
            $dataImplementacaoAcidente, $resultadosEsperadosAcidente, $textoControloExecucaoAcidente,
            $dataConclusaoAcidente, $observacoesAcidente, $eficaciaAcidente, $responsavelAcidente,
            $dataFechoAcidente, $nomeComportamento, $ativoComportamento);
        mysqli_stmt_execute($stmt2);

        mysqli_stmt_fetch($stmt2);
        mysqli_stmt_close($stmt2);

        $conversaoDataAcidente = new DateTime($dataAcidente);
        $textoDataAcidente = $conversaoDataAcidente->format('d-m-Y');

        $conversaoDataImplementacaoAcidente  = new DateTime($dataImplementacaoAcidente);
        $textoDataImplementacaoAcidente = $conversaoDataImplementacaoAcidente->format('d-m-Y');

        $conversaoDataConclusaoAcidente = new DateTime($dataConclusaoAcidente);
        $textoDataConclusaoAcidente = $conversaoDataConclusaoAcidente->format('d-m-Y');

        $conversaoDataFechoAcidente = new DateTime($dataFechoAcidente);
        $textoDataFechoAcidente = $conversaoDataFechoAcidente->format('d-m-Y');

        echo "<tr>
                                            <td style='border-bottom: none !important; text-align: center !important;'>$nomeComportamento</td>
                                            <td style='border-bottom: none !important; width:90px; text-align: center !important;'>$textoDataFechoAcidente</td>
                                            <td style='border-bottom: none !important; text-align: center !important;'>$departamentoAcidente</td>
                                            <td style='border-bottom: none !important; text-align: center !important;'>$numeroProcessoAcidente</td>
                                        </tr>";


        echo "</tbody>
                                    </table>

                                    <table border='1' class='table-striped table-bordered' cellspacing='0'
                                           width='100%'>
                                        <thead>
                                        <tr>
                                                <th>Atividade a Realizar</th>
                                             <th>Descrição</th>
                                               <th>Lesões</th>
                                               <th>Causas</th>
                                        </tr>
                                        </thead>
                                        <tbody>";

        echo "<tr>
                                            <td  style='border-bottom: none !important; text-align: center !important;'>$atividadeRealizarAcidente</td>
                                             <td  style='border-bottom: none !important; text-align: center !important;'>$descricaoAcidente</td>
                                               <td  style='border-bottom: none !important; text-align: center !important;'>$lesoesAcidente</td>
                                               <td  style='border-bottom: none !important; text-align: center !important;'>$causasAcidente</td>
                                        </tr>";

        echo "</tbody>
                                    </table>

                                 <table border='1' class='table-striped table-bordered' cellspacing='0'
                                           width='100%'>
                                        <thead>
                                        <tr>
                                            <th>Categoria</th>
                                             <th>Tipologia</th>
                                             <th>Tratamento</th>
                                            <th>Ausência - Horas</th>
                                            <th>Ausência - Dias</th>
                                        </tr>
                                        </thead>
                                        <tbody>";

        echo "<tr>
                                           <td  style='border-bottom: none !important; text-align: center !important;'>$categoriaAcidente</td>
                                             <td  style='border-bottom: none !important; text-align: center !important;'>$tipologiaAcidente</td>
                                               <td  style='border-bottom: none !important; text-align: center !important;'>$tratamentoAcidente</td>
                                               <td  style='border-bottom: none !important; text-align: center !important;'>";echo $horasAusenciaAcidente; echo "H</td>
                                               <td  style='border-bottom: none !important; text-align: center !important;'>$diasAusenciaAcidente Dias</td>
                                        </tr>";

        echo "</tbody>
                                    </table>

                                       <table border='1' class='table-striped table-bordered' cellspacing='0'
                                           width='100%'>
                                        <thead>
                                        <tr>
                                           <th>Ação</th>
                                            <th>Número de Ação</th>
                                             <th>Tipo de Ação</th>
                                             <th>Descrição da Ação</th>
                                        </tr>
                                        </thead>
                                        <tbody>";

        echo "<tr>
                                           <td  style='border-bottom: none !important; text-align: center !important;'>$acaoAcidente</td>
                                                 <td style='border-bottom: none !important; text-align: center !important;'>";echo $numeroAcao; echo "H</td>
                                             <td style='border-bottom: none !important; text-align: center !important;'>$tipoAcaoAcidente</td>
                                             <td style='border-bottom: none !important; text-align: center !important;'>$descricaoAcaoAcidente</td>
                                        </tr>";

        echo "</tbody>
                                    </table>


                                           <table border='1' class='table-striped table-bordered' cellspacing='0'
                                           width='100%'>
                                        <thead>
                                        <tr>
                                           <th>Data de Implementação</th>
                                            <th>Resultados Esperados/Critérios de Avaliação</th>
                                             <th>Controlo de Execução</th>
                                             <th>Data de Conclusão</th>
                                        </tr>
                                        </thead>
                                        <tbody>";

        echo "<tr>
                                           <td style='border-bottom: none !important; text-align: center !important;'>";

        if(!empty($dataImplementacaoAcidente)){

            echo $textoDataImplementacaoAcidente;

        }

        echo "</td>
                                               <td style='border-bottom: none !important; text-align: center !important;'>";echo $resultadosEsperadosAcidente; echo "</td>
                    <td style='border-bottom: none !important; text-align: center !important;'>";echo $textoControloExecucaoAcidente; echo "</td>
                                               <td style='border-bottom: none !important; text-align: center !important;'>";

        if(!empty($dataConclusaoAcidente)){

            echo $textoDataConclusaoAcidente;

        }

        echo "</td>

</tr>";

        echo "</tbody>
                                    </table>


                                     <table border='1' class='table-striped table-bordered' cellspacing='0'
                                           width='100%'>
                                        <thead>
                                        <tr>
                                           <th>Observações</th>
                                             <th>Eficácia</th>
                                            <th>Responsável</th>
                                             <th>Data de Fecho</th>
                                        </tr>
                                        </thead>
                                        <tbody>";

        echo "<tr>
                                            <td style='border-bottom: none !important; text-align: center !important;'>";echo $observacoesAcidente; echo "</td>
 <td style='border-bottom: none !important; text-align: center !important;'>";echo $eficaciaAcidente; echo "</td>
<td style='border-bottom: none !important; text-align: center !important;'>";echo $responsavelAcidente; echo "</td>
   <td style='border-bottom: none !important; text-align: center !important;'>";

        if(!empty($dataFechoAcidente)){

            echo $textoDataFechoAcidente;

        }

        echo "</td>

</tr>";

        echo "</tbody>
                                    </table>



                                    <br><br>";

    }

    mysqli_stmt_close($stmt);

    echo "<br><br><br><br>
                                        <table style='width: 100%'>
                                            <tbody>

                                            <tr>

                                                <td style='width:100%!important;  text-align: center !important; padding-top: 10px!important; padding-bottom:  15px !important;'>

                                                    <h3 style='display: inline;  padding-bottom: 10px !important;'>
                                                        ________________________________</h3><br>
                                                    <h4 style='display: inline; font-weight: normal !important; text-align: center'>(Responsável dos Recursos Humanos)</h4>

                                                </td>

                                            </tr>

                                            </tbody>
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

        <script src='teste/finished/js/jquery.PrintArea.js_4.js'></script>
<script src='teste/finished/js/core.js'></script>

</body>
</html>";