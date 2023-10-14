<?php

namespace app\controllers\Auth;

use app\core\Controller;
use app\core\Request;

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
        // $request->getBody();
    }
    public function register()
    {
        $this->setLayout('guest');
        return $this->render('register');
    }
    public function handleRegister(Request $request)
    {
        echo "<pre>" ;
        var_dump($request->getBody());
         echo "</pre> ";
    // $request->getBody();
    }
}