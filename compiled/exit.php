<?php

include_once("api/facebook/config.php");

setcookie("keep_logged", "", time() - 3600);
session_destroy();

if (strpos($_SERVER['HTTP_REFERER'], '?') !== false) {
    header("location: /");

} else {
    header("location: " . $_SERVER['HTTP_REFERER']);
}