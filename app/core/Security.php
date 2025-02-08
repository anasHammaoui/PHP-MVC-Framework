<?php

namespace app\core;

class Security {
    public function __construct()  {
        
    }
    // generate csrf token
    public function generateCsrf(){
        $token = bin2hex(random_bytes(32));
        $_SESSION["csrf_token"] = $token;
    }

    // validate csrf token
    public function validateCsrf($gettedToken){
        if(isset($_SESSION["csrf_token"]) && isset($gettedToken) && $_SESSION["csrf_token"] === $gettedToken){
            return true;
        }
            return false;
    }
    // xss security
    public function xssSecurity($data){
        return htmlspecialchars($data);
    }
}