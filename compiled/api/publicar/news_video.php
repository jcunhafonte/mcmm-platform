<?php

session_start();

require("../connection/mysql.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $allowedExts = array("mp4", "webm", "flv", "MP4", "WEBM", "FLV");
    $extension = pathinfo($_FILES['video']['name'], PATHINFO_EXTENSION);

    $normal = 'video';
    $result = $conn->prepare("
    INSERT INTO noticias (tipo, titulo, tema, para_1, cabecalho, ref_id_utilizador, data_publicacao, 
    extensao, preview) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $result->bind_param('sssssisss', $normal, $_POST['titulo'], $_POST['tema'], $_POST['para_1_submit'],
        $_POST['cabecalho'], $_SESSION['idUtilizador'], date('Y-m-d H:i:s'), $extension, $_POST['para_1']);
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
                "../utilizadores/noticias/" . $id ."." . $extension);
        }

        echo $id;

    } else {
        
    }
}

?>