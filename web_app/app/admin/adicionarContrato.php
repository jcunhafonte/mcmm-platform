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
<!-- Begin page -->
<div id='wrapper'>";

require_once('php/includes/menus.php');
Menus('colaboradores', 'registoContrato');


echo "<!-- Start right content -->
    <div class='content-page'>
        <!-- ============================================================== -->
        <!-- Start Content here -->
        <!-- ============================================================== -->
        <div class='content'>
            <!-- Page Heading Start -->
            <div class='page-heading'>
                <h1><i class='fa fa-user-plus'></i>&nbsp; Renovar Contrato</h1>
                 <h3>O contrato atual do colaborador será descartado e o perfil será atualizado com os novos dados introduzidos</h3>
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
               O contrato do colaborador <b>$nomeCompletoAdicionada</b> foi renovado com sucesso.<br>
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
               Ocorreu um erro ao renovar o contrato do colaborador <b>$nomeCompletoAdicionada</b>.<br>
               <a class='alert-link'>Votos de uma excelente experiência!</a></div>";
}

echo "<div class='widget'>
                <div class='widget-header transparent'>
                    <h2><strong>Renovar</strong> Contrato</h2>

                    <div class='additional-btn'>
                        <a href='#' class='hidden reload'><i class='icon-ccw-1'></i></a>
                        <a href='#' class='widget-toggle'><i class='icon-down-open-2'></i></a>

                    </div>
                </div>
                <div class='widget-content padding'>
                    <form class='form-horizontal' role='form' method='post'
                    action='php/verificacoes/verificaAdicionarContrato.php'>
                        <div class='form-group'>
                            <label class='col-sm-2 control-label'>Colaborador</label>

                            <div class='col-sm-10'>
                                <select class='form-control selectpicker'
                                name='adicionarNomeContrato' required='required'>
                                <option disabled selected value=''>Colaborador</option>";

$query = "SELECT id_colaborador, nome_completo FROM colaborador WHERE ativo = 1";
$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_result($stmt, $idColaborador, $nomeColaborador);
mysqli_stmt_execute($stmt);

while (mysqli_stmt_fetch($stmt)) {
    echo "<option value='$idColaborador'>$nomeColaborador</option>";
}

mysqli_stmt_close($stmt);
echo "</select>
                            </div>
                        </div>

                        <div class='form-group'>

                            <label for='input-text' class='col-sm-2 control-label'>Função</label>
                             <div class='col-sm-2'>

                                            <select id='pessoasDecisao' class='form-control' name='funcaoColaborador' onchange='apresentacaInputTexto();'>
                                            <option selected disabled>Função</option>
                                            <option value='Ajudante'><b>Ajudante</b></option>
                                            <option value='Distribuição'><b>Distribuição</b></option>
                                            <option value='Escritório'><b>Escritório</b></option>
                                            <option value='Técnico de Vendas'><b>Técnico de Vendas</b></option>
                                            <option value='Outro'><b>Outro</b></option>
                                            </select>

                                </div>

                                <div id='outroPessoasDecisao' style='display: none'>
                                            <label for='input-text' class='col-sm-1 control-label'>Qual?</label>
                                            <div class='col-sm-2'>
                                            <input name='' type='text' class='form-control'
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
                                 autocomplete='on' class='form-control' name='categoriaColaborador'>
                             </div>

                                <div class='col-sm-12'>&nbsp;</div>

                    <label for='input-text' class='col-sm-2 control-label'>Área do Posto de Trabalho</label>
                    <div class='col-sm-2'>

                        <select class='form-control' name='postoTrabalhoColaborador'>
                                                <option selected disabled>Posto de Trabalho</option>
                                                <option value='Escritório'>Escritório</option>
                                                <option value='DAL'>DAL</option>
                                                <option value='Força de Vendas Aveiro'>Força de Vendas Aveiro</option>
                                                <option value='Força de Vendas Ovar'>Força de Vendas Ovar</option>
                                                <option value='Força de Vendas Viseu'>Força de Vendas Viseu</option>
                                                <option value='SDD'>SDD</option>
                                            </select>
                                   </div>

