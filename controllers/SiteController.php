<?php

namespace app\controllers;

use Y2thek\PhpMvcframeworkCore\Application;
use Y2thek\PhpMvcframeworkCore\Controller;
use Y2thek\PhpMvcframeworkCore\Request;
use Y2thek\PhpMvcframeworkCore\Response;
use app\models\ContactForm;

class SiteController extends Controller{

    public function home()
    {
        $params = [
            "name" => "Ye Yint Kyaw"
        ];
        return $this->render('home',$params);
    }

    public function contact(Request $request,Response $response){
        
        $contactForm = new ContactForm();
        if($request->isPost()){
            $contactForm->loadData($request->getBody());
            if($contactForm->validate() && $contactForm->send()){
                Application::$app->session->setFlashMessage('success','Thank for contact us');
                return $response->redirect('/contact');
            }

        }
        return $this->render('contact',[
            'model' => $contactForm
        ]);
    }

   
}