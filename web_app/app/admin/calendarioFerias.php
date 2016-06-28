<?php session_start();

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
    <link href='assets/libs/fullcalendar/fullcalendar.css' rel='stylesheet' type='text/css'/>
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
<!-- Modal Task Progress -->
<div class='md-modal md-3d-flip-vertical' id='task-progress'>
    <div class='md-content'>
        <h3><strong>Task Progress</strong> Information</h3>

        <div>
            <p>CLEANING BUGS</p>

            <div class='progress progress-xs for-modal'>
                <div class='progress-bar progress-bar-success' role='progressbar' aria-valuenow='80' aria-valuemin='0'
                     aria-valuemax='100' style='width: 80%'>
                    <span class='sr-only'>80&#37; Complete</span>
                </div>
            </div>
            <p>POSTING SOME STUFF</p>

            <div class='progress progress-xs for-modal'>
                <div class='progress-bar progress-bar-warning' role='progressbar' aria-valuenow='80' aria-valuemin='0'
                     aria-valuemax='100' style='width: 65%'>
                    <span class='sr-only'>65&#37; Complete</span>
                </div>
            </div>
            <p>BACKUP DATA FROM SERVER</p>

            <div class='progress progress-xs for-modal'>
                <div class='progress-bar progress-bar-info' role='progressbar' aria-valuenow='80' aria-valuemin='0'
                     aria-valuemax='100' style='width: 95%'>
                    <span class='sr-only'>95&#37; Complete</span>
                </div>
            </div>
            <p>RE-DESIGNING WEB APPLICATION</p>

            <div class='progress progress-xs for-modal'>
                <div class='progress-bar progress-bar-primary' role='progressbar' aria-valuenow='80' aria-valuemin='0'
                     aria-valuemax='100' style='width: 100%'>
                    <span class='sr-only'>100&#37; Complete</span>
                </div>
            </div>
            <p class='text-center'>
                <button class='btn btn-danger btn-sm md-close'>Close</button>
            </p>
        </div>
    </div>
