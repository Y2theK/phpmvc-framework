<?php

namespace app\core;

class Session{

    public const FLASH_KEY = "flash_message";
    public function __construct() {
        session_start();

        $flash_messages = $_SESSION[self::FLASH_KEY] ?? [];
        //mark to be removed //you cant delete right here because you will use this flash for the first request
        foreach ($flash_messages as $key => &$flash_message) {
            $flash_message['removed'] = true;
        }

        $_SESSION[self::FLASH_KEY] = $flash_messages;

    }

    public function setFlashMessage($key , $message){
        $_SESSION[self::FLASH_KEY][$key] = [
            'removed' => false,
            'value' => $message
        ];
    }

    public function getFlashMessage($key){
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
    }

    public function __destruct()
    {
        $flash_messages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flash_messages as $key => &$flash_message) {
            if($flash_message['removed']) {
                unset($flash_messages[$key]);
            }
        }

        $_SESSION[self::FLASH_KEY] = $flash_messages;
    }
    public function set($key,$value){
        $_SESSION[$key] = $value;
    }
    public function get($key){
        return $_SESSION[$key] ?? false;
    }
    public function remove($key){
        unset($_SESSION[$key]);
    }
}