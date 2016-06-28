<?php session_start();

if (!isset($_SESSION['ativoAdmin'])) {
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    header("location:entrar.php?url=$actual_link");

} else {

    if (isset($_GET['contrato'])) {

        $contrato = $_GET['contrato'];

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
    <link href='assets/libs/summernote/summernote.css' rel='stylesheet' type='text/css'/>
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
                <button class='btn btn-danger md-close' onclick='funcaoTeste();'>Fechar</button>
                <a class='btn-remover' href=''><button class='btn btn-success md-close'>Remover</button></a>
            </p>
        </div>
    </div>
    <!-- End div .md-content -->
</div>
<!-- End div .md-modal .md-fade-in-scale-up -->

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

<div class='md-modal md-slide-stick-top' id='form-modal'>
    <div class='md-content'>
        <div class='md-close-btn'><a class='md-close'><i class='fa fa-times'></i></a></div>
        <h3><strong>Form</strong> Modal</h3>

        <div>
            <div class='row'>
                <div class='col-sm-6'>
                    <h4>Login</h4>

                    <form role='form'>
                        <div class='form-group'>
                            <input type='email' class='form-control' placeholder='Enter email'>
                        </div>
                        <div class='form-group'>
                            <input type='password' class='form-control' placeholder='Password'>
                        </div>
                        <button type='submit' class='btn btn-default'>Login</button>
                    </form>
                </div>
                <div class='col-sm-6'>
                    <h4>Not a member?</h4>

                    <p>Create account <a href='#fakelink'>here</a></p>

                    <p>OR</p>

                    <button type='button' class='btn btn-primary btn-sm btn-block btn-facebook'><i
                            class='fa fa-facebook'></i> Login with Facebook
                    </button>
                    <button type='button' class='btn btn-primary btn-sm btn-block btn-twitter'><i
                            class='fa fa-twitter'></i> Login with Twitter
                    </button>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- End .md-modal -->



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
        mysqli_stmt_bind_result($stmt, $idContrato, $situacaoContratualContrato, $funcaoColaborador, $postoTrabalhoContrato,
            $perExperimentalContrato, $novaDataFinalPerExperimental, $horasSemanaisContrato, $horasDiariasContrato,
            $descansoContrato, $sistemaRotativoContrato, $NIBContrato, $instBancariaContrato, $agenciaContrato,
            $vencimentoBaseContrato, $categoriaContrato, $dataInicioContrato, $refIdColaboradorContrato, $dataAtual,
            $dataFinalContrato, $atualContrato, $nomeColaboradorContrato,
            $idColaboradorContrato, $ativoColaborador);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        echo "<!-- Start right content -->
    <div class='content-page'>
        <!-- ============================================================== -->
        <!-- Start Content here -->
        <!-- ============================================================== -->
        <div class='content'>
            <!-- Page Heading Start -->
            <div class='page-heading'>
                <h1 style='float: left !important;'><i class='fa fa-user-plus'></i>&nbsp; Editar Contrato</h1>

                <span style='display: none !important;' id='titulo$refIdColaboradorContrato'>$nomeColaboradorContrato</span>";

        if($atualContrato == 0){
                  echo "<div class='text-right' style='height: 73px !important; padding-top: 10px !important;'>
								<div class='row text-right'>
									<div class='col-lg-4 text-right' style='float: right!important;'>
                                        <a
                                         data-href='php/verificacoes/verificaRemoverContrato.php?colaborador=$refIdColaboradorContrato&contrato=$idContrato'
                                        onclick='modalRemover($refIdColaboradorContrato);'
                                        id='botaoRemover$refIdColaboradorContrato'
                                        data-modal='md-fade-in-scale-up' class='md-trigger' data-target='#md-fade-in-scale-up'>
                                        <button type='button' class='text-right btn btn-danger btn-sm'>
										<i class='fa fa-remove'></i> Remover Contrato</button></a>

								</div>
							</div>
							<!-- End div .user-button -->";
        }else{

            echo "<div class='text-right' style='height: 73px !important; padding-top: 10px !important;'>
								<div class='row text-right'>
									<div class='col-lg-4 text-right' style='float: right!important;'>
									</div>
							</div>
							<!-- End div .user-button -->";

        }
            echo "</div>
            <!-- Page Heading End-->";

        if (isset($_GET['sucesso'])) {

            $contratoEditado = $_GET['sucesso'];

            $query = "SELECT id_colaborador, nome_completo FROM colaborador
                        WHERE id_colaborador = ?";

            $stmt = mysqli_prepare($link, $query);
            mysqli_stmt_bind_param($stmt, 's', $contratoEditado);
            mysqli_stmt_bind_result($stmt, $medicinaAdicionada, $nomeCompletoAdicionada);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);

            echo "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
               O contrato do colaborador <b>$nomeCompletoAdicionada</b> foi editado com sucesso.<br>
               <a class='alert-link'>Votos de uma excelente experiência!</a></div>";
        }

        if (isset($_GET['erro'])) {

            $medicinaAdicionada = $_GET['erro'];

            $query = "SELECT id_colaborador, nome_completo FROM colaborador
                        WHERE id_colaborador = ?";

            $stmt = mysqli_prepare($link, $query);
            mysqli_stmt_bind_param($stmt, 'i', $medicinaAdicionada);
            mysqli_stmt_bind_result($stmt, $medicinaAdicionada, $nomeCompletoAdicionada);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);

            echo "<div class='alert alert-danger alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
               Ocorreu um erro ao editar o contrato do colaborador <b>$nomeCompletoAdicionada</b>.<br>
               <a class='alert-link'>Votos de uma excelente experiência!</a></div>";
        }

        echo "<div class='widget'>
                <div class='widget-header transparent'>
                    <h2><strong>Editar</strong> Contrato</h2>

                    <div class='additional-btn'>
                        <a href='#' class='hidden reload'><i class='icon-ccw-1'></i></a>
                        <a href='#' class='widget-toggle'><i class='icon-down-open-2'></i></a>

                    </div>
                </div>
                <div class='widget-content padding'>
                    <form class='form-horizontal' role='form' method='post'
                    action='php/verificacoes/verificaEditarContrato.php?contrato=$idContrato";if($atualContrato == 1){echo "&atual";} echo "'>
                        <div class='form-group'>
                            <label class='col-sm-2 control-label'>Colaborador</label>

                            <div class='col-sm-10'>
                                <select class='form-control selectpicker' disabled
                                name='adicionarNomeContrato' required='required'>";

            echo "<option value='$refIdColaboradorContrato' selected>$nomeColaboradorContrato</option>";

        echo "</select>
                            </div>
                        </div>

                        <div class='form-group'>

                            <label for='input-text' class='col-sm-2 control-label'>Função</label>
                             <div class='col-sm-2'>

                                              <select id='pessoasDecisao' class='form-control' name=' ";

        if(($funcaoColaborador == "Ajudante") OR ($funcaoColaborador == "Distribuição") OR ($funcaoColaborador == "Escritório") OR
            ($funcaoColaborador == "Técnico de Vendas")){
            echo "funcaoColaborador";
        }else{
            echo "";
        }

        echo " ' onchange='apresentacaInputTexto();'>
                                            <option selected disabled>Função</option>
                                            <option ";
        if($funcaoColaborador == "Ajudante"){
            echo "selected";
        }
        echo " value='Ajudante'><b>Ajudante</b></option>
                                            <option ";
        if($funcaoColaborador == "Distribuição"){
            echo "selected";
        }
        echo " value='Distribuição'><b>Distribuição</b></option>
                                            <option ";
        if($funcaoColaborador == "Escritório"){
            echo "selected";
        }
        echo " value='Escritório'><b>Escritório</b></option>
                                            <option ";
        if($funcaoColaborador == "Técnico de Vendas"){
            echo "selected";
        }
        echo " value='Técnico de Vendas'><b>Técnico de Vendas</b></option>
                                            <option ";
        if(($funcaoColaborador != "Ajudante") AND ($funcaoColaborador != "Distribuição") AND ($funcaoColaborador != "Escritório") AND
            ($funcaoColaborador != "Técnico de Vendas")){
            echo "selected";
        }
        echo " value='Outro'><b>Outro</b></option>
                                            </select>

                                </div>

                                <div id='outroPessoasDecisao' style='display: ";
        if(($funcaoColaborador != "Ajudante") AND ($funcaoColaborador != "Distribuição") AND ($funcaoColaborador != "Escritório") AND
            ($funcaoColaborador != "Técnico de Vendas")){
            echo "block";
        }else{
            echo "none";
        }
        echo "'>
                                            <label for='input-text' class='col-sm-1 control-label'>Qual?</label>
                                            <div class='col-sm-2'>
                                            <input name='";

        if(($funcaoColaborador != "Ajudante") AND ($funcaoColaborador != "Distribuição") AND ($funcaoColaborador != "Escritório") AND
            ($funcaoColaborador != "Técnico de Vendas")){
            echo "funcaoColaborador";
        }else{
            echo "";
        }

        echo "' type='text' class='form-control' ";
        if(($funcaoColaborador <> "Ajudante") AND ($funcaoColaborador <> "Distribuição")
            AND ($funcaoColaborador <> "Escritório") AND  ($funcaoColaborador <> "Técnico de Vendas")){
            echo "value='$funcaoColaborador'";
        }
        echo " type='text' class='form-control'
                                            placeholder='Outra Função' id='idPessoasDecisao'>
                                                </div>
                                                </div>

                                                <script>
                                                function apresentacaInputTexto(){

                                                    if(document.getElementById('pessoasDecisao').value == 'Outro'){

                                                        document.getElementById('outroPessoasDecisao').style.display='block';
                                                        $('#pessoasDecisao').attr('name', '');
                                                        $('#idPessoasDecisao').attr('name', 'funcaoColaborador');

                                                    }else{

                                                document.getElementById('outroPessoasDecisao').style.display='none';
                                                $('#pessoasDecisao').attr('name', 'funcaoColaborador');
                                                $('#idPessoasDecisao').attr('name', '');

                                            }

                                        }
                                    </script>

                                     <label for='input-text' class='col-sm-1 control-label'>Categoria</label>
                             <div class='col-sm-2'>
                                 <input type='text' id='inputEmail' placeholder='Categoria'
                                 autocomplete='on' class='form-control' name='categoriaColaborador' ";
        if(!empty($categoriaContrato)){
            echo "value='$categoriaContrato'";
        }
        echo " >
                             </div>

                                <div class='col-sm-12'>&nbsp;</div>

                    <label for='input-text' class='col-sm-2 control-label'>Área do Posto de Trabalho</label>
                    <div class='col-sm-2'>
                   <select class='form-control' name='postoTrabalhoColaborador'>
                                                <option selected disabled>Posto de Trabalho</option>
                                                <option ";
        if ($postoTrabalhoContrato == "Escritório") {
            echo "selected";
        }
        echo " value='Escritório'>Escritório</option>
                                                <option ";
        if ($postoTrabalhoContrato == "DAL") {
            echo "selected";
        }
        echo " value='DAL'>DAL</option>
                                                <option ";
        if ($postoTrabalhoContrato == "Força de Vendas Aveiro") {
            echo "selected";
        }
        echo " value='Força de Vendas Aveiro'>Força de Vendas Aveiro</option>
                                                <option ";
        if ($postoTrabalhoContrato == "Força de Vendas Ovar") {
            echo "selected";
        }
        echo " value='Força de Vendas Ovar'>Força de Vendas Ovar</option>
                                                <option ";
        if ($postoTrabalhoContrato == "Força de Vendas Viseu") {
            echo "selected";
        }
        echo " value='Força de Vendas Viseu'>Força de Vendas Viseu</option>
                                                <option ";
        if ($postoTrabalhoContrato == "SDD") {
            echo "selected";
        }
        echo " value='SDD'>SDD</option>
                                            </select>
                    </div>

