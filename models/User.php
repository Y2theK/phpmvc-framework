<?php

namespace app\models;

use Y2thek\PhpMvcframeworkCore\DbModel;
use Y2thek\PhpMvcframeworkCore\Model;
use Y2thek\PhpMvcframeworkCore\UserModel;

class User extends UserModel
{

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;

    public array $statusArray = [
        self::STATUS_INACTIVE => 'Inactive',
        self::STATUS_ACTIVE => 'Active',
        self::STATUS_DELETED => 'Deleted',
    ];
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
    public function getDisplayStatus(): string
    {
        return $this->statusArray[$this->status];
    }

    public function save(){

        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
        $this->status = self::STATUS_ACTIVE;
        
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