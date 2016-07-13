<?php

session_start();

require("../connection/mysql.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $result = $conn->prepare("UPDATE videos SET titulo = ?, uc = ?,  para_1 = ?, para_2 = ?, tipologia = ?
WHERE id_videos = ?");

    $result->bind_param('ssssss', $_POST['titulo'], $_POST['uc'], $_POST['para_1'],
        $_POST['para_2'], $_POST['tipologia'], $_POST['id_video']);
    $result->execute();
    $result->close();
    
}

?>