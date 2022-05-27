<?php

namespace app\controllers;

use app\engine\App;
use app\models\entities\User;

class AuthController extends Controller
{
    public function actionRegister()
    {
        $login = App::call()->request->getParams()['login'];
        $password = App::call()->request->getParams()['password'];
        $user = new User($login, $password);

        $answer = App::call()->userRepository->insert($user);
        echo json_encode($answer, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function actionLogin()
    {
        $login = App::call()->request->getParams()['login'];
        $pass = App::call()->request->getParams()['password'];
        $answer = [
            "status" => false
        ];
        if (App::call()->userRepository->Auth($login, $pass)) {
            $user = App::call()->userRepository->getWhere('login', $login);
            $answer = [
                "status" => $user->status,
                "login" => $user->login,
                "statusUser" => true,
                "email" => $user->email,
                "karma" => $user->karma,
                "profileImg" => $user->profileImg,
                "profileBannerImg" => $user->profileBannerImg,
            ];
        }
        echo json_encode($answer, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}