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

<!-- Modal fade in scale up -->
<div class='md-modal md-fade-in-scale-up' id='md-fade-in-scale-up'>
    <div class='md-content'>
        <h3>Remover Mudança de Função</h3>

        <div>
            <p>Tem a certeza que pretende remover esta mudança do colaborador <strong><span id='alteravel'></span></strong>?</p>
            <ul>
                <li><strong>Atenção:</strong> Esta ação não pode ser revertida.
                </li>
                <li><strong>Informação:</strong> Após a confirmação da remoção, pode voltar a adicionar mudanças de função ao colaborador.
                </li>
                <li><strong>Fechar:</strong> Clique no botão indicativo para fechar este aviso e cancelar a ação.</li>
            </ul>
            <p>
                <button class='btn btn-danger md-close'>Fechar</button>
                <a class='btn-remover' href=''><button class='btn btn-success md-close'>Remover</button></a>
            </p>
        </div>
    </div>
    <!-- End div .md-content -->
</div>
<!-- End div .md-modal .md-fade-in-scale-up -->

<!-- Begin page -->
<div id='wrapper'>";

require_once('php/includes/menus.php');
Menus('mudancas', 'visualizarMudancas');

echo "<!-- Start right content -->
    <div class='content-page'>
        <!-- ============================================================== -->
        <!-- Start Content here -->
        <!-- ============================================================== -->
        <div class='content'>
            <!-- Page Heading Start -->
            <div class='page-heading'>
                <h1><i class='fa fa-exchange'></i> Mudanças de Função</h1>

                <h3>Verifique as mudanças de função já adicionadas aos seus colaboradores</h3></div>

            <div class='row'>


   <div class='col-md-12'>";

if (isset($_GET['mudancaRemovido'])) {

    $colaboradorRemovido = $_GET['mudancaRemovido'];

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
               O comportamento do colaborador <b>$nomeCompletoRemovido</b> foi removido com sucesso.<br>
               <a class='alert-link'>Votos de uma excelente experiência!</a></div>";
}

if (isset($_GET['mudancaRemovidoErro'])) {

    $colaboradorRemovido = $_GET['mudancaRemovidoErro'];

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
               Ocorreu um erro ao remover o comportamento do colaborador <b>$nomeCompletoRemovido</b>.<br>
               <a class='alert-link'>Votos de uma excelente experiência!</a></div>";
}

    echo "<div class='widget'>
            <div class='widget-header'>
                <h2><strong>Filtrar</strong> por Colaborador</h2>
            </div>
                    <div class='form-group'>

                        <form action='registoMudancas.php' method='get'>
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

                <div class='col-md-12'>";

