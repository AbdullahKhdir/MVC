<?php


namespace app\models\queries;


use app\models\singleTon;

class Register
{

    public function __construct(){}

    public function signUp()
        {
            /*$dbConn = singleTon::getInstance();

            if (isset($_POST["register"])) {
                if ($_POST["register"] === "Register") {

                    $firstName = $_POST["firstName"];
                    $lastName = $_POST["lastName"];
                    $userUID = $_POST["userName"];
                    $userEmail = $_POST["email"];
                    $userPswd = password_hash($_POST["password"], PASSWORD_DEFAULT); //md5($_POST["inputPswd"])

                    if (!empty($firstName) || !empty($lastName) ||
                        !empty($userUID) || !empty($userEmail) || !empty($userPswd)) {

                        $insertUserSql = "select USER_EMAIL
                                  from users
                                  where USER_EMAIL=?;";

                        $stmt = $dbConn->prepare($insertUserSql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

                        $check = $stmt->execute([$userEmail]);

                        if (!$check) {
                            //$_SESSION["REDIRECT"] = "SIGNIN";
                            //header("Location: main.php?error=sqlError");
                            //exit();
                        } else {
                            $checkUsername = $stmt->rowCount();
                            if ($checkUsername > 0) { //checking for existing username
                                //header("Location: main.php?error=usernameExists");
                                //exit();
                                echo "Username exist!";
                                return null;
                            } else { //singing up the user
                                //using prepared statements
                                $insertPreStmt = "insert into users (
                                          user_firstName,
                                             psd,
                                               user_lastName,
                                                 user_access,
                                                  USER_EMAIL) values
                                                  (?,?,?,?,?);";
                                $stmt = $dbConn->prepare($insertPreStmt);
                                if (!$stmt) {
                                    //$_SESSION["REDIRECT"] = "SIGNIN";
                                    //header("Location: main.php?error=sqlError");
                                    //exit();
                                } else {
                                    $check = $stmt->execute([$firstName, $userPswd, $lastName, $userUID, $userEmail]);
                                    //$_SESSION["REDIRECT"] = "SIGNIN";
                                    //header("Location: main.php?signup=successPDO");
                                    //exit();
                                }
                            }
                        }


                    } else {
                        header("Location: main.php?signup=empty");
                        exit();
                    }


                }
            }*/
        }

}