<?php
namespace app\models;


use PDO;

class singleTon{
    static $dbConn;
    public static $db_serverName = "localhost";
    public static $db_name = "phpDB";
    public static $db_userName = "root";
    public static $db_password = "";
    public static $dsn = "";
    public static $options = [
        PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements / for multiple queries turn on
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
        PDO::MYSQL_ATTR_FOUND_ROWS   => true,
    ];

    private function __construct(){}

    public static function getInstance(){
        if (!isset(singleTon::$dbConn)){
            self::$dsn = "mysql:host=" . singleTon::$db_serverName . ";dbname=". singleTon::$db_name;
            singleTon::$dbConn = new PDO(singleTon::$dsn, singleTon::$db_userName, singleTon::$db_password, self::$options);
            return singleTon::$dbConn;
        }
        return singleTon::$dbConn;
    }

}