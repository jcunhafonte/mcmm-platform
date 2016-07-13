<?php

session_start();

require_once '../connection/dbconnection.php';

use editorFotos\SimpleImage;
require_once "../editorFotos/SimpleImage.php";

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_POST['nome']))) {

    $query = "INSERT INTO parceiros (nome, url) VALUES (?, ?)";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'ss', $_POST['nome'], $_POST['url']);

    if (mysqli_stmt_execute($stmt)) {

        $id = mysqli_insert_id($link);

        if (isset($_FILES['logotipo'])) {

            $allowedExts = array("png","PNG");
            $extension = pathinfo($_FILES['logotipo']['name'], PATHINFO_EXTENSION);

            if (($_FILES["logotipo"]["type"] == "image/png")

                && ($_FILES["logotipo"]["size"] < 50000000)
                && in_array($extension, $allowedExts)
            ) {
                if ($_FILES["logotipo"]["error"] > 0) {
                } else {

                    $target_dir = "../../../api/utilizadores/parceiros/";
                    $target_file = $_FILES["logotipo"]["tmp_name"];

                    try {
                        $img = new SimpleImage();
                        $img->load($target_file)->save($target_dir . $id . ".png");
                    } catch (Exception $e) {

                    }
                    $response = "yes";
                }
            } else {
                $response = false;
            }
        }

        mysqli_stmt_close($stmt);
        header("location:../../parceiros.php?parceiroAdicionado");

    } else {

        mysqli_stmt_close($stmt);
        header("location:../../parceiros.php?parceiroAdicionadoErro");

    }

}
