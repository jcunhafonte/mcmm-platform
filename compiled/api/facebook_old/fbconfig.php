<?php
session_start();
// added in v4.0.0
require_once 'autoload.php';
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;

// init app with app id and secret
FacebookSession::setDefaultApplication('1732285890385262', '8e5665736e5ee640f797f46220242ea7');
// login helper with redirect_uri
$helper = new FacebookRedirectLoginHelper('http://www.mcmm.tech/');
try {
    $session = $helper->getSessionFromRedirect();
} catch (FacebookRequestException $ex) {
} catch (Exception $ex) {
}

// see if we have a session
if (isset($session)) {
    // graph api request for user data
    $request = new FacebookRequest($session, 'GET', '/me', '/{user-id}/photos');
    $response = $request->execute();
    // get response
    $graphObject = $response->getGraphObject();
    $fbid = $graphObject->getProperty('id');
    $fbfullname = $graphObject->getProperty('name');
    $femail = $graphObject->getProperty('email');
    /* ---- Session Variables -----*/
    $_SESSION['FBID'] = $fbid;
    $_SESSION['FULLNAME'] = $fbfullname;
    $_SESSION['EMAIL'] = $femail;

    var_dump($femail, $fbfullname, $fbid);

//    header("Location: index.php");
} else {

    $loginUrl = $helper->getLoginUrl();
    header("Location: " . $loginUrl);
}
?>