<?php

session_start();

require_once '../connection/dbconnection.php';

use editorFotos\SimpleImage;

require_once "../editorFotos/SimpleImage.php";

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_POST['nome']))) {


    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    $stringLatitude = (float)$latitude;
    $stringLongitude = (float)$longitude;

    $query = "INSERT INTO alunos (nome, funcao, empresa, conclusao, latitude, longitude) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'ssssdd', $_POST['nome'], $_POST['funcao'], $_POST['empresa'],
        $_POST['data_conclusao'], $stringLatitude, $stringLongitude);

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

                    $target_dir = "../../../api/utilizadores/alunos/";
                    $target_file = $_FILES["fotografia"]["tmp_name"];

                    try {
                        $img = new SimpleImage();
                        $img->load($target_file)->resize(120, 120)->save($target_dir . $id . ".jpg");
                    } catch (Exception $e) {

                    }
                    $response = "yes";
                }
            } else {
                $response = false;
            }
        }

        mysqli_stmt_close($stmt);
        header("location:../../alunos.php?alunoAdicionado");

    } else {

        mysqli_stmt_close($stmt);
        header("location:../../alunos.php?alunoAdicionadoErro");

    }

}
