<?php

include_once("src/Google_Client.php");
include_once("src/contrib/Google_Oauth2Service.php");

$clientId = '744585591883-jpps4niou9cvaulphl7a4bmjif2spi7f.apps.googleusercontent.com';
$clientSecret = 'kysTigoctSL0_Ug_jR3XfwOT';
$redirectUrl = 'http://mcmm.tech';
$homeUrl = 'http://mcmm.tech';

$gClient = new Google_Client();
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectUrl);

$google_oauthV2 = new Google_Oauth2Service($gClient);

?>