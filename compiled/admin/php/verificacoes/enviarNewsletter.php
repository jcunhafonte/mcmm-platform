<?php

require_once '../connection/dbconnection.php';

require_once '../../../api/emails/SendGrid/funcoes.php';

$nomeUtilizador = array();
$email = array();

if (isset($_POST['noticia_1']) AND isset($_POST['noticia_2'])) {

    $query = "SELECT id_noticias, titulo FROM noticias WHERE id_noticias = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 's', $_POST['noticia_1']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $idNoticias1, $titulo1);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    $query = "SELECT id_noticias, titulo FROM noticias WHERE id_noticias = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 's', $_POST['noticia_2']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $idNoticias2, $titulo2);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    $idProjeto1 = $_POST['projeto_1'];
    $idProjeto2 = $_POST['projeto_2'];
    $idProjeto3 = $_POST['projeto_3'];
    $idProjeto4 = $_POST['projeto_4'];
    $idProjeto5 = $_POST['projeto_5'];

    $query = "SELECT nome_utilizador, email FROM utilizadores WHERE ativo = 1 AND validado = 1";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $nomeBD, $emailBD);

    while(mysqli_stmt_fetch($stmt)){
        array_push($nomeUtilizador, $nomeBD);
        array_push($email, $emailBD);
    }
    mysqli_stmt_close($stmt);

    newsletter($nomeUtilizador, $email,
        "http://mcmm.tech/new/$idNoticias1", $titulo1, "http://mcmm.tech/api/utilizadores/noticias/$idNoticias1.jpg",
        "http://mcmm.tech/new/$idNoticias2", $titulo2, "http://mcmm.tech/api/utilizadores/noticias/$idNoticias2.jpg",
        "http://mcmm.tech/projeto/$idProjeto1", "http://mcmm.tech/api/utilizadores/projetos/$idProjeto1.jpg",
        "http://mcmm.tech/projeto/$idProjeto2", "http://mcmm.tech/api/utilizadores/projetos/$idProjeto2.jpg",
        "http://mcmm.tech/projeto/$idProjeto3", "http://mcmm.tech/api/utilizadores/projetos/$idProjeto3.jpg",
        "http://mcmm.tech/projeto/$idProjeto4", "http://mcmm.tech/api/utilizadores/projetos/$idProjeto4.jpg",
        "http://mcmm.tech/projeto/$idProjeto5", "http://mcmm.tech/api/utilizadores/projetos/$idProjeto5.jpg"
    );

    header('location:../../newsletter.php?newsletterEnviada');

}

