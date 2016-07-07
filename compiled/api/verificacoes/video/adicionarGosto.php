<?php

session_start();

require("../../connection/mysql.php");

if(isset($_POST['like'])){

    $result = $conn->prepare("
    DELETE FROM gostos_videos 
    WHERE gostos_videos.ref_id_videos = ? AND gostos_videos.ref_id_utilizador = ?");

    $result->bind_param('ss', $_POST['like'], $_SESSION['idUtilizador']);
    $result->execute();
    $result->close();

    $result = $conn->prepare("
    INSERT INTO gostos_videos(ref_id_utilizador, ref_id_videos, data_gosto) VALUES (?, ?, ?)");
    $result->bind_param('sss', $_SESSION['idUtilizador'], $_POST['like'], date('Y-m-d H:i:s'));
    $result->execute();
    $result->close();

    $result = $conn->prepare("
    SELECT COUNT(gostos_videos.id_gostos_videos)
    FROM gostos_videos 
    WHERE gostos_videos.ref_id_videos = ?");

    $result->bind_param('s', $_POST['like']);
    $result->execute();
    $result->bind_result($totalGostos);
    $result->fetch();
    $result->close();

    echo $totalGostos;
    
    
}