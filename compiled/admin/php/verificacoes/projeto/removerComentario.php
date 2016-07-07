<?php

require_once('../../connection/dbconnection.php');

session_start();

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_GET['comentario']))) {

    $comentario = $_GET['comentario'];

    $result = $link->prepare("
    DELETE FROM comentarios_projetos 
    WHERE id_comentarios_projetos = ?");

    $result->bind_param('s', $comentario);
    $result->execute();
    $result->close();

    $result = $link->prepare("
    DELETE FROM denuncia_comentarios_projetos WHERE ref_id_comentario = ?");

    $result->bind_param('s', $comentario);


    if($result->execute()){

        $result->close();
        header("location:../../../projetosComentarios.php?comentarioRemovido=" . $comentario);

    }else{

        $result->close();
        header("location:../../../projetosComentarios.php?comentarioRemovidoErro=" . $comentario);

    }
}