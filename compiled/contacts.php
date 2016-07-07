<?php

session_start();

require_once 'api/funcoes/utils.php';
require_once 'api/funcoes/menu.php';
require_once 'api/funcoes/footer.php';

checkSession();

?>

<!DOCTYPE html>
<html lang="pt" xmlns:height="http://www.w3.org/1999/xhtml" xmlns:width="http://www.w3.org/1999/xhtml">

<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7">
<![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8">
<![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9">
<![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<!--[if lt IE 9]>
<script type="text/javascript" src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script type="text/javascript" src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<head>

    <title>MCMM</title>

    <!--METAS-->
    <?php metas(); ?>

    <!--FAVICON-->
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="images/favicon/normal/apple-touch-icon-57x57.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/favicon/normal/apple-touch-icon-114x114.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/favicon/normal/apple-touch-icon-72x72.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/favicon/normal/apple-touch-icon-144x144.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="images/favicon/normal/apple-touch-icon-60x60.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="images/favicon/normal/apple-touch-icon-120x120.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="images/favicon/normal/apple-touch-icon-76x76.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="images/favicon/normal/apple-touch-icon-152x152.png"/>
    <link rel="icon" type="image/png" href="images/favicon/normal/favicon-196x196.png" sizes="196x196"/>
    <link rel="icon" type="image/png" href="images/favicon/normal/favicon-96x96.png" sizes="96x96"/>
    <link rel="icon" type="image/png" href="images/favicon/normal/favicon-32x32.png" sizes="32x32"/>
    <link rel="icon" type="image/png" href="images/favicon/normal/favicon-16x16.png" sizes="16x16"/>
    <link rel="icon" type="image/png" href="images/favicon/normal/favicon-128.png" sizes="128x128"/>
    <meta name="application-name" content="MCMM"/>
    <meta name="msapplication-TileColor" content="#FFFFFF"/>
    <meta name="msapplication-TileImage" content="images/favicon/normal/mstile-144x144.png"/>
    <meta name="msapplication-square70x70logo" content="images/favicon/normal/mstile-70x70.png"/>
    <meta name="msapplication-square150x150logo" content="images/favicon/normal/mstile-150x150.png"/>
    <meta name="msapplication-wide310x150logo" content="images/favicon/normal/mstile-310x150.png"/>
    <meta name="msapplication-square310x310logo" content="images/favicon/normal/mstile-310x310.png"/>

    <link rel="stylesheet" href="styles/main-5071e0f3e9.css">

    <script src="scripts/vendor/modernizr-9d550bd14f.js"></script>

</head>

<body data-offset="80" data-target=".navbar" data-spy="scroll">

<?php menu(); ?>

<div id="platform">

    <div class="projects-header">
        <div class="contents" style="background-image: url(/images/backgrounds/contactos.jpeg)">
            <div class="container">
                <div class="row">
                    <div class="description">
                        <h2 class="title">Contactos</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section section-gray">
        <div class="container">
            <div class="row">
                <div onclick="window.open('https://www.google.pt/maps/place/Universidade+de+Aveiro/@40.6303065,-8.6597,17z/data=!3m1!4b1!4m5!3m4!1s0xd23a2aa4e1bda2b:0xd70b976749475485!8m2!3d40.6303024!4d-8.657506', '_blank')"
                     class="splash col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="card card-splash card-splash-contacts">
                        <div class="link">Obter direções
                            <span class="arrow"></span>
                        </div>
                        <div class="content">
                            <a class="card-link">
                                <h4 class="title">Universidade de Aveiro</h4>
                            </a>
                            <div class="excerpt">
                                <small>Campus Universitário de Santiago, 3810-193 Aveiro</small>
                                <br>
                                <small>234 370 200</small>
                            </div>
                        </div>
                        <div class="image">
                            <div class="carousel slide">
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <img src="http://seminariocts2016.web.ua.pt/wp-content/themes/nirvana/images/columns/ua.jpg"
                                             alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div onclick="window.open('https://www.google.pt/maps/place/DECA+-+Departamento+de+Comunica%C3%A7%C3%A3o+e+Arte/@40.6288431,-8.65882,17z/data=!3m1!4b1!4m5!3m4!1s0xd23a2ac782797cd:0x829e10aa3e1ff33a!8m2!3d40.628839!4d-8.656626', '_blank')"
                     class="splash col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="card card-splash card-splash-contacts">
                        <div class="link">Obter direções
                            <span class="arrow"></span>
                        </div>
                        <div class="content">
                            <a class="card-link">
                                <h4 class="title">Mestrado em Comunicação Multimédia</h4>
                            </a>
                            <div class="excerpt">
                                <small>Departamento de Comunicação e Arte</small>
                                <br>
                                <small>234 370 868</small>
                            </div>
                        </div>
                        <div class="image">
                            <div class="carousel slide">
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <img src="http://connector.web.ua.pt/users/17/foto/deca.jpg"
                                             alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="row">

                <form id="contact-us" class="contact-us">
                    <div class="col-lg-12">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-style">

                            <span class="input input--isao">
                                <input class="input__field input__field--isao" type="text" id="1"/>
                                    <label class="input__label input__label--isao" for="1" data-content="Nome">
                                         <span class="input__label-content input__label-content--isao">Nome
                                        </span>
                                    </label>
                            </span>

                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-style">

                            <span class="input input--isao">
                                <input class="input__field input__field--isao" type="text" id="2"/>
                                    <label class="input__label input__label--isao" for="2" data-content="Apelido">
                                         <span class="input__label-content input__label-content--isao">Apelido
                                        </span>
                                    </label>
                            </span>

                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-style">

                          <span class="input input--isao">
                                <input class="input__field input__field--isao" type="text" id="3"/>
                                    <label class="input__label input__label--isao" for="3" data-content="Assunto">
                                         <span class="input__label-content input__label-content--isao">Assunto
                                        </span>
                                    </label>
                            </span>

                        </div>
                    </div>


                    <div class="col-lg-12">
                        <div class="col-lg-12 form-style">
                         <span class="input input--isao">
                                <textarea class="input__field input__field--isao" id="4" rows="4"></textarea>
                                    <label class="input__label input__label--isao" for="4" data-content="Mensagem">
                                         <span class="input__label-content input__label-content--isao">Mensagem
                                        </span>
                                    </label>
                            </span>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <a class="btn btn-info pull-left">
                            Enviar mensagem
                        </a>

                    </div>

                </form>
            </div>
        </div>
    </div>

    <?php footer() ?>

</div>

<!--MODALS-->
<?php

require_once 'api/funcoes/modals.php';
//modals();

?>

<script src="scripts/vendor-c259ccb7d9.js"></script>

<script src="scripts/plugins-aaf19e1ea7.js"></script>

<script src="scripts/contacts-718447bc58.js"></script>

</body>
</html>
