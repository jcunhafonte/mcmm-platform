<?php

session_start();

require_once('../libs/password.php');
require_once('../connection/dbconnection.php');

//$query = "INSERT INTO administrador(email, password, nomeUtilizador)
//VALUES (?, ?, ?)";
//
//$stmt = mysqli_prepare($link, $query);
//
//mysqli_stmt_bind_param($stmt, 'sss', $email, $hash, $nomeUt);
//
//$email = 'raquel@bentoenascimento.com';
//
//$passwordInserida='bentoena_RH123';
//$hash = password_hash($passwordInserida, PASSWORD_BCRYPT, array("cost" => 10));
//$nomeUt = 'Raquel';
//
//mysqli_stmt_execute($stmt);
//mysqli_stmt_close($stmt);


$query = "SELECT email, password FROM administrador";
$stmt = mysqli_prepare($link, $query);

mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $email, $hash);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

if (password_verify($_POST['passwordRH'], $hash)) {

    $_SESSION['nomeAdmin'] = "Raquel Ribeiro";
    $_SESSION['ativoAdmin'] = "Ativo";

    $query = "UPDATE administrador SET visitas = visitas + 1";
    $stmt = mysqli_prepare($link, $query);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        if(isset($_GET['url'])){
            $url = $_GET['url'];
            echo "<script>
                window.location.replace('$url')
                </script>";
        }else{
            echo "<script>
window.location.replace('http://www.bentoenascimento.com/recursosHumanos/administracao/index.php');
</script>";
        }
    } else {
        mysqli_stmt_close($stmt);
        header('location:../../entrar.php?falhado=1');
    }

} else {
    header('location:../../entrar.php?falhado=1');
}


?>