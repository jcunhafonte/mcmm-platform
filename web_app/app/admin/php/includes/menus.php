<?php

function Menus($menuPai = '', $menuFilho = '', $menuNeto = '')
{
    echo "
    <!-- Top Bar Start -->
    <div class='topbar'>
        <div class='topbar-left'>
            <div class='logo'>
                <h1><a href='index.php' style='  margin-left: -80px;'><img src='assets/img/logo.png' alt='Logo'></a>
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

    if ($menuNeto == 'calculadora') {
        echo "<ul class='nav navbar-nav hidden-xs'>
                        <li class='dropdown'>
                            <a href='#' class='dropdown-toggle' data-toggle='dropdown'>
                            <i class='icon-th'></i></a>

                            <div class='dropdown-menu grid-dropdown'>
                                <div class='row stacked'>
                                    <div class='col-xs-4'>
                                        <a href='javascript:;' data-app='calc' data-status='inactive'><i
                                                class='fa fa-calculator'></i>Calculadora</a>
                                    </div>
                                    <div class='col-xs-4'>
                                        <a href='javascript:;' data-app='weather-widget' data-status='active'><i
                                                class='icon-cloud-3'></i>Meteorologia</a>
                                    </div>
                                    <div class='col-xs-4'>
                                        <a href='javascript:;' data-app='calendar-widget2' data-status='active'><i
                                                class='icon-calendar'></i>Calendário</a>
                                    </div>
                                </div>
                                <div class='clearfix'></div>
                            </div>
                        </li>
                    </ul>";
    } else {
    }

    echo "<ul class='nav navbar-nav navbar-right top-navbar'>";

    ini_set('display_errors', 'On');

    $hostname = "localhost";
    $username = "bentoena_RH123";
    $password = "bentoena_RH123";
    $bd = "bentoena_RH";

    $ligacao = mysqli_connect($hostname, $username, $password, $bd);
    mysqli_set_charset($ligacao, "utf8");

    $query = "SELECT COUNT(nome_completo), cartao_cidadao, validade_cc_passaporte, carta_conducao,
validade_conducao FROM colaborador WHERE (validade_cc_passaporte < CURDATE()) OR (validade_conducao < CURDATE())
AND ( (validade_cc_passaporte <> '1970-01-01 00:00:00') OR ( (validade_conducao <> '1970-01-01 00:00:00')) )
AND ativo = 1 ORDER BY nome_completo ASC";
    $stmt = mysqli_prepare($ligacao, $query);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        mysqli_stmt_close($stmt);

        $query = "SELECT COUNT(nome_completo) FROM colaborador WHERE (validade_cc_passaporte < CURDATE())
AND (validade_cc_passaporte <> '1970-01-01 00:00:00') AND ativo = 1 ORDER BY nome_completo ASC";
        $stmt = mysqli_prepare($ligacao, $query);
        mysqli_stmt_bind_result($stmt, $numeroResultados1);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        $query = "SELECT COUNT(nome_completo) FROM colaborador WHERE (validade_conducao < CURDATE()) AND
(validade_conducao <> '1970-01-01 00:00:00') AND ativo = 1 ORDER BY nome_completo ASC";
        $stmt = mysqli_prepare($ligacao, $query);
        mysqli_stmt_bind_result($stmt, $numeroResultados2);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        $numeroResultados = $numeroResultados1 + $numeroResultados2;

        echo "<li class='dropdown iconify hide-phone'>
                        <a href='#' class='dropdown-toggle' data-toggle='dropdown'><i class='fa fa-bell'></i>
                        <span class='label label-danger absolute'>$numeroResultados</span></a>
                        <ul class='dropdown-menu dropdown-message'>
                            <li class='dropdown-header notif-header'><i class='icon-bell-2'></i> Documentos</li>";

        $query = "SELECT nome_completo, cartao_cidadao, validade_cc_passaporte, carta_conducao,
validade_conducao FROM colaborador WHERE (validade_cc_passaporte < CURDATE())
AND (validade_cc_passaporte <> '1970-01-01 00:00:00') AND ativo = 1 ORDER BY nome_completo ASC";
        $stmt = mysqli_prepare($ligacao, $query);
        mysqli_stmt_bind_result($stmt, $nomeCompleto, $numeroCartaoCidadao, $validadeCCidadao, $numeroCConducao,
            $validadeConducao);
        mysqli_stmt_execute($stmt);
        while (mysqli_stmt_fetch($stmt)) {

            $conversaoDataNascimento = new DateTime($validadeCCidadao);
            $textoDataNascimento = $conversaoDataNascimento->format('d-m-Y');

            $numeroCartaoCidadao = chunk_split($numeroCartaoCidadao, 4, ' ');

            echo "<li class='unread'>
                                <a style='cursor: auto !important;'>
                                    <p>O colaborador <strong>$nomeCompleto</strong> possui o cartão de cidadão
                                    com o número <strong>$numeroCartaoCidadao</strong> expirado.
                                        <br />Data de validade: <i>$textoDataNascimento</i>
                                    </p>
                                </a>
                            </li>";
        }
        mysqli_stmt_close($stmt);

        $query = "SELECT nome_completo, cartao_cidadao, validade_cc_passaporte, carta_conducao,
validade_conducao FROM colaborador WHERE (validade_conducao < CURDATE()) AND
(validade_conducao <> '1970-01-01 00:00:00') AND ativo = 1 ORDER BY nome_completo ASC";
        $stmt = mysqli_prepare($ligacao, $query);
        mysqli_stmt_bind_result($stmt, $nomeCompleto, $numeroCartaoCidadao, $validadeCCidadao, $numeroCConducao,
            $validadeConducao);
        mysqli_stmt_execute($stmt);
        while (mysqli_stmt_fetch($stmt)) {

            $conversaoDataNascimento = new DateTime($validadeConducao);
            $textoDataNascimento = $conversaoDataNascimento->format('d-m-Y');

            echo "<li class='unread'>
                                <a style='cursor: auto !important;'>
                                    <p>O colaborador <strong>$nomeCompleto</strong> possui a carta de condução
                                    com o número <strong>$numeroCConducao</strong> expirada.
                                        <br />Data de validade: <i>$textoDataNascimento</i>
                                    </p>
                                </a>
                            </li>";
        }
        mysqli_stmt_close($stmt);

        echo "<li class='dropdown-footer'>
                                <div class='btn-group btn-group-justified'>
                                    <div class='btn-group'>
                                        <a href='alertas.php' class='btn btn-sm btn-success'>Ver Detalhes<i class='icon-right-open-2'></i></a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>";

    } else {
        mysqli_stmt_close($stmt);
    }


    //Contratos

    $dataQuery1 = date('Y-m-d', strtotime('-1 year'));
    $dataQuery2 = date('Y-m-d', strtotime('-6 month'));
    $dataQuery3 = date('Y-m-d', strtotime('-35 days'));
    $dataQuery4 = date('Y-m-d', strtotime('-20 days'));

    $query = "SELECT contrato.data_contrato, contrato.data_final_contrato
