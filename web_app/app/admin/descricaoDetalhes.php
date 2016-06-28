<?php

session_start();

if ((!isset($_SESSION['ativoAdmin']))) {

    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    header("location:entrar.php?url=$actual_link");

} else {

    if ((!isset($_GET['colaborador']) AND (!isset($_GET['descricao'])))) {
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
        <h3>Remover Descrição de Função</h3>

        <div>
            <p>Tem a certeza que pretende remover a descrição da função <strong><span id='alteravel'></span></strong>?</p>
            <ul>
                <li><strong>Atenção:</strong> Esta ação não pode ser revertida.
                </li>
                <li><strong>Informação:</strong> Após a confirmação da remoção, pode a voltar adicionar descrições.
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

    <div id='wrapper'>";

require_once('php/includes/menus.php');
Menus('descricao');
		
echo "<!-- Start right content -->
        <div class='content-page'>
			<!-- ============================================================== -->
			<!-- Start Content here -->
			<!-- ============================================================== -->
            <div class='content'>
            					<!-- Page Heading Start -->
				<div class='page-heading'>
            		<h1 style='float: left'><i class='fa fa-info-circle'></i> Descrição de Funções</h1>";

$query = "SELECT id_descricao, titulo, objetivo, enquadramento, conteudo, competencias_comportamentais,
competencias_tecnicas, requisitos_minimos, substitutos, condicoes, contrapartidas FROM descricao
WHERE id_descricao = ? ORDER BY titulo ASC";

$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_param($stmt, 's', $_GET['descricao']);
mysqli_stmt_bind_result($stmt, $idDescricao, $tituloDescricao, $objetivoDescricao, $enquadramentoDescricao,
    $conteudoDescricao, $competenciasComportamentaisDescricao, $competenciasTecnicasDescricao, $resquisitosDescricao,
    $substitutosDescricao, $condicoesDescricao, $contrapartidasDescricao);
mysqli_stmt_execute($stmt);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

echo "<div class='text-right' style='height: 43px !important; padding-top: 7px !important;'>
								<div class='row text-right'>
									<div class='col-lg-4 text-right' style='float: right!important;'>

										   <a href='editarDescricao.php?descricao=$idDescricao'>
                                        <button type='button' class='text-right btn btn-primary btn-sm'>
										<i class='fa fa-pencil-square-o'></i> Editar Descrição</button></a>

										  <a
                                        data-href='php/verificacoes/verificaCancelarDescricao.php?descricao=$idDescricao&nome=$tituloDescricao'
                                        onclick='modalRemover($idDescricao);'
                                                    id='botaoRemover$idDescricao'
                                                      data-modal='md-fade-in-scale-up'
                                                      class='md-trigger'
                                        data-target='#md-fade-in-scale-up'>
                                        <button type='button' class='text-right btn btn-danger btn-sm'>
										<i class='fa fa-remove'></i> Remover Descrição</button></a>

										</div>
								</div>
							</div>
							<!-- End div .user-button -->
                </div>";

   echo "<div class='row'>
					<div class='col-sm-12'>
						<div class='widget'>
							<div class='widget-header'>
								<h2 id='titulo$idDescricao'>$tituloDescricao</h2>
								<div class='additional-btn'>
									<a href='#' class='hidden reload'><i class='icon-ccw-1'></i></a>
									<a href='#' class='widget-toggle'><i class='icon-down-open-2'></i></a>

								</div>
							</div>
							<div class='widget-content padding'>
								<h3>Descrição</h3>
								<ul id='demo1' class='nav nav-tabs'>
									<li class='active'>
										<a href='#demo1-home' data-toggle='tab'>Objetivo</a>
									</li>
									<li class=''>
										<a href='#demo1-profile' data-toggle='tab'>Enquadramento Orgânico</a>
									</li>
								</ul>

								<div class='tab-content'>
									<div class='tab-pane fade active in' id='demo1-home'>
										<p>$objetivoDescricao</p>
									</div> <!-- / .tab-pane -->
									<div class='tab-pane fade' id='demo1-profile'>
										<p>$enquadramentoDescricao</p>
                                    </div> <!-- / .tab-pane -->
								</div> <!-- / .tab-content -->

								<hr>

                                <h3>Conteúdo</h3>
								<div class='panel-group accordion-toggle' id='accordiondemo9'>
								  <div class='panel'>
								    <div id='accordion10' class='panel-collapse collapse in'>
								      <div class='panel-body'>
								        $conteudoDescricao
								         </div>
								    </div>
								  </div>
								</div>

								<hr>

	                            <h3>Competências</h3>
								<div class='panel-group accordion-toggle' id='accordiondemo3'>
								  <div class='panel panel-lightblue-2' style='border: none !important;'>
								    <div class='panel-heading'>
								      <h4 class='panel-title'>
								        <a data-toggle='collapse' data-parent='#accordiondemo3'
								        href='#accordion7'>Competências Técnicas
								        </a>
								      </h4>
								    </div>
								    <div id='accordion7' class='panel-collapse collapse in'>
								      <div class='panel-body'>
								    $competenciasTecnicasDescricao
                                       </div>
								    </div>
								  </div>
								  <div class='panel panel-lightblue-2' style='border: none !important;'>
								    <div class='panel-heading'>
								      <h4 class='panel-title'>
								        <a data-toggle='collapse' data-parent='#accordiondemo3'
								         href='#accordion8'>Competências Comportamentais
								        </a>
								      </h4>
								    </div>
								    <div id='accordion8' class='panel-collapse collapse'>
								      <div class='panel-body'>
								      $competenciasComportamentaisDescricao
                                        </div>
								    </div>
								  </div>

								</div>
<hr>

<h3>Outros</h3>
								<ul id='demo1' class='nav nav-tabs'>
									<li class='active'>
										<a href='#demo6-home' data-toggle='tab'>Requisitos Mínimos</a>
									</li>
									<li class=''>
										<a href='#demo7-profile' data-toggle='tab'>Substituto</a>
									</li>
                                    <li class=''>
										<a href='#demo8-profile' data-toggle='tab'>Condições Físicas e Materiais</a>
									</li>
									<li class=''>
										<a href='#demo9-profile' data-toggle='tab'>Contrapartidas Remuneratórias</a>
									</li>
								</ul>

								<div class='tab-content'>
									<div class='tab-pane fade active in' id='demo6-home'>
										<p>$resquisitosDescricao</p>
									</div> <!-- / .tab-pane -->
									<div class='tab-pane fade' id='demo7-profile'>
										<p>$substitutosDescricao</p>
                                    </div> <!-- / .tab-pane -->
                                    <div class='tab-pane fade' id='demo8-profile'>
										<p>$condicoesDescricao</p>
                                    </div> <!-- / .tab-pane -->
                                       <div class='tab-pane fade' id='demo9-profile'>
										<p>$contrapartidasDescricao</p>
                                    </div> <!-- / .tab-pane -->
								</div> <!-- / .tab-content -->

							</div>
						</div>
					</div>
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
	<script src='assets/js/pages/tabs-accordions.js'></script>
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