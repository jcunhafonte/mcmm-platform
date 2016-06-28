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
        <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />
        <meta name='apple-mobile-web-app-capable' content='yes' />

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
        <link href='assets/libs/jqueryui/ui-lightness/jquery-ui-1.10.4.custom.min.css' rel='stylesheet' />
        <link href='assets/libs/bootstrap/css/bootstrap.min.css' rel='stylesheet' />
        <link href='assets/libs/font-awesome/css/font-awesome.min.css' rel='stylesheet' />
        <link href='assets/libs/fontello/css/fontello.css' rel='stylesheet' />
        <link href='assets/libs/animate-css/animate.min.css' rel='stylesheet' />
        <link href='assets/libs/nifty-modal/css/component.css' rel='stylesheet' />
        <link href='assets/libs/magnific-popup/magnific-popup.css' rel='stylesheet' /> 
        <link href='assets/libs/ios7-switch/ios7-switch.css' rel='stylesheet' /> 
        <link href='assets/libs/pace/pace.css' rel='stylesheet' />
        <link href='assets/libs/sortable/sortable-theme-bootstrap.css' rel='stylesheet' />
        <link href='assets/libs/bootstrap-datepicker/css/datepicker.css' rel='stylesheet' />
        <link href='assets/libs/jquery-icheck/skins/all.css' rel='stylesheet' />
        <!-- Code Highlighter for Demo -->
        <link href='assets/libs/prettify/github.css' rel='stylesheet' />
        
                <!-- Extra CSS Libraries Start -->
                <link href='assets/libs/bootstrap-select/bootstrap-select.min.css' rel='stylesheet' type='text/css' />
                <link href='assets/libs/bootstrap-select2/select2.css' rel='stylesheet' type='text/css' />
                <link href='assets/libs/bootstrap-xeditable/css/bootstrap-editable.css' rel='stylesheet' type='text/css' />
                <link href='assets/libs/bootstrap-select2/select2.css' rel='stylesheet' type='text/css' />
                <link href='assets/css/style.css' rel='stylesheet' type='text/css' />
                <!-- Extra CSS Libraries End -->
        <link href='assets/css/style-responsive.css' rel='stylesheet' />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js'></script>
        <script src='https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js'></script>
        <![endif]-->

        <link rel='shortcut icon' href='assets/img/favicon.ico'>
        <link rel='apple-touch-icon' href='assets/img/apple-touch-icon.png' />
        <link rel='apple-touch-icon' sizes='57x57' href='assets/img/apple-touch-icon-57x57.png' />
        <link rel='apple-touch-icon' sizes='72x72' href='assets/img/apple-touch-icon-72x72.png' />
        <link rel='apple-touch-icon' sizes='76x76' href='assets/img/apple-touch-icon-76x76.png' />
        <link rel='apple-touch-icon' sizes='114x114' href='assets/img/apple-touch-icon-114x114.png' />
        <link rel='apple-touch-icon' sizes='120x120' href='assets/img/apple-touch-icon-120x120.png' />
        <link rel='apple-touch-icon' sizes='144x144' href='assets/img/apple-touch-icon-144x144.png' />
        <link rel='apple-touch-icon' sizes='152x152' href='assets/img/apple-touch-icon-152x152.png' />
        <link href='assets/libs/jquery-notifyjs/styles/metro/notify-metro.css' rel='stylesheet' type='text/css'/>
    </head>
    <body class='fixed-left'>
        <!-- Modal Start -->
        	<!-- Modal Task Progress -->	
	<div class='md-modal md-3d-flip-vertical' id='task-progress'>
		<div class='md-content'>
			<h3><strong>Task Progress</strong> Information</h3>
			<div>
				<p>CLEANING BUGS</p>
				<div class='progress progress-xs for-modal'>
				  <div class='progress-bar progress-bar-success' role='progressbar' aria-valuenow='80' aria-valuemin='0' aria-valuemax='100' style='width: 80%'>
					<span class='sr-only'>80&#37; Complete</span>
				  </div>
				</div>
				<p>POSTING SOME STUFF</p>
				<div class='progress progress-xs for-modal'>
				  <div class='progress-bar progress-bar-warning' role='progressbar' aria-valuenow='80' aria-valuemin='0' aria-valuemax='100' style='width: 65%'>
					<span class='sr-only'>65&#37; Complete</span>
				  </div>
				</div>
				<p>BACKUP DATA FROM SERVER</p>
				<div class='progress progress-xs for-modal'>
				  <div class='progress-bar progress-bar-info' role='progressbar' aria-valuenow='80' aria-valuemin='0' aria-valuemax='100' style='width: 95%'>
					<span class='sr-only'>95&#37; Complete</span>
				  </div>
				</div>
				<p>RE-DESIGNING WEB APPLICATION</p>
				<div class='progress progress-xs for-modal'>
				  <div class='progress-bar progress-bar-primary' role='progressbar' aria-valuenow='80' aria-valuemin='0' aria-valuemax='100' style='width: 100%'>
					<span class='sr-only'>100&#37; Complete</span>
				  </div>
				</div>
				<p class='text-center'>
				<button class='btn btn-danger btn-sm md-close'>Close</button>
				</p>
			</div>
		</div>
	</div>
		<!-- Modal fade in scale up -->
