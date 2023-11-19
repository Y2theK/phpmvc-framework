<?php
use app\models\User;
use Y2thek\PhpMvcframeworkCore\Application;
use app\controllers\SiteController;
use app\controllers\Auth\AuthController;

require_once __DIR__.'/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = require_once __DIR__.'/../config/app.php';

$app = new Application(dirname(__DIR__),$config);

//BEFORE EVENT
// $app->on(Application::EVENT_BEFORE_REQUEST,function(){
//     echo "before request";
// });


$app->router->get('/',[SiteController::class,'home']);

$app->router->get('/register',[AuthController::class,'register']);
$app->router->post('/register',[AuthController::class,'register']);

$app->router->get('/login',[AuthController::class,'login']);
$app->router->post('/login',[AuthController::class,'login']);

$app->router->get('/logout',[AuthController::class,'logout']);

$app->router->get('/profile',[AuthController::class,'profile']);

$app->router->get('/contact',[SiteController::class,'contact']);
$app->router->post('/contact',[SiteController::class,'contact']);

$app->run();