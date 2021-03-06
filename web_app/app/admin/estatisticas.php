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
    <link href='assets/libs/morrischart/morris.css' rel='stylesheet' type='text/css'/>
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
            <p class='text-center'>Tem a certeza que pretende abandonar a WeControl?</p>

            <p class='text-center'>
                <button class='btn btn-danger md-close'>Não</button>
                <a href='php/verificacoes/sair.php' class='btn btn-success md-close'>Sim, tenho a certeza</a>
            </p>
        </div>
    </div>
</div>
<!-- Modal End -->

<!-- Begin page -->
<div id='wrapper'>";

require_once('php/includes/menus.php');
Menus('estatisticas');

echo "<!-- Start right content -->
    <div class='content-page'>
        <!-- ============================================================== -->
        <!-- Start Content here -->
        <!-- ============================================================== -->
        <div class='content'>
            <!-- Page Heading Start -->
            <div class='page-heading'>
                <h1><i class='fa fa-pie-chart'></i> Estatísticas</h1>
            </div>
            <!-- Page Heading End-->
            <div class='row'>
                <div class='col-md-12'>
                    <div class='widget'>
                        <div class='widget-header transparent'>
                            <h2>Número de <strong>Transmissões</strong> e <strong>Comentários</strong></h2>
<h2 id='primeiro' style='display: none !important;'>Colaborador por função e ano de admissão</h2>
                            <div class='additional-btn'>
                                <a href='#' class='hidden reload'><i class='icon-ccw-1'></i></a>
                                <a onclick='teste2();' class=''><i class='fa fa-floppy-o'></i></a>
                                <a href='#' class='widget-toggle'><i class='icon-down-open-2'></i></a>
                            </div>
                        </div>
                        <div class='widget-content padding'>
                            <div id='area-example'></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class='row' style='display:block;'>

                <div class='col-md-6'>
                    <div class='widget'>
                        <div class='widget-header transparent'>
                            <h2><strong>Utilizador por</strong> mês</h2>
<h2 id='segundo' style='display: none !important;'>Previsão de colaboradores</h2>
                            <div class='additional-btn'>
                                <a href='#' class='hidden reload'><i class='icon-ccw-1'></i></a>
                                 <a onclick='teste3();' class=''><i class='fa fa-floppy-o'></i></a>
                                <a href='#' class='widget-toggle'><i class='icon-down-open-2'></i></a>

                            </div>
                        </div>
                        <div class='widget-content padding'>
                            <div id='line-example'></div>
                        </div>
                    </div>
                </div>

                <div class='col-md-6'>
                    <div class='widget'>
                        <div class='widget-header transparent'>
                            <h2>Agendamentos por <strong>categoria</strong></h2>
