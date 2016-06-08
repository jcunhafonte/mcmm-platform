<?php

require '../Mailin.php';
use Sendinblue\Mailin;

$mailin = new Mailin("https://api.sendinblue.com/v2.0", "vOWEzSLg75w1fj8Z");

$data = array("to" => array("cunha.jose@ua.pt" => "to whom!"),
    "cc" => array("" => ""),
    "bcc" => array("" => ""),
    "from" => array("mcmm_platform@hotmail.com", "from email!"),
    "replyto" => array("replyto@email.com", "reply to!"),
    "subject" => "My subject",
    "text" => "This is the text",
    "html" => "This is the <h1>HTML</h1><br/>  This is inline image 1.<br/>",
    "attachment" => array(),
    "headers" => array("Content-Type" => "text/html; charset=iso-8859-1", "X-param1" => "value1", "X-param2" => "value2", "X-Mailin-custom" => "my custom value", "X-Mailin-IP" => "102.102.1.2", "X-Mailin-Tag" => "My tag"),
);

var_dump($mailin->send_email($data));

?>