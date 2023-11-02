<?php

namespace app\models;

use app\core\DbModel;
use app\core\Model;
use app\core\UserModel;

class User extends UserModel
{

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;

    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $confirm_password = '';
    public int $status = self::STATUS_INACTIVE;

    public function rules()
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED,self::RULE_EMAIL ,[ self::RULE_UNIQUE , 'class' => self::class ]],
            'password' => [self::RULE_REQUIRED , [self::RULE_MIN , 'min' => '8']],
            'confirm_password' => [self::RULE_REQUIRED , [self::RULE_MATCH , 'match' => 'password']],
        ];
    }

    public function getDisplayName(): string
    {
        return $this->name;
    }

    public function save(){

        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
        
        return parent::save();
    }

    public static function tableName(): string
    {
        return 'users';
    }
    public static function primaryKey(): string
    {
        return 'id';
    }

    public function attributes(): array
    {
        return ['name' , 'email' , 'password' , 'status'];
    }

}