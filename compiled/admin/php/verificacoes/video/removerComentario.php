<?php

require_once('../../connection/dbconnection.php');

session_start();

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_GET['comentario']))) {

    $comentario = $_GET['comentario'];

    $result = $link->prepare("
    DELETE FROM comentarios_videos 
    WHERE id_comentarios_videos = ?");

    $result->bind_param('s', $comentario);
    $result->execute();
    $result->close();

    $result = $link->prepare("
    DELETE FROM denuncia_comentarios_videos WHERE ref_id_comentario = ?");

    $result->bind_param('s', $comentario);


    if($result->execute()){

        $result->close();
        header("location:../../../videosComentarios.php?comentarioRemovido=" . $comentario);

    }else{

        $result->close();
        header("location:../../../videosComentarios.php?comentarioRemovidoErro=" . $comentario);

    }
}