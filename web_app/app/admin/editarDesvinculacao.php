<?php

session_start();

if ((!isset($_SESSION['ativoAdmin']))) {

    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    header("location:entrar.php?url=$actual_link");

} else {

    if (isset($_GET['desvinculacao'])) {

        $desvinculacao = $_GET['desvinculacao'];

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

<!-- Modal fade in scale up -->
<div class='md-modal md-fade-in-scale-up' id='md-fade-in-scale-up'>
     <div class='md-content'>
        <h3>Remover Entrevista de Desvinculação</h3>

        <div>
            <p>Tem a certeza que pretende remover esta entrevista de desvinculação do colaborador <strong><span id='alteravel'></span></strong>?</p>
            <ul>
                <li><strong>Atenção:</strong> Esta ação não pode ser revertida.
                </li>
                <li><strong>Informação:</strong> Após a confirmação da remoção, pode voltar a adicionar entrevistas de desvinculação ao colaborador.
                <br>Estas entrevistas só podem ser adicionadas quando há um cancelamento de contrato do colaborador.
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

        $query = "SELECT desvinculacao.id_desvinculacao, desvinculacao.ref_id_colaborador, desvinculacao.data_entrevista,
desvinculacao.porque, desvinculacao.data_desvinculacao, desvinculacao.motivo, desvinculacao.novamente, desvinculacao.melhorar,
desvinculacao.relacionamento, desvinculacao.estrutura, desvinculacao.valores, desvinculacao.planeamento, desvinculacao.superior,
desvinculacao.gerencia, desvinculacao.contrapartidas, desvinculacao.funcao, desvinculacao.comentarios, desvinculacao.parecer,
desvinculacao.readmissao, colaborador.nome_completo FROM desvinculacao
INNER JOIN colaborador ON desvinculacao.ref_id_colaborador = colaborador.id_colaborador
WHERE desvinculacao.id_desvinculacao = ? ORDER BY colaborador.nome_completo ASC";

        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, 's', $_GET['desvinculacao']);
        mysqli_stmt_bind_result($stmt, $idDesvinculacao, $refIdColaborador, $novaDataEntrevistaDesvinculacao, $porqueDesvinculacao,
            $novaDataDesvinculacao, $motivoDesvinculacao, $trabalhariaDesvinculacao, $melhoriaDesvinculacao,
            $relacionamentoInterpessoalDesvinculacao, $estruturaFisicaDesvinculacao, $valoresNormasEmpresa, $planeamentoOrganizacaoObjetivos,
            $superiorHierarquico, $gerenciaDesvinculacao, $contrapartidasEmpresa, $funcaoExercida, $comentariosDesvinculacao,
            $parecerDesvinculacao, $readmitidoDesvinculacao, $nomeColaborador);
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
                <h1 style='float: left!important;'><i class='fa fa fa-user-times'></i> Entrevista de Desvinculação</h1>
<span style='display: none !important;' id='titulo$refIdColaborador'>$nomeColaborador</span>
                  <div class='text-right' style='height: 73px !important; padding-top: 10px !important;'>
								<div class='row text-right'>
									<div class='col-lg-4 text-right' style='float: right!important;'>
                                        <a
                                        data-href='php/verificacoes/verificaCancelarDesvinculacao.php?colaborador=$refIdColaborador&desvinculacao=$idDesvinculacao'
                                        onclick='modalRemover($refIdColaborador);' id='botaoRemover$refIdColaborador'
                                        data-modal='md-fade-in-scale-up' class='md-trigger' data-target='#md-fade-in-scale-up'>
                                        <button type='button' class='text-right btn btn-danger btn-sm'>
										<i class='fa fa-remove'></i> Remover Entrevista</button></a>

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
               A entrevista de desvinculação do colaborador <b>$nomeCompletoAdicionada</b> foi editada com sucesso.<br>
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
               Ocorreu um erro ao editar a entrevista de desvinculação do colaborador <b>$nomeCompletoAdicionada</b>.<br>
               <a class='alert-link'>Votos de uma excelente experiência!</a></div>";
}