<label for='input-text' class='col-sm-1 control-label'>Sit. Contratual</label>
                    <div class='col-sm-2'>
                        <select class='form-control' name='situacaoContratualColaborador'>
                                                <option selected disabled>Situação Contratual</option>
                                                <option ";
        if($situacaoContratualContrato == "Quadro"){echo "selected";}
        echo " value='Quadro'>Quadro</option>
                                                <option ";
        if($situacaoContratualContrato == "Termo"){echo "selected";}
        echo " value='Termo'>Termo</option>
                                                <option ";
        if($situacaoContratualContrato == "Sem Termo"){echo "selected";}
        echo " value='Sem Termo'>Sem Termo</option>
                                            </select>
                    </div>


                     <label for='input-text' class='col-sm-1 control-label'>D. de Admissão</label>
                            <div class='col-sm-2'>

                                 <div class='add-on input-append date' id='dp4' data-date='2012-01-02' data-date-format='yyyy-mm-dd'>
                            <input type='text' id='date-daily2' class='form-control datepicker-input'
                             placeholder='Data de Admissão' name='dataAdmissao' ";

        if (!empty($dataInicioContrato)) {
            if ($dataInicioContrato != "1970-01-01 00:00:00") {
                $conversaoDataAdmissao = new DateTime($dataInicioContrato);
                $textoDataAdmissao = $conversaoDataAdmissao->format('d-m-Y');

                echo "value='$textoDataAdmissao'";
            }
        }
        echo " >
                            </div>
                            </div>

                        <label for='input-text' class='col-sm-1 control-label'>P. Experimental</label>
                             <div class='col-sm-1'>
                                 <input type='number' id='inputEmail' placeholder='Dia(s)'
                                 autocomplete='on' class='form-control' name='periodoExperimentalColaborador' ";
        if(!empty($perExperimentalContrato)){
            echo "value='$perExperimentalContrato'";
        }
        echo " >
                             </div>

                             <div class='col-sm-12'>
                             &nbsp;
                             </div>

                              <label for='input-text' class='col-sm-2 control-label'>D. Final do Per. Experimental</label>
                            <div class='col-sm-2'>

                                 <div class='add-on input-append date' id='dp4' data-date='2012-01-02' data-date-format='yyyy-mm-dd'>
                            <input type='text' id='date-daily2' class='form-control datepicker-input'
                             placeholder='Data Final do Período Experimental' name='dataFinalPeriodoExperimentalColaborador' ";
        if (!empty($novaDataFinalPerExperimental)) {
            if ($novaDataFinalPerExperimental != "1970-01-01 00:00:00") {
                $conversaoDataExp = new DateTime($novaDataFinalPerExperimental);
                $textoDataExp = $conversaoDataExp->format('d-m-Y');

                echo "value='$textoDataExp'";
            }
        }
        echo " >
                            </div>
                            </div>

                            <label for='input-text' class='col-sm-1 control-label'>Nº Horas Sem.</label>
                             <div class='col-sm-2'>
                                 <input type='number' id='inputEmail' placeholder='Horas Semanais'
                                 autocomplete='on' class='form-control' name='horasSemanaisColaborador' ";
        if(!empty($horasSemanaisContrato)){
            echo "value='$horasSemanaisContrato'";
        }
        echo " >
                             </div>

  <label for='input-text' class='col-sm-1 control-label'>Nº Horas Diárias</label>
                             <div class='col-sm-2'>
                                 <input type='number' id='inputEmail' placeholder='Horas Diárias'
                                 autocomplete='on' class='form-control' name='horasDiariasColaborador' ";
        if(!empty($horasDiariasContrato)){
            echo "value='$horasDiariasContrato'";
        }
        echo " >
                             </div>

                              <div class='col-sm-12'>
                             &nbsp;
                             </div>

  <label for='input-text' class='col-sm-2 control-label'>Descanso Complementar - Sábado</label>
   <div class='col-sm-2'>
  <label>
                                                <input type='radio' id='optionsRadios1'
                                                       value='Sim' name='descansoComplementarColaborador' ";
        if($descansoContrato == "Sim"){
            echo "checked";
        }
        echo " > Sim
                                            </label>
                                            <label>
                                                <input type='radio' name='descansoComplementarColaborador'
                                                       id='optionsRadios2' value='Não' ";
        if($descansoContrato == "Não"){
            echo "checked";
        }
        echo " > Não
                                            </label>
