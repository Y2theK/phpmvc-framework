<?php

namespace app\core;

use app\core\middlewares\BaseMiddleware;

class Controller{

    public string $layout = 'main';

    public string $action = '';
    /**
     * @var BaseMiddleware[];
     */
    protected array $middlewares = [];

    public function setLayout(string $layout)
    {
        $this->layout = $layout;
    }
    
    public function render(string $view,array $params = [])
    {
        return Application::$app->view->renderView(
            $view,$params
        );
    }

    public function getMiddlewares(){
        return $this->middlewares;
    }

    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }
    
}