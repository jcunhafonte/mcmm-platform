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
    <title>Wecontrol - Administração</title>
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
            <p class='text-center'>Tem a certeza que pretende abandonar a WeControl?</p>

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
        <h3>Desativar Utilizador</h3>

        <div>
            <p>Tem a certeza que pretende desativar este utilizador<strong><span id='alteravel'></span></strong>?</p>
            <ul>
                <li><strong>Atenção:</strong> Esta ação pode ser revertida.
                </li>
                <li><strong>Informação:</strong> Após a confirmação a desativação, pode voltar a reativar o utilizador.
                </li>
                <li><strong>Fechar:</strong> Clique no botão indicativo para fechar este aviso e cancelar a ação.</li>
            </ul>
            <p>
                <button class='btn btn-danger md-close'>Fechar</button>
                <a class='btn-remover' href=''><button class='btn btn-success md-close'>Desativar</button></a>
            </p>
        </div>
    </div>
    <!-- End div .md-content -->
</div>
<!-- End div .md-modal .md-fade-in-scale-up -->

<!-- Begin page -->
<div id="wrapper">

    <?php
    
    require_once('php/includes/menus.php');
    Menus('exportdata');
	
    ?>

    <!-- Start right content -->
    <div class="content-page">
<!--        <ol class='breadcrumb'>-->
<!--            <li><a href='#'>Home</a></li>-->
<!--            <li class='active'>Dashboard v1</li>-->
<!--        </ol>-->
        <!-- ============================================================== -->
        <!-- Start Content here -->
        <!-- ============================================================== -->
        <div class="content">
            <!-- Page Heading Start -->
            <div class="page-heading">
                <h1><i class='fa fa-database'></i> Exportar Dados</h1>

                <h3>Pode proceder à exportação de dados relacionados com os utilizadores.</h3></div>

            <div class="row">

                <div class="col-md-12">

                    <?php

                    if (isset($_GET['contratoRemovido'])) {

                        $colaboradorRemovido = $_GET['contratoRemovido'];

                        $query = "SELECT id_colaborador, nome_completo FROM colaborador
                        WHERE id_colaborador = ?";

                        $stmt = mysqli_prepare($link, $query);
                        mysqli_stmt_bind_param($stmt, 'i', $colaboradorRemovido);
                        mysqli_stmt_bind_result($stmt, $idColaboradorRemovido, $nomeCompletoRemovido);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_fetch($stmt);
                        mysqli_stmt_close($stmt);

                        echo "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
               O utilizador <b>$nomeCompletoRemovido</b> foi desativado com sucesso.<br>
               <a class='alert-link'>Votos de uma excelente experiência!</a></div>";
                    }

                    if (isset($_GET['contratoRemovidoErro'])) {

                        $colaboradorRemovido = $_GET['contratoRemovidoErro'];

                        $query = "SELECT id_colaborador, nome_completo FROM colaborador
                        WHERE id_colaborador = ?";

                        $stmt = mysqli_prepare($link, $query);
                        mysqli_stmt_bind_param($stmt, 'i', $colaboradorRemovido);
                        mysqli_stmt_bind_result($stmt, $idColaboradorRemovido, $nomeCompletoRemovido);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_fetch($stmt);
                        mysqli_stmt_close($stmt);

                        echo "<div class='alert alert-danger alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
               Ocorreu um erro ao desativar o utilizador <b>$nomeCompletoRemovido</b>.<br>
               <a class='alert-link'>Votos de uma excelente experiência!</a></div>";
                    }

                    ?>

                    <div class="widget">
                        <div class="widget-header">
                            <h2><strong>Exportar</strong> Dados</h2>

                            <div class="additional-btn">
                                <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                                <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                                <!--                                <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>-->
                            </div>
                        </div>
                        <div class="widget-content">
                            <br>

                            <div class="table-responsive" style="overflow-x: hidden">
                                <form class='form-horizontal' role='form'>
                                    <table id="datatables-4" class="table table-striped table-bordered" cellspacing="0"
                                           width="100%">
                                        <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Idade</th>
                                            <th>Email</th>
                                            <th>Data de registo</th>
                                            <th>Última visita</th>
                                            <th>Função</th>
                                            <th>Estado</th>
                                        </tr>
                                        </thead>

                                        <tbody>

                                        <?php

                                        $query = "SELECT id_utilizador, nome_utilizador, email,
                                      data_registo, ultima_visita, num_visitas, idade, funcao, ativo FROM utilizadores 
                                      ORDER BY nome_utilizador ASC";
                                        $stmt = mysqli_prepare($link, $query);
                                        mysqli_stmt_bind_result($stmt, $idUtilizador, $nomeUtilizador, $email, $dataRegisto, $dataUltimaVisita, $numVisitas, $idade, $funcao, $estado);
                                        mysqli_stmt_execute($stmt);

                                        while (mysqli_stmt_fetch($stmt)) {

                                            
                                            //Remover Horas de Datas
                                            $conversaoDataRegisto = new DateTime($dataRegisto);
                                            $textoDataRegisto = $conversaoDataRegisto->format('d-m-Y');

                                            /*
                                            $from = new DateTime($idade);
                                            $to = new DateTime('today');
                                            */

                                            echo "<tr>
                                            <td>
                                            <a href='../perfil.php?utilizador=$idUtilizador'>
                                            <span id='titulo$idUtilizador'>$nomeUtilizador</span></a>
                                            </td>
                                            <td>";
                                            if(isset($idade)){ echo $idade;}else{ echo "Sem idade"; }
                                            echo "</td>
                                            <td>$email</td>
                                            <td>$textoDataRegisto</td>
                                            <td>$dataUltimaVisita</td>
                                            <td>";
                                            if(isset($funcao)){ echo $funcao;}else{ echo "Sem função"; }
                                            echo "</td><td>";
                                            if($estado==1){ echo "Ativo"; }else{ echo "Desativo"; }            
                                            echo "</td>
                                        </tr>";
                                        }
                                        mysqli_stmt_close($stmt);
                                        ?>
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
                Wecontrol &copy; 2015
                <div class='footer-links pull-right'>
                    <a>Plataforma de Gestão</a>
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
<link rel="canonical" href="http://openexchangerates.github.io/accounting.js/"/>

<script src="assets/libs/accounting.js-master/accounting.min.js"></script>
<!-- Page Specific JS Libraries -->
<script src='assets/libs/bootstrap-select/bootstrap-select.min.js'></script>
<script src='assets/libs/bootstrap-inputmask/inputmask.js'></script>
<script src='assets/libs/summernote/summernote.js'></script>
<script src='assets/js/pages/forms.js'></script>

 <!-- Extra CSS Libraries Start -->
    <link href='assets/libs/bootstrap-select/bootstrap-select.min.css' rel='stylesheet' type='text/css'/>
    <link href='assets/libs/summernote/summernote.css' rel='stylesheet' type='text/css'/>
    <link href='assets/css/style.css' rel='stylesheet' type='text/css'/>
    <!-- Extra CSS Libraries End -->
    <link href='assets/css/style-responsive.css' rel='stylesheet'/>

    <script src='teste/finished/js/jquery.PrintArea.js_4.js'></script>
<script src='teste/finished/js/core.js'></script>

<script>
    function modalRemover(param){

        $('#md-fade-in-scale-up').find('.btn-remover').attr('href', $("#botaoRemover" + param).data('href'));

        var titulo = '';
        titulo = document.getElementById('titulo'+param).innerHTML;
        document.getElementById('alteravel').innerHTML = titulo;

    };
</script>

</body>
</html>