<div class='md-modal md-fade-in-scale-up' id='md-fade-in-scale-up'>
    <div class='md-content'>
        <h3>Remover Dia Não Útil</h3>

        <div>
            <p>Tem a certeza que pretende remover o dia não útil <strong><span id='alteravel'></span></strong>?</p>
            <ul>
                <li><strong>Atenção:</strong> Esta ação não pode ser revertida.
                </li>
               <li><strong>Informação:</strong> Após a confirmação da remoção, pode voltar a adicionar dias não úteis ao colaborador.
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
Menus('configuracoes');

echo "<!-- Start right content -->
        <div class='content-page'>
			<!-- ============================================================== -->
			<!-- Start Content here -->
			<!-- ============================================================== -->
            <div class='content'>
								<!-- Page Heading Start -->
				<div class='page-heading'>
            		<h1><i class='fa fa-cors'></i> Configurações</h1>
            		            	</div>
            	<!-- Page Heading End-->	
								
				<!-- Your awesome content goes here -->
				<div class='row'>
					
					<div class='col-sm-12'>


							<div class='widget'>
							<div class='widget-header'>
								<h2><strong>Número</strong> dias de férias</h2>
								<div class='additional-btn'>
									<a href='#' class='hidden reload'><i class='icon-ccw-1'></i></a>
									<a href='#' class='widget-toggle'><i class='icon-down-open-2'></i></a>
								</div>
							</div>
							<div class='widget-content padding'>
								<p>Edite os dias de férias atuais</p>
					            <table id='user' class='table table-bordered table-striped' style='clear: both'>
					                <tbody>";

//SELECT ULTIMO ID
$query = "SELECT numero FROM dias_ferias";

$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_result($stmt, $numeroFerias);
mysqli_stmt_execute($stmt);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

echo "<tr>
					                        <td width='50%'>Dias de férias atuais</td>

					                     <td>
					                     <a href='#' id='diasFerias' data-type='number' data-pk='2'
					                        data-title='Edite o número de dias de férias'>$numeroFerias</a></td>
					                        </tr>

					                </tbody>
					            </table>
							</div>


						</div>


                    <div class='widget'>
							<div class='widget-header'>
								<h2><strong>Número</strong> de colaboradores de férias em simultâneo</h2>
								<div class='additional-btn'>
									<a href='#' class='hidden reload'><i class='icon-ccw-1'></i></a>
									<a href='#' class='widget-toggle'><i class='icon-down-open-2'></i></a>
								</div>
							</div>
							<div class='widget-content padding'>
								<p>Edite os colaboradores de férias em simultâneo</p>
					            <table id='user' class='table table-bordered table-striped' style='clear: both'>
					                <tbody>";

//SELECT ULTIMO ID
$query = "SELECT numero FROM ferias_simultaneo";

$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_result($stmt, $numeroSimultaneo);
mysqli_stmt_execute($stmt);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

