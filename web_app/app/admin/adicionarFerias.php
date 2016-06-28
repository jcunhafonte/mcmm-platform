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
Menus('ferias', 'adicionarFerias', 'ferias');


echo "<!-- Start right content -->
    <div class='content-page'>
        <!-- ============================================================== -->
        <!-- Start Content here -->
        <!-- ============================================================== -->
        <div class='content'>
            <!-- Page Heading Start -->
            <div class='page-heading'>
                <h1><i class='fa fa-plane'></i>&nbsp; Férias</h1>
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
               As férias do colaborador <b>$nomeCompletoAdicionada</b> foram registadas com sucesso.<br>
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
               Ocorreu um erro ao registar as férias ao colaborador <b>$nomeCompletoAdicionada</b>.<br>
               <a class='alert-link'>Votos de uma excelente experiência!</a></div>";
}

echo "<div class='widget'>
                <div class='widget-header transparent'>
                    <h2><strong>Registar</strong> Férias</h2>

                    <div class='additional-btn'>
                        <a href='#' class='hidden reload'><i class='icon-ccw-1'></i></a>
                        <a href='#' class='widget-toggle'><i class='icon-down-open-2'></i></a>

                    </div>
                </div>
                <div class='widget-content padding'>
                    <form class='form-horizontal' role='form' method='post'
                    action='php/verificacoes/verificaAdicionarFerias.php'>
                        <div class='form-group'>
                            <label class='col-sm-2 control-label'>Colaborador</label>

                            <div class='col-sm-6'>
                                <select class='form-control selectpicker' id='feriasColaborador'
                                name='adicionarNomeFerias' required='required'>
                                <option disabled selected value='0'>Colaborador</option>";

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

                                 <label for='input-text' class='col-sm-2 control-label'>Dias de Férias Disponíveis</label>
                            <div class='col-sm-2'>
                               <label for='input-text' class='control-label'
                               style='font-weight: normal !important;'>
                               <span id='feriasColaboradorA'>Selecione um colaborador</span>
                               <span id='diasColaborador'></span></label>
                            </div>

                        </div>

                        <div class='form-group'>

                            <label for='input-text' class='col-sm-2 control-label'>Data - Início das Férias</label>
                            <div class='col-sm-2'>

                            <div class='add-on input-append date' id='dp3' data-date='2012-01-02' data-date-format='yyyy-mm-dd'>
                            <input type='text' id='date-daily1' class='form-control datepicker-input'
                             placeholder='Início das Férias' name='dataInicioFerias'>
                            </div>

                            </div>

                            <label for='input-text' class='col-sm-2 control-label'>Data - Fim das Férias</label>
                            <div class='col-sm-2'>

                                 <div class='add-on input-append date' id='dp4' data-date='2012-01-02' data-date-format='yyyy-mm-dd'>
                            <input type='text' id='date-daily2' class='form-control datepicker-input'
                             placeholder='Fim das Férias' name='dataFimFerias'>
                            </div>

                            </div>

                        </div>

                        <div class='form-group' id='botaoRegistarFerias'>

                            <div class='col-sm-2'>
                                &nbsp;
                            </div>
                            <div class='col-sm-10'>
                                <button type='submit' style='width: 100% !important;'
                                class='btn btn-default input-block-level'>Registar</button>
                            </div>

                        </div>

                    </form>
                </div>"; ?>

<div id="escondidaNomes" style="display: none !important;">
    <?php
    $query = "SELECT id_colaborador, nome_completo FROM colaborador WHERE ativo = 1";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_result($stmt, $idColaborador, $nomeColaborador);
    mysqli_stmt_execute($stmt);

    while (mysqli_stmt_fetch($stmt)) {
        echo "<span id='colaboradorNome$idColaborador'>$nomeColaborador</span>";
    }
    mysqli_stmt_close($stmt);
    ?>

    <div id="numeroColaboresFerias"></div>
    <div id="diasRestantesColaboresFerias"></div>

