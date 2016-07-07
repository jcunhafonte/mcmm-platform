<?php

session_start();

if(isset($_SESSION['nomeAdmin'])){
    header('location:index.php');
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>MCMM - Administração</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="apple-mobile-web-app-capable" content="yes" />

		<!--FAVICON-->
		<link rel="apple-touch-icon-precomposed" sizes="57x57" href="assets/favicon/purple/apple-touch-icon-57x57.png"/>
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/favicon/purple/apple-touch-icon-114x114.png"/>
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/favicon/purple/apple-touch-icon-72x72.png"/>
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/favicon/purple/apple-touch-icon-144x144.png"/>
		<link rel="apple-touch-icon-precomposed" sizes="60x60" href="assets/favicon/purple/apple-touch-icon-60x60.png"/>
		<link rel="apple-touch-icon-precomposed" sizes="120x120" href="assets/favicon/purple/apple-touch-icon-120x120.png"/>
		<link rel="apple-touch-icon-precomposed" sizes="76x76" href="assets/favicon/purple/apple-touch-icon-76x76.png"/>
		<link rel="apple-touch-icon-precomposed" sizes="152x152" href="assets/favicon/purple/apple-touch-icon-152x152.png"/>
		<link rel="icon" type="image/png" href="assets/favicon/purple/favicon-196x196.png" sizes="196x196"/>
		<link rel="icon" type="image/png" href="assets/favicon/purple/favicon-96x96.png" sizes="96x96"/>
		<link rel="icon" type="image/png" href="assets/favicon/purple/favicon-32x32.png" sizes="32x32"/>
		<link rel="icon" type="image/png" href="assets/favicon/purple/favicon-16x16.png" sizes="16x16"/>
		<link rel="icon" type="image/png" href="assets/favicon/purple/favicon-128.png" sizes="128x128"/>
		<meta name="application-name" content="MCMM"/>
		<meta name="msapplication-TileColor" content="#FFFFFF"/>
		<meta name="msapplication-TileImage" content="assets/favicon/normal/mstile-144x144.png"/>
		<meta name="msapplication-square70x70logo" content="assets/favicon/normal/mstile-70x70.png"/>
		<meta name="msapplication-square150x150logo" content="assets/favicon/normal/mstile-150x150.png"/>
		<meta name="msapplication-wide310x150logo" content="assets/favicon/normal/mstile-310x150.png"/>
		<meta name="msapplication-square310x310logo" content="assets/favicon/normal/mstile-310x310.png"/>


        <!-- Base Css Files -->
        <link href="assets/libs/jqueryui/ui-lightness/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" />
        <link href="assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/libs/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
        <link href="assets/libs/fontello/css/fontello.css" rel="stylesheet" />
        <link href="assets/libs/animate-css/animate.min.css" rel="stylesheet" />
        <link href="assets/libs/nifty-modal/css/component.css" rel="stylesheet" />
        <link href="assets/libs/magnific-popup/magnific-popup.css" rel="stylesheet" /> 
        <link href="assets/libs/ios7-switch/ios7-switch.css" rel="stylesheet" />
        <link href="assets/libs/pace/pace.css" rel="stylesheet" />
        <link href="assets/libs/sortable/sortable-theme-bootstrap.css" rel="stylesheet" />
        <link href="assets/libs/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
        <link href="assets/libs/jquery-icheck/skins/all.css" rel="stylesheet" />

        <!-- Code Highlighter for Demo -->
        <link href="assets/libs/prettify/github.css" rel="stylesheet" />
        
        <!-- Extra CSS Libraries Start -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

        <!-- Extra CSS Libraries End -->
        <link href="assets/css/style-responsive.css" rel="stylesheet" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

    </head>
    <body class="fixed-left login-page">
        <!-- Modal Start -->
		
	<!-- Begin page -->
	<div class="container">
		<div class="full-content-center">
			<p class="text-center"></p>
            <div class="login-wrap animated flipInX" style="margin-top: 100px !important;">
                <?php

                if(isset($_GET['falhado']) AND ($_GET['falhado'] == 1)){

                    echo '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
               A Palavra-passe que introduziu não se encontra correta.<br>
               <a class="alert-link">Tente novamente!</a></div>';
                }

                if(isset($_GET['sair']) AND ($_GET['sair'] == 1)){
                    echo '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                Muito obrigado pela sua visita.<br>
               <a class="alert-link">Até breve!</a></div>';
                }

                ?>
				<div class="login-block">
					<img src="assets/img/logo.svg" style="background: white" class="img-circle not-logged-avatar">
					
					<form role="form" action="php/verificacoes/verificaLogin.php<?php if(isset($_GET['url'])){ echo "?url=".$_GET['url']; }?>" method="post">
						<div class="form-group login-input">
						<i class="fa fa-user overlay"></i>
						<input type="text" name="emailUtilizador" class="form-control text-input" placeholder="mcmm_platform@hotmail.com" disabled>
						</div>
						<div class="form-group login-input">
						<i class="fa fa-key overlay"></i>
						<input type="password" name="palavraPasseUtilizador" required="required" autocomplete="on" class="form-control text-input" placeholder="********">
						</div>
						
						<div class="row">
							<div class="col-sm-12">
							<button type="submit" class="btn btn-success btn-block">ENTRAR</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			
		</div>
	</div>
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
	</body>
</html>