FROM contrato
WHERE ((contrato.data_contrato <= ?) OR (contrato.data_contrato <= ?))
AND ((contrato.data_final_contrato >= ?) OR (contrato.data_final_contrato >= ?))
AND (contrato.data_contrato <> '1970-01-01 00:00:00')
AND (contrato.data_final_contrato <> '1970-01-01 00:00:00')
AND contrato.atual = 1";

    $stmt = mysqli_prepare($ligacao, $query);
    mysqli_stmt_bind_param($stmt, 'ssss', $dataQuery1, $dataQuery2, $dataQuery4, $dataQuery3);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        mysqli_stmt_close($stmt);

        //6 Meses
        $query = "SELECT COUNT(contrato.data_contrato)
FROM contrato
INNER JOIN colaborador ON contrato.ref_id_colaborador = colaborador.id_colaborador
WHERE (contrato.data_contrato >= ?) AND (contrato.data_contrato <= ?)
AND (contrato.data_final_contrato >= ?)
AND (contrato.data_contrato <> '1970-01-01 00:00:00')
AND (contrato.data_final_contrato <> '1970-01-01 00:00:00')
AND contrato.atual = 1 ORDER BY colaborador.nome_completo ASC";

        $stmt = mysqli_prepare($ligacao, $query);
        mysqli_stmt_bind_param($stmt, 'sss', $dataQuery1, $dataQuery2, $dataQuery4);
        mysqli_stmt_bind_result($stmt, $AnumeroResultados1);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        //1 Ano
        $query = "SELECT COUNT( contrato.data_contrato )
