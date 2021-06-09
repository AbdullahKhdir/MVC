<?php
namespace app\controllers;
use app\Core\Controller;
use app\models\RegisterModel;

class AuthController extends Controller{

    public function __construct(){}

    public function renderLogin(){
        $this->render("login");
    }

    public function renderRegister(){
        $this->render("register");
    }

    public function handleLogin(\app\core\Request $req){
        if ($req){
          $body=  $req->getBody();
        }
        var_dump($req->getBody());
        return $this->render("login");
    }

    public function handleRegister(\app\core\Request $req){

        $regModel = new RegisterModel();

        if ($req){
            $body = $req->getBody();
            $regModel->loadData($req->getBody()); //write the posted data to the RegisterModel
            if ($regModel->isValid($req) === true){
                return $this->render("register", ["regModel" => $regModel]);
            }else{
                /*$params = [
                    "FirstNameError" => $regModel->error["firstName"][$regModel->getIndex("firstName")],
                    "LastNameError" => $regModel->error["lastName"][$regModel->getIndex("lastName")],
                    "UserNameError" => $regModel->error["userName"][$regModel->getIndex("userName")],
                    "EmailError" => $regModel->error["email"][$regModel->getIndex("email")],
                    "PswdError" => $regModel->error["password"][$regModel->getIndex("password")],
                    "PswdConfirmError" => $regModel->error["passwordConfirm"][$regModel->getIndex("passwordConfirm")],
                ];*/

                return $this->render("register", ["regModel" => $regModel]);
            }
        }
    }

}