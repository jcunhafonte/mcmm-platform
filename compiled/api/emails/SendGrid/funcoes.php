<?php

function emailValidarConta($user, $emailUser, $hashEmail)
{
    require "sendgrid-php.php";

    $sendgrid = new SendGrid('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');
    $email = new SendGrid\Email();
    $email
        ->addTo($emailUser)
        ->addToName($user)
        ->setFrom('mcmm_platform@hotmail.com')
        ->setFromName('MCMM')
        ->setSubject('Validação de Conta')
        ->setText('Validação de Conta')
        ->setHtml('<strong>Validação de Conta</strong>')
        ->setTemplateId('013d209b-84ec-4a82-b4bc-92c16a618510')
        ->setSubstitutions(array(
            '%username%' => array($user),
            '%subject%' => array('Validação de Conta'),
            '%hash_email%' => array($hashEmail)
        ));

    try {
        $sendgrid->send($email);
    } catch (\SendGrid\Exception $e) {
        echo $e->getCode();
        foreach ($e->getErrors() as $er) {
            echo $er;
        }
    }
}

function confirmacaoValidacao($user, $emailUser, $link_user)
{
    require "sendgrid-php.php";

    $sendgrid = new SendGrid('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');
    $email = new SendGrid\Email();
    $email
        ->addTo($emailUser)
        ->addToName($user)
        ->setFrom('mcmm_platform@hotmail.com')
        ->setFromName('MCMM')
        ->setSubject('Conta Validada')
        ->setText('Conta Validada')
        ->setHtml('<strong>Conta Validada</strong>')
        ->setTemplateId('f763e1f4-c605-4caa-b585-657867a967eb')
        ->setSubstitutions(array(
            '%username%' => array($user),
            '%subject%' => array('Conta Validada'),
            '%email%' => array($emailUser),
            '%link_user%' => array($link_user)
        ));

    try {
        $sendgrid->send($email);
    } catch (\SendGrid\Exception $e) {
        echo $e->getCode();
        foreach ($e->getErrors() as $er) {
            echo $er;
        }
    }
}

function alteracaoPassword($user, $emailUser, $link_user)
{
    require "sendgrid-php.php";

    $sendgrid = new SendGrid('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');
    $email = new SendGrid\Email();
    $email
        ->addTo($emailUser)
        ->addToName($user)
        ->setFrom('mcmm_platform@hotmail.com')
        ->setFromName('MCMM')
        ->setSubject('Alteração da Palavra-passe')
        ->setText('Alteração da Palavra-passe')
        ->setHtml('<strong>Alteração da Palavra-passe</strong>')
        ->setTemplateId('0b81d395-0bab-4577-b908-ae3b5f70bc5e')
        ->setSubstitutions(array(
            '%username%' => array($user),
            '%subject%' => array('Alteração da Palavra-passe'),
            '%link_user%' => array($link_user)
        ));

    try {
        $sendgrid->send($email);
    } catch (\SendGrid\Exception $e) {
        echo $e->getCode();
        foreach ($e->getErrors() as $er) {
            echo $er;
        }
    }
}

function welcomeSocial($user, $emailUser, $link_user, $social)
{
    require "sendgrid-php.php";

    $sendgrid = new SendGrid('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');
    $email = new SendGrid\Email();
    $email
        ->addTo($emailUser)
        ->addToName($user)
        ->setFrom('mcmm_platform@hotmail.com')
        ->setFromName('MCMM')
        ->setSubject('Bem-vindo!')
        ->setText('Bem-vindo!')
        ->setHtml('<strong>Bem-vindo!</strong>')
        ->setTemplateId('702f9112-375a-4df6-84b4-930d4cdec431')
        ->setSubstitutions(array(
            '%username%' => array($user),
            '%subject%' => array('Bem-vindo!'),
            '%social%' => array($social),
            '%link_user%' => array($link_user)
        ));

    try {
        $sendgrid->send($email);
    } catch (\SendGrid\Exception $e) {
        echo $e->getCode();
        foreach ($e->getErrors() as $er) {
            echo $er;
        }
    }
}

function recoverPassword($user, $emailUser, $link_user)
{
    require "sendgrid-php.php";

    $sendgrid = new SendGrid('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');
    $email = new SendGrid\Email();
    $email
        ->addTo($emailUser)
        ->addToName($user)
        ->setFrom('mcmm_platform@hotmail.com')
        ->setFromName('MCMM')
        ->setSubject('Recuperar Palavra-passe')
        ->setText('Recuperar Palavra-passe')
        ->setHtml('<strong>Recuperar Palavra-passe</strong>')
        ->setTemplateId('916c1446-4d90-468b-8561-e4801715f96d')
        ->setSubstitutions(array(
            '%username%' => array($user),
            '%subject%' => array('Recuperar Palavra-passe'),
            '%email%' => array($emailUser),
            '%link_user%' => array($link_user)
        ));

    try {
        $sendgrid->send($email);
    } catch (\SendGrid\Exception $e) {
        echo $e->getCode();
        foreach ($e->getErrors() as $er) {
            echo $er;
        }
    }
}

function newsletter($user, $emailUser,
                    $linkNoticia1, $textoNoticia1, $imagemNoticia1,
                    $linkNoticia2, $textoNoticia2, $imagemNoticia2,
                    $linkProjeto1, $imagemProjeto1,
                    $linkProjeto2, $imagemProjeto2,
                    $linkProjeto3, $imagemProjeto3,
                    $linkProjeto4, $imagemProjeto4,
                    $linkProjeto5, $imagemProjeto5)
{
    require "sendgrid-php.php";

    $sendgrid = new SendGrid('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');
    $email = new SendGrid\Email();
    $email
        ->addTo($emailUser)
        ->addToName($user)
        ->setFrom('mcmm_platform@hotmail.com')
        ->setFromName('MCMM')
        ->setSubject('Newsletter MCMM')
        ->setText('Newsletter MCMM')
        ->setHtml('<strong>Newsletter MCMM</strong>')
        ->setTemplateId('799ddf1e-b290-4ccb-96df-43c43d1f44e9')
        ->setSubstitutions(array(
                '%subject%' => array('Newsletter MCMM'),
                '%link_noticia_1%' => array($linkNoticia1),
                '%texto_noticia_1%' => array($textoNoticia1),
                '%imagem_noticia_1%' => array($imagemNoticia1),
                
                '%link_noticia_2%' => array($linkNoticia2),
                '%texto_noticia_2%' => array($textoNoticia2),
                '%imagem_noticia_2%' => array($imagemNoticia2),

                '%link_projeto_1%' => array($linkProjeto1),
                '%imagem_projeto_1%' => array($imagemProjeto1),

                '%link_projeto_2%' => array($linkProjeto2),
                '%imagem_projeto_2%' => array($imagemProjeto2),

                '%link_projeto_3%' => array($linkProjeto3),
                '%imagem_projeto_3%' => array($imagemProjeto3),

                '%link_projeto_4%' => array($linkProjeto4),
                '%imagem_projeto_4%' => array($imagemProjeto4),

                '%link_projeto_5%' => array($linkProjeto5),
                '%imagem_projeto_5%' => array($imagemProjeto5),
            )
        );

    try {
        $sendgrid->send($email);
    } catch (\SendGrid\Exception $e) {
        echo $e->getCode();
        foreach ($e->getErrors() as $er) {
            echo $er;
        }
    }
}
