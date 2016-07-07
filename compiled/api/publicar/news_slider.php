<?php

session_start();

use editorFotos\SimpleImage;

require_once "../editorFotos/SimpleImage.php";
require("../connection/mysql.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $normal = 'slider';
    $result = $conn->prepare("
INSERT INTO noticias (tipo, titulo, tema, para_1, para_2, ref_id_utilizador, data_publicacao, preview) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    $result->bind_param('sssssiss', $normal, $_POST['titulo'], $_POST['tema'], $_POST['para_1_submit'],
        $_POST['para_2_submit'], $_SESSION['idUtilizador'], date('Y-m-d H:i:s'), $_POST['para_1']);
    $result->execute();
    $id = $conn->insert_id;
    $result->close();

    echo $id;

    if ($_FILES['image_1']['size'] > 0) {
        $allowedExts = array("jpeg", "jpg", "png", "JPEG", "JPG", "PNG");
        $extension_1 = pathinfo($_FILES['image_1']['name'], PATHINFO_EXTENSION);

        if ((($_FILES["image_1"]["type"] == "image/jpeg") || ($_FILES["image_1"]["type"] == "image/png"))

            && ($_FILES["image_1"]["size"] < 10000000)
            && in_array($extension_1, $allowedExts)
        ) {
            if ($_FILES["image_1"]["error"] > 0) {

            } else {

                $target_dir = "../utilizadores/noticias/";
                $target_file = $_FILES["image_1"]["tmp_name"];

                try {
                    $img = new SimpleImage();
                    $img->load($target_file)->resize(700, 700)->save($target_dir . $id . "_1.jpg");
                } catch (Exception $e) {

                }

            }
        } else {

        }
    }

    if ($_FILES['image_2']['size'] > 0) {
        $allowedExts = array("jpeg", "jpg", "png", "JPEG", "JPG", "PNG");
        $extension_2 = pathinfo($_FILES['image_2']['name'], PATHINFO_EXTENSION);

        if ((($_FILES["image_2"]["type"] == "image/jpeg") || ($_FILES["image_2"]["type"] == "image/png"))

            && ($_FILES["image_2"]["size"] < 10000000)
            && in_array($extension_2, $allowedExts)
        ) {
            if ($_FILES["image_2"]["error"] > 0) {

            } else {

                $target_dir = "../utilizadores/noticias/";
                $target_file = $_FILES["image_2"]["tmp_name"];

                try {
                    $img = new SimpleImage();
                    $img->load($target_file)->resize(700, 700)->save($target_dir . $id . "_2.jpg");
                } catch (Exception $e) {

                }

            }
        } else {

        }
    }

    if ($_FILES['image_3']['size'] > 0) {
        $allowedExts = array("jpeg", "jpg", "png", "JPEG", "JPG", "PNG");
        $extension_3 = pathinfo($_FILES['image_3']['name'], PATHINFO_EXTENSION);

        if ((($_FILES["image_3"]["type"] == "image/jpeg") || ($_FILES["image_3"]["type"] == "image/png"))

            && ($_FILES["image_3"]["size"] < 10000000)
            && in_array($extension_3, $allowedExts)
        ) {
            if ($_FILES["image_3"]["error"] > 0) {

            } else {

                $target_dir = "../utilizadores/noticias/";
                $target_file = $_FILES["image_3"]["tmp_name"];

                try {
                    $img = new SimpleImage();
                    $img->load($target_file)->resize(700, 700)->save($target_dir . $id . "_3.jpg");
                } catch (Exception $e) {

                }

            }
        } else {

        }
    }

    if ($_FILES['image_4']['size'] > 0) {
        $allowedExts = array("jpeg", "jpg", "png", "JPEG", "JPG", "PNG");
        $extension_4 = pathinfo($_FILES['image_3']['name'], PATHINFO_EXTENSION);

        if ((($_FILES["image_4"]["type"] == "image/jpeg") || ($_FILES["image_4"]["type"] == "image/png"))

            && ($_FILES["image_4"]["size"] < 10000000)
            && in_array($extension_4, $allowedExts)
        ) {
            if ($_FILES["image_4"]["error"] > 0) {

            } else {

                $target_dir = "../utilizadores/noticias/";
                $target_file = $_FILES["image_4"]["tmp_name"];

                try {
                    $img = new SimpleImage();
                    $img->load($target_file)->resize(700, 700)->save($target_dir . $id . "_4.jpg");
                } catch (Exception $e) {

                }

            }
        } else {

        }
    }
}
?>