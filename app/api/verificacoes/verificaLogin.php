<?php

header('Access-Control-Allow-Origin: *');

session_start();
session_destroy();

$seed = 'DB97368CFAE81F9852EF15F76B6CF';
require("../connection/mysql.php");

session_start();

if (isset($_POST['emailUtilizador']) && isset($_POST['palavraPasseUtilizador'])) {

    if (filter_var($_POST['emailUtilizador'], FILTER_VALIDATE_EMAIL)) {

        $email = $_POST['emailUtilizador'];
        $ativo = 1;

        $result = $conn->prepare("SELECT email FROM utilizadores WHERE email = ?");
        $result->bind_param('s', $email);
        $result->execute();
        $result->store_result();
        $row_number = $result->num_rows;

        if ($row_number == 0) {
            $result->close();
            echo "entrar=5";
            return true;
        } else {
            $result->close();
        }

        // Consulta de dados do Utilizador
        $result = $conn->prepare("SELECT hash, password, ativo, validado FROM utilizadores WHERE email = ? AND ativo = ?");
        $result->bind_param('si', $email, $ativo);
        $result->execute();
        $result->bind_result($hashDB, $passwordDB, $utilizadorAtivo, $utilizadorValidado);
        $result->fetch();
        $result->close();

        if ((int)$utilizadorValidado == 1) {
            if ((int)$utilizadorAtivo == 1) {
                if (password_verify($_POST['palavraPasseUtilizador'] . $hashDB, $passwordDB)) {
                    // Se a palavra-passe for a correta, realizar diversas ações:

                    $email = $_POST['emailUtilizador'];
                    $ativo = 1;
                    $validado = 1;

                    $result = $conn->prepare("SELECT id_utilizador, nome_utilizador, email, data_registo, ultima_visita,
                    num_visitas, sobre, idade, funcao
                    FROM utilizadores WHERE email = ? AND ativo = ? AND validado = ?");
                    $result->bind_param('sii', $email, $ativo, $validado);
                    $result->execute();
                    $result->bind_result($idUtilizador, $nomeUtilizador, $emailUtilizador, $dataRegisto,
                        $ultimaVisitaUtilizador, $numVisitasPerfil, $sobreUtilizador, $idade, $funcao);
                    $result->fetch();
                    $result->close();

                    // Variável ID Utilizador
                    $_SESSION['idUtilizador'] = $idUtilizador;

                    // Variável Email Utilizador
                    $_SESSION['emailUtilizador'] = $emailUtilizador;

                    // Variável Sessão Nome
                    $_SESSION['nomeUtilizador'] = $nomeUtilizador;

                    // Varíavel Sessão Data Registo
                    $dataRegistoUtilizador = DateTime::createFromFormat('Y-m-d H:i:s', $dataRegisto);
                    $dataRegistoUtilizador = $dataRegistoUtilizador->format('Y-m-d');
                    $_SESSION['dataRegistoUtilizador'] = $dataRegistoUtilizador;

                    // Variável Sessão Hora Visita
                    $_SESSION['diasUltimaVisitaUtilizador'] = $ultimaVisitaUtilizador;

                    $ultimaVisitaUtilizador = new DateTime($ultimaVisitaUtilizador);
                    $dataAtual = new DateTime(date('Y-m-d H:i:s'));
                    $diferenca = $dataAtual->diff($ultimaVisitaUtilizador);
                    $ultimaVisitaHoras = $diferenca->h;
                    $ultimaVisitaHoras = $ultimaVisitaHoras + ($diferenca->days * 24);
                    $_SESSION['horaUltimaVisitaUtilizador'] = $ultimaVisitaHoras;

                    $_SESSION['visualizacoesPerfil'] = $numVisitasPerfil;
                    $_SESSION['sobreUtilizador'] = $sobreUtilizador;
                    $_SESSION['funcaoUtilizador'] = $funcao;
                    $_SESSION['idadeUtilizador'] = $idade;

                    if ((int)$_POST['continuarLogado'] == 1) {
                        setcookie('keep_logged', $_SESSION['idUtilizador'], time() + (30 * 24 * 60 * 60), '/');
                    }

                    echo "entrar=1";

                } else {
                    echo "entrar=4";
                }
            } else {
                echo "bloqueado=1";
            }
        } else {
            echo "validado=0";
        }
    } else {
        echo "entrar=2";
    }
} else {
    echo "entrar=3";
}

?>