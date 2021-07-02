<?php
namespace app\migrations;
ob_start();
@session_start();
?>
<?php

use app\core\Application;
use app\Core\Database;
use PDO;

class m0001_init{

    public function __construct(){}

    public function init(){
        Database::log("Creating users table!");
        $this->createUsersTable();
        $this->createAuthUsersTable();
        $this->insertAuthUser();
    }

    public function destruct(){
        Database::log("Dropping users table!");
        $this->dropUsersTable();
        $this->dropAuthUsersTable();
    }

    public function createUsersTable(){
      $SQL = "create Table if not exists users(
                id int not null auto_increment primary key,
                firstname varchar(20) not null ,
                lastname varchar(20) not null,
                email varchar(50) not null ,
                username varchar(100) not null,
                password varchar(255) not null,
                status tinyint not null,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
               ) ENGINE=INNODB;      
             ";
      $stmt = Application::$app->db->prepare($SQL);
      $stmt->execute();
      Database::log("Table users is created!");
    }

    public function createAuthUsersTable(){
        $SQL = "create Table if not exists authUsers(
                id int not null auto_increment primary key,
                email varchar(50) not null ,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
               ) ENGINE=INNODB;      
             ";
        $stmt = Application::$app->db->prepare($SQL);
        $stmt->execute();
        Database::log("Table authUsers is created!");
    }

    public function dropUsersTable(){
       $SQL = "drop table users";
       Application::$app->db->exec($SQL);
       Database::log("Table authUsers is dropped!");
    }
    public function dropAuthUsersTable(){
        $SQL = "drop table authUsers";
        Application::$app->db->exec($SQL);
        Database::log("Table authUsers is dropped!");
    }

    public function insertAuthUser(){
        Database::$dbConn->exec("insert into authUsers (email) values ('abdullah.khdir@telekom.de'),('abdullahkhder77@gmail.com')");
        Database::log("Administrator is inserted!");
    }

}