FROM contrato
INNER JOIN colaborador ON contrato.ref_id_colaborador = colaborador.id_colaborador
WHERE (contrato.data_contrato <= ?) AND (contrato.data_final_contrato >= ?)
AND (contrato.data_contrato <> '1970-01-01 00:00:00')
AND (contrato.data_final_contrato <> '1970-01-01 00:00:00')
AND contrato.atual = 1 ORDER BY colaborador.nome_completo ASC";

        $stmt = mysqli_prepare($ligacao, $query);
        mysqli_stmt_bind_param($stmt, 'ss', $dataQuery1, $dataQuery3);
        mysqli_stmt_bind_result($stmt, $AnumeroResultados2);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        $AnumeroResultados = $AnumeroResultados1 + $AnumeroResultados2;

        echo "<li class='dropdown iconify file-text'>
                        <a href='#' class='dropdown-toggle' data-toggle='dropdown'><i class='fa fa-file-text'></i>
                        <span class='label label-danger absolute'>$AnumeroResultados</span></a>
                        <ul class='dropdown-menu dropdown-message'>
                            <li class='dropdown-header notif-header'><i class='icon-bell-2'></i> Contratos</li>";

        //6 Meses
        $query = "SELECT contrato.data_final_contrato, colaborador.nome_completo
FROM contrato
INNER JOIN colaborador ON contrato.ref_id_colaborador = colaborador.id_colaborador
WHERE (contrato.data_contrato >= ?) AND (contrato.data_contrato <= ?)
AND (contrato.data_final_contrato >= ?)
AND (contrato.data_contrato <> '1970-01-01 00:00:00')
AND (contrato.data_final_contrato <> '1970-01-01 00:00:00')
AND contrato.atual = 1 ORDER BY colaborador.nome_completo ASC";

        $stmt = mysqli_prepare($ligacao, $query);
        mysqli_stmt_bind_param($stmt, 'sss', $dataQuery1, $dataQuery2, $dataQuery4);
        mysqli_stmt_bind_result($stmt, $dataFinalContrato, $nomeColaboradorFimContrato);
        mysqli_stmt_execute($stmt);
        while (mysqli_stmt_fetch($stmt)) {

            $conversaoDataNascimento = new DateTime($dataFinalContrato);
            $textoDataNascimento = $conversaoDataNascimento->format('d-m-Y');

            echo "<li class='unread'>
                                <a style='cursor: auto !important;'>
                                    <p>O contrato do colaborador <strong>$nomeColaboradorFimContrato</strong>,
                                    registado à menos de seis meses expira brevemente.
                                        <br />Data de fim de contrato: <i>$textoDataNascimento</i>
                                    </p>
                                </a>
                            </li>";
        }
        mysqli_stmt_close($stmt);

        //1 Ano

        $query = "SELECT contrato.data_final_contrato, colaborador.nome_completo
