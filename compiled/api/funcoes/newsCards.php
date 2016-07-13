<?php

function cardNormal($id, $tema, $data, $titulo, $excerto, $nomeUtilizador, $refIdUtilizador, $idUser, $comments, $likes)
{
    echo "
    <div class=\"normal col-xs-12 col-sm-6 col-md-4 col-lg-3 masonry\">
        <div class=\"card\" onclick=\"window.location='/new/$id'\">
            <span class=\"theme\">
                <a>$tema</a>
            </span>
            <div class=\"control-image\">
                <div class=\"image\">
                    <img src=\"/api/utilizadores/noticias/$id.jpg\"/>
                </div>
            </div>
            <div class=\"content\" style='height: 300px;'>
                <p class=\"category\">$data</p>
                <a class=\"card-link\">
                    <h4 class=\"title\">" . h($titulo) . "</h4>
                </a>
                <div class=\"excerpt\">" . h($excerto) . "</div>
            </div>
            <div class=\"footer\">
                <div class=\"author\">
                    <a class=\"card-link\" href=\"/@$idUser\">
                        <img src=\"/api/utilizadores/perfis/$refIdUtilizador.jpg\" class=\"avatar\">
                        <span>" . h($nomeUtilizador) . "</span>
                    </a>
                </div>
                <div class=\"stats pull-right info-card\" style='margin-top: 2px'>
                    <div class=\"card-link\">
                        <i class=\"fa fa-comment-o\"></i> $comments
                    </div>
                    <div class=\"card-link\">
                        <i class=\"fa fa-heart-o\"></i> $likes
                    </div>
                </div>
            </div>
        </div>
    </div>";
}

function cardText($id, $nomeUtilizador, $excerto)
{
    echo "
        <div class=\"text col-xs-12 col-sm-6 col-md-4 col-lg-3 masonry\">
            <div class=\"card-quote\" onclick=\"window.location='/new/$id'\">
                <div class=\"quote\">
                </div>
                <div class=\"content\">
                    <h4 class=\"title\" style='word-break: break-all'>" . h($excerto) . "</h4>
                    <span class=\"author\">" . h($nomeUtilizador) . "</span>
                </div>
            </div>
        </div>";
}

function cardSlider($videoNumber, $id, $tema, $data, $titulo, $excerto, $nomeUtilizador, $refIdUtilizador, $idUser, $comments, $likes)
{
    echo "
        <div class=\"slider-carousel col-xs-12 col-sm-6 col-md-4 col-lg-3 masonry\">
            <div class=\"card card-many\" id='$id'>
                <span class=\"theme\">
                    <a>" . h ($tema) . "</a>
                </span>
                <div class=\"footer\">
                    <div class=\"author\">
                        <a class=\"card-link\" href=\"/@$idUser\">
                            <img src=\"/api/utilizadores/perfis/$refIdUtilizador.jpg\" class=\"avatar\">
                            <span>". h($nomeUtilizador) . "</span>
                        </a>
                    </div>
                    <div class=\"stats pull-right info-card\" style='margin-top: 2px !important;'>
                        <div class=\"card-link\">
                            <i class=\"fa fa-comment-o\"></i> $comments
                        </div>
                        <div class=\"card-link\">
                            <i class=\"fa fa-heart-o\"></i> $likes
                        </div>
                    </div>
                </div>
                              
                <div class=\"content\">
                    <p class=\"category\">$data</p>
                    <a class=\"card-link\">
                        <h4 class=\"title\">" . h($titulo) . "</h4>
                    </a>
                    <div class=\"excerpt\">" . h($excerto) . "</div>
                </div>
   
                <div class=\"image\">
                    <div id=\"card-many-carousel-$videoNumber\" class=\"carousel slide\" data-ride=\"carousel\">
                        <div class=\"carousel-inner\">";

                        for ($i = 1; $i <= 4; $i++) {
                            if (file_exists("api/utilizadores/noticias/" . $id . "_$i.jpg")) {

                                $active = ($i == 1) ? 'active' : '';
                                echo "
                                <div class=\"item $active\">
                                    <img src=\"api/utilizadores/noticias/" . $id . "_$i.jpg\"/>
                                </div>
                                ";
                            }
                        }

                echo "</div>
                    </div>
                </div>
                
                <div class=\"controlos\">
                    <a class=\"left carousel-control\" href=\"#card-many-carousel-$videoNumber\" data-slide=\"prev\">
                        <span class=\"icone pe-7s-angle-left\"></span>
                    </a>
                    <span id=\"slide-number-$videoNumber\" class=\"slide-number\"></span>
                    <a class=\"right carousel-control\" href=\"#card-many-carousel-$videoNumber\" data-slide=\"next\">
                        <span class=\"icone pe-7s-angle-right\"></span>
                    </a>
                </div>
            </div>
        </div>";
}

function cardVideo($idVideoNumber, $id, $tema, $data, $titulo, $excerto, $nomeUtilizador, $refIdUtilizador, $idUser, $comments, $likes, $extensao)
{
    echo "
        <div class=\"video col-xs-12 col-sm-6 col-md-4 col-lg-3 masonry\">
            <div class=\"card card-video\" onclick=\"window.location='/new/$id'\">
                <span class=\"theme\">
                    <a>$tema</a>
                </span>
                <div class=\"control-image\">
                    <div class=\"image\" id='video-player-$idVideoNumber'
                     data-url='api/utilizadores/noticias/$id.$extensao'>
                        <img src=\"\"/>
                    </div>
                    <div class=\"play\">
                        <span class=\"pe-7s-play\"></span>
                    </div>
                </div>
                <div class=\"content\">
                    <p class=\"category\">$data</p>
                    <a class=\"card-link\">
                        <h4 class=\"title\">" . h($titulo) . "</h4>
                    </a>
                    <div class=\"excerpt\">";
                        echo h(strip_tags($excerto));
                echo "</div>
                </div>
                <div class=\"footer\" style='position: relative !important;'>
                    <div class=\"author\">
                        <a class=\"card-link\" href=\"/@$idUser\">
                            <img src=\"/api/utilizadores/perfis/$refIdUtilizador.jpg\" class=\"avatar\">
                            <span>" . h($nomeUtilizador) . "</span>
                        </a>
                    </div>
                    <div class=\"stats pull-right info-card\" style='margin-top: 2px !important;'>
                        <div class=\"card-link\" href=\"#\">
                            <i class=\"fa fa-comment-o\"></i> $comments
                        </div>
                        <div class=\"card-link\" href=\"#\">
                            <i class=\"fa fa-heart-o\"></i> $likes
                        </div>
                    </div>
                </div>
            </div>
        </div>";
}