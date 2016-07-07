<?php

session_start();

require("../../connection/mysql.php");

if(isset($_POST['comentario'])){

    $result = $conn->prepare("
    DELETE FROM comentarios_noticias 
    WHERE id_comentarios_noticias = ? AND comentarios_noticias.ref_id_utilizador = ?");

    $result->bind_param('ss', $_POST['comentario'], $_SESSION['idUtilizador']);
    $result->execute();
    $result->close();

    $result = $conn->prepare("
    DELETE FROM denuncia_comentarios_noticias WHERE ref_id_comentario = ?");

    $result->bind_param('s', $_POST['comentario']);
    $result->execute();
    $result->close();

    $result = $conn->prepare("
    SELECT COUNT(comentarios_noticias.id_comentarios_noticias)
    FROM comentarios_noticias 
    WHERE comentarios_noticias.ref_id_noticia = ?");

    $result->bind_param('s', $_POST['noticia']);
    $result->execute();
    $result->bind_result($totalComentarios);
    $result->fetch();
    $result->close();

    echo $totalComentarios;

}