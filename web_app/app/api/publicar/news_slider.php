<?php

session_start();

require("../connection/mysql.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    print_r($_POST);
    print_r($_FILES);

    if ($_FILES['image_1']['size'] > 0) {
        $allowedExts = array("jpeg", "jpg", "png");
        $extension_1 = pathinfo($_FILES['image_1']['name'], PATHINFO_EXTENSION);

        if ((($_FILES["image_1"]["type"] == "image/jpeg") || ($_FILES["image_1"]["type"] == "image/png"))

            && ($_FILES["image_1"]["size"] < 10000000)
            && in_array($extension_1, $allowedExts)
        ) {
            if ($_FILES["image_1"]["error"] > 0) {

            } else {

                if (file_exists("../utilizadores/projetos/2_1.$extension_1")) {
                } else {
                    move_uploaded_file($_FILES["image_1"]["tmp_name"],
                        "../utilizadores/projetos/" . "2_1." . $extension_1);
                }
            }
        } else {
            echo "Invalid file";
        }
    }

    if ($_FILES['image_2']['size'] > 0) {
        $allowedExts = array("jpeg", "jpg", "png");
        $extension_2 = pathinfo($_FILES['image_2']['name'], PATHINFO_EXTENSION);

        if ((($_FILES["image_2"]["type"] == "image/jpeg") || ($_FILES["image_2"]["type"] == "image/png"))

            && ($_FILES["image_2"]["size"] < 10000000)
            && in_array($extension_2, $allowedExts)
        ) {
            if ($_FILES["image_2"]["error"] > 0) {

            } else {

                if (file_exists("../utilizadores/projetos/2_2.$extension_2")) {
                } else {
                    move_uploaded_file($_FILES["image_2"]["tmp_name"],
                        "../utilizadores/projetos/" . "2_2." . $extension_2);
                }
            }
        } else {
            echo "Invalid file";
        }
    }

    if ($_FILES['image_3']['size'] > 0) {
        $allowedExts = array("jpeg", "jpg", "png");
        $extension_3 = pathinfo($_FILES['image_3']['name'], PATHINFO_EXTENSION);

        if ((($_FILES["image_3"]["type"] == "image/jpeg") || ($_FILES["image_3"]["type"] == "image/png"))

            && ($_FILES["image_3"]["size"] < 10000000)
            && in_array($extension_3, $allowedExts)
        ) {
            if ($_FILES["image_3"]["error"] > 0) {

            } else {

                if (file_exists("../utilizadores/projetos/2_3.$extension_3")) {
                } else {
                    move_uploaded_file($_FILES["image_3"]["tmp_name"],
                        "../utilizadores/projetos/" . "2_3." . $extension_3);
                }
            }
        } else {
            echo "Invalid file";
        }
    }

    if ($_FILES['image_4']['size'] > 0) {
        $allowedExts = array("jpeg", "jpg", "png");
        $extension_4 = pathinfo($_FILES['image_4']['name'], PATHINFO_EXTENSION);

        if ((($_FILES["image_4"]["type"] == "image/jpeg") || ($_FILES["image_4"]["type"] == "image/png"))

            && ($_FILES["image_4"]["size"] < 10000000)
            && in_array($extension_4, $allowedExts)
        ) {
            if ($_FILES["image_4"]["error"] > 0) {

            } else {

                if (file_exists("../utilizadores/projetos/2_4.$extension_4")) {
                } else {
                    move_uploaded_file($_FILES["image_4"]["tmp_name"],
                        "../utilizadores/projetos/" . "2_4." . $extension_4);
                }
            }
        } else {
            echo "Invalid file";
        }
    }
}
?>