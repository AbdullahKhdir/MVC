<?php


namespace app\models\queries;


use app\core\Application;
use app\Core\Controller;
use app\Core\Database;
use PDO;

class updateQuery extends Controller{

    public function __construct(){}

    public function update($field, $value, $result){
        $column = strtolower(str_replace("btn","",$field));

        if ($column == "email"){
            //checkEmail
            $searchForEmail = "select email from users where email=?";
            $stmtEmail = Application::$app->db->prepare($searchForEmail);
            $check = $stmtEmail->execute([$value]);
            if ($check){
                if ($stmtEmail->rowCount() > 0){
                    //Model::$error["email"][] = Model::RULE_EMAIL_EXISTS;
                    header("Location: /profile");
                    exit();
                }else{

                    $stmt = Database::$dbConn->prepare("update users set $column = '$value' where email='$result'");
                    $stmt->execute();
                    $stmt = Database::$dbConn->prepare("update authUsers set $column = '$value' where email='$result'");
                    $stmt->execute();
                    header("Location: /logout");
                    exit();
                }
            }else{
                header("Location: /home?error=sqlError");
                exit();
            }
        }else{
            $stmt = Database::$dbConn->prepare("update users set $column = '$value' where email='$result'");
            $stmt->execute();
            header("Location: /profile");
            exit();
        }

    }
}