<?php

session_start();

include_once("src/Google_Client.php");
include_once("src/contrib/Google_Oauth2Service.php");
######### edit details ##########
$clientId = '744585591883-jpps4niou9cvaulphl7a4bmjif2spi7f.apps.googleusercontent.com'; //Google CLIENT ID
$clientSecret = 'kysTigoctSL0_Ug_jR3XfwOT'; //Google CLIENT SECRET
$redirectUrl = 'http://mcmm.tech';  //return url (url to script)
$homeUrl = 'http://mcmm.tech';  //return to home

##################################

$gClient = new Google_Client();
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectUrl);

$google_oauthV2 = new Google_Oauth2Service($gClient);

?>