</div>

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
<div id='wrapper'>

    <?php require_once('php/includes/menus.php');
    Menus('ferias', 'calendarioFerias'); ?>

    <!-- Start right content -->
    <div class='content-page'>
        <!-- ============================================================== -->
        <!-- Start Content here -->
        <!-- ============================================================== -->
        <div class='content'>
            <!-- Page Heading Start -->
            <div class='page-heading'>
                <h1><i class='fa fa-plane'></i>&nbsp; Férias</h1>

                <div class='text-right'>
                    <div class='row text-right'>
                        <div class='col-lg-4 text-right' id="download" style='float: right!important;'
                             onclick='teste2()'>
                            <a class='print btn btn-primary btn-sm '>
                                <i class='fa fa-save'></i> &nbsp;Guardar</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page Heading End-->
            <div class='row'>
                <div class='col-md-12'>
                    <div class='widget'>
                        <div class='widget-header'>
                            <h2>Calendário de Férias</h2>

                            <div class='additional-btn'>
                                <a href='#' class='hidden reload'><i class='icon-ccw-1'></i></a>
                                <a href='#' class='widget-maximize hidden'><i class='icon-resize-full-1'></i></a>
                                <a href='#' class='widget-toggle'><i class='icon-down-open-2'></i></a>
                            </div>
                        </div>
                        <div class='widget-content padding'>
                            <div class='col-md-12' id="">
                                <div class='widget bg-white'>
                                    <div class='widget-body'>
                                        <div class='row'>
                                            <div class='col-md-12 col-sm-12 col-xs-12'>
                                                <div id='calendar'></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--            <div class='row'-->
            <!--                 style="width:100%; z-index: -9999999999999999999999999999999999999999 !important; position: absolute; top: 0px"-->
            <!--                 id="divImprimir">-->
            <!--                <div class='col-md-12'>-->
            <!--                    <div class='widget'>-->
            <!--                        <div class='widget-header'>-->
            <!--                            <h2>Calendário de Férias</h2>-->
            <!---->
            <!--                            <div class='additional-btn'>-->
            <!--                                <a href='#' class='hidden reload'><i class='icon-ccw-1'></i></a>-->
            <!--                                <a href='#' class='widget-maximize hidden'><i class='icon-resize-full-1'></i></a>-->
            <!--                                <a href='#' class='widget-toggle'><i class='icon-down-open-2'></i></a>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                        <div class='widget-content padding'>-->
            <!--                            <div class='col-md-12' id="">-->
            <!--                                <div class='widget bg-white'>-->
            <!--                                    <div class='widget-body'>-->
            <!--                                        <div class='row'>-->
            <!--                                            <div class='col-md-12 col-sm-12 col-xs-12'>-->
            <!--                                                <div id='calendarA'></div>-->
            <!--                                            </div>-->
            <!--                                        </div>-->
            <!--                                    </div>-->
            <!--                                </div>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
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
<script src='assets/libs/fullcalendar/fullcalendar.min.js'></script>
<script>

    function teste() {
        window.open('', document.getElementById('calendar').toDataURL());
    }

    //function to calculate window height
    function get_calendar_height() {
        return $(window).height() + 150;
    }


    $(function () {

        function runCalendar() {
            var $modal = $('#event-modal');
            $('#draggable-events div.draggable-event').each(function () {
                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                };
                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject);
                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 999,
                    revert: true, // will cause the event to go back to its
                    revertDuration: 20 //  original position after the drag
                });
            });
            /*  Initialize the calendar  */
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();
            var form = '';
            var calendar = $('#calendar').fullCalendar({

                slotDuration: '00:15:00', /* If we want to split day time each 15minutes */
                minTime: '08:00:00',
                maxTime: '19:00:00',
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: [


                    <?php

                     $query = "SELECT COUNT( id_ferias ) FROM ferias INNER JOIN colaborador
    ON ferias.ref_id_colaborador = colaborador.id_colaborador WHERE (inicio_ferias > CURDATE( ))
    AND colaborador.ativo = 1";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        mysqli_stmt_close($stmt);

        $query = "SELECT inicio_ferias, fim_ferias, ref_id_colaborador, nome_completo
    FROM ferias INNER JOIN colaborador ON colaborador.id_colaborador = ferias.ref_id_colaborador
    WHERE inicio_ferias > CURDATE( ) AND colaborador.ativo = 1 ORDER BY inicio_ferias ASC";

        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_result($stmt, $dataInicioFerias, $dataFimFerias, $idColaborador, $nomeCompleto);
        mysqli_stmt_execute($stmt);

        while (mysqli_stmt_fetch($stmt)) {


                $nomeCompletoPrimeiro = $nomeCompleto;
               $nomeCompletoSegundo = $nomeCompleto;

$nomeCompletoSegundo = substr($nomeCompletoSegundo, strrpos($nomeCompletoSegundo, ' ') + 1);

$nomeCompletoPrimeiro = strtok($nomeCompletoPrimeiro, " "); // Test

                   echo " {
                    title: '$nomeCompletoPrimeiro "; echo " "; echo "$nomeCompletoSegundo',
                    start: '$dataInicioFerias',
                    end: '$dataFimFerias',
                    className: 'bg-blue-1'
                },

                ";

                }
    } else {
        mysqli_stmt_close($stmt);
    }

    mysqli_stmt_close($stmt);
         $query = "SELECT COUNT( id_ferias ) FROM ferias INNER JOIN colaborador
    ON ferias.ref_id_colaborador = colaborador.id_colaborador WHERE (CURDATE( ) BETWEEN inicio_ferias AND fim_ferias)
    AND colaborador.ativo = 1";

        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_result($stmt, $numeroFeriasAtuais);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            mysqli_stmt_close($stmt);

            $query = "SELECT inicio_ferias, fim_ferias, ref_id_colaborador, nome_completo FROM ferias
    INNER JOIN colaborador ON colaborador.id_colaborador = ferias.ref_id_colaborador
    WHERE (CURDATE( ) BETWEEN inicio_ferias AND fim_ferias) AND colaborador.ativo = 1 ORDER BY inicio_ferias ASC";

            $stmt = mysqli_prepare($link, $query);
            mysqli_stmt_bind_result($stmt, $dataInicioFerias, $dataFimFerias, $idColaborador, $nomeCompleto);
            mysqli_stmt_execute($stmt);

            while (mysqli_stmt_fetch($stmt)) {

                 $nomeCompletoPrimeiro = $nomeCompleto;
               $nomeCompletoSegundo = $nomeCompleto;

$nomeCompletoSegundo = substr($nomeCompletoSegundo, strrpos($nomeCompletoSegundo, ' ') + 1);

$nomeCompletoPrimeiro = strtok($nomeCompletoPrimeiro, " "); // Test

                   echo " {
                    title: '$nomeCompletoPrimeiro "; echo " "; echo "$nomeCompletoSegundo',
                    start: '$dataInicioFerias',
                    end: '$dataFimFerias',
                    className: 'bg-green-3'
                },

                ";

               }

        } else {
            mysqli_stmt_close($stmt);
        }


    //ANTIGAS

                   $query = "SELECT COUNT( id_ferias ) FROM ferias INNER JOIN colaborador
    ON ferias.ref_id_colaborador = colaborador.id_colaborador WHERE (fim_ferias < CURDATE( ))
    AND colaborador.ativo = 1";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        mysqli_stmt_close($stmt);

        $query = "SELECT inicio_ferias, fim_ferias, ref_id_colaborador, nome_completo
    FROM ferias INNER JOIN colaborador ON colaborador.id_colaborador = ferias.ref_id_colaborador
    WHERE fim_ferias < CURDATE( ) AND colaborador.ativo = 1 ORDER BY inicio_ferias ASC";

        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_result($stmt, $dataInicioFerias, $dataFimFerias, $idColaborador, $nomeCompleto);
        mysqli_stmt_execute($stmt);

        while (mysqli_stmt_fetch($stmt)) {

               $nomeCompletoPrimeiro = $nomeCompleto;
               $nomeCompletoSegundo = $nomeCompleto;

$nomeCompletoSegundo = substr($nomeCompletoSegundo, strrpos($nomeCompletoSegundo, ' ') + 1);

$nomeCompletoPrimeiro = strtok($nomeCompletoPrimeiro, " "); // Test

                   echo " {
                    title: '$nomeCompletoPrimeiro "; echo " "; echo "$nomeCompletoSegundo',
                    start: '$dataInicioFerias',
                    end: '$dataFimFerias',
                    className: 'bg-red-1'
                },

                ";

                }
    } else {
        mysqli_stmt_close($stmt);
    }


    ?>

                ],
            });

        }

        runCalendar();

        var c = document.getElementById('calendar');