echo "<tr>
					                        <td width='50%'>Colaboradores de férias em simultâneo</td>

					                     <td>
					                     <a href='#' id='diasSimultaneo' data-type='number' data-pk='2'
					                        data-title='Edite o número de colaboradores de férias em simultâeno'>$numeroSimultaneo</a></td>
					                        </tr>

					                </tbody>
					            </table>
							</div>


						</div>
						
						<div class='widget'>
							<div class='widget-header'>
								<h2>Dias <strong>Não Úteis</strong></h2>
								<div class='additional-btn'>
									<a href='#' class='hidden reload'><i class='icon-ccw-1'></i></a>
									<a href='#' class='widget-toggle'><i class='icon-down-open-2'></i></a>
								</div>
							</div>
							<div class='widget-content padding'>							
								<p>Adicione Dias Não Úteis</p>
					            <table id='user' class='table table-bordered table-striped' style='clear: both'>
					                <tbody>";

//SELECT ULTIMO ID
$query = "SELECT id_nao_uteis FROM nao_uteis ORDER BY id_nao_uteis DESC LIMIT 1";

$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_result($stmt, $idNaoUtilUltimo);
mysqli_stmt_execute($stmt);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

$textoIdNaoUltimo = ($idNaoUtilUltimo + 1);

echo "<tr>
					                        <td width='50%'><a href='#' id='nomeDiaAtual' data-type='text' data-pk='2'
					                        data-title='Insira o nome do Dia'>Nome do Dia</a></td>

					                        <td>

					                        <a href='#' id='dobAtual' data-type='combodate' ";
$dataAtual = date('d-m-Y');
echo "data-value=$dataAtual";
echo " data-format='DD-MM-YYYY' data-viewformat='DD-MM-YYYY'
					                        data-template='D de MMM de YYYY' data-pk='1'name='ex1'
					                        data-title='Insira uma data'></a>

                       </td>
					                        </tr>

					                </tbody>
					            </table>
							</div>

                        <div class='widget-content padding'>
								<p>Edite ou Apague Dias Não Úteis Adicionados</p>
					            <table id='user' class='table table-bordered table-striped' style='clear: both'>
					                <tbody id='dataAdicionadas'>";

//SELECT DIAS
$query = "SELECT id_nao_uteis, descricao, data_dia FROM nao_uteis ORDER BY data_dia ASC";

$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_result($stmt, $idNaoUtil, $descricao, $dataDia);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) > 0) {
    mysqli_stmt_close($stmt);

//SELECT DIAS
    $query = "SELECT id_nao_uteis, descricao, data_dia FROM nao_uteis ORDER BY data_dia ASC";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_result($stmt, $idNaoUtil, $descricao, $dataDia);
    mysqli_stmt_execute($stmt);

    while (mysqli_stmt_fetch($stmt)) {

        $conversaoDataAcidente = new DateTime($dataDia);
        $textoDataAcidente = $conversaoDataAcidente->format('d-m-Y');

        echo "<tr>
					                        <td width='50%'><a href='#' id='nomeDia$idNaoUtil' data-type='text' data-pk='2'
					                        data-title='Edite o nome do Dia'>$descricao</a></td>

					                        <td>

					                        <a href='#' id='dob$idNaoUtil' data-type='combodate' ";
        echo "data-value=$textoDataAcidente";
        echo " data-format='DD-MM-YYYY' data-viewformat='DD-MM-YYYY'
					                        data-template='D de MMM de YYYY' data-pk='1' name='ex1'
					                        data-title='Edite a data'></a>
					                        </td>

					                              <td class='text-center'>

      <a data-href='php/verificacoes/verificaCancelarDia.php?&dia=$idNaoUtil'
                                                    data-toggle='tooltip' title='Remover Dia'
                                                    class='md-trigger text-center btn btn-default' style='padding: 3px 6px !important;'
                                                      onclick='modalRemover($idNaoUtil);' id='botaoRemover$idNaoUtil'
                                        data-target='#md-fade-in-scale-up'  data-modal='md-fade-in-scale-up'>
                                                    <i class='fa fa-times'></i></a>

					                        </td>

					                        </tr>

					                        ";
    }
    mysqli_stmt_close($stmt);

} else {
    mysqli_stmt_close($stmt);

    echo "<tr>
					                        <td>Não existem dias não úteis adicionados.</td>

					                        </tr>

					                        ";
}

