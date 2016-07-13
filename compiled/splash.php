<?php

session_start();

require_once 'api/funcoes/utils.php';
require_once 'api/funcoes/menu.php';
require_once 'api/connection/mysql.php';

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

    <style>
        @media screen and (max-width: 772px) {
            .cd-programa-wrapper {
                max-width: 300px;
                left: 50%;
                transform: translateX(-50%);
            }
        }
    </style>

</head>

<body data-offset="80" data-target=".navbar" data-spy="scroll" id="splash">

<?php menu(); ?>

<menu id="menu-dots">
    <nav id="primary">
        <ul>
            <li>
                <h1>Sobre</h1>
                <a class="sobre" href=#sobre"></a>
            </li>
            <li>
                <h1>Candidaturas</h1>
                <a class="candidaturas" href="#candidaturas"></a>
            </li>
            <li>
                <h1>Programa Curricular</h1>
                <a class="programa-curricular" href="#programa-curricular"></a>
            </li>
            <li>
                <h1>Canal</h1>
                <a class="canal" href="#canal"></a>
            </li>
            <li>
                <h1>Notícias</h1>
                <a class="noticias" href="#noticias"></a>
            </li>
            <li>
                <h1>Projetos</h1>
                <a class="projetos" href="#projetos"></a>
            </li>
            <li>
                <h1>Alunos</h1>
                <a class="alunos" href="#alunos"></a>
            </li>
            <li>
                <h1>Corpo Docente</h1>
                <a class="docentes" href="#docentes"></a>
            </li>
            <li>
                <h1>Informações</h1>
                <a class="informacoes" href="#informacoes"></a>
            </li>
        </ul>
    </nav>
</menu>

<section class="home-header dark" id="video-splash">
    <div class="homepage-welcome">
        <div class="video-container">
            <div class="title-container">
                <div class="headline">
                    <h1 class="video-title large wow fadeInUp" data-wow-delay="0s" data-wow-duration="1.5s">
                        MESTRADO EM COMUNICAÇÃO MULTIMÉDIA
                    </h1>
                    <h2 class="video-description wow fadeInUp" data-wow-delay="0.4s" data-wow-duration="1.5s">
                        <span>Play is the highest form of </span><span id="typed" style="white-space:pre;"></span>
                    </h2>
                    <div class="row wow fadeInUp" data-wow-delay="0.8s" data-wow-duration="1.5s">
                        <div class="col-md-12 control-cand">
                            <a href="https://paco.ua.pt/CandidaturasPG/main.aspx" style=""
                               class="mcmm-button large see-through-2 has-icon" target="_blank">
                                <span>Candidaturas</span>
                                <i class="pe-7s-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="filter"></div>
            <video autoplay loop muted class="fillWidth" poster="video/video.jpg">
                <source src="video/video.webm" type="video/webm"/>
                <source src="video/video.mp4" type="video/mp4"/>
                <source src="video/video.ogg" type="video/ogg"/>
            </video>
        </div>
        <section id="arrow-header" class="demo wow fadeInUp" data-wow-delay="1.2s" data-wow-duration="1.5s">
            <a href="" class="sobre"><span></span></a>
        </section>
    </div>
</section>

