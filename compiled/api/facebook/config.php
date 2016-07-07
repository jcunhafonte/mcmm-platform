<?php

include_once("inc/facebook.php");

$appId = '1732285890385262'; 
$appSecret = '8e5665736e5ee640f797f46220242ea7'; 
$homeurl = 'http://mcmm.tech/';
$fbPermissions = 'email'; 

//Call Facebook API
$facebook = new Facebook(array(
  'appId'  => $appId,
  'secret' => $appSecret

));

$fbuser = $facebook->getUser();

?>