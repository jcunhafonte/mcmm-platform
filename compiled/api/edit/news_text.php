<?php

session_start();

require("../connection/mysql.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $result = $conn->prepare("UPDATE noticias SET titulo = ?, tema = ?, para_1 = ?, preview = ? WHERE id_noticias = ?");

    $result->bind_param('sssss', $_POST['titulo'], $_POST['tema'], $_POST['para_1_submit'], $_POST['para_1'], $_POST['id_news']);
    $result->execute();
    $result->close();
    
}

?>