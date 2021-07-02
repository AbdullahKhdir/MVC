<?php


namespace app\controllers;
use app\Core\Controller;
use app\Core\Model;
use app\core\Request;
use app\models\queries\SignIn;
use app\models\queries\updateQuery;
use app\models\RegisterModel;

class profile extends Controller {

    public function __construct(){}

    public function renderProfile(Request $request = null){
        if(isset($_SESSION["protectedRoutes"]) && isset($_SESSION["userName"])){

            $userName = $_SESSION["userName"];
            $email = $_SESSION["loggedInEmail"];
            $results = (new SignIn())->fetchAccountInfos($userName, $email);

            if(!$results){
                $results = (new SignIn())->fetchAccountInfos($userName);
                if (!$results){
                    $results = (new SignIn())->fetchAccountInfos($email);
                }
            }

            $params = [
                "firstName" => $results[0]["firstname"],
                "lastName" =>  $results[0]["lastname"],
                "email" => $results[0]["email"],
                "userName" => $results[0]["username"],
                "Name" => $results[0]["firstname"]." ".$results[0]["lastname"],
            ];

            return $this->render("profile", $params);
        }else{
            header("Location: /login");
            exit();
        }
    }



    public function handleChangePData(Request $req){
        $regModel = new RegisterModel();

        $userName = $_SESSION["userName"];
        $email = $_SESSION["loggedInEmail"];
        $results = (new SignIn())->fetchAccountInfos($userName, $email);

        if(!$results){
            $results = (new SignIn())->fetchAccountInfos($userName);
            if (!$results){
                $results = (new SignIn())->fetchAccountInfos($email);
            }
        }

        if ($req){
            $body = $req->getBody();
            $regModel->loadData($req->getBody()); //write the posted data to the RegisterModel

            if ($regModel->isValid($req) === true){
            }else{

                if (isset($_POST["btnProfilePicture"])){
                    $file = $_FILES["ProfilePicture"];

                    $fileName = $_FILES["ProfilePicture"]["name"];
                    $fileTmpName = $_FILES["ProfilePicture"]["tmp_name"];
                    $fileSize = $_FILES["ProfilePicture"]["size"];
                    $fileError = $_FILES["ProfilePicture"]["error"];
                    $fileType = $_FILES["ProfilePicture"]["type"];

                    $fileExtension = explode(".", $fileName);
                    $fileActuallExtension = strtolower(end($fileExtension));

                    if (in_array($fileActuallExtension, ["jpg", "png", "jpeg"])){
                        if ($fileError == 0){
                            if ($fileSize < 200000){
                                $fileNameNew = uniqid("", true).".".$fileActuallExtension;
                                $fileDestination = __DIR__ . "/../assets/" .$fileNameNew;
                                move_uploaded_file($fileTmpName, $fileDestination);
                                header("Location: /profile?upload=success");
                                exit();
                            }else{
                                header("Location: /profile?error=fileSize");
                                exit();
                            }
                        }else{
                            header("Location: /profile?error=uploadFileError");
                            exit();
                        }
                    }else{
                        header("Location: /profile?profilePicture=invalidFile");
                        exit();
                    }

                    header("Location: /profile");
                    exit();
                }

                if (isset($_POST["resetPic"])){
                    header("Location: /profile");
                    exit();
                }

                if (isset($_POST["btnfirstName"])){
                    if(isset($_POST["firstName"])){
                        if($_POST["firstName"] !== $results[0]["firstname"]){
                            (new updateQuery())->update("btnfirstName", $_POST["firstName"], $results[0]["email"]);
                        }else{
                            //notify
                        }
                    }
                }

                if (isset($_POST["btnlastName"])){
                    if(isset($_POST["lastName"])){
                        if($_POST["lastName"] !== $results[0]["lastname"]){
                            (new updateQuery())->update("btnlastName", $_POST["lastName"], $results[0]["email"]);
                        }else{
                            //notify
                        }
                    }
                }

                if (isset($_POST["btnuserName"])){
                    if(isset($_POST["userName"])){
                        if("@".$_POST["userName"] !== $results[0]["username"]){
                            (new updateQuery())->update("btnuserName", "@".$_POST["userName"], $results[0]["email"]);
                        }else{
                            //notify
                        }
                    }
                }

                if (isset($_POST["btnemail"])){
                    if(isset($_POST["email"])){
                        if($_POST["email"] !== $results[0]["email"]){
                            (new updateQuery())->update("btnemail", $_POST["email"], $results[0]["email"]);
                        }else{
                            //notify
                        }
                    }
                }

                if (isset($_POST["btnpassword"])){
                    if(isset($_POST["password"])){
                        if ($_POST["password"] == "start-123"){

                        }else{
                            $_POST["password"] = password_hash($_POST["password"], PASSWORD_DEFAULT);
                            (new updateQuery())->update("btnpassword", $_POST["password"], $results[0]["email"]);
                        }
                    }
                }

                return $this->render("profile", ["regModel" => $regModel]);
            }
        }
    }

}
