<?php

require_once 'xssAvoid.php';

function newsNormal($firstLetter, $para1, $para2, $cabecalho, $id)
{
    echo "
        <div class=\"news-normal\">
            <div class=\"container\">
                <div class=\"row\">
                    <div class=\"first-text col-xs-12\">
                      " . strip_tags($para1, "<b><p><i><blockquote><a><u>") . "
                    </div>
                    <div class=\"sub-header col-xs-12 wow fadeInUp\" data-wow-duration=\"1.5s\">
                        <h2 class=\"col-xs-12\">" . h($cabecalho) . "</h2>
                    </div>
                </div>
            </div>
            <div class=\"background\">
                <div class=\"wrapper-image\">
                    <div class=\"image parallax-background\"
                    style=\"background-image: url('/api/utilizadores/noticias/$id.jpg') \"></div>
                </div>
            </div>
            <div class=\"container\">
                <div class=\"row\">
                    <div class=\"second-text col-xs-12\">" . strip_tags($para2, "<b><p><i><blockquote><a><u>") . "</div>
                </div>
            </div>
        </div>
    ";
}

function newsText($firstLetter, $para1, $para2, $cabecalho, $id)
{
    echo "
         <div class=\"news-text\">
            <div class=\"container\">
                <div class=\"row\">
                    <div class=\"text col-xs-12\">
                      " . strip_tags($para1, "<b><p><i><blockquote><a><u>") . "
                       </div>
                </div>
            </div>
        </div>
    ";
}

function newsSlider($firstLetter, $para1, $para2, $cabecalho, $id)
{
    echo "
        <div class=\"news-slider-detail\">
            <div class=\"container\">
                <div class=\"row\">
                    <div class=\"first-text col-xs-12\">
                        " . strip_tags($para1, "<b><p><i><blockquote><a><u>") . "
                    </div>
                </div>
            </div>
            <div class=\"images  wow fadeInUp\" data-wow-duration=\"2s\"\">
                <div class=\"owl-carousel owl-theme\">";

            for ($i = 1; $i <= 4; $i++) {
                if (file_exists("api/utilizadores/noticias/" . $id . "_$i.jpg")) {
                    echo "
                        <div class=\"item\">
                            <img src=\"/api/utilizadores/noticias/" . $id . "_$i.jpg\"/>
                        </div>
                    ";
        }
    }

    echo "</div>
            </div>
            <div class=\"container\">
                <div class=\"row\">
                    <div class=\"second-text col-xs-12\">
                        " . strip_tags($para2, "<b><p><i><blockquote><a><u>") . "
                    </div>
                </div>
            </div>
        </div>    
    ";
}

function newsVideo($para1){
    echo "
        <div class=\"news-video\">
            <div class=\"container\">
                <div class=\"row\">
                    <div class=\"video col-xs-12\">
                        <div id=\"video-player\"></div>
                    </div>

                    <div class=\"text col-xs-12\">
                        " . strip_tags($para1, "<b><p><i><blockquote><a><u>") . "
                    </div>
                </div>
            </div>
        </div>
    ";
}

?>