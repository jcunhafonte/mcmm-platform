<?php

session_start();

if (!isset($_SESSION['ativoAdmin'])) {

    header('location:entrar.php');

}

require_once('php/connection/dbconnection.php');

$query = "SELECT COUNT(id_utilizador) FROM utilizadores WHERE ativo = 1";
$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_result($stmt, $totaisColaboradores);
mysqli_stmt_execute($stmt);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

$query = "SELECT COUNT(id_videos) FROM videos WHERE ativo = 1";
$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_result($stmt, $totaisVideos);
mysqli_stmt_execute($stmt);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

$query = "SELECT COUNT(id_noticias) FROM noticias WHERE ativo = 1";
$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_result($stmt, $totaisNoticias);
mysqli_stmt_execute($stmt);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

$query = "SELECT COUNT(id_projetos) FROM projetos WHERE ativo = 1";
$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_result($stmt, $totaisProjetos);
mysqli_stmt_execute($stmt);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

?>
<!DOCTYPE html>
<html>
<head>

    <meta charset='UTF-8'>
    <title>MCMM - Administração</title>
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no'/>
    <meta name='apple-mobile-web-app-capable' content='yes'/>

    <?php  require_once('php/pages/favicon.php'); ?>

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
    <link href='assets/libs/rickshaw/rickshaw.min.css' rel='stylesheet' type='text/css'/>
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
            <p class='text-center'>Tem a certeza que pretende abandonar a Plataforma MCMM?</p>

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
Menus('inicio', 'inicio', 'calculadora');
?>

<!-- Start right content -->
<div class='content-page'>
<!-- ============================================================== -->
<!-- Start Content here -->
<!-- ============================================================== -->
<div class='content'>
    <!-- Start info box -->
    <div class='row top-summary'>

        <div class='col-lg-6 col-md-6'>
            <div class='widget green-1 animated fadeInDown'>
                <div class='widget-content padding'>
                    <div class='widget-icon'>
                        <i class='icon-globe-inv'></i>
                    </div>
                    <div class='text-box'>
                        <p class='maindata'><b>PUBLICAÇÕES</b></p>

                        <h2><span class='animate-number' data-value='<?php echo ($totaisNoticias + $totaisProjetos + $totaisVideos); ?>'
                                  data-duration='1000'>0</span></h2>

                        <div class='clearfix'></div>
                    </div>
                </div>
            </div>
        </div>

        <div class='col-lg-6 col-md-6'>
            <div class='widget lightblue-1 animated fadeInDown'>
                <div class='widget-content padding'>
                    <div class='widget-icon'>
                        <i class='fa fa-users'></i>
                    </div>
                    <div class='text-box'>
                        <p class='maindata'><b>UTILIZADORES</b></p>

                        <h2><span class='animate-number' data-value='<?php echo $totaisColaboradores; ?>'
                                  data-duration='1500'>0</span></h2>

                        <div class='clearfix'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of info box -->

    <div class='row'>
        <div class='col-lg-6 portlets'>
            <div class='widget darkblue-3'>
                <div class='widget-header transparent'>
                    <h2><strong>Servidor</strong></h2>

                    <div class='additional-btn'>
                        <a href='#' class='hidden reload'><i class='icon-ccw-1'></i></a>
                        <a href='#' class='widget-maximize hidden'><i class='icon-resize-full-1'></i></a>
                        <a href='#' class='widget-toggle'><i class='icon-down-open-2'></i></a>

                    </div>
                </div>
                <div class='widget-content'>
                    <div id='website-statistic2' class='statistic-chart'>

                        <div class='col-sm-12 stacked'>
                            <h4><i class='fa fa-circle-o text-green-1'></i> Evolução do Servidor</h4>

                            <div class='col-sm-8 status-data'>
                                <div class='clearfix'></div>
                                <div style='visibility: hidden' class='progress progress-xs'>
                                    <div style='width: 72%' aria-valuemax='100' aria-valuemin='0'
                                         aria-valuenow='72' role='progressbar' class='progress-bar bg-orange-2'
                                         title='Average Load: 76%' data-placement='right' data-toggle='tooltip'>
                                        <span class='sr-only'>72% Complete (success)</span>
                                    </div>
                                </div>
                            </div>
                            <div class='col-sm-4 text-center'>
                                <div class='ws-load echart' data-percent='50'><span class='percent'></span>
                                </div>
                            </div>
                        </div>
                        <div class='clearfix'></div>
                        <div id='home-chart-2'></div>
                    </div>
                </div>
            </div>

        </div>
        <div class='col-lg-6 col-md-6 portlets'>
            <div id='calendar-widget2' class='widget blue-1'>
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
        </div>

    </div>

    

    <div class='row'>
        <div class='col-lg-8 col-md-6 portlets'></div>
    </div>

    <!-- Footer Start -->
            <footer>
                MCMM &copy; 2016 Daniela Bessa e José Fonte
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
<div id='contextMenu' class='dropdown clearfix'>
    <ul class='dropdown-menu' role='menu' aria-labelledby='dropdownMenu'
        style='display:block;position:static;margin-bottom:5px;'>
        <li><a tabindex='-1' href='javascript:;' data-priority='high'><i class='fa fa-circle-o text-red-1'></i> High
                Priority</a></li>
        <li><a tabindex='-1' href='javascript:;' data-priority='medium'><i class='fa fa-circle-o text-orange-3'></i>
                Medium Priority</a></li>
        <li><a tabindex='-1' href='javascript:;' data-priority='low'><i class='fa fa-circle-o text-yellow-1'></i> Low
                Priority</a></li>
        <li><a tabindex='-1' href='javascript:;' data-priority='none'><i class='fa fa-circle-o text-lightblue-1'></i>
                None</a></li>
    </ul>
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
<script src='assets/libs/d3/d3.v3.js'></script>
<script src='assets/libs/rickshaw/rickshaw.min.js'></script>
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
<script src='assets/js/pages/index.js'></script>

<script>
    $(document).ready(function () {
        var cTime = new Date(), day = cTime.getDay() + 4, month = cTime.getMonth() + 1, year = cTime.getFullYear();
        var events = [
            {
                "date": <?php echo date('d'); ?> +"/" + month + "/" + year,
                "title": 'Hoje',
                "link": 'javascript:;',
                "color": 'rgba(255,255,255,0.2)'
            },
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

</body>
</html>