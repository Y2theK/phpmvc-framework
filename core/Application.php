<?php

namespace app\core;

use app\core\Router;
use app\core\Request;
use app\core\Response;

class Application{

    public Router $router;
    public Request $request;
    public Response $response;
    public static string $ROOT_DIR;
    public static Application $app;
    public Controller $controller;

    public function __construct(string $rootPath)
    {
        self::$app = $this;
        self::$ROOT_DIR = $rootPath;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request,$this->response);
        
    }

    public function run(){
        echo $this->router->resolve();
    }
}