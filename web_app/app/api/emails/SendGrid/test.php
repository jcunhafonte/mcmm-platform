<?php

require "sendgrid-php.php";

$sendgrid = new SendGrid('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');
$email = new SendGrid\Email();
$email
    ->addTo('cunha.jose@ua.pt')
    ->addToName('José')
    ->setFrom('mcmm_platform@hotmail.com')
    ->setFromName('Support')
    ->setSubject('MCMM')
    ->setText('Hello World!')
    ->setHtml('<strong>Hello World!</strong>')
    ->setTemplateId('f763e1f4-c605-4caa-b585-657867a967eb')
    ->setSubstitutions(array(
        '%username%' => array('John'),
        '%subject%' => array('John'),
        '%email%' => array('John'),
    ))
;

try {
    $sendgrid->send($email);
} catch (\SendGrid\Exception $e) {
    echo $e->getCode();
    foreach ($e->getErrors() as $er) {
        echo $er;
    }
}