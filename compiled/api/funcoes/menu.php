<?php

function menu($platform = '', $path = null)
{

    $news = '';
    $projects = '';
    $videos = '';

    $news_underline = 'hvr-underline-from-center';
    $projects_underline = 'hvr-underline-from-center';
    $videos_underline = 'hvr-underline-from-center';

    switch ($platform) {
        case 'news';
            $news = 'is-active';
            $news_underline = '';
            break;
        case 'projects';
            $projects = 'is-active';
            $projects_underline = '';
            break;
        case 'videos';
            $videos = 'is-active';
            $videos_underline = '';
            break;
    }

    echo "<nav class=\"mcmm-nav mcmm-nav--top navbar-transparent\" id=\"topbar\" role=\"navigation\">
    <div class=\"container\">
        <div class=\"mcmm-nav-inner\">
            <div class=\"mcmm-nav-block mcmm-nav-block--left float-left\">
                <a href=\"/\" class=\"brand\">
                    <img class=\"brand-img\" src=\"";
                    echo $path;
                    echo "images/logo-w.svg\"/>
                </a>
            </div>
            <div class=\"mcmm-nav-block mcmm-nav-block--center\">
                <nav class=\"platforms platforms--mcmm-nav platforms--narrow\">
                    <ul class=\"platforms-list single\">
                        <li class=\"platforms-item $news\">
                            <a class=\"platforms-anchor $news_underline\" href=\"/news\">
                                Notícias
                            </a>
                        </li>
                        <li class=\"platforms-item $projects\">
                            <a class=\"platforms-anchor $projects_underline\" href=\"/projects\">
                                Projetos
                            </a>
                        </li>
                        <li class=\"platforms-item $videos\">
                            <a class=\"platforms-anchor $videos_underline\" href=\"/videos\">
                                Vídeos
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>";

    if (!isset($_SESSION['idUtilizador'])) {
        echo " <div class=\"mcmm-nav-block mcmm-nav-block--right float-right\">
                <div class=\"buttons-area\">
                    <a class=\"btn btn-primary btn-short btn-sign\" data-toggle=\"modal\"
                       href=\"javascript:void(0)\" onclick=\"openLoginModal();\">
                        Entrar
                    </a>
                    <span class=\"divider-bar\">/</span>
                    <a class=\"btn btn-primary btn-short btn-sign\" data-toggle=\"modal\"
                       href=\"javascript:void(0)\" onclick=\"openRegisterModal();\">
                        Registar
                    </a>
                </div>
            </div>";
    } else {
        echo "<div class=\"mcmm-nav-block mcmm-nav-block--right float-right\">
                <div class=\"buttons-area buttons-area-logged\">

                    <div class=\"button button--circle\" data-placement=\"bottom\" rel=\"tooltip\" title=\"Canal\"
                    onclick=\"window.location='/channel'\">
                        <i class=\"pe-7s-video\"></i>
                        <span style='display: none' class='button-badge'></span>
                    </div>
                                   
                    <div class=\"button button--circle\" data-placement=\"bottom\" rel=\"tooltip\" title=\"Publicar\"
                     onclick=\"window.location='/publish'\">
                        <i class=\"pe-7s-upload\"></i>
                    </div>

                    <div class=\"button button--circle no-border\">
                        <li class=\"dropdown\" style=\"list-style-type: none\">
                            <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">
                                <img width=\"40px\" height=\"40px\" class=\"avatar-image avatar\"
                                     src=\"/api/utilizadores/perfis/";
        echo $_SESSION['idUtilizador'] . ".jpg\">
                            </a>
                            <ul class=\"dropdown-menu\">
                                <li>
                                    <a href=\"/@";
        echo $_SESSION['idUser'] . "\">Perfil</a>
                                </li>
                                <li>
                                    <a href=\"/publish\">Publicar</a>
                                </li>
                                <li>
                                    <a href=\"/publications\">Publicações</a>
                                </li>
                                <li>
                                    <a data-toggle=\"modal\" data-target=\".modal-settings\">Definições</a>
                                </li>
                                <li class=\"divider\"></li>
                                <li>
                                    <a href=\"/exit\">Sair</a>
                                </li>
                            </ul>
                        </li>
                    </div>
                </div>
            </div>";
    }
    echo "</div>
    </div>
</nav>
<style>
.platforms-item a:focus{
text-decoration: none !important;
}
</style>
";

}