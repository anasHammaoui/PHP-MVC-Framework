<?php

namespace app\controllers\front;
use app\controllers\BaseController;
use app\core\Sessions;
class Dash extends BaseController{
    private $sessions;
    public function __construct(){
        $this -> sessions = new Sessions();
    }
    public function adminDash(){
        if ($this -> sessions -> checkSession("user_role","admin")){
            $this -> render("Admin");
        } else {
            echo "Please log in first admin:)";die;
        }
    }
    public function userDash(){
        if ($this -> sessions -> checkSession("user_role","user")){
            $this -> render("UserDash");
        } else {
            echo "Please log in first user:)";die;
        }
    }
}