<?php

session_start();

use editorFotos\SimpleImage;

require_once "../editorFotos/SimpleImage.php";
require("../connection/mysql.php");

$response = '';

if (isset($_FILES['image'])) {

    $allowedExts = array("jpeg", "jpg", "png", "JPEG", "JPG", "PNG");
    $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

    if ((($_FILES["image"]["type"] == "image/jpeg") || ($_FILES["image"]["type"] == "image/png"))

        && ($_FILES["image"]["size"] < 50000000)
        && in_array($extension, $allowedExts)
    ) {
        if ($_FILES["image"]["error"] > 0) {
        } else {

            $target_dir = "../utilizadores/perfis/";
            $target_file = $_FILES["image"]["tmp_name"];

            try {
                $img = new SimpleImage();
                $img->load($target_file)->resize(120, 120)->save($target_dir . $_SESSION['idUtilizador'] . ".jpg");
            } catch (Exception $e) {

            }
            $response = "yes";
        }
    } else {
        $response = false;
    }
}

if(isset($_POST['nome']) AND isset($_POST['sobre'])){

    $result = $conn->prepare("UPDATE utilizadores SET sobre = ?, nome_utilizador = ? WHERE id_utilizador = ?");

    $result->bind_param('ssi', $_POST['sobre'], $_POST['nome'], $_SESSION['idUtilizador']);
    $result->execute();
    $result->fetch();
    $result->close();

    $response = "yes";
}

$arr = array('response' => $response, 'sobre' => $_POST['sobre'], 'nome' => $_POST['nome']);
echo json_encode($arr);
return true;