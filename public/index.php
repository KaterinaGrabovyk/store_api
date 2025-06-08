<?php

use App\App;
use App\Config;
use App\Controllers\QueriesController;
use App\Router;

require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

//* routes

$router=new Router();
$router
    ->get('/products',[QueriesController::class,'getAll'])
    ->get('/products/{:id}',[QueriesController::class,'getId'])
    ->post('/add',[QueriesController::class,'add'])
    ->put('/products/update/{:id}',[QueriesController::class,'update'])
    ;


(new App(
       $router,
       ['uri'=>$_SERVER['REQUEST_URI'],'method'=>$_SERVER['REQUEST_METHOD']],
       new Config()
))->run();