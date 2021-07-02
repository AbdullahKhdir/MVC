<?php
namespace app\controllers;
use app\Core\Database;
use app\models\queries\fetchAuthUsers;
use Dotenv\Dotenv;
use PDO;

require_once __DIR__ ."/../vendor/autoload.php";
require_once __DIR__."/../Core/Request.php";

class AuthorizedUsers{

    private array $authUsers = [];

    public function __construct(){}
    public function fetchAuthUsers(){
        $this->authUsers = (new fetchAuthUsers())->fetchAuthUsers();
    }

    public function getAuthUsers(): array{
        $this->fetchAuthUsers();
        return $this->authUsers;
    }

}