if ((!isset($_GET['colaborador'])) || ($_GET['colaborador'] == 0)) {

    echo "<div class='widget'>
                        <div class='widget-header'>
                            <h2><strong>Registo</strong> de Mudanças de Função</h2>

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
                                            <th>Data</th>
                                            <th>Medida</th>
                                            <th>Nova Função</th>
                                            <th>Novo Vencimento</th>
                                            <th>Ações</th>
                                        </tr>
                                        </thead>
                                        <tbody>";

    $query = "SELECT mudancas.id_mudanca, mudancas.ref_id_colaborador, mudancas.data_mudanca, mudancas.medida,
mudancas.causa, mudancas.funcao, mudancas.vencimento, mudancas.periodo_experiencia, mudancas.eficacia,
mudancas.comentarios, mudancas.historico_vencimento, mudancas.historico_funcao, colaborador.nome_completo,
colaborador.ativo FROM mudancas INNER JOIN colaborador ON mudancas.ref_id_colaborador = colaborador.id_colaborador
WHERE colaborador.ativo = 1 ORDER BY colaborador.nome_completo ASC";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_result($stmt, $idMudanca, $refIdColaborador, $dataMudanca, $medidaMudanca,
        $causaMudanca, $funcaoMudanca, $vencimentoMudanca, $periodoExperienciaMudanca, $eficaciaMudanca,
        $comentariosMudanca, $historicoVencimentoMudanca, $historicoFuncaoMudanca, $nomeMudanca, $ativoMudanca);
    mysqli_stmt_execute($stmt);

    while (mysqli_stmt_fetch($stmt)) {

        $conversaoDataMudanca = new DateTime($dataMudanca);
        $textoDataMudanca = $conversaoDataMudanca->format('d-m-Y');

        echo "<tr>
                                            <td><a href='perfilColaborador.php?colaborador=$refIdColaborador'>
                                            <span id='titulo$idMudanca'>$nomeMudanca</span></a></td>
                                            <td>$textoDataMudanca</td>
                                            <td>$medidaMudanca</td>
                                            <td>$funcaoMudanca</td>
                                            <td>"; echo $vencimentoMudanca; echo "€</td>
                                            <td class='text-center'>
                                                <div class='btn-group btn-group-xs text-center'>

                                                <a href='registoMudancaDetalhes.php?colaborador=$refIdColaborador&mudanca=$idMudanca'
                                                data-toggle='tooltip' title='Ver Detalhes'
                                                class='text-center btn btn-default'><i class='fa fa-eye'></i></a>
<a href='editarMudanca.php?mudanca=$idMudanca' data-toggle='tooltip' title='Editar Mudança'
                                                       class='text-center btn btn-default'><i
                                                            class='fa fa-edit'></i></a>
                                                <a data-href='php/verificacoes/verificaCancelarMudanca.php?colaborador=$refIdColaborador&mudanca=$idMudanca'
                                                    data-toggle='tooltip' title='Remover Mudança' class='md-trigger text-center btn btn-default'
                                                      onclick='modalRemover($idMudanca);' id='botaoRemover$idMudanca'
                                                       data-target='#md-fade-in-scale-up' data-modal='md-fade-in-scale-up'>
                                                    <i class='fa fa-times'></i></a>
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
                            <h2><strong>Registo</strong> de Mudanças de Função - <strong>$nomeCompletoApresenta</strong></h2>

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
                                            <th>Data</th>
                                            <th>Medida</th>
                                            <th>Nova Função</th>
                                            <th>Novo Vencimento</th>
                                            <th>Ações</th>
                                        </tr>
                                        </thead>
                                        <tbody>";

    $query = "SELECT mudancas.id_mudanca, mudancas.ref_id_colaborador, mudancas.data_mudanca, mudancas.medida,
mudancas.causa, mudancas.funcao, mudancas.vencimento, mudancas.periodo_experiencia, mudancas.eficacia,
mudancas.comentarios, mudancas.historico_vencimento, mudancas.historico_funcao, colaborador.nome_completo,
colaborador.ativo FROM mudancas INNER JOIN colaborador ON mudancas.ref_id_colaborador = colaborador.id_colaborador
WHERE colaborador.ativo = 1 AND ref_id_colaborador = ? ORDER BY colaborador.nome_completo ASC";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt,'s', $_GET['colaborador']);
    mysqli_stmt_bind_result($stmt, $idMudanca, $refIdColaborador, $dataMudanca, $medidaMudanca,
        $causaMudanca, $funcaoMudanca, $vencimentoMudanca, $periodoExperienciaMudanca, $eficaciaMudanca,
        $comentariosMudanca, $historicVencimentoMudanca, $historicoFuncaoMudanca, $nomeMudanca, $ativoMudanca);
    mysqli_stmt_execute($stmt);

    while (mysqli_stmt_fetch($stmt)) {

        $conversaoDataMudanca = new DateTime($dataMudanca);
        $textoDataMudanca = $conversaoDataMudanca->format('d-m-Y');

        echo "<tr>
                                            <td><a href='perfilColaborador.php?colaborador=$refIdColaborador'>
                                            <span id='titulo$idMudanca'>$nomeMudanca</span></a></td>
                                            <td>$textoDataMudanca</td>
                                            <td>$medidaMudanca</td>
                                            <td>$funcaoMudanca</td>
                                            <td>"; echo $vencimentoMudanca; echo "€</td>
                                            <td class='text-center'>
                                                <div class='btn-group btn-group-xs text-center'>

                                                 <a href='registoMudancaDetalhes.php?colaborador=$refIdColaborador&mudanca=$idMudanca'
                                                data-toggle='tooltip' title='Ver Detalhes'
                                                class='text-center btn btn-default'><i class='fa fa-eye'></i></a>
<a href='editarMudanca.php?mudanca=$idMudanca' data-toggle='tooltip' title='Editar Mudança'
                                                       class='text-center btn btn-default'><i
                                                            class='fa fa-edit'></i></a>
                                                <a data-href='php/verificacoes/verificaCancelarMudanca.php?colaborador=$refIdColaborador&mudanca=$idMudanca'
                                                    data-toggle='tooltip' title='Remover Mudança' class='md-trigger text-center btn btn-default'
                                                      onclick='modalRemover($idMudanca);' id='botaoRemover$idMudanca'
                                                       data-target='#md-fade-in-scale-up' data-modal='md-fade-in-scale-up'>
                                                    <i class='fa fa-times'></i></a>
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

    <script>
    function modalRemover(param){

        $('#md-fade-in-scale-up').find('.btn-remover').attr('href', $(\"#botaoRemover\" + param).data('href'));

        var titulo = '';
        titulo = document.getElementById('titulo'+param).innerHTML;
        document.getElementById('alteravel').innerHTML = titulo;

    };
</script>

</body>
</html>";