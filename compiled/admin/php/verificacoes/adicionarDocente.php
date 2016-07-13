<?php

session_start();

require_once '../connection/dbconnection.php';

use editorFotos\SimpleImage;
require_once "../editorFotos/SimpleImage.php";

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_POST['nome']))) {

    $query = "INSERT INTO docentes (nome) VALUES (?)";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 's', $_POST['nome']);

    if (mysqli_stmt_execute($stmt)) {

        $id = mysqli_insert_id($link);

        if (isset($_FILES['fotografia'])) {

            $allowedExts = array("jpeg", "jpg", "png", "JPEG", "JPG", "PNG");
            $extension = pathinfo($_FILES['fotografia']['name'], PATHINFO_EXTENSION);

            if ((($_FILES["fotografia"]["type"] == "image/jpeg") || ($_FILES["fotografia"]["type"] == "image/png"))

                && ($_FILES["fotografia"]["size"] < 50000000)
                && in_array($extension, $allowedExts)
            ) {
                if ($_FILES["fotografia"]["error"] > 0) {
                } else {

                    $target_dir = "../../../api/utilizadores/docentes/";
                    $target_file = $_FILES["fotografia"]["tmp_name"];

                    try {
                        $img = new SimpleImage();
                        $img->load($target_file)->resize(500, 500)->save($target_dir . $id . ".jpg");
                    } catch (Exception $e) {

                    }
                    $response = "yes";
                }
            } else {
                $response = false;
            }
        }

        mysqli_stmt_close($stmt);
        header("location:../../docentes.php?docenteAdicionado");

    } else {

        mysqli_stmt_close($stmt);
        header("location:../../docentes.php?docenteAdicionadoErro");

    }

}
