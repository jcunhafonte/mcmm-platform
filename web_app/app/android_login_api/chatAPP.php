<?php

require("connection/dbconnection.php");

// json response array
$user = array();
$linha = array();
$respostaFinal = array();

$transmissaoAtivo = (int)$_GET['transmissaoAtiva'];

$query = "SELECT id_transmissao FROM transmissoes WHERE ref_id_utilizador = ? AND direto = 1";

$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_param($stmt, 'i', $transmissaoAtivo);
mysqli_stmt_bind_result($stmt, $idTrChat);
mysqli_stmt_execute($stmt);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

$query = "SELECT chat.texto, chat.data_texto, chat.ref_id_utilizador, utilizadores.nome_utilizador
          FROM chat
          INNER JOIN utilizadores ON utilizadores.id_utilizador = chat.ref_id_utilizador
          WHERE chat.ref_id_transmissao = ?
          ORDER BY chat.data_texto DESC";

$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_param($stmt, 'i', $idTrChat);
mysqli_stmt_bind_result($stmt, $chatTexto, $chatDataTexto, $chatRefIdUt, $utNomeUt);
mysqli_stmt_execute($stmt);

while (mysqli_stmt_fetch($stmt)) {

    $dataTexto = strtotime($chatDataTexto);
    $dataTexto = date('H:i', $dataTexto);

    $linha['title'] = $utNomeUt;
    $linha['image'] = "http://wesee.diogosantos.pt/utilizadores/perfil/$chatRefIdUt.png";
    $linha['rating'] = $chatTexto;
    $linha['releaseYear'] = $dataTexto;
    $linha['genre'] = ["Action", "Drama", "Sci-Fi"];

    array_push($user, $linha);
}

mysqli_stmt_close($stmt);

echo json_encode($user, JSON_PRETTY_PRINT);