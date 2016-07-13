<?php

session_start();

require("../connection/mysql.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $result = $conn->prepare("UPDATE projetos SET titulo = ?, uc = ?,  para_1 = ?, para_2 = ?, ac = ?
WHERE id_projetos = ?");

    $result->bind_param('ssssss', $_POST['titulo'], $_POST['uc'], $_POST['para_1'],
        $_POST['para_2'], $_POST['ac'], $_POST['id_projects']);
    $result->execute();
    $result->close();
    
}

?>