//        var t = c.getContext('2d');

    });


    //attacht resize event to window and set fullcalendar height property
    $(document).ready(function () {

        $('#calendar').fullCalendar('option', 'height', get_calendar_height());

        $(window).resize(function () {
            $('#calendar').fullCalendar('option', 'height', get_calendar_height());
        });

    });

</script>

<style>
    .fc-header-right {
        visibility: hidden;
    !important;
    }

    .fc-day div {
        height: 2em !important;
    }
</style>

<script type="text/javascript" src="teste/html2canvas-0.5.0-alpha1/dist/html2canvas.js"></script>
<script src='assets/download-master/download.js'></script>
<script type="text/javascript">

    function teste2() {

        $('#calendar .fc-header-left').css('visibility', 'hidden');

        $('#calendar .fc-state-highlight').css('background-color', 'transparent');

        setTimeout(function () {


            html2canvas($("#calendar"), {
                useCORS: true,
                onrendered: function (canvas) {
                    // canvas is the final rendered <canvas> element

                    var nomeImagem = "Calendário de Férias - " + $('.fc-header-title h2').html();

                    var myImage = canvas.toDataURL("image/png");

                    download(myImage, nomeImagem, "image/png");

                    window.open(myImage);

                    setTimeout(function () {
                        $('#calendar .fc-header-left').css('visibility', 'visible');
                        $('#calendar .fc-state-highlight').css('background-color', '#fcf8e3');

                    }, 100);

                }
            });


        }, 200);
    }


</script>

</body>
</html>