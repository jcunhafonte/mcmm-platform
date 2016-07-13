<?php

session_start();

require("../../connection/mysql.php");

if(isset($_POST['noticia'])){

    $result = $conn->prepare("
    SELECT gostos_noticias.id_gostos_noticias, gostos_noticias.ref_id_utilizador, 
    gostos_noticias.ref_id_noticias, utilizadores.nome_utilizador, utilizadores.id_user
    FROM gostos_noticias
    INNER JOIN utilizadores 
    ON gostos_noticias.ref_id_utilizador = utilizadores.id_utilizador
    WHERE gostos_noticias.ref_id_noticias = ?
    ORDER BY utilizadores.nome_utilizador");

    $result->bind_param('s', $_POST['noticia']);
    $result->execute();
    $result->bind_result($idGostosNoticias, $refIdUtilizador, $refIdNoticias, $nomeUtilizador, $idUser);

    while($result->fetch()){

        echo "
        <tr>
            <td width=\"80%\">
                <a class='anchor-likes' href='/@$idUser' style='display: inherit'>
                    <img style=\"border-radius: 50%; float: left\" width=\"60px\" height=\"60px\"
                         src='/api/utilizadores/perfis/$refIdUtilizador.jpg'>
                    <h5 class='title-likes' style=\"line-height: 60px; padding-left: 80px; margin:0\">
                        $nomeUtilizador
                    </h5>
                </a>
            </td>
            <td class=\"text-right\" style=\"vertical-align: middle;width: 70px !important;
            display: block; float: right; margin-top: 12px\">
                <button class=\"btn-likes\" onclick=\"window.location='/@$idUser'\"
                >Perfil</button>
            </td>
        </tr>
        ";

    }

    $result->close();

}