FROM contrato
INNER JOIN colaborador ON contrato.ref_id_colaborador = colaborador.id_colaborador
WHERE (contrato.data_contrato <= ?) AND (contrato.data_final_contrato >= ?)
AND (contrato.data_contrato <> '1970-01-01 00:00:00')
AND (contrato.data_final_contrato <> '1970-01-01 00:00:00')
AND contrato.atual = 1 ORDER BY colaborador.nome_completo ASC";

        $stmt = mysqli_prepare($ligacao, $query);
        mysqli_stmt_bind_param($stmt, 'ss', $dataQuery1, $dataQuery3);
        mysqli_stmt_bind_result($stmt, $dataFinalContrato, $nomeColaboradorFimContrato);
        mysqli_stmt_execute($stmt);
        while (mysqli_stmt_fetch($stmt)) {

            $conversaoDataNascimento = new DateTime($dataFinalContrato);
            $textoDataNascimento = $conversaoDataNascimento->format('d-m-Y');

            echo "<li class='unread'>
                                <a style='cursor: auto !important;'>
                                    <p>O contrato do colaborador <strong>$nomeColaboradorFimContrato</strong>,
                                    registado à pelo menos um ano expira brevemente.
                                        <br />Data de fim de contrato: <i>$textoDataNascimento</i>
                                    </p>
                                </a>
                            </li>";
        }
        mysqli_stmt_close($stmt);

        echo "<li class='dropdown-footer'>
                                <div class='btn-group btn-group-justified'>
                                    <div class='btn-group'>
                                        <a href='alertas.php' class='btn btn-sm btn-success'>Ver Detalhes<i class='icon-right-open-2'></i></a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>";


    } else {
        mysqli_stmt_close($stmt);
    }


    echo "<li class='dropdown iconify hide-phone'><a href='#' onclick='javascript:toggle_fullscreen()'><i
                                    class='icon-resize-full-2'></i></a></li>
                        <li class='dropdown topbar-profile'>
                            <a href='#' class='dropdown-toggle' data-toggle='dropdown'><span
                                    class='rounded-image topbar-profile-image'><img src='assets/img/responsavel_RH.png'></span>
                                 <strong>Raquel Ribeiro</strong> <i class='fa fa-caret-down'></i></a>
                            <ul class='dropdown-menu'>
                                <li><a class='md-trigger' data-modal='logout-modal'><i class='icon-logout-1'></i>
                                        Sair</a></li>
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
                    <a href='perfilColaborador.php' class='rounded-image profile-image'>
                        <img src='assets/img/responsavel_RH.png'></a>
                </div>
                <div class='col-xs-8' style='margin-top: 10px'>
                    <div class='profile-text'>Administradora <b>R. Ribeiro</b></div>
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
                                class='icon-users'></i><span>Colaboradores</span> <span class='pull-right'><i
                                    class='fa fa-angle-down'></i></span></a>
                        <ul>
                            <li><a ";

    if ($menuFilho == 'adicionarColaborador') {
        echo "class='active'";
    }

    echo " href='adicionarColaborador.php'><span>Adicionar Colaborador</span></a></li>
                            <li><a ";

    if ($menuFilho == 'atualColaborador') {
        echo "class='active'";
    }

    echo " href='atuaisColaboradores.php'><span>Atuais Colaboradores</span></a></li>
                            <li><a ";

    if ($menuFilho == 'antigoColaborador') {
        echo "class='active'";
    }

    echo " href='antigosColaboradores.php'><span>Antigos Colaboradores</span></a></li>


