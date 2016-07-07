<?php

session_start();

use editorFotos\SimpleImage;

require_once "../editorFotos/SimpleImage.php";
require("../connection/mysql.php");

$seed = 'DB97368CFAE81F9852EF15F76B6CF';

$email = $_POST['email'];
$result = $conn->prepare("SELECT email FROM utilizadores WHERE email = ?");
$result->bind_param('s', $email);
$result->execute();
$result->store_result();
$row_number = $result->num_rows;

if ($row_number > 0) {
    $result->close();
} else {
    $result->close();

    $nomeUt = $_POST['nome'];
    $emailUt = $_POST['email'];
    $dataRegistoUt = date("Y-m-d H:i:s");
    $ultimaVisitaUt = date("Y-m-d H:i:s");
    $userID = $_POST['id_user'];
    $facebookID = $_POST['id_facebook'];
    $validado = 1;

    $result = $conn->prepare("INSERT INTO utilizadores (validado, nome_utilizador, email, data_registo, ultima_visita, id_user, id_facebook)
    VALUES (?, ?, ?, ?, ?, ?, ?)");
    $result->bind_param('issssss', $validado, $nomeUt, $emailUt, $dataRegistoUt, $ultimaVisitaUt, $userID, $facebookID);
    $result->execute();
    $result->close();

    include_once("../emails/SendGrid/funcoes.php");
//    emailValidarConta($nomeUt, $emailUt, $validaHashEmail);

    $email = $_POST['email'];
    $result = $conn->prepare("SELECT id_utilizador, id_user FROM utilizadores WHERE email = ?");
    $result->bind_param('s', $email);
    $result->execute();
    $result->bind_result($idUtilizador, $idUser);
    $result->fetch();
    $result->close();

    $img = file_get_contents($_POST['url_imagem']);
    $im = imagecreatefromstring($img);
    $width = imagesx($im);
    $height = imagesy($im);
    $newwidth = '120';
    $newheight = '120';

    $thumb = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresized($thumb, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    imagejpeg($thumb,"../utilizadores/perfis/$idUtilizador.jpg");
    imagedestroy($thumb);
    imagedestroy($im);

    $ativo = 1;
    $validado = 1;

    $result = $conn->prepare("SELECT id_utilizador, nome_utilizador, email, data_registo, ultima_visita,
                    num_visitas, sobre, id_user
                    FROM utilizadores WHERE id_utilizador = ? AND ativo = ? AND validado = ?");
    $result->bind_param('sii', $idUtilizador, $ativo, $validado);
    $result->execute();
    $result->bind_result($idUtilizador, $nomeUtilizador, $emailUtilizador, $dataRegisto,
        $ultimaVisitaUtilizador, $numVisitasPerfil, $sobreUtilizador, $idUser);
    $result->fetch();
    $result->close();

    $_SESSION['idUtilizador'] = $idUtilizador;
    $_SESSION['emailUtilizador'] = $emailUtilizador;
    $_SESSION['nomeUtilizador'] = $nomeUtilizador;
    $dataRegistoUtilizador = DateTime::createFromFormat('Y-m-d H:i:s', $dataRegisto);
    $dataRegistoUtilizador = $dataRegistoUtilizador->format('Y-m-d');
    $_SESSION['dataRegistoUtilizador'] = $dataRegistoUtilizador;
    $_SESSION['diasUltimaVisitaUtilizador'] = $ultimaVisitaUtilizador;
    $ultimaVisitaUtilizador = new DateTime($ultimaVisitaUtilizador);
    $dataAtual = new DateTime(date('Y-m-d H:i:s'));
    $diferenca = $dataAtual->diff($ultimaVisitaUtilizador);
    $ultimaVisitaHoras = $diferenca->h;
    $ultimaVisitaHoras = $ultimaVisitaHoras + ($diferenca->days * 24);
    $_SESSION['horaUltimaVisitaUtilizador'] = $ultimaVisitaHoras;
    $_SESSION['visualizacoesPerfil'] = $numVisitasPerfil;
    $_SESSION['sobreUtilizador'] = $sobreUtilizador;
    $_SESSION['idUser'] = $idUser;

    echo $idUser;
}

?>