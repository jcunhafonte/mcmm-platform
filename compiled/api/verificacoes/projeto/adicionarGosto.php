<?php

session_start();

require("../../connection/mysql.php");

if(isset($_POST['like'])){

    $result = $conn->prepare("
    DELETE FROM gostos_projetos
    WHERE gostos_projetos.ref_id_projetos = ? AND gostos_projetos.ref_id_utilizador = ?");

    $result->bind_param('ss', $_POST['like'], $_SESSION['idUtilizador']);
    $result->execute();
    $result->close();

    $result = $conn->prepare("
    INSERT INTO gostos_projetos(ref_id_utilizador, ref_id_projetos, data_gosto) VALUES (?, ?, ?)");
    $result->bind_param('sss', $_SESSION['idUtilizador'], $_POST['like'], date('Y-m-d H:i:s'));
    $result->execute();
    $result->close();

    $result = $conn->prepare("
    SELECT COUNT(gostos_projetos.id_gostos_projetos)
    FROM gostos_projetos 
    WHERE gostos_projetos.ref_id_projetos = ?");

    $result->bind_param('s', $_POST['like']);
    $result->execute();
    $result->bind_result($totalGostos);
    $result->fetch();
    $result->close();

    echo $totalGostos;
    
    
}