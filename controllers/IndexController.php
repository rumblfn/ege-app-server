<?php

namespace app\controllers;

use app\engine\App;

class IndexController extends Controller
{
    public function actionIndex()
    {
        $subjects = App::call()->subjectRepository->getAll();
        var_dump($subjects);
    }
}