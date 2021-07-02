<?php

namespace app\Core;
use app\controllers\AuthorizedUsers;
use JetBrains\PhpStorm\Pure;
use PDO;

class Database{

    public static \PDO $dbConn;
    public static array $newMigrations = [];
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
        Database::$dbConn->exec(Database::$createMigrations);
    }

    public static function getAppliedMigrations(): array {
        Database::createMigration();
        $stmt = Database::$dbConn->prepare("select migration from migrations");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public static function applyMigrations(){
        Database::createMigration();
        $getAppliedMigrations = Database::getAppliedMigrations();
        $files = scandir(Application::$ROOT_DIR."/migrations");
        $toApplyMigrations = array_diff($files, $getAppliedMigrations);

        foreach ($toApplyMigrations as $migration){
            if ($migration === "." || $migration === "..") {
                continue;
            }
            require_once Application::$ROOT_DIR."/migrations/".$migration;

            $className = pathinfo($migration, PATHINFO_FILENAME);
            $namespace = "\app\migrations";
            $className = addcslashes($className, $className[0]);
            $className = $namespace.$className;
            $instance = new $className();

            if ($className == "\app\migrations\m0001_init"){
                $instance->init();
                array_push(Database::$newMigrations, $migration);
                $className = null;
            }elseif ($className == "\app\migrations\m0002_destruct"){
            }
        }

        if (!empty(Database::$newMigrations)){
            Database::saveMigrations(Database::$newMigrations);
        }else{
            Database::log("All migrations are applied!".PHP_EOL);
        }
    }

    public static function saveMigrations(array $migrations){
        $insertSqlValues = implode(",", array_map(fn($mig) => "('$mig')", $migrations));
        $insertSql = "insert into migrations (migration) values $insertSqlValues ";
        $stmt = Database::$dbConn->prepare($insertSql);
        $stmt->execute();
    }

    public static function log($msg){
        echo "[". date('Y-m-d H:i:s') ."] - ".$msg.PHP_EOL;
    }
}
