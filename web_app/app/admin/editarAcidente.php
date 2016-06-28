<?php session_start();

if (!isset($_SESSION['ativoAdmin'])) {
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    header("location:entrar.php?url=$actual_link");
} else {

    if (isset($_GET['acidente'])) {

        $acidente = $_GET['acidente'];

        require_once('php/connection/dbconnection.php');

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

<!-- Modal fade in scale up -->
<div class='md-modal md-fade-in-scale-up' id='md-fade-in-scale-up'>
    <div class='md-content'>
        <h3>Remover Acidente</h3>

        <div>
            <p>Tem a certeza que pretende remover este acidente do colaborador <strong><span id='alteravel'></span></strong>?</p>
            <ul>
                <li><strong>Atenção:</strong> Esta ação não pode ser revertida.
                </li>
                 <li><strong>Informação:</strong> Após a confirmação da remoção, pode voltar a adicionar acidentes de trabalho ao colaborador.
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

<!-- Begin page -->
<div id='wrapper'>";

        require_once('php/includes/menus.php');
        Menus('acidentes');


        $query = "SELECT acidentes.id_acidente, acidentes.ref_id_colaborador, acidentes.data_acidente,acidentes.departamento,
acidentes.numero_processo, acidentes.atividade, acidentes.descricao, acidentes.lesoes, acidentes.causas,
acidentes.categoria, acidentes.tipologia, acidentes.tratamento, acidentes.ausencia_horas, acidentes.ausencia_dias,
acidentes.acao, acidentes.numero_acao, acidentes.tipo_acao, acidentes.descricao_acao, acidentes.data_implementacao,
acidentes.resultados, acidentes.controlo, acidentes.data_conclusao, acidentes.observacoes, acidentes.eficacia,
 acidentes.responsavel, acidentes.data_fecho, colaborador.nome_completo, colaborador.ativo
FROM acidentes INNER JOIN colaborador ON acidentes.ref_id_colaborador = colaborador.id_colaborador
WHERE colaborador.ativo = 1 AND acidentes.id_acidente = ? ORDER BY colaborador.nome_completo ASC ";

        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, 's', $_GET['acidente']);
        mysqli_stmt_bind_result($stmt, $idAcidente, $refIdColaborador, $dataAcidente,
            $departamentoAcidente, $numeroProcessoAcidente, $atividadeRealizarAcidente, $descricaoAcidente, $lesoesAcidente,
            $causasAcidente, $categoriaAcidente, $tipologiaAcidente, $tratamentoAcidente, $horasAusenciaAcidente,
            $diasAusenciaAcidente, $acaoAcidente, $numeroAcao, $tipoAcaoAcidente, $descricaoAcaoAcidente,
            $dataImplementacaoAcidente, $resultadosEsperadosAcidente, $textoControloExecucaoAcidente,
            $dataConclusaoAcidente, $observacoesAcidente, $eficaciaAcidente, $responsavelAcidente,
            $dataFechoAcidente, $nomeComportamento, $ativoComportamento);
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
                <h1 style='float: left !important;'>
                <i class='fa fa-medkit'></i> Acidentes de Trabalho</h1>

                  <div class='text-right' style='height: 73px !important; padding-top: 10px !important;'>
                  <span style='display: none !important;' id='titulo$refIdColaborador'>$nomeComportamento</span>
								<div class='row text-right'>
									<div class='col-lg-4 text-right' style='float: right!important;'>
                                        <a
                                        data-href='php/verificacoes/verificaCancelarAcidente.php?colaborador=$refIdColaborador&acidente=$idAcidente'
                                        onclick='modalRemover($refIdColaborador);' id='botaoRemover$refIdColaborador'
                                        data-modal='md-fade-in-scale-up' class='md-trigger' data-target='#md-fade-in-scale-up'>
                                        <button type='button' class='text-right btn btn-danger btn-sm'>
										<i class='fa fa-remove'></i> Remover Acidente</button></a>

								</div>
							</div>
							<!-- End div .user-button -->

            </div>
            <!-- Page Heading End-->";

        if (isset($_GET['sucesso'])) {

            $medicinaAdicionada = $_GET['sucesso'];

            $query = "SELECT id_colaborador, nome_completo FROM colaborador
                        WHERE id_colaborador = ?";

            $stmt = mysqli_prepare($link, $query);
            mysqli_stmt_bind_param($stmt, 'i', $medicinaAdicionada);
            mysqli_stmt_bind_result($stmt, $medicinaAdicionada, $nomeCompletoAdicionada);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);

            echo "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
               O acidente do colaborador <b>$nomeCompletoAdicionada</b> foi editado com sucesso.<br>
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
               Ocorreu um erro ao editar o acidente do colaborador <b>$nomeCompletoAdicionada</b>.<br>
               <a class='alert-link'>Votos de uma excelente experiência!</a></div>";
        }

        echo "<div class='widget'>
                <div class='widget-header transparent'>
                    <h2><strong>Editar</strong> Acidente</h2>

                    <div class='additional-btn'>
                        <a href='#' class='hidden reload'><i class='icon-ccw-1'></i></a>
                        <a href='#' class='widget-toggle'><i class='icon-down-open-2'></i></a>

                    </div>
                </div>
                <div class='widget-content padding'>
                    <form class='form-horizontal' role='form' method='post'
                    action='php/verificacoes/verificaEditarAcidente.php?acidente=$idAcidente'>
                        <div class='form-group'>
                            <label class='col-sm-2 control-label'>Colaborador</label>

                            <div class='col-sm-10'>
                                <select class='form-control selectpicker' title='AAA'
                                name='adicionarColaboradorAcidente' required='required'>
                                <option disabled selected value=''>Colaborador</option>";

        $query = "SELECT id_colaborador, nome_completo FROM colaborador WHERE ativo = 1";
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_result($stmt, $idColaborador, $nomeColaborador);
        mysqli_stmt_execute($stmt);

        while (mysqli_stmt_fetch($stmt)) {
            echo "<option value='$idColaborador' ";
            if ($idColaborador == $refIdColaborador) {
                echo "selected";
            }

            echo " >$nomeColaborador</option>";
        }

        mysqli_stmt_close($stmt);
        echo "</select>
                            </div>
                        </div>

                        <div class='form-group'>

                              <label for='input-text' class='col-sm-2 control-label'>Data</label>
                            <div class='col-sm-2'>
                                <input type='text' class='form-control datepicker-input'
                                id='inputEmail' name='dataAcidente' data-mask='99-99-9999'
                                placeholder='Data do Acidente' ";

        if(!empty($dataAcidente)){

            $conversaoDataAcidente = new DateTime($dataAcidente);
            $textoDataAcidente = $conversaoDataAcidente->format('d-m-Y');

            echo "value='$textoDataAcidente'";

        }

        echo " >
                            </div>

                               <label for='input-text' class='col-sm-1 control-label'>Departamento</label>
                            <div class='col-sm-2'>
                                  <select class='form-control' name='departamentoAcidente'>
                                        <option selected disabled>Departamento</option>
                                        <option value='FV Aveiro' ";

        if(!empty($departamentoAcidente) AND $departamentoAcidente == "FV Aveiro"){

            echo "selected";

        }

        echo " ><b>FV Aveiro</b></option>
                                        <option value='FV Ovar' ";

        if(!empty($departamentoAcidente) AND $departamentoAcidente == "FV Ovar"){

            echo "selected";

        }
        echo " ><b>FV Ovar</b></option>
                                        <option value='FV Viseu' ";

        if(!empty($departamentoAcidente) AND $departamentoAcidente == "FV Viseu"){

            echo "selected";

        }
        echo " ><b>FV Viseu</b></option>
                                        <option value='DAL' ";
        if(!empty($departamentoAcidente) AND $departamentoAcidente == "DAL"){

            echo "selected";

        }
        echo " ><b>DAL</b></option>
                                </select>
                            </div>

                             <label for='input-text' class='col-sm-1 control-label'>Nº do Processo</label>
                            <div class='col-sm-2'>
                                <input type='text' class='form-control'
                                id='inputEmail' name='numeroProcessoAcidente' data-mask='999999999/99'
                                placeholder='Número do Processo' ";
        if(!empty($numeroProcessoAcidente)){

            echo "value='$numeroProcessoAcidente'";

        }
        echo " >
                            </div>

                              <div class='col-sm-12'>
                            &nbsp;
                            </div>

                            <label for='inputEmail' class='control-label col-sm-2'>Atividade a Realizar</label>
                            <div class='col-sm-3'>
                                <textarea placeholder='Atividade a Realizar Durante o Acidente' rows='2'
                                class='form-control' name='atividadeRealizarAcidente'>";

        if(!empty($atividadeRealizarAcidente)){

            echo "$atividadeRealizarAcidente";

        }
        echo "</textarea>
                            </div>

                              <label for='inputEmail' class='control-label col-sm-1'>Descrição</label>
                            <div class='col-sm-6'>
                                <textarea placeholder='Descrição do Acidente' rows='2' class='form-control'
                                name='descricaoAcidente'>";
        if(!empty($descricaoAcidente)){

            echo "$descricaoAcidente";

        }
        echo "</textarea>
                            </div>

                             <div class='col-sm-12'>
                            &nbsp;
                            </div>

                             <label for='inputEmail' class='control-label col-sm-2'>Lesões</label>
                            <div class='col-sm-3'>
                                <textarea placeholder='Lesões Provocadas' rows='2'
                                class='form-control' name='lesoesAcidente'>";

        if(!empty($lesoesAcidente)){

            echo "$lesoesAcidente";

        }

        echo "</textarea>
                            </div>

                            <label for='inputEmail' class='control-label col-sm-1'>Causas</label>
                            <div class='col-sm-3'>
                                <textarea placeholder='Causas do Acidente' rows='2'
                                class='form-control' name='causasAcidente'>";
        if(!empty($causasAcidente)){

            echo "$causasAcidente";

        }
        echo "</textarea>
                            </div>

                             <label for='input-text' class='col-sm-1 control-label'>Categoria B&N</label>
                            <div class='col-sm-2'>
                                <input type='text' class='form-control'
                                id='inputEmail' name='categoriaAcidente'
                                placeholder='Categoria do Acidente' ";
        if(!empty($categoriaAcidente)){

            echo "value='$categoriaAcidente'";

        }
        echo " >
                            </div>

                            <div class='col-sm-12'>
                            &nbsp;
                            </div>

                                 <label for='input-text' class='col-sm-2 control-label'>Tipologia</label>
                            <div class='col-sm-2'>
                                <input type='text' class='form-control'
                                id='inputEmail' name='tipologiaAcidente'
                                placeholder='Tipologia do Acidente' ";
        if(!empty($tipologiaAcidente)){

            echo "value='$tipologiaAcidente'";

        }
        echo " >
                            </div>

                              <label for='inputEmail' class='control-label col-sm-1'>Tratamento</label>
                            <div class='col-sm-4'>
                                <textarea placeholder='Tratamento do Acidente' rows='2'
                                class='form-control' name='tratamentoAcidente'>";
        if(!empty($tratamentoAcidente)){

            echo "$tratamentoAcidente";

        }
        echo "</textarea>
                            </div>


                             <div class='col-sm-12'>
                            &nbsp;
                            </div>

                              <label for='input-text' class='col-sm-2 control-label'>Ausência</label>
                            <div class='col-sm-1'>
                                <input type='text' class='form-control'
                                id='inputEmail' name='horasAusenciaAcidente' data-mask='99:99'
                                placeholder='Horas' ";
        if(!empty($horasAusenciaAcidente)){

            echo "value='$horasAusenciaAcidente'";

        }
        echo ">
                            </div>

                             <div class='col-sm-1'>
                                <input type='text' class='form-control'
                                id='inputEmail' name='diasAusenciaAcidente'
                                placeholder='Dias' ";
        if(!empty($diasAusenciaAcidente)){

            echo "value='$diasAusenciaAcidente'";

        }
        echo " >
                            </div>

                             <div class='col-sm-2'>
                            <label for='inputEmail' class='control-label'>Ação&nbsp;&nbsp;</label>
                                            <label>
                                                <input type='radio' id='optionsRadios1' ";

        if(!empty($acaoAcidente) AND $acaoAcidente == "Sim"){
            echo "checked";
        }

                                                       echo " value='Sim' name='acaoAcidente'> &nbsp;Sim &nbsp;&nbsp;&nbsp;
                                            </label>
                                            <label>
                                                <input type='radio' name='acaoAcidente' ";
        if(!empty($acaoAcidente) AND $acaoAcidente == "Não"){
            echo "checked";
        }
                                                       echo " id='optionsRadios2' value='Não'> &nbsp;Não &nbsp;&nbsp;&nbsp;
                                            </label>
                            </div>


                              <label for='input-text' class='col-sm-1 control-label'>Número de Ação</label>
                            <div class='col-sm-1'>
                                <input type='number' class='form-control'
                                id='inputEmail' name='numeroAcao'
                                placeholder='Horas' ";
        if(!empty($numeroAcao)){

            echo "value='$numeroAcao'";

        }
        echo " >
                            </div>

                               <div class='col-sm-3'>
                            <label for='inputEmail' class='control-label'>Tipo de Ação&nbsp;&nbsp;</label>
                                            <label>
                                                <input type='radio' id='optionsRadios1' ";
        if(!empty($tipoAcaoAcidente) AND $tipoAcaoAcidente == "M"){
            echo "checked";
        }
                                                       echo " value='M' name='tipoAcaoAcidente'> &nbsp;M &nbsp;&nbsp;&nbsp;
                                            </label>
                                            <label>
                                                <input type='radio' name='tipoAcaoAcidente' ";
        if(!empty($tipoAcaoAcidente) AND $tipoAcaoAcidente == "C"){
            echo "checked";
        }
                                                       echo " id='optionsRadios2' value='C'> &nbsp;C &nbsp;&nbsp;&nbsp;
                                            </label>
                                                <label>
                                                <input type='radio' name='tipoAcaoAcidente' ";
        if(!empty($tipoAcaoAcidente) AND $tipoAcaoAcidente == "P"){
            echo "checked";
        }
                                                     echo " id='optionsRadios2' value='P'> &nbsp;P &nbsp;&nbsp;&nbsp;
                                            </label>
                            </div>

                              <div class='col-sm-12'>
                            &nbsp;
                            </div>

                            <label for='input-text' class='col-sm-2 control-label'>Descrição da Ação</label>
                            <div class='col-sm-5'>
                                <textarea placeholder='Descrição da Ação do Acidente' rows='2'
                                class='form-control' name='descricaoAcaoAcidente'>";
        if(!empty($descricaoAcaoAcidente)){
            echo "$descricaoAcaoAcidente";
        }
        echo "</textarea>
                            </div>

                              <label for='input-text' class='col-sm-2 control-label'>Data de Implementação</label>
                            <div class='col-sm-2'>
                                <input type='text' class='form-control datepicker-input'
                                id='inputEmail' name='dataImplementacaoAcidente' data-mask='99-99-9999'
                                placeholder='Data de Implementação' ";

        if((!empty($dataImplementacaoAcidente)) AND ($dataImplementacaoAcidente != "1970-01-01 00:00:00")){

            $conversaoDataImplementacaoAcidente  = new DateTime($dataImplementacaoAcidente);
            $textoDataImplementacaoAcidente = $conversaoDataImplementacaoAcidente->format('d-m-Y');

            echo "value='$textoDataImplementacaoAcidente'";

        }

        echo " >
                            </div>

                            <div class='col-sm-12'>
                            &nbsp;
                            </div>


                            <label for='inputEmail' class='control-label col-sm-2'>
                            Resultados Esperados/Critérios de Avaliação de Ação
                            </label>

                            <div class='col-sm-4'>
                                <textarea placeholder='Resultados Esperados do Acidente' rows='2' class='form-control'
                                name='resultadosEsperadosAcidente'>";

        if(!empty($resultadosEsperadosAcidente)){
            echo "$resultadosEsperadosAcidente";
        }

        echo "</textarea>
                            </div>

                            <div class='form-group'>
                            <label class='col-sm-2 control-label'>Controlo de Execução</label>

                            <div class='col-sm-4'>
                                <label class='checkbox-inline icheckbox'>
                                    <input type='checkbox' id='inlineCheckbox1' name='controloExecucaoAcidente1'
                                    value='25% ' ";

