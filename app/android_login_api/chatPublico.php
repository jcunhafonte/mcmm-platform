<?php

require("connection/dbconnection.php");

// json response array
$user = array();

$transmissaoAtivo = (int)$_GET['transmissaoAtiva'];

$query = "SELECT id_transmissao FROM transmissoes WHERE ref_id_utilizador = ? AND direto = 1";

$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_param($stmt, 'i', $transmissaoAtivo);
mysqli_stmt_bind_result($stmt, $idTrChat);
mysqli_stmt_execute($stmt);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

$query ="SELECT COUNT(id_publico) FROM publico WHERE ref_id_transmissao = ?";
$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_param($stmt, 'i', $idTrChat);
mysqli_stmt_bind_result($stmt, $numeroPessoas);
mysqli_stmt_execute($stmt);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

$user = json_encode(
    [
        "error" => false,
        "user" => [
            "publico" => $numeroPessoas
        ]
    ]
);
echo $user;