<h2 id='terceiro' style='display: none !important;'>Colaboradores por função</h2>
                            <div class='additional-btn'>
                                <a href='#' class='hidden reload'><i class='icon-ccw-1'></i></a>
                                 <a onclick='teste4();' class=''><i class='fa fa-floppy-o'></i></a>
                                <a href='#' class='widget-toggle'><i class='icon-down-open-2'></i></a>
                            </div>
                        </div>
                        <div class='widget-content padding'>
                            <div id='donut-example'></div>
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
<script src='assets/libs/raphael/raphael-min.js'></script>
<script src='assets/libs/morrischart/morris.min.js'></script>
<!--<script src='assets/js/pages/morris-charts.js'></script>-->";?>
    <script type="text/javascript" src="teste/html2canvas-0.5.0-alpha1/dist/html2canvas.js"></script>
    <script src='assets/download-master/download.js'></script>
    <script type="text/javascript">

        function teste2() {

                html2canvas($("#area-example"), {
                    useCORS: true,
                    onrendered: function (canvas) {
                        // canvas is the final rendered <canvas> element

                        var nomeImagem = $('#primeiro').html();

                        var myImage = canvas.toDataURL("image/png");

                        download(myImage, nomeImagem, "image/png");

                        window.open(myImage);


                    }
                });
        }

        function teste3() {

            html2canvas($("#line-example"), {
                useCORS: true,
                onrendered: function (canvas) {
                    // canvas is the final rendered <canvas> element

                    var nomeImagem = $('#segundo').html();

                    var myImage = canvas.toDataURL("image/png");

                    download(myImage, nomeImagem, "image/png");

                    window.open(myImage);


                }
            });
        }

        function teste4() {

            html2canvas($("#donut-example"), {
                useCORS: true,
                onrendered: function (canvas) {
                    // canvas is the final rendered <canvas> element

                    var nomeImagem = $('#terceiro').html();

                    var myImage = canvas.toDataURL("image/png");

                    download(myImage, nomeImagem, "image/png");

                    window.open(myImage);


                }
            });
        }

    </script>

    <script>
        $(function () {
            Morris.Line({
                element: 'line-example',
                resize: true,
                data: [
                    <?php

                    $inicioDataAdmissao = 01;

                        while($inicioDataAdmissao <= 12){

                        $query = "SELECT MONTH( data_registo ) , funcao, COUNT( id_utilizador )
                        FROM utilizadores WHERE MONTH( data_registo ) = ?";

                            $stmt = mysqli_prepare($link, $query);
                            mysqli_stmt_bind_param($stmt, 'i', $inicioDataAdmissao);
                            mysqli_stmt_bind_result($stmt, $anoAju, $funcaoAju, $resultadoAju);
                           mysqli_stmt_execute($stmt);
                            mysqli_stmt_fetch($stmt);
                            mysqli_stmt_close($stmt);

                        
                        if($inicioDataAdmissao == 01){
                            echo "{ y: '2016-$inicioDataAdmissao', a: $resultadoAju},";
                        }else{
                            echo "{ y: '2015-$inicioDataAdmissao', a: $resultadoAju},";
                        }

                        $inicioDataAdmissao = $inicioDataAdmissao + 1;

                        }

                        $percentage = 10;

                        $previsaoPendente2016 = $resultadoAju*($percentage/100);
                        $previsao2016 = $previsaoPendente2016 + $resultadoAju;

                        $previsaoPendente2017 = $previsao2016*($percentage/100);
                        $previsao2017 = $previsaoPendente2017 + $previsao2016;

                        $inicioDataAdmissao = $inicioDataAdmissao + 1;

                    ?>

                ],
                xkey: 'y',
                ykeys: ['a'],
                labels: ['Utilizadores']
            });





            Morris.Donut({
                element: 'donut-example',
                resize: true,
                data: [<?php

                $estado  = 1;
                $query = "SELECT categoria, COUNT( id_agendamentos ) FROM agendamentos WHERE ativo = ? GROUP BY categoria";

                $stmt = mysqli_prepare($link, $query);
                    mysqli_stmt_bind_param($stmt, 'i', $estado);
                    mysqli_stmt_bind_result($stmt, $funcaoDonut, $numeroDonut);
                    mysqli_stmt_execute($stmt);

                    while(mysqli_stmt_fetch($stmt)){

                    if(!empty($funcaoDonut)){
                    echo "{label: '$funcaoDonut', value: $numeroDonut},";}
                   }
                     mysqli_stmt_close($stmt);
                               ?>]
            });

            Morris.Area({
                element: 'area-example',
                resize: true,
                data: [

                    <?php

                    $inicioDataAdmissao = 1;

                while($inicioDataAdmissao <= 12){

                      $query = "SELECT MONTH( data_transmissao ), tema, COUNT( id_transmissao )
                    FROM transmissoes WHERE MONTH( data_transmissao ) = ?";

                        $stmt = mysqli_prepare($link, $query);
                        mysqli_stmt_bind_param($stmt, 'i', $inicioDataAdmissao);
                        mysqli_stmt_bind_result($stmt, $anoAju, $funcaoAju, $resultadoAju);
                       mysqli_stmt_execute($stmt);
                        mysqli_stmt_fetch($stmt);
                        mysqli_stmt_close($stmt);

                          $query = "SELECT MONTH( data_registo ), COUNT( id_comentarios_transmissoes )
                    FROM comentarios_transmissoes WHERE MONTH( data_registo ) = ?";
                        $stmt = mysqli_prepare($link, $query);
                        mysqli_stmt_bind_param($stmt, 'i', $inicioDataAdmissao);
                        mysqli_stmt_bind_result($stmt, $anoDis, $resultadoDis);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_fetch($stmt);
                        mysqli_stmt_close($stmt);



                        if($inicioDataAdmissao == 1){
                            echo "{ y: '2016-$inicioDataAdmissao', a: $resultadoAju, b: $resultadoDis},";
                        }else{
                            echo "{ y: '2015-$inicioDataAdmissao', a: $resultadoAju, b: $resultadoDis},";
                        }

                        $inicioDataAdmissao = $inicioDataAdmissao + 1;

                }
                ?>
                ],
                xkey: 'y',
                ykeys: ['a', 'b'],
                labels: ['Transmissões', 'Comentários']
            });





});

<?php echo "</script>
</body>
</html>";
?>