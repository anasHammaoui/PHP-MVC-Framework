<?php
namespace app\core;
use app\core\sessions;
use app\core\Validator;
use app\core\Security;
use Illuminate\Database\Eloquent\Model;
use app\models\User;
class Auth extends Model {
    private $sessions;
    private $validator;
    private $security;
    private $user;
    public function __construct(){
        $this -> sessions = new Sessions();
        $this -> validator = new Validator();
        $this -> security = new Security();
        $this -> user = new User();
    }
    public function signUp($email,$password){
        $password = $this -> security -> xssSecurity($password) ;
        $email =$this -> security -> xssSecurity($email);
        // var_dump($this -> user::where('email',$email) -> first());die;
        if ($this -> validator ->validatePass($password)  &&  $this -> validator ->validateEmail($email) ){
            if ($this -> user::where('email',$email) -> first()){
                return false;
            } else {
                $countUsers = $this -> user -> count();
                    $this -> user -> email = $email;
                    $this ->user -> pass = password_hash($password,PASSWORD_BCRYPT);
                    $this ->user -> user_role = $countUsers === 0 ? "admin" : "user";
                    $this -> user-> save();
                    return true;
            }
        }
        return false;
    }
    public function login($email,$password){
        $password = $this -> security -> xssSecurity($password) ;
        $email =$this -> security -> xssSecurity($email);
        if ($this -> validator ->validatePass($password)  &&  $this -> validator ->validateEmail($email) ){
            if ($this -> user::where('email',$email) -> first()){
                $userData = $this -> user::where('email',$email) -> select("user_id","email","pass","user_role") -> first() -> toArray();
                if (password_verify($password,$userData["pass"])){
                    // var_dump($userData);die;
                    $this -> sessions -> setSession("user_id",$userData["user_id"]);
                    $this -> sessions -> setSession("user_role",$userData["user_role"]);
                    return true;
                } 
                return false;
            } 
            return false;
        }
        return false;
    }
}