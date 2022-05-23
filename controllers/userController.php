<?php

namespace app\controllers;

use app\engine\App;

class UserController extends Controller
{
    public function actionCheckLogin()
    {
        $login = App::call()->request->getParams()['login'];
        $answer = [
            'check' => true
        ];
        echo json_encode($answer, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}