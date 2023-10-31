<?php

namespace app\core;

use app\core\Router;
use app\core\Request;
use app\core\Session;
use app\core\Response;

class Application{

    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public static string $ROOT_DIR;
    public static Application $app;
    public Database $db;

    public Controller $controller;

    public function __construct(string $rootPath,array $config)
    {
        self::$app = $this;
        self::$ROOT_DIR = $rootPath;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request,$this->response);
        $this->db = new Database($config['db']);
        
    }

    public function run(){
        echo $this->router->resolve();
    }
}