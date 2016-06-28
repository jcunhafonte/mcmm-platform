<?php

session_start();

if ((!isset($_SESSION['ativoAdmin']))) {

    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    header("location:entrar.php?url=$actual_link");

} else {

    if ((!isset($_GET['colaborador']) AND (!isset($_GET['contrato'])))) {
        header('location:index.php');
    }

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

<!-- Modal fade in scale up -->
<div class='md-modal md-fade-in-scale-up' id='md-fade-in-scale-up'>
     <div class='md-content'>
        <h3>Remover Contrato</h3>

        <div>
            <p>Tem a certeza que pretende remover este contrato do colaborador <strong><span id='alteravel'></span></strong>?</p>
            <ul>
                <li><strong>Atenção:</strong> Esta ação não pode ser revertida.
                </li>
                <li><strong>Informação:</strong> Após a confirmação da remoção, pode voltar a adicionar contratos ao colaborador.
                <br>O contrato que pretende remover encontra-se inativo, visto que não é possível ter um colaborador sem contrato.<br>Sendo assim, esta ação é apenas informativa.
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
Menus('colaboradores');

$query = "SELECT contrato.id_contrato, contrato.situacao_contratual, contrato.funcao, contrato.posto_trabalho,
contrato.periodo_experimental, contrato.data_final_per_experimental, contrato.horas_semanais, contrato.horas_diarias,
contrato.descanso_complementar, contrato.sistema_rotativo, contrato.NIB, contrato.instituicao_bancaria,
contrato.agencia, contrato.vencimento_base, contrato.categoria, contrato.data_admissao, contrato.ref_id_colaborador,
contrato.data_contrato, contrato.data_final_contrato, contrato.atual,
colaborador.nome_completo, colaborador.id_colaborador, colaborador.ativo
FROM contrato INNER JOIN colaborador ON colaborador.id_colaborador = contrato.ref_id_colaborador
WHERE colaborador.ativo = 1 AND contrato.id_contrato = ? ORDER BY colaborador.nome_completo ASC";

$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_param($stmt, 's', $_GET['contrato']);
mysqli_stmt_bind_result($stmt, $idContrato, $situacaoContratualContrato, $funcaoContrato, $postoTrabalhoContrato,
    $perExperimentalContrato, $novaDataFinalPerExperimental, $horasSemanaisContrato, $horasDiariasContrato,
    $descansoContrato, $sistemaRotativoContrato, $NIBContrato, $instBancariaContrato, $agenciaContrato,
    $vencimentoBaseContrato, $categoriaContrato, $dataInicioContrato, $refIdColaboradorContrato, $dataAtual,
    $dataFinalContrato, $atualContrato, $nomeColaboradorContrato,
    $idColaboradorContrato, $ativoColaborador);
mysqli_stmt_execute($stmt);
mysqli_stmt_fetch($stmt);

if ($atualContrato == 1) {
    $textoAtualContrato = "Contrato Ativo";
} else {
    $textoAtualContrato = "Contrato Inativo";
}

$conversaoDataInicioContrato = new DateTime($dataInicioContrato);
$textoDataInicioContrato = $conversaoDataInicioContrato->format('d-m-Y');

$conversaoFinalContrato = new DateTime($dataFinalContrato);
$textoFinalContrato = $conversaoFinalContrato->format('d-m-Y');

$conversaoDataAtual = new DateTime($dataAtual);
$textoDataAtual = $conversaoDataAtual->format('d-m-Y');

$conversaoPerExperimental = new DateTime($novaDataFinalPerExperimental);
$textoPerExperimental = $conversaoPerExperimental->format('d-m-Y');

mysqli_stmt_close($stmt);

echo "<!-- Start right content -->
    <div class='content-page'>
        <!-- ============================================================== -->
        <!-- Start Content here -->
        <!-- ============================================================== -->
        <div class='content'>
            <!-- Page Heading Start -->
            <div class='page-heading'>
                <h1 style='float: left !important;'><i class='fa fa-user-plus'></i> Detalhes do Contrato</h1>

                <div class='text-right' style='height: 43px !important; padding-top: 8px !important;'>
								<div class='row text-right'>
									<div class='col-lg-4 text-right' style='float: right!important;'>";

if ($atualContrato == 0) {
    echo "<a
                                        data-href='php/verificacoes/verificaRemoverContrato.php?colaborador=$refIdColaboradorContrato&contrato=$idContrato'
                                        onclick='modalRemover($idContrato);'
                                                    id='botaoRemover$idContrato'
                                                      data-modal='md-fade-in-scale-up'
                                                      class='md-trigger'
                                        data-target='#md-fade-in-scale-up'>
                                        <button type='button' class='text-right btn btn-danger btn-sm'>
										<i class='fa fa-remove'></i> Remover Contrato</button></a>";
}

echo "<a href='editarContrato.php?contrato=$idContrato'>
                                        <button type='button' class='text-right btn btn-primary btn-sm'>
										<i class='fa fa-pencil-square-o'></i> Editar Contrato</button></a>
										</div>
								</div>
							</div>
							<!-- End div .user-button -->


            </div>
            <!-- Page Heading End-->

            <!-- Your awesome content goes here -->
            <div class='row'>

                <div class='col-sm-12 portlets'>";

if (isset($_GET['formacaoRemovida'])) {

    $colaboradorRemovido = $_GET['formacaoRemovida'];

    $query = "SELECT id_colaborador, nome_completo FROM colaborador WHERE id_colaborador = ?";

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
               Ocorreu um erro ao remover o comportamento do colaborador <b>$nomeCompletoRemovido</b>.<br>
               <a class='alert-link'>Votos de uma excelente experiência!</a></div>";
}

$query = "SELECT nome_completo FROM colaborador WHERE id_colaborador = ?";
$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_param($stmt, 'i', $_GET['colaborador']);
mysqli_stmt_bind_result($stmt, $nomeApresenta);
mysqli_stmt_execute($stmt);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

echo "<div class='widget'>
                        <div class='widget-header'>
                            <h2><strong id='titulo$idContrato'>$nomeApresenta</strong> - $textoDataAtual</h2>

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
                                            <th>Função</th>
                                             <th>Categoria</th>
                                             <th>Área do Posto de Trabalho</th>
                                             <th>Situação Contratual</th>
                                               <th>Data Admissão</th>
                                               <th>Período Experimental</th>
                                        </tr>
                                        </thead>
                                            <td width='16%'>$funcaoContrato</td>
                                             <td width='16%'>$categoriaContrato</td>
                                                <td width='16%'>$postoTrabalhoContrato</td>
                                             <td width='16%'>$situacaoContratualContrato</td>
                                               <td width='16%'>$textoDataInicioContrato</td>
                                               <td width='17%'>$perExperimentalContrato Dias</td>
                                      </tr>
                                </tbody>
                            </table>
                        </div>

                         <div class='widget-content padding'>
                            <table id='user' class='table table-bordered table-striped' style='clear: both'>
                                <tbody>
                                 <thead>
                                        <tr>
                                            <th>Data Final - Período Experimental</th>
                                             <th>Número - Horas Semanais</th>
                                             <th>Número - Horas Diárias</th>
                                             <th>Descanso Complementar - Sábado</th>
                                               <th>Sistema Rotativo</th>
                                               <th>NIB</th>
                                        </tr>
                                        </thead>
                                             <td width='16%'>$textoPerExperimental</td>
                                             <td width='16%'>$horasSemanaisContrato Horas</td>
                                                <td width='16%'>$horasDiariasContrato Horas</td>
                                             <td width='16%'>$descansoContrato</td>
                                               <td width='16%'>$sistemaRotativoContrato</td>
                                               <td width='17%'>"; if(!empty($NIBContrato)){echo "$NIBContrato";}

if ($atualContrato == 1) {
    $textoAtualContrato = "Contrato Ativo";
} else {
    $textoAtualContrato = "Contrato Inativo";
}

echo "</td>
                                      </tr>
                                </tbody>
                            </table>
                        </div>

                           <div class='widget-content padding'>
                            <table id='user' class='table table-bordered table-striped' style='clear: both'>
                                <tbody>
                                 <thead>
                                        <tr>
                                        <th>Estado do Contrato</th>
                                            <th>Instituição Bancária</th>
                                             <th>Agência</th>
                                             <th>Vencimento Base</th>
                                             <th>Data Final - Contrato de Trabalho</th>
                                        </tr>
                                        </thead>
                                        <td width='20%'>$textoAtualContrato</td>
                                             <td width='20%'>$instBancariaContrato</td>
                                             <td width='20%'>$agenciaContrato</td>
                                                <td width='20%'>$vencimentoBaseContrato";echo "€</td>
                                             <td width='20%'>$textoFinalContrato</td>
                                      </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>";

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