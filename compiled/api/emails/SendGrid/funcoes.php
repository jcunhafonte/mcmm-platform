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