$colaboradorId = $_GET['colaborador'];

echo "<div class='widget'>
                <div class='widget-header transparent'>
                    <h2><strong>Editar</strong> Entrevista de Desvinculação</h2>

                    <div class='additional-btn'>
                        <a href='#' class='hidden reload'><i class='icon-ccw-1'></i></a>
                        <a href='#' class='widget-toggle'><i class='icon-down-open-2'></i></a>

                    </div>
                </div>
                <div class='widget-content padding'>
                    <form class='form-horizontal' role='form' method='post'
                    action='php/verificacoes/verificaEditarDesvinculacao.php?desvinculacao=$idDesvinculacao";
if(isset($_GET['perfil']))
    echo "&perfil";
echo "'>
                        <div class='form-group'>
                            <label class='col-sm-2 control-label'>Colaborador</label>

                            <div class='col-sm-10'>
                                <select class='form-control selectpicker'
                                name='' required='required' disabled>
                                <option disabled value=''>Colaborador</option>";

    echo "<option selected  disabled value='$refIdColaborador'>$nomeColaborador</option>";

        echo "</select>
                            </div>
                        </div>

<input type='number' value='$refIdColaborador' style='display: none !important;' name='adicionarNomeDesvinculacao'/>

                        <div class='form-group'>

 <label for='input-text' class='col-sm-2 control-label'>Data de Entrevista</label>
                            <div class='col-sm-2'>

                                 <div class='add-on input-append date' id='dp4' data-date='2012-01-02' data-date-format='yyyy-mm-dd'>
                            <input type='text' id='date-daily2' class='form-control datepicker-input'
                             placeholder='Data de Entrevista' name='dataEntrevistaDesvinculacao' ";

        if (!empty($novaDataEntrevistaDesvinculacao)) {
            if ($novaDataEntrevistaDesvinculacao != "1970-01-01 00:00:00") {

                $conversaoNovaDataEntrevistaDesvinculacao = new DateTime($novaDataEntrevistaDesvinculacao);
                $textoNovaDataEntrevistaDesvinculacao = $conversaoNovaDataEntrevistaDesvinculacao->format('d-m-Y');

                echo "value='$textoNovaDataEntrevistaDesvinculacao'";
            }
        }

        echo " >
                            </div>
                            </div>

                     <label for='input-text' class='col-sm-2 control-label'>Data de Desvinculação</label>
                            <div class='col-sm-2'>

                                 <div class='add-on input-append date' id='dp4' data-date='2012-01-02' data-date-format='yyyy-mm-dd'>
                            <input type='text' id='date-daily2' class='form-control datepicker-input'
                             placeholder='Data de Desvinculação' name='dataDesvinculacao' ";

        if (!empty($novaDataDesvinculacao)) {
            if ($novaDataDesvinculacao != "1970-01-01 00:00:00") {

                $conversaoNovaDataDesvinculacao = new DateTime($novaDataDesvinculacao);
                $textoNovaDataDesvinculacao = $conversaoNovaDataDesvinculacao->format('d-m-Y');

                echo "value='$textoNovaDataDesvinculacao'";
            }
        }


        echo " >
                            </div>
                            </div>

                             <div class='col-sm-12'>
                             &nbsp;
                             </div>

                              <label for='input-text' class='col-sm-2 control-label'>Motivo</label>
                            <div class='col-sm-4'>

                            <textarea placeholder='Motivo de Desvinculação' name='motivoDesvinculacao'
                            rows='2' class='form-control'>";
        if(!empty($motivoDesvinculacao)){
            echo "$motivoDesvinculacao";
        }
        echo "</textarea>

                            </div>

                            <label for='input-text' class='col-sm-2 control-label'>Trabalharia novamente? Porquê?</label>
                            <div class='col-sm-4'>

                            <textarea placeholder='Trabalharia novamente na empresa? Porquê?' name='trabalhariaDesvinculacao'
                            rows='2' class='form-control'>";
        if(!empty($trabalhariaDesvinculacao)){
            echo "$trabalhariaDesvinculacao";
        }
        echo "</textarea>

                            </div>

                              <div class='col-sm-12'>
                             &nbsp;
                             </div>

                            <label for='input-text' class='col-sm-2 control-label'>Na sua opinião, o que poderia melhorar?</label>
                            <div class='col-sm-6'>

                            <textarea placeholder='Na sua opinião, o que poderia melhorar na empresa?' name='melhoriaDesvinculacao'
                            rows='2' class='form-control'>";
        if(!empty($melhoriaDesvinculacao)){
            echo "$melhoriaDesvinculacao";
        }
        echo "</textarea>

                            </div>

                            <div class='col-sm-12'>
                             &nbsp;
                             </div>

  <label for='input-text' class='col-sm-2 control-label'>Relacionamento Interpessoal</label>
   <div class='col-sm-4'>
                                              <label>
                                                <input type='radio' id='optionsRadios1' ";
        if($relacionamentoInterpessoalDesvinculacao == "Excelente"){echo "checked";}
                                                       echo " value='Excelente' name='relacionamentoInterpessoalDesvinculacao'> Excelente
                                            </label>
                                            <label>
                                                <input type='radio' name='relacionamentoInterpessoalDesvinculacao' ";
        if($relacionamentoInterpessoalDesvinculacao == "Muito Bom"){echo "checked";}
        echo " id='optionsRadios2' value='Muito Bom'> Muito Bom
                                            </label>
                                             <label>
                                                <input type='radio' name='relacionamentoInterpessoalDesvinculacao' ";
        if($relacionamentoInterpessoalDesvinculacao == "Bom"){echo "checked";}
        echo " id='optionsRadios2' value='Bom'> Bom
                                            </label>
                                             <label>
                                                <input type='radio' name='relacionamentoInterpessoalDesvinculacao' ";
            if($relacionamentoInterpessoalDesvinculacao == "Satisfaz"){echo "checked";}
            echo " id='optionsRadios2' value='Satisfaz'> Satisfaz
                                            </label>
                                             <label>
                                                <input type='radio' name='relacionamentoInterpessoalDesvinculacao' ";
                if($relacionamentoInterpessoalDesvinculacao == "Não Satisfaz"){echo "checked";}
                echo " id='optionsRadios2' value='Não Satisfaz'> Não Satisfaz
                                            </label>
                                            </div>

                                              <label for='input-text' class='col-sm-2 control-label'>Estrutura Física</label>
                                                 <div class='col-sm-4'>
                                              <label>
                                                <input type='radio' id='optionsRadios1' ";
        if($estruturaFisicaDesvinculacao == "Excelente"){echo "checked";}
                                                       echo " value='Excelente' name='estruturaFisicaDesvinculacao'> Excelente
                                            </label>
                                            <label>
                                                <input type='radio' name='estruturaFisicaDesvinculacao' ";
        if($estruturaFisicaDesvinculacao == "Muito Bom"){echo "checked";}
                                                      echo " id='optionsRadios2' value='Muito Bom'> Muito Bom
                                            </label>
                                             <label>
                                                <input type='radio' name='estruturaFisicaDesvinculacao' ";
        if($estruturaFisicaDesvinculacao == "Bom"){echo "checked";}
                                                     echo " id='optionsRadios2' value='Bom'> Bom
                                            </label>
                                             <label>
                                                <input type='radio' name='estruturaFisicaDesvinculacao' ";
        if($estruturaFisicaDesvinculacao == "Satisfaz"){echo "checked";}
                                                      echo " id='optionsRadios2' value='Satisfaz'> Satisfaz
                                            </label>
                                             <label>
                                                <input type='radio' name='estruturaFisicaDesvinculacao' ";
        if($estruturaFisicaDesvinculacao == "Não Satisfaz"){echo "checked";}
                                                       echo " id='optionsRadios2' value='Não Satisfaz'> Não Satisfaz
                                            </label>
                                            </div>
                                            <div class='col-sm-12'>
                             &nbsp;
                             </div>

     <label for='input-text' class='col-sm-2 control-label'>Valores e Normas da Empresa</label>
                                                 <div class='col-sm-4'>
                                              <label>
                                                <input type='radio' id='optionsRadios1' ";
        if($valoresNormasEmpresa == "Excelente"){echo "checked";}
                                                      echo " value='Excelente' name='valoresNormasEmpresa'> Excelente
                                            </label>
                                            <label>
                                                <input ";
        if($valoresNormasEmpresa == "Muito Bom"){echo "checked";}
        echo " type='radio' name='valoresNormasEmpresa'
                                                       id='optionsRadios2' value='Muito Bom'> Muito Bom
                                            </label>
                                             <label>
                                                <input ";
        if($valoresNormasEmpresa == "Bom"){echo "checked";}
        echo " type='radio' name='valoresNormasEmpresa'
                                                       id='optionsRadios2' value='Bom'> Bom
                                            </label>
                                             <label>
                                                <input ";
        if($valoresNormasEmpresa == "Satisfaz"){echo "checked";}
        echo " type='radio' name='valoresNormasEmpresa'
                                                       id='optionsRadios2' value='Satisfaz'> Satisfaz
                                            </label>
                                             <label>
                                                <input ";
        if($valoresNormasEmpresa == "Não Satisfaz"){echo "checked";}
        echo " type='radio' name='valoresNormasEmpresa'
                                                       id='optionsRadios2' value='Não Satisfaz'> Não Satisfaz
                                            </label>
                                            </div>

                                             <label for='input-text' class='col-sm-2 control-label'>Planeamento, Organização e Objet.</label>
                                                 <div class='col-sm-4'>
                                              <label>
                                                <input ";
        if($planeamentoOrganizacaoObjetivos == "Excelente"){echo "checked";}
        echo " type='radio' id='optionsRadios1'
                                                       value='Excelente' name='planeamentoOrganizacaoObjetivos'> Excelente
                                            </label>
                                            <label>
                                                <input ";
        if($planeamentoOrganizacaoObjetivos == "Muito Bom"){echo "checked";}
        echo " type='radio' name='planeamentoOrganizacaoObjetivos'
                                                       id='optionsRadios2' value='Muito Bom'> Muito Bom
                                            </label>
                                             <label>
                                                <input ";
        if($planeamentoOrganizacaoObjetivos == "Bom"){echo "checked";}
        echo " type='radio' name='planeamentoOrganizacaoObjetivos'
                                                       id='optionsRadios2' value='Bom'> Bom
                                            </label>
                                             <label>
                                                <input ";
        if($planeamentoOrganizacaoObjetivos == "Satisfaz"){echo "checked";}
        echo " type='radio' name='planeamentoOrganizacaoObjetivos'
                                                       id='optionsRadios2' value='Satisfaz'> Satisfaz
                                            </label>
                                             <label>
                                                <input ";
        if($planeamentoOrganizacaoObjetivos == "Não Satisfaz"){echo "checked";}
        echo " type='radio' name='planeamentoOrganizacaoObjetivos'
                                                       id='optionsRadios2' value='Não Satisfaz'> Não Satisfaz
                                            </label>
                                            </div>

                        <div class='col-sm-12'>
                             &nbsp;
                             </div>

     <label for='input-text' class='col-sm-2 control-label'>Superior Hierárquico</label>
                                                 <div class='col-sm-4'>
                                              <label>
                                                <input ";
        if($superiorHierarquico == "Excelente"){echo "checked";}
        echo " type='radio' id='optionsRadios1'
                                                       value='Excelente' name='superiorHierarquico'> Excelente
                                            </label>
                                            <label>
                                                <input ";
        if($superiorHierarquico == "Muito Bom"){echo "checked";}
        echo " type='radio' name='superiorHierarquico'
                                                       id='optionsRadios2' value='Muito Bom'> Muito Bom
                                            </label>
                                             <label>
                                                <input ";
        if($superiorHierarquico == "Bom"){echo "checked";}
        echo " type='radio' name='superiorHierarquico'
                                                       id='optionsRadios2' value='Bom'> Bom
                                            </label>
                                             <label>
                                                <input ";
        if($superiorHierarquico == "Satisfaz"){echo "checked";}
        echo " type='radio' name='superiorHierarquico'
                                                       id='optionsRadios2' value='Satisfaz'> Satisfaz
                                            </label>
                                             <label>
                                                <input ";
        if($superiorHierarquico == "Não Satisfaz"){echo "checked";}
        echo " type='radio' name='superiorHierarquico'
                                                       id='optionsRadios2' value='Não Satisfaz'> Não Satisfaz
                                            </label>
                                            </div>

                                             <label for='input-text' class='col-sm-2 control-label'>Gerência</label>
                                                 <div class='col-sm-4'>
                                              <label>
                                                <input ";
        if($gerenciaDesvinculacao == "Excelente"){echo "checked";}
        echo " type='radio' id='optionsRadios1'
                                                       value='Excelente' name='gerenciaDesvinculacao'> Excelente
                                            </label>
                                            <label>
                                                <input ";
        if($gerenciaDesvinculacao == "Muito Bom"){echo "checked";}
        echo " type='radio' name='gerenciaDesvinculacao'
                                                       id='optionsRadios2' value='Muito Bom'> Muito Bom
                                            </label>
                                             <label>
                                                <input ";
        if($gerenciaDesvinculacao == "Bom"){echo "checked";}
        echo " type='radio' name='gerenciaDesvinculacao'
                                                       id='optionsRadios2' value='Bom'> Bom
                                            </label>
                                             <label>
                                                <input ";
        if($gerenciaDesvinculacao == "Satisfaz"){echo "checked";}
        echo " type='radio' name='gerenciaDesvinculacao'
                                                       id='optionsRadios2' value='Satisfaz'> Satisfaz
                                            </label>
                                             <label>
                                                <input ";
        if($gerenciaDesvinculacao == "Não Satisfaz"){echo "checked";}
        echo " type='radio' name='gerenciaDesvinculacao'
                                                       id='optionsRadios2' value='Não Satisfaz'> Não Satisfaz
                                            </label>
                                            </div>

                                                     <div class='col-sm-12'>
                             &nbsp;
                             </div>

     <label for='input-text' class='col-sm-2 control-label'>Contrapartidas Remuneratórias</label>
                                                 <div class='col-sm-4'>
                                              <label>
                                                <input ";
        if($contrapartidasEmpresa == "Excelente"){echo "checked";}
        echo " type='radio' id='optionsRadios1'
                                                       value='Excelente' name='contrapartidasEmpresa'> Excelente
                                            </label>
                                            <label>
                                                <input ";
        if($contrapartidasEmpresa == "Muito Bom"){echo "checked";}
        echo " type='radio' name='contrapartidasEmpresa'
                                                       id='optionsRadios2' value='Muito Bom'> Muito Bom
                                            </label>
                                             <label>
                                                <input ";
        if($contrapartidasEmpresa == "Bom"){echo "checked";}
        echo " type='radio' name='contrapartidasEmpresa'
                                                       id='optionsRadios2' value='Bom'> Bom
                                            </label>
                                             <label>
                                                <input ";
        if($contrapartidasEmpresa == "Satisfaz"){echo "checked";}
        echo " type='radio' name='contrapartidasEmpresa'
                                                       id='optionsRadios2' value='Satisfaz'> Satisfaz
                                            </label>
                                             <label>
                                                <input ";
        if($contrapartidasEmpresa == "Não Satisfaz"){echo "checked";}
        echo " type='radio' name='contrapartidasEmpresa'
                                                       id='optionsRadios2' value='Não Satisfaz'> Não Satisfaz
                                            </label>
                                            </div>

                                             <label for='input-text' class='col-sm-2 control-label'>Função Exercida</label>
                                                 <div class='col-sm-4'>
                                              <label>
                                                <input ";
        if($funcaoExercida == "Excelente"){echo "checked";}
        echo " type='radio' id='optionsRadios1'
                                                       value='Excelente' name='funcaoExercida'> Excelente
                                            </label>
                                            <label>
                                                <input ";
        if($funcaoExercida == "Muito Bom"){echo "checked";}
        echo " type='radio' name='funcaoExercida'
                                                       id='optionsRadios2' value='Muito Bom'> Muito Bom
                                            </label>
                                             <label>
                                                <input ";
        if($funcaoExercida == "Bom"){echo "checked";}
        echo " type='radio' name='funcaoExercida'
                                                       id='optionsRadios2' value='Bom'> Bom
                                            </label>
                                             <label>
                                                <input ";
        if($funcaoExercida == "Satisfaz"){echo "checked";}
        echo " type='radio' name='funcaoExercida'
                                                       id='optionsRadios2' value='Satisfaz'> Satisfaz
                                            </label>
                                             <label>
                                                <input ";
        if($funcaoExercida == "Não Satisfaz"){echo "checked";}
        echo " type='radio' name='funcaoExercida'
                                                       id='optionsRadios2' value='Não Satisfaz'> Não Satisfaz
                                            </label>
                                            </div>

                                                     <div class='col-sm-12'>
                             &nbsp;
                             </div>

                              <label for='input-text' class='col-sm-2 control-label'>Comentários</label>
                            <div class='col-sm-4'>

                            <textarea placeholder='Comentários sobre a Desvincunlação' name='comentariosDesvinculacao'
                            rows='2' class='form-control'>";
        if(!empty($comentariosDesvinculacao)){
            echo "$comentariosDesvinculacao";
        }
        echo "</textarea>

                            </div>

                            <label for='input-text' class='col-sm-2 control-label'>Parecer do Entrevistador</label>
                            <div class='col-sm-4'>

                            <textarea placeholder='Parecer do Entrevistador' name='parecerDesvinculacao'
                            rows='2' class='form-control'>";
        if(!empty($parecerDesvinculacao)){
            echo "$parecerDesvinculacao";
        }
        echo "</textarea>

                            </div>

                              <div class='col-sm-12'>
                             &nbsp;
                             </div>

                               <label for='input-text' class='col-sm-2 control-label'>O colaborador pode ser readmitido?</label>
                                                 <div class='col-sm-2'>
                                              <label>
                                                <input ";
        if($readmitidoDesvinculacao == "Sim"){
            echo "checked";
        }
        echo " type='radio' id='optionsRadios1'
                                                       value='Sim' name='readmitidoDesvinculacao'> Sim
                                            </label>
                                            <label>
                                                <input ";
        if($readmitidoDesvinculacao == "Não"){
            echo "checked";
        }
        echo " type='radio' name='readmitidoDesvinculacao'
                                                       id='optionsRadios2' value='Não'> Não
                                            </label>
                                            </div>

                            <label for='input-text' class='col-sm-2 control-label'>Porquê?</label>
                            <div class='col-sm-6'>

                            <textarea placeholder='Porquê?' name='porqueDesvinculacao'
                            rows='2' class='form-control'>";
        if(!empty($porqueDesvinculacao)){
            echo "$porqueDesvinculacao";
        }
        echo "</textarea>

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