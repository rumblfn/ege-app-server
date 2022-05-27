<?php

namespace app\controllers;

use app\engine\App;

class UserController extends Controller
{
    public function actionCheckLogin()
    {
        $login = App::call()->request->getParams()['login'];
        $user = App::call()->userRepository->getWhere('login', $login);
        
        $answer = [
            'check' => true
        ];
        if ($user) {
            $answer['check'] = false;
        }

        echo json_encode($answer, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
    public function actionVerifyEmail()
    {
        $email = App::call()->request->getParams()['email'];
        $login = App::call()->request->getParams()['login'];
        
        $answer = [
            'msg' => 'There are some errors. Try later'
        ];
        echo json_encode($answer, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
    public function actionEditAbout()
    {
        $new_status = App::call()->request->getParams()['text'];
        $login = App::call()->request->getParams()['login'];

        $user = App::call()->userRepository->getWhere('login', $login);
        $user->status = $new_status;
        App::call()->userRepository->save($user);

        $answer = [
            'new_status' => $new_status,
            'login' => $login,
            'status' => true
        ];
        echo json_encode($answer, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}