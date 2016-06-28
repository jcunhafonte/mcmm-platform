<?php

require_once('../connection/dbconnection.php');

session_start();

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_GET['descricao'])) AND
    (!isset($_GET['perfil']))) {

    $tituloDescricao = $_GET['nome'];
    $descricao = $_GET['descricao'];

    $query = "DELETE FROM descricao WHERE id_descricao = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'i', $descricao);

    if (mysqli_stmt_execute($stmt)) {

        mysqli_stmt_close($stmt);
        header("location:../../registoDescricoes.php?descricaoRemovida=$tituloDescricao");

    } else {

        mysqli_stmt_close($stmt);
        header("location:../../registoDescricoes.php?descricaoRemovidaErro=$tituloDescricao");

    }
}