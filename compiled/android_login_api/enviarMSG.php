<?php

session_start();

require_once('connection/dbconnection.php');

if ($_POST) {

    $idUtilizador = trim($_POST['ref_id_utilizador']);
    $comentario = trim($_POST['textoInserido']);

    $query = "SELECT id_transmissao FROM transmissoes WHERE ref_id_utilizador = ? AND direto = 1";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'i', $idUtilizador);
    mysqli_stmt_bind_result($stmt, $idTrChat);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    $query = "INSERT INTO chat(ref_id_transmissao, ref_id_utilizador, texto) VALUES (?, ?, ?)";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'iis', $idTrChat, $idUtilizador, $comentario);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}