<section class="section-info whatwedo" id="sobre">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-push-6 wow fadeInUp animated" data-wow-duration="2s">
                <div class="whatwedo-description no-padding">
                    <h3>Sobre o Mestrado</h3>
                    <p>O Mestrado em Comunicação Multimédia (MCMM) tem como objetivo fundamental o reforço da formação
                        de profissionais na área da comunicação multimédia, nomeadamente na produção de artefactos
                        comunicacionais multimédia (ramo Multimédia Interativo) ou na criação de conteúdos audiovisuais
                        digitais (ramo Audiovisual Digital).</p>
                    <p class="bottom">O MCMM organiza-se em dois percursos de
                        formação: o percurso de Multimédia Interativo e o percurso de Audiovisual Digital.</p>
                    <div class="whatwedo">
                        <a class="mcmm-button large see-through-2 has-icon" target="_blank"
                        href="https://paco.ua.pt/CandidaturasPG/main.aspx">
                            <span>Candidaturas</span>
                            <i class="pe-7s-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-sm-pull-6 wow fadeInUp" data-wow-duration="2s">
                <ul class="skills">
                    <li data-percent="25" class="skills-animated">
                        <span>Comunicação</span>
                        <div class="progress">
                        </div>
                    </li>
                    <li data-percent="75" class="skills-animated">
                        <span>Multimédia</span>
                        <div class="progress">
                        </div>
                    </li>
                    <li data-percent="75" class="skills-animated">
                        <span>Audiovisual</span>
                        <div class="progress">
                        </div>
                    </li>
                    <li data-percent="50" class="skills-animated">
                        <span>Design</span>
                        <div class="progress">
                        </div>
                    </li>
                    <li data-percent="75" class="skills-animated">
                        <span>UX/UI</span>
                        <div class="progress">
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="researchareas dark parallax-section-2">
    <div class="container">
        <div class="row">
            <div class="col-md-4 wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="1s">
                <article>
                    <svg style="display: none" id="tec-com_svg" viewBox="0 0 380 380">
                        <defs>
                            <style>.cls-1 {
                                    fill: none;
                                    stroke: #fff;
                                    stroke-miterlimit: 10;
                                    stroke-width: 4px;
                                }</style>
                        </defs>
                        <path class="cls-1"
                              d="M-112.76,355.7l-97.62-97.62a6,6,0,0,0-8.48,0l-24.39,24.39-8.49-8.49,64.09-64.09a6,6,0,0,0,0-8.48l-3-3,24-24a6,6,0,0,0,1.73-4.76l-2.51-29.25a23.21,23.21,0,0,0-6.05-13l-11.13-11.13a23.2,23.2,0,0,0-13-6.05l-29.25-2.51h-0.14l-0.45,0h-0.23l-0.39,0-0.24,0-0.38.07-0.23.05-0.38.12-0.2.07-0.39.17-0.18.08-0.39.22-0.15.09-0.39.28-0.12.09c-0.16.13-.32,0.28-0.48,0.43l-24,24-3-3a6,6,0,0,0-8.48,0l-64.09,64.09-8.48-8.48,24.39-24.39a6,6,0,0,0,0-8.48L-412.86,55.6a6,6,0,0,0-8.48,0l-57.26,57.26a6,6,0,0,0,0,8.49L-381,219a6,6,0,0,0,4.24,1.75A6,6,0,0,0-372.5,219l24.39-24.39,8.49,8.49-61.56,61.55a6,6,0,0,0,0,8.48l21.33,21.34-9.63,9.63a121.42,121.42,0,0,0-71.22-22.85A123.18,123.18,0,0,0-482,283.09a6,6,0,0,0-4.68,4.11,6,6,0,0,0,1.48,6L-453,325.45l-5.36,52.24a6,6,0,0,0,1.73,4.86l17,17a6,6,0,0,0,4.24,1.76,5.47,5.47,0,0,0,.61,0l52.24-5.36,32.21,32.21a6,6,0,0,0,4.24,1.76,6,6,0,0,0,1.8-.28,6,6,0,0,0,4.11-4.68,122.59,122.59,0,0,0-18.67-89.14l10.18-10.19L-330.26,344a6,6,0,0,0,4.24,1.76,6,6,0,0,0,4.24-1.76l61.55-61.55,8.49,8.48-24.39,24.39a6,6,0,0,0,0,8.48l97.62,97.62a6,6,0,0,0,4.24,1.76,6,6,0,0,0,4.24-1.76l57.27-57.27a6,6,0,0,0,0-8.48h0ZM-328,157.46l-10.6,10.6-40.33-40.32,10.61-10.6Zm-137.91-40.36,10.6-10.61,27.6,27.6a6,6,0,0,0,4.24,1.76,6,6,0,0,0,4.24-1.76,6,6,0,0,0,0-8.48L-446.79,98l10.6-10.6,27.6,27.6a6,6,0,0,0,4.24,1.76,6,6,0,0,0,4.24-1.76,6,6,0,0,0,0-8.48l-27.6-27.6,10.6-10.6,40.32,40.32-14.84,14.84-19.09,19.09-14.85,14.84Zm89.14,89.13-40.33-40.33,10.6-10.6,40.32,40.32Zm24.39-24.39-5.3,5.3L-398,146.83l10.6-10.6,40.32,40.33Zm125-59.7,27.22,27.22a6,6,0,0,0,4.24,1.76,6,6,0,0,0,4.24-1.76,6,6,0,0,0,0-8.48l-19.83-19.84,12.86,1.11a11.67,11.67,0,0,1,5.55,2.58l11.13,11.13a11.72,11.72,0,0,1,2.58,5.55l2.28,26.46L-199.11,190l-48-48ZM-433.23,389l-12.94-12.94,4.08-39.69,48.55,48.55Zm82.61,21.87L-468,293.47q3.67-.24,7.34-0.24a109.48,109.48,0,0,1,67.95,23.39l0.12,0.09a112,112,0,0,1,9.95,8.83,110.51,110.51,0,0,1,32.07,85.35h0ZM-366.13,326q-3.8-4.63-8.07-8.93-2.84-2.83-5.82-5.45l8.67-8.67,14.14,14.14Zm40.11,5.32-62.43-62.43,125.64-125.64,62.43,62.43Zm62.62-11.71,10.6-10.6,27.6,27.6a6,6,0,0,0,4.24,1.76,6,6,0,0,0,4.24-1.76,6,6,0,0,0,0-8.48l-27.6-27.6,5.3-5.3,5.31-5.31,27.6,27.6a6,6,0,0,0,4.24,1.76,6,6,0,0,0,4.24-1.76,6,6,0,0,0,0-8.48l-27.6-27.6,10.6-10.61,40.32,40.32-48.78,48.78Zm89.14,89.14-40.32-40.32,10.6-10.6,40.32,40.32Zm19.09-19.09-40.32-40.32,10.6-10.61L-144.57,379Zm19.09-19.09-40.33-40.32,10.6-10.6,40.32,40.32Zm0,0"
                              transform="translate(489 -51.84)"/>
                        <path class="cls-1"
                              d="M-465.16,391a6,6,0,0,0-8.48,0,6,6,0,0,0,0,8.48l17,17a6,6,0,0,0,4.24,1.76,6,6,0,0,0,4.24-1.76,6,6,0,0,0,0-8.49Zm0,0"
                              transform="translate(489 -51.84)"/>
                    </svg>
                    <p></p>
                    <h5 class="text-center">
                        Tec. Comunicação
                    </h5>
                </article>
            </div>
            <div class="col-md-4 wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="1s">
                <article>
                    <svg style="display: none" id="social-sci_svg" viewBox="0 0 412.8 342.34">
                        <defs>
                            <style>.cls-1 {
                                    fill: none;
                                    stroke: #fff;
                                    stroke-miterlimit: 10;
                                    stroke-width: 4px;
                                }</style>
                        </defs>
                        <path class="cls-1"
                              d="M-202.89-51.31a6,6,0,0,0-.73-0.16L-253.55-59c-8.07-5.22-8.84-18.18-8.85-32.21a92.35,92.35,0,0,0,25.6-64.43v-2a56.92,56.92,0,0,0,19.2-42.75v-38.4A57.26,57.26,0,0,0-274.8-296H-358a25.25,25.25,0,0,0-24.55,19.52,44.47,44.47,0,0,0-39,44.08v32a56.92,56.92,0,0,0,19.2,42.75v2a92.35,92.35,0,0,0,25.6,64.43c0,14-.78,27-8.85,32.21l-49.92,7.49a5.87,5.87,0,0,0-.73.16,48.26,48.26,0,0,0-27,19.69A54.56,54.56,0,0,0-472.8-1.19V23.6c0,10.34,9.22,18.74,20.56,18.74H-187c11.34,0,20.55-8.41,20.55-18.74V-1.19a54.53,54.53,0,0,0-9.48-30.43,48.26,48.26,0,0,0-27-19.69h0ZM-319.6-66.4A78.17,78.17,0,0,0-274.2-81c0.57,10.95,2.84,23.1,11.75,30.42C-267.27-26.1-291.2-8-319.6-8s-52.33-18.1-57.15-42.62C-367.84-57.94-365.58-70.09-365-81A78.16,78.16,0,0,0-319.6-66.4h0Zm-70.8-93.45a6.45,6.45,0,0,0,0-1.09V-194a19.62,19.62,0,0,1,19.6-19.6H-262a6,6,0,0,0,6-6,6,6,0,0,0-6-6H-370.8A31.63,31.63,0,0,0-402.4-194v18.08a45,45,0,0,1-7.2-24.48v-32a32.44,32.44,0,0,1,32.4-32.4,6,6,0,0,0,6-6A13.22,13.22,0,0,1-358-284h83.2a45.25,45.25,0,0,1,45.2,45.2v38.4a45,45,0,0,1-7.2,24.48V-200.4a6,6,0,0,0-6-6,6,6,0,0,0-6,6v44.8c0,42.57-31.76,77.2-70.8,77.2s-70.8-34.63-70.8-77.2v-4.25Zm212,183.45c0,3.66-3.92,6.74-8.55,6.74H-452.25c-4.64,0-8.55-3.09-8.55-6.74V-1.19c0-15.21,9.41-33.24,27.39-38.47l45.27-6.79C-381.43-17.3-353.06,4-319.6,4s61.83-21.3,68.54-50.45l45.27,6.79c18,5.23,27.39,23.26,27.39,38.47V23.6Zm0,0"
                              transform="translate(526 298)"/>
                        <path class="cls-1"
                              d="M-486-27.2h-22.58c-2,0-3.42-1.19-3.42-2.25v-16c0-9,5.52-19.67,16.06-22.81l32.66-4.9,0.41-.08,0.18,0a6.46,6.46,0,0,0,.65-0.21l0.15-.07a5.1,5.1,0,0,0,.51-0.24l0.09,0,0.15-.09L-461-74c7.27-4.15,9.79-11.66,10.65-19a52.36,52.36,0,0,0,26.84,7.43,52.1,52.1,0,0,0,23.38-5.51,6,6,0,0,0,2.7-8,6,6,0,0,0-8-2.7,40.18,40.18,0,0,1-18,4.26c-24.09,0-43.69-21.46-43.69-47.83V-171a10.57,10.57,0,0,1,10.56-10.57h15.44a6,6,0,0,0,6-6,6,6,0,0,0-6-6h-15.44A22.59,22.59,0,0,0-479.2-171v3.15a27.16,27.16,0,0,1-.8-6.54v-20.7A18.86,18.86,0,0,1-461.16-214a6,6,0,0,0,6-6,6.43,6.43,0,0,1,6.42-6.42h7.54a6,6,0,0,0,6-6,6,6,0,0,0-6-6h-7.54a18.45,18.45,0,0,0-17.56,12.85A30.9,30.9,0,0,0-492-195.13v20.7a38.91,38.91,0,0,0,12.8,28.94v0.05a61.82,61.82,0,0,0,17.3,43.28c-0.07,7.63-.65,14.47-4.42,17.28l-31.8,4.77a6.57,6.57,0,0,0-.73.16C-515.36-75.32-524-59.11-524-45.49v16c0,7.85,6.91,14.25,15.42,14.25H-486a6,6,0,0,0,6-6,6,6,0,0,0-6-6h0Zm0,0"
                              transform="translate(526 298)"/>
                        <path class="cls-1"
                              d="M-140.36-80a5.86,5.86,0,0,0-.73-0.16l-31.79-4.77c-3.77-2.81-4.36-9.65-4.42-17.28A61.81,61.81,0,0,0-160-145.44v-0.05a38.94,38.94,0,0,0,12.8-28.94V-206.8a31.64,31.64,0,0,0-31.6-31.6H-198a6,6,0,0,0-6,6,6,6,0,0,0,6,6h19.2a19.62,19.62,0,0,1,19.6,19.6v32.37a27.32,27.32,0,0,1-.8,6.54V-171a22.59,22.59,0,0,0-22.56-22.56H-198a6,6,0,0,0-6,6,6,6,0,0,0,6,6h15.44A10.57,10.57,0,0,1-172-171v25.59c0,26.37-19.6,47.83-43.69,47.83a40.16,40.16,0,0,1-18-4.26,6,6,0,0,0-8,2.7,6,6,0,0,0,2.7,8,52.09,52.09,0,0,0,23.38,5.51A52.36,52.36,0,0,0-188.86-93c0.87,7.34,3.38,14.85,10.65,19l0.13,0.08,0.16,0.09,0.08,0a5.1,5.1,0,0,0,.51.24l0.15,0.07a6.51,6.51,0,0,0,.65.21l0.18,0,0.41,0.08,32.66,4.9c10.55,3.14,16.06,13.81,16.06,22.81v16c0,1.06-1.46,2.25-3.42,2.25H-153.2a6,6,0,0,0-6,6,6,6,0,0,0,6,6h22.58c8.5,0,15.42-6.39,15.42-14.25v-16c0-13.63-8.64-29.84-25.16-34.46h0Zm0,0"
                              transform="translate(526 298)"/>
                    </svg>
                    <p></p>
                    <h5 class="text-center">Ciências Sociais</h5>
                </article>
            </div>
            <div class="col-md-4 wow fadeInUp" data-wow-delay="0.6s" data-wow-duration="1s">
                <article>
                    <svg style="display: none" id="design_svg" viewBox="0 0 344 338.33">
                        <defs>
                            <style>.cls-1 {
                                    fill: none;
                                    stroke: #fff;
                                    stroke-miterlimit: 10;
                                    stroke-width: 4px;
                                }</style>
                        </defs>
                        <path class="cls-1"
                              d="M46-233.78c-3.41,1.93-6.76,4-10,6.25a5.63,5.63,0,0,0-1.49,7.86,5.6,5.6,0,0,0,4.68,2.49,5.73,5.73,0,0,0,3.21-1c3-2,6.08-4,9.21-5.78a5.69,5.69,0,0,0,2.1-7.75,5.65,5.65,0,0,0-7.71-2.1h0Zm0,0"
                              transform="translate(50 273)"/>
                        <path class="cls-1"
                              d="M196.84-228a5.68,5.68,0,0,0,1.72,7.83c3,2,6.06,4.07,8.93,6.25a5.66,5.66,0,0,0,3.41,1.16,5.75,5.75,0,0,0,4.53-2.27,5.68,5.68,0,0,0-1.11-7.94c-3.1-2.35-6.36-4.59-9.65-6.72a5.69,5.69,0,0,0-7.83,1.69h0Zm0,0"
                              transform="translate(50 273)"/>
                        <path class="cls-1"
                              d="M274.57-112.73a5.69,5.69,0,0,0-6.08-5.23,5.67,5.67,0,0,0-5.23,6.06c0.14,1.74.14,3.49,0.2,5.23H246.68v45.35H292v-45.35H274.79c-0.08-2-.08-4.07-0.22-6.06h0Zm6.08,40.06H258V-95.33h22.66v22.66Zm0,0"
                              transform="translate(50 273)"/>
                        <path class="cls-1"
                              d="M-21.3-154.73c-1.36,3.65-2.61,7.42-3.71,11.18a5.65,5.65,0,0,0,3.87,7,5,5,0,0,0,1.58.23,5.67,5.67,0,0,0,5.45-4.09c1-3.49,2.16-6.95,3.44-10.32A5.7,5.7,0,0,0-14-158.06a5.71,5.71,0,0,0-7.3,3.32h0Zm0,0"
                              transform="translate(50 273)"/>
                        <path class="cls-1"
                              d="M260.73-151a5.7,5.7,0,0,0-3.68,7.14c1.08,3.41,2,6.95,2.88,10.49a5.7,5.7,0,0,0,5.53,4.37,7.1,7.1,0,0,0,1.3-.14A5.65,5.65,0,0,0,271-136c-0.89-3.82-1.93-7.66-3.1-11.34a5.72,5.72,0,0,0-7.14-3.71h0Zm0,0"
                              transform="translate(50 273)"/>
                        <path class="cls-1"
                              d="M231.93-207.39a5.68,5.68,0,0,0-8-.13,5.67,5.67,0,0,0-.11,8c2.52,2.6,5,5.31,7.27,8.1a5.57,5.57,0,0,0,4.35,2,5.7,5.7,0,0,0,3.62-1.3,5.7,5.7,0,0,0,.75-8c-2.52-3-5.15-5.95-7.86-8.75h0Zm0,0"
                              transform="translate(50 273)"/>
                        <path class="cls-1"
                              d="M25.38-204.57a5.7,5.7,0,0,0,.28-8,5.7,5.7,0,0,0-8-.28c-2.85,2.68-5.65,5.48-8.27,8.36a5.68,5.68,0,0,0,.33,8A5.64,5.64,0,0,0,13.51-195a5.61,5.61,0,0,0,4.17-1.85c2.47-2.66,5-5.26,7.69-7.72h0Zm0,0"
                              transform="translate(50 273)"/>
                        <path class="cls-1"
                              d="M254-160.93a5.48,5.48,0,0,0,2.51-.61,5.66,5.66,0,0,0,2.55-7.58c-1.74-3.51-3.66-7-5.67-10.35a5.67,5.67,0,0,0-7.78-1.94,5.67,5.67,0,0,0-1.93,7.78c1.86,3.07,3.63,6.31,5.23,9.55a5.72,5.72,0,0,0,5.09,3.15h0Zm0,0"
                              transform="translate(50 273)"/>
                        <path class="cls-1"
                              d="M-19.48-108.25c0.17-3.63.5-7.28,0.94-10.88a5.66,5.66,0,0,0-4.89-6.33,5.72,5.72,0,0,0-6.34,4.92c-0.5,3.85-.83,7.78-1,11.71a5.39,5.39,0,0,0,.3,2.15H-48v45.35H-2.68v-45.35H-19.89a5.15,5.15,0,0,0,.41-1.57h0ZM-14-72.67H-36.65V-95.33H-14v22.66Zm0,0"
                              transform="translate(50 273)"/>
                        <path class="cls-1"
                              d="M-5.2-186.06c-2.16,3.27-4.24,6.62-6.17,10a5.66,5.66,0,0,0,2.16,7.72,5.63,5.63,0,0,0,2.76.75,5.71,5.71,0,0,0,5-2.88c1.77-3.15,3.71-6.28,5.7-9.26a5.69,5.69,0,0,0-1.52-7.89,5.69,5.69,0,0,0-7.88,1.55h0Zm0,0"
                              transform="translate(50 273)"/>
                        <path class="cls-1"
                              d="M-25.34-225.68a22.61,22.61,0,0,0,21.86-17H65.33A5.6,5.6,0,0,0,64-236.55a5.64,5.64,0,0,0,5.28,3.65,5.27,5.27,0,0,0,2-.39c3.4-1.3,6.86-2.46,10.32-3.49a5.64,5.64,0,0,0,3.93-5.89H98.65a8.52,8.52,0,0,0,.69.64v16.35h45.32v-15.1c1.22,0.19,2.44.35,3.63,0.58a4.82,4.82,0,0,0,1,.11,5.66,5.66,0,0,0,4.7-2.57h12.35a5.65,5.65,0,0,0-.53.89,5.65,5.65,0,0,0,3.44,7.23c3.43,1.21,6.84,2.57,10.12,4a5.64,5.64,0,0,0,2.3.5,5.71,5.71,0,0,0,5.17-3.37,5.65,5.65,0,0,0-2.88-7.47c-1.47-.67-3-1.19-4.48-1.8h68a22.61,22.61,0,0,0,21.86,17A22.67,22.67,0,0,0,292-248.34,22.68,22.68,0,0,0,269.34-271a22.61,22.61,0,0,0-21.86,17H144.66v-17H99.34v17H-3.48a22.61,22.61,0,0,0-21.86-17A22.68,22.68,0,0,0-48-248.34a22.67,22.67,0,0,0,22.66,22.66h0Zm294.68-34a11.3,11.3,0,0,1,11.31,11.31A11.33,11.33,0,0,1,269.34-237,11.36,11.36,0,0,1,258-248.34a11.33,11.33,0,0,1,11.35-11.31h0Zm-158.69,0h22.7V-237h-22.7v-22.66Zm-136,0A11.33,11.33,0,0,1-14-248.34,11.36,11.36,0,0,1-25.34-237a11.33,11.33,0,0,1-11.31-11.35,11.3,11.3,0,0,1,11.31-11.31h0Zm0,0"
                              transform="translate(50 273)"/>
                        <path class="cls-1"
                              d="M127.67-214.33A5.69,5.69,0,0,0,122-220a5.69,5.69,0,0,0-5.67,5.67v4L15.2-55.68H44.06a32.65,32.65,0,0,1,32.6,32.63V35H88V63.33h68V35h11.31v-58a32.67,32.67,0,0,1,32.63-32.63H228.8L127.67-210.35v-4ZM122-78.34A11.36,11.36,0,0,1,133.35-67,11.33,11.33,0,0,1,122-55.68,11.33,11.33,0,0,1,110.65-67,11.36,11.36,0,0,1,122-78.34h0ZM144.66,52H99.34V35h45.32V52ZM156,23.68H88v-17h68v17ZM199.94-67A44,44,0,0,0,156-23.06v18.4H88v-18.4A44,44,0,0,0,44.06-67H36.14l80.18-122.66v100.8A22.61,22.61,0,0,0,99.34-67,22.67,22.67,0,0,0,122-44.33,22.67,22.67,0,0,0,144.66-67a22.61,22.61,0,0,0-17-21.86v-100.8L207.86-67h-7.91Zm0,0"
                              transform="translate(50 273)"/>
                    </svg>
                    <p></p>
                    <h5 class="text-center">Design</h5>
                </article>
            </div>
        </div>
    </div>