echo "</tbody>
					            </table>
							</div>
						</div>

						<div class='widget' style='display: none'>
							<div class='widget-header'>
								<h2><strong>IOS 7</strong> Switches</h2>
								<div class='additional-btn'>
									<a href='#' class='hidden reload'><i class='icon-ccw-1'></i></a>
									<a href='#' class='widget-toggle'><i class='icon-down-open-2'></i></a>
									<a href='#' class='widget-close'><i class='icon-cancel-3'></i></a>
								</div>
							</div>
							<div class='widget-content padding'>
								<h4>Large Size</h4>
								<input type='checkbox' class='ios-switch ios-switch-default ios-switch-lg' checked />
								<input type='checkbox' class='ios-switch ios-switch-primary ios-switch-lg' checked />
								<input type='checkbox' class='ios-switch ios-switch-success ios-switch-lg' checked />
								<input type='checkbox' class='ios-switch ios-switch-danger ios-switch-lg' checked />
								<input type='checkbox' class='ios-switch ios-switch-warning ios-switch-lg' checked />
								<input type='checkbox' class='ios-switch ios-switch-info ios-switch-lg' checked />

								<h4>Default Size</h4>
								<input type='checkbox' class='ios-switch ios-switch-default' checked />
								<input type='checkbox' class='ios-switch ios-switch-primary' checked />
								<input type='checkbox' class='ios-switch ios-switch-success' checked />
								<input type='checkbox' class='ios-switch ios-switch-danger' checked />
								<input type='checkbox' class='ios-switch ios-switch-warning' checked />
								<input type='checkbox' class='ios-switch ios-switch-info' checked />

								<h4>Small Size</h4>
								<input type='checkbox' class='ios-switch ios-switch-default ios-switch-sm' checked />
								<input type='checkbox' class='ios-switch ios-switch-primary ios-switch-sm' checked />
								<input type='checkbox' class='ios-switch ios-switch-success ios-switch-sm' checked />
								<input type='checkbox' class='ios-switch ios-switch-danger ios-switch-sm' checked />
								<input type='checkbox' class='ios-switch ios-switch-warning ios-switch-sm' checked />
								<input type='checkbox' class='ios-switch ios-switch-info ios-switch-sm' checked />
							</div>
						</div>

					</div>
				</div>
				<!-- End of your awesome content -->
			
			<!-- Footer Start -->
            <footer>
                Bento & Nascimento &copy; 2015
                <div class='footer-links pull-right'>
                    <a>Plataforma de Gestão dos Recursos Humanos</a>
                </div>
            </footer>
            <!-- Footer End -->";

echo "</div>
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
	<script src='assets/js/pages/advanced-forms.js'></script>";?>

