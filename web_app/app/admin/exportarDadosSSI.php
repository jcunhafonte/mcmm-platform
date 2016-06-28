<?php

session_start();

if (!isset($_SESSION['ativoAdmin'])) {
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    header("location:entrar.php?url=$actual_link");
}

require_once('php/connection/dbconnection.php');

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
   <title>BN, Lda - Relatório SSI</title>
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
    <link href="assets/libs/jqueryui/ui-lightness/jquery-ui-1.10.4.custom.min.css" rel="stylesheet"/>
    <link href="assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="assets/libs/font-awesome/css/font-awesome.min.css" rel="stylesheet"/>
    <link href="assets/libs/fontello/css/fontello.css" rel="stylesheet"/>
    <link href="assets/libs/animate-css/animate.min.css" rel="stylesheet"/>
    <link href="assets/libs/nifty-modal/css/component.css" rel="stylesheet"/>
    <link href="assets/libs/magnific-popup/magnific-popup.css" rel="stylesheet"/>
    <link href="assets/libs/ios7-switch/ios7-switch.css" rel="stylesheet"/>
    <link href="assets/libs/pace/pace.css" rel="stylesheet"/>
    <link href="assets/libs/sortable/sortable-theme-bootstrap.css" rel="stylesheet"/>
    <link href="assets/libs/bootstrap-datepicker/css/datepicker.css" rel="stylesheet"/>
    <link href="assets/libs/jquery-icheck/skins/all.css" rel="stylesheet"/>
    <!-- Code Highlighter for Demo -->
    <link href="assets/libs/prettify/github.css" rel="stylesheet"/>

    <!-- Extra CSS Libraries Start -->
    <link href="assets/libs/jquery-datatables/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="assets/libs/jquery-datatables/extensions/TableTools/css/dataTables.tableTools.css" rel="stylesheet"
          type="text/css"/>
    <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
    <!-- Extra CSS Libraries End -->
    <link href="assets/css/style-responsive.css" rel="stylesheet"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

</head>
<body class="fixed-left">
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
<div id="wrapper">

    <?php

    require_once('php/includes/menus.php');
    Menus('exportarDados', 'qualidadeSSI');

    ?>

    <div class="content-page">
        <!-- ============================================================== -->
        <!-- Start Content here -->
        <!-- ============================================================== -->
        <div class="content">
            <!-- Page Heading Start -->
            <div class="page-heading">
                <h1><i class='fa fa-table'></i> Exportar Dados - SSI</h1>

                <h3>Visualize, consulte e exporte os dados dos seus colaboradores para diversos formatos</h3>
                <div class='text-right'>
                    <div class='row text-right'>
                        <div class='col-lg-4 text-right' style='float: right!important;'>
                            <a href='#' rel='contentA' class='print btn btn-primary btn-sm invoice-print'>
                                <i class='icon-print-2'></i> Imprimir</a>
                        </div>
                    </div>
                </div>
                <!-- End div .user-button -->
            </div>


            <div class="row">

                <div class="col-md-12">
                    <div class="widget">
                        <div class="widget-header">
                            <h2><strong>SSI</strong></h2>

                            <div class='additional-btn'>
                                <a href='#' class='hidden reload'><i class='icon-ccw-1'></i></a>
                                <a href='#' class='widget-toggle'><i class='icon-down-open-2'></i></a>
