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
    <!--    <link href='assets/libs/rickshaw/rickshaw.min.css' rel='stylesheet' type='text/css'/>-->
    <link href='assets/libs/morrischart/morris.css' rel='stylesheet' type='text/css'/>
    <link href='assets/libs/jquery-jvectormap/css/jquery-jvectormap-1.2.2.css' rel='stylesheet' type='text/css'/>
    <link href='assets/libs/jquery-clock/clock.css' rel='stylesheet' type='text/css'/>
    <link href='assets/libs/bootstrap-calendar/css/bic_calendar.css' rel='stylesheet' type='text/css'/>
    <link href='assets/libs/sortable/sortable-theme-bootstrap.css' rel='stylesheet' type='text/css'/>
    <link href='assets/libs/jquery-weather/simpleweather.css' rel='stylesheet' type='text/css'/>
    <link href='assets/libs/bootstrap-xeditable/css/bootstrap-editable.css' rel='stylesheet' type='text/css'/>
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
<div id='wrapper'>

    <?php require_once('php/includes/menus.php');
    Menus('presencas', 'marcarPresencas');
    ?>

    <!-- Start right content -->
    <div class='content-page'>
        <!-- ============================================================== -->
        <!-- Start Content here -->
        <!-- ============================================================== -->
        <div class='content'>
            <div class="page-heading">
                <h1><i class='fa fa-hand-o-up'></i> Registar Presenças</h1>
            </div>
            <!-- Page Heading End-->
            <div class='row'>
                <div class='col-lg-12 col-md-6 portlets'>

                    <?php

                    if (isset($_GET['sucesso'])) {

                        $dataSucesso = $_GET['sucesso'];

                        echo "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
               As presenças do dia <b>"; echo $dataSucesso; echo "</b> foram marcadas com sucesso.<br>
               <a class='alert-link'>Votos de uma excelente experiência!</a></div>";
                    }

                    ?>

                    <div id='calendar-widget2 azulinho' class='widget blue-1'
                         style="background-color: #183747 !important;">
                        <div class='widget-header transparent'>
                            <h2><strong>Calendário</strong></h2>

                            <div class='additional-btn'>
                                <a href='#' class='hidden reload'><i class='icon-ccw-1'></i></a>
                                <a href='#' class='widget-maximize hidden'><i class='icon-resize-full-1'></i></a>
                                <a href='#' class='widget-toggle'><i class='icon-down-open-2'></i></a>

                            </div>
                        </div>
                        <div id='calendar-box2' class='widget-content col-sm-12'>

                        </div>
                    </div>

                    <div class='widget'>
                        <div class='widget-header transparent'>
                            <h2><strong>Inserir data de registo</strong> (Opcional)</h2>

                            <div class='additional-btn'>
                                <a href='#' class='hidden reload'><i class='icon-ccw-1'></i></a>
                                <a href='#' class='widget-toggle'><i class='icon-down-open-2'></i></a>

                            </div>
                        </div>
                        <div class='widget-content padding'>
                            <form class='form-horizontal' role='form' method='get'
                                  action='marcarPresencasColaboradores.php'>

                                <div class='form-group'>

                                    <div class='col-sm-12'>
                                        <input type='text' class='form-control datepicker-input'
                                               id='inputEmail' name='data' data-mask='99-99-9999'
                                               placeholder='Data de Registo (Opcional)'>
                                    </div>
                                </div>

                                <div class='form-group'>

                                    <div class='col-sm-12'>
                                        <button type='submit' style='width: 100% !important;'
                                                class='btn btn-default input-block-level'>Avançar</button>
                                    </div>

                                </div>

                            </form>
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
<script src='assets/libs/d3/d3.v3.js'></script>
<!--<script src='assets/libs/rickshaw/rickshaw.min.js'></script>-->
<!--<script src='assets/libs/raphael/raphael-min.js'></script>-->
<script src='assets/libs/morrischart/morris.min.js'></script>
<script src='assets/libs/jquery-knob/jquery.knob.js'></script>
<script src='assets/libs/jquery-jvectormap/js/jquery-jvectormap-1.2.2.min.js'></script>
<script src='assets/libs/jquery-jvectormap/js/jquery-jvectormap-us-aea-en.js'></script>
<script src='assets/libs/jquery-clock/clock.js'></script>
<script src='assets/libs/jquery-easypiechart/jquery.easypiechart.min.js'></script>
<script src='assets/libs/jquery-weather/jquery.simpleWeather-2.6.min.js'></script>
<script src='assets/libs/bootstrap-xeditable/js/bootstrap-editable.min.js'></script>
<script src='assets/libs/bootstrap-calendar/js/bic_calendar.min.js'></script>
<script src='assets/js/apps/calculator.js'></script>
<script src='assets/js/apps/todo.js'></script>
<script src='assets/js/apps/notes.js'></script>
<script src='assets/js/pages/indexPresencas.js'></script>
<style>
    #azulinho {
        background-color: #183747 !important;
    }
</style>
<script>
    $(document).ready(function () {
        var cTime = new Date(), day = cTime.getDay() + 4, month = cTime.getMonth() + 1,
            year = cTime.getFullYear();
        var events = [

            {
                "date": <?php echo date('d'); ?> +"/" + <?php echo date('m'); ?> +"/" + <?php echo date('Y'); ?>,
                "title": 'Hoje',
                "link": 'marcarPresencasColaboradores.php?data=<?php echo date('Y-m-d');?>',
                "color": 'rgba(255,255,255,0.3)'
            },

            <?php

 // Start date
  $date = '2014-01-01';
  // End date
  $end_date = date('Y-m-d');

  while (strtotime($date) <= strtotime("-1 day", strtotime($end_date))) {

$timestamp = strtotime($date);
$dw = date( "w", $timestamp);

            if($dw == 0){}else{
  echo "
    {
                'date':"; ?> <?php echo date("d", $timestamp); ?> +"/" + <?php echo date("m", $timestamp); ?> +"/" + <?php echo date("Y", $timestamp); ?> <?php echo ",
                'title':"; ?> <?php echo "'Dia '"; ?> + <?php echo date("d", $timestamp); ?> +"-" + <?php echo date("m", $timestamp); ?> +"-" + <?php echo date("Y", $timestamp); ?> <?php echo ",
                'link': 'marcarPresencasColaboradores.php?data=$date',
                'color': 'rgba(255,255,255,0.1)'
            },
  ";
}

  $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
  }

 ?>


        ];

        $('#calendar-box2').bic_calendar({
            events: events,
            dayNames: dayNames,
            monthNames: monthNames,
            showDays: true,
            displayMonthController: true,
            displayYearController: false,
            popoverOptions: {
                placement: 'top',
                trigger: 'hover',
                html: true
            },
            tooltipOptions: {
                placement: 'top',
                html: true
            }
        });
    });
</script>

<!-- Extra CSS Libraries Start -->
<link href='assets/libs/bootstrap-select/bootstrap-select.min.css' rel='stylesheet' type='text/css'/>
<link href='assets/libs/summernote/summernote.css' rel='stylesheet' type='text/css'/>
<link href='assets/css/style.css' rel='stylesheet' type='text/css'/>
<!-- Extra CSS Libraries End -->
<link href='assets/css/style-responsive.css' rel='stylesheet'/>

<!-- Page Specific JS Libraries -->
<script src='assets/libs/bootstrap-select/bootstrap-select.min.js'></script>
<script src='assets/libs/bootstrap-inputmask/inputmask.js'></script>
<script src='assets/libs/summernote/summernote.js'></script>
<script src='assets/js/pages/forms.js'></script>

</body>
</html>