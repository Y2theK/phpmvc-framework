<?php

namespace app\core;

use app\core\Router;
use app\core\Request;
use app\core\Session;
use app\core\Response;

class Application{

    public string $layout = 'main';

    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public static string $ROOT_DIR;
    public static Application $app;
    public Database $db;
    public ?DbModel $user;

    public string $userClass;

    public ?Controller $controller = null;

    public function __construct(string $rootPath,array $config)
    {
        self::$app = $this;
        self::$ROOT_DIR = $rootPath;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request,$this->response);
        $this->db = new Database($config['db']);

        $this->userClass = $config['userClass'];

        $primaryValue = $this->session->get('user');
        
        if($primaryValue){
            $primaryKey = $this->userClass::primaryKey();

           $this->user =  $this->userClass::findOne([$primaryKey => $primaryValue]);
        }else{
            $this->user = null;
        }

        
    }
    public function login(DbModel $user){
        $this->user = $user;
        $primaryKey =  $user->primaryKey();

        $primaryValue = $user->$primaryKey;

        $this->session->set('user',$primaryValue);

        return true;
    }

    public function logout(){
        $this->user = null;
        $this->session->remove('user');
    }

    public static function isGuest(){
        return !self::$app->user;
    }
    public function run(){
        try {
            echo $this->router->resolve();
        } catch (\Exception $e) {
            $this->response->setStatusCode($e->getCode());
            echo $this->router->renderView('errors/error',[
                'exception' => $e
            ]);
        }
    }
}