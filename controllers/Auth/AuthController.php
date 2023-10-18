<?php

namespace app\controllers\Auth;

use app\core\Request;
use app\core\Controller;
use app\models\RegisterModel;

class AuthController extends Controller
{

    public function login()
    {
        $this->setLayout('guest');
        return $this->render('login');
    }
    public function handleLogin(Request $request)
    {
       
        echo "<pre>" ;
        var_dump($request->getBody());
         echo "</pre> ";    
    }
    public function register(Request $request)
    {
        $this->setLayout('guest');

        $registerModel = new RegisterModel();

            if($request->isGet()){
                return $this->render('register',[
                    'model' => $registerModel
                ]);
            }
            $registerModel->loadData($request->getBody());

            if($registerModel->validate() && $registerModel->register()){
                return 'create user success';
            }
           
            return $this->render('register',[
                'model' => $registerModel
            ]);
    }
    public function handleRegister(Request $request)
    {
        // $this->registerModel = new RegisterModel();

        // $this->registerModel->loadData($request->getBody());


        // if($this->registerModel->validate() && $this->registerModel->register()){
        //     return 'success';
        // }
        // return $this->render('register',[
        //     'model' => $this->registerModel
        // ]);
       

    }
}