<?php session_start();

if (!isset($_SESSION['ativoAdmin'])) {
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    header("location:entrar.php?url=$actual_link");
} else {

    if (isset($_GET['comportamento'])) {

        $comportamento = $_GET['comportamento'];

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

                    <p>AND</p>

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
        <h3>Remover Comportamento</h3>

        <div>
            <p>Tem a certeza que pretende remover este comportamento do colaborador <strong><span id='alteravel'></span></strong>?</p>
            <ul>
                <li><strong>Atenção:</strong> Esta ação não pode ser revertida.
                </li>
                <li><strong>Informação:</strong> Após a confirmação da remoção, pode voltar a adicionar comportamentos ao colaborador.
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
Menus('comportamento');

        $query = "SELECT comportamentos.id_comportamentos, comportamentos.ref_id_colaborador,
comportamentos.data_comportamento, comportamentos.descricao, comportamentos.danos, comportamentos.situacao,
comportamentos.analise, comportamentos.pessoas, comportamentos.sancao, comportamentos.comentarios,
comportamentos.melhoria, comportamentos.documentos, colaborador.nome_completo, colaborador.ativo
FROM comportamentos INNER JOIN colaborador ON comportamentos.ref_id_colaborador = colaborador.id_colaborador
WHERE colaborador.ativo = 1 AND comportamentos.id_comportamentos = ?";

        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, 's', $comportamento);
        mysqli_stmt_bind_result($stmt, $idComportamento, $refIdColaborador, $dataComportamento, $descricaoComportamento,
            $danosComportamento, $situacaoComportamento, $analiseComportamento, $pessoasComportamento, $sancaoComportamento,
            $comentariosComportamento, $melhoriaComportamento, $documentosComportamento, $nomeComportamento, $ativoComportamento);
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
                <i class='fa fa-exclamation-triangle'></i> Comportamentos Não Aceitáveis</h1>

                  <div class='text-right' style='height: 73px !important; padding-top: 10px !important;'>
								<div class='row text-right'>
									<div class='col-lg-4 text-right' style='float: right!important;'>
                                        <a
                                        data-href='php/verificacoes/verificaCancelarComportamento.php?colaborador=$refIdColaborador&comportamento=$idComportamento'
                                        onclick='modalRemover($refIdColaborador);' id='botaoRemover$refIdColaborador'
                                        data-modal='md-fade-in-scale-up' class='md-trigger' data-target='#md-fade-in-scale-up'>
                                        <button type='button' class='text-right btn btn-danger btn-sm'>
										<i class='fa fa-remove'></i> Remover Comportamento</button></a>

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
               O comportamento do colaborador <b>$nomeCompletoAdicionada</b> foi editado com sucesso.<br>
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
               Ocorreu um erro ao editar o comportamento do colaborador <b>$nomeCompletoAdicionada</b>.<br>
               <a class='alert-link'>Votos de uma excelente experiência!</a></div>";
}

echo "<div class='widget'>
                <div class='widget-header transparent'>
                    <h2><strong>Editar</strong> Comportamento</h2>

                    <div class='additional-btn'>
                        <a href='#' class='hidden reload'><i class='icon-ccw-1'></i></a>
                        <a href='#' class='widget-toggle'><i class='icon-down-open-2'></i></a>

                    </div>
                </div>
                <div class='widget-content padding'>
                    <form class='form-horizontal' role='form' method='post'
                    action='php/verificacoes/verificaEditarComportamento.php?comportamento=$comportamento'>
                        <div class='form-group'>
                            <label class='col-sm-2 control-label'>Colaborador</label>

                            <div class='col-sm-10'>
                                <select class='form-control selectpicker' title='AAA'
                                name='adicionarColaboradorComportamento' required='required'>";

$query = "SELECT id_colaborador, nome_completo FROM colaborador WHERE ativo = 1";
$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_result($stmt, $idColaborador, $nomeColaborador);
mysqli_stmt_execute($stmt);

while (mysqli_stmt_fetch($stmt)) {
    echo "<option value='$idColaborador' ";
    if($idColaborador == $refIdColaborador){
        echo "selected";
    }

    echo " >$nomeColaborador</option>";
}

mysqli_stmt_close($stmt);
echo "</select>
                            </div>
                        </div>

                        <div class='form-group'>
