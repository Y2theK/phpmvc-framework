<?php

namespace app\controllers\Auth;

use app\models\User;
use Y2thek\PhpMvcframeworkCore\Request;
use Y2thek\PhpMvcframeworkCore\Response;
use Y2thek\PhpMvcframeworkCore\Controller;
use Y2thek\PhpMvcframeworkCore\Application;
use app\models\LoginForm;
use Y2thek\PhpMvcframeworkCore\middlewares\AuthMiddleware;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile']));
    }

    public function login(Request $request,Response $response)
    {
        $loginForm = new LoginForm();
        if($request->isPost()){
            $loginForm->loadData($request->getBody());
            if($loginForm->validate() && $loginForm->login()){
                $response->redirect('/');
                return;
            }
        }
        $this->setLayout('guest');
        return $this->render('login',[
            'model' => $loginForm
        ]);
    }

    public function profile(){
        $user = Application::$app->user;
        return $this->render('profile',[
            'user' => $user
        ]);
    }

    public function register(Request $request)
    {
        $this->setLayout('guest');

        $user = new User();

            if($request->isGet()){
                return $this->render('register',[
                    'model' => $user
                ]);
            }
            $user->loadData($request->getBody());

            if($user->validate() && $user->save()){

                Application::$app->session->setFlashMessage("success","Thank you for registering");
                Application::$app->response->redirect('/');
            }
           
            return $this->render('register',[
                'model' => $user
            ]);
    }

    public function logout(Request $request,Response $response){
        Application::$app->logout();
        $response->redirect('/');
    }
       
}