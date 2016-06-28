<?php

session_start();

if (!isset($_SESSION['ativoAdmin'])) {
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    header("location:entrar.php?url=$actual_link");
}

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
Menus('descricao', 'registarDescricao');

?>

<!-- Start right content -->
<div class="content-page">
<!-- ============================================================== -->
<!-- Start Content here -->
<!-- ============================================================== -->
<div class="content">
<!-- Page Heading Start -->
<div class="page-heading">
    <h1><i class='fa fa-info-circle'></i> Descrição de Funções</h1>

    <h3>Edite a descrição de uma função já existente, alterando os dados apresentados</h3></div>
<!-- Page Heading End-->
<div class="row">
    <div class="col-md-12">

        <?php

        if (isset($_GET['sucesso'])) {
            $nomeFuncao = $_GET['sucesso'];
            echo "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
               A descrição da função <b>$nomeFuncao</b> foi adicionada com sucesso.<br>
               <a class='alert-link'>Votos de uma excelente experiência!</a></div>";
        }

        if (isset($_GET['erro'])) {
            $nomeFuncao = $_GET['erro'];
            echo "<div class='alert alert-danger alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
               Ocorreu um erro ao adicionar a descrição da função <b>$nomeFuncao</b>.<br>
               <a class='alert-link'>Tente novamente!</a></div>";
        }
        ?>

        <!-- Your awesome content goes here -->
        <div class="widget animated fadeInDown">
            <form id="myWizard" action="php/verificacoes/verificaAdicionarDescricao.php" method="post">

                <section class="step" data-step-title="Descrição">
                    <div class="row">

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="inputEmail">Título da Função</label>
                                <input name="tituloFuncaoDefinicao" type="text"
                                       placeholder="Título da Função" autocomplete="on"
                                       required="required" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="inputEmail">Objetivo</label>

                                <textarea name="objetivoDefinicao" rows="5"
                                          placeholder="Objetivo da Função"
                                          class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="inputEmail">Enquadramento Orgânico</label>

                                <textarea name="enquadramentoDefinicao" rows="5"
                                          placeholder="Enquadramento Orgânico da Função"
                                          class="form-control"></textarea>
                            </div>
                        </div>

                    </div>
                </section>

                <section class="step" data-step-title="Conteúdo">
                    <div class="row">

                        <div class="widget">
                            <div class="widget-header" style="height: 82px !important;">
                                <h2><strong>Conteúdo</strong> da Função</h2>
                                <h5 style="padding: 4px 13px 4px 13px !important;
    margin: 0px !important;
    font-weight: 400 !important;
    display: block !important;
    color: #5b5b5b !important;">Manipule os conteúdos que pretende inserir com total liberdade.
                                    As funcionalidades são semelhantes às do <strong>MICROSOFT OFFICE 2013</strong>.
                                </h5>
                            </div>

                            <div class="widget-content">
                                <textarea rows="20" id="ckeditor" name="conteudoDescricao"
                                          placeholder="Introduza e manipule os seus conteudos"></textarea>
                            </div>
                        </div>

                    </div>
                </section>

                <section class="step" data-step-title="Competências">
                    <div class="row">

                        <div class="widget">
                            <div class="widget-header">
                                <h2><strong>Competências</strong> Técnicas</h2>
                            </div>

                            <div class="widget-content">
                                <textarea rows="20" id="t1" name="tecnicasDescricao"></textarea>
                            </div>
                        </div>

                        <div class="widget">
                            <div class="widget-header">
                                <h2><strong>Competências</strong> Comportamentais</h2>
                            </div>

                            <div class="widget-content">
                                <textarea rows="20" id="t2" name="comportamentaisDescricao"></textarea>
                            </div>
                        </div>

                    </div>
                </section>

                <section class="step" data-step-title="Outros">
                    <div class="row">

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="inputEmail">Requisitos Mínimos</label>

                                <textarea name="requisitosDefinicao" rows="4"
                                          placeholder="Requisitos Mínimos da Função"
                                          class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="inputEmail">Substituído por:</label>
                                <input name="substitutoDefinicao" type="text"
                                       placeholder="Substituto da Função" autocomplete="on"
                                       required="required" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="inputEmail">Condições Físicas e Materiais</label>

                                <textarea name="fisicasMateriaisDefinicao" rows="4"
                                          placeholder="Condições Físicas e Materiais da Função"
                                          class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="inputEmail">Contrapartidas Remuneratórias</label>

                                <textarea name="contrapartidasDefinicao" rows="4"
                                          placeholder="Contrapartidas Remuneratórias da Função"
                                          class="form-control"></textarea>
                            </div>
                        </div>

                    </div>
                </section>
            </form>
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
<script src="assets/libs/jquery-wizard/jquery.easyWizard.js"></script>
<script src="assets/js/pages/form-wizard.js"></script>
<script src='assets/js/apps/calculator.js'></script>
<script src='assets/libs/bootstrap-inputmask/inputmask.js'></script>

<!-- Page Specific JS Libraries -->
<script src="assets/libs/bootstrap-select/bootstrap-select.min.js"></script>
<script src="assets/libs/bootstrap-inputmask/inputmask.js"></script>
<script src="assets/libs/bootstrap-xeditable/js/bootstrap-editable.min.js"></script>
<script src="assets/libs/bootstrap-xeditable/demo/jquery.mockjax.js"></script>
<script src="assets/libs/bootstrap-xeditable/demo/demo-mock.js"></script>
<script src="assets/libs/bootstrap-select2/select2.min.js"></script>
<script src="assets/libs/jquery-clndr/moment-2.5.1.js"></script>
<script src="assets/libs/bootstrap-typeahead/bootstrap3-typeahead.min.js"></script>
<script src="assets/libs/ckeditor/ckeditor.js"></script>
<script src="assets/libs/ckeditor/adapters/jquery.js"></script>
<script src="assets/js/pages/advanced-forms.js"></script>

<script>
    CKEDITOR.replace('t1',
        {
            width: "100%",
            height: "200px",
        }
    ).setData('');
</script>

<script>
    CKEDITOR.replace('t2',
        {
            width: "100%",
            height: "200px",
        }
    ).setData('');
</script>
<!--<style>-->
<!--    #cke_117, #cke_166, #cke_159, #cke_188, {-->
<!--        display: none !important; }-->
<!--    #cke_95, #cke_24, #cke_73, #cke_66, {-->
<!--        display: none !important;    }-->
<!--    #cke_208, #cke_250, #cke_257, #cke_279, {-->
<!--        display: none !important;    }-->
<!--    #cke_1_contents {-->
<!--        height: 200px !important;    }-->
<!--    #cke_2_contents {-->
<!--        height: 200px !important;    }-->
<!--    #cke_3_contents {-->
<!--        height: 350px !important;    }-->
<!--</style>-->
<!--<style>-->
<!--    #cke_16, #cke_87, #cke_65 {-->
<!--        display: none !important;-->
<!--    }-->
<!---->
<!--</style>-->
</body>
</html>