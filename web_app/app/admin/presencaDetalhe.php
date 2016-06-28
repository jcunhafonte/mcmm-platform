<?php session_start();

if ((!isset($_SESSION['ativoAdmin']))) {

    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    header("location:entrar.php?url=$actual_link");

} else {

    if ((!isset($_GET['colaborador']) AND (!isset($_GET['mesPresenca'])))) {
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
<!-- Modal End -->";

$query = "SELECT nome_completo FROM colaborador WHERE id_colaborador = ?";
$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_param($stmt, 'i', $_GET['colaborador']);
mysqli_stmt_bind_result($stmt, $nomeApresenta);
mysqli_stmt_execute($stmt);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

echo "<!-- Modal fade in scale up -->
<div class='md-modal md-fade-in-scale-up' id='md-fade-in-scale-up'>
    <div class='md-content'>
        <h3>Remover Presença</h3>

        <div>
            <p>Tem a certeza que pretende remover esta presença do colaborador <strong><span id='alteravel'>$nomeApresenta</span></strong> do dia <strong><span id='dataAlteravel'></span></strong>?</p>
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
Menus('presencas');

echo "<!-- Start right content -->
    <div class='content-page'>
        <!-- ============================================================== -->
        <!-- Start Content here -->
        <!-- ============================================================== -->
        <div class='content'>
            <!-- Page Heading Start -->
            <div class='page-heading'>
                <h1><i class='fa fa-hand-o-up'></i> Detalhes de Presenças</h1>
            </div>
            <!-- Page Heading End-->

            <!-- Your awesome content goes here -->
            <div class='row'>

                <div class='col-sm-12 portlets'>";

$mes = $_GET['mesPresenca'];
$ano = $_GET['anoPresenca'];
$colaborador = $_GET['colaborador'];

   $mes_extenso = array(
        1 => 'Janeiro',
        2 => 'Fevereiro',
        3 => 'Março',
        4 => 'Abril',
        5 => 'Maio',
        6 => 'Junho',
        7 => 'Julho',
        8 => 'Agosto',
        9 => 'Setembro',
        10 => 'Outubro',
        11 => 'Novembro',
        12 => 'Dezembro'
    );


if (isset($_GET['sucesso'])) {

    $dataSucesso = $_GET['sucesso'];

    echo "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
               A presença do dia <b>"; echo $_GET['data']; echo "</b> do seu colaborador foi removida com sucesso.<br>
               <a class='alert-link'>Votos de uma excelente experiência!</a></div>";
}

if (isset($_GET['erro'])) {

    $dataSucesso = $_GET['erro'];

    echo "<div class='alert alert-danger alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
               Não foi possível remover a presença do dia <b>"; echo $_GET['data']; echo "</b> do seu colaborador.<br>
               <a class='alert-link'>Votos de uma excelente experiência!</a></div>";
}

    echo "<div class='widget'>
                        <div class='widget-header'>
                            <h2><strong>$nomeApresenta</strong> - $mes_extenso[$mes] de $ano</h2>

                            <div class='additional-btn'>
                                <a href='#' class='hidden reload'><i class='icon-ccw-1'></i></a>
                                <a href='#' class='widget-toggle'><i class='icon-down-open-2'></i></a>

                            </div>
                        </div>
                        <div class='widget-content padding'>
                            <table id='user' class='table table-bordered table-striped' style='clear: both'>
                                <tbody>
                                 <thead>
                                        <tr>
                                            <th>Data de Presença</th>
                                            <th class='text-center'>Remover Presença</th>
                                        </tr>
                                        </thead>";

    $query = "SELECT id_presencas, data_presenca FROM presencas WHERE (ref_id_colaborador = ?) AND
(MONTH(data_presenca ) = ?) AND (YEAR(data_presenca) = ?) ORDER BY data_presenca ASC";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'iii', $_GET['colaborador'], $mes, $ano);

    mysqli_stmt_bind_result($stmt, $idPresencas, $dataPresencas);
    mysqli_stmt_execute($stmt);

    while (mysqli_stmt_fetch($stmt)) {

        $conversaoDataPresencas = new DateTime($dataPresencas);
        $textoConversaoDataPresencas = $conversaoDataPresencas->format('d-m-Y');

        echo "<tr>";
                                    echo "<td width='45%' id='tituloData$idPresencas'>$textoConversaoDataPresencas</td>
                                      <td width='10%' class='text-center'>
                                          <div class='btn-group btn-group-xs text-center'>
                                                <a data-href='php/verificacoes/verificarRemoverPresenca.php?presenca=$idPresencas&mesPresenca=$mes&anoPresenca=$ano&colaborador=$colaborador&data=$textoConversaoDataPresencas' data-toggle='tooltip' title='Remover Presença
                                                 - $textoConversaoDataPresencas' class='md-trigger text-center btn btn-default'
                                                   onclick='modalRemover($idPresencas);'id='botaoRemover$idPresencas'
 data-target='#md-fade-in-scale-up'  data-modal='md-fade-in-scale-up'
                                                 >
                                                 <i class='fa fa-remove fa-1x'></i></a>
                                                </div>
                                      </td>";
        echo "</tr>";
    }

    mysqli_stmt_close($stmt);
    echo "</tbody>
                            </table>
                        </div>
                    </div>";


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

//        var titulo = '';
//        titulo = document.getElementById('titulo'+param).innerHTML;
//        document.getElementById('alteravel').innerHTML = titulo;

        var tituloData = '';
        tituloData = document.getElementById('tituloData'+param).innerHTML;
        document.getElementById('dataAlteravel').innerHTML = tituloData;

    };
</script>

</body>
</html>";