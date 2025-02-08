<?php
namespace app\controllers\front;
use app\core\Auth as AuthFrame;
use app\controllers\BaseController;
use app\core\Sessions;
class auth extends BaseController{
    private $authFrame;
    private $sessions;
    public function __construct(){
        $this -> authFrame = new AuthFrame();
        $this -> sessions = new Sessions();
    }
    public function renderSignUp(){
        $this -> render("SignUp");
    }
    public function renderLogin(){
        $this -> render("SignIn");
    }
    public function signUp(){
        // echo "salam";die;
        if (isset($_POST["signUp"])){
            $errors = [];
            $email = $_POST["email"];
            $pass = $_POST["password"];
            if (!($this -> authFrame -> signUp($email,$pass,"user"))){
                array_push($errors, "Invalid email or password");
            }
            $this -> render("signUp",["errors" => $errors]);
        }   
    } public function login(){
        if (isset($_POST["signIn"])){
            if($this -> authFrame-> login($_POST["email"],$_POST["password"])){
                if ($this -> sessions -> checkSession("user_role","admin")){
                   header("location:/admin");
                   exit;
                } elseif ($this -> sessions -> checkSession("user_role","user")){
                    header("location:/userdash");
                    exit;
                }
            } else {
                echo "failed to log in";die;
            }
        }
    }
}