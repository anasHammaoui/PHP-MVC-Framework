<?php
include_once "../vendor/autoload.php";
use app\core\Router;
$router = new Router();
$router -> add("get","/",[Router::class, "getRoutes"]);
$router -> dispatch($_SERVER["REQUEST_URI"], $_SERVER["REQUEST_METHOD"]);