<script>

    //Nome Dia
    $(function () {
        $('#nomeDiaAtual').editable();
    });

    $('#nomeDiaAtual').on('save', function (e, params) {
        setTimeout(function () {

            nomeEnviado = true;
            testaEnvio();

        }, 100);

    });

    //Nome Dia
    $(function () {
        $('#diasFerias').editable();
    });

    $('#diasFerias').on('save', function (e, params) {
        setTimeout(function () {

            editarDiasFerias();

        }, 100);

    });

    //Nome Dia
    $(function () {
        $('#diasSimultaneo').editable();
    });

    $('#diasSimultaneo').on('save', function (e, params) {
        setTimeout(function () {

            editarSimultaneo();

        }, 100);

    });

    //DOB ATUAL

    $(function () {
        $('#dobAtual').editable({
            combodate: {
                minYear: 2015,
                maxYear: 2030,
                minuteStep: 1
            }
        })
    });

    $('#dobAtual').on('save', function (e, params) {
        setTimeout(function () {

            dataEnviado = true;
            testaEnvio();

        }, 100);

    });
    <?php
        //ANTIGOS DOB
        $query = "SELECT id_nao_uteis, descricao, data_dia FROM nao_uteis ORDER BY data_dia ASC";

        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_result($stmt, $idNaoUtil, $descricao, $dataDia);
        mysqli_stmt_execute($stmt);

        while(mysqli_stmt_fetch($stmt)) {

          echo "
          $(function () {
            $('#dob$idNaoUtil').editable({
                combodate: {
                    minYear: 2015,
                    maxYear: 2030,
                    minuteStep: 1
                }
            })
        });

        $('#dob$idNaoUtil').on('save', function (e, params) {
            setTimeout(function () {

                testaEnvio2($idNaoUtil);

            }, 100);

        });

          //Nome Dia
        $(function () {
            $('#nomeDia$idNaoUtil').editable();
        });

        $('#nomeDia$idNaoUtil').on('save', function (e, params) {
            setTimeout(function () {

                testaEnvio2($idNaoUtil);

            }, 100);

        });

        ";

        }
     mysqli_stmt_close($stmt);
    ?>

    var nomeEnviado = false;
    var dataEnviado = false;

    function testaEnvio() {

        if (nomeEnviado == true) {

            if (dataEnviado == true) {

                $.ajax({
                    type: 'POST',
                    url: 'php/funcoes/adicionarDiasFeriados.php',
                    data: 'choice1=' + $('#dobAtual').html() + '&choice2=' + $('#nomeDiaAtual').html(),
                    success: function () {

                        nomeEnviado = false;
                        dataEnviado = false;

                        window.location.replace("http://bentoenascimento.com/recursosHumanos/administracao/configuracoes.php?sucesso");

                    }
                });
            }
        }
    }

    function editarDiasFerias() {

        $.ajax({
            type: 'POST',
            url: 'php/funcoes/editarDiasFerias.php',
            data: 'choice1=' + $('#diasFerias').html(),
            success: function () {

                notify30('success');

            }
        });
    }

    function editarSimultaneo() {

        $.ajax({
            type: 'POST',
            url: 'php/funcoes/editarDiasSimultaneo.php',
            data: 'choice1=' + $('#diasSimultaneo').html(),
            success: function () {

                notify40('success');

            }
        });
    }

    function testaEnvio2(param) {

        $.ajax({
            type: 'POST',
            url: 'php/funcoes/adicionarDiasFeriados2.php',
            data: 'choice1=' + $('#dob' + param).html() + '&choice2=' + $('#nomeDia' + param).html() + '&choice3=' + param,
            success: function () {

                notify21('success');

            }
        });

    }

