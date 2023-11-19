<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';

//BEFORE EVENT
// $app->on(Application::EVENT_BEFORE_REQUEST,function(){
//     echo "before request";
// });

$app->run();