<?php
namespace app\controllers;
use app\Core\Controller;

class AuthController extends Controller{

    public function __construct(){}
    public function login(){
        return $this->render("login");
    }

    public function register(){
        return $this->render("register");
    }

    public function handleLogin(\app\core\Request $req){
        if ($req){
          $body=  $req->getBody();
        }
        return $this->login();
    }

    public function handleRegister(\app\core\Request $req){
        if ($req){
         $body = $req->getBody();
        }
        return $this->register();
    }

}