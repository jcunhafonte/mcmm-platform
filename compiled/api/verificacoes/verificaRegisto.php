<?php

session_start();

use editorFotos\SimpleImage;

require_once "../editorFotos/SimpleImage.php";
require("../connection/mysql.php");

$seed = 'DB97368CFAE81F9852EF15F76B6CF';

$email = $_POST['emailUtilizador'];
$result = $conn->prepare("SELECT email FROM utilizadores WHERE email = ?");
$result->bind_param('s', $email);
$result->execute();
$result->store_result();
$row_number = $result->num_rows;

if ($row_number > 0) {
    echo "registo=0";
    $result->close();
} else {
    $result->close();

    if ($_POST['confirmarPalavraPasseUtilizador'] == $_POST['palavraPasseUtilizador']) {

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $nomeUt = $_POST['nomeUtilizador'];
            $emailUt = $_POST['emailUtilizador'];
            $hashUt = hash("sha512", $seed . mt_rand());
            $passwordUt = password_hash($_POST['palavraPasseUtilizador'] . $hashUt, PASSWORD_BCRYPT);
            $dataRegistoUt = date("Y-m-d H:i:s");
            $ultimaVisitaUt = date("Y-m-d H:i:s");
            $hashEmail = ($seed . mt_rand());
            $userID = $_POST['utilizadorId'];

            $result = $conn->prepare("INSERT INTO utilizadores (nome_utilizador, email, password, data_registo, ultima_visita, hash, hash_email, id_user) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $result->bind_param('ssssssss', $nomeUt, $emailUt, $passwordUt,
                $dataRegistoUt, $ultimaVisitaUt, $hashUt, $hashEmail, $userID);
            $result->execute();
            $result->close();

            $validaHashEmail ="http://mcmm.tech/api/verificacoes/validarEmailUtilizador.php?utilizadorValidado=$hashEmail";

            include_once("../emails/SendGrid/funcoes.php");
            emailValidarConta($nomeUt, $emailUt, $validaHashEmail);

            $email = $_POST['emailUtilizador'];
            $result = $conn->prepare("SELECT id_utilizador FROM utilizadores WHERE email = ?");
            $result->bind_param('s', $email);
            $result->execute();
            $result->bind_result($idUtilizador);
            $result->fetch();
            $result->close();

            $target_dir = "../utilizadores/perfis/";
            $target_file = "../../images/avatar/avatar.jpg";

            try {
                $img = new SimpleImage();
                $img->load($target_file)->resize(120, 120)->save($target_dir . $idUtilizador . ".jpg");
            } catch (Exception $e) {

            }

            echo "registo=1";
        } else {
            echo "registo=4";
        }
    } else {
        echo "registo=3";
    }
}
?>