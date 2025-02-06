<?php

include_once "../vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();
include_once "../config/Database.php";
use app\core\Router;
use app\models\user;
$router = new Router();
$router -> dispatch($_SERVER["REQUEST_URI"], $_SERVER["REQUEST_METHOD"]);


