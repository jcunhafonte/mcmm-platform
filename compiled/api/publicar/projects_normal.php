<?php

session_start();

use editorFotos\SimpleImage;

require_once "../editorFotos/SimpleImage.php";
require("../connection/mysql.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $normal = 'normal';
    $result = $conn->prepare("
INSERT INTO projetos (tipo, titulo, uc, para_1, para_2, ac, ref_id_utilizador, data_publicacao) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    $result->bind_param('ssssssis', $normal, $_POST['titulo'], $_POST['uc'], $_POST['para_1'],
        $_POST['para_2'], $_POST['ac'], $_SESSION['idUtilizador'], date('Y-m-d H:i:s'));
    $result->execute();
    $id = $conn->insert_id;
    $result->close();

    $allowedExts = array("jpeg", "jpg", "png", "JPEG", "JPG", "PNG");
    $extension = end(explode(".", $_FILES["image"]["name"]));

    if ((($_FILES["image"]["type"] == "image/jpeg")
            || ($_FILES["image"]["type"] == "image/jpg")
            || ($_FILES["image"]["type"] == "image/png"))
        && ($_FILES["image"]["size"] < 50000000)
        && in_array($extension, $allowedExts))
    {
        if ($_FILES["image"]["error"] > 0) {
        } else {

            $target_dir = "../utilizadores/projetos/";
            $target_file = $_FILES["image"]["tmp_name"];

            try {

                $img = new SimpleImage();
                $img->load($target_file)->resize(431,431)->save($target_dir . $id . ".jpg");
            } catch (Exception $e) {

            }

            echo $id;
        }
    } else {

    }
}

?>