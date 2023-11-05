<?php

namespace app\core;

class View 
{
    public string $title = '';
    
    public function renderView($view,$params = []){

        $viewContent = $this->renderOnlyView($view,$params);
        $layoutContent = $this->layoutView();

       return str_replace('{{ content }}',$viewContent,$layoutContent);
    }

    public function renderOnlyView($view,$params)
    {
        foreach($params as $key => $value){
            $$key = $value;
        }
        ob_start();   //store main.php as string in cache and return 
        include_once(Application::$ROOT_DIR . "/views/$view.php");  //include file
        return ob_get_clean();
    }

    protected function layoutView()
    {

        $layout = Application::$app->layout;
        if(Application::$app->controller){
            $layout = Application::$app->controller->layout;
        }
        ob_start();   //store main.php as string in cache and return 
        include_once(Application::$ROOT_DIR . "/views/layouts/$layout.php");
        return ob_get_clean();
    }
}