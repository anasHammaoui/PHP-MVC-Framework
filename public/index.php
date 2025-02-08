<?php
session_start();
include_once "../vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();
include_once "../config/Database.php";
use app\core\Router;
use app\controllers\front\auth;
use app\controllers\front\Dash;
// use app\models\user;
$router = new Router();
$router -> add("get","/signup", [auth::class,"renderSignUp"]);
$router -> add("post","/create", [auth::class,"signUp"]);
$router -> add("get","/login", [auth::class,"renderLogin"]);
$router -> add("post","/login/account", [auth::class,"login"]);
$router -> add("get","/admin", [Dash::class,"adminDash"]);
$router -> add("get","/userdash", [Dash::class,"userDash"]);
$router -> dispatch($_SERVER["REQUEST_URI"], $_SERVER["REQUEST_METHOD"]);


