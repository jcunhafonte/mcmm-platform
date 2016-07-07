<?php

session_start();

require("../../connection/mysql.php");

if(isset($_POST['comentario'])){

    $result = $conn->prepare("
    DELETE FROM comentarios_videos 
    WHERE id_comentarios_videos = ? AND comentarios_videos.ref_id_utilizador = ?");

    $result->bind_param('ss', $_POST['comentario'], $_SESSION['idUtilizador']);
    $result->execute();
    $result->close();

    $result = $conn->prepare("
    DELETE FROM denuncia_comentarios_videos WHERE ref_id_comentario = ?");

    $result->bind_param('s', $_POST['comentario']);
    $result->execute();
    $result->close();

    $result = $conn->prepare("
    SELECT COUNT(comentarios_videos.id_comentarios_videos)
    FROM comentarios_videos 
    WHERE comentarios_videos.ref_id_videos = ?");

    $result->bind_param('s', $_POST['video']);
    $result->execute();
    $result->bind_result($totalComentarios);
    $result->fetch();
    $result->close();

    echo $totalComentarios;

}