</div>

                                <label for='input-text' class='col-sm-1 control-label'>Sistema Rotativo</label>
                                   <div class='col-sm-1'>
                                  <label>
                                                <input type='radio' id='optionsRadios1'
                                                       value='Sim' name='sistemaRotativoColaborador' ";
        if($sistemaRotativoContrato == "Sim"){
            echo "checked";
        }
        echo " > Sim
                                            </label>
                                            <label>
                                                <input type='radio' name='sistemaRotativoColaborador'
                                                       id='optionsRadios2' value='Não' ";
        if($sistemaRotativoContrato == "Não"){
            echo "checked";
        }
        echo " > Não
                                            </label>
</div>


  <label for='input-text' class='col-sm-1 control-label'>NIB</label>
                             <div class='col-sm-5'>
                                 <input type='number' id='inputEmail' placeholder='NIB'
                                 autocomplete='on' class='form-control' name='NIBColaborador' ";
        if (!empty($NIBContrato)) {
            echo "value='$NIBContrato'";
        }
        echo " >
                             </div>

    <div class='col-sm-12'>
                             &nbsp;
                             </div>

  <label for='input-text' class='col-sm-2 control-label'>Instituição Bancária</label>
                             <div class='col-sm-2'>
                                 <input type='text' id='inputEmail' placeholder='Instituição Bancária'
                                 autocomplete='on' class='form-control' name='isntBancariaColaborador' ";
        if (!empty($instBancariaContrato)) {
            echo "value='$instBancariaContrato'";
        }

        echo " >
                             </div>

  <label for='input-text' class='col-sm-1 control-label'>Agência</label>
                             <div class='col-sm-2'>
                                 <input type='text' id='inputEmail' placeholder='Agência'
                                 autocomplete='on' class='form-control' name='agenciaColaborador' ";
        if (!empty($agenciaContrato)) {
            echo "value='$agenciaContrato'";
        }
        echo " >
                             </div>


                               <label for='input-text' class='col-sm-1 control-label'>Venc. Base</label>
                             <div class='col-sm-1'>
                                 <input type='text' id='inputEmail' placeholder='Vencimento'
                                 autocomplete='on' class='form-control' name='vencBaseColaborador' ";
        if (!empty($vencimentoBaseContrato)) {
            echo "value='$vencimentoBaseContrato&euro;'";
        }
        echo " >
                             </div>

                              <label for='input-text' class='col-sm-1 control-label'>Data Final do Contr. de Trab.</label>
                             <div class='col-sm-2'>
                                  <div class='add-on input-append date' id='dp4' data-date='2012-01-02' data-date-format='yyyy-mm-dd'>
                            <input type='text' id='date-daily2' class='form-control datepicker-input'
                             placeholder='Data Final do Contrato de Trabalho' name='dataFinalContratoColaborador' ";
        if (!empty($dataFinalContrato)) {

            if ($dataFinalContrato != "1970-01-01 00:00:00") {
                $conversaoDataFinalContrato = new DateTime($dataFinalContrato);
                $textoDataFinalContrato = $conversaoDataFinalContrato->format('d-m-Y');

                echo "value='$textoDataFinalContrato'";
            }
        }
        echo " >
                            </div>
                             </div>

                        </div>