</section>

<section class="candidaturas" id="candidaturas">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <header class="section-header wow fadeInUp" data-wow-duration="1s">
                    <h2 class="text-center">Candidaturas</h2>
                    <p class="large">Se estás interessado em ingressar no Mestrado em Comunicação Multimédia, basta
                        seguires três passos para te candidatares.</p>
                </header>
            </div>
        </div><!--row-->
        <div class="row">
            <div class="col-md-4 wow fadeInUp " data-wow-duration="2s" data-wow-delay="0s">
                <article>
                    <div class="striped-icon-small">1</div>
                    <img src="images/icons/mouse.png"/>
                    <h5>Clica em Candidaturas</h5>
                    <p>Acede à página oficial da inscrição (PACO) para preencheres os teus dados</p>
                </article>
            </div>
            <div class="col-md-4 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.1s">
                <article>
                    <div class="striped-icon-small">2</div>
                    <img src="images/icons/computer.png"/>
                    <h5>Preenche os teus dados</h5>
                    <p>Preenche os dados solicitados cuidadosamente para procederes à submissão</p>
                </article>
            </div>
            <div class="col-md-4 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.2s">
                <article>
                    <div class="striped-icon-small">3</div>
                    <img src="images/icons/paper-plane.png"/>
                    <h5>Submete os dados</h5>
                    <p>Verifica se os dados que introduziste se encontram corretos e submete os mesmos</p>
                </article>
            </div>
            <div class="col-md-12 text-center whatwedo wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.4s">
                <a class="mcmm-button large see-through-2 has-icon" target="_blank"
                href="https://paco.ua.pt/CandidaturasPG/main.aspx">
                    <span>Candidaturas</span>
                    <i class="pe-7s-angle-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="curricular" id="programa-curricular">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <header class="section-header wow fadeInUp" data-wow-duration="2s">
                    <h2>Programa Curricular</h2>
                    <p class="large">Consulta o programa curricular do mestrado em Comunicação Multimédia</p>
                </header>
            </div>
        </div><!--row-->

        <div class="cd-programa-container wow fadeInUp" data-wow-duration="2s">

            <div class="row">
                <div class="col-xs-12 text-center">
                    <div class="programa-switcher">
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-info active button-curricular">
                                <input type="radio" name="duration-1" value="first" id="first-1" checked>
                                Audiovisual Digital
                            </label>
                            <label class="btn btn-info button-curricular">
                                <input type="radio" name="duration-1" value="second" id="second-1"> Multimédia
                                Interativo
                            </label>
                        </div>

                    </div>
                </div>
            </div>

            <div class="cd-programa-list cd-bounce-invert">
                <div class="row no-gutter">
                    <div class="col-sm-6 col-md-3">
                        <ul class="cd-programa-wrapper">

                            <li class="panel panel-curricular panel-default is-visible" data-type="first">
                                <div class="panel-heading text-center">
                                    <p class="subhead">1º SEMESTRE</p>
                                    <h5>1º ANO</h5>
                                </div>
                                <div class="panel-body text-center">
                                    <ul class="list-styled list-style-ok">
                                        <li class="principal">
                                            <span style="color: #2979ff">6 ects </span>
                                            <a style="color: #2b2e33" href="http://www.ua.pt/ensino/uc/4280"
                                               target="_blank">Conteúdos AV para Novos Media</a>
                                        </li>
                                        <li class="principal">
                                            <span style="color: #2979ff">8 ects </span>
                                            <a style="color: #2b2e33" href="http://www.ua.pt/ensino/uc/4507"
                                               target="_blank">Produção e Realização Audiovisual 1</a>
                                        </li>
                                        <li>
                                            <span style="color: #2979ff">6 ects </span>
                                            <a href="http://www.ua.pt/ensino/uc/4451" target="_blank">Metodologias de
                                                Projecto e Investigação</a>
                                        </li>
                                        <li>
                                            <span style="color: #2979ff">4 ects </span>
                                            <a href="http://www.ua.pt/ensino/uc/4568" target="_blank">Teoria dos
                                                Media</a>
                                        </li>
                                        <li>
                                            <span style="color: #2979ff">6 ects </span>
                                            <a href="http://www.ua.pt/ensino/uc/4301" target="_blank">Design de
                                                Comunicação Multimédia</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li class="panel panel-curricular panel-default is-hidden" data-type="second">
                                <div class="panel-heading  text-center ">
                                    <p class="subhead">1º SEMESTRE</p>
                                    <h5>1º ANO</h5>
                                </div>
                                <div class="panel-body text-center">
                                    <ul class="list-styled list-style-ok">
                                        <li class="principal">
                                            <span style="color: #2979ff">6 ects </span>
                                            <a style="color: #2b2e33" href="http://www.ua.pt/ensino/uc/4763"
                                               target="_blank">Serviços e Tecnologias Nas Instituições</a>
                                        </li>
                                        <li class="principal">
                                            <span style="color: #2979ff">8 ects </span>
                                            <a style="color: #2b2e33" href="http://www.ua.pt/ensino/uc/7464"
                                               target="_blank">Tecnologias Dinâmicas Para a Internet</a>
                                        </li>
                                        <li>
                                            <span style="color: #2979ff">6 ects </span>
                                            <a href="http://www.ua.pt/ensino/uc/4451" target="_blank">Metodologias de
                                                Projecto e Investigação</a>
                                        </li>
                                        <li>
                                            <span style="color: #2979ff">4 ects </span>
                                            <a href="http://www.ua.pt/ensino/uc/4568" target="_blank">Teoria dos
                                                Media</a>
                                        </li>
                                        <li>
                                            <span style="color: #2979ff">6 ects </span>
                                            <a href="http://www.ua.pt/ensino/uc/4301" target="_blank">Design de
                                                Comunicação Multimédia</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                        </ul>

                    </div>

                    <div class="col-sm-6 col-md-3">
                        <ul class="cd-programa-wrapper">

                            <li class="panel panel-curricular panel-default is-visible" data-type="first">
                                <div class="panel-heading  text-center">
                                    <p class="subhead">2º SEMESTRE</p>
                                    <h5>1º ANO</h5>
                                </div>
                                <div class="panel-body text-center">
                                    <ul class="list-styled list-style-ok">
                                        <li class="principal">
                                            <span style="color: #2979ff">8 ects </span>
                                            <a style="color: #2b2e33" href="http://www.ua.pt/ensino/uc/4508"
                                               target="_blank">Produção e Realização Audiovisual 2</a>
                                        </li>
                                        <li class="principal">
                                            <span style="color: #2979ff">6 ects </span>
                                            <a style="color: #2b2e33" href="http://www.ua.pt/ensino/uc/4520"
                                               target="_blank">Publicação e Divulgação em Plataformas Digitais</a>
                                        </li>
                                        <li class="principal">
                                            <span style="color: #2979ff">6 ects </span>
                                            <a style="color: #2b2e33" href="http://www.ua.pt/ensino/uc/4502"
                                               target="_blank">Pós-produção e Efeitos Especiais</a>
                                        </li>
                                        <li>
                                            <span style="color: #2979ff">4 ects </span>
                                            <a href="http://www.ua.pt/ensino/uc/4527" target="_blank">Redes e Ecologia
                                                dos Media</a>
                                        </li>
                                        <li>
                                            <span style="color: #2979ff">6 ects </span>
                                            <a href="http://www.ua.pt/ensino/uc/4287" target="_blank">Criatividade na
                                                Comunicação Multimédia</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li class="panel panel-curricular panel-default is-hidden" data-type="second">
                                <div class="panel-heading text-center">
                                    <p class="subhead">2º SEMESTRE</p>
                                    <h5>1º ANO</h5>
                                </div>
                                <div class="panel-body text-center">
                                    <ul class="list-styled list-style-ok">
                                        <li class="principal">
                                            <span style="color: #2979ff">6 ects </span>
                                            <a style="color: #2b2e33" href="http://www.ua.pt/ensino/uc/4765"
                                               target="_blank">Multimédia e Gestão de Conhecimento</a>
                                        </li>
                                        <li class="principal">
                                            <span style="color: #2979ff">7 ects </span>
                                            <a style="color: #2b2e33" href="http://www.ua.pt/ensino/uc/4766"
                                               target="_blank">Multimédia em Ambientes Artísticos</a>
                                        </li>
                                        <li class="principal">
                                            <span style="color: #2979ff">7 ects </span>
                                            <a style="color: #2b2e33" href="http://www.ua.pt/ensino/uc/4767"
                                               target="_blank">Narrativas e Jogos Interactivos</a>
                                        </li>
                                        <li>
                                            <span style="color: #2979ff">4 ects </span>
                                            <a href="http://www.ua.pt/ensino/uc/4527" target="_blank">Redes e Ecologia
                                                dos Media</a>
                                        </li>
                                        <li>
                                            <span style="color: #2979ff">6 ects </span>
                                            <a href="http://www.ua.pt/ensino/uc/4287" target="_blank">Criatividade na
                                                Comunicação Multimédia</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                        </ul>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <ul class="cd-programa-wrapper">

                            <li class="panel panel-curricular panel-default is-visible" data-type="first">
                                <div class="panel-heading  text-center">
                                    <p class="subhead">1º SEMESTRE</p>
                                    <h5>2º ANO</h5>
                                </div>
                                <div class="panel-body text-center">
                                    <ul class="list-styled list-style-ok">
                                        <li>
                                            <span style="color: #2979ff">10 ects </span>
                                            <a href="http://www.ua.pt/ensino/uc/4338" target="_blank">Estatística e
                                                Análise de Dados para Ciências Sociais 1</a>
                                        </li>
                                        <li>
                                            <span style="color: #2979ff">8 ects </span>
                                            <a href="http://www.ua.pt/ensino/uc/4768" target="_blank">Seminário</a>
                                        </li>
                                        <li>
                                            <span style="color: #2979ff">12 ects </span>
                                            <a href="http://www.ua.pt/ensino/uc/4769" target="_blank">Projecto de
                                                Dissertação</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li class="panel panel-curricular panel-default is-hidden" data-type="second">
                                <div class="panel-heading  text-center">
                                    <p class="subhead">1º SEMESTRE</p>
                                    <h5>2º ANO</h5>
                                </div>
                                <div class="panel-body text-center">
                                    <ul class="list-styled list-style-ok">
                                        <li>
                                            <span style="color: #2979ff">10 ects </span>
                                            <a href="http://www.ua.pt/ensino/uc/4338" target="_blank">Estatística e
                                                Análise de Dados para Ciências Sociais 1</a>
                                        </li>
                                        <li>
                                            <span style="color: #2979ff">8 ects </span>
                                            <a href="http://www.ua.pt/ensino/uc/4768" target="_blank">Seminário</a>
                                        </li>
                                        <li>
                                            <span style="color: #2979ff">12 ects </span>
                                            <a href="http://www.ua.pt/ensino/uc/4769" target="_blank">Projecto de
                                                Dissertação</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>

                    </div>

                    <div class="col-sm-6 col-md-3">
                        <ul class="cd-programa-wrapper">

                            <li class="panel panel-curricular panel-default is-visible" data-type="first">
                                <div class="panel-heading text-center">
                                    <p class="subhead">2º SEMESTRE</p>
                                    <h5>2º ANO</h5>
                                </div>
                                <div class="panel-body text-center">
                                    <ul class="list-styled list-style-ok">
                                        <li>
                                            <span style="color: #2979ff">30 ects </span>
                                            <a href="http://www.ua.pt/ensino/uc/4770" target="_blank">Dissertação ou
                                                Projeto ou Estágio</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li class="panel panel-curricular panel-default is-hidden" data-type="second">
                                <div class="panel-heading text-center">
                                    <p class="subhead">2º SEMESTRE</p>
                                    <h5>2º ANO</h5>
                                </div>
                                <div class="panel-body text-center">
                                    <ul class="list-styled list-style-ok">
                                        <li>
                                            <span style="color: #2979ff">30 ects </span>
                                            <a href="http://www.ua.pt/ensino/uc/4770" target="_blank">Dissertação ou
                                                Projeto ou Estágio</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                        </ul>

                    </div>

                </div>
            </div>

        </div>

    </div>
