<?php

namespace app\core;
class Validator {
    public function __construct(){

    }   
    public function validateEmail($email){
        if (filter_var($email,FILTER_VALIDATE_EMAIL)){
            return true;
        } else {
            return false;
        }
    }
    public function validateStrings($name){
        if (preg_match("/^[a-z]+$/i", $name)){
            return true;
        } 
        return false;
    }
    public function validatePhone($phone){
        if(preg_match("/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/",$phone)){
            return true;
        } else {
            return false;
        }
    }
    public function validateNumbers($num){
        if (preg_match("/^\d+(\.\d+)?$/",$num)){
            return true;
        } else {
            return false; 
        }
    }
    public function validatePass($pass){
        if (preg_match("/^[A-Za-z\d]{8,}$/",$pass)){
            return true;
        } 
        return false;
    }
}