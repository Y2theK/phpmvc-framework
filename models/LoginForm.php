<?php

namespace app\models;

use Y2thek\PhpMvcframeworkCore\Application;
use Y2thek\PhpMvcframeworkCore\Model;
use app\models\User;

class LoginForm extends Model
{
    public string $email = '';
    public string $password = '';

    public function rules()
    {
        return [
            'email' => [self::RULE_REQUIRED,self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED]
        ];
    }
    public function login()
    {
        $user = User::findOne(['email' => $this->email]);
        if(!$user){
            $this->addError('email','User does not exist with this email');
            return false;
        }

        if(!password_verify($this->password,$user->password)){
            $this->addError('password','Password is not correct');
            return false;
        }
      
        return Application::$app->login($user);

    }
}