<li><a ";

    if ($menuFilho == 'registoContrato') {
        echo "class='active'";
    }

    echo " href='adicionarContrato.php'><span>Renovar Contrato</span></a></li>


   <li><a ";

    if ($menuFilho == 'consultarContratos') {
        echo "class='active'";
    }

    echo " href='registoContratos.php'><span>Consultar Contratos</span></a></li>

  <li><a ";

    if ($menuFilho == 'consultarDesvinculacao') {
        echo "class='active'";
    }

    echo " href='registoEntrevistasDesvinculacao.php'><span>Consultar E. de Desvinculação</span></a></li>


                        </ul>
                    </li>
                      <li class='has_sub'><a ";

    if ($menuPai == 'formacoes') {
        echo "class='active'";
    }

    echo " href='javascript:void(0);'><i
                                class='fa fa-graduation-cap'></i><span>Formação</span>
                                <span class='pull-right'><i
                                    class='fa fa-angle-down'></i></span></a>
                        <ul>
                            <li><a ";

    if ($menuFilho == 'adicionarFormacao') {
        echo "class='active'";
    }

    echo " href='adicionarFormacaoColaboradores.php'><span>Adicionar Formação</span></a></li>

    <li><a ";

    if ($menuFilho == 'registoFormacoes') {
        echo "class='active'";
    }

    echo " href='registoFormacoes.php'><span>Consultar Formação</span></a></li>

                        </ul>
                    </li>

  <li class='has_sub'><a ";

    if ($menuPai == 'medicina') {
        echo "class='active'";
    }

    echo " href='javascript:void(0);'><i
                                class='fa fa-stethoscope'></i><span>Medicina de Trabalho</span>
                                <span class='pull-right'><i
                                    class='fa fa-angle-down'></i></span></a>
                        <ul>
                            <li><a ";

    if ($menuFilho == 'adicionarMedicina') {
        echo "class='active'";
    }

    echo " href='adicionarMedicinaColaboradores.php'><span>Adicionar Consulta</span></a></li>

    <li><a ";

    if ($menuFilho == 'registoMedicina') {
        echo "class='active'";
    }

    echo " href='registoMedicina.php'><span>Consultar Consultas</span></a></li>

     <li><a ";

    if ($menuFilho == 'marcacaoConsultas') {
        echo "class='active'";
    }

    echo " href='marcacaoMedicina.php'><span>Marcação de Consultas</span></a></li>

  <li><a ";

    if ($menuFilho == 'registoMarcacoes') {
        echo "class='active'";
    }

    echo " href='registoMarcacoes.php'><span>Consultar Marcações</span></a></li>

 <li><a ";

    if ($menuFilho == 'calendarioMarcacoes') {
        echo "class='active'";
    }

    echo " href='calendarioMarcacoes.php'><span>Calendário Marcações</span></a></li>

                        </ul>
                    </li>

                      <li class='has_sub'><a ";

    if ($menuPai == 'justificacoes') {
        echo "class='active'";
    }

    echo " href='javascript:void(0);'><i
                                class='fa fa-file-text'></i><span>Justificações</span>
                                <span class='pull-right'><i
                                    class='fa fa-angle-down'></i></span></a>
                        <ul>
                            <li><a ";

    if ($menuFilho == 'justificarFalta') {
        echo "class='active'";
    }

    echo " href='adicionarJustificacoes.php'><span>Adicionar Justificação</span></a></li>

    <li><a ";

    if ($menuFilho == 'visualizarJustificacoes') {
        echo "class='active'";
    }

    echo " href='registoJustificacoes.php'><span>Consultar Justificações</span></a></li>

                        </ul>
                    </li>

                               <li class='has_sub'><a ";

    if ($menuPai == 'comportamentos') {
        echo "class='active'";
    }

    echo " href='javascript:void(0);'><i
                                class='fa fa-exclamation-triangle'></i><span>Comp. Não Aceitáveis</span>
                                <span class='pull-right'><i
                                    class='fa fa-angle-down'></i></span></a>
                        <ul>
                            <li><a ";

    if ($menuFilho == 'registarComportamento') {
        echo "class='active'";
    }

    echo " href='adicionarComportamentosNaoAceitaveis.php'><span>Adicionar Comportamento</span></a></li>

    <li><a ";

    if ($menuFilho == 'visualizarComportamento') {
        echo "class='active'";
    }

    echo " href='registoComportamentos.php'><span>Consultar Comportamentos</span></a></li>

                        </ul>
                    </li>

                    <li class='has_sub'><a ";

    if ($menuPai == 'mudancas') {
        echo "class='active'";
    }

    echo " href='javascript:void(0);'><i
                                class='fa fa-exchange'></i><span>Mudanças de Função</span>
                                <span class='pull-right'><i
                                    class='fa fa-angle-down'></i></span></a>
                        <ul>
                            <li><a ";

    if ($menuFilho == 'registarMudancas') {
        echo "class='active'";
    }

    echo " href='adicionarMudancas.php'><span>Adicionar Mudanças</span></a></li>

    <li><a ";

    if ($menuFilho == 'visualizarMudancas') {
        echo "class='active'";
    }

    echo " href='registoMudancas.php'><span>Consultar Mudanças</span></a></li>

                        </ul>
                    </li>



                      <li class='has_sub'><a ";

    if ($menuPai == 'acidentes') {
        echo "class='active'";
    }

    echo " href='javascript:void(0);'><i
                                class='fa fa-medkit'></i><span>Acidentes de Trabalho</span>
                                <span class='pull-right'><i
                                    class='fa fa-angle-down'></i></span></a>
                        <ul>
                            <li><a ";

    if ($menuFilho == 'adicionarAcidente') {
        echo "class='active'";
    }

    echo " href='adicionarAcidentesTrabalho.php'><span>Adicionar Acidente</span></a></li>

    <li><a ";

    if ($menuFilho == 'registoAcidentes') {
        echo "class='active'";
    }

    echo " href='registoAcidentes.php'><span>Consultar Acidentes</span></a></li>


                        </ul>
                    </li>




                     <li class='has_sub'><a ";

    if ($menuPai == 'ferias') {
        echo "class='active'";
    }

    echo " href='javascript:void(0);'><i
                                class='fa fa-plane'></i><span>Férias</span>
                                <span class='pull-right'><i
                                    class='fa fa-angle-down'></i></span></a>
                        <ul>
                            <li><a ";

    if ($menuFilho == 'adicionarFerias') {
        echo "class='active'";
    }

    echo " href='adicionarFerias.php'><span>Registar Férias</span></a></li>

    <li><a ";

    if ($menuFilho == 'registoFerias') {
        echo "class='active'";
    }

    echo " href='registoFerias.php'><span>Consultar Férias</span></a></li>

   <li><a ";

    if ($menuFilho == 'calendarioFerias') {
        echo "class='active'";
    }

    echo " href='calendarioFerias.php'><span>Calendário Férias</span></a></li>


                        </ul>
                    </li>

