<?php

use Dotenv\Dotenv;
use Y2thek\PhpMvcframeworkCore\Application;

require_once __DIR__.'/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = require_once __DIR__.'/../config/app.php';

$app = new Application(dirname(__DIR__),$config);


return $app;