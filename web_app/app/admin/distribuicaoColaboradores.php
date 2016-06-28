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
    Menus('geografia');

    ?>

    <!-- Start right content -->
    <div class="content-page">
        <!-- ============================================================== -->
        <!-- Start Content here -->
        <!-- ============================================================== -->
        <div class="content">
            <!-- Page Heading Start -->
            <div class="page-heading">
                <h1><i class='fa fa-map-marker'></i> Distribuição Geográfica dos Colaboradores</h1>
            </div>
            <!-- Page Heading End-->
            <div class="row">
                <div class="col-md-12 portlets">
                    <div class="widget">
                        <div id="googleMap" style="height:650px !important; width: 100% !important;">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Start -->
            <footer style="margin-top: 0 !important;">
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
<script src="http://maps.googleapis.com/maps/api/js"></script>
<script src="assets/libs/jquery-gmap3/gmap3.min.js"></script>
<script src="assets/js/pages/google-maps.js"></script>

<script type="text/javascript" src="gmap3_lib/gmap3.js"></script>
<script>
    var macDoList = [
        <?php

        $query = "SELECT id_colaborador, nome_completo, telemovel, morada,
localidade, ativo FROM colaborador";
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_result($stmt, $idColaborador, $nomeCompleto, $telemovel, $morada,
        $localidade, $ativo);
        mysqli_stmt_execute($stmt);

        while (mysqli_stmt_fetch($stmt)){
            if(!empty($morada) AND (!empty($localidade))){
                    $morada=preg_replace('/^([^,]*).*$/', '$1', $morada);
                    echo "{address: '$morada, $localidade', data: {type: $ativo, drive: false, zip: $telemovel, city: '<a href="; echo "perfilColaborador.php?colaborador=$idColaborador"; echo ">$nomeCompleto</a>'},    options:{icon: new google.maps.MarkerImage('";
                     if($ativo == 1){
                     echo "php/icons/bighouse.png";
                     }else{
                     echo "php/icons/bighouse2.png";
                     }
                     echo "')}, },";
            }
        }

        mysqli_stmt_close($stmt);
        ?>
    ];
</script>
<style>
    #container {
        position: relative;
        height: 700px;
    }

    #googleMap {
        border: 1px dashed #C0C0C0;
        width: 100%;
        height: 700px;
    }

    /* cluster */
    .cluster {
        color: #FFFFFF;
        text-align: center;
        font-family: Verdana;
        font-size: 14px;
        font-weight: bold;
        text-shadow: 0 0 2px #000;
        -moz-text-shadow: 0 0 2px #000;
        -webkit-text-shadow: 0 0 2px #000;
    }

    .cluster-1 {
        background: url(gmap3_lib/examples/clusters/images/m1.png) no-repeat;
        line-height: 50px;
        width: 50px;
        height: 40px;
    }

    .cluster-2 {
        background: url(gmap3_lib/examples/clusters/images/m2.png) no-repeat;
        line-height: 53px;
        width: 60px;
        height: 48px;
    }

    .cluster-3 {
        background: url(gmap3_lib/examples/clusters/images/m3.png) no-repeat;
        line-height: 66px;
        width: 70px;
        height: 56px;
    }

    /* infobulle */
    .infobulle {
        overflow: hidden;
        cursor: default;
        clear: both;
        position: relative;
        height: 34px;
        padding: 0;
        background-color: rgb(57, 57, 57);
        border-radius: 4px 4px;
        -moz-border-radius: 4px 4px;
        -webkit-border-radius: 4px 4px;
        border: 1px solid #2C2C2C;
    }

    .infobulle .bg {
        font-size: 1px;
        height: 16px;
        border: 0px;
        width: 100%;
        padding: 0px;
        margin: 0px;
        /*background-color: #5E5E5E;*/
    }

    .infobulle a {
        color: #FFFFFF !important;
    }

    .infobulle a:hover {
        color: #30bbf2 !important;
    }

    .infobulle .text {
        color: #FFFFFF;
        font-family: Verdana;
        font-size: 11px;
        font-weight: bold;
        line-height: 25px;
        padding: 4px 20px;
        text-shadow: 0 -1px 0 #000000;
        white-space: nowrap;
        margin-top: -17px;
    }

    .infobulle.drive .text {
        background: url(gmap3_lib/examples/clusters/images/drive.png) no-repeat 2px center;
        padding: 4px 20px 4px 36px;
    }

    .arrow {
        position: absolute;
        left: 45px;
        height: 0;
        width: 0;
        margin-left: 0;
        border-width: 10px 10px 0 0;
        border-color: #2C2C2C transparent transparent;
        border-style: solid;
    }

</style>
<script type="text/javascript">

    $(function () {

        $("#googleMap").gmap3({
            map: {
                options: {
                    center: [40.583913, -8.625544],
                    zoom: 9,
                    mapTypeId: google.maps.MapTypeId.TERRAIN
                }
            },
            marker: {
                values: macDoList,
                cluster: {
                    radius: 70,
                    // This style will be used for clusters with more than 0 markers
                    0: {
                        content: "<div class='cluster cluster-1'>CLUSTER_COUNT</div>",
                        width: 53,
                        height: 52
                    },
                    // This style will be used for clusters with more than 20 markers
                    20: {
                        content: "<div class='cluster cluster-2'>CLUSTER_COUNT</div>",
                        width: 56,
                        height: 55
                    },
                    // This style will be used for clusters with more than 50 markers
                    50: {
                        content: "<div class='cluster cluster-3'>CLUSTER_COUNT</div>",
                        width: 66,
                        height: 65
                    },
                    events: {
                        click: function (cluster) {
                            var map = $(this).gmap3("get");
                            map.setCenter(cluster.main.getPosition());
                            map.setZoom(map.getZoom() + 1);
                        }
                    }
                },
                options: {
//                    icon: new google.maps.MarkerImage("https://maps.gstatic.com/mapfiles/ms2/micons/rangerstation.png")
                },
                events: {
                    mouseover: function (marker, event, context) {
                        $(this).gmap3(
                            {clear: "overlay"},
                            {
                                overlay: {
                                    latLng: marker.getPosition(),
                                    options: {
                                        content: "<div class='infobulle" + (context.data.drive ? " drive" : "") + "'>" +
                                        "<div class='bg'></div>" +
                                        "<div class='text'>" + context.data.city + " - " + context.data.zip + "</div>" +
                                        "</div>" +
                                        "<div class='arrow'></div>",
                                        offset: {
                                            x: -46,
                                            y: -73
                                        }
                                    }
                                }
                            });
                    },
                    mouseout: function () {
                        $(this).gmap3({clear: "overlay"});
                    }
                }
            }
        });

    });
</script>
</body>
</html>