<!--                               -->
                            </div>
                        </div>
                        <div class="widget-content">
                            <br>

                            <div class="table-responsive" >
                                <form class='form-horizontal' role='form'>
                                    <div>
                                    <table id="datatables-4" class="table table-striped table-bordered" cellspacing="0"
                                           width="100%">
                                        <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Função</th>
                                            <th>Idade</th>
                                            <th>Medicina Trabalho</th>
                                            <th>Cartão Cidadão</th>
                                            <th>Validade C. Cidadão</th>
                                        </tr>
                                        </thead>

                                        <tfoot>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Função</th>
                                            <th>Idade</th>
                                            <th>Medicina Trabalho</th>
                                            <th>Cartão Cidadão</th>
                                            <th>Validade C. Cidadão</th>
                                        </tr>
                                        </tfoot>
                                        <tbody>

                                        <?php

                                        $query = "SELECT nome_completo, funcao, nascimento,
                                        medicina_trabalho, cartao_cidadao, validade_cc_passaporte
                                        FROM colaborador";

                                        $stmt = mysqli_prepare($link, $query);
                                        mysqli_stmt_bind_result($stmt, $nomeCompleto, $funcao,
                                            $dataNascimento, $medicinaTrabalho, $cartaoCidadao,
                                            $validadeCC);
                                        mysqli_stmt_execute($stmt);

                                        while (mysqli_stmt_fetch($stmt)) {

                                            $cartaoCidadao = chunk_split($cartaoCidadao, 4, ' ');

                                            $from = new DateTime($dataNascimento);
                                            $to = new DateTime('today');

                                            $conversaoValidadeCC = new DateTime($validadeCC);
                                            $textoValidadeCC = $conversaoValidadeCC->format('d-m-Y');

                                            if ($medicinaTrabalho == 1) {
                                                $textoMedicinaTrabalho = "Controlado";
                                            } else {
                                                $textoMedicinaTrabalho = "Não Controlado";
                                            }

                                            echo "<tr>
                                                <td>$nomeCompleto</td>
                                                <td>$funcao</td>
                                            <td>";
                                            echo $from->diff($to)->y;
                                            echo "</td>
                                                <td>$textoMedicinaTrabalho</td>
                                                <td>$cartaoCidadao</td>
                                                <td>$textoValidadeCC</td>
                                            </tr>";
                                        }

                                        mysqli_stmt_close($stmt);

                                        ?>

                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>


                        <div class="widget-content" style="display: none !important;">
                            <br>

                            <div class="table-responsive" id="contentA">
                                <form class='form-horizontal' role='form'>
                                    <div>

                                        <table width='100%'>
                                            <thead>


                                            </thead>
                                            <tr width='100%'>
                                                <td style='width: 70%' width='70%'>
                                                    <h4><img src='assets/img/inv-logo.png' alt='Logo'></h4>

                                                    Rua dos Caniços, Ervosas<br>
                                                    3830-252 Ílhavo<br>
                                                    <abbr title='Phone'>Telefone:</abbr> 234 940 050<br>
                                                    <abbr title='Fax'>Fax:</abbr> 234 940 059<br>
                                                    <abbr title='Email'>Email:</abbr> geral@bentoenascimento.com

                                                </td>
                                                <td style='text-align: right' width='30%'>
                                                    Data: <?php echo date('d-m-Y'); ?></td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h3><strong>SSI</strong></h3>
                                                </td>
                                            </tr>
                                        </table>

                                        <table border="1" class="table table-striped table-bordered" cellspacing="0"
                                               width="100%">
                                            <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Função</th>
                                                <th>Idade</th>
                                                <th>Medicina Trabalho</th>
                                                <th>Cartão Cidadão</th>
                                                <th>Validade C. Cidadão</th>
                                            </tr>
                                            </thead>

                                            <tfoot>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Função</th>
                                                <th>Idade</th>
                                                <th>Medicina Trabalho</th>
                                                <th>Cartão Cidadão</th>
                                                <th>Validade C. Cidadão</th>
                                            </tr>
                                            </tfoot>
                                            <tbody>

                                            <?php

                                            $query = "SELECT nome_completo, funcao, nascimento,
                                        medicina_trabalho, cartao_cidadao, validade_cc_passaporte
                                        FROM colaborador";

                                            $stmt = mysqli_prepare($link, $query);
                                            mysqli_stmt_bind_result($stmt, $nomeCompleto, $funcao,
                                                $dataNascimento, $medicinaTrabalho, $cartaoCidadao,
                                                $validadeCC);
                                            mysqli_stmt_execute($stmt);

                                            while (mysqli_stmt_fetch($stmt)) {

                                                $cartaoCidadao = chunk_split($cartaoCidadao, 4, ' ');

                                                $from = new DateTime($dataNascimento);
                                                $to = new DateTime('today');

                                                $conversaoValidadeCC = new DateTime($validadeCC);
                                                $textoValidadeCC = $conversaoValidadeCC->format('d-m-Y');

                                                if ($medicinaTrabalho == 1) {
                                                    $textoMedicinaTrabalho = "Controlado";
                                                } else {
                                                    $textoMedicinaTrabalho = "Não Controlado";
                                                }

                                                echo "<tr>
                                                <td style='text-align: center !important;'>$nomeCompleto</td>
                                                <td style='text-align: center !important;'>$funcao</td>
                                            <td style='text-align: center !important;'>";
                                                echo $from->diff($to)->y;
                                                echo "</td>
                                                <td style='text-align: center !important;'>$textoMedicinaTrabalho</td>
                                                <td style='text-align: center !important;'>$cartaoCidadao</td>
                                                <td style='text-align: center !important;'>$textoValidadeCC</td>
                                            </tr>";
                                            }

                                            mysqli_stmt_close($stmt);

                                            ?>

                                            </tbody>
                                        </table>
