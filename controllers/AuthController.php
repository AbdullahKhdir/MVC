<?php
namespace app\controllers;
use app\core\Application;
use app\Core\Controller;
use app\Core\Database;
use app\Core\Model;
use app\models\RegisterModel;
use PDO;

class AuthController extends Controller{

    public function __construct(){}

    public function renderLogin(){
        $this->render("login");
    }

    public function renderRegister(){
        $this->render("register");
    }

    public function handleLogin(\app\core\Request $req){

        $regModel = new RegisterModel();

        if ($req){
            $body = $req->getBody();

            $regModel->loadData($req->getBody()); //write the posted data to the RegisterModel

            if ($regModel->isValidLogin($req) === true){

                $email = $req->getBody()['email'];
                $pswd = $req->getBody()["password"];

                //checkEmail
                $searchForEmail = "select email, username, password from users where email=?";
                $stmt = Application::$app->db->prepare($searchForEmail);
                $check = $stmt->execute([$email]);

                if ($check){
                    if ($stmt->rowCount()){
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                        $checkPswd = password_verify($pswd, $result["password"]);
                        if ($checkPswd === true){
                            //Database::log($result["username"]." has logged in at ".time());
                            $length = strlen($result["username"]);
                            $_SESSION["userName"] = substr($result["username"], 1, $length);
                            return $this->render("login", ["regModel" => $regModel]);
                        }else{
                            Model::$error["password"][] = Model::RULE_PASSWORD_DOES_NOT_MATCH;
                            return $this->render("login", ["regModel" => $regModel]);
                        }
                    }else{
                        Model::$error["email"][] = "Please insert a valid email!";
                        return $this->render("login", ["regModel" => $regModel]);
                    }
                }else{
                    header("Location: /home?error=sqlError");
                    exit();
                }
            }else{
                return $this->render("login", ["regModel" => $regModel]);
            }
        }
    }

    public function handleRegister(\app\core\Request $req){

        $regModel = new RegisterModel();
        if ($req){
            $body = $req->getBody();
            $regModel->loadData($req->getBody()); //write the posted data to the RegisterModel
            if ($regModel->isValid($req) === true){
                //getting reqBody()
                $fName = $req->getBody()['firstName'];
                $lName = $req->getBody()['lastName'];
                $email = $req->getBody()['email'];
                $uName = "@".$req->getBody()['userName'];
                $pswd = password_hash($req->getBody()["password"], PASSWORD_DEFAULT);

                //checkUsername
                $searchForUsername = "select username from users where username=?";
                $stmt = Application::$app->db->prepare($searchForUsername);
                $check = $stmt->execute([$uName]);

                if ($check){
                    if ($stmt->rowCount() > 0){
                        Model::$error["userName"][] = Model::RULE_USERNAME_EXISTS;
                        return $this->render("register", ["regModel" => $regModel]);
                    }
                }else{
                    header("Location: /home?error=sqlError");
                    exit();
                }
                //checkEmail
                $searchForEmail = "select email from users where email=?";
                $stmtEmail = Application::$app->db->prepare($searchForEmail);
                $check = $stmtEmail->execute([$email]);
                if ($check){
                    if ($stmtEmail->rowCount() > 0){
                        Model::$error["email"][] = Model::RULE_EMAIL_EXISTS;
                        return $this->render("register", ["regModel" => $regModel]);
                    }else{
                    }
                }else{
                    header("Location: /home?error=sqlError");
                    exit();
                }

                //inserting a new record!
                $insertRecord = "insert into users (firstname,
                                                    lastname, 
                                                    email, 
                                                    username, 
                                                    password, 
                                                    status) 
                                 values ('$fName',
                                         '$lName', 
                                         '$email', 
                                         '$uName',
                                         '$pswd',
                                         1)";
                $stmt = Application::$app->db->prepare($insertRecord);
                $stmt->execute();
                Database::log("A new record has been added to the users table!");
                return $this->render("register", ["regModel" => $regModel]);
            }else{
                return $this->render("register", ["regModel" => $regModel]);
            }
        }
    }

}