<?php

session_start();

require("../../connection/mysql.php");

if (isset($_POST['projeto'])) {

    $result = $conn->prepare("
    DELETE FROM gostos_projetos WHERE ref_id_projetos = ?");

    $result->bind_param('s', $_POST['projeto']);
    $result->execute();
    $result->close();

    $result = $conn->prepare("
    DELETE FROM denuncia_comentarios_projetos WHERE ref_id_projetos = ?");

    $result->bind_param('s', $_POST['projeto']);
    $result->execute();
    $result->close();

    $result = $conn->prepare("
    DELETE FROM comentarios_projetos WHERE ref_id_projeto = ?");

    $result->bind_param('s', $_POST['projeto']);
    $result->execute();
    $result->close();

    $result = $conn->prepare("
    DELETE FROM projetos WHERE id_projetos = ?");

    $result->bind_param('s', $_POST['projeto']);
    $result->execute();
    $result->close();

    $result = $conn->prepare("
    SELECT COUNT(projetos.id_projetos)
    FROM projetos
    WHERE projetos.ativo = 1
    AND projetos.ref_id_utilizador = ?");

    $result->bind_param('s', $_SESSION['idUtilizador']);
    $result->execute();
    $result->bind_result($totalVideos);
    $result->fetch();
    $result->close();

    echo $totalVideos;

}