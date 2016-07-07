<?php

session_start();

require("../connection/mysql.php");

if (isset($_POST['atual_password']) AND isset($_POST['new_password']) AND isset($_POST['confirm_new_password'])) {

    if ($_POST['new_password'] == $_POST['confirm_new_password']) {


        $result = $conn->prepare("SELECT hash, password FROM utilizadores WHERE id_utilizador = ?");
        $result->bind_param('s', $_SESSION['idUtilizador']);
        $result->execute();
        $result->bind_result($hashDB, $passwordDB);
        $result->fetch();
        $result->close();

        if (password_verify($_POST['atual_password'] . $hashDB, $passwordDB)) {

            $seed = 'DB97368CFAE81F9852EF15F76B6CF';
            $hash = hash("sha512", $seed . mt_rand());
            $password = password_hash($_POST['new_password'] . $hash, PASSWORD_BCRYPT);

            $result = $conn->prepare("UPDATE utilizadores SET hash = ?, password = ? WHERE id_utilizador = ?");

            $result->bind_param('ssi', $hash, $password, $_SESSION['idUtilizador']);
            $result->execute();
            $result->fetch();
            $result->close();

            include_once("../emails/SendGrid/funcoes.php");

            $linkUser = "http://mcmm.tech/@" . $_SESSION['idUser'];
            alteracaoPassword($_SESSION['nomeUtilizador'], $_SESSION['emailUtilizador'], $linkUser);

            echo "yes";

        } else {
            echo "no";
        }
    } else {
        echo "no";
    }
}

?>