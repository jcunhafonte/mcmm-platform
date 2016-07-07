<?php

session_start();

require("../connection/mysql.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    print_r($_POST);
    print_r($_FILES);

    $allowedExts = array("mp4", "webm", "flv");
    $extension = pathinfo($_FILES['video']['name'], PATHINFO_EXTENSION);

    if ((($_FILES["video"]["type"] == "video/mp4")
            || ($_FILES["video"]["type"] == "video/webm")
            || ($_FILES["video"]["type"] == "video/x-flv"))

        && ($_FILES["video"]["size"] < 50000000)
        && in_array($extension, $allowedExts)
    ) {
        if ($_FILES["video"]["error"] > 0) {
        } else {

            if (file_exists("../utilizadores/videos/2.$extension")) {
            } else {
                move_uploaded_file($_FILES["video"]["tmp_name"],
                    "../utilizadores/videos/" . "2." . $extension);
            }
        }
    } else {
        echo "Invalid file";
    }
}

?>