<?php

use App\App;
use App\Config;
use App\Controllers\QueriesController;
use App\Controllers\PagesController;
use App\Router;

require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

define('VIEW_PATH',__DIR__ . '/../views');
//* routes
$router=new Router();
$router
    ->get('/products',[QueriesController::class,'getAll'])
    ->get('/products/{:id}',[QueriesController::class,'getbyId'])
    ->post('/products/add',[QueriesController::class,'add'])
    ->put('/products/update/{:id}',[QueriesController::class,'update'])
    ->patch('/products/update/{:id}',[QueriesController::class,'patch'])
    ->delete('/products/delete/{:id}',[QueriesController::class,'delete'])
    ->get('/',[PagesController::class,'index']);
    ;


(new App(
       $router,
       ['uri'=>$_SERVER['REQUEST_URI'],'method'=>$_SERVER['REQUEST_METHOD']],
       new Config()
))->run();