<li class='has_sub'><a ";

    if ($menuPai == 'presencas') {
        echo "class='active'";
    }

    echo " href='javascript:void(0);'><i
                                class='fa fa-hand-o-up'></i><span>Presenças</span>
                                <span class='pull-right'><i
                                    class='fa fa-angle-down'></i></span></a>
                        <ul>
                            <li><a ";

    if ($menuFilho == 'marcarPresencas') {
        echo "class='active'";
    }

    echo " href='marcarPresencas.php'><span>Registar Presenças</span></a></li>

    <li><a ";

    if ($menuFilho == 'registoPresenca') {
        echo "class='active'";
    }

    echo " href='registoPresencas.php'><span>Consultar Presenças</span></a></li>

                        </ul>
                    </li>

                           <li class='has_sub'><a ";

    if ($menuPai == 'exportarDados') {
        echo "class='active'";
    }

    echo " href='javascript:void(0);'><i
                                class='fa fa-table'></i><span>Exportar Dados</span>
                                <span class='pull-right'><i
                                    class='fa fa-angle-down'></i></span></a>
                        <ul>
                            <li><a ";

    if ($menuFilho == 'qualidadeSSI') {
        echo "class='active'";
    }

    echo " href='exportarDadosSSI.php'><span>SSI</span></a></li>

                     <li><a ";

    if ($menuFilho == 'qualidadeContratos') {
        echo "class='active'";
    }

    echo " href='exportarDadosContratos.php'><span>Contratos</span></a></li>


    <li><a ";

    if ($menuFilho == 'qualidadeDesvinculacao') {
        echo "class='active'";
    }

    echo " href='exportarDadosDesvinculacao.php'><span>Entrevistas de Desvinculação</span></a></li>

    <li><a ";

    if ($menuFilho == 'qualidadeFormacao') {
        echo "class='active'";
    }

    echo " href='exportarDadosFormacao.php'><span>Formação</span></a></li>

 <li><a ";

    if ($menuFilho == 'qualidadeMedicina') {
        echo "class='active'";
    }

    echo " href='exportarDadosMedicina.php'><span>Medicina de Trabalho</span></a></li>

  <li><a ";

    if ($menuFilho == 'qualidadeMarcacoes') {
        echo "class='active'";
    }

    echo " href='exportarDadosMarcacoes.php'><span>Marcação Medicina de Trabalho</span></a></li>


 <li><a ";

    if ($menuFilho == 'qualidadeJustificacoes') {
        echo "class='active'";
    }

    echo " href='exportarDadosJustificacoes.php'><span>Justificações</span></a></li>

 <li><a ";

    if ($menuFilho == 'qualidadeComportamento') {
        echo "class='active'";
    }

    echo " href='exportarDadosComportamentos.php'><span>Comportamentos Não Aceitáveis</span></a></li>

  <li><a ";

    if ($menuFilho == 'qualidadeMudancas') {
        echo "class='active'";
    }

    echo " href='exportarDadosMudancas.php'><span>Mudanças de Função</span></a></li>

   <li><a ";

    if ($menuFilho == 'qualidadeAcidentes') {
        echo "class='active'";
    }

    echo " href='exportarDadosAcidentes.php'><span>Acidentes de Trabalho</span></a></li>

 <li><a ";

    if ($menuFilho == 'qualidadeFerias') {
        echo "class='active'";
    }

    echo " href='exportarDadosFerias.php'><span>Férias</span></a></li>

  <li><a ";

    if ($menuFilho == 'qualidadePresencas') {
        echo "class='active'";
    }

    echo " href='exportarDadosPresencas.php'><span>Presenças</span></a></li>

                        </ul>
                    </li>

                    <li class='has_sub'><a ";

    if ($menuPai == 'comunicacoes') {
        echo "class='active'";
    }

    echo " href='javascript:void(0);'><i
                                class='fa fa-comments'></i><span>Comunicações</span>
                                <span class='pull-right'><i
                                    class='fa fa-angle-down'></i></span></a>
                        <ul>


 <li><a ";

    if ($menuFilho == 'comunicacaoContratos') {
        echo "class='active'";
    }

    echo " href='comunicacaoContratos.php'><span>Contratos</span></a></li>


 <li><a ";

    if ($menuFilho == 'comunicacaoDesvinculacao') {
        echo "class='active'";
    }

    echo " href='comunicacaoDesvinculacao.php'><span>Entrevistas de Desvinculação</span></a></li>


                           <li><a ";


    if ($menuFilho == 'comunicacaoFormacoes') {
        echo "class='active'";
    }

    echo " href='comunicacaoFormacoes.php'><span>Formação</span></a></li>

  <li><a ";

    if ($menuFilho == 'comunicacaoMedicina') {
        echo "class='active'";
    }

    echo " href='comunicacaoMedicina.php'><span>Medicina de Trabalho</span></a></li>

  <li><a ";

    if ($menuFilho == 'comunicacaoMarcacao') {
        echo "class='active'";
    }

    echo " href='comunicacaoMarcacao.php'><span>Marcação Medicina de Trabalho</span></a></li>

  <li><a ";

    if ($menuFilho == 'comunicacaoJustificacao') {
        echo "class='active'";
    }

    echo " href='comunicacaoJustificacao.php'><span>Justificações</span></a></li>

  <li><a ";

    if ($menuFilho == 'comunicacaoComportamento') {
        echo "class='active'";
    }

    echo " href='comunicacaoComportamentos.php'><span>Comportamentos Não Aceitáveis</span></a></li>

    <li><a ";

    if ($menuFilho == 'comunicacaoMudancas') {
        echo "class='active'";
    }

    echo " href='comunicacaoMudancas.php'><span>Mudanças de Função</span></a></li>


  <li><a ";

    if ($menuFilho == 'comunicacaoAcidentes') {
        echo "class='active'";
    }

    echo " href='comunicacaoAcidentes.php'><span>Acidentes de Trabalho</span></a></li>


  <li><a ";

    if ($menuFilho == 'comunicacaoFerias') {
        echo "class='active'";
    }

    echo " href='comunicacaoFerias.php'><span>Férias</span></a></li>

   <li><a ";

    if ($menuFilho == 'comunicacaoPresencas') {
        echo "class='active'";
    }

    echo " href='comunicacaoPresencas.php'><span>Presenças</span></a></li>

                        </ul>
                    </li>


                    <li><a ";

    if ($menuPai == 'geografia') {
        echo "class='active'";
    }

    echo " href='distribuicaoColaboradores.php'>
                    <i class='fa fa-map-marker'></i><span>Localização Geográfica</span></a>
                    </li>

                               <li class='has_sub'><a ";

    if ($menuPai == 'estatisticas') {
        echo "class='active'";
    }

    echo " href='javascript:void(0);'><i
                                class='fa fa-line-chart'></i><span>Estatísticas</span>
                                <span class='pull-right'><i
                                    class='fa fa-angle-down'></i></span></a>
                        <ul>


 <li><a ";

    if ($menuFilho == 'estatisticasColaboradores') {
        echo "class='active'";
    }

    echo " href='estatisticasContratos.php'><span>Colaboradores</span></a></li>


 <li><a ";

    if ($menuFilho == 'estatisticasDesvinculacao') {
        echo "class='active'";
    }

    echo " href='estatisticasDesvinculacao.php'><span>Entrevistas de Desvinculação</span></a></li>


                           <li><a ";


    if ($menuFilho == 'estatisticasFormacao') {
        echo "class='active'";
    }

    echo " href='estatisticasFormacao.php'><span>Formação</span></a></li>

  <li><a ";

    if ($menuFilho == 'estatisticasMedicina') {
        echo "class='active'";
    }

    echo " href='estatisticasMedicina.php'><span>Medicina de Trabalho</span></a></li>


  <li><a ";

    if ($menuFilho == 'estatisticasJustificacao') {
        echo "class='active'";
    }

    echo " href='estatisticasJustificacao.php'><span>Justificações</span></a></li>

  <li><a ";

    if ($menuFilho == 'estatisticasComportamento') {
        echo "class='active'";
    }

    echo " href='estatisticasComportamento.php'><span>Comportamentos Não Aceitáveis</span></a></li>

    <li><a ";

    if ($menuFilho == 'estatisticasMudancas') {
        echo "class='active'";
    }

    echo " href='estatisticasMudancas.php'><span>Mudanças de Função</span></a></li>


  <li><a ";

    if ($menuFilho == 'estatisticasAcidentes') {
        echo "class='active'";
    }

    echo " href='estatisticasAcidentes.php'><span>Acidentes de Trabalho</span></a></li>


  <li><a ";

    if ($menuFilho == 'estatisticasFerias') {
        echo "class='active'";
    }

    echo " href='estatisticasFerias.php'><span>Férias</span></a></li>

   <li><a ";

    if ($menuFilho == 'estatisticasPresencas') {
        echo "class='active'";
    }

    echo " href='estatisticasPresencas.php'><span>Presenças</span></a></li>

                        </ul>
                    </li>


                 <li class='has_sub'><a ";

    if ($menuPai == 'descricao') {
        echo "class='active'";
    }

    echo " href='javascript:void(0);'><i
                                class='fa fa-info-circle'></i><span>Descrição de Funções</span>
                                <span class='pull-right'><i
                                    class='fa fa-angle-down'></i></span></a>
                        <ul>
                            <li><a ";

    if ($menuFilho == 'registarDescricao') {
        echo "class='active'";
    }

    echo " href='registarDescricao.php'><span>Adicionar Descrição</span></a></li>

    <li><a ";

    if ($menuFilho == 'registoDescricoes') {
        echo "class='active'";
    }

    echo " href='registoDescricoes.php'><span>Consultar Descrições</span></a></li>

   <li><a ";

    if ($menuFilho == 'imprimirDescricoes') {
        echo "class='active'";
    }

    echo " href='imprimirDescricoes.php'><span>Imprimir Descrições</span></a></li>

                        </ul>
                    </li>

                            <li><a ";

    if ($menuPai == 'alertas') {
        echo "class='active'";
    }

    echo " href='alertas.php'>
                    <i class='fa fa-bell'></i><span>Alertas</span></a>
                    </li>

                       <li><a ";

    if ($menuPai == 'configuracoes') {
        echo "class='active'";
    }

    echo " href='configuracoes.php'>
                    <i class='fa fa-cogs'></i><span>Configurações</span></a>
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
    echo "<div class='left-footer'>
            <div class='progress progress-xs'>
                <div class='progress-bar bg-green-1' role='progressbar' aria-valuenow='100%' aria-valuemin='0'
                     aria-valuemax='100' style='width: 100%'>
                    <span class='progress-precentage'>100%</span>
                </div>
   <a data-toggle='tooltip' title='Desempenho' class='btn btn-default'><i class='fa fa-check'></i></a>
            </div>
        </div>
    </div>";
}

?>