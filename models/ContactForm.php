<?php

namespace app\models;

use Y2thek\PhpMvcframeworkCore\Model;

class ContactForm extends Model
{
    public string $subject = '';
    public string $email = '';
    public string $body = '';

    public function rules()
    {
        return [
            'subject' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED,self::RULE_EMAIL],
            'body' => [self::RULE_REQUIRED],
        ];
    }

    public function send(){
        return true;
    }
}