<?php

session_start();

if ((!isset($_SESSION['ativoAdmin']))) {

    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    header("location:entrar.php?url=$actual_link");

} else {

    if ((!isset($_GET['colaborador']) AND (!isset($_GET['ferias'])))) {
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
Menus('comunicacoes');

$query = "SELECT ferias.id_ferias, ferias.inicio_ferias, ferias.fim_ferias, ferias.ref_id_colaborador,
colaborador.nome_completo, colaborador.funcao, colaborador.morada, colaborador.funcao, colaborador.categoria,
colaborador.telemovel, colaborador.telefone, colaborador.codigo_postal, colaborador.localidade
FROM ferias INNER JOIN colaborador ON colaborador.id_colaborador = ferias.ref_id_colaborador
WHERE colaborador.ativo = 1 AND ferias.id_ferias = ? ORDER BY colaborador.nome_completo ASC ";

$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_param($stmt, 'i', $_GET['ferias']);

mysqli_stmt_bind_result($stmt, $idFerias, $inicioFerias, $fimFerias, $refColaboradorFerias,
    $colaboradorNome, $funcaoColaborador, $moradaColaborador, $funcaoColaborador,
    $categoriaColaborador, $telmColaborador, $telfColaborador, $codPostalColaborador, $localidadeColaborador);

mysqli_stmt_execute($stmt);

mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

$conversaoDataConsultaFerias = new DateTime($inicioFerias);
$textoDataConsultaFerias = $conversaoDataConsultaFerias->format('d-m-Y');

$conversaoDataConsultaFeriasFim = new DateTime($fimFerias);
$textoDataConsultaFeriasFim = $conversaoDataConsultaFeriasFim->format('d-m-Y');

function getWorkingDays($startDate, $endDate)
{
    $begin = strtotime($startDate);
    $end = strtotime($endDate);

    if ($begin > $end) {
        echo "startdate is in the future! <br />";

        return 0;
    } else {
        $no_days = 0;
        $weekends = 0;
        while ($begin <= $end) {
            $no_days++; // no of days in the given interval
            $what_day = date("N", $begin);
            if ($what_day > 5) { // 6 and 7 are weekend days
                $weekends++;
            };
            $begin += 86400; // +1 day
        };
        $working_days = $no_days - $weekends;

        return $working_days;
    }
}

echo "<!-- Start right content -->
    <div class='content-page'>
        <!-- ============================================================== -->
        <!-- Start Content here -->
        <!-- ============================================================== -->
        <div class='content'>
            <!-- Page Heading Start -->
            <div class='page-heading'>
                <h1 style='float: left !important;'><i class='fa fa-comments'></i> Comunicação - Férias</h1>

                  <div class='text-right' style='height: 43px !important; padding-top: 8px !important;'>
                  <div class='row text-right'>
									<div class='col-lg-4 text-right' style='float: right!important;'>
                                   <a href='#' rel='contentA' class='print btn btn-primary btn-sm invoice-print'>
                                   <i class='icon-print-2'></i> Imprimir</a>
                                   </div>
								</div>
							</div>
							<!-- End div .user-button -->

            </div>
            <!-- Page Heading End-->

            <!-- Your awesome content goes here -->
            <div class='row'>

                <div class='col-sm-12 portlets'>

                	<!-- Your awesome content goes here -->
                <div id='contentA'>
				<div class='widget invoice'>
					<div class='widget-content padding' style='padding-top: 15px !important;'>
					<div class='row'>

						<div class='table-responsive'>
<style>
table .teste tr td{
padding-top: 100px !important;
}
</style>
    <table width='100%'>
                                <thead>


                                </thead>
                                 <tr width='100%'>
                                                <td style='width: 60%' width='40%'>
                                                    <h4><img src='assets/img/inv-logo.png' alt='Logo'></h4>

                                                    Rua dos Caniços, Ervosas<br>
                                                    3830-252 Ílhavo<br>
                                                    <abbr title='Phone'>Telefone:</abbr> 234 940 050<br>
  	                                                <abbr title='Fax'>Fax:</abbr> 234 940 059<br>
							                        <abbr title='Email'>Email:</abbr> geral@bentoenascimento.com

                                                </td>
                                                	<td width='60%' style='text-align: right'>
									<h3>REGISTO DE FÉRIAS</h3>
							<h4>BN-$idFerias</h4>
							</td>
                                            </tr>
                                </table>

						<table class='teste' width='100%'>
							<tbody>

								<tr>
									<td width='40%'></td>
									<td width='60%' style='text-align: right'>
									  $colaboradorNome<br>
									 $moradaColaborador<br>";
if (!empty($codPostalColaborador) OR !empty($localidadeColaborador)) {
    echo "$codPostalColaborador $localidadeColaborador<br>";
}

if (!empty($telmColaborador) OR $telmColaborador != 0) {
    echo $telmColaborador . "<br>";
}
if (!empty($telfColaborador) OR $telfColaborador != 0) {
    echo $telfColaborador;
}
echo "</td>
								</tr>";

$nr_work_days = getWorkingDays($inicioFerias, $fimFerias);


echo "<tr>
								<td>
								<h3 style='display: inline;'>DIAS ÚTEIS: </h3>
								<h3 style='display: inline; font-weight: normal !important;'>
								$nr_work_days Dias</h3>
								</td>
								</tr>";


echo "<tr><td>&nbsp;</td></tr>

								<tr>
								<td colspan='2' style='padding-top: 10px!important; padding-bottom:  15px !important;'>

	                                <h3 style='display: inline;  padding-bottom: 10px !important;'>Data Início</h3><br>
                                    <h4 style='display: inline; font-weight: normal !important;'>$textoDataConsultaFerias</h4>

								</td>
								</tr>

									<tr>
								<td colspan='2' style='padding-top: 10px!important; padding-bottom:  15px !important;'>

	                                <h3 style='display: inline;  padding-bottom: 10px !important;'>Data Fim</h3><br>
                                    <h4 style='display: inline; font-weight: normal !important;'>$textoDataConsultaFeriasFim</h4>

								</td>
								</tr>


<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>

							</tbody>
						</table>

						<table style='width: 100%'>
						<tbody>

							<tr>
								<td style='width:50%!important; text-align: center !important; padding-top: 10px!important; padding-bottom:  15px !important;'>

	                                <h3 style='display: inline;  padding-bottom: 10px !important;'>
	                                ________________________________</h3><br>
                                    <h4 style='display: inline; font-weight: normal !important; text-align: center'>($colaboradorNome)</h4>

								</td>

									<td style='width:50%!important;  text-align: center !important; padding-top: 10px!important; padding-bottom:  15px !important;'>

	                                <h3 style='display: inline;  padding-bottom: 10px !important;'>
	                                ________________________________</h3><br>
                                    <h4 style='display: inline; font-weight: normal !important; text-align: center'>(Responsável dos Recursos Humanos)</h4>

								</td>

								</tr>

						</tbody>
						</table>

						</div>

				</div>
                    </div>
				<!-- End of your awesome content -->";


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

    <script src='teste/finished/js/jquery.PrintArea.js_4.js'></script>
        <script src='teste/finished/js/core.js'></script>

</body>
</html>";