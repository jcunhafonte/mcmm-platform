<?php

require("../connection/mysql.php");

if (isset($_POST['utilizador_signupEnd'])) {

    $userID = $_POST['utilizador_signupEnd'];
    $ativo = 1;

    echo $userID;

    $result = $conn->prepare("SELECT id_user FROM utilizadores WHERE id_user = ?");
    $result->bind_param('s', $userID);
    $result->execute();
    $result->store_result();
    $row_number = $result->num_rows;

    if ($row_number == 0) {
        $result->close();
        $arr = array('valid' => true);
        echo json_encode($arr);
        return true;
    } else {
        $result->close();
        $arr = array('valid' => false);
        echo json_encode($arr);
        return true;
    }
} else {
    $arr = array('valid' => true);
    echo json_encode($arr);
    return true;
}

?>