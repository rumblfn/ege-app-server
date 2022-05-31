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
    public function actionEditImg()
    {
        $base64_img = App::call()->request->getParams()['text'];
        $login = App::call()->request->getParams()['login'];

        $user = App::call()->userRepository->getWhere('login', $login);
        $user->profileImg = $user->id . '.jpg';
        App::call()->userRepository->save($user);

        $path = dirname(__DIR__)  . '/public/uploads/user_imgs/' . $user->id . '.jpg';

        $answer = [
            'login' => $login,
            'status' => true
        ];

        base64_to_jpeg($base64_img, $path);
        echo json_encode($answer, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
    public function actionRemoveImg()
    {
        $login = App::call()->request->getParams()['login'];
        $user = App::call()->userRepository->getWhere('login', $login);
        $user->profileImg = null;
        App::call()->userRepository->save($user);

        $answer = [
            'login' => $login,
            'status' => true,
        ];

        echo json_encode($answer, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}

function base64_to_jpeg($base64_string, $output_file) {
    $ifp = fopen( $output_file, 'wb' ); 

    $data = explode( ',', $base64_string );
    fwrite( $ifp, base64_decode( $data[ 1 ] ) );
    fclose( $ifp );
}