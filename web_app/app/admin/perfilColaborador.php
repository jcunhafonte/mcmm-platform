<?php

session_start();

if (!isset($_SESSION['ativoAdmin'])) {

    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    header("location:entrar.php?url=$actual_link");

} else {

    if (isset($_GET['colaborador'])) {

        $colaborador = $_GET['colaborador'];

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
                <link href='assets/css/style.css' rel='stylesheet' type='text/css' />
                <!-- Extra CSS Libraries End -->
        <link href='assets/css/style-responsive.css' rel='stylesheet' />

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
        Menus('colaboradores', '');

        echo "<!-- Start right content -->
        <div class='content-page'>
			<!-- ============================================================== -->
			<!-- Start Content here -->
			<!-- ============================================================== -->
			<div class='profile-banner'";

        $query = "SELECT id_colaborador, processo_recrutamento, processo_admissao, processo_saida,
tipo_admissao, nome_completo, morada, localidade, codigo_postal, telefone,
telemovel, email, nascimento, naturalidade, nacionalidade, cartao_cidadao,
emissao_cartao_cidadao, entidade_emissora, contribuinte_passaporte, seg_social, carta_conducao,
validade_conducao, categoria_conducao, situacao_militar, estado_civil, deficiencia_colaborador,
conjuge_colaborador, contribuinte_conjuge, titulares_rendimento, familiares_cargo, numeros_filhos,
idades_filhos, deficiencia_filhos, reg_seg_social, percentagem_funcionario, percentagem_patronal,
funcao, categoria, situacao_contratual, posto_trabalho, periodo_experimental, data_final_per_experimental,
horas_semanais, horas_diarias, descanso_complementar, sistema_rotativo, NIB, instituicao_bancaria,
agencia, vencimento_base, data_admissao, ativo, escolaridade, validade_cc_passaporte, data_final_contrato
 FROM colaborador WHERE id_colaborador = ?";

        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, 'i', $colaborador);
        mysqli_stmt_bind_result($stmt, $idColaborador, $procRecrutamento, $procAdmissao, $procSaida,
            $tipoAdmissaoColaborador,  $nomeColaborador, $moradaColaborador,
            $localidadeColaborador,  $codigoPostalColaborador, $telefoneColaborador, $telemovelColaborador,
            $emailColaborador, $novaDataNascimentoColaborador, $naturalidadeColaborador,
            $nacionalidadeColaborador, $CCPassaporteColaborador, $novaDataEmissaoCCColaborador,
            $entidaEmissoraCCColaborador, $contribuinteColaborador, $segSocialColaborador,
            $cartaConducaoColaborador, $novaDataValidadeCConducaoColaborador,
            $categoriasCConducaoColaborador, $situacaoMilitarColaborador,
            $estadoCivilColaborador, $deficienciaColaborador, $conjugeColaborador,
            $contribuinteConjugeColaborador, $titularesRendimento,
            $familiaresCargoColaborador, $filhosColaborador, $idadesFilhosColaborador,
            $deficienciaFilhosColaborador, $regimeSegSocialColaborador,
            $percentagemFuncionarioColaborador, $percentagemEntPatronalColaborador,
            $funcaoColaborador, $categoriaColaborador, $situacaoContratualColaborador,
            $postoTrabalhoColaborador, $periodoExperimentalColaborador,
            $novaDataFinalPeriodoExperimentalColaborador, $horasSemanaisColaborador,
            $horasDiariasColaborador, $descansoComplementarColaborador,
            $sistemaRotativoColaborador, $NIBColaborador, $isntBancariaColaborador,
            $agenciaColaborador, $vencBaseColaborador, $novaDataAdmissao, $ativo, $escolaridade,
            $novaDataValidadeCCPassaporte, $novaDataFinalContrato);

        mysqli_stmt_execute($stmt);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        $fotografia = rand(1, 7);

        echo "style='background-image: url(../../fotos/$fotografia.jpg);'";
        echo " >

				<div class='col-sm-3 avatar-container'>
					<img src='images/users/user-256.jpg' class='img-circle profile-avatar' alt='User avatar'>
				</div>
				<div class='col-sm-12 profile-actions text-right'>


				<!-- User button -->
							<div class='user-button text-right'>
								<div class='row text-right'>
									<div class='col-lg-3 text-right' style='float: right!important;'>";

        if ($ativo == 1) {
            echo "<a   onclick='modalRemover($idColaborador);' id='botaoRemover$idColaborador'  data-target='#md-fade-in-scale-up'
  data-modal='md-fade-in-scale-up' data-href='adicionarDesvinculacao.php?perfil&colaborador=$colaborador'
  class='md-trigger'>
                                        <button type='button' class='text-right btn btn-default btn-sm btn-block'>
										<i class='fa fa-user-times'></i> Cancelar Contrato</button></a>
										<!-- Modal fade in scale up -->
<div class='md-modal md-fade-in-scale-up' id='md-fade-in-scale-up'>
    <div class='md-content'>
        <h3>Cancelar Contrato</h3>

        <div style='text-align: left !important;'>
            <p>Tem a certeza que pretende cancelar o contrato do colaborador <strong><span id='alteravel'>$nomeColaborador</span></strong>?</p>
            <ul>
                <li><strong>Atenção:</strong> Esta ação pode ser revertida.
                </li>
                <li><strong>Informação:</strong> Após a confirmação do cancelamento, pode voltar a reativar o contrato do colaborador.
                </li>
                <li><strong>Fechar:</strong> Clique no botão indicativo para fechar este aviso e cancelar a ação.</li>
            </ul>
            <p>
                <button class='btn btn-danger md-close' onclick='funcaoTeste();'>Fechar</button>
                <a class='btn-remover' href=''><button class='btn btn-success md-close'>Cancelar</button></a>
            </p>
        </div>
    </div>
    <!-- End div .md-content -->
</div>
<!-- End div .md-modal .md-fade-in-scale-up -->
										";
        } else {
            echo "<a data-href='php/verificacoes/verificaReativarContrato.php?perfil=1&colaborador=$colaborador'
class='md-trigger'   onclick='modalRemover($idColaborador);' id='botaoRemover$idColaborador' data-target='#md-fade-in-scale-up'
  data-modal='md-fade-in-scale-up'>
                                        <button type='button' class='text-right btn btn-default btn-sm btn-block'>
										<i class='fa fa-user-plus'></i> Reativar Contrato</button></a>
										<!-- Modal fade in scale up -->
<div class='md-modal md-fade-in-scale-up' id='md-fade-in-scale-up'>
    <div class='md-content'>
        <h3>Reativar Contrato</h3>

        <div style='text-align: left !important;'>
            <p>Tem a certeza que pretende reativar o contrato do colaborador <strong><span id='alteravel'></span></strong>?</p>
            <ul>
                <li><strong>Atenção:</strong> Esta ação pode ser revertida.
                </li>
                <li><strong>Informação:</strong> Após a confirmação da reativação, pode voltar a cancelar o contrato do colaborador.
                </li>
                <li><strong>Fechar:</strong> Clique no botão indicativo para fechar este aviso e cancelar a ação.</li>
            </ul>
            <p>
                <button class='btn btn-danger md-close' onclick='funcaoTeste();'>Fechar</button>
                <a class='btn-remover' href=''><button class='btn btn-success md-close'>Reativar</button></a>
            </p>
        </div>
    </div>
    <!-- End div .md-content -->
</div>
<!-- End div .md-modal .md-fade-in-scale-up -->
										";
        }

        echo "</div>
								</div>
							</div><!-- End div .user-button -->


				";
        if ($ativo == 1) {
            echo "<button type='button' class='botaoSobre btn btn-success btn-sm'>
					<i class='fa fa-check'></i> Atual Colaborador</button>";
        } else {
            echo "<button type='button' class='botaoSobre btn btn-danger btn-sm'>
					<i class='fa fa-remove'></i> Antigo Colaborador</button>";
        }
        echo "<a href='editarPerfil.php?colaborador=$colaborador'>
					<button type='button' class='btn btn-primary btn-sm'>
					<i class='fa fa-pencil-square-o'></i> Editar Perfil</button></a>
				</div>
			</div>
            <div class='content'>

				<div class='row'>
					<div class='col-sm-3'>
						<!-- Begin user profile -->
						<div class='text-center user-profile-2'>
							<h4><b>$nomeColaborador</b></h4>

							<h5>";
        if (!empty($funcaoColaborador)) {
            echo $funcaoColaborador;
        }
        echo "</h5>
							<ul class='list-group'>";
        if(!empty($procRecrutamento)){
            echo "<li class='list-group-item'>
								<span class='badge'>$procRecrutamento</span>
								Processo de Recrutamento
							  </li>";
        }
        if(!empty($procAdmissao)){
            echo "<li class='list-group-item'>
								<span class='badge'>$procAdmissao</span>
								Processo de Admissão
							  </li>";
        }
        if((!empty($procSaida)) AND ($procSaida != 38)){
            echo "<li class='list-group-item'>
								<span class='badge'>$procSaida</span>
								Processo de Saída
							  </li>";
        }
							echo "</ul>
						</div><!-- End div .box-info -->
						<!-- Begin user profile -->
					</div><!-- End div .col-sm-4 -->
					
					<div class='col-sm-9'>
						<div class='widget widget-tabbed'>
							<!-- Nav tab -->
							<ul class='nav nav-tabs nav-justified'>
							  <li class='active'><a href='#about' data-toggle='tab'><i class='fa fa-user'></i> Identificação</a></li>
							  <li><a href='#user-activities' data-toggle='tab'><i class='fa fa-file-archive-o'></i> IRS e Segurança Social</a></li>
							  <li><a href='#mymessage' data-toggle='tab'><i class='fa fa-sitemap'></i> Status</a></li>
							</ul>
							<!-- End nav tab -->

							<!-- Tab panes -->
							<div class='tab-content'>

								<!-- Tab about -->
								<div class='tab-pane animated fadeInRight active' id='about'>
									<div class='user-profile-content'>
										<div class='row'>
											<div class='col-sm-4'>";

        if (!empty($moradaColaborador)) {
            echo "<address>
                                                <strong>Morada</strong><br>
                                                <p>$moradaColaborador</p>
                                                </address>";
        }

        if (!empty($localidadeColaborador)) {
            echo "<address>
                                                <strong>Localidade</strong><br>
                                                <p>$localidadeColaborador</p>
                                                </address>";
        }

        if (!empty($codigoPostalColaborador)) {
            echo "<address>
                                                <strong>Código Postal</strong><br>
                                                <p>$codigoPostalColaborador</p>
                                                </address>";
        }

        if (!empty($telefoneColaborador)) {

            $telefoneColaborador = chunk_split($telefoneColaborador, 3, ' ');

            echo "<address>
                                                <strong>Telefone</strong><br>
                                                <p>$telefoneColaborador</p>
                                                </address>";
        }

        if (!empty($telemovelColaborador)) {

            $telemovelColaborador = chunk_split($telemovelColaborador, 3, ' ');

            echo "<address>
                                                <strong>Telemóvel</strong><br>
                                                <p>$telemovelColaborador</p>
                                                </address>";
        }

        if (!empty($emailColaborador)) {
            echo "<address>
                                                <strong>Email</strong><br>
                                                <p>$emailColaborador</p>
                                                </address>";
        }

        if (!empty($novaDataNascimentoColaborador)) {
            if ($novaDataNascimentoColaborador != "0000-00-00 00:00:00") {
                $conversaoDataNascimento = new DateTime($novaDataNascimentoColaborador);
                $textoDataNascimento = $conversaoDataNascimento->format('d-m-Y');

                echo "<address>
                                                <strong>Data de Nascimento</strong><br>
                                                <p>$textoDataNascimento</p>
                                                </address>";
            }
        }
        echo "</div>

        									<div class='col-sm-4'>";

        if (!empty($naturalidadeColaborador)) {
            echo "<address>
                                                <strong>Naturalidade</strong><br>
                                                <p>$naturalidadeColaborador</p>
                                                </address>";
        }

        if (!empty($nacionalidadeColaborador)) {
            echo "<address>
                                                <strong>Nacionalidade</strong><br>
                                                <p>$nacionalidadeColaborador</p>
                                                </address>";
        }

        if (!empty($CCPassaporteColaborador)) {

            $CCPassaporteColaborador = chunk_split($CCPassaporteColaborador, 4, ' ');

            echo "<address>
                                                <strong>Número de Cartão Cidadão ou Passaporte</strong><br>
                                                <p>$CCPassaporteColaborador</p>
                                                </address>";
        }

        if (!empty($novaDataEmissaoCCColaborador)) {
            if ($novaDataEmissaoCCColaborador != "0000-00-00 00:00:00") {
                $conversaoDataEmissaoCCColaborador = new DateTime($novaDataEmissaoCCColaborador);
                $textoDataEmissaoCCColaborador = $conversaoDataEmissaoCCColaborador->format('d-m-Y');

                echo "<address>
                                                <strong>Data de Emissão do Cartão de Cidadão ou Passaporte</strong><br>
                                                <p>$textoDataEmissaoCCColaborador</p>
                                                </address>";
            }
        }
        if (!empty($entidaEmissoraCCColaborador)) {
            echo "<address>
                                                <strong>Entidade Emissora do Cartão de Cidadão ou Passaporte</strong><br>
                                                <p>$entidaEmissoraCCColaborador</p>
                                                </address>";
        }

        if (!empty($novaDataValidadeCCPassaporte)) {
            if ($novaDataValidadeCCPassaporte != "0000-00-00 00:00:00") {
                $conversaoDataValidadeCCPassaporte = new DateTime($novaDataValidadeCCPassaporte);
                $textoDataValidadeCCPassaporte = $conversaoDataValidadeCCPassaporte->format('d-m-Y');

                echo "<address>
                                                <strong>Data de Validade do Cartão de Cidadão ou Passaporte</strong><br>
                                                <p>$textoDataValidadeCCPassaporte</p>
                                                </address>";
            }
        }

        if (!empty($contribuinteColaborador)) {

            $contribuinteColaborador = chunk_split($contribuinteColaborador, 3, ' ');

            echo "<address>
                                                <strong>Número de Contribuinte</strong><br>
                                                <p>$contribuinteColaborador</p>
                                                </address>";
        }
        echo "</div>


							<div class='col-sm-4'>";

        if (!empty($segSocialColaborador)) {

            $segSocialColaborador = chunk_split($segSocialColaborador, 4, ' ');

            echo "<address>
                                                <strong>Número de Segurança Social</strong><br>
                                                <p>$segSocialColaborador</p>
                                                </address>";
        }

        if (!empty($cartaConducaoColaborador)) {
            echo "<address>
                                                <strong>Número de Carta de Condução</strong><br>
                                                <p>$cartaConducaoColaborador</p>
                                                </address>";
        }

        if (!empty($novaDataValidadeCConducaoColaborador)) {
            if ($novaDataValidadeCConducaoColaborador != "1970-01-01 00:00:00") {
                $conversaoDataValidadeCConducaoColaborador = new DateTime($novaDataValidadeCConducaoColaborador);
                $textoDataValidadeCConducaoColaborador = $conversaoDataValidadeCConducaoColaborador->format('d-m-Y');

                echo "<address>
                                                <strong>Data de Validade da Carta de Condução</strong><br>
                                                <p>$textoDataValidadeCConducaoColaborador</p>
                                                </address>";
            }
        }

        if (!empty($categoriasCConducaoColaborador)) {

            echo "<address>
                                                <strong>Categorias da Carta de Condução</strong><br>
                                                <p>$categoriasCConducaoColaborador</p>
                                                </address>";
        }

        if (!empty($escolaridade)) {

            echo "<address>
                                                <strong>Escolaridade</strong><br>
                                                <p>$escolaridade</p>
                                                </address>";
        }

        if (!empty($situacaoMilitarColaborador)) {
            echo "<address>
                                                <strong>Situação Militar</strong><br>
                                                <p>$situacaoMilitarColaborador</p>
                                                </address>";
        }

        if (!empty($tipoAdmissaoColaborador)) {

            echo "<address>
                                                <strong>Tipo de Admissão</strong><br>
                                                <p>$tipoAdmissaoColaborador</p>
                                                </address>";
        }
        echo "</div>
										</div><!-- End div .row -->
									</div><!-- End div .user-profile-content -->
								</div><!-- End div .tab-pane -->
								<!-- End Tab about -->
								
								
													<!-- Tab about -->
								<div class='tab-pane animated fadeInRight' id='user-activities'>
									<div class='user-profile-content'>
										<div class='row'>
											<div class='col-sm-6'>";

        if (!empty($estadoCivilColaborador)) {
            echo "<address>
                                                <strong>Estado Civil</strong><br>
                                                <p>$estadoCivilColaborador</p>
                                                </address>";
        }

        if (!empty($deficienciaColaborador)) {
            echo "<address>
                                                <strong>Titular com Deficiência</strong><br>
                                                <p>$deficienciaColaborador</p>
                                                </address>";
        }

        if (!empty($conjugeColaborador)) {
            echo "<address>
                                                <strong>Nome do Cônjuge ou Pessoa Análoga</strong><br>
                                                <p>$conjugeColaborador</p>
                                                </address>";
        }

        if (!empty($contribuinteConjugeColaborador)) {

            $contribuinteConjugeColaborador = chunk_split($contribuinteConjugeColaborador, 3, ' ');

            echo "<address>
                                                <strong>Número de Contribuinte do Cônjuge ou Pessoa Análoga</strong><br>
                                                <p>$contribuinteConjugeColaborador</p>
                                                </address>";
        }

        if (!empty($titularesRendimento)) {

            echo "<address>
                                                <strong>Número de Titulares de Rendimento</strong><br>
                                                <p>$titularesRendimento</p>
                                                </address>";
        }

        if (!empty($familiaresCargoColaborador)) {

            echo "<address>
                                                <strong>Número de Familiares a seu Cargo</strong><br>
                                                <p>$familiaresCargoColaborador Familiares</p>
                                                </address>";
        }

        echo "</div>

        									<div class='col-sm-6'>";

        if (!empty($filhosColaborador)) {
            echo "<address>
                                                <strong>Número de Filhos</strong><br>
                                                <p>$filhosColaborador Filhos</p>
                                                </address>";
        }

        if (!empty($idadesFilhosColaborador)) {
            echo "<address>
                                                <strong>Idades dos Filhos</strong><br>
                                                <p>$idadesFilhosColaborador Anos</p>
                                                </address>";
        }

        if (!empty($deficienciaFilhosColaborador)) {

            echo "<address>
                                                <strong>Filhos com Deficiência</strong><br>
                                                <p>$deficienciaFilhosColaborador</p>
                                                </address>";
        }

        if (!empty($regimeSegSocialColaborador)) {

            echo "<address>
                                                <strong>Regime de Segurança Social</strong><br>
                                                <p>$regimeSegSocialColaborador</p>
                                                </address>";
        }

        if (!empty($percentagemFuncionarioColaborador)) {
            echo "<address>
                                                <strong>Percentagem Funcionário</strong><br>
                                                <p>";
            echo $percentagemFuncionarioColaborador;
            echo "%</p>
                                                </address>";
        }

        if (!empty($percentagemEntPatronalColaborador)) {
            echo "<address>
                                                <strong>Percentagem Entidade Patronal</strong><br>
                                                <p>";
            echo $percentagemEntPatronalColaborador;
            echo "%</p>
                                                </address>";
        }

        echo "</div>
										</div><!-- End div .row -->
									</div><!-- End div .user-profile-content -->
								</div><!-- End div .tab-pane -->
								<!-- End Tab about -->
								
													<!-- Tab about -->
								<div class='tab-pane animated fadeInRight' id='mymessage'>
									<div class='user-profile-content'>
										<div class='row'>
											<div class='col-sm-4'>";

        if (!empty($funcaoColaborador)) {
            echo "<address>
                                                <strong>Função</strong><br>
                                                <p>$funcaoColaborador</p>
                                                </address>";
        }

        if (!empty($categoriaColaborador)) {
            echo "<address>
                                                <strong>Categoria</strong><br>
                                                <p>$categoriaColaborador</p>
                                                </address>";
        }

        if (!empty($postoTrabalhoColaborador)) {
            echo "<address>
                                                <strong>Área do Posto de Trabalho</strong><br>
                                                <p>$postoTrabalhoColaborador</p>
                                                </address>";
        }

        if (!empty($situacaoContratualColaborador)) {

            echo "<address>
                                                <strong>Situação Contratual</strong><br>
                                                <p>$situacaoContratualColaborador</p>
                                                </address>";
        }

        if (!empty($novaDataAdmissao)) {
            if ($novaDataAdmissao != "0000-00-00 00:00:00") {
            $conversaoDataAdmissao = new DateTime($novaDataAdmissao);
            $textoDataAdmissao = $conversaoDataAdmissao->format('d-m-Y');

            echo "<address>
                                                <strong>Data de Admissão</strong><br>
                                                <p>$textoDataAdmissao</p>
                                                </address>";
        }}

        echo "</div>

        									<div class='col-sm-4'>";

        if (!empty($periodoExperimentalColaborador)) {

            echo "<address>
                                                <strong>Período Experimental</strong><br>
                                                <p>$periodoExperimentalColaborador Dias</p>
                                                </address>";
        }

        if (!empty($novaDataFinalPeriodoExperimentalColaborador)) {
            if ($novaDataFinalPeriodoExperimentalColaborador != "0000-00-00 00:00:00") {
            $conversaoDataFinalPeriodoExperimentalColaborador = new DateTime($novaDataFinalPeriodoExperimentalColaborador);
            $textoDataFinalPeriodoExperimentalColaborador = $conversaoDataFinalPeriodoExperimentalColaborador->format('d-m-Y');

            echo "<address>
                                                <strong>Data Final do Período Experimental</strong><br>
                                                <p>$textoDataFinalPeriodoExperimentalColaborador</p>
                                                </address>";
        }}

        if (!empty($horasSemanaisColaborador)) {
            echo "<address>
                                                <strong>Número de Horas Semanais</strong><br>
                                                <p>$horasSemanaisColaborador Horas</p>
                                                </address>";
        }

        if (!empty($horasDiariasColaborador)) {
            echo "<address>
                                                <strong>Número de Horas Diárias</strong><br>
                                                <p>$horasDiariasColaborador Horas</p>
                                                </address>";
        }

        if (!empty($descansoComplementarColaborador)) {

            echo "<address>
                                                <strong>Descanso Complementar - Sábado</strong><br>
                                                <p>$descansoComplementarColaborador</p>
                                                </address>";
        }

        echo "</div>

        									<div class='col-sm-4'>";

        if (!empty($sistemaRotativoColaborador)) {
            echo "<address>
                                                <strong>Sistema Rotativo</strong><br>
                                                <p>$sistemaRotativoColaborador</p>
                                                </address>";
        }

        if (!empty($NIBColaborador)) {

            $NIBColaborador = chunk_split($NIBColaborador, 4, ' ');

            echo "<address>
                                                <strong>NIB</strong><br>
                                                <p>$NIBColaborador</p>
                                                </address>";
        }

        if (!empty($isntBancariaColaborador)) {

            echo "<address>
                                                <strong>Instituição Bancária</strong><br>
                                                <p>$isntBancariaColaborador</p>
                                                </address>";
        }

        if (!empty($agenciaColaborador)) {

            echo "<address>
                                                <strong>Agência</strong><br>
                                                <p>$agenciaColaborador</p>
                                                </address>";
        }

        if (!empty($vencBaseColaborador)) {
            echo "<address>
                                                <strong>Vencimento Base</strong><br>
                                                <p>";
            echo $vencBaseColaborador;
            echo "€</p>
                                                </address>";
        }


        if (!empty($novaDataFinalContrato)) {
            if ($novaDataFinalContrato != "0000-00-00 00:00:00") {
                $conversaoDataFinalContrato = new DateTime($novaDataFinalContrato);
                $textoDataFinalContrato = $conversaoDataFinalContrato->format('d-m-Y');

                if($textoDataFinalContrato == "01-01-1970") $textoDataFinalContrato = "Não foi inserida uma data";

                echo "<address>
                                                <strong>Data Final do Contrato de Trabalho</strong><br>
                                                <p>$textoDataFinalContrato</p>
                                                </address>";
            }}

        echo "</div>

										</div><!-- End div .row -->
									</div><!-- End div .user-profile-content -->
								</div><!-- End div .tab-pane -->
								<!-- End Tab about -->
							</div><!-- End div .tab-content -->
						</div><!-- End div .box-info -->
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
		<div class='md-overlay' onclick='funcaoTeste();'></div>
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
	<script src='http://maps.google.com/maps/api/js?sensor=true'></script>
	<script src='assets/libs/jquery-gmap3/gmap3.min.js'></script>
	<script src='assets/js/pages/google-maps.js'></script>
	<script>
    function modalRemover(param){

        $('#md-fade-in-scale-up').find('.btn-remover').attr('href', $(\"#botaoRemover\" + param).data('href'));

$('.md-overlay').css('visibility','visible');
$('.md-overlay').css('opacity','1');

    };

    function funcaoTeste(){

$('.md-overlay').css('visibility','hidden');
$('.md-overlay').css('opacity','0');

}
    </script>
	</body>
</html>";
    } else {
        header('location:index.php');
    }
}