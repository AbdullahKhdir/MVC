<?php


namespace app\migrations;

use app\core\Application;
use app\Core\Database;

class m0001_init{

    public function __construct(){}

    public function init(){
        Database::log("Creating users table!");
        $this->createUsersTable();
    }

    public function destruct(){
        Database::log("Dropping users table!");
        $this->dropUsersTable();
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

    public function dropUsersTable(){
       $SQL = "drop table users";
       Application::$app->db->exec($SQL);
    }

}