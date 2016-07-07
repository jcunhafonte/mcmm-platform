<?php

session_start();

require("../connection/mysql.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $normal = 'text';
    $result = $conn->prepare("
INSERT INTO noticias (tipo, titulo, tema, para_1, ref_id_utilizador, data_publicacao, preview) 
VALUES (?, ?, ?, ?, ?, ?, ?)");

    $result->bind_param('ssssiss', $normal, $_POST['titulo'], $_POST['tema'], $_POST['para_1_submit'],
        $_SESSION['idUtilizador'], date('Y-m-d H:i:s'), $_POST['para_1']);
    $result->execute();
    $id = $conn->insert_id;
    $result->close();
    
    echo $id;
}

?>