<span style='display: none' id='titulo$refIdColaborador'>$nomeComportamento</span>
                              <label for='input-text' class='col-sm-2 control-label'>Data</label>
                            <div class='col-sm-2'>
                                <input type='text' class='form-control datepicker-input'
                                id='inputEmail' name='dataComportamento' data-mask='99-99-9999'
                                placeholder='Data do Comportamento' ";
        if(!empty($dataComportamento)){
            $conversaoDataJustificacao = new DateTime($dataComportamento);
            $textoDataJustificacao = $conversaoDataJustificacao->format('d-m-Y');
            echo "value='$textoDataJustificacao'";
        }
                            echo " >
                            </div>

                            <div class='col-sm-1'>
                            <label for='inputEmail' class='control-label'>Descrição</label>
                            </div>
                            <div class='col-sm-7'>
                                <textarea placeholder='Descrição do Comportamento' rows='2' class='form-control'
                                name='descricaoComportamento'>";
        if(!empty($descricaoComportamento)){
            echo $descricaoComportamento;
        }
        echo "</textarea>
                            </div>

                            <div class='col-sm-12'>
                            &nbsp;
                            </div>

                            <label for='input-text' class='col-sm-2 control-label'>Danos na Empresa</label>
                            <div class='col-sm-2'>
                                  <select class='form-control' name='danosComportamento'>
                                        <option selected disabled>Tipo de Danos</option>
                                        <option "; if($danosComportamento == "Património")
        {echo "selected";}

            echo " value='Património'><b>Património</b></option>
                                        <option "; if($danosComportamento == "Imagem")
        {echo "selected";}
            echo " value='Imagem'><b>Imagem</b></option>
                                        <option "; if($danosComportamento == "Relações do Trabalho")
        {echo "selected";}
            echo " value='Relações do Trabalho'><b>Relações do Trabalho</b></option>
                                        <option "; if($danosComportamento == "Funcionamento Interno")
            {echo "selected";}
       echo " value='Funcionamento Interno'><b>Funcionamento Interno</b></option>
                                </select>
                            </div>

                            <div class='col-sm-3'>
                            <label for='inputEmail' class='control-label'>Recorrente e/ou Grave&nbsp;&nbsp;</label>
                                            <label>
                                                <input type='radio' id='optionsRadios1' ";
        if($situacaoComportamento == "Sim"){echo "checked";}
                                                      echo " value='Sim' name='situacaoComportamento'> &nbsp;Sim &nbsp;&nbsp;&nbsp;
                                            </label>
                                            <label>
                                                <input type='radio' name='situacaoComportamento' ";
        if($situacaoComportamento == "Não"){echo "checked";}
                                                       echo " id='optionsRadios2' value='Não'> &nbsp;Não &nbsp;&nbsp;&nbsp;
                                            </label>
                            </div>

                             <div class='col-sm-1'>
                            <label for='inputEmail' class='control-label'>Análise Causas</label>
                            </div>
                            <div class='col-sm-4'>
                                <textarea placeholder='Análise das Causas do Comportamento' rows='2'
                                class='form-control' name='causasComportamento'>"; if(!empty($analiseComportamento))
        {echo $analiseComportamento;}
            echo "</textarea>
                            </div>

                            <div class='col-sm-12'>
                            &nbsp;
                            </div>

                              <label for='input-text' class='col-sm-2 control-label'>Pessoas a Envolver na Decisão</label>
                            <div class='col-sm-2'>
                                  <select class='form-control' onchange='apresentacaInputTexto();'
                                  name='";
        if(($pessoasComportamento != "Administração") AND ($pessoasComportamento != "Apoio Jurídico")
            AND ($pessoasComportamento != "DRH"))   {}else{echo "pessoasDecisaoComportamento";}
         echo "' id='pessoasDecisao'>
                                        <option selected disabled>Pessoas a Envolver</option>
                                        <option "; if($pessoasComportamento == "Administração")
        {echo "selected";}
            echo " value='Administração'><b>Administração</b></option>
                                        <option "; if($pessoasComportamento == "Apoio Jurídico")
        {echo "selected";}
            echo " value='Apoio Jurídico'><b>Apoio Jurídico</b></option>
                                        <option "; if($pessoasComportamento == "DRH")
        {echo "selected";}
           echo " value='DRH'><b>DRH</b></option>
                                        <option ";
        if(($pessoasComportamento != "Administração") AND ($pessoasComportamento != "Apoio Jurídico")
            AND ($pessoasComportamento != "DRH"))   {echo "selected";}

        echo " value='Outro'><b>Outro</b></option>
                                </select>
                            </div>

                             <div class='col-sm-2' id='outroPessoasDecisao' ";

        if(($pessoasComportamento != "Administração") AND ($pessoasComportamento != "Apoio Jurídico")
            AND ($pessoasComportamento != "DRH"))   {echo "style='display: block'";}else{
            echo "style='display: none'";
        }

        echo " >
                                    <input name='";
        if(($pessoasComportamento != "Administração") AND ($pessoasComportamento != "Apoio Jurídico")
            AND ($pessoasComportamento != "DRH"))   {echo "pessoasDecisaoComportamento";}else{}
        echo "' type='text' class='form-control' placeholder='Pessoas a Envolver'
                                    id='idPessoasDecisao' ";
        if(($pessoasComportamento != "Administração") AND ($pessoasComportamento != "Apoio Jurídico")
            AND ($pessoasComportamento != "DRH"))   {echo "value='$pessoasComportamento'";}
        echo " >
                                </div>


                                    <label for='input-text' class='col-sm-1 control-label'>Tipo de Sanção</label>
                            <div class='col-sm-2'>
                                  <select class='form-control' onchange='sancaoInputTexto();'
                                  name='"; if(($sancaoComportamento != "Verbal") AND ($sancaoComportamento != "Escrita"))
        {}else{echo "sancaoComportamento";} echo "' id='sancao'>
                                        <option selected disabled>Sanção</option>
                                        <option ";
        if($sancaoComportamento == "Verbal")
        {echo "selected";}
        echo " value='Verbal'><b>Verbal</b></option>
                                        <option ";
        if($sancaoComportamento == "Escrita")
        {echo "selected";}
        echo " value='Escrita'><b>Escrita</b></option>
                                        <option ";
        if(($sancaoComportamento != "Verbal") AND ($sancaoComportamento != "Escrita"))
        {echo "selected";}
        echo " value='Outro'><b>Outro</b></option>
                                </select>
                            </div>

                             <div class='col-sm-2' id='outroSancao' ";
        if(($sancaoComportamento != "Verbal") AND ($sancaoComportamento != "Escrita"))
        {echo "style='display: block'";}else{
            echo "style='display: none'";
        }
        echo " > <input name='"; if(($sancaoComportamento != "Verbal") AND ($sancaoComportamento != "Escrita"))
        {echo "sancaoComportamento";}else{}
        echo "' type='text' class='form-control' ";
        if(($sancaoComportamento != "Verbal") AND ($sancaoComportamento != "Escrita"))
        {echo "value='$sancaoComportamento'";}
                                    echo " id='idSancao' placeholder='Sanção'>
                            </div>

                            <div class='col-sm-12'>
                            &nbsp;
                            </div>


                            <label for='inputEmail' class='control-label col-sm-2'>Comentários</label>
                            <div class='col-sm-3'>
                                <textarea placeholder='Comentários do Comportamento' rows='2' class='form-control'
                                name='comentariosComportamento'>"; if(!empty($comentariosComportamento)){echo $comentariosComportamento;}
        echo "</textarea>
                            </div>

                            <div class='col-sm-3'>
                            <label for='inputEmail' class='control-label'>Oportunidade de Melhoria&nbsp;&nbsp;</label>
                                            <label>
                                                <input type='radio' id='optionsRadios1' ";
        if($melhoriaComportamento == "Sim"){echo "checked";}
                                                      echo " value='Sim' name='oportunidadeComportamento'> &nbsp;Sim &nbsp;&nbsp;&nbsp;
                                            </label>
                                            <label>
                                                <input type='radio' name='oportunidadeComportamento' ";
        if($melhoriaComportamento == "Não"){echo "checked";}
                                                      echo " id='optionsRadios2' value='Não'> &nbsp;Não &nbsp;&nbsp;&nbsp;
                                            </label>
                            </div>

                            <label for='inputEmail' class='control-label col-sm-1'>Docs. Anexos</label>
                            <div class='col-sm-3'>
                                <textarea placeholder='Documentos Anexos do Comportamento' rows='2'
                                class='form-control' name='documentosComportamento'>"; if(!empty($documentosComportamento)){
            echo $documentosComportamento;} echo "</textarea>
                            </div>

                        </div>

<script>

function sancaoInputTexto(){

if(document.getElementById('sancao').value == 'Outro'){

document.getElementById('outroSancao').style.display='block';
   $('#sancao').attr('name', '');
   $('#idSancao').attr('name', 'sancaoComportamento');

}else{

document.getElementById('outroSancao').style.display='none';
$('#sancao').attr('name', 'sancaoComportamento');
 $('#idSancao').attr('name', '');

}

}

function apresentacaInputTexto(){

if(document.getElementById('pessoasDecisao').value == 'Outro'){

document.getElementById('outroPessoasDecisao').style.display='block';
   $('#pessoasDecisao').attr('name', '');
   $('#idPessoasDecisao').attr('name', 'pessoasDecisaoComportamento');

}else{

document.getElementById('outroPessoasDecisao').style.display='none';
$('#pessoasDecisao').attr('name', 'pessoasDecisaoComportamento');
 $('#idPessoasDecisao').attr('name', '');

}

}

</script>

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