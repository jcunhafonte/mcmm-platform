<?php

require_once('../../connection/dbconnection.php');

session_start();

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_GET['comentario']))) {

    $comentario = $_GET['comentario'];


    $result = $link->prepare("
    DELETE FROM denuncia_comentarios_noticias WHERE id_denuncia_comentarios_noticias = ?");
    $result->bind_param('s', $comentario);

    if($result->execute()){
        $result->close();
        header("location:../../../noticiasComentariosDenunciados.php?denunciaRemovida=" . $comentario);
    }else{
        $result->close();
        header("location:../../../noticiasComentariosDenunciados.php?denunciaRemovidaErro=" . $comentario);
    }
}