<?php

require_once __DIR__.'/../vendor/autoload.php';

use app\controllers\Auth\AuthController;
use app\core\Application;
use app\controllers\SiteController;

$app = new Application(dirname(__DIR__));

$app->router->get('/',[SiteController::class,'home']);

$app->router->get('/contact',[SiteController::class,'contact']);
$app->router->get('/login',[AuthController::class,'login']);
$app->router->get('/register',[AuthController::class,'register']);

$app->router->post('/contact',[SiteController::class,'handleContact']);
$app->router->post('/login',[AuthController::class,'handleLogin']);
$app->router->post('/register',[AuthController::class,'handleRegister']);

$app->run();