</section>

<section class="video dark" id="canal">

    <?php channel() ?>

    <div class="video-bg"></div>
    <article>
        <div class="container">
            <div class="row">
                <div id="custom"
                     data-vide-bg="mp4: video/video.mp4, webm: video/video.webm, ogg: video/video.ogg, poster: video/video.jpg"
                     data-vide-options="posterType: jpg, position: 0% 0%">
                </div>
                <div class="col-md-5">
                    <h2 class="text-right">Canal</h2>
                </div>
                <div class="col-md-2">
                    <div class="control-channel-icon">
                        <a href="/channel">
                            <img src="images/icons/play-button.png">
                        </a>
                    </div>
                </div>
                <div class="col-md-5">
                    <h2 class="text-left">MCMM</h2>
                </div>
            </div>
        </div>
    </article>
</section>

<section class="noticias_section" id="noticias">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <header class="section-header  wow fadeInUp" data-wow-duration="2s">
                    <h2>Notícias</h2>
                    <p class="large">Consulta notícias acerca do MCMM para te manteres atualizado acerca dos mais
                        recentes acontecimentos.</p>
                </header>
            </div>
        </div>
        <div class="row">

            <?php

            $result = $conn->prepare("
                    SELECT id_noticias, titulo, tipo, preview, para_1, cabecalho
                    FROM noticias
                    WHERE ativo =1
                    AND destacado =1
                    ORDER BY data_publicacao DESC 
                    LIMIT 3");

            $result->execute();
            $result->bind_result($idNoticias, $titulo, $tipo, $preview, $para1, $cabecalho);

            while ($result->fetch()) {

                echo "
                <div class=\"splash col-xs-12 col-sm-12 col-md-4 col-lg-4 wow fadeInUp\" data-wow-duration=\"1s\" 
                onclick=\"window.location='/new/$idNoticias'\">
                    <div class=\"card card-splash\">
                        <div class=\"link\">Ver notícia
                            <span class=\"arrow\"></span>
                        </div>
                        <div class=\"content\">
                            <a class=\"card-link\">
                                <h4 class=\"title\">" . h($titulo) . "</h4>
                            </a>
                            <div class=\"excerpt\">";

                switch ($tipo) {
                    case "normal":
                        $excerto = substr($cabecalho, 0, 150) . '...';
                        break;
                    case "slider":
                        $excerto = substr($preview, 0, 150) . '...';
                        break;
                    case "text":
                        $excerto = substr($preview, 0, 150) . '...';
                        break;
                    case "video":
                        $excerto = substr($preview, 0, 150) . '...';
                        break;
                }

                echo h($excerto);

                echo "</div>
                        </div>
                        <div class=\"image\">
                            <div class=\"carousel slide\">
                                <div class=\"carousel-inner\">
                                    <div class=\"item active\">";

                switch ($tipo) {
                    case "normal":
                        echo "<img src='/api/utilizadores/noticias/$idNoticias.jpg' />";
                        break;
                    case "slider":
                        echo "<img src='/api/utilizadores/noticias/" . $idNoticias . "_1.jpg' />";
                        break;
                    case "text":
                        echo "<img src='/images/backgrounds/default.jpg' />";
                        break;
                    case "video":
                        if(file_exists("api/utilizadores/noticias/$idNoticias.jpg")){
                            echo "<img src='/api/utilizadores/noticias/$idNoticias.jpg' />";
                        }else{
                            echo "<img src='/images/backgrounds/default.jpg' />";
                        }
                        break;
                }

                echo "</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                ";

            }

            $result->close();

            ?>

            <div class="col-md-12 text-center whatwedo wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.4s">
                <a class="mcmm-button large see-through-2 has-icon" href="/news">
                    <span>Notícias</span>
                    <i class="pe-7s-angle-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="projetos" id="projetos">

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <header class="section-header wow fadeInUp" data-wow-duration="2s">
                    <h2 class="title-projects">Projetos</h2>
                    <p class="large">Explora alguns projetos, realizados no âmbito do MCMM, para que estejas atualizado
                        quanto ao que por cá se faz.</p>
                </header>
            </div>
        </div>

        <div class="row">

            <div class="col-sm-12 col-lg-6 no-padding">

                <?php
                $result = $conn->prepare("
                    SELECT projetos.id_projetos, projetos.titulo, projetos.data_publicacao,
                    projetos.ativo, projetos.tipo
                    FROM projetos 
                    WHERE projetos.ativo = 1 AND projetos.destacado = 1
                    ORDER BY projetos.data_publicacao DESC
                    LIMIT 4");

                $result->execute();
                $result->bind_result($idProjetos, $titulo, $dataPub, $ativo, $tipo);

                while ($result->fetch()) {
                    echo "<div class=\"projects-cards col-sm-6 wow fadeInUp\" data-wow-duration=\"2s\">
                                    <div class=\"project project-small\">
                                        <div class=\"project__card\">
                                            <a href=\"/project/$idProjetos\" class=\"project__image\">";

                    if ($tipo == "normal") {
                        echo "<img width='431px' height='431px'
                                                                    src=\"/api/utilizadores/projetos/$idProjetos.jpg\">";
                    } else {
                        echo "<img width='431px' height='431px'
                           src=\"/api/utilizadores/projetos/" . $idProjetos . "_1.jpg\">";
                    }

                    echo "</a>
                                            <div class=\"project__detail\">
                                                <h2 class=\"project__title\">" . h($titulo) . "</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>";
                }

                $result->close();

                ?>
            </div>

            <div class="col-sm-12 col-lg-6 no-padding">

                <?php
                $result = $conn->prepare("
                    SELECT projetos.id_projetos, projetos.titulo, projetos.data_publicacao,
                    projetos.ativo, projetos.tipo
                    FROM projetos 
                    WHERE projetos.ativo = 1 AND projetos.destacado = 1
                    ORDER BY projetos.data_publicacao DESC
                    LIMIT 1 OFFSET 4");

                $result->execute();
                $result->bind_result($idProjetos, $titulo, $dataPub, $ativo, $tipo);

                while ($result->fetch()) {
                    echo "<div class=\"projects-cards col-sm-12 wow fadeInUp\" data-wow-duration=\"2s\">
                                    <div class=\"project project-large\">
                                        <div class=\"project__card\">
                                            <a href=\"/project/$idProjetos\" class=\"project__image\">";

                    if ($tipo == "normal") {
                        echo "<img width='431px' height='431px'
                                                                    src=\"/api/utilizadores/projetos/$idProjetos.jpg\">";
                    } else {
                        echo "<img width='431px' height='431px'
                           src=\"/api/utilizadores/projetos/" . $idProjetos . "_1.jpg\">";
                    }

                    echo "</a>
                                            <div class=\"project__detail\">
                                                <h2 class=\"project__title\">" . h($titulo) . "</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>";
                }

                $result->close();

                ?>

            </div>

            <div class="col-md-12 text-center whatwedo wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.4s"
                 style="position:initial">
                <a href="/projects" class="mcmm-button large see-through-2 has-icon">
                    <span>Projetos</span>
                    <i class="pe-7s-angle-right"></i>
                </a>
            </div>

        </div>
    </div>
</section>

<section class="alunos_section" id="alunos">
    <div class="row">
        <div class="container">
            <div class="col-md-8 col-md-offset-2">
                <header class="section-header wow fadeInUp" data-wow-duration="2s">
                    <h2>Alunos MCMM</h2>
                    <p class="large">Consulta a atividade atual de alguns alunos que frequentaram o Mestrado em
                        Comunicação
                        Multimédia, para conheceres as oportunidades que este proporciona.</p>
                </header>
            </div>
        </div>
    </div>

    <div class="row">
        <div>
            <div>
                <div class="owl-carousel owl-theme wow fadeInUp" data-wow-duration="2s">

                    <?php

                    $result = $conn->prepare("
                    SELECT id_testemunhos, texto, autor, profissao
                    FROM testemunhos
                    ORDER BY id_testemunhos");

                    $result->execute();
                    $result->bind_result($idTestemunhos, $texto, $autor, $profissao);

                    while ($result->fetch()) {

                        echo "
                        <div class=\"item\">
                            <div class=\"box-student\">
                                <div class=\"quote-symbol\">
                                    <svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\"
                                         version=\"1.1\" viewBox=\"0 0 512.5 512.5\"
                                         style=\"enable-background:new 0 0 512.5 512.5;\" xml:space=\"preserve\">
                                        <g>
                                            <path
                                                d=\"M112.5,208.25c61.856,0,112,50.145,112,112s-50.144,112-112,112s-112-50.145-112-112l-0.5-16   c0-123.712,100.288-224,224-224v64c-42.737,0-82.917,16.643-113.137,46.863c-5.817,5.818-11.126,12.008-15.915,18.51   C100.667,208.723,106.528,208.25,112.5,208.25z M400.5,208.25c61.855,0,112,50.145,112,112s-50.145,112-112,112   s-112-50.145-112-112l-0.5-16c0-123.712,100.287-224,224-224v64c-42.736,0-82.918,16.643-113.137,46.863   c-5.818,5.818-11.127,12.008-15.916,18.51C388.666,208.723,394.527,208.25,400.5,208.25z\"/>
                                        </g>
                                    </svg>
                                </div>
                                <p>
                                    $texto
                                </p>
                                <span class=\"arrow\"></span>
                            </div>
                            <div class=\"profile\">
                                <div class=\"user-image\">
                                    <img class=\"img-circle\"
                                         src=\"/api/utilizadores/testemunhos/$idTestemunhos.jpg\"/>
                                </div>
                                <div class=\"user-name\">
                                    <span>$autor</span>
                                </div>
                                <div class=\"user-job\">
                                    <span>$profissao</span>
                                </div>
                            </div>
                        </div>
                        ";
                    }
                    $result->close();
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row parallax-section-1">
        <div class="container">
            <div class="col-xs-2 col-md-3 col-lg-4"></div>
            <div class="col-xs-8 col-md-6 col-lg-4">
                <header class="section-subheader wow fadeInUp" data-wow-duration="2s">
                    <h2>
                        O sucesso profissional dos nossos mestres é o nosso sucesso.
                    </h2>
                    <p class="large">
                        Desde 2007/2008 o MCMM diplomou cerca de 200 estudantes.
                    </p>
                    <p>Explora a atual atividade de alguns deles.</p>
                </header>
            </div>
            <div class="col-xs-2 col-md-3 col-lg-4"></div>

            <div class="col-md-12 text-center whatwedo wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.4s">
                <a class="mcmm-button large see-through-2 has-icon" href="/students">
                    <span>Alunos</span>
                    <i class="pe-7s-angle-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="corpo-docente is-divider" id="docentes">
    <div class="container">
        <div class="row list-dream-team">

            <?php

            $result = $conn->prepare("
                        SELECT id_docentes, nome
                        FROM docentes
                        ORDER BY nome");

            $result->execute();
            $result->bind_result($idDocentes, $nome);

            while ($result->fetch()) {
                echo "
                <div class=\"col-lg-3 col-md-3 col-sm-6 col-xs-12 wow fadeInUp\" data-wow-duration=\"2s\">
                    <div class=\"team-item\">
                        <div class=\"image\">
                            <img src=\"api/utilizadores/docentes/$idDocentes.jpg\" class=\"img-responsive\"/>
                        </div>
                        <div class=\"info\">
                            <div class=\"name\">" . h($nome) . "</div>
                        </div>
                    </div>
                </div>
                ";
            }

            $result->close();

            ?>

        </div>
    </div>
</section>

<section class="sponsors" id="sponsors">

    <div class="row">
        <div class="container">
            <div class="col-md-8 col-md-offset-2">
                <header class="text-center wow fadeInUp" data-wow-duration="2s">
                    <h2 style="color: #FFF; margin-bottom:0; margin-top:20px">Parceiros</h2>
                </header>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-1"></div>
        <div class="col-xs-10">
            <div class="brands">
                <div class="row no-gutter">
                    <div class="owl-carousel owl-theme">

                        <?php

                        $result = $conn->prepare("
                        SELECT id_parceiros, url
                        FROM parceiros
                        ORDER BY nome");

                        $result->execute();
                        $result->bind_result($idParceiros, $url);

                        while ($result->fetch()) {
                            echo "
                            <div class=\"item wow fadeInUp\" data-wow-duration=\"2s\">
                                <div class=\"brand-logo\">
                                    <a class=\"brand-logo-wrap\" href=\"$url\" target='_blank'>
                                        <img src=\"api/utilizadores/parceiros/$idParceiros.png\" alt=\"brand\"/>
                                    </a>
                                </div>
                            </div>
                            ";
                        }

                        $result->close();

                        ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-1"></div>
    </div>
</section>

<footer class="home-footer" id="informacoes">
    <div class="container">
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="contact-info">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="footer-header">
                            <h2>Contactos</h2>
                            <p class="large">Conhece a equipa responsável pelo Mestrado em Comunicação Multimédia</p>
                        </div>
                    </div>
                </div><!--row-->
                <div class="row">
                    <div class="col-md-4">
                        <article class="contact-item">
                            <div class="striped-icon-xlarge">
                                <span aria-hidden="true" class="icon-pin"></span>
                            </div>
                            <h5>Morada</h5>
                            <p>Universidade de Aveiro</p>
                            <p>3810-193 Aveiro</p>
                        </article>
                    </div>
                    <div class="col-md-4">
                        <article class="contact-item">
                            <div class="striped-icon-xlarge">
                                <span aria-hidden="true" class="icon-call-end"></span>
                            </div>
                            <h5>Telefones</h5>
                            <p>234 370 389</p>
                            <p>234 370 868</p>
                        </article>
                    </div>
                    <div class="col-md-4">
                        <article class="contact-item">
                            <div class="striped-icon-xlarge">
                                <span aria-hidden="true" class="icon-envelope"></span>
                            </div>
                            <h5>Emails</h5>
                            <p>geral@ua.pt</p>
                            <p>deca-mcmm@ua.pt</p>
                        </article>
                    </div>

                    <div class="col-md-12 text-center whatwedo wow fadeInUp" data-wow-duration="2s"
                         data-wow-delay="0.4s">
                        <a class="mcmm-button large see-through-2 has-icon" href="/contacts">
                            <span>Contactos</span>
                            <i class="pe-7s-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="copyright-alt">
            <ul class="copyright-links list-inline">
                <li>
                    <a href="#fakelink">
                        <svg class="facebook" x="0px" y="0px" viewBox="0 0 288.861 288.861" xml:space="preserve"
                             width="26px" height="26px">
                        <g>
                            <path fill="#fff"
                                  d="M167.172,288.861h-62.16V159.347H70.769v-59.48h34.242v-33.4C105.011,35.804,124.195,0,178.284,0   c19.068,0,33.066,1.787,33.651,1.864l5.739,0.746l-1.382,55.663l-6.324-0.058c-0.013,0-14.223-0.135-29.724-0.135   c-11.536,0-13.066,2.847-13.066,14.171v27.629h50.913l-2.821,59.48h-48.086v129.501H167.172z M117.858,276.007h36.453V146.5h48.677   l1.607-33.779h-50.284V72.238c0-13.368,3.078-27.025,25.919-27.025c9.178,0,17.899,0.045,23.509,0.09l0.778-31.292   c-5.675-0.508-15.116-1.157-26.247-1.157c-44.544,0-60.419,27.693-60.419,53.613v46.254H83.61V146.5h34.242v129.507H117.858z"/>
                        </g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                    </svg>
                    </a>
                </li>
                <li>
                    <a href="#fakelink">
                        <svg class="youtube" x="0px" y="0px" width="26px" height="26px" viewBox="0 0 511.627 511.627"
                             xml:space="preserve">
                        <g>
                            <g>
                                <path fill="#fff"
                                      d="M459.954,264.376c-2.471-11.233-7.949-20.653-16.416-28.264c-8.474-7.611-18.227-12.085-29.27-13.418    c-35.02-3.806-87.837-5.708-158.457-5.708c-70.618,0-123.341,1.903-158.174,5.708c-11.227,1.333-21.029,5.807-29.407,13.418    c-8.376,7.614-13.896,17.035-16.562,28.264c-4.948,22.083-7.423,55.391-7.423,99.931c0,45.299,2.475,78.61,7.423,99.93    c2.478,11.225,7.951,20.653,16.421,28.261c8.47,7.614,18.225,11.991,29.263,13.134c35.026,3.997,87.847,5.996,158.461,5.996    c70.609,0,123.44-1.999,158.453-5.996c11.043-1.143,20.748-5.52,29.126-13.134c8.377-7.607,13.897-17.036,16.56-28.261    c4.948-22.083,7.426-55.391,7.426-99.93C467.377,319.007,464.899,285.695,459.954,264.376z M165.025,293.218h-30.549v162.45    h-28.549v-162.45h-29.98v-26.837h89.079V293.218z M242.11,455.668H216.7v-15.421c-10.278,11.615-19.989,17.419-29.125,17.419    c-8.754,0-14.275-3.524-16.556-10.564c-1.521-4.568-2.286-11.519-2.286-20.844V314.627h25.41v103.924    c0,6.088,0.096,9.421,0.288,9.993c0.571,3.997,2.568,5.995,5.996,5.995c5.138,0,10.566-3.997,16.274-11.991V314.627h25.41V455.668    z M339.183,413.411c0,13.894-0.855,23.417-2.56,28.558c-3.244,10.462-9.996,15.697-20.273,15.697    c-9.137,0-17.986-5.235-26.556-15.697v13.702h-25.406v-189.29h25.406v61.955c8.189-10.273,17.036-15.413,26.556-15.413    c10.277,0,17.029,5.331,20.273,15.988c1.704,4.948,2.56,14.369,2.56,28.264V413.411z M435.685,390.003h-51.104v24.839    c0,13.134,4.374,19.697,13.131,19.697c6.279,0,10.089-3.422,11.42-10.28c0.376-1.902,0.571-7.706,0.571-17.412h25.981v3.71    c0,9.329-0.195,14.846-0.572,16.563c-0.567,5.133-2.56,10.273-5.995,15.413c-6.852,10.089-17.139,15.133-30.841,15.133    c-13.127,0-23.407-4.855-30.833-14.558c-5.517-7.043-8.275-18.083-8.275-33.12v-49.396c0-15.036,2.662-26.076,7.987-33.119    c7.427-9.705,17.61-14.558,30.557-14.558c12.755,0,22.85,4.853,30.263,14.558c5.146,7.043,7.71,18.083,7.71,33.119V390.003    L435.685,390.003z"/>
                                <path fill="#fff"
                                      d="M302.634,336.043c-4.38,0-8.658,2.101-12.847,6.283v85.934c4.188,4.186,8.467,6.279,12.847,6.279    c7.419,0,11.14-6.372,11.14-19.13v-60.236C313.773,342.418,310.061,336.043,302.634,336.043z"/>
                                <path fill="#fff"
                                      d="M397.428,336.043c-8.565,0-12.847,6.475-12.847,19.41v13.134h25.693v-13.134    C410.274,342.511,405.99,336.043,397.428,336.043z"/>
                                <path fill="#fff"
                                      d="M148.473,113.917v77.375h28.549v-77.375L211.563,0h-29.121l-19.41,75.089L142.759,0h-30.262    c5.33,15.99,11.516,33.785,18.559,53.391C140.003,79.656,145.805,99.835,148.473,113.917z"/>
                                <path fill="#fff"
                                      d="M249.82,193.291c13.134,0,23.219-4.854,30.262-14.561c5.332-7.043,7.994-18.274,7.994-33.689V95.075    c0-15.225-2.669-26.363-7.994-33.406c-7.043-9.707-17.128-14.561-30.262-14.561c-12.756,0-22.75,4.854-29.98,14.561    c-5.327,7.043-7.992,18.181-7.992,33.406v49.965c0,15.225,2.662,26.457,7.992,33.689    C227.073,188.437,237.063,193.291,249.82,193.291z M237.541,89.935c0-13.134,4.093-19.701,12.279-19.701    s12.275,6.567,12.275,19.701v59.955c0,13.328-4.089,19.985-12.275,19.985s-12.279-6.661-12.279-19.985V89.935z"/>
                                <path fill="#fff"
                                      d="M328.328,193.291c9.523,0,19.328-5.901,29.413-17.705v15.703h25.981V48.822h-25.981v108.777    c-5.712,8.186-11.133,12.275-16.279,12.275c-3.429,0-5.428-2.093-5.996-6.28c-0.191-0.381-0.287-3.715-0.287-9.994V48.822h-25.981    v112.492c0,9.705,0.767,16.84,2.286,21.411C313.961,189.768,319.574,193.291,328.328,193.291z"/>
                            </g>
                        </g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                    </svg>
                    </a>
                </li>
                <li>
                    <a href="#fakelink">
                        <style>
                            .email {
                                padding-top: 5px;
                            }
                        </style>
                        <svg class="email" x="0px" y="0px" viewBox="0 0 31.012 31.012" xml:space="preserve" width="32"
                             height="30">
                        <g>
                            <path fill="#fff"
                                  d="M28.512,26.529H2.5c-1.378,0-2.5-1.121-2.5-2.5V6.982c0-1.379,1.122-2.5,2.5-2.5h26.012c1.378,0,2.5,1.121,2.5,2.5v17.047   C31.012,25.408,29.89,26.529,28.512,26.529z M2.5,5.482c-0.827,0-1.5,0.673-1.5,1.5v17.047c0,0.827,0.673,1.5,1.5,1.5h26.012   c0.827,0,1.5-0.673,1.5-1.5V6.982c0-0.827-0.673-1.5-1.5-1.5H2.5z"/>
                            <path fill="#fff"
                                  d="M15.506,18.018c-0.665,0-1.33-0.221-1.836-0.662L0.891,6.219c-0.208-0.182-0.23-0.497-0.048-0.705   c0.182-0.21,0.498-0.23,0.706-0.049l12.778,11.137c0.64,0.557,1.72,0.556,2.358,0L29.46,5.466c0.207-0.183,0.522-0.162,0.706,0.049   c0.182,0.208,0.16,0.523-0.048,0.705L17.342,17.355C16.836,17.797,16.171,18.018,15.506,18.018z"/>
                        </g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                    </svg>
                    </a>
                </li>
            </ul>
            <p>&copy; 2016 Mestrado em Comunicação Multimédia</p>
            <p>&nbsp;</p>
            <p style="line-height: 20px">Plataforma desenvolvida pelos alunos
                <a href="mailto:danielabessa@ua.pt"><b>Daniela Bessa</b></a> e
                <a href="mailto:cunha.jose@ua.pt"><b>José Fonte</b></a>.
            </p>
            <p style="line-height: 20px">A orientação dos projeto foi realizada pelos professores Hélder Caixinha,
                Maria João Antunes e Pedro Amado, durante o ano letivo 2015/16, no âmbito da
                Unidade Curricular de Projeto (perfil Tecnologia e Organizações),
                da Licenciatura em Novas Tecnologias da Comunicação.</p>
            <!--            <p>O desenvolvimento da plataforma foi proposto por Maria João Antunes e Telmo Eduardo Silva.</p>-->
        </div>
    </div>
</footer>

<!--TO TOP-->
<a id="to-top">
    <i class="fa fa-angle-up top-icon"></i>
</a>

<!--MODALS-->
<?php

require_once 'api/funcoes/modals.php';
require_once 'api/funcoes/socials.php';

?>

<script src="scripts/vendor-c259ccb7d9.js"></script>

<script src="scripts/plugins-aaf19e1ea7.js"></script>

<script src="scripts/index-f00db4a4bf.js"></script>

<script src="scripts/main.js"></script>

<script>
    new WOW().init();

    <?php
    if ($_SERVER['REQUEST_URI'] === "/validated") {

        echo "
            noty({
                    text: 'A tua conta foi validada com <b>sucesso</b>!<br>' +
                    'Entra na plataforma para acederes a diversas funcionalidades.',
                    type: 'success',
                    layout: 'topRight',
                    theme: 'bootstrapTheme',
                    animation: {
                        open: 'animated bounceInLeft',
                        close: 'animated bounceOutRight',
                        easing: 'swing',
                        speed: 250
                    },
                    timeout: 6000
                });
        ";
    }

    if ($_SERVER['REQUEST_URI'] === "/blocked") {

        echo "
            noty({
                    text: 'A tua conta encontra-se <b>bloqueada</b>!<br>',
                    type: 'error',
                    layout: 'topRight',
                    theme: 'bootstrapTheme',
                    animation: {
                        open: 'animated bounceInLeft',
                        close: 'animated bounceOutRight',
                        easing: 'swing',
                        speed: 250
                    },
                    timeout: 6000
                });
        ";
    }
    ?>

    $(document).ready(function () {
        $('[rel="tooltip"]').tooltip();
    });

</script>

<?php

if (!isset($_SESSION['idUtilizador'])) {

    //TWITTER
    if ((isset($_GET['connected'])) AND ($_GET['connected'] == "twitter")) {

        $objTwitterApi = new TwitterLoginAPI;
        $return = $objTwitterApi->view();

        $id = $return['id'];
        $image = $return['profile_image_url'];
        $name = $return['name'];
        $id_user = $return['id_user'];

        $result = $conn->prepare("SELECT email FROM utilizadores WHERE id_twitter = ?");
        $result->bind_param('s', $id);
        $result->execute();
        $result->store_result();
        $row_number = $result->num_rows;

        if ($row_number > 0) {
            $result->close();
            getCredentialsTwitter($id);
        } else {
            $result->close();
            conclusionTwitter($id, $image, $name, $id_user);
        }
        echo "<script src='scripts/socials/twitter.js'></script>";
    }

    //FACEBOOK
    if (isset($_GET['code'])) {
        if ($fbuser) {
            try {
                $user_profile = $facebook->api('/me?fields=id,first_name,last_name,email,picture');
            } catch (FacebookApiException $e) {
                error_log($e);
                $fbuser = null;
            }

            if (isset($user_profile['id']) AND isset($user_profile['email'])) {

                $id = $user_profile['id'];
                $image = "http://graph.facebook.com/$id/picture";
                $first_name = $user_profile['first_name'];
                $last_name = $user_profile['last_name'];
                $email = $user_profile['email'];

                $result = $conn->prepare("SELECT email FROM utilizadores WHERE id_facebook = ?");
                $result->bind_param('s', $id);
                $result->execute();
                $result->store_result();
                $row_number = $result->num_rows;

                if ($row_number > 0) {
                    $result->close();
                    getCredentialsFacebook($id);
                } else {
                    $result->close();

                    $result = $conn->prepare("SELECT email FROM utilizadores WHERE email = ?");
                    $result->bind_param('s', $email);
                    $result->execute();
                    $result->store_result();
                    $row_number = $result->num_rows;

                    if ($row_number > 0) {

                        echo "<script>
                            $('#loginModal').modal('show');
                            shakeModal();
                            $('.error').addClass('alert alert-danger').html('O email deste serviço já se encontra registado na nossa plataforma.');
                        </script>";

                    } else {
                        conclusionFacebook($id, $image, $first_name, $last_name, $email);
                    }
                }
                echo "<script src='scripts/socials/facebook.js'></script>";
            }
            $facebook = true;
        } else {
            $facebook = false;
        }

        //GOOGLE
        if (!$facebook) {
            if (isset($_REQUEST['code'])) {
                $gClient->authenticate();
                $_SESSION['token'] = $gClient->getAccessToken();
                header('location:/');
            }
        }
    }

    //GOOGLE
    if (isset($_SESSION['token'])) {
        $gClient->setAccessToken($_SESSION['token']);
    }

    if ($gClient->getAccessToken()) {
        $userProfile = $google_oauthV2->userinfo->get();
        $_SESSION['token'] = $gClient->getAccessToken();

        if (isset($userProfile['id'])) {

            $id = $userProfile['id'];
            $image = $userProfile['picture'];
            $name = $userProfile['name'];
            $email = $userProfile['email'];

            $result = $conn->prepare("SELECT email FROM utilizadores WHERE id_google = ?");
            $result->bind_param('s', $id);
            $result->execute();
            $result->store_result();
            $row_number = $result->num_rows;

            if ($row_number > 0) {
                $result->close();
                getCredentialsGoogle($id);
            } else {
                $result->close();

                $result = $conn->prepare("SELECT email FROM utilizadores WHERE email = ?");
                $result->bind_param('s', $email);
                $result->execute();
                $result->store_result();
                $row_number = $result->num_rows;

                if ($row_number > 0) {
                    echo "<script>
                            $('#loginModal').modal('show');
                            shakeModal();
                            $('.error').addClass('alert alert-danger').html('O email deste serviço já se encontra registado na nossa plataforma.');
                        </script>";

                } else {
                    conclusionGoogle($id, $image, $name, $email);
                }
            }

            echo "<script src='scripts/socials/google.js'></script>";
        }
    }

    //Recuperar Senha
    if (isset($_GET['recover'])) {
        $_SESSION['account_recover'] = $_GET['recover'];
        header('location:/');
    }

    if (isset($_SESSION['account_recover'])) {

        $result = $conn->prepare("SELECT email, hash_email FROM utilizadores WHERE hash_email = ?");
        $result->bind_param('s', $_SESSION['account_recover']);
        $result->execute();
        $result->bind_result($email, $hashEmail);
        $result->fetch();

        conclusionRecover($email, $hashEmail);
        echo "<script src='scripts/socials/recover.js'></script>";
    }

}

?>

</body>
</html>
