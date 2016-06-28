<?php

session_start();

if (!isset($_SESSION['ativoAdmin'])) {
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    header("location:entrar.php?url=$actual_link");
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <title>BN, Lda</title>
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no'/>
    <meta name='apple-mobile-web-app-capable' content='yes'/>

    <link rel='shortcut icon' href='assets/img/favicon.png'>
    <link rel='apple-touch-icon' href='assets/img/favicon.png'/>
    <link rel='apple-touch-icon' sizes='57x57' href='assets/img/apple-touch-icon-57x57.png'/>
    <link rel='apple-touch-icon' sizes='72x72' href='assets/img/apple-touch-icon-72x72.png'/>
    <link rel='apple-touch-icon' sizes='76x76' href='assets/img/apple-touch-icon-76x76.png'/>
    <link rel='apple-touch-icon' sizes='114x114' href='assets/img/apple-touch-icon-114x114.png'/>
    <link rel='apple-touch-icon' sizes='120x120' href='assets/img/apple-touch-icon-114x114.png'/>
    <link rel='apple-touch-icon' sizes='144x144' href='assets/img/apple-touch-icon-144x144.png'/>
    <link rel='apple-touch-icon' sizes='152x152' href='assets/img/apple-touch-icon-152x152.png'/>

    <!-- Base Css Files -->
    <link href="assets/libs/jqueryui/ui-lightness/jquery-ui-1.10.4.custom.min.css" rel="stylesheet"/>
    <link href="assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="assets/libs/font-awesome/css/font-awesome.min.css" rel="stylesheet"/>
    <link href="assets/libs/fontello/css/fontello.css" rel="stylesheet"/>
    <link href="assets/libs/animate-css/animate.min.css" rel="stylesheet"/>
    <link href="assets/libs/nifty-modal/css/component.css" rel="stylesheet"/>
    <link href="assets/libs/magnific-popup/magnific-popup.css" rel="stylesheet"/>
    <link href="assets/libs/ios7-switch/ios7-switch.css" rel="stylesheet"/>
    <link href="assets/libs/pace/pace.css" rel="stylesheet"/>
    <link href="assets/libs/sortable/sortable-theme-bootstrap.css" rel="stylesheet"/>
    <link href="assets/libs/bootstrap-datepicker/css/datepicker.css" rel="stylesheet"/>
    <link href="assets/libs/jquery-icheck/skins/all.css" rel="stylesheet"/>
    <!-- Code Highlighter for Demo -->
    <link href="assets/libs/prettify/github.css" rel="stylesheet"/>

    <!-- Extra CSS Libraries Start -->
    <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
    <!-- Extra CSS Libraries End -->
    <link href="assets/css/style-responsive.css" rel="stylesheet"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

</head>
<body class="fixed-left">
<!-- Modal Start -->

<div class='md-modal md-just-me' id='logout-modal'>
    <div class='md-content'>
        <h3>Confirmação da <strong>Saída</strong></h3>

        <div>
            <p class='text-center'>Tem a certeza que pretende abandonar a Plataforma de Gestão dos Recursos Humanos da
                Bento & Nascimento?</p>

            <p class='text-center'>
                <button class='btn btn-danger md-close'>Não</button>
                <a href='php/verificacoes/sair.php' class='btn btn-success md-close'>Sim, tenho a certeza</a>
            </p>
        </div>
    </div>
</div>
<!-- Modal End -->

<!-- Begin page -->
<div id="wrapper">

    <?php

    require_once('php/includes/menus.php');
    Menus('colaboradores', 'adicionarColaborador');

    ?>

    <!-- Start right content -->
    <div class="content-page">
        <!-- ============================================================== -->
        <!-- Start Content here -->
        <!-- ============================================================== -->
        <div class="content">
            <!-- Page Heading Start -->
            <div class="page-heading">
                <h1><i class='fa fa-user-plus'></i> Adicionar Colaborador</h1>

                <h3>Preencha os dados requisitados</h3></div>
            <!-- Page Heading End-->
            <div class="row">
                <div class="col-md-12 portlets">

                    <?php

                    if (isset($_GET['sucesso']) AND ($_GET['sucesso'] == 1)) {

                        echo '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
               O seu colaborador foi <b>adicionado</b> com sucesso.<br>
               <a class="alert-link">Votos de uma excelente experiência!</a></div>';
                    }

                    if (isset($_GET['sucesso']) AND ($_GET['sucesso'] == 2)) {

                        echo '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
               Ocorreu um erro ao <b>adicionar</b> o seu colaborador.<br>
               <a class="alert-link">Tente novamente!</a></div>';
                    }
                    ?>

                    <!-- Your awesome content goes here -->
                    <div class="widget animated fadeInDown">
                        <form id="myWizard" action="php/verificacoes/verificaAdicionarColaborador.php" method="post">

                            <section class="step" data-step-title="Identificação">
                                <div class="row">

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="inputEmail">Nome</label>
                                            <input name="nomeColaborador" type="text" placeholder="Nome"
                                                   autocomplete="on" required="required" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="inputPassword">Morada</label>
                                            <input name="moradaColaborador" type="text"
                                                   autocomplete="on" placeholder="Morada"
                                                   class="form-control">
                                        </div>
                                    </div>


                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="inputEmail">Localidade</label>

                                            <input name="localidadeColaborador" type="text"
                                                   autocomplete="on" placeholder="Localidade"
                                                   class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="inputPassword">Código Postal</label>
                                            <input type="text" id="cod" placeholder="Código Postal"
                                                   autocomplete="on" name="codigoPostalColaborador"
                                                   pattern="\d{4}([\-]\d{3})?" data-mask="9999-999"
                                                   class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="inputEmail">Telefone</label>

                                            <input type="tel" placeholder="Telefone" class="form-control"
                                                   autocomplete="on" name="telefoneColaborador" maxlength="9">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="inputPassword">Telemóvel</label>
                                            <input type="tel" id="inputPassword" placeholder="Telemóvel"
                                                   autocomplete="on" name="telemovelColaborador" maxlength="9"
                                                   class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="inputEmail">Email</label>
                                            <input type="email" id="inputEmail" placeholder="Email" class="form-control"
                                                   autocomplete="on" name="emailColaborador">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="inputEmail">Data de Nascimento</label>
                                            <input type="text" class="form-control datepicker-input"
                                                   name="dataNascimentoColaborador"
                                                   data-mask="99-99-9999" placeholder="Data de Nascimento">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="inputEmail">Naturalidade</label>
                                            <input type="text" id="inputEmail" placeholder="Naturalidade"
                                                   class="form-control"
                                                   autocomplete="on" name="naturalidadeColaborador">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="inputEmail">Nacionalidade</label>
                                            <input type="text" id="inputEmail" placeholder="Nacionalidade"
                                                   class="form-control"
                                                   autocomplete="on" name="nacionalidadeColaborador">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="inputEmail">Número - C. Cidadão/Passaporte</label>
                                            <input type="number" id="inputEmail" placeholder="CC ou Passaporte"
                                                   class="form-control"
                                                   autocomplete="on" name="CCPassaporteColaborador">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="inputEmail">Data de Emissão - CC/Passaporte</label>
                                            <input type="text" class="form-control datepicker-input"
                                                   name="dataEmissaoCCColaborador"
                                                   data-mask="99-99-9999" placeholder="Data de Emissão">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="inputEmail">Entidade Emissora - CC/Passaporte</label>
                                            <input type="text" id="inputEmail" placeholder="Entidade Emissora"
                                                   autocomplete="on" class="form-control"
                                                   name="entidaEmissoraCCColaborador">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="inputEmail">Data de Validade - CC/Passaporte</label>
                                            <input type="text" class="form-control datepicker-input"
                                                   name="dataValidadeCCColaborador"
                                                   data-mask="99-99-9999" placeholder="Data de Validade">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="inputEmail">Número - Contribuinte</label>
                                            <input type="number" id="inputEmail" placeholder="Número de Contribuinte"
                                                   autocomplete="on" class="form-control"
                                                   name="contribuinteColaborador">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="inputEmail">Número - Segurança Social</label>
                                            <input type="number" id="inputEmail"
                                                   autocomplete="on" placeholder="Número de Segurança Social"
                                                   class="form-control"
                                                   name="segSocialColaborador">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="inputEmail">Número - Carta de Condução</label>
                                            <input type="text" id="inputEmail"
                                                   autocomplete="on" placeholder="Número de Carta de Condução"
                                                   class="form-control"
                                                   name="cartaConducaoColaborador">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="inputEmail">Data de Validade - C. de Condução</label>
                                            <input type="text" class="form-control datepicker-input"
                                                   name="dataValidadeCConducaoColaborador"
                                                   data-mask="99-99-9999" placeholder="Data de Validade">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="inputEmail">Categorias - C. de Condução</label>
                                            <input type="text" id="inputEmail" placeholder="Categorias"
                                                   autocomplete="on" class="form-control"
                                                   name="categoriasCConducaoColaborador">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="">Escolaridade</label>
                                            <select class="form-control" name="escolaridadeColaborador">
                                                <option selected disabled>Escolaridade</option>
                                                <optgroup label="Ensino Básico">
                                                    <option value="Ensino Básico - 1º Ciclo">1º Ciclo</option>
                                                    <option value="Ensino Básico - 2º Ciclo">2º Ciclo</option>
                                                    <option value="Ensino Básico - 3º Ciclo">3º Ciclo</option>
                                                </optgroup>
                                                <option value="Ensino Secundário"><b>Ensino Secundário</b></option>
                                                <option value="Ensino Superior"><b>Ensino Superior</b></option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <label for="">Situação Militar</label>
                                            <select class="form-control" name="situacaoMilitarColaborador">
                                                <option selected disabled>Situação Militar</option>
                                                    <option value="Conforme">Conforme</option>
                                                    <option value="Não Conforme">Não Conforme</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <section class="step" data-step-title="IRS e Segurança Social">
                                <div class="row">

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="inputEmail">Estado Civil</label><br>
                                            <label>
                                                <input type="radio" id="optionsRadios1"
                                                       value="Solteiro" name="estadoCivilColaborador"
                                                       > Solteiro
                                            </label>
                                            <label>
                                                <input type="radio" name="estadoCivilColaborador"
                                                       id="optionsRadios2" value="Casado"> Casado
                                            </label>
                                            <label>
                                                <input type="radio" name="estadoCivilColaborador"
                                                       id="optionsRadios2" value="Separado"> Separado
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="inputEmail">Titular c/ Deficiência</label><br>
                                            <label>
                                                <input type="radio" id="optionsRadios1"
                                                       value="Sim" name="deficienciaColaborador"
                                                       > Sim
                                            </label>
                                            <label>
                                                <input type="radio" name="deficienciaColaborador"
                                                       id="optionsRadios2" value="Não"> Não
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="inputEmail">Nome do Cônjuge/Pessoa Análoga</label>
                                            <input type="text" id="inputEmail"
                                                   autocomplete="on" placeholder="Nome do Cônjuge ou Pessoa Análoga"
                                                   class="form-control" name="conjugeColaborador">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="inputEmail">Número - Contribuinte</label>
                                            <input type="number" id="inputEmail" placeholder="Número de Contribuinte"
                                                   autocomplete="on" class="form-control"
                                                   name="ContribuinteConjugeColaborador">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="inputEmail">Número - Titulares de Rendimento</label><br>
                                            <label>
                                                <input type="radio" id="optionsRadios1"
                                                       value="1 Titular" name="titularesRendimento"> 1 Titular
                                            </label>
                                            <label>
                                                <input type="radio" name="titularesRendimento"
                                                       id="optionsRadios1" value="1 Titular - Aufere 95% ou Mais"> 1 Titular - Aufere 95% ou Mais
                                            </label>
                                            <label>
                                                <input type="radio" name="titularesRendimento"
                                                       id="optionsRadios1" value="2 Titulares"> 2 Titulares
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="inputEmail">Nº - Familiares a Cargo</label>
                                            <input type="number" id="inputEmail" placeholder="Familiares Cargo"
                                                   autocomplete="on" class="form-control"
                                                   name="familiaresCargoColaborador">
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="inputEmail">Nº - Filhos</label>
                                            <input type="number" id="inputEmail" placeholder="Número Filhos"
                                                   autocomplete="on" class="form-control" name="filhosColaborador">
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="inputEmail">Idades - Filhos</label>
                                            <input type="text" id="inputEmail" placeholder="Idades"
                                                   autocomplete="on" class="form-control"
                                                   name="idadesFilhosColaborador">
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="inputEmail">Filho(s) c/ deficiência</label><br>
                                            <label>
                                                <input type="radio" id="optionsRadios1"
                                                       value="Sim" name="deficienciaFilhosColaborador"
                                                       > Sim
                                            </label>
                                            <label>
                                                <input type="radio" name="deficienciaFilhosColaborador"
                                                       id="optionsRadios2" value="Não"> Não
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="inputEmail">Regime de Seg. Social</label>
                                            <input type="number" id="inputEmail" placeholder="Regime"
                                                   autocomplete="on" class="form-control"
                                                   name="regimeSegSocialColaborador">
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="inputEmail">% Funcionário</label>
                                            <input type="number" id="inputEmail" placeholder="Percentagem"
                                                   autocomplete="on" class="form-control"
                                                   name="percentagemFuncionarioColaborador">
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="inputEmail">% Entidade Patronal</label>
                                            <input type="number" id="inputEmail" placeholder="Percentagem"
                                                   autocomplete="on" class="form-control"
                                                   name="percentagemEntPatronalColaborador">
                                        </div>
                                    </div>

                                </div>
                            </section>

                            <section class="step" data-step-title="Condições de Admissão">
                                <div class="row">

                                    <div class="col-sm-3">
                                            <div class="form-group">
                                            <label for="">Função</label>
                                            <select id="pessoasDecisao" class="form-control" name="funcaoColaborador" onchange="apresentacaInputTexto();">
                                            <option selected disabled>Função</option>
                                            <option value="Ajudante"><b>Ajudante</b></option>
                                            <option value="Distribuição"><b>Distribuição</b></option>
                                            <option value="Escritório"><b>Escritório</b></option>
                                            <option value="Técnico de Vendas"><b>Técnico de Vendas</b></option>
                                            <option value="Outro"><b>Outro</b></option>
                                            </select>
                                            </div>
                                            </div>

                                            <div class='col-sm-3' id='outroPessoasDecisao' style='display: none'>
                                            <div class="form-group">
                                            <label for="">Qual?</label>
                                            <input name='' type='text' class='form-control' placeholder="Outra Função"
                                                id='idPessoasDecisao'>
                                                </div>
                                                </div>

                                                <script>
                                                function apresentacaInputTexto(){

                                                    if(document.getElementById('pessoasDecisao').value == 'Outro'){

                                                        document.getElementById('outroPessoasDecisao').style.display='block';
                                                        $('#pessoasDecisao').attr('name', '');
                                                        $('#idPessoasDecisao').attr('name', 'funcaoColaborador');

                                                    }else{

                                                document.getElementById('outroPessoasDecisao').style.display='none';
                                                $('#pessoasDecisao').attr('name', 'funcaoColaborador');
                                                $('#idPessoasDecisao').attr('name', '');

                                            }

                                        }
                                    </script>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="inputEmail">Categoria</label>
                                            <input type="text" id="inputEmail" placeholder="Categoria"
                                                   autocomplete="on" class="form-control" name="categoriaColaborador">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="">Área do Posto de Trabalho</label>
                                            <select class="form-control" name="postoTrabalhoColaborador">
                                                <option selected disabled>Posto de Trabalho</option>
                                                <option value="Escritório">Escritório</option>
                                                <option value="DAL">DAL</option>
                                                <option value="Força de Vendas Aveiro">Força de Vendas Aveiro</option>
                                                <option value="Força de Vendas Ovar">Força de Vendas Ovar</option>
                                                <option value="Força de Vendas Viseu">Força de Vendas Viseu</option>
                                                <option value="SDD">SDD</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="">Situação Contratual</label>
                                            <select class="form-control" name="situacaoContratualColaborador">
                                                <option selected disabled>Situação Contratual</option>
                                                <option value="Quadro">Quadro</option>
                                                <option value="Termo">Termo</option>
                                                <option value="Sem Termo">Sem Termo</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="inputEmail">Data de Admissão</label>
                                            <input type="text" class="form-control datepicker-input"
                                                   id="inputEmail"
                                                   name="dataAdmissao"
                                                   data-mask="99-99-9999" placeholder="Data Admissão">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="inputEmail">Período Experimental (dias)</label>
                                            <input type="number" id="inputEmail" placeholder="Período Experimental"
                                                   autocomplete="on" class="form-control"
                                                   name="periodoExperimentalColaborador">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="inputEmail">Data Final do Per. Experimental</label>
                                            <input type="text" class="form-control datepicker-input"
                                                   id="inputEmail"
                                                   name="dataFinalPeriodoExperimentalColaborador"
                                                   data-mask="99-99-9999" placeholder="Data Final do Perído Experimental">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="inputEmail">Nº de Horas Semanais</label>
                                            <input type="number" id="inputEmail" placeholder="Horas Semanais"
                                                   autocomplete="on" class="form-control"
                                                   name="horasSemanaisColaborador">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="inputEmail">Nº de Horas Diárias</label>
                                            <input type="number" id="inputEmail" placeholder="Horas Diárias"
                                                   autocomplete="on" class="form-control"
                                                   name="horasDiariasColaborador">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="inputEmail">Descanso Complementar - Sábado</label><br>
                                            <label>
                                                <input type="radio" id="optionsRadios1"
                                                       value="Sim" name="descansoComplementarColaborador"
                                                       > Sim
                                            </label>
                                            <label>
                                                <input type="radio" name="descansoComplementarColaborador"
                                                       id="optionsRadios2" value="Não"> Não
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="inputEmail">Sistema Rotativo</label><br>
                                            <label>
                                                <input type="radio" id="optionsRadios1"
                                                       value="Sim" name="sistemaRotativoColaborador"
                                                       > Sim
                                            </label>
                                            <label>
                                                <input type="radio" name="sistemaRotativoColaborador"
                                                       id="optionsRadios2" value="Não"> Não
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-sm-12" style="font-size: 0 !important;">
                                        &nbsp;
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="inputEmail">NIB</label>
                                            <input type="number" id="inputEmail" placeholder="NIB"
                                                   autocomplete="on" class="form-control" name="NIBColaborador">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="inputEmail">Instituição Bancária</label>
                                            <input type="text" id="inputEmail" placeholder="Instituição Bancária"
                                                   autocomplete="on" class="form-control"
                                                   name="isntBancariaColaborador">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="inputEmail">Agência</label>
                                            <input type="text" id="inputEmail" placeholder="Agência"
                                                   autocomplete="on" class="form-control" name="agenciaColaborador">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="inputEmail">Vencimento Base</label>
                                            <input type="text" id="inputEmail" placeholder="Vencimento Base" data-mask="999.99€"
                                                   autocomplete="on" class="form-control" name="vencBaseColaborador">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="inputEmail">Data Final do Contrato de Trabalho</label>
                                            <input type="text" class="form-control datepicker-input"
                                                   id="inputEmail"
                                                   name="dataFinalContratoColaborador"
                                                   data-mask="99-99-9999" placeholder="Data Final do Contrato">
                                        </div>
                                    </div>

                                </div>
                            </section>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Footer Start -->
            <footer>
                Bento & Nascimento &copy; 2015
                <div class='footer-links pull-right'>
                    <a>Plataforma de Gestão dos Recursos Humanos</a>
                </div>
            </footer>
            <!-- Footer End -->
        </div>
        <!-- ============================================================== -->
        <!-- End content here -->
        <!-- ============================================================== -->

    </div>
    <!-- End right content -->

</div>
<!-- End of page -->
<!-- the overlay modal element -->
<div class="md-overlay"></div>
<!-- End of eoverlay modal -->
<script>
    var resizefunc = [];
</script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="assets/libs/jquery/jquery-1.11.1.min.js"></script>
<script src="assets/libs/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/libs/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
<script src="assets/libs/jquery-ui-touch/jquery.ui.touch-punch.min.js"></script>
<script src="assets/libs/jquery-detectmobile/detect.js"></script>
<script src="assets/libs/jquery-animate-numbers/jquery.animateNumbers.js"></script>
<script src="assets/libs/ios7-switch/ios7.switch.js"></script>
<script src="assets/libs/fastclick/fastclick.js"></script>
<script src="assets/libs/jquery-blockui/jquery.blockUI.js"></script>
<script src="assets/libs/bootstrap-bootbox/bootbox.min.js"></script>
<script src="assets/libs/jquery-slimscroll/jquery.slimscroll.js"></script>
<script src="assets/libs/jquery-sparkline/jquery-sparkline.js"></script>
<script src="assets/libs/nifty-modal/js/classie.js"></script>
<script src="assets/libs/nifty-modal/js/modalEffects.js"></script>
<script src="assets/libs/sortable/sortable.min.js"></script>
<script src="assets/libs/bootstrap-fileinput/bootstrap.file-input.js"></script>
<script src="assets/libs/bootstrap-select/bootstrap-select.min.js"></script>
<script src="assets/libs/bootstrap-select2/select2.min.js"></script>
<script src="assets/libs/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="assets/libs/pace/pace.min.js"></script>
<script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="assets/libs/jquery-icheck/icheck.min.js"></script>

<!-- Demo Specific JS Libraries -->
<script src="assets/libs/prettify/prettify.js"></script>

<script src="assets/js/init.js"></script>
<!-- Page Specific JS Libraries -->
<script src="assets/libs/jquery-wizard/jquery.easyWizard.js"></script>
<script src="assets/js/pages/form-wizard.js"></script>
<script src='assets/js/apps/calculator.js'></script>
<script src='assets/libs/bootstrap-inputmask/inputmask.js'></script>

</body>
</html>