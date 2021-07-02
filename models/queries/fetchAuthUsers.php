<?php


namespace app\models\queries;


use app\Core\Database;
use PDO;

class fetchAuthUsers{

    public function __construct(){}

    public function fetchAuthUsers(): array{
        $stmt = Database::$dbConn->prepare("select email from authUsers");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}