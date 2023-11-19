<?php

use app\models\User;

return [
    'userClass' => User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'] ?? "mysql:host=localhost;port=3306;dbname=mvc_framework",
        'user' => $_ENV['DB_USER'] ?? "root",
        'password' => $_ENV['DB_PASSWORD'] ?? "",
    ]
];
