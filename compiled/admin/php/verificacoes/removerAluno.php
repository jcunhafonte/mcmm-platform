<?php

require_once('../connection/dbconnection.php');

session_start();

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_GET['aluno']))) {

    $aluno = $_GET['aluno'];

    $query = "DELETE FROM alunos WHERE id_alunos = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 's', $aluno);

    if (mysqli_stmt_execute($stmt)) {

        mysqli_stmt_close($stmt);
        header("location:../../alunos.php?alunoRemovido");

    } else {

        mysqli_stmt_close($stmt);
        header("location:../../alunos.php?alunoRemovido");

    }

}