</div>

<?php echo "</div>
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
<!-- Page Specific JS Libraries -->
	<script src='assets/libs/jquery-notifyjs/notify.min.js'></script>
	<script src='assets/libs/jquery-notifyjs/styles/metro/notify-metro.js'></script>
	<script src='assets/js/pages/notifications.js'></script>";
?>

<script>

    var intervaloFerias;

    $('#dp3').datepicker().on('changeDate', function (ev) {
        $('#date-daily1').change();
    });
    $('#date-daily1').change(function () {
        verificaDataFerias();
    });

    $('#dp4').datepicker().on('changeDate', function (ev) {
        $('#date-daily2').change();
    });
    $('#date-daily2').change(function () {
        verificaDataFerias();
    });

    var teste = 0;

    function verificaDataFerias() {
        if ((document.getElementById('date-daily1').value > "")
            && (document.getElementById('date-daily2').value > "")) {

            $('#numeroColaboresFerias').load('php/funcoes/obterColaboradoresPeriodoFerias.php?' +
            'choice1=' + $('#date-daily1').val() + '&choice2=' + $('#date-daily2').val()
            + '&choice3=' + $('#feriasColaborador').val());

            $('#diasRestantesColaboresFerias').load('php/funcoes/obterColaboradoresPeriodoFerias2.php?' +
            'choice1=' + $('#date-daily1').val() + '&choice2=' + $('#date-daily2').val()
            + '&choice3=' + $('#feriasColaborador').val());

            intervaloFerias = setInterval(verificacaoFerias, 250);

        } else {
            //Não faz nada
        }
    }

    function verificacaoFerias() {

        teste = document.getElementById('numeroFeriasColaboradores').value;

        if (teste >= numeroColabSimultaneo) {
            clearInterval(intervaloFerias);
            notify5('warning');
            resultadoDiasColaborador();
            document.getElementById('botaoRegistarFerias').style.display = 'none';

        } else {

            if (document.getElementById('feriasColaboradorA').innerHTML) {
                clearInterval(intervaloFerias);
                notify6('success');
                document.getElementById('botaoRegistarFerias').style.display = 'block';

                resultadoDiasColaborador();
            }
        }
    }

    function resultadoDiasColaborador() {

        var valor1 = 0;
        var valor2 = 0;
        var valor3 = 0;

        var idColaborador = document.getElementById('feriasColaborador').value;
        numeroFeriasDisponiveis(idColaborador);

        if (parseInt(document.getElementById('feriasColaborador').value) > 0) {

            valor1 = parseInt(document.getElementById('feriasColaboradorA').innerHTML);
            valor2 = document.getElementById('numeroDiasRestantesColaboradores').value;

            valor3 = parseInt(valor1) - parseInt(valor2);

            document.getElementById('feriasColaboradorA').innerHTML = "" + valor3 + "";

            if (document.getElementById('feriasColaboradorA').innerHTML == 1) {
                document.getElementById('diasColaborador').innerHTML = "Dia";
            } else {
                document.getElementById('diasColaborador').innerHTML = "Dias";
            }

            if (document.getElementById('feriasColaboradorA').innerHTML == 0) {

                document.getElementById('feriasColaboradorA').innerHTML = 'Este colaborador não tem mais dias disponíveis';
                document.getElementById('diasColaborador').innerHTML = '';

            }

            if (valor3 < 0) {

                document.getElementById('feriasColaboradorA').innerHTML = 'Impossível registar mais dias';
                document.getElementById('diasColaborador').innerHTML = '';
                notify('error');
                document.getElementById('botaoRegistarFerias').style.display = 'none';

                var referenciaColaborador = '';
                referenciaColaborador = document.getElementById('feriasColaborador').value;

                var nomeColaborador = '';
                nomeColaborador = document.getElementById('colaboradorNome' + referenciaColaborador).innerHTML;

            }

        }

    }
