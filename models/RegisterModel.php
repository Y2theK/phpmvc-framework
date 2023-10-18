<?php

namespace app\models;

use app\core\Model;

class RegisterModel extends Model
{

    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $confirm_password = '';

    public function rules()
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED,self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED , [self::RULE_MIN , 'min' => '8']],
            'confirm_password' => [self::RULE_REQUIRED , [self::RULE_MATCH , 'match' => 'password']],
        ];
    }

    public function register(){
        return true;
    }

}