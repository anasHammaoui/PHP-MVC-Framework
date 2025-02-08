<?php
namespace app\controllers;
class BaseController{
    public function __construct(){

    }
    public function render($page, $data = []){
        extract($data);
        include __dir__."/../views/".$page.".php";
        exit;
    }
}
