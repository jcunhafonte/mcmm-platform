<?php session_start();

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
    <link href='assets/libs/bootstrap-select/bootstrap-select.min.css' rel='stylesheet' type='text/css'/>
    <link href='assets/libs/bootstrap-select2/select2.css' rel='stylesheet' type='text/css'/>
    <link href='assets/libs/bootstrap-xeditable/css/bootstrap-editable.css' rel='stylesheet' type='text/css'/>
    <link href='assets/libs/bootstrap-select2/select2.css' rel='stylesheet' type='text/css'/>
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

<!-- Modal Start -->
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
Menus('alertas');

echo "<!-- Start right content -->
    <div class='content-page'>
        <!-- ============================================================== -->
        <!-- Start Content here -->
        <!-- ============================================================== -->
        <div class='content'>
            <!-- Page Heading Start -->
            <div class='page-heading'>
                <h1><i class='fa fa-bell'></i> Alertas</h1>
            </div>
            <!-- Page Heading End-->

            <!-- Your awesome content goes here -->
            <div class='row'>

                <div class='col-sm-12'>";

$query = "SELECT nome_completo, cartao_cidadao, validade_cc_passaporte FROM
colaborador WHERE (validade_cc_passaporte < CURDATE()) AND (validade_cc_passaporte <> '1970-01-01 00:00:00')
AND ativo = 1 ORDER BY nome_completo ASC";

$stmt = mysqli_prepare($link, $query);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) > 0) {
    mysqli_stmt_close($stmt);
    echo "<div class='widget'>
                        <div class='widget-header'>
                            <h2>Cartão de <strong>Cidadão</strong></h2>

                            <div class='additional-btn'>
                                <a href='#' class='hidden reload'><i class='icon-ccw-1'></i></a>
                                <a href='#' class='widget-toggle'><i class='icon-down-open-2'></i></a>

                            </div>
                        </div>
                        <div class='widget-content padding'>
                            <table id='user' class='table table-bordered table-striped' style='clear: both'>
                                <tbody>
                                 <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Identificação do Documento</th>
                                            <th>Data de Validade</th>
                                        </tr>
                                        </thead>";

    $query = "SELECT nome_completo, cartao_cidadao, validade_cc_passaporte FROM colaborador
WHERE (validade_cc_passaporte < CURDATE()) AND (validade_cc_passaporte <> '1970-01-01 00:00:00')
AND ativo = 1 ORDER BY nome_completo ASC";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_result($stmt, $nomeColaborador, $cartaoCidadaoColaborador,
        $validadeCCColaborador);
    mysqli_stmt_execute($stmt);

    while (mysqli_stmt_fetch($stmt)) {

        $conversaoValidadeCCColaborador = new DateTime($validadeCCColaborador);
        $textoValidadeCCColaborador = $conversaoValidadeCCColaborador->format('d-m-Y');

        $cartaoCidadaoColaborador = chunk_split($cartaoCidadaoColaborador, 4, ' ');

        echo "<tr>
                                    <td width='45%'>$nomeColaborador</td>
                                    <td width='30%'>$cartaoCidadaoColaborador</td>
                                      <td width='25%'>$textoValidadeCCColaborador</td>
                                </tr>";
    }

    mysqli_stmt_close($stmt);
    echo "</tbody>
                            </table>
                        </div>
                    </div>";
}else{
    mysqli_stmt_close($stmt);
    echo "<div class='widget'>
                        <div class='widget-header'>
                            <h2>Cartão de <strong>Cidadão</strong></h2>

                            <div class='additional-btn'>
                                <a href='#' class='hidden reload'><i class='icon-ccw-1'></i></a>
                                <a href='#' class='widget-toggle'><i class='icon-down-open-2'></i></a>

        <div class='widget-content padding'>
                            <table id='user' class='table table-bordered table-striped' style='clear: both'>
                                <tbody>
                                 <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Identificação do Documento</th>
                                            <th>Data de Validade</th>
                                        </tr>
                                        </thead>";

        echo "<tr>
            <td width='100%' colspan='3'>Não há alertas para apresentar. Os documentos dos colaboradores encontram-se todos regularizados.</td>
        </tr>";

    echo "</tbody>
                            </table>
                        </div>
                    </div>";
}

$query = "SELECT nome_completo, carta_conducao, validade_conducao FROM
colaborador WHERE (validade_conducao < CURDATE()) AND
(validade_conducao <> '1970-01-01 00:00:00') AND ativo = 1 ORDER BY nome_completo ASC";

$stmt = mysqli_prepare($link, $query);

mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) > 0) {
    mysqli_stmt_close($stmt);
    echo "<div class='widget'>
                        <div class='widget-header'>
                            <h2>Carta de <strong>Condução</strong></h2>

                            <div class='additional-btn'>
                                <a href='#' class='hidden reload'><i class='icon-ccw-1'></i></a>
                                <a href='#' class='widget-toggle'><i class='icon-down-open-2'></i></a>
                            </div>
                        </div>

                           <div class='widget-content padding'>
                      <table id='user' class='table table-bordered table-striped' style='clear: both'>
                                <tbody>
                                 <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Identificação do Documento</th>
                                            <th>Data de Validade</th>
                                        </tr>
                                        </thead>";
    $query = "SELECT nome_completo, carta_conducao, validade_conducao FROM
colaborador WHERE (validade_conducao < CURDATE()) AND
(validade_conducao <> '1970-01-01 00:00:00') AND ativo = 1 ORDER BY nome_completo ASC";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_result($stmt, $nomeColaborador, $cartaoCidadaoColaborador,
        $validadeCCColaborador);
    mysqli_stmt_execute($stmt);

    while (mysqli_stmt_fetch($stmt)) {

        $conversaoValidadeCCColaborador = new DateTime($validadeCCColaborador);
        $textoValidadeCCColaborador = $conversaoValidadeCCColaborador->format('d-m-Y');

        $cartaoCidadaoColaborador = chunk_split($cartaoCidadaoColaborador, 4, ' ');

        echo "<tr>
                                    <td width='45%'>$nomeColaborador</td>
                                    <td width='30%'>$cartaoCidadaoColaborador</td>
                                      <td width='25%'>$textoValidadeCCColaborador</td>
                                </tr>";
    }

    mysqli_stmt_close($stmt);
    echo "</tbody>
                            </table>
                        </div>
                    </div>";
}else{
    mysqli_stmt_close($stmt);
    echo "<div class='widget'>
                        <div class='widget-header'>
                            <h2>Carta de <strong>Condução</strong></h2>

                            <div class='additional-btn'>
                                <a href='#' class='hidden reload'><i class='icon-ccw-1'></i></a>
                                <a href='#' class='widget-toggle'><i class='icon-down-open-2'></i></a>
                            </div>
                        </div>
                        <div class='widget-content padding'>
                            <table id='user' class='table table-bordered table-striped' style='clear: both'>
                                <tbody>
                                 <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Identificação do Documento</th>
                                            <th>Data de Validade</th>
                                        </tr>
                                        </thead>";

    echo "<tr>
            <td width='100%' colspan='3'>Não há alertas para apresentar. Os documentos dos colaboradores encontram-se todos regularizados.</td>
        </tr>";

    echo "</tbody>
                            </table>
                        </div>
                    </div>";
}

//CONTRATOS

$dataQuery1 = date('Y-m-d', strtotime('-1 year'));
$dataQuery2 = date('Y-m-d', strtotime('-6 month'));
$dataQuery3 = date('Y-m-d', strtotime('-35 days'));
$dataQuery4 = date('Y-m-d', strtotime('-20 days'));

$query = "SELECT contrato.data_contrato, contrato.data_final_contrato
FROM contrato
WHERE ((contrato.data_contrato <= ?) OR (contrato.data_contrato <= ?))
AND ((contrato.data_final_contrato >= ?) OR (contrato.data_final_contrato >= ?))
AND (contrato.data_contrato <> '1970-01-01 00:00:00')
AND (contrato.data_final_contrato <> '1970-01-01 00:00:00')
AND contrato.atual = 1";

$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_param($stmt, 'ssss', $dataQuery1, $dataQuery2, $dataQuery4, $dataQuery3);

mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) > 0) {
    mysqli_stmt_close($stmt);
    echo "<div class='widget'>
                        <div class='widget-header'>
                            <h2><strong>Contratos</strong></h2>

                            <div class='additional-btn'>
                                <a href='#' class='hidden reload'><i class='icon-ccw-1'></i></a>
                                <a href='#' class='widget-toggle'><i class='icon-down-open-2'></i></a>
                            </div>
                        </div>

                           <div class='widget-content padding'>
                      <table id='user' class='table table-bordered table-striped' style='clear: both'>
                                <tbody>
                                 <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Início do Contrato</th>
                                            <th>Fim do Contrato</th>
                                        </tr>
                                        </thead>";
    //6 Meses
    $query = "SELECT contrato.data_contrato, contrato.data_final_contrato,
colaborador.nome_completo
FROM contrato
INNER JOIN colaborador ON contrato.ref_id_colaborador = colaborador.id_colaborador
WHERE (contrato.data_contrato >= ?) AND (contrato.data_contrato <= ?)
AND (contrato.data_final_contrato >= ?)
AND (contrato.data_contrato <> '1970-01-01 00:00:00')
AND (contrato.data_final_contrato <> '1970-01-01 00:00:00')
AND contrato.atual = 1 ORDER BY colaborador.nome_completo ASC";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'sss', $dataQuery1, $dataQuery2, $dataQuery4);
    mysqli_stmt_bind_result($stmt, $dataContrato, $dataFinalContrato,
        $nomeColaboradorFimContrato);
    mysqli_stmt_execute($stmt);

    while (mysqli_stmt_fetch($stmt)) {

        $conversaoValidadeCCColaborador = new DateTime($dataContrato);
        $textoValidadeCCColaborador = $conversaoValidadeCCColaborador->format('d-m-Y');

        $conversaoValidadeCCColaboradorA = new DateTime($dataFinalContrato);
        $textoValidadeCCColaboradorA = $conversaoValidadeCCColaboradorA->format('d-m-Y');

        echo "<tr>
                                    <td width='45%'>$nomeColaboradorFimContrato</td>
                                    <td width='30%'>$textoValidadeCCColaborador</td>
                                      <td width='25%'>$textoValidadeCCColaboradorA</td>
                                </tr>";
    }

    mysqli_stmt_close($stmt);

    //1 Ano
    $query = "SELECT contrato.data_contrato, contrato.data_final_contrato, colaborador.nome_completo
FROM contrato
INNER JOIN colaborador ON contrato.ref_id_colaborador = colaborador.id_colaborador
WHERE (contrato.data_contrato <= ?) AND (contrato.data_final_contrato >= ?)
AND (contrato.data_contrato <> '1970-01-01 00:00:00')
AND (contrato.data_final_contrato <> '1970-01-01 00:00:00')
AND contrato.atual = 1 ORDER BY colaborador.nome_completo ASC";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'ss', $dataQuery1, $dataQuery3);
    mysqli_stmt_bind_result($stmt, $dataContrato, $dataFinalContrato,
        $nomeColaboradorFimContrato);
    mysqli_stmt_execute($stmt);

    while (mysqli_stmt_fetch($stmt)) {

        $conversaoValidadeCCColaborador = new DateTime($dataContrato);
        $textoValidadeCCColaborador = $conversaoValidadeCCColaborador->format('d-m-Y');

        $conversaoValidadeCCColaboradorA = new DateTime($dataFinalContrato);
        $textoValidadeCCColaboradorA = $conversaoValidadeCCColaboradorA->format('d-m-Y');

        echo "<tr>
                                    <td width='45%'>$nomeColaboradorFimContrato</td>
                                    <td width='30%'>$textoValidadeCCColaborador</td>
                                      <td width='25%'>$textoValidadeCCColaboradorA</td>
                                </tr>";
    }

    mysqli_stmt_close($stmt);


    echo "</tbody>
                            </table>
                        </div>
                    </div>";
}else{
    mysqli_stmt_close($stmt);
    echo "<div class='widget'>
                        <div class='widget-header'>
                            <h2><strong>Contratos</strong></h2>

                            <div class='additional-btn'>
                                <a href='#' class='hidden reload'><i class='icon-ccw-1'></i></a>
                                <a href='#' class='widget-toggle'><i class='icon-down-open-2'></i></a>
                            </div>
                        </div>
                        <div class='widget-content padding'>
                            <table id='user' class='table table-bordered table-striped' style='clear: both'>
                                <tbody>
                                 <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Início do Contrato</th>
                                            <th>Fim do Contrato</th>
                                        </tr>
                                        </thead>";

    echo "<tr>
            <td width='100%' colspan='3'>Não há alertas para apresentar. Os contratos dos colaboradores encontram-se todos regularizados.</td>
        </tr>";

    echo "</tbody>
                            </table>
                        </div>
                    </div>";
}



echo "</div>
            </div>
            <!-- End of your awesome content -->

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
<script src='assets/libs/bootstrap-select/bootstrap-select.min.js'></script>
<script src='assets/libs/bootstrap-inputmask/inputmask.js'></script>
<script src='assets/libs/bootstrap-xeditable/js/bootstrap-editable.min.js'></script>
<script src='assets/libs/bootstrap-xeditable/demo/jquery.mockjax.js'></script>
<script src='assets/libs/bootstrap-xeditable/demo/demo-mock.js'></script>
<script src='assets/libs/bootstrap-select2/select2.min.js'></script>
<script src='assets/libs/jquery-clndr/moment-2.5.1.js'></script>
<script src='assets/libs/bootstrap-typeahead/bootstrap3-typeahead.min.js'></script>
<script src='assets/libs/ckeditor/ckeditor.js'></script>
<script src='assets/libs/ckeditor/adapters/jquery.js'></script>
<script src='assets/js/pages/advanced-forms.js'></script>
</body>
</html>";