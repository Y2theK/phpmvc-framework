<?php


$app = require_once __DIR__.'/../bootstrap/app.php';

//BEFORE EVENT
// $app->on(Application::EVENT_BEFORE_REQUEST,function(){
//     echo "before request";
// });


require_once __DIR__.'/../routes/web.php';

$app->run();