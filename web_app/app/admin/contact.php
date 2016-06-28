<?php

$nome = $_POST['nome'];
$quem = $_POST['quem'];
$msg = $_POST['msg'];

			require("PHPMailer_v5.1/class.phpmailer.php");

			$mailer = new PHPMailer();
			$mailer->IsSMTP();
			$mailer->Host = 'iberweb13a.ibername.com';   //dados do servidor de email
			$mailer->SMTPAuth = TRUE;

			$mailer->Username = 'geral@bentoenascimento.com'; //email bento e nascimento
			$mailer->Password = 'b#2010#n';			//password email bento e nascimento

			$mailer->From = $quem;
			$mailer->FromName = utf8_decode($nome);
			$mailer->Subject = 'Pedido de Informação - Página Online';
			$mailer->Body = utf8_decode($msg);


			//Quem recebe?
			$mailer->AddAddress('geral@bentoenascimento.com');

			if(!$mailer->Send()) {
    			error_log("Mailer :  error ".$mailer->ErrorInfo)." : $to";
    			echo ""; //Se falhou
			} else {
    			echo " "; //Se enviou
			}
?>
    		<script language="javascript">
				alert("Email enviado com sucesso!");
				location.href="contact.html";
			</script>