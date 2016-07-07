<?php

session_start();

require("../../connection/mysql.php");

if (isset($_POST['noticia'])) {

    $result = $conn->prepare("
    DELETE FROM gostos_noticias WHERE ref_id_noticias = ?");

    $result->bind_param('s', $_POST['noticia']);
    $result->execute();
    $result->close();

    $result = $conn->prepare("
    DELETE FROM denuncia_comentarios_noticias WHERE ref_id_noticias = ?");

    $result->bind_param('s', $_POST['noticia']);
    $result->execute();
    $result->close();

    $result = $conn->prepare("
    DELETE FROM comentarios_noticias WHERE ref_id_noticia = ?");

    $result->bind_param('s', $_POST['noticia']);
    $result->execute();
    $result->close();

    $result = $conn->prepare("
    DELETE FROM noticias WHERE id_noticias = ?");

    $result->bind_param('s', $_POST['noticia']);
    $result->execute();
    $result->close();

    $result = $conn->prepare("
    SELECT COUNT(noticias.id_noticias)
    FROM noticias
    WHERE noticias.ativo = 1
    AND noticias.ref_id_utilizador = ?");

    $result->bind_param('s', $_SESSION['idUtilizador']);
    $result->execute();
    $result->bind_result($totalVideos);
    $result->fetch();
    $result->close();
    
    echo $totalVideos;

}