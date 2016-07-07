<?php

/**
 * User has successfully authenticated with Twitter. Access tokens saved to session and DB.
 */

session_start();
require_once('oauth/twitteroauth.php');
require_once('twitter_class.php');

if (isset($_GET['connect']) && $_GET['connect'] == 'twitter') {
    $objTwitterApi = new TwitterLoginAPI;
    $return = $objTwitterApi->login_twitter($_GET['connect']);
    if ($return['error']) {
        echo $return['error'];
    } else {
        header('location:' . $return['url']);
        exit;
    }

}

?>

<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>How To Login With Twitter oAuth Using PHP</title>
</head>
<body>
<div class='tLink'><strong>Tutorial Link:</strong> <a
        href='http://www.stepblogging.com/how-to-login-with-twitter-oauth-using-php/' target='_blank'>Click Here</a>
</div>
<br/>
<div class='web'>
    <h1>How To Login With Twitter oAuth Using PHP</h1>
    <?php

    if (isset($_GET['connected'])) {
        $objTwitterApi = new TwitterLoginAPI;
        $return = $objTwitterApi->view();

        echo 'name:' . $return['name'] . '<br>';
        echo 'followers_count:' . $return['followers_count'] . '<br>';
        echo 'friends_count:' . $return['friends_count'] . '<br>';
        echo 'location:' . $return['location'] . '<br>';
        echo 'profile_image: <img src = "' . $return['profile_image_url'] . '" width="100" /><br>';
        echo 'Logout: <a href="https://twitter.com/logout" target="_blank">Logout</a><br>';

    } else {
        echo '<a href="index.php?connect=twitter"><img src="./images/lighter.png" alt="Sign in with Twitter"/></a>';
    }

    ?>
</div>
</body>
</html>
<style>
    .web {
        font-family: tahoma;
        size: 12px;
        top: 10%;
        border: 1px solid #CDCDCD;
        border-radius: 10px;
        padding: 10px;
        width: 45%;
        margin: auto;
        height: auto;
    }

    h1, h2 {
        margin: 3px 0;
        font-size: 13px;
        text-decoration: underline;
    }

    .tLink {
        font-family: tahoma;
        size: 12px;
        padding-left: 10px;
        text-align: center;
    }

    .talign_right {
        text-align: right;
    }

    .username_availability_result {
        display: block;
        width: auto;
        float: left;
        padding-left: 10px;
    }

    .input {
        float: left;
    }

    .error {
        color: #FF0000;
        font-size: 12px;
    }

</style>



