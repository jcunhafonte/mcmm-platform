<?php

require_once('../connection/dbconnection.php');

session_start();

if (isset($_SESSION['ativoAdmin'])) {

    $presenca = $_GET['presenca'];
    $colaborador = $_GET['colaborador'];
    $mes = $_GET['mesPresenca'];
    $ano = $_GET['anoPresenca'];
    $conversaoDataPresencas = $_GET['data'];

    $query = "DELETE FROM presencas WHERE id_presencas = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'i', $presenca);

    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_close($stmt);
        header("location:../../presencaDetalhe.php?colaborador=$colaborador&mesPresenca=$mes&anoPresenca=$ano&data=$conversaoDataPresencas&sucesso");
    }else{
        mysqli_stmt_close($stmt);
        header("location:../../presencaDetalhe.php?colaborador=$colaborador&mesPresenca=$mes&anoPresenca=$ano&data=$conversaoDataPresencas&erro");
    }

}