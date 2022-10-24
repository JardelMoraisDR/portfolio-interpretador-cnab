<?php

include 'Controllers/HomeController.php';
include 'Controllers/InterpretationController.php';

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch($url)
{
    case '/' :
    case '/home':
        HomeController::index();
    break;

    case '/interpretation':
        InterpretationController::index();
    break;

    default:
        echo "<center><h1>Página não encontrada :( </h1></center>";
    break;

}