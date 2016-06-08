<?php

session_start();

$seed = 'DB97368CFAE81F9852EF15F76B6CF';

require("connection/dbconnection.php");

$_POST['emailUtilizador'] = "cunha@ua.pt";

$_POST['nomeUtilizador'] = 'cunha';

$_POST['palavraPasseUtilizador'] = 'cunha';
$_POST['confirmarPalavraPasseUtilizador'] = 'cunha';

// Verificar se email já existe
$email = $_POST['emailUtilizador'];

$query = "SELECT email FROM utilizadores WHERE email = ?";

$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_param($stmt, 's', $email);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);


if (mysqli_stmt_num_rows($stmt) > 0) {

    echo "Email já registado";
    mysqli_stmt_close($stmt);

} else {

    mysqli_stmt_close($stmt);

// Verificar Palavra-passe coincide
    if ($_POST['confirmarPalavraPasseUtilizador'] == $_POST['palavraPasseUtilizador']) {
// Verificar Email
        if (filter_var($email, FILTER_VALIDATE_EMAIL) AND strpos($email, '@ua.pt') == TRUE) {

            // Ligação à BD 
            $query = "INSERT INTO utilizadores (nome_utilizador, email, password, data_registo, ultima_visita, hash)
VALUES (?, ?, ?, ?, ?, ?)";

            $stmt = mysqli_prepare($link, $query);

            // Valores que são transmitidos para a BD
            $nomeUt = $_POST['nomeUtilizador'];
            $emailUt = $_POST['emailUtilizador'];
            // Segurança Palavra-passe
            $hashUt = hash("sha512", $seed . mt_rand());
            $passwordUt = password_hash($_POST['palavraPasseUtilizador'] . $hashUt, PASSWORD_BCRYPT);
            $dataRegistoUt = date("Y-m-d H:i:s");
            $ultimaVisitaUt = date("Y-m-d H:i:s");

            mysqli_stmt_bind_param($stmt, 'ssssss', $nomeUt, $emailUt, $passwordUt,
                $dataRegistoUt, $ultimaVisitaUt, $hashUt);


            // Executar o Statement
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);


//            include_once("../funcoes/enviarEmails.php");
//            enviarEmailRegisto();

//            $query = "SELECT id_utilizadores FROM utilizadores WHERE email = ?";
//
//            $stmt = mysqli_prepare($ligacao, $query);
//            mysqli_stmt_bind_param($stmt, 's', $email);
//            $email = $_POST['emailUtilizador'];
//
//            mysqli_stmt_execute($stmt);
//            mysqli_stmt_bind_result($stmt, $idUtilizador);
//            mysqli_stmt_fetch($stmt);
//            mysqli_stmt_close($stmt);
//

//            $target_dir = "../../../../IIS_tmp/Carfull/utilizadores/";

//            if ($genero == 1) {
//                $target_file = "../../images/avatar_fem.png";
//            } else {
//                $target_file = "../../images/avatar_masc.png";
//            }

//            try {
//                $img = new SimpleImage();
//
//                $img->load($target_file)->save($target_dir . $idUtilizador . ".png"); //redimensiona a foto com ratio em relação á medida de largura que puseres
//
//            } catch (Exception $e) {
//
//            }
        } else {
            $url = $_SERVER['HTTP_REFERER'];
            $url = preg_replace('/\?.*/', '', $url);
            header('location:' . $url . '?registo=3');
        }
    } else {
        $url = $_SERVER['HTTP_REFERER'];
        $url = preg_replace('/\?.*/', '', $url);
        header('location:' . $url . '?registo=3');
    }
}
?>