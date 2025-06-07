<?php

use App\Config;
use App\Controllers\QueriesController;

require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
$res=new QueriesController((new Config())->getConnect());
$res->handleReq();