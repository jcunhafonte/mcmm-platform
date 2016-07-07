<?php

session_start();

require("../connection/mysql.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $allowedExts = array("mp4", "webm", "flv", "MP4", "WEBM", "FLV");
    $extension = pathinfo($_FILES['video']['name'], PATHINFO_EXTENSION);

    $result = $conn->prepare("
INSERT INTO videos (titulo, uc, para_1, para_2, tipologia, 
ref_id_utilizador, data_publicacao, extensao) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    $result->bind_param('sssssiss', $_POST['titulo'], $_POST['uc'], $_POST['para_1'],
        $_POST['para_2'], $_POST['tipologia'], $_SESSION['idUtilizador'], date('Y-m-d H:i:s'),
        $extension);
    $result->execute();
    $id = $conn->insert_id;
    $result->close();

    if ((($_FILES["video"]["type"] == "video/mp4")
            || ($_FILES["video"]["type"] == "video/webm")
            || ($_FILES["video"]["type"] == "video/x-flv"))

        && ($_FILES["video"]["size"] < 50000000)
        && in_array($extension, $allowedExts)
    ) {
        if ($_FILES["video"]["error"] > 0) {
        } else {
            move_uploaded_file($_FILES["video"]["tmp_name"],
                "../utilizadores/videos/" . $id ."." . $extension);
        }

        echo $id;

    } else {
        echo "Invalid file";
    }
}

?>