<?php
namespace app\controllers\front;
use app\core\Auth as AuthFrame;
use app\controllers\BaseController;
use app\core\Sessions;
use app\core\Security;
class auth extends BaseController{
    private $authFrame;
    private $sessions;
    private $security;
    public function __construct(){
        $this -> authFrame = new AuthFrame();
        $this -> sessions = new Sessions();
        $this -> security = new Security();
    }
    public function renderSignUp(){
        $this -> security -> generateCsrf();
        $this -> render("SignUp");
    }
    public function renderLogin(){
        $this -> security -> generateCsrf();
        $this -> render("SignIn");
    }
    public function signUp(){
        // echo "salam";die;
        if (isset($_POST["signUp"])){
            if ($this -> security -> validateCsrf($_POST["token"])){
            $errors = [];
            $email = $_POST["email"];
            $pass = $_POST["password"];
            if (!($this -> authFrame -> signUp($email,$pass,"user"))){
                array_push($errors, "Invalid email or password");
            }
            $this -> render("signUp",["errors" => $errors]);
        } else{
            var_dump($_SESSION["csrf_token"],$_POST["signUp"]);
            echo "csrf token isn't exist:)";die;
        }
        }   
    } public function login(){
        if (isset($_POST["signIn"])){
            if ($this -> security -> validateCsrf($_POST["token"])){
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
            } else{
                echo "csrf token isn't exist:)";die;
            }
        }
    }
}