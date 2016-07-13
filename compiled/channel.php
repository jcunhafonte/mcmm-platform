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

    <style>
        .projects-header .contents:after {
            opacity: 0.85 !important;
        }
    </style>

</head>

<body data-offset="80" data-target=".navbar" data-spy="scroll">

<?php menu(); ?>

<div id="platform">

    <div class="projects-header">
        <div class="contents" style="background-image: url(/images/backgrounds/canal.gif)">
            <div class="container">
                <div class="row">
                    <div class="description">
                        <h2 class="title">Canal</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section section-gray">
        <div class="container">
            <div class="row">
                <div class="channel">
                    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                        <div class="video">
                            <iframe width="100%" height="100%" id="UstreamIframe"
                                    src="http://www.ustream.tv/embed/22354809"
                                    frameborder="0"
                                    style="position:absolute; top:0; left: 0">
                            </iframe>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                        <div class="chat">
                            <iframe width="100%" height="100%" id="chat" name="chat"
                                    src="http://www.ustream.tv/socialstream/22354809?videos=0"
                                    frameborder="0"
                                    style="position:absolute; top:0; left: 0">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="user-actions user-actions-force-align-small">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="pull-left">
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="pull-right">

                                    <button class="btn"
                                            onclick="window.open('http://twitter.com/share?url=http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>&hashtags=MCMM', '_blank')"
                                    >
                                        <svg class="twitter" x="0px" y="0px" viewBox="0 0 52.851 52.851"
                                             xml:space="preserve"
                                             width="26px" height="26px">
                                    <g>
                                        <path
                                            d="M52.412,9.656c-0.354-0.24-0.823-0.227-1.165,0.031c-0.449,0.34-1.179,0.61-1.965,0.818   c2.047-2.294,2.091-3.826,2.069-4.178c-0.023-0.364-0.242-0.687-0.572-0.842c-0.331-0.156-0.719-0.118-1.014,0.096   c-2.303,1.674-4.597,2.027-5.961,2.063c-2.094-2.004-4.813-3.102-7.707-3.102c-6.196,0-11.236,5.108-11.236,11.386   c0,0.54,0.038,1.079,0.113,1.613C14.236,17.42,5.516,7.131,5.426,7.024c-0.21-0.25-0.528-0.384-0.854-0.355   c-0.326,0.028-0.617,0.213-0.78,0.497C0.702,12.526,2.77,17.234,4.66,19.93c-0.334-0.178-0.605-0.354-0.767-0.473   c-0.3-0.224-0.701-0.261-1.039-0.095c-0.337,0.166-0.552,0.506-0.559,0.881c-0.083,5.108,2.375,8.034,4.687,9.652   c-0.308-0.029-0.621,0.085-0.835,0.318c-0.24,0.261-0.325,0.63-0.221,0.969c1.597,5.227,5.518,7.003,8.013,7.606   c-5.13,3.994-12.68,2.708-12.763,2.694c-0.456-0.081-0.906,0.159-1.092,0.582c-0.185,0.422-0.059,0.917,0.309,1.197   c5.415,4.133,11.892,5.048,16.57,5.048c3.539,0,6.05-0.524,6.29-0.577c23.698-5.616,24.365-27.323,24.31-30.88   c4.449-4.137,5.144-5.713,5.251-6.103C52.929,10.336,52.767,9.896,52.412,9.656z M45.874,15.691c-0.223,0.205-0.34,0.5-0.32,0.803   c0.063,0.96,1.275,23.597-22.742,29.288c-0.109,0.023-9.656,2.015-17.932-2.085c3.497-0.097,8.511-1.013,12.004-4.935   c0.264-0.295,0.328-0.719,0.164-1.079c-0.162-0.357-0.519-0.586-0.91-0.586c-0.003,0-0.007,0-0.01,0   c-0.05,0.032-5.301-0.006-7.705-5.001c0.968,0.055,2.162-0.005,3.113-0.443c0.392-0.181,0.623-0.592,0.575-1.021   c-0.048-0.428-0.366-0.777-0.788-0.866c-0.269-0.057-6.115-1.364-6.933-7.741c0.887,0.388,2.022,0.705,3.144,0.534   c0.386-0.058,0.702-0.335,0.811-0.71s-0.01-0.779-0.305-1.035c-0.25-0.218-5.74-5.097-3.137-11.39   c2.826,2.965,11.196,10.67,21.337,10.088c0.297-0.017,0.572-0.167,0.749-0.407c0.176-0.24,0.236-0.546,0.164-0.835   c-0.192-0.765-0.29-1.553-0.29-2.341c0-5.176,4.144-9.386,9.237-9.386c2.491,0,4.828,0.994,6.579,2.8   c0.184,0.19,0.437,0.299,0.701,0.304c1.06,0.015,2.802-0.11,4.77-0.899c-0.568,0.707-1.402,1.554-2.629,2.518   c-0.347,0.273-0.474,0.74-0.313,1.151c0.161,0.412,0.577,0.671,1.011,0.632c0.233-0.019,1.421-0.123,2.764-0.414   C48.249,13.423,47.246,14.429,45.874,15.691z"/>
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
                                    </button>

                                    <button class="btn"
                                            onclick="window.open('http://www.facebook.com/sharer/sharer.php?u=http://<?php echo $_SERVER['HTTP_HOST']. $_SERVER['REQUEST_URI']?>', '_blank')"
                                    >
                                        <svg class="facebook" x="0px" y="0px" viewBox="0 0 288.861 288.861"
                                             xml:space="preserve"
                                             width="26px" height="26px">
                                    <g>
                                        <path
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
                                    </button>

                                    <button class="btn"
                                            onclick="window.open('https://plus.google.com/share?url=http://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>', '_blank')"
                                    >
                                        <svg width="34px" height="34px" xml:space="preserve" class='google-plus'
                                             viewBox="0 0 518.18 383.89">
                                    <defs>
                                        <style>.cls-11 {
                                                stroke: #fff;
                                                stroke-miterlimit: 10;
                                                stroke-width: 7px;
                                            }</style>
                                    </defs>
                                            <path class="cls-11"
                                                  d="M497.51,212.42H462.93V177.86a13.66,13.66,0,1,0-27.33,0v34.57H401a13.67,13.67,0,0,0,0,27.34H435.6v34.57a13.66,13.66,0,1,0,27.33,0V239.76h34.58a13.67,13.67,0,0,0,0-27.34h0Z"
                                                  transform="translate(3.51 -67.61)"/>
                                            <path class="cls-11"
                                                  d="M348,212.42q-77.6.11-155.18,0h-0.09c-5.75,0-10.42,1.74-13.85,5.19-5.18,5.18-5.14,11.78-5.12,14.26,0.14,13.53.1,27,.09,40.6l0,16.32c0,13.92,6.42,20.43,20.22,20.43h20.41c16.41,0,32.85,0,49.37,0-0.15.3-.3,0.62-0.46,0.93-4.66,9.76-12,18.42-22.4,26.46-13.09,7.9-26.2,12.45-40.09,13.88-31.83,3.22-57.73-6.62-79.19-30.32-7.26-8-13.17-18.23-18.23-31-6.24-20.85-6.14-40.31.17-59.1a95.92,95.92,0,0,1,25.21-38.53c32.91-30.64,83.49-31.9,115.14-2.91,6.3,5.77,16.37,7.68,24.82-1.34l10.58-10.59c10.86-10.9,21.7-21.76,32.74-32.58,4.22-4.18,6.26-8.84,6.07-13.88-0.3-7.55-5.58-12-7.22-13.42C267,79,215.24,64.55,156.78,73.85,116.36,80.3,81,99.21,51.66,130c-12.83,13.41-22.58,27.09-29.74,41.64-1.79,3.38-4,7.62-4.49,8.74A186.7,186.7,0,0,0,1.64,284.27c2.82,22,9.13,42.13,18.38,59.34a176.64,176.64,0,0,0,50.14,62.5C105.5,434,144.86,448,187.66,448A221.55,221.55,0,0,0,242,440.93c27.43-6.94,51.51-20.12,71-38.62,11.34-9.67,21.14-21.52,29.89-36.27,23.81-40.14,31.75-85.18,24.27-137.7-0.5-3.74-3.42-15.9-19.18-15.9h0Zm-29.63,139c-7.14,12-14.93,21.5-24.42,29.61A131,131,0,0,1,235,413.25c-56,14.15-104.06,4.47-147.18-29.55a148.71,148.71,0,0,1-42.39-53c-8-14.9-13.09-31.26-15.5-50a158.62,158.62,0,0,1,13.36-88.25c0.23-.47.69-1.4,1.27-2.55A14.17,14.17,0,0,0,46,187.38c0.49-1,1-2.06,1.46-3.1,0.83-1.56,1.51-2.86,1.81-3.41a12,12,0,0,0,.54-1.12A143.57,143.57,0,0,1,72.3,149.68c24.94-26.17,54.89-42.2,89-47.66,46.64-7.47,86.83,2.18,122.74,29.67Q271.55,144,259.16,156.51L255,160.72c-42.65-31.82-104.58-28.26-145.57,9.9a126.35,126.35,0,0,0-32.72,50c-8.25,24.58-8.43,50.41-.17,77.86,6.74,17.17,14.37,30.12,24,40.8,27.65,30.52,62.52,43.81,103.3,39.55,18.17-1.87,35.9-8,52.67-18.31a10,10,0,0,0,1.2-.82c14.4-11,24.66-23.17,31.41-37.26a124.16,124.16,0,0,0,6.71-18.28c0.75-2.5,3-10-2.1-16.85-3.43-4.58-8.42-6.5-15.62-6.78-21.2.17-42.42,0.14-63.62,0.14l-12.1,0v-8.16c0-10.46,0-20.94,0-31.53Q271,241.12,340,241c4.51,42.14-2.58,78.35-21.66,110.5h0Z"
                                                  transform="translate(3.51 -67.61)"/>
                                    </svg>
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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

<script src="scripts/channel-718447bc58.js"></script>

<script src="scripts/main.js"></script>

<script src="scripts/channel_state.js"></script>

</body>
</html>
