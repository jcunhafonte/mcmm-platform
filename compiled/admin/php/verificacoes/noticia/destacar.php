<?php

require_once('../../connection/dbconnection.php');

session_start();

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_POST['noticia']))) {

    $noticia = $_POST['noticia'];

    $destacado = 1;
    $query = "UPDATE noticias SET destacado = ? WHERE id_noticias = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'ii', $destacado, $noticia);

    if (mysqli_stmt_execute($stmt)) {

        mysqli_stmt_close($stmt);
        header("location:../../../noticiasDestacadas.php?noticiaDestacada=" . $noticia);

    } else {

        mysqli_stmt_close($stmt);
        header("location:../../../noticiasDestacadas.php?noticiaDestacadaErro=" . $noticia);

    }

}