<div style='display: none !important;'>
<input type='text' value='$refIdColaboradorContrato' name='idColaborador'/>
</div>

                        <div class='form-group'>

                            <div class='col-sm-2'>
                                &nbsp;
                            </div>
                            <div class='col-sm-10'>
                                <button type='submit' style='width: 100% !important;'
                                class='btn btn-default input-block-level'>Editar</button>
                            </div>

                        </div>

                    </form>
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
<script src='assets/libs/bootstrap-select/bootstrap-select.min.js'></script>
<script src='assets/libs/bootstrap-inputmask/inputmask.js'></script>
<script src='assets/libs/summernote/summernote.js'></script>
<script src='assets/js/pages/forms.js'></script>
<script>

function funcaoTeste(){

$('.md-overlay').css('visibility','hidden');
$('.md-overlay').css('opacity','0');

}

</script>
<script>
    function modalRemover(param){

        $('#md-fade-in-scale-up').find('.btn-remover').attr('href', $(\"#botaoRemover\" + param).data('href'));

        var titulo = '';
        titulo = document.getElementById('titulo'+param).innerHTML;
        document.getElementById('alteravel').innerHTML = titulo;

        $('.md-overlay').css('visibility','visible');
        $('.md-overlay').css('opacity','1');

    };
</script>
</body>
</html>";
    } else {
        header('location:index.php');
    }
}
?>