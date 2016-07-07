<?php

session_start();

require("../connection/mysql.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    print_r($_POST);
    print_r($_FILES);

    $allowedExts = array("jpeg", "jpg", "png");
    $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

    if ((($_FILES["image"]["type"] == "image/jpeg") || ($_FILES["image"]["type"] == "image/png"))

        && ($_FILES["image"]["size"] < 50000000)
        && in_array($extension, $allowedExts)
    ) {
        if ($_FILES["image"]["error"] > 0) {
        } else {

            if (file_exists("../utilizadores/projetos/2.$extension")) {
            } else {
                move_uploaded_file($_FILES["image"]["tmp_name"],
                    "../utilizadores/projetos/" . "2." . $extension);
            }
        }
    } else {
        echo "Invalid file";
    }
}

?>