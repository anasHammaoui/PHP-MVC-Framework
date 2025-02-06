<?php
namespace app\core;
class Sessions{
    public function __construct(){
        if (session_status() !== PHP_SESSION_ACTIVE){
            session_start();
        }
    }
    public function setSession($key, $value){
        $_SESSION[$key] = $value;
    }
    public function getSessionValue($key){
        if (isset($_SESSION[$key])){
            return $_SESSION[$key];
        } 
        return NULL;
    }
    public function destroy(){
        session_destroy();
        return true;
    }
}