<?php

session_start();

require("../../connection/mysql.php");

if(isset($_POST['comentario'])){

    $result = $conn->prepare("
    DELETE FROM comentarios_projetos 
    WHERE id_comentarios_projetos = ? AND comentarios_projetos.ref_id_utilizador = ?");

    $result->bind_param('ss', $_POST['comentario'], $_SESSION['idUtilizador']);
    $result->execute();
    $result->close();

    $result = $conn->prepare("
    DELETE FROM denuncia_comentarios_projetos WHERE ref_id_comentario = ?");

    $result->bind_param('s', $_POST['comentario']);
    $result->execute();
    $result->close();

    $result = $conn->prepare("
    SELECT COUNT(comentarios_projetos.id_comentarios_projetos)
    FROM comentarios_projetos 
    WHERE comentarios_projetos.ref_id_projeto = ?");

    $result->bind_param('s', $_POST['projeto']);
    $result->execute();
    $result->bind_result($totalComentarios);
    $result->fetch();
    $result->close();

    echo $totalComentarios;

}