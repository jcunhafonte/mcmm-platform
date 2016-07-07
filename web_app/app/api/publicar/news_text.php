<?php

session_start();

require("../connection/mysql.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    print_r($_POST);
    print_r($_FILES);
}

?>