if(!empty($textoControloExecucaoAcidente)){
        if (strpos($textoControloExecucaoAcidente,'25%') !== false) {
            echo 'checked';
        }
}
        echo " > 25%
                                </label>
                                <label class='checkbox-inline icheckbox'>
                                    <input type='checkbox' id='inlineCheckbox2' name='controloExecucaoAcidente2'
                                    value='50% ' ";

        if(!empty($textoControloExecucaoAcidente)){
            if (strpos($textoControloExecucaoAcidente,'50%') !== false) {
                echo 'checked';
            }
        }

        echo " > 50%
                                </label>
                                <label class='checkbox-inline icheckbox'>
                                    <input type='checkbox' id='inlineCheckbox3' name='controloExecucaoAcidente3'
                                    value='75% ' ";

        if(!empty($textoControloExecucaoAcidente)){
            if (strpos($textoControloExecucaoAcidente,'75%') !== false) {
                echo 'checked';
            }
        }

        echo " > 75%
                                </label>
                                <label class='checkbox-inline icheckbox'>
                                    <input type='checkbox' id='inlineCheckbox3' name='controloExecucaoAcidente4'
                                    value='100% ' ";

        if(!empty($textoControloExecucaoAcidente)){
            if (strpos($textoControloExecucaoAcidente,'100%') !== false) {
                echo 'checked';
            }
        }

        echo " > 100%
                                </label>
                            </div>
                            </div>

                            <div class='col-sm-12'>
                            &nbsp;
                            </div>

                              <label for='input-text' class='col-sm-2 control-label'>Data de Conclusão</label>
                            <div class='col-sm-2'>
                                <input type='text' class='form-control datepicker-input'
                                id='inputEmail' name='dataConclusaoAcidente' data-mask='99-99-9999'
                                placeholder='Data de Conclusão' ";

        if((!empty($dataConclusaoAcidente)) AND ($dataConclusaoAcidente != "1970-01-01 00:00:00")){

            $conversaoDataConclusaoAcidente = new DateTime($dataConclusaoAcidente);
            $textoDataConclusaoAcidente = $conversaoDataConclusaoAcidente->format('d-m-Y');

            echo "value='$textoDataConclusaoAcidente'";

        }

        echo " >
                            </div>

                             <label for='inputEmail' class='control-label col-sm-1'>
                            Observações
                            </label>

                            <div class='col-sm-4'>
                                <textarea placeholder='Observações do Acidente' rows='2' class='form-control'
                                name='observacoesAcidente'>";

        if(!empty($observacoesAcidente)){
            echo "$observacoesAcidente";
        }

        echo "</textarea>
                            </div>

                            <div class='col-sm-3'>
                            <label for='inputEmail' class='control-label'>Eficácia&nbsp;&nbsp;</label>
                                            <label>
                                                <input type='radio' id='optionsRadios1' ";

        if(!empty($eficaciaAcidente) AND $eficaciaAcidente == "Sim"){
            echo "checked";
        }

                                                      echo " value='Sim' name='eficaciaAcidente'> &nbsp;Sim &nbsp;&nbsp;&nbsp;
                                            </label>
                                            <label>
                                                <input type='radio' name='eficaciaAcidente' ";
        if(!empty($eficaciaAcidente) AND $eficaciaAcidente == "Não"){
            echo "checked";
        }
                                                      echo " id='optionsRadios2' value='Não'> &nbsp;Não &nbsp;&nbsp;&nbsp;
                                            </label>
                            </div>

                            <div class='col-sm-12'>
                            &nbsp;
                            </div>

                            <label for='input-text' class='col-sm-2 control-label'>Responsável</label>
                            <div class='col-sm-2'>
                                <input type='text' class='form-control'
                                id='inputEmail' name='responsavelAcidente'
                                placeholder='Responsável' "; if(!empty($responsavelAcidente)){
            echo "value='$responsavelAcidente'";
        }
        echo " >
                            </div>

                             <label for='input-text' class='col-sm-1 control-label'>Data de Fecho</label>
                            <div class='col-sm-2'>
                                <input type='text' class='form-control datepicker-input'
                                id='inputEmail' name='dataFechoAcidente' data-mask='99-99-9999'
                                placeholder='Data de Fecho' ";

        if((!empty($dataFechoAcidente)) AND ($dataFechoAcidente != "1970-01-01 00:00:00")){
            $conversaoDataFechoAcidente = new DateTime($dataFechoAcidente);
            $textoDataFechoAcidente = $conversaoDataFechoAcidente->format('d-m-Y');
            echo "value='$textoDataFechoAcidente'";
        }

        echo " >
                            </div>


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
    function modalRemover(param){

        $('#md-fade-in-scale-up').find('.btn-remover').attr('href', $(\"#botaoRemover\" + param).data('href'));

        var titulo = '';
        titulo = document.getElementById('titulo'+param).innerHTML;
        document.getElementById('alteravel').innerHTML = titulo;

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
?>