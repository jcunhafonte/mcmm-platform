<?php

session_start();

if (isset($_SESSION['ativoAdmin'])) {

    session_destroy();
    header('location:../../entrar.php?sair=1');

}else{

    session_destroy();
    header('location:../../entrar.php?sair=1');

}