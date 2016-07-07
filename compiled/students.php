<?php

session_start();

require_once 'api/funcoes/utils.php';
require_once 'api/funcoes/menu.php';
require_once 'api/funcoes/footer.php';
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

    <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3_wvIDZm3AokUrTBqcX9eFuPYRy2nifk"></script>

</head>

<body data-offset="80" data-target=".navbar" data-spy="scroll">

<?php menu(); ?>

<div id="platform">

    <div class="projects-header">
        <div class="contents" style="background-image: url(/images/backgrounds/students.jpg)">
            <div class="container">
                <div class="row">
                    <div class="description">
                        <h2 class="title">Alunos</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section section-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div id="map_students"></div>
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

<script>

    var markersData = {
        marcadores: [

            <?php

            $query = "SELECT id_alunos, nome, funcao, empresa, conclusao, latitude, longitude FROM alunos";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_result($stmt, $idAlunos, $nome, $funcao, $empresa, $conclusao, $latitude, $longitude);
            mysqli_stmt_execute($stmt);

            while (mysqli_stmt_fetch($stmt)) {

                $image = file_exists("api/utilizadores/alunos/$idAlunos.jpg") ? "api/utilizadores/alunos/$idAlunos.jpg" : "images/avatar/avatar.jpg";

                echo  "
                {
                    name: \"$nome\",
                    location_latitude: $latitude,
                    location_longitude: $longitude,
                    map_image_url: \"$image\",
                    funcao: \"$funcao\",
                    description_point: \"$empresa\",
                    description_pointA: \"$conclusao\",
                    url_point: \"\"
                },
                ";

            }

            mysqli_stmt_close($stmt);
            ?>
        ]
    };
</script>

<script src="scripts/vendor-c259ccb7d9.js"></script>

<script src="scripts/plugins-aaf19e1ea7.js"></script>

<script src="scripts/students-f7a7498e1c.js"></script>

</body>
</html>