<br><br><br><br>
                                        <table style='width: 100%'>
                                            <tbody>

                                            <tr>

                                                <td style='width:100%!important;  text-align: center !important; padding-top: 10px!important; padding-bottom:  15px !important;'>

                                                    <h3 style='display: inline;  padding-bottom: 10px !important;'>
                                                        ________________________________</h3><br>
                                                    <h4 style='display: inline; font-weight: normal !important; text-align: center'>(Responsável dos Recursos Humanos)</h4>

                                                </td>

                                            </tr>

                                            </tbody>
                                        </table>
                                </form>
                            </div>
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
<div class="md-overlay"></div>
<!-- End of eoverlay modal -->
<script>
    var resizefunc = [];
</script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="assets/libs/jquery/jquery-1.11.1.min.js"></script>
<script src="assets/libs/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/libs/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
<script src="assets/libs/jquery-ui-touch/jquery.ui.touch-punch.min.js"></script>
<script src="assets/libs/jquery-detectmobile/detect.js"></script>
<script src="assets/libs/jquery-animate-numbers/jquery.animateNumbers.js"></script>
<script src="assets/libs/ios7-switch/ios7.switch.js"></script>
<script src="assets/libs/fastclick/fastclick.js"></script>
<script src="assets/libs/jquery-blockui/jquery.blockUI.js"></script>
<script src="assets/libs/bootstrap-bootbox/bootbox.min.js"></script>
<script src="assets/libs/jquery-slimscroll/jquery.slimscroll.js"></script>
<script src="assets/libs/jquery-sparkline/jquery-sparkline.js"></script>
<script src="assets/libs/nifty-modal/js/classie.js"></script>
<script src="assets/libs/nifty-modal/js/modalEffects.js"></script>
<script src="assets/libs/sortable/sortable.min.js"></script>
<script src="assets/libs/bootstrap-fileinput/bootstrap.file-input.js"></script>
<script src="assets/libs/bootstrap-select/bootstrap-select.min.js"></script>
<script src="assets/libs/bootstrap-select2/select2.min.js"></script>
<script src="assets/libs/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="assets/libs/pace/pace.min.js"></script>
<script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="assets/libs/jquery-icheck/icheck.min.js"></script>

<!-- Demo Specific JS Libraries -->
<script src="assets/libs/prettify/prettify.js"></script>

<script src="assets/js/init.js"></script>
<!-- Page Specific JS Libraries -->
<script src="assets/libs/jquery-datatables/js/jquery.dataTables.min.js"></script>
<script src="assets/libs/jquery-datatables/js/dataTables.bootstrap.js"></script>
<script src="assets/libs/jquery-datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script src="assets/js/pages/datatables.js"></script>
<script src='teste/finished/js/jquery.PrintArea.js_4.js'></script>
<script src='teste/finished/js/core.js'></script>

</body>
</html>