<?php

session_start();

require("../../connection/mysql.php");

if(isset($_POST)) {

    $result = $conn->prepare("
    INSERT INTO comentarios_projetos(ref_id_utilizador, ref_id_projeto, data_comentario, comentario) 
    VALUES (?, ?, ?, ?)");
    $result->bind_param('ssss', $_SESSION['idUtilizador'], $_POST['projeto'], date('Y-m-d H:i:s'), $_POST['comentario']);
    $result->execute();
    $idComment = $conn->insert_id;
    $result->close();

    $dataC = strtotime(date('Y-m-d H:i:s'));
    $dataC = date('Y-m-j', $dataC);

    $meses = array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
    $data = explode("-", $dataC);

    $dia = $data[2];
    $mes = $data[1];
    $ano = $data[0];
    $textoData = $dia . " de " . $meses[($mes) - 1] . ", " . $ano;

    $idComentariosProjetos = $idComment;
    $refIdUtilizador = $_SESSION['idUtilizador'];
    $comentario = $_POST['comentario'];

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
                                                <h4 class=\"media-heading media-heading-yellow\"
                                                onclick=\"window.location='/@" . $_SESSION['idUser'] . "'\"
                                                >"; echo utf8_encode($_SESSION['nomeUtilizador']); echo "</h4>
                                            </div>
                                            <div class=\"control-date\">
                                                <a class=\"media-date\">$textoData</a>
                                            </div>
                                        </div>
                                        <div class=\"pull-right\">
                                            <h6 class=\"text-muted\">";

                                             if(isset($_SESSION['idUtilizador'])){

                                            if($_SESSION['idUtilizador'] == $refIdUtilizador){
                                                echo"<a style='opacity: 1' class=\"remove-comment close yellow\" aria-label=\"close\"
                                                    data-toggle=\"modal\" data-target=\".modal-remove\"
                                                data-comment='$idComentariosProjetos'
                                                >&times;</a>";
                                                }else{
                                                    echo"<a href=\"\" class=\"alert-comment yellow\"
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
                                            <p>"; echo $comentario; echo "</p>
                                        </div>
                                    </div>
                                    
                                </div>";

}