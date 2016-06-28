<?php

session_start();

if (!isset($_SESSION['ativoAdmin'])) {

    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    header("location:entrar.php?url=$actual_link");

} else {

    if (isset($_GET['colaborador'])) {

        $colaborador = $_GET['colaborador'];

        require_once('php/connection/dbconnection.php');

        echo "<!DOCTYPE html>
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
    <link href='assets/libs/jqueryui/ui-lightness/jquery-ui-1.10.4.custom.min.css' rel='stylesheet'/>
    <link href='assets/libs/bootstrap/css/bootstrap.min.css' rel='stylesheet'/>
    <link href='assets/libs/font-awesome/css/font-awesome.min.css' rel='stylesheet'/>
    <link href='assets/libs/fontello/css/fontello.css' rel='stylesheet'/>
    <link href='assets/libs/animate-css/animate.min.css' rel='stylesheet'/>
    <link href='assets/libs/nifty-modal/css/component.css' rel='stylesheet'/>
    <link href='assets/libs/magnific-popup/magnific-popup.css' rel='stylesheet'/>
    <link href='assets/libs/ios7-switch/ios7-switch.css' rel='stylesheet'/>
    <link href='assets/libs/pace/pace.css' rel='stylesheet'/>
    <link href='assets/libs/sortable/sortable-theme-bootstrap.css' rel='stylesheet'/>
    <link href='assets/libs/bootstrap-datepicker/css/datepicker.css' rel='stylesheet'/>
    <link href='assets/libs/jquery-icheck/skins/all.css' rel='stylesheet'/>
    <!-- Code Highlighter for Demo -->
    <link href='assets/libs/prettify/github.css' rel='stylesheet'/>

    <!-- Extra CSS Libraries Start -->
    <link href='assets/css/style.css' rel='stylesheet' type='text/css'/>
    <!-- Extra CSS Libraries End -->
    <link href='assets/css/style-responsive.css' rel='stylesheet'/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js'></script>
    <script src='https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js'></script>
    <![endif]-->

</head>
<body class='fixed-left'>

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
<div id='wrapper'>";

        require_once('php/includes/menus.php');
        Menus('colaboradores', '');

        $query = "SELECT id_colaborador, tipo_admissao, nome_completo, morada, localidade,
codigo_postal, telefone, telemovel, email, nascimento, naturalidade, nacionalidade, cartao_cidadao,
emissao_cartao_cidadao, entidade_emissora, contribuinte_passaporte, seg_social, carta_conducao,
validade_conducao, categoria_conducao, situacao_militar, estado_civil, deficiencia_colaborador,
conjuge_colaborador, contribuinte_conjuge, titulares_rendimento, familiares_cargo, numeros_filhos,
idades_filhos, deficiencia_filhos, reg_seg_social, percentagem_funcionario, percentagem_patronal,
funcao, categoria, situacao_contratual, posto_trabalho, periodo_experimental, data_final_per_experimental,
horas_semanais, horas_diarias, descanso_complementar, sistema_rotativo, NIB, instituicao_bancaria,
agencia, vencimento_base, data_admissao, ativo, escolaridade, validade_cc_passaporte, data_final_contrato FROM
colaborador WHERE id_colaborador = ?";

        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, 'i', $colaborador);
        mysqli_stmt_bind_result($stmt, $idColaborador, $tipoAdmissaoColaborador,
            $nomeColaborador, $moradaColaborador, $localidadeColaborador,
            $codigoPostalColaborador, $telefoneColaborador, $telemovelColaborador,
            $emailColaborador, $novaDataNascimentoColaborador, $naturalidadeColaborador,
            $nacionalidadeColaborador, $CCPassaporteColaborador, $novaDataEmissaoCCColaborador,
            $entidaEmissoraCCColaborador, $contribuinteColaborador, $segSocialColaborador,
            $cartaConducaoColaborador, $novaDataValidadeCConducaoColaborador,
            $categoriasCConducaoColaborador, $situacaoMilitarColaborador,
            $estadoCivilColaborador, $deficienciaColaborador, $conjugeColaborador,
            $contribuinteConjugeColaborador, $titularesRendimento,
            $familiaresCargoColaborador, $filhosColaborador, $idadesFilhosColaborador,
            $deficienciaFilhosColaborador, $regimeSegSocialColaborador,
            $percentagemFuncionarioColaborador, $percentagemEntPatronalColaborador,
            $funcaoColaborador, $categoriaColaborador, $situacaoContratualColaborador,
            $postoTrabalhoColaborador, $periodoExperimentalColaborador,
            $novaDataFinalPeriodoExperimentalColaborador, $horasSemanaisColaborador,
            $horasDiariasColaborador, $descansoComplementarColaborador,
            $sistemaRotativoColaborador, $NIBColaborador, $isntBancariaColaborador,
            $agenciaColaborador, $vencBaseColaborador, $novaDataAdmissao, $ativo, $escolaridade,
            $novaDataValidadeCCPassaporte, $novaDataFinalContratoColaborador);

        mysqli_stmt_execute($stmt);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        echo "<!-- Start right content -->
    <div class='content-page'>
        <!-- ============================================================== -->
        <!-- Start Content here -->
        <!-- ============================================================== -->
        <div class='content'>
            <!-- Page Heading Start -->
            <div class='page-heading'>
                <h1><i class='fa fa-pencil-square-o'></i> Editar Perfil&nbsp;&nbsp;<small>$nomeColaborador</small></h1>

                <h3>Edite os dados do seu colaborador</h3></div>
            <!-- Page Heading End-->
            <div class='row'>
                <div class='col-md-12 portlets'>";

        if (isset($_GET['sucesso']) AND ($_GET['sucesso'] == 1)) {

            echo "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
               Os dados do seu colaborador foram <b>editados</b> com sucesso.<br>
               <a class='alert-link'>Votos de uma excelente experiência!</a></div>";
        }

        if (isset($_GET['sucesso']) AND ($_GET['sucesso'] == 2)) {

            echo "<div class='alert alert-danger alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
               Ocorreu um erro ao <b>editar</b> os dados do seu colaborador.<br>
               <a class='alert-link'>Tente novamente!</a></div>";
        }

        echo "<!-- Your awesome content goes here -->
                    <div class='widget animated fadeInDown'>
                        <form id='myWizard' action='php/verificacoes/verificaEditarColaborador.php?colaborador=$colaborador' method='post'>

                            <section class='step' data-step-title='Identificação'>
                                <div class='row'>

                                    <div class='col-sm-6'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>Nome</label>
                                            <input name='nomeColaborador' type='text' placeholder='Nome' ";
        if (!empty($nomeColaborador)) {
            echo "value='$nomeColaborador'";
        }

        echo " autocomplete='on' required='required' class='form-control'>
                                        </div>
                                    </div>

                                    <div class='col-sm-6'>
                                        <div class='form-group'>
                                            <label for='inputPassword'>Morada</label>
                                            <input name='moradaColaborador' type='text' ";
        if (!empty($moradaColaborador)) {
            echo "value='$moradaColaborador'";
        }
        echo " autocomplete='on' placeholder='Morada'
                                                   class='form-control'>
                                        </div>
                                    </div>


                                    <div class='col-sm-3'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>Localidade</label>

                                            <input name='localidadeColaborador' type='text' ";

        if (!empty($localidadeColaborador)) {
            echo "value='$localidadeColaborador'";
        }
        echo " autocomplete='on' placeholder='Localidade'
                                                   class='form-control'>
                                        </div>
                                    </div>

                                    <div class='col-sm-2'>
                                        <div class='form-group'>
                                            <label for='inputPassword'>Código Postal</label>
                                            <input type='text' id='cod' placeholder='Código Postal'
                                                   autocomplete='on' name='codigoPostalColaborador'
                                                   pattern='\d{4}([\-]\d{3})?'
                                                   class='form-control' ";

        if (!empty($codigoPostalColaborador)) {
            echo "value='$codigoPostalColaborador'";
        }

        echo " >
                                        </div>
                                    </div>

                                    <div class='col-sm-2'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>Telefone</label>

                                            <input type='tel' placeholder='Telefone' class='form-control' ";

        if (!empty($telefoneColaborador)) {
            echo "value='$telefoneColaborador'";
        }

        echo " autocomplete='on' name='telefoneColaborador' maxlength='9'>
                                        </div>
                                    </div>
                                    <div class='col-sm-2'>
                                        <div class='form-group'>
                                            <label for='inputPassword'>Telemóvel</label>
                                            <input type='tel' id='inputPassword' placeholder='Telemóvel'
                                                   autocomplete='on' name='telemovelColaborador' maxlength='9'
                                                   class='form-control' ";

        if (!empty($telemovelColaborador)) {
            echo "value='$telemovelColaborador'";
        }

        echo " >
                                        </div>
                                    </div>

                                    <div class='col-sm-3'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>Email</label>
                                            <input type='email' id='inputEmail' placeholder='Email' class='form-control'
                                                   autocomplete='on' name='emailColaborador' ";

        if (!empty($emailColaborador)) {
            echo "value='$emailColaborador'";
        }

        echo " >
                                        </div>
                                    </div>

                                    <div class='col-sm-3'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>Data de Nascimento</label>
                                            <input type='text' class='form-control datepicker-input'
                                                   name='dataNascimentoColaborador'
                                                   data-mask='99-99-9999' placeholder='Data de Nascimento' ";

        if (!empty($novaDataNascimentoColaborador)) {
            if (($novaDataNascimentoColaborador != "1970-01-01 00:00:00")) {
                $conversaoDataNascimento = new DateTime($novaDataNascimentoColaborador);
                $textoDataNascimento = $conversaoDataNascimento->format('d-m-Y');

                echo "value='$textoDataNascimento'";
            }
        }

        echo " >
                                        </div>
                                    </div>

                                    <div class='col-sm-3'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>Naturalidade</label>
                                            <input type='text' id='inputEmail' placeholder='Naturalidade'
                                                   class='form-control' ";
        if (!empty($naturalidadeColaborador)) {
            echo "value='$naturalidadeColaborador'";
        }

        echo " autocomplete='on' name='naturalidadeColaborador'>
                                        </div>
                                    </div>

                                    <div class='col-sm-3'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>Nacionalidade</label>
                                            <input type='text' id='inputEmail' placeholder='Nacionalidade'
                                                   class='form-control' ";

        if (!empty($nacionalidadeColaborador)) {
            echo "value='$nacionalidadeColaborador'";
        }

        echo " autocomplete='on' name='nacionalidadeColaborador'>
                                        </div>
                                    </div>

                                    <div class='col-sm-3'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>Número - C. Cidadão/Passaporte</label>
                                            <input type='number' id='inputEmail' placeholder='CC ou Passaporte'
                                                   class='form-control' ";

        if (!empty($CCPassaporteColaborador)) {
            echo "value='$CCPassaporteColaborador'";
        }
        echo " autocomplete='on' name='CCPassaporteColaborador'>
                                        </div>
                                    </div>

                                    <div class='col-sm-3'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>Data de Emissão - CC/Passaporte</label>
                                            <input type='text' class='form-control datepicker-input'
                                                   name='dataEmissaoCCColaborador' ";

        if (!empty($novaDataEmissaoCCColaborador)) {
            if (($novaDataEmissaoCCColaborador != "0000-00-00 00:00:00")) {
                $conversaoDataEmissaoCCColaborador = new DateTime($novaDataEmissaoCCColaborador);
                $textoDataEmissaoCCColaborador = $conversaoDataEmissaoCCColaborador->format('d-m-Y');

                echo "value='$textoDataEmissaoCCColaborador'";
            }
        }

        echo " data-mask='99-99-9999' placeholder='Data de Emissão'>
                                        </div>
                                    </div>

                                    <div class='col-sm-3'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>Entidade Emissora - CC/Passaporte</label>
                                            <input type='text' id='inputEmail' placeholder='Entidade Emissora'
                                                   autocomplete='on' class='form-control' ";

        if (!empty($entidaEmissoraCCColaborador)) {
            echo "value='$entidaEmissoraCCColaborador'";
        }

        echo " name='entidaEmissoraCCColaborador'>
                                        </div>
                                    </div>

                                    <div class='col-sm-3'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>Data de Validade - CC/Passaporte</label>
                                            <input type='text' class='form-control datepicker-input'
                                                   name='dataValidadeCCColaborador' ";

        if (!empty($novaDataValidadeCCPassaporte)) {
            if (($novaDataValidadeCCPassaporte != "1970-01-01 00:00:00")) {
                $conversaoDataValidadeCCPassaporte = new DateTime($novaDataValidadeCCPassaporte);
                $textoDataValidadeCCPassaporte = $conversaoDataValidadeCCPassaporte->format('d-m-Y');

                echo "value='$textoDataValidadeCCPassaporte'";
            }
        }
        echo " data-mask='99-99-9999' placeholder='Data de Validade'>
                                        </div>
                                    </div>

                                    <div class='col-sm-3'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>Número - Contribuinte</label>
                                            <input type='number' id='inputEmail' placeholder='Número de Contribuinte'
                                                   autocomplete='on' class='form-control' ";

        if (!empty($contribuinteColaborador)) {
            echo "value='$contribuinteColaborador'";
        }

        echo " name='contribuinteColaborador'>
                                        </div>
                                    </div>

                                    <div class='col-sm-3'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>Número - Segurança Social</label>
                                            <input type='number' id='inputEmail'
                                                   autocomplete='on' placeholder='Número de Segurança Social'
                                                   class='form-control' ";

        if (!empty($segSocialColaborador)) {
            echo "value='$segSocialColaborador'";
        }

        echo " name='segSocialColaborador'>
                                        </div>
                                    </div>

                                    <div class='col-sm-3'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>Número - Carta de Condução</label>
                                            <input type='text' id='inputEmail'
                                                   autocomplete='on' placeholder='Número de Carta de Condução'
                                                   class='form-control' ";

        if (!empty($cartaConducaoColaborador)) {
            echo "value='$cartaConducaoColaborador'";
        }

        echo " name='cartaConducaoColaborador'>
                                        </div>
                                    </div>

                                    <div class='col-sm-3'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>Data de Validade - C. de Condução</label>
                                            <input type='text' class='form-control datepicker-input'
                                                   name='dataValidadeCConducaoColaborador' ";

        if (!empty($novaDataValidadeCConducaoColaborador)) {

            if ($novaDataValidadeCConducaoColaborador != "1970-01-01 00:00:00") {

                $conversaoDataValidadeCConducaoColaborador = new DateTime($novaDataValidadeCConducaoColaborador);
                $textoDataValidadeCConducaoColaborador = $conversaoDataValidadeCConducaoColaborador->format('d-m-Y');

                echo "value='$textoDataValidadeCConducaoColaborador'";
            }
        }
        echo " data-mask='99-99-9999' placeholder='Data de Validade'>
                                        </div>
                                    </div>

                                    <div class='col-sm-3'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>Categorias - C. de Condução</label>
                                            <input type='text' id='inputEmail' placeholder='Categorias'
                                                   autocomplete='on' class='form-control' ";

        if (!empty($categoriasCConducaoColaborador)) {
            echo "value='$categoriasCConducaoColaborador'";
        }

        echo " name='categoriasCConducaoColaborador'>
                                        </div>
                                    </div>

                                    <div class='col-sm-3'>
                                        <div class='form-group'>
                                            <label for='' class=''>Escolaridade</label>

                                            <select class='form-control' name='escolaridadeColaborador'>
                                                <option ";
        if (empty($escolaridade)) {
            echo "selected disabled";
        }
        echo " >Escolaridade</option>
                                                <optgroup label='Ensino Básico'>
                                                    <option ";
        if ($escolaridade == "Ensino Básico - 1º Ciclo") {
            echo "selected";
        }
        echo " value='Ensino Básico - 1º Ciclo'>1º Ciclo</option>
                                                    <option ";

        if ($escolaridade == "Ensino Básico - 2º Ciclo") {
            echo "selected";
        }
        echo " value='Ensino Básico - 2º Ciclo'>2º Ciclo</option>
                                                    <option ";
        if ($escolaridade == "Ensino Básico - 3º Ciclo") {
            echo "selected";
        }
        echo " value='Ensino Básico - 3º Ciclo'>3º Ciclo</option>
                                                </optgroup>
                                                <option ";
        if ($escolaridade == "Ensino Secundário") {
            echo "selected";
        }
        echo " value='Ensino Secundário'>Ensino Secundário</option>
                                                <option ";
        if ($escolaridade == "Ensino Superior") {
            echo "selected";
        }
        echo " value='Ensino Superior'>Ensino Superior</option>
                                            </select>

                                        </div>
                                    </div>

                                    <div class='col-sm-5'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>Situação Militar</label>
                                            <input type='text' id='inputEmail' placeholder='Situação Militar'
                                                   autocomplete='on' class='form-control' ";

        if (!empty($situacaoMilitarColaborador)) {
            echo "value='$situacaoMilitarColaborador'";
        }

        echo " name='situacaoMilitarColaborador'>
                                        </div>
                                    </div>

                                    <div class='col-sm-4'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>Tipo de Admissão</label>
                                            <input type='text' id='inputEmail' placeholder='Tipo de Admissão'
                                                   autocomplete='on' class='form-control' ";

        if (!empty($tipoAdmissaoColaborador)) {
            echo "value='$tipoAdmissaoColaborador'";
        }

        echo " name='tipoAdmissaoColaborador'>
                                        </div>
                                    </div>

                                </div>
                            </section>

                            <section class='step' data-step-title='IRS e Seg. Social'>
                                <div class='row'>

                                    <div class='col-sm-2'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>Estado Civil</label><br>
                                            <label>
                                                <input type='radio' id='optionsRadios1'
                                                       value='Solteiro' name='estadoCivilColaborador'
                                                      ";
        if ($estadoCivilColaborador == "Solteiro") {
            echo "checked";
        }
        echo " > Solteiro
                                            </label>
                                            <label>
                                                <input type='radio' name='estadoCivilColaborador'
                                                       id='optionsRadios2' value='Casado' ";
        if ($estadoCivilColaborador == "Casado") {
            echo "checked";
        }
        echo " > Casado
                                            </label>
                                            <label>
                                                <input type='radio' name='estadoCivilColaborador'
                                                       id='optionsRadios2' value='Separado' ";
        if ($estadoCivilColaborador == "Separado") {
            echo "checked";
        }
        echo " > Separado
                                            </label>
                                        </div>
                                    </div>

                                    <div class='col-sm-2'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>Titular c/ Deficiência</label><br>
                                            <label>
                                                <input type='radio' id='optionsRadios1'
                                                       value='Sim' name='deficienciaColaborador' ";
        if ($deficienciaColaborador == "Sim") {
            echo "checked";
        }
        echo " > Sim
                                            </label>
                                            <label>
                                                <input type='radio' name='deficienciaColaborador' ";
        if ($deficienciaColaborador == "Não") {
            echo "checked";
        }
        echo " id='optionsRadios2' value='Não'> Não
                                            </label>
                                        </div>
                                    </div>

                                    <div class='col-sm-5'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>Nome do Cônjuge/Pessoa Análoga</label>
                                            <input type='text' id='inputEmail' ";
        if (!empty($conjugeColaborador)) {
            echo "value='$conjugeColaborador'";
        }
        echo " autocomplete='on' placeholder='Nome do Cônjuge ou Pessoa Análoga'
                                                   class='form-control' name='conjugeColaborador'>
                                        </div>
                                    </div>

                                    <div class='col-sm-3'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>Número - Contribuinte</label>
                                            <input type='number' id='inputEmail' placeholder='Número de Contribuinte'
                                                   autocomplete='on' class='form-control' ";
        if (!empty($contribuinteConjugeColaborador)) {
            echo "value='$contribuinteConjugeColaborador'";
        }
        echo " name='ContribuinteConjugeColaborador'>
                                        </div>
                                    </div>

                                    <div class='col-sm-6'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>Número - Titulares de Rendimento</label><br>
                                            <label>
                                                <input type='radio' id='optionsRadios1'
                                                       value='1 Titular' name='titularesRendimento' ";

        if ($titularesRendimento == "1 Titular") {
            echo "checked";
        }

        echo " > 1 Titular
                                            </label>
                                            <label>
                                                <input type='radio' name='titularesRendimento'
                                                       id='optionsRadios1' ";
        if ($titularesRendimento == "1 Titular - Aufere 95% ou Mais") {
            echo "checked";
        }

        echo " value='1 Titular - Aufere 95%'> 1 Titular - Aufere 95% ou Mais
                                            </label>
                                            <label>
                                                <input type='radio' name='titularesRendimento' ";
        if ($titularesRendimento == "2 Titulares") {
            echo "checked";
        }
        echo " id='optionsRadios1' value='2 Titulares'> 2 Titulares
                                            </label>
                                        </div>
                                    </div>

                                    <div class='col-sm-2'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>Nº - Familiares a Cargo</label>
                                            <input type='number' id='inputEmail' placeholder='Familiares Cargo'
                                                   autocomplete='on' class='form-control' ";
        if (!empty($familiaresCargoColaborador)) {
            echo "value='$familiaresCargoColaborador'";
        }
        echo " name='familiaresCargoColaborador'>
                                        </div>
                                    </div>

                                    <div class='col-sm-2'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>Nº - Filhos</label>
                                            <input type='number' id='inputEmail' placeholder='Número Filhos' ";
        if (!empty($filhosColaborador)) {
            echo "value='$filhosColaborador'";
        }
        echo " autocomplete='on' class='form-control' name='filhosColaborador'>
                                        </div>
                                    </div>

                                    <div class='col-sm-4'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>Idades - Filhos</label>
                                            <input type='text' id='inputEmail' placeholder='Idades'
                                                   autocomplete='on' class='form-control' ";
        if (!empty($idadesFilhosColaborador)) {
            echo "value='$idadesFilhosColaborador'";
        }
        echo " name='idadesFilhosColaborador'>
                                        </div>
                                    </div>

                                    <div class='col-sm-2'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>Filho(s) c/ deficiência</label><br>
                                            <label>
                                                <input type='radio' id='optionsRadios1'
                                                       value='Sim' name='deficienciaFilhosColaborador' ";
        if ($deficienciaFilhosColaborador == "Sim") {
            echo "checked";
        }
        echo " > Sim
                                            </label>
                                            <label>
                                                <input type='radio' name='deficienciaFilhosColaborador' ";
        if ($deficienciaFilhosColaborador == "Não") {
            echo "checked";
        }
        echo " id='optionsRadios2' value='Não'> Não
                                            </label>
                                        </div>
                                    </div>

                                    <div class='col-sm-2'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>Regime de Seg. Social</label>
                                            <input type='number' id='inputEmail' placeholder='Regime'
                                                   autocomplete='on' class='form-control' ";
        if (!empty($regimeSegSocialColaborador)) {
            echo "value='$regimeSegSocialColaborador'";
        }
        echo " name='regimeSegSocialColaborador'>
                                        </div>
                                    </div>

                                    <div class='col-sm-2'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>% Funcionário</label>
                                            <input type='number' id='inputEmail' placeholder='Percentagem'
                                                   autocomplete='on' class='form-control' ";
        if (!empty($percentagemFuncionarioColaborador)) {
            echo "value='$percentagemFuncionarioColaborador'";
        }
        echo " name='percentagemFuncionarioColaborador'>
                                        </div>
                                    </div>

                                    <div class='col-sm-2'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>% Entidade Patronal</label>
                                            <input type='number' id='inputEmail' placeholder='Percentagem'
                                                   autocomplete='on' class='form-control' ";
        if (!empty($percentagemEntPatronalColaborador)) {
            echo "value='$percentagemEntPatronalColaborador'";
        }
        echo " name='percentagemEntPatronalColaborador'>
                                        </div>
                                    </div>

                                </div>
                            </section>

                            <section class='step' data-step-title='Condições de Admissão'>
                                <div class='row'>

                              <div class='col-sm-3'>
                                            <div class='form-group'>
                                            <label for=''>Função</label>
                                            <select id='pessoasDecisao' class='form-control' name='";

        if (($funcaoColaborador == "Ajudante") OR ($funcaoColaborador == "Distribuição") OR ($funcaoColaborador == "Escritório") OR
            ($funcaoColaborador == "Técnico de Vendas")
        ) {
            echo "funcaoColaborador";
        } else {
            echo "";
        }

        echo "' onchange='apresentacaInputTexto();'>
                                            <option selected disabled>Função</option>
                                            <option ";
        if ($funcaoColaborador == "Ajudante") {
            echo "selected";
        }
        echo " value='Ajudante'><b>Ajudante</b></option>
                                            <option ";
        if ($funcaoColaborador == "Distribuição") {
            echo "selected";
        }
        echo " value='Distribuição'><b>Distribuição</b></option>
                                            <option ";
        if ($funcaoColaborador == "Escritório") {
            echo "selected";
        }
        echo " value='Escritório'><b>Escritório</b></option>
                                            <option ";
        if ($funcaoColaborador == "Técnico de Vendas") {
            echo "selected";
        }
        echo " value='Técnico de Vendas'><b>Técnico de Vendas</b></option>
                                            <option ";
        if (($funcaoColaborador != "Ajudante") AND ($funcaoColaborador != "Distribuição") AND ($funcaoColaborador != "Escritório") AND
            ($funcaoColaborador != "Técnico de Vendas")
        ) {
            echo "selected";
        }
        echo " value='Outro'><b>Outro</b></option>
                                            </select>
                                            </div>
                                            </div>

                                            <div class='col-sm-3' id='outroPessoasDecisao' style='display: ";
        if (($funcaoColaborador != "Ajudante") AND ($funcaoColaborador != "Distribuição") AND ($funcaoColaborador != "Escritório") AND
            ($funcaoColaborador != "Técnico de Vendas")
        ) {
            echo "block";
        } else {
            echo "none";
        }
        echo "'>
                                            <div class='form-group'>
                                            <label for=''>Qual?</label>
                                            <input placeholder='Outra Função' name='";

        if (($funcaoColaborador != "Ajudante") AND ($funcaoColaborador != "Distribuição") AND ($funcaoColaborador != "Escritório") AND
            ($funcaoColaborador != "Técnico de Vendas")
        ) {
            echo "funcaoColaborador";
        } else {
            echo "";
        }

        echo "' type='text' class='form-control' ";
        if (($funcaoColaborador <> "Ajudante") AND ($funcaoColaborador <> "Distribuição")
            AND ($funcaoColaborador <> "Escritório") AND ($funcaoColaborador <> "Técnico de Vendas")
        ) {
            echo "value='$funcaoColaborador'";
        }
        echo " id='idPessoasDecisao'></div></div>

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


                                    <div class='col-sm-3'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>Categoria</label>
                                            <input type='text' id='inputEmail' placeholder='Categoria' ";
        if (!empty($categoriaColaborador)) {
            echo "value='$categoriaColaborador'";
        }
        echo " autocomplete='on' class='form-control' name='categoriaColaborador'>
                                        </div>
                                    </div>

                                    <div class='col-sm-3'>
                                        <div class='form-group'>
                                            <label for=''>Área do Posto de Trabalho</label>
                                            <select class='form-control' name='postoTrabalhoColaborador'>
                                                <option selected disabled>Posto de Trabalho</option>
                                                <option ";
        if ($postoTrabalhoColaborador == "Escritório") {
            echo "selected";
        }
        echo " value='Escritório'>Escritório</option>
                                                <option ";
        if ($postoTrabalhoColaborador == "DAL") {
            echo "selected";
        }
        echo " value='DAL'>DAL</option>
                                                <option ";
        if ($postoTrabalhoColaborador == "Força de Vendas Aveiro") {
            echo "selected";
        }
        echo " value='Força de Vendas Aveiro'>Força de Vendas Aveiro</option>
                                                <option ";
        if ($postoTrabalhoColaborador == "Força de Vendas Ovar") {
            echo "selected";
        }
        echo " value='Força de Vendas Ovar'>Força de Vendas Ovar</option>
                                                <option ";
        if ($postoTrabalhoColaborador == "Força de Vendas Viseu") {
            echo "selected";
        }
        echo " value='Força de Vendas Viseu'>Força de Vendas Viseu</option>
                                                <option ";
        if ($postoTrabalhoColaborador == "SDD") {
            echo "selected";
        }
        echo " value='SDD'>SDD</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class='col-sm-3'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>Situação Contratual</label>
                                             <select class='form-control' name='situacaoContratualColaborador'>
                                                <option selected disabled>Situação Contratual</option>
                                                <option ";
        if ($situacaoContratualColaborador == "Quadro") {
            echo "selected";
        }
        echo " value='Quadro'>Quadro</option>
                                                <option ";
        if ($situacaoContratualColaborador == "Termo") {
            echo "selected";
        }
        echo " value='Termo'>Termo</option>
                                                <option ";
        if ($situacaoContratualColaborador == "Sem Termo") {
            echo "selected";
        }
        echo " value='Sem Termo'>Sem Termo</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class='col-sm-3'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>Data de Admissão</label>
                                            <input type='text' class='form-control datepicker-input'
                                                   id='inputEmail' ";
        if (!empty($novaDataAdmissao)) {
            if ($novaDataAdmissao != "1970-01-01 00:00:00") {
                $conversaoDataAdmissao = new DateTime($novaDataAdmissao);
                $textoDataAdmissao = $conversaoDataAdmissao->format('d-m-Y');

                echo "value='$textoDataAdmissao'";
            }
        }
        echo " name='dataAdmissao'
                                                   data-mask='99-99-9999' placeholder='Data Admissão'>
                                        </div>
                                    </div>

                                    <div class='col-sm-3'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>Período Experimental (dias)</label>
                                            <input type='number' id='inputEmail' placeholder='Período Experimental' ";
        if (!empty($periodoExperimentalColaborador)) {
            echo "value='$periodoExperimentalColaborador'";
        }
        echo " autocomplete='on' class='form-control'
                                                   name='periodoExperimentalColaborador'>
                                        </div>
                                    </div>

                                    <div class='col-sm-3'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>Data Final do Per. Experimental</label>
                                            <input type='text' class='form-control datepicker-input'
                                                   id='inputEmail' ";

        if (!empty($novaDataFinalPeriodoExperimentalColaborador)) {

            if ($novaDataFinalPeriodoExperimentalColaborador != "0000-00-00 00:00:00") {
                $conversaoDataFinalPeriodoExperimentalColaborador = new DateTime($novaDataFinalPeriodoExperimentalColaborador);
                $textoDataFinalPeriodoExperimentalColaborador = $conversaoDataFinalPeriodoExperimentalColaborador->format('d-m-Y');

                echo "value='$textoDataFinalPeriodoExperimentalColaborador'";
            }
        }

        echo " name='dataFinalPeriodoExperimentalColaborador'
                                                   data-mask='99-99-9999' placeholder='Data Final'>
                                        </div>
                                    </div>

                                    <div class='col-sm-3'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>Nº de Horas Semanais</label>
                                            <input type='number' id='inputEmail' placeholder='Horas Semanais'
                                                   autocomplete='on' class='form-control' ";
        if (!empty($horasSemanaisColaborador)) {
            echo "value='$horasSemanaisColaborador'";
        }
        echo " name='horasSemanaisColaborador'>
                                        </div>
                                    </div>

                                    <div class='col-sm-3'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>Nº de Horas Diárias</label>
                                            <input type='number' id='inputEmail' placeholder='Horas Diárias'
                                                   autocomplete='on' class='form-control' ";
        if (!empty($horasDiariasColaborador)) {
            echo "value='$horasDiariasColaborador'";
        }
        echo " name='horasDiariasColaborador'>
                                        </div>
                                    </div>

                                    <div class='col-sm-3'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>Descanso Complementar - Sábado</label><br>
                                            <label>
                                                <input type='radio' id='optionsRadios1'
                                                       value='Sim' name='descansoComplementarColaborador' ";
        if ($descansoComplementarColaborador == "Sim") {
            echo "checked";
        }
        echo " > Sim
                                            </label>
                                            <label>
                                                <input type='radio' name='descansoComplementarColaborador' ";
        if ($descansoComplementarColaborador == "Não") {
            echo "checked";
        }
        echo " id='optionsRadios2' value='Não'> Não
                                            </label>
                                        </div>
                                    </div>

                                    <div class='col-sm-2'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>Sistema Rotativo</label><br>
                                            <label>
                                                <input type='radio' id='optionsRadios1'
                                                       value='Sim' name='sistemaRotativoColaborador' ";
        if ($sistemaRotativoColaborador == "Sim") {
            echo "checked";
        }
        echo " > Sim
                                            </label>
                                            <label>
                                                <input type='radio' name='sistemaRotativoColaborador' ";
        if ($sistemaRotativoColaborador == "Não") {
            echo "checked";
        }
        echo " id='optionsRadios2' value='Não'> Não
                                            </label>
                                        </div>
                                    </div>
<div class='col-sm-12' style='font-size: 0 !important;'>&nbsp;</div>
                                    <div class='col-sm-4'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>NIB</label>
                                            <input type='number' id='inputEmail' placeholder='NIB' ";

        if (!empty($NIBColaborador)) {
            echo "value='$NIBColaborador'";
        }

        echo " autocomplete='on' class='form-control' name='NIBColaborador'>
                                        </div>
                                    </div>

                                    <div class='col-sm-3'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>Instituição Bancária</label>
                                            <input type='text' id='inputEmail' placeholder='Instituição Bancária'
                                                   autocomplete='on' class='form-control' ";
        if (!empty($isntBancariaColaborador)) {
            echo "value='$isntBancariaColaborador'";
        }

        echo " name='isntBancariaColaborador'>
                                        </div>
                                    </div>

                                    <div class='col-sm-3'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>Agência</label>
                                            <input type='text' id='inputEmail' placeholder='Agência' ";
        if (!empty($agenciaColaborador)) {
            echo "value='$agenciaColaborador'";
        }
        echo " autocomplete='on' class='form-control' name='agenciaColaborador'>
                                        </div>
                                    </div>

                                    <div class='col-sm-3'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>Vencimento Base</label>
                                            <input type='text' id='inputEmail' placeholder='Vencimento Base' ";
        if (!empty($vencBaseColaborador)) {
            echo "value='$vencBaseColaborador&euro;'";
        }
        echo " autocomplete='on' class='form-control' name='vencBaseColaborador'>
                                        </div>
                                    </div>

                                      <div class='col-sm-3'>
                                        <div class='form-group'>
                                            <label for='inputEmail'>Data Final do Contrato de Trabalho</label>
                                            <input type='text' class='form-control datepicker-input'
                                                   id='inputEmail'
                                                   name='dataFinalContratoColaborador'
                                                   data-mask='99-99-9999' placeholder='Data Final do Contrato' ";

        if (!empty($novaDataFinalContratoColaborador)) {

            if ($novaDataFinalContratoColaborador != "1970-01-01 00:00:00") {
                $conversaoDataFinalContratoColaborador = new DateTime($novaDataFinalContratoColaborador);
                $textoDataFinalContratoColaborador = $conversaoDataFinalContratoColaborador->format('d-m-Y');

                echo "value='$textoDataFinalContratoColaborador'";
            }
        }


        echo " >
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
<div class='md-overlay' onclick='funcaoTeste();'></div>
<!-- End of eoverlay modal -->
<script>
    var resizefunc = [];
</script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src='assets/libs/jquery/jquery-1.11.1.min.js'></script>
<script src='assets/libs/bootstrap/js/bootstrap.min.js'></script>
<script src='assets/libs/jqueryui/jquery-ui-1.10.4.custom.min.js'></script>
<script src='assets/libs/jquery-ui-touch/jquery.ui.touch-punch.min.js'></script>
<script src='assets/libs/jquery-detectmobile/detect.js'></script>
<script src='assets/libs/jquery-animate-numbers/jquery.animateNumbers.js'></script>
<script src='assets/libs/ios7-switch/ios7.switch.js'></script>
<script src='assets/libs/fastclick/fastclick.js'></script>
<script src='assets/libs/jquery-blockui/jquery.blockUI.js'></script>
<script src='assets/libs/bootstrap-bootbox/bootbox.min.js'></script>
<script src='assets/libs/jquery-slimscroll/jquery.slimscroll.js'></script>
<script src='assets/libs/jquery-sparkline/jquery-sparkline.js'></script>
<script src='assets/libs/nifty-modal/js/classie.js'></script>
<script src='assets/libs/nifty-modal/js/modalEffects.js'></script>
<script src='assets/libs/sortable/sortable.min.js'></script>
<script src='assets/libs/bootstrap-fileinput/bootstrap.file-input.js'></script>
<script src='assets/libs/bootstrap-select/bootstrap-select.min.js'></script>
<script src='assets/libs/bootstrap-select2/select2.min.js'></script>
<script src='assets/libs/magnific-popup/jquery.magnific-popup.min.js'></script>
<script src='assets/libs/pace/pace.min.js'></script>
<script src='assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.js'></script>
<script src='assets/libs/jquery-icheck/icheck.min.js'></script>

<!-- Demo Specific JS Libraries -->
<script src='assets/libs/prettify/prettify.js'></script>

<script src='assets/js/init.js'></script>
<!-- Page Specific JS Libraries -->
<script src='assets/libs/jquery-wizard/jquery.easyWizard.js'></script>
<script src='assets/js/pages/form-wizard.js'></script>
<script src='assets/js/apps/calculator.js'></script>
<script src='assets/libs/bootstrap-inputmask/inputmask.js'></script>

</body>
</html>";
    } else {
        header('location:index.php');
    }
}