<?php

session_start();

require("../../connection/mysql.php");

if(isset($_POST['like'])){

    $result = $conn->prepare("
    DELETE FROM gostos_noticias 
    WHERE gostos_noticias.ref_id_noticias = ? AND gostos_noticias.ref_id_utilizador = ?");

    $result->bind_param('ss', $_POST['like'], $_SESSION['idUtilizador']);
    $result->execute();
    $result->close();

    $result = $conn->prepare("
    SELECT COUNT(gostos_noticias.id_gostos_noticias)
    FROM gostos_noticias 
    WHERE gostos_noticias.ref_id_noticias = ?");

    $result->bind_param('s', $_POST['like']);
    $result->execute();
    $result->bind_result($totalGostos);
    $result->fetch();
    $result->close();

    echo $totalGostos;

}