</script>
<!-- Page Specific JS Libraries -->
<script src='assets/libs/jquery-notifyjs/notify.min.js'></script>
<script src='assets/libs/jquery-notifyjs/styles/metro/notify-metro.js'></script>
<script src='assets/js/pages/notifications.js'></script>
<script>
    function notify21(style, position) {
        if (style == "error") {
            icon = "fa fa-exclamation";
        } else if (style == "warning") {
            icon = "fa fa-warning";
        } else if (style == "success") {
            icon = "fa fa-check";
        } else if (style == "info") {
            icon = "fa fa-question";
        } else {
            icon = "fa fa-circle-o";
        }
        $.notify({
            title: 'Parabéns! Dia não útil editado.',
            text: 'Dia editado com sucesso.',
            image: "<i class='fa fa-check'></i>"
        }, {
            style: 'metro',
            className: style,
            globalPosition: position,
            showAnimation: "show",
            showDuration: 0,
            hideDuration: 0,
            autoHideDelay: 10000,
            autoHide: true,
            clickToHide: true
        });
    }

    function notify30(style, position) {
        if (style == "error") {
            icon = "fa fa-exclamation";
        } else if (style == "warning") {
            icon = "fa fa-warning";
        } else if (style == "success") {
            icon = "fa fa-check";
        } else if (style == "info") {
            icon = "fa fa-question";
        } else {
            icon = "fa fa-circle-o";
        }
        $.notify({
            title: 'Parabéns! Dias de férias editados.',
            text: 'Os dias de férias dos colaboradores foram editados com sucesso.',
            image: "<i class='fa fa-check'></i>"
        }, {
            style: 'metro',
            className: style,
            globalPosition: position,
            showAnimation: "show",
            showDuration: 0,
            hideDuration: 0,
            autoHideDelay: 10000,
            autoHide: true,
            clickToHide: true
        });
    }

    function notify40(style, position) {
        if (style == "error") {
            icon = "fa fa-exclamation";
        } else if (style == "warning") {
            icon = "fa fa-warning";
        } else if (style == "success") {
            icon = "fa fa-check";
        } else if (style == "info") {
            icon = "fa fa-question";
        } else {
            icon = "fa fa-circle-o";
        }
        $.notify({
            title: 'Parabéns! Féras em simultâneo editados.',
            text: 'O número de colaboradores de férias em simultâneo foram editados com sucesso.',
            image: "<i class='fa fa-check'></i>"
        }, {
            style: 'metro',
            className: style,
            globalPosition: position,
            showAnimation: "show",
            showDuration: 0,
            hideDuration: 0,
            autoHideDelay: 10000,
            autoHide: true,
            clickToHide: true
        });
    }

    function notify20(style, position) {
        if (style == "error") {
            icon = "fa fa-exclamation";
        } else if (style == "warning") {
            icon = "fa fa-warning";
        } else if (style == "success") {
            icon = "fa fa-check";
        } else if (style == "info") {
            icon = "fa fa-question";
        } else {
            icon = "fa fa-circle-o";
        }
        $.notify({
            title: 'Parabéns! Dia não útil adicionado.',
            text: 'O dia ' + $('#dobAtual').html() + ' foi adicionado com sucesso.',
            image: "<i class='fa fa-check'></i>"
        }, {
            style: 'metro',
            className: style,
            globalPosition: position,
            showAnimation: "show",
            showDuration: 0,
            hideDuration: 0,
            autoHideDelay: 10000,
            autoHide: true,
            clickToHide: true
        });
    }

    function notify22(style, position) {
        if (style == "error") {
            icon = "fa fa-exclamation";
        } else if (style == "warning") {
            icon = "fa fa-warning";
        } else if (style == "success") {
            icon = "fa fa-check";
        } else if (style == "info") {
            icon = "fa fa-question";
        } else {
            icon = "fa fa-circle-o";
        }
        $.notify({
            title: 'Parabéns! Dia não útil removido.',
            text: 'Dia removido com sucesso.',
            image: "<i class='fa fa-check'></i>"
        }, {
            style: 'metro',
            className: style,
            globalPosition: position,
            showAnimation: "show",
            showDuration: 0,
            hideDuration: 0,
            autoHideDelay: 10000,
            autoHide: true,
            clickToHide: true
        });
    }

    function notify23(style, position) {
        if (style == "error") {
            icon = "fa fa-exclamation";
        } else if (style == "warning") {
            icon = "fa fa-warning";
        } else if (style == "success") {
            icon = "fa fa-check";
        } else if (style == "info") {
            icon = "fa fa-question";
        } else {
            icon = "fa fa-circle-o";
        }
        $.notify({
            title: 'Atenção! Dia não útil não removido.',
            text: 'Ocorreu um erro ao remover o dia não útil.',
            image: "<i class='fa fa-check'></i>"
        }, {
            style: 'metro',
            className: style,
            globalPosition: position,
            showAnimation: "show",
            showDuration: 0,
            hideDuration: 0,
            autoHideDelay: 10000,
            autoHide: true,
            clickToHide: true
        });
    }
</script>

<?php

if (isset($_GET['sucesso'])) {
    ?>
    <script>
        notify20('success');
    </script>
<?php
}

?>

<?php

if (isset($_GET['diaRemovido'])) {
    ?>
    <script>
        notify22('success');
    </script>
<?php
}

?>

<?php

if (isset($_GET['diaRemovidoErro'])) {
    ?>
    <script>
        notify23('error');
    </script>
<?php
}

?>

<script>
    function modalRemover(param) {

        $('#md-fade-in-scale-up').find('.btn-remover').attr('href', $("#botaoRemover" + param).data('href'));

        var titulo = '';
        titulo = document.getElementById('nomeDia' + param).innerHTML;
        document.getElementById('alteravel').innerHTML = titulo;

    }
    ;
</script>
</body>
</html>