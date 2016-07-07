<?php

function checkSession()
{
    if (!isset($_SESSION['idUtilizador'])) {
        if (isset($_COOKIE['keep_logged'])) {

            $hostname = "localhost";
            $username = "root";
            $password = "Saskatoon0708PM";
            $bd = "mcmm_platform";

            $conn = mysqli_connect($hostname, $username, $password, $bd);

            $result = $conn->prepare("SELECT hash, password, ativo, validado FROM utilizadores WHERE id_utilizador = ? AND ativo = 1");
            $result->bind_param('i', $_COOKIE['keep_logged']);
            $result->execute();
            $result->bind_result($hashDB, $passwordDB, $utilizadorAtivo, $utilizadorValidado);
            $result->fetch();
            $result->close();

            if ((int)$utilizadorValidado == 1) {
                if ((int)$utilizadorAtivo == 1) {

                    $ativo = 1;
                    $validado = 1;

                    $ultimaVisitaUt = date("Y-m-d H:i:s");
                    $result = $conn->prepare("UPDATE utilizadores SET ultima_visita = ? WHERE id_utilizador = ?");
                    $result->bind_param('ss', $ultimaVisitaUt, $_COOKIE['keep_logged']);
                    $result->execute();
                    $result->close();

                    $result = $conn->prepare("SELECT id_utilizador, nome_utilizador, email, data_registo, ultima_visita,
                    num_visitas, sobre, id_user
                    FROM utilizadores WHERE id_utilizador = ? AND ativo = ? AND validado = ?");
                    $result->bind_param('sii', $_COOKIE['keep_logged'], $ativo, $validado);
                    $result->execute();
                    $result->bind_result($idUtilizador, $nomeUtilizador, $emailUtilizador, $dataRegisto,
                        $ultimaVisitaUtilizador, $numVisitasPerfil, $sobreUtilizador, $idUser);
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
                    $_SESSION['idUser'] = $idUser;

                    setcookie('keep_logged', $_SESSION['idUtilizador'], time() + (30 * 24 * 60 * 60), '/');

                } else {
                }
            } else {
            }
        } else {
        }
    }
}

function metas()
{
    echo "
    
    <meta http-equiv=\"content-type\" content=\"text/html;charset=utf-8\"/>
    <meta charset=\"UTF-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">

    <meta name=\"author\" content=\"MCMM\">
    <meta name=\"description\" content=\"Plataforma MCMM\">
    <meta name=\"keywords\" content=\"UA, DECA, MCMM, AV, ...\">
    <meta name=\"title\" content=\"MCMM\">
    <meta name=\"referrer\" content=\"always\">

    <meta name=\"viewport\" content=\"width=device-width\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no\">
    <meta http-equiv=\"content-language\" content=\"pt\">

    <meta property=\"og:title\" content=\"MCMM - Mestrado em Comunicação Multimédia\">
    <meta property=\"og:type\" content=\"website\">
    <meta property=\"og:image\" content=\"http://mcmm.tech/images/social/sharer.jpg\">
    <meta property=\"og:site_name\" content=\"MCMM - Mestrado em Comunicação Multimédia\">
    <meta property=\"og:description\" content=\"Play is the highest form of research\">

    <meta name=\"twitter:card\" content=\"summary\">
    <meta name=\"twitter:title\" content=\"MCMM - Mestrado em Comunicação Multimédia\">
    <meta name=\"twitter:description\" content=\"Play is the highest form of research\">
    <meta name=\"twitter:image\" content=\"http://mcmm.tech/images/social/sharer.jpg\">";
}

function author_card($color = '', $idUtilizador, $idUser, $nomeUtilizador)
{
    echo "
     <div class=\"author-card hidden-sm hidden-xs\">
        <div class=\"wrapper\">
            <div class=\"contents col-xs-12\">
                <div class=\"col-xs-3\">
                    <div class=\"avatar\">
                        <img class=\"img-circle\" width=\"50\" height=\"50\"
                             src=\"/api/utilizadores/perfis/$idUtilizador.jpg\"
                        />
                    </div>
                </div>
                <div class=\"col-xs-6\">
                    <div class=\"name name-$color\">
                        <span onclick=\"window.location='/@$idUser'\">";
    echo h($nomeUtilizador);
    echo "</span>
                    </div>
                </div>";

    if (isset($_SESSION['idUtilizador'])) {
        if ($_SESSION['idUtilizador'] == $idUtilizador) {
            echo "
             <div class=\"col-xs-4\">
                <div class=\"btn-card-author btn-card-author-$color\">
                    Perfil
                </div>
            </div>";
        } else {
            echo "
             <div class=\"col-xs-4\">
                <div class=\"btn-card-author btn-card-author-$color\">
                    Seguir
                </div>
            </div>";
        }
    } else {
        echo "
             <div class=\"col-xs-4\">
                
            </div>";
    }

    echo "              
             </div>
        </div>
    </div>";
}

function arrows_area($platform, $color = '', $tituloAnterior, $idAnterior, $tituloSeguinte, $idSeguinte)
{

    echo "
      <div class=\"arrows-area hidden-sm hidden-xs\">
        <div class=\"right\" onclick=\"window.location='/$platform/$idSeguinte'\">
            <div class=\"wrapper\">
                <button type=\"button\" class=\"arrows arrow-right arrow-right-$color\"></button>
                <span class=\"text\">";
    echo h($tituloSeguinte);
    echo "</span>
            </div>
        </div>

        <div class=\"left\" onclick=\"window.location='/$platform/$idAnterior'\">
            <div class=\"wrapper\">
                <button type=\"button\" class=\"arrows arrow-left arrow-left-$color\"></button>
                <span class=\"text\">";
    echo h($tituloAnterior);
    echo "</span>
            </div>
        </div>
    </div>";

}

function next_page_video($tituloNext, $idVideosNext)
{
    echo "<div class=\"next-page\" onclick=\"window.location='/video/$idVideosNext'\">
            <div class=\"overlay\"></div>
            <div class=\"image\" style=\"background: no-repeat url('/images/backgrounds/default.jpg'); background-size:100%;\"></div>
            <div class=\"contents\">
                <div class=\"text\">
                    <span><i>Próximo Vídeo</i></span>
                    <h2>";
    echo h($tituloNext);
    echo "</h2>
                </div>
            </div>
        </div>";
}

function next_page_projects_normal($tituloNext, $idProjetosNext)
{
    echo "<div class=\"next-page\" onclick=\"window.location='/project/$idProjetosNext'\">
            <div class=\"overlay\"></div>
            <div class=\"image\" style=\"background: no-repeat url('/api/utilizadores/projetos/$idProjetosNext.jpg'); background-size:100%;\"></div>
            <div class=\"contents\">
                <div class=\"text\">
                    <span><i>Próximo Projeto</i></span>
                    <h2>";
    echo h($tituloNext);
    echo "</h2>
                </div>
            </div>
        </div>";
}

function next_page_projects_slider($tituloNext, $idProjetosNext)
{
    echo "<div class=\"next-page\" onclick=\"window.location='/project/$idProjetosNext'\">
            <div class=\"overlay\"></div>
            <div class=\"image\" style=\"background: no-repeat url('/api/utilizadores/projetos/" . $idProjetosNext . "_1.jpg'); background-size:100%;\"></div>
            <div class=\"contents\">
                <div class=\"text\">
                    <span><i>Próximo Projeto</i></span>
                    <h2>";
    echo h($tituloNext);
    echo "</h2>
                </div>
            </div>
        </div>";
}

function comments_video($color, $idVideos)
{
    $hostname = "localhost";
    $username = "root";
    $password = "Saskatoon0708PM";
    $bd = "mcmm_platform";

    $conn = mysqli_connect($hostname, $username, $password, $bd);
    mysqli_set_charset($conn, "utf8");

    $result = $conn->prepare("
    SELECT COUNT(comentarios_videos.id_comentarios_videos)
    FROM comentarios_videos 
    WHERE comentarios_videos.ref_id_videos = ?");

    $result->bind_param('s', $idVideos);
    $result->execute();
    $result->bind_result($totalComentarios);
    $result->fetch();
    $result->close();

    if ($totalComentarios == 1) {
        $textoComentarios = "1 Comentário";
    } else {
        $textoComentarios = "$totalComentarios Comentários";
    }

    echo "<div class=\"comments\" id='comments'>";

    echo "<div class=\"container old-comments\">
                <div class=\"row\">
                    <div class=\"col-md-8 col-md-offset-2\">
                        <div class=\"media-area\">
                            <p class=\"text-center\"><i>Participa na discussão</i></p>
                            <h3 class=\"text-center total-comments\">$textoComentarios</h3>
                            <div id='box-comments'>";


    $result = $conn->prepare("
SELECT comentarios_videos.id_comentarios_videos, comentarios_videos.comentario, comentarios_videos.ref_id_utilizador, 
comentarios_videos.ref_id_videos, comentarios_videos.data_comentario, utilizadores.nome_utilizador, 
utilizadores.id_utilizador, utilizadores.id_user
FROM comentarios_videos
INNER JOIN utilizadores 
ON utilizadores.id_utilizador = comentarios_videos.ref_id_utilizador
WHERE comentarios_videos.ref_id_videos = ?
ORDER BY comentarios_videos.data_comentario");

    $result->bind_param('s', $idVideos);
    $result->execute();
    $result->bind_result($idComentariosVideos, $comentario, $refIdUtilizador, $refIdVideos,
        $dataComentario, $nomeUtilizador, $idUtilizador, $idUser);

    while ($result->fetch()) {

        $dataC = strtotime($dataComentario);
        $dataC = date('Y-m-j', $dataC);

        $meses = array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
        $data = explode("-", $dataC);

        $dia = $data[2];
        $mes = $data[1];
        $ano = $data[0];
        $textoData = $dia . " de " . $meses[($mes) - 1] . ", " . $ano;

        echo "
                                <div class=\"media\" id='comment-list-$idComentariosVideos'>
                                    <a class=\"pull-left\">
                                        <div class=\"avatar\">
                                            <img class=\"media-object\" width='64px' height='64px'
                                            src=\"/api/utilizadores/perfis/$refIdUtilizador.jpg\">
                                        </div>
                                    </a>
                                    
                                    <div class=\"media-body\" style='display: block'>
                                        <div class=\"pull-left\">
                                            <div>
                                                <h4 class=\"media-heading media-heading-$color\"
                                                onclick=\"window.location='/@$idUser'\"
                                                >";
        echo h($nomeUtilizador);
        echo "</h4>
                                            </div>
                                            <div class=\"control-date\">
                                                <a class=\"media-date\">$textoData</a>
                                            </div>
                                        </div>
                                        <div class=\"pull-right\">
                                            <h6 class=\"text-muted\">";

        if (isset($_SESSION['idUtilizador'])) {

            if ($_SESSION['idUtilizador'] == $idUtilizador) {
                echo "  <a style='opacity: 1' class=\"remove-comment close $color\" aria-label=\"close\"
                                                data-toggle=\"modal\" data-target=\".modal-remove\"
                                                data-comment='$idComentariosVideos'
                                                >&times;</a>";
            } else {
                echo "<a href=\"\" class=\"alert-comment $color\"
                                                 data-toggle=\"modal\" data-target=\".modal-alert\"
                                                  data-comment='$idComentariosVideos'
                                                >Denunciar</a>";
            }
        }

        echo "</h6>
                                        </div>
                                    </div>
                                    
                                    <div  class=\"media-body\" style='display: inline-block; width: 100%; padding-left: 89px'>
                                      <div class=\"pull-left\">
                                            <p>";
        echo h($comentario);
        echo "</p>
                                        </div>
                                    </div>
                                    
                                </div>";
    }


    $result->close();

    echo "                 </div>
                        </div>
                    </div>
                </div>
            </div>";

    echo "<div class=\"divider\"></div>
            <div class=\"container new-comments\">
                <div class=\"row\">
                    <div class=\"col-md-8 col-md-offset-2\">
                        <h3 class=\"text-center\">Comenta</h3>
                        <div class=\"media media-post\">
                            <a class=\"pull-left author\" href=\"#\">
                                <div class=\"avatar\">
                                    <img class=\"media-object\" width='64px' height='64px'";

    if (!isset($_SESSION['idUtilizador'])) {
        echo "src=\"/images/avatar/avatar.jpg\"";
    } else {
        echo "src=\"/api/utilizadores/perfis/" . $_SESSION['idUtilizador'] . ".jpg\"";
    }

    echo ">
                                </div>
                            </a>
                            <div class=\"media-body\">
                                <form method='post' accept-charset='utf-8' id='submit_comment'>
                                    <div class='form-group text-comments'>
                                         <textarea id='comment' name='comment' class=\"form-control\" 
                                         placeholder=\"O meu comentário...\" rows=\"6\"";

    if (!isset($_SESSION['idUtilizador'])) {
        echo "onclick=\"openLoginModal();\"";
    }

    echo "></textarea>

                                        <input id='id_video_comment' type='hidden' value='$idVideos'/>
                                    </div>
                                                                
                                    <div class=\"media-footer\">";

    if (isset($_SESSION['idUtilizador'])) {
        echo "<button
                                        class=\"btn btn-info btn-comment pull-right btn-comment-$color\" type='submit'>
                                        Comentar
                                        </button>";
    }

    echo "</form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>";


}

function user_actions($totalComentarios, $classHeart, $totalGostos, $classes, $color)
{
    echo "
            <div class=\"user-actions $classes\">
            <div class=\"container\">
                <div class=\"row\">
                    <div class=\"col-xs-6\">
                        <div class=\"pull-left\">
                            <button class=\"btn ";

    if (isset($_SESSION['idUtilizador'])) {
        echo "heart-click";
    }
    echo "\" style='padding: 8px 4px;'";

    if (!isset($_SESSION['idUtilizador'])) {

        echo "onclick='openLoginModal();'";
    }
    echo ">
                                <i class=\"heart heart-$color fa fa-heart$classHeart\"></i>
                                <span class='total-likes'>$totalGostos</span>
                            </button>
                            <button class=\"btn btn-comments\">
                                <i class=\"fa fa-comment-o\"></i>
                                <span class='number-comments'>$totalComentarios</span>
                            </button>
                        </div>
                    </div>
                    <div class=\"col-xs-6 hidden-lg hidden-md\">
                        <div class=\"pull-right\">

                            <button class=\"btn\"
                                onclick=\"window.open('http://twitter.com/share?url=http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]&hashtags=MCMM', '_blank')\"
                            >
                                <svg class=\"twitter\" x=\"0px\" y=\"0px\" viewBox=\"0 0 52.851 52.851\" xml:space=\"preserve\"
                                     width=\"26px\" height=\"26px\">
                                    <g>
                                        <path
                                            d=\"M52.412,9.656c-0.354-0.24-0.823-0.227-1.165,0.031c-0.449,0.34-1.179,0.61-1.965,0.818   c2.047-2.294,2.091-3.826,2.069-4.178c-0.023-0.364-0.242-0.687-0.572-0.842c-0.331-0.156-0.719-0.118-1.014,0.096   c-2.303,1.674-4.597,2.027-5.961,2.063c-2.094-2.004-4.813-3.102-7.707-3.102c-6.196,0-11.236,5.108-11.236,11.386   c0,0.54,0.038,1.079,0.113,1.613C14.236,17.42,5.516,7.131,5.426,7.024c-0.21-0.25-0.528-0.384-0.854-0.355   c-0.326,0.028-0.617,0.213-0.78,0.497C0.702,12.526,2.77,17.234,4.66,19.93c-0.334-0.178-0.605-0.354-0.767-0.473   c-0.3-0.224-0.701-0.261-1.039-0.095c-0.337,0.166-0.552,0.506-0.559,0.881c-0.083,5.108,2.375,8.034,4.687,9.652   c-0.308-0.029-0.621,0.085-0.835,0.318c-0.24,0.261-0.325,0.63-0.221,0.969c1.597,5.227,5.518,7.003,8.013,7.606   c-5.13,3.994-12.68,2.708-12.763,2.694c-0.456-0.081-0.906,0.159-1.092,0.582c-0.185,0.422-0.059,0.917,0.309,1.197   c5.415,4.133,11.892,5.048,16.57,5.048c3.539,0,6.05-0.524,6.29-0.577c23.698-5.616,24.365-27.323,24.31-30.88   c4.449-4.137,5.144-5.713,5.251-6.103C52.929,10.336,52.767,9.896,52.412,9.656z M45.874,15.691c-0.223,0.205-0.34,0.5-0.32,0.803   c0.063,0.96,1.275,23.597-22.742,29.288c-0.109,0.023-9.656,2.015-17.932-2.085c3.497-0.097,8.511-1.013,12.004-4.935   c0.264-0.295,0.328-0.719,0.164-1.079c-0.162-0.357-0.519-0.586-0.91-0.586c-0.003,0-0.007,0-0.01,0   c-0.05,0.032-5.301-0.006-7.705-5.001c0.968,0.055,2.162-0.005,3.113-0.443c0.392-0.181,0.623-0.592,0.575-1.021   c-0.048-0.428-0.366-0.777-0.788-0.866c-0.269-0.057-6.115-1.364-6.933-7.741c0.887,0.388,2.022,0.705,3.144,0.534   c0.386-0.058,0.702-0.335,0.811-0.71s-0.01-0.779-0.305-1.035c-0.25-0.218-5.74-5.097-3.137-11.39   c2.826,2.965,11.196,10.67,21.337,10.088c0.297-0.017,0.572-0.167,0.749-0.407c0.176-0.24,0.236-0.546,0.164-0.835   c-0.192-0.765-0.29-1.553-0.29-2.341c0-5.176,4.144-9.386,9.237-9.386c2.491,0,4.828,0.994,6.579,2.8   c0.184,0.19,0.437,0.299,0.701,0.304c1.06,0.015,2.802-0.11,4.77-0.899c-0.568,0.707-1.402,1.554-2.629,2.518   c-0.347,0.273-0.474,0.74-0.313,1.151c0.161,0.412,0.577,0.671,1.011,0.632c0.233-0.019,1.421-0.123,2.764-0.414   C48.249,13.423,47.246,14.429,45.874,15.691z\"/>
                                    </g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                </svg>
                            </button>

                            <button class=\"btn\"
                                    onclick=\"window.open('http://www.facebook.com/sharer/sharer.php?u=http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]', '_blank')\"
                            >
                                <svg class=\"facebook\" x=\"0px\" y=\"0px\" viewBox=\"0 0 288.861 288.861\" xml:space=\"preserve\"
                                     width=\"26px\" height=\"26px\">
                                    <g>
                                        <path
                                            d=\"M167.172,288.861h-62.16V159.347H70.769v-59.48h34.242v-33.4C105.011,35.804,124.195,0,178.284,0   c19.068,0,33.066,1.787,33.651,1.864l5.739,0.746l-1.382,55.663l-6.324-0.058c-0.013,0-14.223-0.135-29.724-0.135   c-11.536,0-13.066,2.847-13.066,14.171v27.629h50.913l-2.821,59.48h-48.086v129.501H167.172z M117.858,276.007h36.453V146.5h48.677   l1.607-33.779h-50.284V72.238c0-13.368,3.078-27.025,25.919-27.025c9.178,0,17.899,0.045,23.509,0.09l0.778-31.292   c-5.675-0.508-15.116-1.157-26.247-1.157c-44.544,0-60.419,27.693-60.419,53.613v46.254H83.61V146.5h34.242v129.507H117.858z\"/>
                                    </g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                </svg>
                            </button>

                            <button class=\"btn\"
                                    onclick=\"window.open('https://plus.google.com/share?url=http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]', '_blank')\"
                            >
                                <svg width=\"34px\" height=\"34px\" xml:space=\"preserve\" class='google-plus'
                                     viewBox=\"0 0 518.18 383.89\">
                                    <defs>
                                        <style>.cls-11 {
                                                stroke: #fff;
                                                stroke-miterlimit: 10;
                                                stroke-width: 7px;
                                            }</style>
                                    </defs>
                                    <path class=\"cls-11\"
                                          d=\"M497.51,212.42H462.93V177.86a13.66,13.66,0,1,0-27.33,0v34.57H401a13.67,13.67,0,0,0,0,27.34H435.6v34.57a13.66,13.66,0,1,0,27.33,0V239.76h34.58a13.67,13.67,0,0,0,0-27.34h0Z\"
                                          transform=\"translate(3.51 -67.61)\"/>
                                    <path class=\"cls-11\"
                                          d=\"M348,212.42q-77.6.11-155.18,0h-0.09c-5.75,0-10.42,1.74-13.85,5.19-5.18,5.18-5.14,11.78-5.12,14.26,0.14,13.53.1,27,.09,40.6l0,16.32c0,13.92,6.42,20.43,20.22,20.43h20.41c16.41,0,32.85,0,49.37,0-0.15.3-.3,0.62-0.46,0.93-4.66,9.76-12,18.42-22.4,26.46-13.09,7.9-26.2,12.45-40.09,13.88-31.83,3.22-57.73-6.62-79.19-30.32-7.26-8-13.17-18.23-18.23-31-6.24-20.85-6.14-40.31.17-59.1a95.92,95.92,0,0,1,25.21-38.53c32.91-30.64,83.49-31.9,115.14-2.91,6.3,5.77,16.37,7.68,24.82-1.34l10.58-10.59c10.86-10.9,21.7-21.76,32.74-32.58,4.22-4.18,6.26-8.84,6.07-13.88-0.3-7.55-5.58-12-7.22-13.42C267,79,215.24,64.55,156.78,73.85,116.36,80.3,81,99.21,51.66,130c-12.83,13.41-22.58,27.09-29.74,41.64-1.79,3.38-4,7.62-4.49,8.74A186.7,186.7,0,0,0,1.64,284.27c2.82,22,9.13,42.13,18.38,59.34a176.64,176.64,0,0,0,50.14,62.5C105.5,434,144.86,448,187.66,448A221.55,221.55,0,0,0,242,440.93c27.43-6.94,51.51-20.12,71-38.62,11.34-9.67,21.14-21.52,29.89-36.27,23.81-40.14,31.75-85.18,24.27-137.7-0.5-3.74-3.42-15.9-19.18-15.9h0Zm-29.63,139c-7.14,12-14.93,21.5-24.42,29.61A131,131,0,0,1,235,413.25c-56,14.15-104.06,4.47-147.18-29.55a148.71,148.71,0,0,1-42.39-53c-8-14.9-13.09-31.26-15.5-50a158.62,158.62,0,0,1,13.36-88.25c0.23-.47.69-1.4,1.27-2.55A14.17,14.17,0,0,0,46,187.38c0.49-1,1-2.06,1.46-3.1,0.83-1.56,1.51-2.86,1.81-3.41a12,12,0,0,0,.54-1.12A143.57,143.57,0,0,1,72.3,149.68c24.94-26.17,54.89-42.2,89-47.66,46.64-7.47,86.83,2.18,122.74,29.67Q271.55,144,259.16,156.51L255,160.72c-42.65-31.82-104.58-28.26-145.57,9.9a126.35,126.35,0,0,0-32.72,50c-8.25,24.58-8.43,50.41-.17,77.86,6.74,17.17,14.37,30.12,24,40.8,27.65,30.52,62.52,43.81,103.3,39.55,18.17-1.87,35.9-8,52.67-18.31a10,10,0,0,0,1.2-.82c14.4-11,24.66-23.17,31.41-37.26a124.16,124.16,0,0,0,6.71-18.28c0.75-2.5,3-10-2.1-16.85-3.43-4.58-8.42-6.5-15.62-6.78-21.2.17-42.42,0.14-63.62,0.14l-12.1,0v-8.16c0-10.46,0-20.94,0-31.53Q271,241.12,340,241c4.51,42.14-2.58,78.35-21.66,110.5h0Z\"
                                          transform=\"translate(3.51 -67.61)\"/>
                                </svg>
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    ";
}

function comments_projetos($color, $idProjetos)
{
    $hostname = "localhost";
    $username = "root";
    $password = "Saskatoon0708PM";
    $bd = "mcmm_platform";

    $conn = mysqli_connect($hostname, $username, $password, $bd);
    mysqli_set_charset($conn, "utf8");

    $result = $conn->prepare("
    SELECT COUNT(comentarios_projetos.id_comentarios_projetos)
    FROM comentarios_projetos 
    WHERE comentarios_projetos.ref_id_projeto = ?");

    $result->bind_param('s', $idProjetos);
    $result->execute();
    $result->bind_result($totalComentarios);
    $result->fetch();
    $result->close();

    if ($totalComentarios == 1) {
        $textoComentarios = "1 Comentário";
    } else {
        $textoComentarios = "$totalComentarios Comentários";
    }

    echo "<div class=\"comments\" id='comments'>";

    echo "<div class=\"container old-comments\">
                <div class=\"row\">
                    <div class=\"col-md-8 col-md-offset-2\">
                        <div class=\"media-area\">
                            <p class=\"text-center\"><i>Participa na discussão</i></p>
                            <h3 class=\"text-center total-comments\">$textoComentarios</h3>
                            <div id='box-comments'>";


    $result = $conn->prepare("
SELECT comentarios_projetos.id_comentarios_projetos, comentarios_projetos.comentario, comentarios_projetos.ref_id_utilizador, comentarios_projetos.ref_id_projeto, comentarios_projetos.data_comentario, utilizadores.nome_utilizador, utilizadores.id_utilizador, utilizadores.id_user
FROM comentarios_projetos
INNER JOIN utilizadores ON utilizadores.id_utilizador = comentarios_projetos.ref_id_utilizador
WHERE comentarios_projetos.ref_id_projeto = ?
ORDER BY comentarios_projetos.data_comentario");

    $result->bind_param('s', $idProjetos);
    $result->execute();
    $result->bind_result($idComentariosProjetos, $comentario, $refIdUtilizador, $refIdProjetos,
        $dataComentario, $nomeUtilizador, $idUtilizador, $idUser);

    while ($result->fetch()) {

        $dataC = strtotime($dataComentario);
        $dataC = date('Y-m-j', $dataC);

        $meses = array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
        $data = explode("-", $dataC);

        $dia = $data[2];
        $mes = $data[1];
        $ano = $data[0];
        $textoData = $dia . " de " . $meses[($mes) - 1] . ", " . $ano;

        echo "
                                <div class=\"media\" id='comment-list-$idComentariosProjetos'>
                                    <a class=\"pull-left\">
                                        <div class=\"avatar\">
                                            <img class=\"media-object\" width='64px' height='64px'
                                            src=\"/api/utilizadores/perfis/$refIdUtilizador.jpg\">
                                        </div>
                                    </a>
                                    
                                    <div class=\"media-body\" style='display: block'>
                                        <div class=\"pull-left\">
                                            <div>
                                                <h4 class=\"media-heading media-heading-$color\"
                                                onclick=\"window.location='/@$idUser'\"
                                                >";
        echo h($nomeUtilizador);
        echo "</h4>
                                            </div>
                                            <div class=\"control-date\">
                                                <a class=\"media-date\">$textoData</a>
                                            </div>
                                        </div>
                                        <div class=\"pull-right\">
                                            <h6 class=\"text-muted\">";

        if (isset($_SESSION['idUtilizador'])) {

            if ($_SESSION['idUtilizador'] == $idUtilizador) {
                echo "  <a style='opacity: 1' class=\"remove-comment close $color\" aria-label=\"close\"
                                                data-toggle=\"modal\" data-target=\".modal-remove\"
                                                data-comment='$idComentariosProjetos'
                                                >&times;</a>";
            } else {
                echo "<a href=\"\" class=\"alert-comment $color\"
                                                 data-toggle=\"modal\" data-target=\".modal-alert\"
                                                  data-comment='$idComentariosProjetos'
                                                >Denunciar</a>";
            }
        }

        echo "</h6>
                                        </div>
                                    </div>
                                    
                                    <div  class=\"media-body\" style='display: inline-block; width: 100%; padding-left: 89px'>
                                      <div class=\"pull-left\">
                                            <p>";
        echo h($comentario);
        echo "</p>
                                        </div>
                                    </div>
                                    
                                </div>";
    }


    $result->close();

    echo "                 </div>
                        </div>
                    </div>
                </div>
            </div>";

    echo "<div class=\"divider\"></div>
            <div class=\"container new-comments\">
                <div class=\"row\">
                    <div class=\"col-md-8 col-md-offset-2\">
                        <h3 class=\"text-center\">Comenta</h3>
                        <div class=\"media media-post\">
                            <a class=\"pull-left author\" href=\"#\">
                                <div class=\"avatar\">
                                    <img class=\"media-object\" width='64px' height='64px'";

    if (!isset($_SESSION['idUtilizador'])) {
        echo "src=\"/images/avatar/avatar.jpg\"";
    } else {
        echo "src=\"/api/utilizadores/perfis/" . $_SESSION['idUtilizador'] . ".jpg\"";
    }

    echo ">
                                </div>
                            </a>
                            <div class=\"media-body\">
                                <form method='post' accept-charset='utf-8' id='submit_comment'>
                                    <div class='form-group text-comments'>
                                         <textarea id='comment' name='comment' class=\"form-control\" 
                                         placeholder=\"O meu comentário...\" rows=\"6\"";

    if (!isset($_SESSION['idUtilizador'])) {
        echo "onclick=\"openLoginModal();\"";
    }

    echo "></textarea>

                                        <input id='id_projeto_comment' type='hidden' value='$idProjetos'/>
                                    </div>
                                                                
                                    <div class=\"media-footer\">";

    if (isset($_SESSION['idUtilizador'])) {
        echo "<button
                                        class=\"btn btn-info btn-comment pull-right btn-comment-$color\" type='submit'>
                                        Comentar
                                        </button>";
    }

    echo "</form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>";


}

function comments_noticias($color, $idNoticias)
{
    $hostname = "localhost";
    $username = "root";
    $password = "Saskatoon0708PM";
    $bd = "mcmm_platform";

    $conn = mysqli_connect($hostname, $username, $password, $bd);
    mysqli_set_charset($conn, "utf8");

    $result = $conn->prepare("
    SELECT COUNT(comentarios_noticias.id_comentarios_noticias)
    FROM comentarios_noticias 
    WHERE comentarios_noticias.ref_id_noticia = ?");

    $result->bind_param('s', $idNoticias);
    $result->execute();
    $result->bind_result($totalComentarios);
    $result->fetch();
    $result->close();

    if ($totalComentarios == 1) {
        $textoComentarios = "1 Comentário";
    } else {
        $textoComentarios = "$totalComentarios Comentários";
    }

    echo "<div class=\"comments\" id='comments'>";

    echo "<div class=\"container old-comments\">
                <div class=\"row\">
                    <div class=\"col-md-8 col-md-offset-2\">
                        <div class=\"media-area\">
                            <p class=\"text-center\"><i>Participa na discussão</i></p>
                            <h3 class=\"text-center total-comments\">$textoComentarios</h3>
                            <div id='box-comments'>";


    $result = $conn->prepare("
SELECT comentarios_noticias.id_comentarios_noticias, comentarios_noticias.comentario, comentarios_noticias.ref_id_utilizador,
 comentarios_noticias.ref_id_noticia, comentarios_noticias.data_comentario, utilizadores.nome_utilizador, 
 utilizadores.id_utilizador, utilizadores.id_user
FROM comentarios_noticias
INNER JOIN utilizadores ON utilizadores.id_utilizador = comentarios_noticias.ref_id_utilizador
WHERE comentarios_noticias.ref_id_noticia = ?
ORDER BY comentarios_noticias.data_comentario");

    $result->bind_param('s', $idNoticias);
    $result->execute();
    $result->bind_result($idComentariosNoticias, $comentario, $refIdUtilizador, $refIdNoticias,
        $dataComentario, $nomeUtilizador, $idUtilizador, $idUser);

    while ($result->fetch()) {

        $dataC = strtotime($dataComentario);
        $dataC = date('Y-m-j', $dataC);

        $meses = array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
        $data = explode("-", $dataC);

        $dia = $data[2];
        $mes = $data[1];
        $ano = $data[0];
        $textoData = $dia . " de " . $meses[($mes) - 1] . ", " . $ano;

        echo "
                                <div class=\"media\" id='comment-list-$idComentariosNoticias'>
                                    <a class=\"pull-left\">
                                        <div class=\"avatar\">
                                            <img class=\"media-object\" width='64px' height='64px'
                                            src=\"/api/utilizadores/perfis/$refIdUtilizador.jpg\">
                                        </div>
                                    </a>
                                    
                                    <div class=\"media-body\" style='display: block'>
                                        <div class=\"pull-left\">
                                            <div>
                                                <h4 class=\"media-heading media-heading-$color\"
                                                onclick=\"window.location='/@$idUser'\"
                                                >";
        echo h($nomeUtilizador);
        echo "</h4>
                                            </div>
                                            <div class=\"control-date\">
                                                <a class=\"media-date\">$textoData</a>
                                            </div>
                                        </div>
                                        <div class=\"pull-right\">
                                            <h6 class=\"text-muted\">";

        if (isset($_SESSION['idUtilizador'])) {

            if ($_SESSION['idUtilizador'] == $idUtilizador) {
                echo "  <a style='opacity: 1' class=\"remove-comment close $color\" aria-label=\"close\"
                                                data-toggle=\"modal\" data-target=\".modal-remove\"
                                                data-comment='$idComentariosNoticias'
                                                >&times;</a>";
            } else {
                echo "<a href=\"\" class=\"alert-comment $color\"
                                                 data-toggle=\"modal\" data-target=\".modal-alert\"
                                                  data-comment='$idComentariosNoticias'
                                                >Denunciar</a>";
            }
        }

        echo "</h6>
                                        </div>
                                    </div>
                                    
                                    <div  class=\"media-body\" style='display: inline-block; width: 100%; padding-left: 89px'>
                                      <div class=\"pull-left\">
                                            <p>";
        echo h($comentario);
        echo "</p>
                                        </div>
                                    </div>
                                    
                                </div>";
    }


    $result->close();

    echo "                 </div>
                        </div>
                    </div>
                </div>
            </div>";

    echo "<div class=\"divider\"></div>
            <div class=\"container new-comments\">
                <div class=\"row\">
                    <div class=\"col-md-8 col-md-offset-2\">
                        <h3 class=\"text-center\">Comenta</h3>
                        <div class=\"media media-post\">
                            <a class=\"pull-left author\" href=\"#\">
                                <div class=\"avatar\">
                                    <img class=\"media-object\" width='64px' height='64px'";

    if (!isset($_SESSION['idUtilizador'])) {
        echo "src=\"/images/avatar/avatar.jpg\"";
    } else {
        echo "src=\"/api/utilizadores/perfis/" . $_SESSION['idUtilizador'] . ".jpg\"";
    }

    echo ">
                                </div>
                            </a>
                            <div class=\"media-body\">
                                <form method='post' accept-charset='utf-8' id='submit_comment'>
                                    <div class='form-group text-comments'>
                                         <textarea id='comment' name='comment' class=\"form-control\" 
                                         placeholder=\"O meu comentário...\" rows=\"6\"";

    if (!isset($_SESSION['idUtilizador'])) {
        echo "onclick=\"openLoginModal();\"";
    }

    echo "></textarea>

                                        <input id='id_noticia_comment' type='hidden' value='$idNoticias'/>
                                    </div>
                                                                
                                    <div class=\"media-footer\">";

    if (isset($_SESSION['idUtilizador'])) {
        echo "<button
                                        class=\"btn btn-info btn-comment pull-right btn-comment-$color\" type='submit'>
                                        Comentar
                                        </button>";
    }

    echo "</form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>";


}

function beautifulDate($dataSent)
{
    $dataP = strtotime($dataSent);
    $dataP = date('Y-m-j', $dataP);

    $meses = array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
    $data = explode("-", $dataP);

    $dia = $data[2];
    $mes = $data[1];
    $ano = $data[0];
    $textoData = $dia . " de " . $meses[($mes) - 1] . ", " . $ano;

    return $textoData;
}

function h($text, $charset = null)
{
    if (is_array($text)) {
        return array_map('h', $text);
    }
    if (empty($charset)) {
        $charset = 'UTF-8';
    }
    return htmlspecialchars($text, ENT_QUOTES, $charset);
}

function getCredentialsTwitter($id)
{

    $hostname = "localhost";
    $username = "root";
    $password = "Saskatoon0708PM";
    $bd = "mcmm_platform";

    $conn = mysqli_connect($hostname, $username, $password, $bd);

    $ultimaVisitaUt = date("Y-m-d H:i:s");
    $result = $conn->prepare("UPDATE utilizadores SET ultima_visita = ? WHERE id_twitter = ?");
    $result->bind_param('ss', $ultimaVisitaUt, $id);
    $result->execute();
    $result->close();

    $result = $conn->prepare("SELECT id_utilizador, nome_utilizador, email, data_registo, ultima_visita,
                    num_visitas, sobre, id_user, ativo
                    FROM utilizadores WHERE id_twitter = ?");
    $result->bind_param('s', $id);
    $result->execute();
    $result->bind_result($idUtilizador, $nomeUtilizador, $emailUtilizador, $dataRegisto,
        $ultimaVisitaUtilizador, $numVisitasPerfil, $sobreUtilizador, $idUser, $ativo);
    $result->fetch();
    $result->close();

    if ($ativo == 0) {
        header('location:/blocked');
    } else {

        $_SESSION['idUtilizador'] = $idUtilizador;
        $_SESSION['emailUtilizador'] = $emailUtilizador;
        $_SESSION['nomeUtilizador'] = $nomeUtilizador;
        $dataRegistoUtilizador = DateTime::createFromFormat('Y-m-d H:i:s', $dataRegisto);
        $dataRegistoUtilizador = $dataRegistoUtilizador->format('Y-m-d');
        $_SESSION['dataRegistoUtilizador'] = $dataRegistoUtilizador;
        $_SESSION['diasUltimaVisitaUtilizador'] = $ultimaVisitaUtilizador;
        $ultimaVisitaUtilizador = new DateTime($ultimaVisitaUtilizador);
        $dataAtual = new DateTime(date('Y-m-d H:i:s'));
        $diferenca = $dataAtual->diff($ultimaVisitaUtilizador);
        $ultimaVisitaHoras = $diferenca->h;
        $ultimaVisitaHoras = $ultimaVisitaHoras + ($diferenca->days * 24);
        $_SESSION['horaUltimaVisitaUtilizador'] = $ultimaVisitaHoras;
        $_SESSION['visualizacoesPerfil'] = $numVisitasPerfil;
        $_SESSION['sobreUtilizador'] = $sobreUtilizador;
        $_SESSION['idUser'] = $idUser;


        header('location:/@' . $idUser);
    }

}

function getCredentialsFacebook($id)
{

    $hostname = "localhost";
    $username = "root";
    $password = "Saskatoon0708PM";
    $bd = "mcmm_platform";

    $conn = mysqli_connect($hostname, $username, $password, $bd);

    $ultimaVisitaUt = date("Y-m-d H:i:s");
    $result = $conn->prepare("UPDATE utilizadores SET ultima_visita = ? WHERE id_facebook = ?");
    $result->bind_param('ss', $ultimaVisitaUt, $id);
    $result->execute();
    $result->close();

    $result = $conn->prepare("SELECT id_utilizador, nome_utilizador, email, data_registo, ultima_visita,
                    num_visitas, sobre, id_user, ativo
                    FROM utilizadores WHERE id_facebook = ?");
    $result->bind_param('s', $id);
    $result->execute();
    $result->bind_result($idUtilizador, $nomeUtilizador, $emailUtilizador, $dataRegisto,
        $ultimaVisitaUtilizador, $numVisitasPerfil, $sobreUtilizador, $idUser, $ativo);
    $result->fetch();
    $result->close();

    if ($ativo == 0) {
        header('location:/blocked');
    } else {

        $_SESSION['idUtilizador'] = $idUtilizador;
        $_SESSION['emailUtilizador'] = $emailUtilizador;
        $_SESSION['nomeUtilizador'] = $nomeUtilizador;
        $dataRegistoUtilizador = DateTime::createFromFormat('Y-m-d H:i:s', $dataRegisto);
        $dataRegistoUtilizador = $dataRegistoUtilizador->format('Y-m-d');
        $_SESSION['dataRegistoUtilizador'] = $dataRegistoUtilizador;
        $_SESSION['diasUltimaVisitaUtilizador'] = $ultimaVisitaUtilizador;
        $ultimaVisitaUtilizador = new DateTime($ultimaVisitaUtilizador);
        $dataAtual = new DateTime(date('Y-m-d H:i:s'));
        $diferenca = $dataAtual->diff($ultimaVisitaUtilizador);
        $ultimaVisitaHoras = $diferenca->h;
        $ultimaVisitaHoras = $ultimaVisitaHoras + ($diferenca->days * 24);
        $_SESSION['horaUltimaVisitaUtilizador'] = $ultimaVisitaHoras;
        $_SESSION['visualizacoesPerfil'] = $numVisitasPerfil;
        $_SESSION['sobreUtilizador'] = $sobreUtilizador;
        $_SESSION['idUser'] = $idUser;
        
        header('location:/@' . $idUser);
    }

}