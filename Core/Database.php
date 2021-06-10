<?php

namespace app\Core;
use PDO;

class Database{

    public static \PDO $dbConn;

    public static string $createMigrations = "CREATE TABLE IF NOT EXISTS migrations (
                                              id int auto_increment primary key ,
                                              migration VARCHAR(255),
                                              created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
                                              ) ENGINE=INNODB;";

    public static array $options = [
        PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements / for multiple queries turn on
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array

    ];

    private function __construct(){}

    public static function getInstance($config): PDO {
        if (!isset(Database::$dbConn)){
            Database::$dbConn = new PDO($config["dsn"], $config["user"], $config["password"], Database::$options);
            return Database::$dbConn;
        }
        return Database::$dbConn;
    }

    public static function createMigration(){
        Database::$dbConn->exec(Database::createMigration());
    }

    public static function getAppliedMigrations(){
        Database::createMigration();
        $stmt = Database::$dbConn->prepare("select migration from migrations");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public static function applyMigrations(){
        Database::createMigration();
        Database::getAppliedMigrations();
        $files = scandir(Application::$ROOT_DIR."/migrations");
        echo "<pre>";
        var_dump($files);
        echo "<pre>";
        exit();
    }

}