</script>

<script>

    $(document).ready(function () {

        $('#wrapper').toggleClass('open-right-sidebar');
        //e.stopPropagation();
        $('body').trigger('resize');

    });

</script>
<script>

    <?php

 //SELECT ULTIMO ID
$query2 = "SELECT numero FROM ferias_simultaneo";

$stmt2 = mysqli_prepare($link2, $query2);
mysqli_stmt_bind_result($stmt2, $numeroSimultaneo);
mysqli_stmt_execute($stmt2);
mysqli_stmt_fetch($stmt2);
mysqli_stmt_close($stmt2);

    $numeroSimultaneo = (int) $numeroSimultaneo;

        echo "var numeroColabSimultaneo = $numeroSimultaneo;

        ";

    //SELECT ULTIMO ID
$query2 = "SELECT numero FROM dias_ferias";

$stmt2 = mysqli_prepare($link2, $query2);
mysqli_stmt_bind_result($stmt2, $numeroFerias);
mysqli_stmt_execute($stmt2);
mysqli_stmt_fetch($stmt2);
mysqli_stmt_close($stmt2);

    $numeroFerias = (int) $numeroFerias;

        echo "var numeroDiasFeriasColaboradores = $numeroFerias;

        ";


        $query2 = "SELECT id_colaborador FROM colaborador WHERE ativo = 1 ORDER BY id_colaborador ASC";
$stmt2 = mysqli_prepare($link2, $query2);
mysqli_stmt_bind_result($stmt2, $idColaboradorFerias);
mysqli_stmt_execute($stmt2);
while(mysqli_stmt_fetch($stmt2)){
     echo "var ferias$idColaboradorFerias = numeroDiasFeriasColaboradores;

     ";
     }
mysqli_stmt_close($stmt2);

function getWorkingDays($startDate, $endDate)
{

    $hostname = "localhost";
    $username = "bentoena_RH123";
    $password = "bentoena_RH123";
    $bd = "bentoena_RH";

    $link = mysqli_connect($hostname, $username, $password, $bd);
    mysqli_set_charset($link,"utf8");

    $contaDias = false;
    $begin = strtotime($startDate);
    $end = strtotime($endDate);

    if ($begin > $end) {

        echo "startdate is in the future! <br />";
        return 0;

    } else {

        $no_days = 0;
        $weekends = 0;

        while ($begin <= $end) {

            $contaDias = false;
            $no_days++; // no of days in the given interval
            $what_day = date("N", $begin);

            //SELECT DIAS
            $query = "SELECT id_nao_uteis, descricao, data_dia FROM nao_uteis ORDER BY data_dia ASC";

            $stmt = mysqli_prepare($link, $query);
            mysqli_stmt_bind_result($stmt, $idNaoUtil, $descricao, $dataDia);
            mysqli_stmt_execute($stmt);

            while (mysqli_stmt_fetch($stmt)) {

                $conversaoDataAcidente = new DateTime($dataDia);
                $textoDataAcidente = $conversaoDataAcidente->format('Y-m-d');

                if ($startDate == $textoDataAcidente) {
                    $weekends++;
                    $contaDias = true;
                }
            }
            mysqli_stmt_close($stmt);

            if ($contaDias == false) {

                if ($what_day > 5) { // 6 and 7 are weekend days
                    $weekends++;
                };

            }

            $begin += 86400; // +1 day

            $startDate = strtotime("+1 day", strtotime($startDate));
            $startDate = date("Y-m-d", $startDate);

        };
        $working_days = $no_days - $weekends;

        return $working_days;
    }
}

$query2 = "SELECT id_colaborador FROM colaborador WHERE ativo = 1 ORDER BY id_colaborador ASC";
$stmt2 = mysqli_prepare($link2, $query2);
mysqli_stmt_bind_result($stmt2, $idColaboradorFerias);
mysqli_stmt_execute($stmt2);

