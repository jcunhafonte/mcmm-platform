<?php

function Menus($menuPai = '', $menuFilho = '', $menuNeto = '')
{
    echo "
    <!-- Top Bar Start -->
    <div class='topbar'>
        <div class='topbar-left'>
            <div class='logo'>
                <h1><a href='index.php' style='  margin-left: -80px;'></a>
                </h1>
            </div>
            <button class='button-menu-mobile open-left'>
                <i class='fa fa-bars'></i>
            </button>
        </div>
        <!-- Button mobile view to collapse sidebar menu -->
        <div class='navbar navbar-default' role='navigation'>
            <div class='container'>
                <div class='navbar-collapse2'>";


    echo "<ul class='nav navbar-nav navbar-right top-navbar'>";

    ini_set('display_errors', 'On');

    $hostname = "localhost";
    $username = "root";
    $password = "Saskatoon0708PM";
    $bd = "mcmm_platform";

    $ligacao = mysqli_connect($hostname, $username, $password, $bd);
    mysqli_set_charset($ligacao, "utf8");


    echo "<li class='dropdown iconify hide-phone'><a href='#' onclick='javascript:toggle_fullscreen()'><i
                                    class='icon-resize-full-2'></i></a></li>
                        <li class='dropdown topbar-profile'>
                            <a class='dropdown-toggle' data-toggle='dropdown' style='cursor: pointer'>
                                <span class='rounded-image topbar-profile-image'>
                                    <img src='assets/img/logo.svg' style='background: white'>
                                </span>
                                <strong>" . $_SESSION['nomeAdmin'] . "</strong> <i class='fa fa-caret-down'></i>
                            </a>
                            <ul class='dropdown-menu'>
                                <li>
                                    <a class='md-trigger' data-modal='logout-modal'><i class='icon-logout-1'></i>Sair</a>
                                </li>
                            </ul>
                        </li>";
    if ($menuNeto == 'ferias') {

        echo "<li class='right-opener'>
                        <a href='javascript:;' class='open-right'>
                              <i class='fa fa-angle-double-right'></i>
                        <i class='fa fa-angle-double-left'></i>
                        </a>
                    </li>";
    }
    echo "</ul>
                </div>
                <!--/.nav-collapse -->
            </div>
        </div>
    </div>
    <!-- Top Bar End -->
    <!-- Left Sidebar Start -->
    <div class='left side-menu'>
        <div class='sidebar-inner slimscrollleft'>
            <form role='search' class='navbar-form'>
                <div class='form-group'>
                </div>
            </form>
            <div class='clearfix'></div>
            <!--- Divider -->
            <div class='clearfix'></div>
            <div class='profile-info'>
                <div class='col-xs-4'>
                    <a class='rounded-image profile-image'>
                        <img src='assets/img/logo.svg' style='background: white'>
                    </a>
                </div>
                <div class='col-xs-8' style='margin-top: 10px'>
                    <div class='profile-text'>Administrador <b>MCMM</b></div>
                </div>
            </div>
            <div class='clearfix'></div>
            <!--- Divider -->
            <div id='sidebar-menu'>
                <ul>
                    <li class=''><a ";

    if (($menuPai == 'inicio') AND ($menuFilho == 'inicio')) {
        echo "class='active'";
    }

    echo " href='index.php' onclick='location.href=' ";
    echo "index.php";
    echo "'><i
                                class='icon-home-3'></i><span>Início</span></a></li>
                    <li class='has_sub'><a ";

    if ($menuPai == 'colaboradores') {
        echo "class='active'";
    }

    echo " href='javascript:void(0);'><i
                                class='icon-users'></i><span>Utilizadores</span> <span class='pull-right'><i
                                    class='fa fa-angle-down'></i></span></a>
                        <ul>
                            <li><a ";

    if ($menuFilho == 'atualColaborador') echo "class='active'";

    echo " href='utilizadoresAtivos.php'><span>Utilizadores Ativos</span></a></li>
                            <li><a ";

    if ($menuFilho == 'antigoColaborador') echo "class='active'";

    echo " href='utilizadoresInativos.php'><span>Utilizadores Inativos</span></a></li>

                        </ul>
                    </li>

                    <li class='has_sub'>
                        <a "; if ($menuPai == 'noticias') echo "class='active'";
                            echo " href='javascript:void(0);'><i class='fa fa-file-text'></i><span>Notícias</span>
                                <span class='pull-right'><i class='fa fa-angle-down'></i></span>
                        </a>
                        <ul>
                            <li><a ";

                                if ($menuFilho == 'noticiasAtivas') echo "class='active'";

                                echo " href='noticiasAtivas.php'><span>Notícias Ativas</span></a></li>
                            
                            <li><a ";

                                if ($menuFilho == 'noticiasInativas') echo "class='active'";

                                echo " href='noticiasInativas.php'><span>Notícias Inativas</span></a>
        
                            </li>
                            
                            <li><a ";
                                if ($menuFilho == 'destacadasNoticias') echo "class='active'";
                                echo " href='noticiasDestacadas.php'><span>Notícias Destacadas</span></a>
                            </li>
                            
                            <li><a ";

                                if ($menuFilho == 'comentariosNoticias') echo "class='active'";

                                echo " href='noticiasComentarios.php'><span>Comentários</span></a>
        
                            </li>
                            
                            <li><a ";

                                if ($menuFilho == 'comentariosDanunciadosNoticias') echo "class='active'";

                                echo " href='noticiasComentariosDenunciados.php'><span>Comentários Denunciados</span></a>
        
                            </li>
                            
                        </ul>
                    </li>
                    
                    
                     <li class='has_sub'>
                        <a "; if ($menuPai == 'projetos') echo "class='active'";
                            echo " href='javascript:void(0);'><i class='fa fa-sitemap'></i><span>Projetos</span>
                                <span class='pull-right'><i class='fa fa-angle-down'></i></span>
                        </a>
                        <ul>
                            <li><a ";

                                if ($menuFilho == 'projetosAtivos') echo "class='active'";

                                echo " href='projetosAtivos.php'><span>Projetos Ativos</span></a></li>
                            
                            <li><a ";

                                if ($menuFilho == 'projetosInativos') echo "class='active'";

                                echo " href='projetosInativos.php'><span>Projetos Inativos</span></a>
        
                            </li>
                            
                            <li><a ";
                                if ($menuFilho == 'destacadosProjetos') echo "class='active'";
                                echo " href='projetosDestacados.php'><span>Projetos Destacados</span></a>
                            </li>
                            
                            <li><a ";

                                if ($menuFilho == 'comentariosProjetos') echo "class='active'";

                                echo " href='projetosComentarios.php'><span>Comentários</span></a>
        
                            </li>
                            
                            <li><a ";

                                if ($menuFilho == 'comentariosDanunciadosProjetos') echo "class='active'";

                                echo " href='projetosComentariosDenunciados.php'><span>Comentários Denunciados</span></a>
        
                            </li>
                            
                        </ul>
                    </li>
                    
                    
                     <li class='has_sub'>
                        <a "; if ($menuPai == 'videos') echo "class='active'";
                            echo " href='javascript:void(0);'><i class='fa fa-video-camera'></i><span>Vídeos</span>
                                <span class='pull-right'><i class='fa fa-angle-down'></i></span>
                        </a>
                        <ul>
                            <li><a ";

                                if ($menuFilho == 'videosAtivos') echo "class='active'";

                                echo " href='videosAtivos.php'><span>Vídeos Ativos</span></a></li>
                            
                            <li><a ";

                                if ($menuFilho == 'videosInativos') echo "class='active'";

                                echo " href='videosInativos.php'><span>Vídeos Inativos</span></a>
        
                            </li>
                                                  
                            <li><a ";

                                if ($menuFilho == 'comentariosVideos') echo "class='active'";

                                echo " href='videosComentarios.php'><span>Comentários</span></a>
        
                            </li>
                            
                            <li><a ";

                                if ($menuFilho == 'comentariosDanunciadosVideos') echo "class='active'";

                                echo " href='videosComentariosDenunciados.php'><span>Comentários Denunciados</span></a>
        
                            </li>
                            
                        </ul>
                    </li>
                    
                    
                    <li><a ";

    if ($menuPai == 'alunos') echo "class='active'";

    echo " href='alunos.php'>
                    <i class='fa fa-graduation-cap'></i><span>Alunos</span></a>
                    </li>
                    
                     <li><a ";

    if ($menuPai == 'testemunhos') echo "class='active'";

    echo " href='testemunhos.php'>
                    <i class='fa fa-comments'></i><span>Testemunhos</span></a>
                    </li>
                    
                     <li><a ";

    if ($menuPai == 'parceiros') echo "class='active'";

    echo " href='parceiros.php'>
                    <i class='fa fa-building'></i><span>Parceiros</span></a>
                    </li>
                    
                    <li><a ";

                    if ($menuPai == 'docentes') echo "class='active'";

                    echo " href='docentes.php'>
                    <i class='fa fa-university'></i><span>Docentes</span></a>
                    </li>
                    
                    
                    <li><a ";

    if ($menuPai == 'exportdata') echo "class='active'";

    echo " href='exportarDados.php'>
                    <i class='fa fa-database'></i><span>Exportar Dados</span></a>
                    </li>

               
                    <li><a ";

    if ($menuPai == 'estatisticas') {
        echo "class='active'";
    }

    echo " href='estatisticas.php'>
                    <i class='fa fa-pie-chart'></i><span>Estatisticas</span></a>
                    </li>

                    <li><a ";

    if ($menuPai == 'mensagens') {
        echo "class='active'";
    }

    echo " href='mensagens.php'>
                    <i class='fa fa-envelope'></i><span>Mensagens</span></a>
                    </li>
                    
                    <li>
                    <a ";

                    if ($menuPai == 'newsletter') {
                    echo "class='active'";
                    }

                    echo " href='newsletter.php'>
                    <i class='fa fa-share'></i><span>Newsletter</span></a>
                    </li>

                </ul>
                <div class='clearfix'></div>
            </div>
            <div class='clearfix'></div>
            <div class='clearfix'></div>
            <br><br><br>
        </div>";
    if ($menuNeto == 'ferias') {

        echo "
<!-- Right Sidebar Start -->
    <div class='right side-menu'>
    	<ul class='nav nav-tabs nav-justified' id='right-tabs'>
		  <li class='active'><a href='#feed' data-toggle='tab' title='Live Feed'><i class='fa fa-plane fa-1x'></i> Férias Registadas</a></li>
		</ul>
		<div class='clearfix'></div>
		<div class='tab-content'>
		<div class='tab-pane active' id='feed'>
				<div class='tab-inner slimscroller'>
					<div class='panel-group' id='collapse'>
					  <div class='panel panel-default' id='chat-panel'>
					    <div class='panel-heading bg-orange-1'>
					      <h4 class='panel-title'>
					        <a data-toggle='collapse' href='#chat-coll'>
					          <i class='fa fa-calendar'></i> Férias Agendadas
					          <span class='label bg-darkblue-1 pull-right'>";

        $query = "SELECT COUNT( id_ferias ) FROM ferias INNER JOIN colaborador
ON ferias.ref_id_colaborador = colaborador.id_colaborador WHERE (inicio_ferias > CURDATE( ))
AND colaborador.ativo = 1";

        $stmt = mysqli_prepare($ligacao, $query);
        mysqli_stmt_bind_result($stmt, $numeroFeriasAgendadas);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        echo "$numeroFeriasAgendadas";

        echo "</span>
					        </a>
					      </h4>
					    </div>
					    <div id='chat-coll' class='panel-collapse collapse in'>
					      <div class='panel-body'>
					      	<ul class='list-unstyled' id='chat-list'>";

        $query = "SELECT COUNT( id_ferias ) FROM ferias INNER JOIN colaborador
ON ferias.ref_id_colaborador = colaborador.id_colaborador WHERE (inicio_ferias > CURDATE( ))
AND colaborador.ativo = 1";

        $stmt = mysqli_prepare($ligacao, $query);
        mysqli_stmt_bind_result($stmt, $numeroFeriasAgendadas);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            mysqli_stmt_close($stmt);

            $query = "SELECT inicio_ferias, fim_ferias, ref_id_colaborador, nome_completo
FROM ferias INNER JOIN colaborador ON colaborador.id_colaborador = ferias.ref_id_colaborador
 WHERE inicio_ferias > CURDATE( ) AND colaborador.ativo = 1 ORDER BY inicio_ferias ASC";

            $stmt = mysqli_prepare($ligacao, $query);
            mysqli_stmt_bind_result($stmt, $dataInicioFerias, $dataFimFerias, $idColaborador, $nomeCompleto);
            mysqli_stmt_execute($stmt);

            while (mysqli_stmt_fetch($stmt)) {

                $conversaoDataComportamento = new DateTime($dataInicioFerias);
                $textoDataComportamento = $conversaoDataComportamento->format('d-m-Y');

                $conversaoDataComportamentoFim = new DateTime($dataFimFerias);
                $textoDataComportamentoFim = $conversaoDataComportamentoFim->format('d-m-Y');

                echo "<li style='height: 90px !important;'>
                <a href='javascript:;'>
                    <span style='box-shadow: 0 0 0 2px #4EA6A6; height: 38px !important;' class='chat-user-avatar'>
                    <img src='images/users/user-256.jpg'>
                    </span>

                    <span class='chat-user-name'><a href='perfilColaborador.php?colaborador=$idColaborador'>$nomeCompleto</a></span>
<br>

                    <span class='chat-user-msg'>Início: $textoDataComportamento<br>
                    Fim: $textoDataComportamentoFim</span>
                    </a>
					      		</li>";
            }

        } else {
            mysqli_stmt_close($stmt);
        }


        echo "</ul>
					      </div>
					    </div>
					  </div>
					</div>


					<div class='panel-group' id='remails'>
					  <div class='panel panel-default' id='chat-panel'>
					    <div class='panel-heading bg-green-3'>
					      <h4 class='panel-title'>
					        <a data-toggle='collapse' href='#chat-collA'>
					          <i class='fa fa-fighter-jet'></i> Férias Ativas
					          <span class='label bg-darkblue-1 pull-right'>";

        $query = "SELECT COUNT( id_ferias ) FROM ferias INNER JOIN colaborador
ON ferias.ref_id_colaborador = colaborador.id_colaborador WHERE (CURDATE( ) BETWEEN inicio_ferias AND fim_ferias)
AND colaborador.ativo = 1";

        $stmt = mysqli_prepare($ligacao, $query);
        mysqli_stmt_bind_result($stmt, $numeroFeriasAtuais);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        echo "$numeroFeriasAtuais";

        echo "</span>
					        </a>
					      </h4>
					    </div>
					    <div id='chat-collA' class='panel-collapse collapse in'>
					      <div class='panel-body'>
					      	<ul class='list-unstyled' id='chat-list'>";

        $query = "SELECT COUNT( id_ferias ) FROM ferias INNER JOIN colaborador
ON ferias.ref_id_colaborador = colaborador.id_colaborador WHERE (CURDATE( ) BETWEEN inicio_ferias AND fim_ferias)
AND colaborador.ativo = 1";

        $stmt = mysqli_prepare($ligacao, $query);
        mysqli_stmt_bind_result($stmt, $numeroFeriasAtuais);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            mysqli_stmt_close($stmt);

            $query = "SELECT inicio_ferias, fim_ferias, ref_id_colaborador, nome_completo FROM ferias
INNER JOIN colaborador ON colaborador.id_colaborador = ferias.ref_id_colaborador
WHERE (CURDATE( ) BETWEEN inicio_ferias AND fim_ferias) AND colaborador.ativo = 1 ORDER BY inicio_ferias ASC";

            $stmt = mysqli_prepare($ligacao, $query);
            mysqli_stmt_bind_result($stmt, $dataInicioFerias, $dataFimFerias, $idColaborador, $nomeCompleto);
            mysqli_stmt_execute($stmt);

            while (mysqli_stmt_fetch($stmt)) {

                $conversaoDataComportamento = new DateTime($dataInicioFerias);
                $textoDataComportamento = $conversaoDataComportamento->format('d-m-Y');

                $conversaoDataComportamentoFim = new DateTime($dataFimFerias);
                $textoDataComportamentoFim = $conversaoDataComportamentoFim->format('d-m-Y');

                echo "<li style='height: 90px !important;'>
                <a href='javascript:;'>
                    <span style='box-shadow: 0 0 0 2px #4EA6A6; height: 38px !important;' class='chat-user-avatar'>
                    <img src='images/users/user-256.jpg'>
                    </span>

                    <span class='chat-user-name'><a href='perfilColaborador.php?colaborador=$idColaborador'>$nomeCompleto</a></span>
<br>

                    <span class='chat-user-msg'>Início: $textoDataComportamento<br>
                    Fim: $textoDataComportamentoFim</span>
                    </a>
					      		</li>";
            }

        } else {
            mysqli_stmt_close($stmt);
        }

        echo "</ul>
					      </div>


					    </div>
<br>
					    <div style='margin-top:10px !important;margin-left: 20px; !important; margin-right: 20px!important;'>
					      	 	<a href='registoFerias.php' class='btn btn-block btn-sm btn-warning'>Detalhes das Férias</a>
</div>
					  </div>
					</div>
				</div>

			</div>
		</div>
    </div>
    <!-- Right Sidebar End -->";
    }
    echo "</div>";
}

?>