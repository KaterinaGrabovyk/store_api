<?php

use App\Config;
use App\Router;

require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();


//* routes

$router=new Router();
$router
    ->get('/products',[App\Controllers\QueriesController::class,'getAll',(new Config())->getConnect()]);


$router->resolve($_SERVER['REQUEST_URI'],$_SERVER['REQUEST_METHOD']);