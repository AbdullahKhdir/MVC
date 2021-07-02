<?php
use app\controllers\AuthController;
use app\controllers\SiteController;
use app\Core\application;
use app\core\Request;
use app\Core\Response;

require_once __DIR__ ."/vendor/autoload.php";
require_once __DIR__."/Core/Request.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->Load();

$config = [
    "DB" => [
        "dsn" => $_ENV['DB_DSN'],
        "user" => $_ENV['DB_USER'],
        "password" => $_ENV['DB_PASSWORD'],
    ],
];

$app = new \app\Core\Application(__DIR__, $config);

\app\Core\Database::applyMigrations();
//var_dump(\app\Core\Database::getAuthUsers());