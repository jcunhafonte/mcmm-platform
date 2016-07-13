<?php

session_start();

require("../connection/mysql.php");

if(isset($_POST['nome']) AND isset($_POST['assunto']) AND isset($_POST['email']) AND isset($_POST['mensagem'])){

    $result = $conn->prepare("
    INSERT INTO mensagens(nome, email, assunto, texto, data_mensagem) VALUES (?, ?, ?, ?, ?)");
    $result->bind_param('sssss', $_POST['nome'], $_POST['email'], $_POST['assunto'], $_POST['mensagem'], date('Y-m-d H:i:s'));
    $result->execute();
    $result->close();

}