while(mysqli_stmt_fetch($stmt2)){

  $query = "SELECT inicio_ferias, fim_ferias, ref_id_colaborador FROM ferias
WHERE YEAR( inicio_ferias ) = ? AND ref_id_colaborador = ?";

        $anoAtual = date('Y');
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, 'is', $anoAtual, $idColaboradorFerias);
        mysqli_stmt_bind_result($stmt, $dataInicioFerias, $dataFimFerias, $idColaborador);
        mysqli_stmt_execute($stmt);

    while (mysqli_stmt_fetch($stmt)) {

    $nr_work_days = getWorkingDays($dataInicioFerias, $dataFimFerias);
    echo "ferias$idColaborador =  ferias$idColaborador - $nr_work_days;

    ";
    }

mysqli_stmt_close($stmt);

}

mysqli_stmt_close($stmt2);

    ?>


    $('#feriasColaborador').on('change', function () {
        var idColaborador = this.value;
        numeroFeriasDisponiveis(idColaborador);
    });

    function numeroFeriasDisponiveis(param) {

        var num = 0;
        num = param;

        <?php

 $query2 = "SELECT id_colaborador FROM colaborador WHERE ativo = 1 ORDER BY id_colaborador ASC";
$stmt2 = mysqli_prepare($link2, $query2);
mysqli_stmt_bind_result($stmt2, $idColaboradorFerias);
mysqli_stmt_execute($stmt2);

         while(mysqli_stmt_fetch($stmt2)){

        echo "if(num == $idColaboradorFerias){

                numeroFeriasDisponiveis$idColaboradorFerias();
}
            ";
            }

mysqli_stmt_close($stmt2);

 ?>

    }

</script>
<script>

    <?php
    $query2 = "SELECT id_colaborador FROM colaborador WHERE ativo = 1 ORDER BY id_colaborador ASC";
    $stmt2 = mysqli_prepare($link2, $query2);
    mysqli_stmt_bind_result($stmt2, $idColaboradorFerias);
    mysqli_stmt_execute($stmt2);
    while(mysqli_stmt_fetch($stmt2)){

        ?>

    function numeroFeriasDisponiveis<?php echo "$idColaboradorFerias"; ?>() {

        document.getElementById('botaoRegistarFerias').style.display = 'block';
        document.getElementById('feriasColaboradorA').innerHTML = '';
        document.getElementById('feriasColaboradorA').innerHTML = <?php echo "ferias$idColaboradorFerias"; ?>;

        if (document.getElementById('feriasColaboradorA').innerHTML == "1") {
            document.getElementById('diasColaborador').innerHTML = "Dia";
        } else {
            document.getElementById('diasColaborador').innerHTML = "Dias";
        }

        if (document.getElementById('feriasColaboradorA').innerHTML == "0") {

            document.getElementById('feriasColaboradorA').innerHTML = 'Este colaborador não tem mais dias disponíveis';
            document.getElementById('diasColaborador').innerHTML = '';

        }

        if (document.getElementById('feriasColaboradorA').innerHTML < "0") {

            document.getElementById('feriasColaboradorA').innerHTML = 'Impossível registar mais dias';
            document.getElementById('diasColaborador').innerHTML = '';
            notify('error');
            document.getElementById('botaoRegistarFerias').style.display = 'none';

            var nomeColaborador = '';
            nomeColaborador = document.getElementById('colaboradorNome<?php echo "$idColaboradorFerias"; ?>').innerHTML;

            document.getElementById('colaboradorNomeNot').innerHTML = nomeColaborador;

        }

    }

    <?php

        }
        mysqli_stmt_close($stmt2);

        ?>

</script>
<!-- Extra CSS Libraries Start -->
<link href='assets/libs/jquery-notifyjs/styles/metro/notify-metro.css' rel='stylesheet' type='text/css'/>
<link href='assets/css/style.css' rel='stylesheet' type='text/css'/>

</body>
</html>