<label for='input-text' class='col-sm-1 control-label'>Sit. Contratual</label>
                    <div class='col-sm-2'>
                         <select class='form-control' name='situacaoContratualColaborador'>
                                                <option selected disabled>Situação Contratual</option>
                                                <option value='Quadro'>Quadro</option>
                                                <option value='Termo'>Termo</option>
                                                <option value='Sem Termo'>Sem Termo</option>
                                            </select>
                    </div>


                     <label for='input-text' class='col-sm-1 control-label'>D. de Admissão</label>
                            <div class='col-sm-2'>

                                 <div class='add-on input-append date' id='dp4' data-date='2012-01-02' data-date-format='yyyy-mm-dd'>
                            <input type='text' id='date-daily2' class='form-control datepicker-input'
                             placeholder='Data de Admissão' name='dataAdmissao'>
                            </div>
                            </div>

                        <label for='input-text' class='col-sm-1 control-label'>P. Experimental</label>
                             <div class='col-sm-1'>
                                 <input type='number' id='inputEmail' placeholder='Dia(s)'
                                 autocomplete='on' class='form-control' name='periodoExperimentalColaborador'>
                             </div>

                             <div class='col-sm-12'>
                             &nbsp;
                             </div>

                              <label for='input-text' class='col-sm-2 control-label'>D. Final do Per. Experimental</label>
                            <div class='col-sm-2'>

                                 <div class='add-on input-append date' id='dp4' data-date='2012-01-02' data-date-format='yyyy-mm-dd'>
                            <input type='text' id='date-daily2' class='form-control datepicker-input'
                             placeholder='Data Final do Período Experimental' name='dataFinalPeriodoExperimentalColaborador'>
                            </div>
                            </div>

                            <label for='input-text' class='col-sm-1 control-label'>Nº Horas Sem.</label>
                             <div class='col-sm-2'>
                                 <input type='number' id='inputEmail' placeholder='Horas Semanais'
                                 autocomplete='on' class='form-control' name='horasSemanaisColaborador'>
                             </div>

  <label for='input-text' class='col-sm-1 control-label'>Nº Horas Diárias</label>
                             <div class='col-sm-2'>
                                 <input type='number' id='inputEmail' placeholder='Horas Diárias'
                                 autocomplete='on' class='form-control' name='horasDiariasColaborador'>
                             </div>

                              <div class='col-sm-12'>
                             &nbsp;
                             </div>

  <label for='input-text' class='col-sm-2 control-label'>Descanso Complementar - Sábado</label>
   <div class='col-sm-2'>
  <label>
                                                <input type='radio' id='optionsRadios1'
                                                       value='Sim' name='descansoComplementarColaborador'
                                                       > Sim
                                            </label>
                                            <label>
                                                <input type='radio' name='descansoComplementarColaborador'
                                                       id='optionsRadios2' value='Não'> Não
                                            </label>
</div>

                                <label for='input-text' class='col-sm-1 control-label'>Sistema Rotativo</label>
                                   <div class='col-sm-1'>
                                  <label>
                                                <input type='radio' id='optionsRadios1'
                                                       value='Sim' name='sistemaRotativoColaborador'
                                                       > Sim
                                            </label>
                                            <label>
                                                <input type='radio' name='sistemaRotativoColaborador'
                                                       id='optionsRadios2' value='Não'> Não
                                            </label>
</div>


  <label for='input-text' class='col-sm-1 control-label'>NIB</label>
                             <div class='col-sm-5'>
                                 <input type='number' id='inputEmail' placeholder='NIB'
                                 autocomplete='on' class='form-control' name='NIBColaborador'>
                             </div>

    <div class='col-sm-12'>
                             &nbsp;
                             </div>

  <label for='input-text' class='col-sm-2 control-label'>Instituição Bancária</label>
                             <div class='col-sm-2'>
                                 <input type='text' id='inputEmail' placeholder='Instituição Bancária'
                                 autocomplete='on' class='form-control' name='isntBancariaColaborador'>
                             </div>

  <label for='input-text' class='col-sm-1 control-label'>Agência</label>
                             <div class='col-sm-2'>
                                 <input type='text' id='inputEmail' placeholder='Agência'
                                 autocomplete='on' class='form-control' name='agenciaColaborador'>
                             </div>


                               <label for='input-text' class='col-sm-1 control-label'>Venc. Base</label>
                             <div class='col-sm-1'>
                                 <input type='text' id='inputEmail' placeholder='Vencimento' data-mask='999.99€'
                                 autocomplete='on' class='form-control' name='vencBaseColaborador'>
                             </div>

                              <label for='input-text' class='col-sm-1 control-label'>Data Final do Contr. de Trab.</label>
                             <div class='col-sm-2'>
                                  <div class='add-on input-append date' id='dp4' data-date='2012-01-02' data-date-format='yyyy-mm-dd'>
                            <input type='text' id='date-daily2' class='form-control datepicker-input'
                             placeholder='Data Final do Contrato de Trabalho' name='dataFinalContratoColaborador'>
                            </div>
                             </div>

                        </div>

                        <div class='form-group'>

                            <div class='col-sm-2'>
                                &nbsp;
                            </div>
                            <div class='col-sm-10'>
                                <button type='submit' style='width: 100% !important;'
                                class='btn btn-default input-block-level'>Renovar</button>
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
<script src='assets/libs/summernote/summernote.js'></script>
<script src='assets/js/pages/forms.js'></script>
</body>
</html>";