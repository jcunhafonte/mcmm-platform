<?php

require("../connection/mysql.php");

if (isset($_POST['email_recover'])) {

    if (filter_var($_POST['email_recover'], FILTER_VALIDATE_EMAIL)) {

        $email = $_POST['email_recover'];
        $ativo = 1;

        $result = $conn->prepare("SELECT email FROM utilizadores WHERE (email = ?) AND (validado = 1)
        AND (id_facebook IS NULL) AND (id_google IS NULL) AND (id_twitter IS NULL)");
        $result->bind_param('s', $email);
        $result->execute();
        $result->store_result();
        $row_number = $result->num_rows;

        if ($row_number == 0) {
            $result->close();
            $arr = array('valid' => false);
            echo json_encode($arr);
            return true;
        } else {
            $result->close();
            $arr = array('valid' => true);
            echo json_encode($arr);
            return true;
        }
    } else {
        $arr = array('valid' => true);
        echo json_encode($arr);
        return true;
    }
} else {
    $arr = array('valid' => true);
    echo json_encode($arr);
    return true;
}

?>