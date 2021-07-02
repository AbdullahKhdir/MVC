<?php
namespace app\models\queries;
use app\Core\Database;
use app\models\singleTon;
use PDO;

class SignIn{

    public function __construct(){}

    public function signIn(){

       /* if (isset($_POST["inputEmail"]) || isset($_POST["inputPswd"])) {
            if (isset($_POST["SignIn"])) {
                if ($_POST["SignIn"] == "Login") {

                    $conn = singleTon::getInstance();
                    if (!empty($_POST["email"]) || !empty($_POST["password"])) {
                        if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                            $userSignInQuery = "select USER_EMAIL, psd, user_access, id
                                        from users
                                        where USER_EMAIL=?;";

                            $stmt = $conn->prepare($userSignInQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

                            $check = $stmt->execute([$_POST["email"]]);

                            if ($check) {
                                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                $checkPassword = password_verify($_POST["password"] , $result["psd"]);
                                if ($checkPassword === false) {
                                    //header("Location: index.php?error=pswdDoesNotMatch");
                                    //exit();
                                }else {
                                    if ($stmt->rowCount()) {
                                        $_SESSION["rowCount"] = $stmt->rowCount();
                                    }
                                    session_start();
                                    $_SESSION["userId"] = $result["id"];
                                    $_SESSION["username"] = $result["user_access"];

                                    //header("Location: index.php?login=success");
                                    //exit();
                                }
                            }else {
                                //header("Location: index.php?error=userDoesNotExist");
                                //exit();
                            }
                        }else {
                            //header("Location: index.php?error=unvalidEmail");
                            //exit();
                        }
                    }else {
                        //header("Location: index.php?signIn=empty");
                        //exit();
                    }
                }
            }elseif (isset($_POST["SignOut"])) {
                if ($_POST["SignOut"] === "Sign Out") {
                    unset($_SESSION["userId"]);
                    unset($_SESSION["username"]);
                    //session_unset();
                    //session_destroy();
                    //header("Location: index.php?signOut=success");
                    //exit();
                }
            }
        }
        */
    }

    public function fetchAccountInfos($userName = null, $email = null){
        if ($email){
            $stmt = Database::$dbConn->prepare("select firstname, lastname, email, username from users where email='$email'");
        }else if($userName){
            $stmt = Database::$dbConn->prepare("select firstname, lastname, email, username from users where userName='@$userName'");
        }else{
            $stmt = Database::$dbConn->prepare("select firstname, lastname, email, username from users where email='$email' and userName='@$userName'");
        }
        $stmt->execute();
        /*if(!$stmt->fetchAll(PDO::FETCH_ASSOC)){
            $stmt = Database::$dbConn->prepare("");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }*/
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}