<?php

session_start();

require("../../connection/mysql.php");

if (isset($_POST['video'])) {

    $result = $conn->prepare("
    DELETE FROM gostos_videos WHERE ref_id_videos = ?");

    $result->bind_param('s', $_POST['video']);
    $result->execute();
    $result->close();

    $result = $conn->prepare("
    DELETE FROM denuncia_comentarios_videos WHERE ref_id_videos = ?");

    $result->bind_param('s', $_POST['video']);
    $result->execute();
    $result->close();

    $result = $conn->prepare("
    DELETE FROM comentarios_videos WHERE ref_id_videos = ?");

    $result->bind_param('s', $_POST['video']);
    $result->execute();
    $result->close();

    $result = $conn->prepare("
    DELETE FROM videos WHERE id_videos = ?");

    $result->bind_param('s', $_POST['video']);
    $result->execute();
    $result->close();

    $result = $conn->prepare("
    SELECT COUNT(videos.id_videos)
    FROM videos
    WHERE videos.ativo = 1
    AND videos.ref_id_utilizador = ?");

    $result->bind_param('s', $_SESSION['idUtilizador']);
    $result->execute();
    $result->bind_result($totalVideos);
    $result->fetch();
    $result->close();

    echo $totalVideos;

}