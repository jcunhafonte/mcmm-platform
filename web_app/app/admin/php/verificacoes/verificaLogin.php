<?php

session_start();

require_once('../libs/password.php');
require_once('../connection/dbconnection.php');

$email = "admin@ua.pt";

if (isset($email) && isset($_POST['palavraPasseUtilizador'])) {

        $ativo = 1;
        
        // Consulta de dados do Utilizador
        $query = "SELECT hash, password, nome_utilizador FROM utilizadores WHERE email = ? AND ativo = ?";

        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, 'si', $email, $ativo);
       
        
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $hashDB, $passwordDB, $utilizadorNome);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        if (password_verify($_POST['palavraPasseUtilizador'] . $hashDB, $passwordDB)) {

            $_SESSION['nomeAdmin'] = $utilizadorNome;
            $_SESSION['ativoAdmin'] = "Ativo";

            mysqli_stmt_close($stmt);
            header('location:../../index.php');

        }else{
            mysqli_stmt_close($stmt);
            header('location:../../entrar.php?falhado=1');
        }

}else{
    header('location:../../entrar.php?falhado=1');
}

?>