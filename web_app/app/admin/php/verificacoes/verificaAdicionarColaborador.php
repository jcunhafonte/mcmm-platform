<?php

require_once('../connection/dbconnection.php');

session_start();

if (isset($_SESSION['ativoAdmin'])) {

    if (isset($_POST['nomeColaborador'])) {
        $nomeColaborador = $_POST['nomeColaborador'];
    } else {
        $nomeColaborador = NULL;
    }

    if (isset($_POST['moradaColaborador'])) {
        $moradaColaborador = $_POST['moradaColaborador'];
    } else {
        $moradaColaborador = NULL;
    }

    if (isset($_POST['localidadeColaborador'])) {
        $localidadeColaborador = $_POST['localidadeColaborador'];
    } else {
        $localidadeColaborador = NULL;
    }

    if (isset($_POST['codigoPostalColaborador'])) {
        $codigoPostalColaborador = $_POST['codigoPostalColaborador'];
    } else {
        $codigoPostalColaborador = NULL;
    }

    if (isset($_POST['telefoneColaborador'])) {
        $telefoneColaborador = $_POST['telefoneColaborador'];
    } else {
        $telefoneColaborador = NULL;
    }

    if (isset($_POST['telemovelColaborador'])) {
        $telemovelColaborador = $_POST['telemovelColaborador'];
    } else {
        $telemovelColaborador = NULL;
    }

    if (isset($_POST['emailColaborador'])) {
        $emailColaborador = $_POST['emailColaborador'];
    } else {
        $emailColaborador = NULL;
    }

    if (isset($_POST['dataNascimentoColaborador'])) {

        $dataNascimentoColaborador = $_POST['dataNascimentoColaborador'];
        $dataNascimentoColaborador = strtotime($dataNascimentoColaborador);
        $novaDataNascimentoColaborador = date('Y-m-d H:i:s', $dataNascimentoColaborador);

    } else {
        $novaDataNascimentoColaborador = NULL;
    }

    if (isset($_POST['naturalidadeColaborador'])) {
        $naturalidadeColaborador = $_POST['naturalidadeColaborador'];
    } else {
        $naturalidadeColaborador = NULL;
    }

    if (isset($_POST['nacionalidadeColaborador'])) {
        $nacionalidadeColaborador = $_POST['nacionalidadeColaborador'];
    } else {
        $nacionalidadeColaborador = NULL;
    }

    if (isset($_POST['CCPassaporteColaborador'])) {
        $CCPassaporteColaborador = $_POST['CCPassaporteColaborador'];
    } else {
        $CCPassaporteColaborador = NULL;
    }

    if (isset($_POST['dataEmissaoCCColaborador'])) {

        $dataEmissaoCCColaborador = $_POST['dataEmissaoCCColaborador'];
        $dataEmissaoCCColaborador = strtotime($dataEmissaoCCColaborador);
        $novaDataEmissaoCCColaborador = date('Y-m-d H:i:s', $dataEmissaoCCColaborador);

    } else {
        $novaDataEmissaoCCColaborador = NULL;
    }

    if (isset($_POST['entidaEmissoraCCColaborador'])) {
        $entidaEmissoraCCColaborador = $_POST['entidaEmissoraCCColaborador'];
    } else {
        $entidaEmissoraCCColaborador = NULL;
    }

    if (isset($_POST['dataValidadeCCColaborador'])) {
        $dataValidadeCCColaborador = $_POST['dataValidadeCCColaborador'];
        $dataValidadeCCColaborador = strtotime($dataValidadeCCColaborador);
        $novaDataValidadeCCColaborador = date('Y-m-d H:i:s', $dataValidadeCCColaborador);
    } else {
        $novaDataValidadeCCColaborador = NULL;
    }

    if (isset($_POST['contribuinteColaborador'])) {
        $contribuinteColaborador = $_POST['contribuinteColaborador'];
    } else {
        $contribuinteColaborador = NULL;
    }

    if (isset($_POST['segSocialColaborador'])) {
        $segSocialColaborador = $_POST['segSocialColaborador'];
    } else {
        $segSocialColaborador = NULL;
    }

    if (isset($_POST['cartaConducaoColaborador'])) {
        $cartaConducaoColaborador = $_POST['cartaConducaoColaborador'];
    } else {
        $cartaConducaoColaborador = NULL;
    }

    if (isset($_POST['dataValidadeCConducaoColaborador'])) {
        $dataValidadeCConducaoColaborador = $_POST['dataValidadeCConducaoColaborador'];
        $dataValidadeCConducaoColaborador = strtotime($dataValidadeCConducaoColaborador);
        $novaDataValidadeCConducaoColaborador = date('Y-m-d H:i:s', $dataValidadeCConducaoColaborador);
    } else {
        $novaDataValidadeCConducaoColaborador = NULL;
    }

    if (isset($_POST['categoriasCConducaoColaborador'])) {
        $categoriasCConducaoColaborador = $_POST['categoriasCConducaoColaborador'];
    } else {
        $categoriasCConducaoColaborador = NULL;
    }

    if (isset($_POST['situacaoMilitarColaborador'])) {
        $situacaoMilitarColaborador = $_POST['situacaoMilitarColaborador'];
    } else {
        $situacaoMilitarColaborador = NULL;
    }

    if (isset($_POST['tipoAdmissaoColaborador'])) {
        $tipoAdmissaoColaborador = $_POST['tipoAdmissaoColaborador'];
    } else {
        $tipoAdmissaoColaborador = NULL;
    }


//    Segunda Página de Dados

    if (isset($_POST['estadoCivilColaborador'])) {
        $estadoCivilColaborador = $_POST['estadoCivilColaborador'];
    } else {
        $estadoCivilColaborador = NULL;
    }

    if (isset($_POST['deficienciaColaborador'])) {
        $deficienciaColaborador = $_POST['deficienciaColaborador'];
    } else {
        $deficienciaColaborador = NULL;
    }

    if (isset($_POST['conjugeColaborador'])) {
        $conjugeColaborador = $_POST['conjugeColaborador'];
    } else {
        $conjugeColaborador = NULL;
    }

    if (isset($_POST['ContribuinteConjugeColaborador'])) {
        $contribuinteConjugeColaborador = $_POST['ContribuinteConjugeColaborador'];
        $contribuinteConjugeColaborador = (int)$contribuinteConjugeColaborador;
    } else {
        $contribuinteConjugeColaborador = NULL;
    }

    if (isset($_POST['titularesRendimento'])) {
        $titularesRendimento = $_POST['titularesRendimento'];
    } else {
        $titularesRendimento = NULL;
    }

    if (isset($_POST['familiaresCargoColaborador'])) {
        $familiaresCargoColaborador = $_POST['familiaresCargoColaborador'];
    } else {
        $familiaresCargoColaborador = NULL;
    }

    if (isset($_POST['filhosColaborador'])) {
        $filhosColaborador = $_POST['filhosColaborador'];
    } else {
        $filhosColaborador = NULL;
    }

    if (isset($_POST['idadesFilhosColaborador'])) {
        $idadesFilhosColaborador = $_POST['idadesFilhosColaborador'];
    } else {
        $idadesFilhosColaborador = NULL;
    }

    if (isset($_POST['deficienciaFilhosColaborador'])) {
        $deficienciaFilhosColaborador = $_POST['deficienciaFilhosColaborador'];
    } else {
        $deficienciaFilhosColaborador = NULL;
    }

    if (isset($_POST['regimeSegSocialColaborador'])) {
        $regimeSegSocialColaborador = $_POST['regimeSegSocialColaborador'];
    } else {
        $regimeSegSocialColaborador = NULL;
    }

    if (isset($_POST['percentagemFuncionarioColaborador'])) {
        $percentagemFuncionarioColaborador = $_POST['percentagemFuncionarioColaborador'];
    } else {
        $percentagemFuncionarioColaborador = NULL;
    }

    if (isset($_POST['percentagemEntPatronalColaborador'])) {
        $percentagemEntPatronalColaborador = $_POST['percentagemEntPatronalColaborador'];
    } else {
        $percentagemEntPatronalColaborador = NULL;
    }

// Terceira Parte

    if (isset($_POST['funcaoColaborador'])) {
        $funcaoColaborador = $_POST['funcaoColaborador'];
    } else {
        $funcaoColaborador = NULL;
    }

    if (isset($_POST['categoriaColaborador'])) {
        $categoriaColaborador = $_POST['categoriaColaborador'];
    } else {
        $categoriaColaborador = NULL;
    }

    if (isset($_POST['postoTrabalhoColaborador'])) {
        $postoTrabalhoColaborador = $_POST['postoTrabalhoColaborador'];
    } else {
        $postoTrabalhoColaborador = NULL;
    }

    if (isset($_POST['situacaoContratualColaborador'])) {
        $situacaoContratualColaborador = $_POST['situacaoContratualColaborador'];
    } else {
        $situacaoContratualColaborador = NULL;
    }

    if (isset($_POST['periodoExperimentalColaborador'])) {
        $periodoExperimentalColaborador = $_POST['periodoExperimentalColaborador'];
    } else {
        $periodoExperimentalColaborador = NULL;
    }

    if (isset($_POST['periodoExperimentalColaborador'])) {
        $periodoExperimentalColaborador = $_POST['periodoExperimentalColaborador'];
    } else {
        $periodoExperimentalColaborador = NULL;
    }

    if (isset($_POST['dataFinalPeriodoExperimentalColaborador'])) {

        $dataFinalPeriodoExperimentalColaborador = $_POST['dataFinalPeriodoExperimentalColaborador'];
        $dataFinalPeriodoExperimentalColaborador = strtotime($dataFinalPeriodoExperimentalColaborador);
        $novaDataFinalPeriodoExperimentalColaborador = date('Y-m-d H:i:s', $dataFinalPeriodoExperimentalColaborador);

    } else {
        $novaDataFinalPeriodoExperimentalColaborador = NULL;
    }

    if (isset($_POST['dataAdmissao'])) {

        $dataAdmissao = $_POST['dataAdmissao'];
        $dataAdmissao = strtotime($dataAdmissao);
        $novaDataAdmissao = date('Y-m-d H:i:s', $dataAdmissao);
    } else {
        $novaDataAdmissao = NULL;
    }

    if (isset($_POST['horasSemanaisColaborador'])) {
        $horasSemanaisColaborador = $_POST['horasSemanaisColaborador'];
    } else {
        $horasSemanaisColaborador = NULL;
    }

    if (isset($_POST['horasDiariasColaborador'])) {
        $horasDiariasColaborador = $_POST['horasDiariasColaborador'];
    } else {
        $horasDiariasColaborador = NULL;
    }

    if (isset($_POST['descansoComplementarColaborador'])) {
        $descansoComplementarColaborador = $_POST['descansoComplementarColaborador'];
    } else {
        $descansoComplementarColaborador = NULL;
    }

    if (isset($_POST['sistemaRotativoColaborador'])) {
        $sistemaRotativoColaborador = $_POST['sistemaRotativoColaborador'];
    } else {
        $sistemaRotativoColaborador = NULL;
    }

    if (isset($_POST['NIBColaborador'])) {
        $NIBColaborador = $_POST['NIBColaborador'];
    } else {
        $NIBColaborador = NULL;
    }

    if (isset($_POST['isntBancariaColaborador'])) {
        $isntBancariaColaborador = $_POST['isntBancariaColaborador'];
    } else {
        $isntBancariaColaborador = NULL;
    }

    if (isset($_POST['agenciaColaborador'])) {
        $agenciaColaborador = $_POST['agenciaColaborador'];
    } else {
        $agenciaColaborador = NULL;
    }

    if (isset($_POST['vencBaseColaborador'])) {
        $vencBaseColaborador = $_POST['vencBaseColaborador'];
        $symbols = array('$', '€', '£');
        $vencBaseColaborador = str_replace($symbols, '', $vencBaseColaborador);
    } else {
        $vencBaseColaborador = NULL;
    }


    if (isset($_POST['dataFinalContratoColaborador'])) {

        $dataFinalContratoColaborador = $_POST['dataFinalContratoColaborador'];
        $dataFinalContratoColaborador = strtotime($dataFinalContratoColaborador);
        $novaDataFinalContratoColaborador = date('Y-m-d H:i:s', $dataFinalContratoColaborador);
    } else {
        $novaDataFinalContratoColaborador = NULL;
    }

    if (isset($_POST['escolaridadeColaborador'])) {
        $escolaridadeColaborador = $_POST['escolaridadeColaborador'];
    } else {
        $escolaridadeColaborador = NULL;
    }

    $query = "SELECT processo_recrutamento, processo_admissao FROM
colaborador ORDER BY processo_recrutamento DESC LIMIT 1";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_result($stmt, $procRecrutamento, $procAdmissao);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    $procRecrutamento = $procRecrutamento + 1;
    $procAdmissao = $procAdmissao + 1;

    $query = "INSERT INTO colaborador (tipo_admissao, nome_completo, morada, localidade,
codigo_postal, telefone, telemovel, email, nascimento, naturalidade, nacionalidade, cartao_cidadao,
emissao_cartao_cidadao, entidade_emissora, validade_cc_passaporte, contribuinte_passaporte, seg_social, carta_conducao,
validade_conducao, categoria_conducao, situacao_militar, estado_civil, deficiencia_colaborador,
conjuge_colaborador, contribuinte_conjuge, titulares_rendimento, familiares_cargo, numeros_filhos,
idades_filhos, deficiencia_filhos, reg_seg_social, percentagem_funcionario, percentagem_patronal,
funcao, categoria, situacao_contratual, posto_trabalho, periodo_experimental, data_final_per_experimental,
horas_semanais, horas_diarias, descanso_complementar, sistema_rotativo, NIB, instituicao_bancaria,
agencia, vencimento_base, data_admissao, escolaridade, medicina_trabalho, processo_recrutamento,
processo_admissao, data_final_contrato) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,
?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1, ?, ?, ?)";

    $stmt = mysqli_prepare($link, $query);

    mysqli_stmt_bind_param($stmt, 'sssssiissssisssiisssssssisiissiiissssisiississsssiis',
        $tipoAdmissaoColaborador, $nomeColaborador, $moradaColaborador, $localidadeColaborador, $codigoPostalColaborador,
        $telefoneColaborador, $telemovelColaborador, $emailColaborador, $novaDataNascimentoColaborador,
        $naturalidadeColaborador, $nacionalidadeColaborador, $CCPassaporteColaborador, $novaDataEmissaoCCColaborador,
        $entidaEmissoraCCColaborador, $novaDataValidadeCCColaborador, $contribuinteColaborador, $segSocialColaborador,
        $cartaConducaoColaborador, $novaDataValidadeCConducaoColaborador, $categoriasCConducaoColaborador,
        $situacaoMilitarColaborador, $estadoCivilColaborador, $deficienciaColaborador,
        $conjugeColaborador, $contribuinteConjugeColaborador, $titularesRendimento, $familiaresCargoColaborador,
        $filhosColaborador, $idadesFilhosColaborador, $deficienciaFilhosColaborador,
        $regimeSegSocialColaborador, $percentagemFuncionarioColaborador,
        $percentagemEntPatronalColaborador, $funcaoColaborador, $categoriaColaborador, $situacaoContratualColaborador,
        $postoTrabalhoColaborador, $periodoExperimentalColaborador, $novaDataFinalPeriodoExperimentalColaborador,
        $horasSemanaisColaborador, $horasDiariasColaborador, $descansoComplementarColaborador,
        $sistemaRotativoColaborador, $NIBColaborador, $isntBancariaColaborador, $agenciaColaborador,
        $vencBaseColaborador, $novaDataAdmissao, $escolaridadeColaborador,
        $procRecrutamento, $procAdmissao, $novaDataFinalContratoColaborador);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        $query = "SELECT id_colaborador FROM colaborador ORDER BY id_colaborador DESC LIMIT 1";
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_result($stmt, $idColaboradorContrato);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        $query = "INSERT INTO contrato (situacao_contratual, posto_trabalho, periodo_experimental,
data_final_per_experimental, funcao, categoria, horas_semanais, horas_diarias, descanso_complementar,
sistema_rotativo, NIB, instituicao_bancaria, agencia, vencimento_base, data_admissao, ref_id_colaborador,
data_final_contrato, data_contrato) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $dataAtual = date('Y-m-d H:i:s');
        $stmt = mysqli_prepare($link, $query);

        mysqli_stmt_bind_param($stmt, 'ssisssiississssiss', $situacaoContratualColaborador, $postoTrabalhoColaborador,
            $periodoExperimentalColaborador, $novaDataFinalPeriodoExperimentalColaborador, $funcaoColaborador,
            $categoriaColaborador, $horasSemanaisColaborador, $horasDiariasColaborador, $descansoComplementarColaborador,
            $sistemaRotativoColaborador, $NIBColaborador, $isntBancariaColaborador, $agenciaColaborador,
            $vencBaseColaborador, $novaDataAdmissao, $idColaboradorContrato, $novaDataFinalContratoColaborador,
            $dataAtual);

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
            header('location:../../adicionarColaborador.php?sucesso=1');
        } else {
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
            header('location:../../adicionarColaborador.php?sucesso=2');
        }
    } else {
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        header('location:../../adicionarColaborador.php?sucesso=2');
    }
}