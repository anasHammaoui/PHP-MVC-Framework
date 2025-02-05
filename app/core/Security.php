<?php

namespace app\core;

class Security {
    public function __construct()  {
        
    }
    // generate csrf token
    public function csrfSecurity(){
       if (!isset($_SERVER["csrf_token"])){
        $token = bin2hex(random_bytes(32));
        $_SERVER["csrf_token"] = $token;
       } else {
        $token = $_SERVER["csrf_token"];
       }
       return $token;
    }

    // validate csrf token
    public function validateCsrf($gettedToken){
        if($gettedToken === $_SERVER["csrf_token"]){
            return true;
        } else {
            return false;
        }
    }
    // xss security
    public function xssSecurity($data){
        return htmlspecialchars($data);
    }
}