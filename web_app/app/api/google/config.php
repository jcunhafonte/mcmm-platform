<?php

session_start();
include_once("src/Google_Client.php");
include_once("src/contrib/Google_Oauth2Service.php");
######### edit details ##########
$clientId = '494233592444-3na800v5acvj7c5m6vccvvu1thmv3bjk.apps.googleusercontent.com'; //Google CLIENT ID
$clientSecret = 'JoSBm6PLiGp69909uNzQFzV_'; //Google CLIENT SECRET
$redirectUrl = 'http://178.62.86.141';  //return url (url to script)
$homeUrl = 'http://178.62.86.141';  //return to home

##################################

$gClient = new Google_Client();
$gClient->setApplicationName('MCMM');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectUrl);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>