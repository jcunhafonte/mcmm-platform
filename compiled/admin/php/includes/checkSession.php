<?php

if (!isset($_SESSION['ativoAdmin'])) {
    header("location:entrar.php");
}
