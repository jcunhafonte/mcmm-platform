<?php

function checkSession()
{
    if (isset($_COOKIE['keep_logged'])) {
        session_start();
    } else {
    }
}
