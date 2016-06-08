<?php

require_once('connection/dbconnection.php');

// json response array
$response = array("error" => FALSE);
$user = array();

$utilizador = $_GET['utilizador'];

$query = "SELECT id_utilizador, nome_utilizador, email,
        data_registo, ultima_visita, num_visitas, sobre, idade, funcao
        FROM utilizadores
        WHERE id_utilizador = ? AND ativo = 1 AND validado = 1";

$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_param($stmt, 's', $utilizador);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $idUtilizadorV, $nomeUtilizadorV, $emailUtilizadorV,
    $dataRegistoV, $ultimaVisitaUtilizadorV, $numVisitasPerfilV, $sobreUtilizadorV, $idadeUtilizadorV, $funcaoUtilizadorV);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

$dataRegistoUtilizador = DateTime::createFromFormat('Y-m-d H:i:s', $dataRegistoV);
$dataRegistoUtilizador = $dataRegistoUtilizador->format('d-m-Y');

$diasPassados = date_create()->diff(date_create($ultimaVisitaUtilizadorV))->days;

if ($diasPassados == 0) {
    $diasPassados = "Hoje";
} else {
    if ($diasPassados == 1) {
        $diasPassados = "Ontem";
    } else {
        $diasPassados = "há " . $diasPassados . " dias";
    }
}

$query = "SELECT recomendacoes.ref_id_transmissao, transmissoes.ref_id_utilizador,
                    COUNT(recomendacoes.ref_id_transmissao)
                    FROM recomendacoes
                    INNER JOIN transmissoes ON transmissoes.id_transmissao = recomendacoes.ref_id_transmissao
                    WHERE transmissoes.ref_id_utilizador = ?";

$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_param($stmt, 'i', $_GET['utilizador']);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) > 0) {

    // Consultar dados da função
    $query = "SELECT recomendacoes.ref_id_transmissao, transmissoes.ref_id_utilizador,
                    COUNT(recomendacoes.ref_id_transmissao)
                    FROM recomendacoes
                    INNER JOIN transmissoes ON transmissoes.id_transmissao = recomendacoes.ref_id_transmissao
                    WHERE transmissoes.ref_id_utilizador = ?";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'i', $_GET['utilizador']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $refIdTrajetosRecomendacoes, $trajetosUtilizadores, $recomendacoesUtilizador);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
} else {
    mysqli_stmt_close($stmt);
}

$query = "SELECT COUNT(id_transmissao) FROM transmissoes WHERE ref_id_utilizador = ?";

$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_param($stmt, 'i', $_GET['utilizador']);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) > 0) {

    // Consultar dados da função
    $query = "SELECT COUNT(id_transmissao) FROM transmissoes WHERE ref_id_utilizador = ?";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'i', $_GET['utilizador']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $trajetosPartilhados);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

} else {
    mysqli_stmt_close($stmt);
}

$user = json_encode(
    [
        "error" => false,
        "user" => [
            "nome" => $nomeUtilizadorV,
            "email" => $emailUtilizadorV,
            "registo" => $dataRegistoUtilizador,
            "ultima_visita" => $diasPassados,
            "transmissoes" => $trajetosPartilhados,
            "recomendacoes" => $recomendacoesUtilizador,
            "visualizacoes_perfil" => $numVisitasPerfilV,
        ]
    ]
);

echo $user;