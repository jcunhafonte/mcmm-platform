<?php

session_start();

require("../../connection/mysql.php");

if(isset($_POST['comentario'])){

    $result = $conn->prepare("
    DELETE FROM denuncia_comentarios_videos WHERE ref_id_comentario = ?");

    $result->bind_param('s', $_POST['comentario']);
    $result->execute();
    $result->close();

    $result = $conn->prepare("
    INSERT INTO denuncia_comentarios_videos(ref_id_videos, ref_id_utilizador_denunciador, ref_id_comentario, data_denuncia) 
    VALUES (?, ?, ?, ?)");

    $result->bind_param('ssss', $_POST['video'], $_SESSION['idUtilizador'], $_POST['comentario'], date('Y-m-d H:i:s'));
    $result->execute();
    $result->close();

}